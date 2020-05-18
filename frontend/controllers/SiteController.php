<?php
namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\Cari;
use yii\db\Query;
use frontend\models\Resep;
use frontend\models\ResepSearch;
use yii\data\Pagination;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\Helpers\ArrayHelper;
use yii\data\SqlDataProvider;
use frontend\models\Users;
use frontend\models\UsersSearch;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['login', 'signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $status=0;
        $userQuery = (new Query())
            ->from('users')
            ->where(['userId'=>Yii::$app->user->id]);
        foreach($userQuery->each() as $user){ //hasil query pasti 1
            $id = $user['userPekerjaan'];
            $status =1;
        } 
        
        if($status == 1){
            if($id == 3){ //apoteker
                $searchModel = new ResepSearch();
                $provider = new ActiveDataProvider([
                    'query'=>Resep::find(),
                    'Pagination'=>[
                    'pageSize'=>6,
                    ],
                ]);
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('/resep/index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'provider' => $provider,
                ]);
            }

            else if($id == 4){ //kasir
                $model = new Cari();
                if($model->load(Yii::$app->request->post())){
                    $_SESSION['cari']=$model->detailResepDosis;
                    return $this->goHome();
                }

                $searchModel = new UsersSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('/users/indexkasir', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $model,
                ]);
            }

            else if($id > 4){ //profesi dokter
                $searchModel = new UsersSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('/users/indexdokter', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            }

            else {
                return $this->render('index');
            }
        }
            
        
        return $this->render('index');
    }

    public function actionCoronaglobal(){
        return $this->render('coronaglobal');
    }

    public function actionCoronalokal($date = null){
        function http_request($url){
            //persiapkan CURL
            $ch = curl_init();

            //set URL
            curl_setopt($ch, CURLOPT_URL, $url);

            //aktifkan fungsi trans nilai
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            //matikan SSL agar bisa diakses di localhost
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

            //Akses nilainya dan tampung hasil
            $output = curl_exec($ch);

            //close
            curl_close($ch);

            return $output;
        }
        //Data di Indo per hari
        $day = date('d');
        $month = date('n');
        $year = date('Y');
        $index = 1;
        $datum = [];
        for ($d=$day-19; $d<=$day; $d++){
            $hari = $d;
            $bulan = $month;
            $tahun = $year;
            if ($hari<=0){
                $bulan-=1;
                if ($bulan<=0){
                    $tahun-=1;
                    $bulan = 12 + $bulan;
                }
                if (($bulan%2) != 0) //bulan ganjil
                    $hari = 31 + $hari;
                else
                    $hari = 30 + $hari; //februari akan gagal
            }
            $region[$index] = http_request('https://covid19.mathdro.id/api/daily/'.$bulan.'-'.$hari.'-'.$tahun.'"');
            $regions = json_decode($region[$index], TRUE);
            foreach ($regions as $aRegion){
                if ($aRegion["countryRegion"] === "Indonesia"){
                    $datum[$index] = $aRegion;
                }
            }
            $index++;
        }

        //ambil data provinsi
                $data = http_request("https://api.kawalcorona.com/indonesia/provinsi/");
        //ubah format JSON to array assoc
                $data = json_decode($data, TRUE);
        return $this->render('coronalokal', [
            'data' => $data,
            'aRegion' => $datum,
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack(); //untuk kembali ke aktifitas trakhir sebelumnya
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
}
