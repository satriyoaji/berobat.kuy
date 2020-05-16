<?php

namespace frontend\controllers;

use frontend\models\Jenisperiksa;
use Yii;
use frontend\models\Pemeriksaan;
use frontend\models\Nota;
use frontend\models\PemeriksaanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * PemeriksaanController implements the CRUD actions for Pemeriksaan model.
 */
class PemeriksaanController extends Controller
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
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'detail', 'delete'],
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'detail', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Pemeriksaan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PemeriksaanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pemeriksaan model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
        ]);
    }

    /**
     * Creates a new Pemeriksaan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pemeriksaan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $jenisPeriksa = Jenisperiksa::find()
                ->where(['jenisPeriksaID' => $model->jenisPeriksaID])
                ->one();

            if(isset($_SESSION['pendaftaranID'])){
                Yii::$app->db->createCommand()->update('pendaftaran', ['pendaftaranStatus' => 'Sudah Diperiksa'], ['pendaftaranID' => $_SESSION['pendaftaranID']])->execute();
            }

            //kok gabisa pake active record bawaan??
            Yii::$app->db->createCommand()->insert('nota', [
                'notaStatus' => 'sudah bayar',
                'pemeriksaanID' => $model->pemeriksaanID,
                'notaTotalHarga' => $jenisPeriksa['jenisPeriksaHarga'],
                'code' => rand(10, 1000),
            ])->execute();

            return $this->redirect(['pendaftaran/listharian']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Pemeriksaan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) //KOK GABISA UPDATE???
    {
        $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {

                return Yii::$app->response->redirect(['pendaftaran/listharian']);
            }else{
                //var_dump(Yii::$app->errorHandler);
            }
        
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Pemeriksaan model.
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
     * Finds the Pemeriksaan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pemeriksaan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pemeriksaan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
