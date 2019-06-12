<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Users;
use frontend\models\GantiPassword;
use frontend\models\UsersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile; 
use yii\db\Query;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndexdokter()
    {
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indexdokter', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndexkasir()
    {
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indexkasir', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDokter()
    {
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('dokter', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPasien()
    {
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('pasien', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /* 
        gawe shaf nek kate nyambungno file anyar garek kopas sing bagian index 
        actionIndex diganti action nama file e
        yang di render diganti index jadi nama file e
    */
    public function actionApoteker()
    {
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('apoteker', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Users model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Users();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->password= sha1($model->password);
            $model->userPekerjaan = 1;
            $model->save();

            return $this->redirect(['site/login']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model2 = new GantiPassword();

        if ($model2->load(Yii::$app->request->post())) {
            echo "halo";
            $model2->username= sha1($model2->username);
            $cekPassword = (new Query())
                ->select('count(*)')
                ->from('users')
                ->where(['password'=>$model2->username]);
            foreach($cekPassword->each() as $cek){
                if($cek['count(*)']){
                    if($model2->userNama == $model2->userEmail){
                        $model->password = sha1($model2->userNama);
                        $model->save();
                    }
                }
            }
            
            return $this->redirect(['view', 'id' => $model->userId]);
        }
        
        if ($model->load(Yii::$app->request->post())) {
            if(isset($model->userFoto)){
                $model->userFoto = UploadedFile::getInstance($model, 'userFoto');
                $model->userFoto->saveAs('gambar/' .$model->userFoto->baseName. '.' .$model->userFoto->extension);
                //save to database
                $model->userFoto = $model->userFoto->baseName. '.' .$model->userFoto->extension;
            
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->userId]);
        }


        return $this->render('update', [
            'model' => $model,
            'model2' => $model2,
        ]);
    }

    /**
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
