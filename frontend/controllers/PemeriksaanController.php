<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Pemeriksaan;
use frontend\models\PemeriksaanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
        if(isset($_SESSION['pendaftaranID'])){
            Yii::$app->db->createCommand()->update('pendaftaran', ['pendaftaranStatus' => 'Sudah Diperiksa'], ['pendaftaranID' => $_SESSION['pendaftaranID']])->execute();
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['obat/listobat']);
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
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

    
            if ($model->load(Yii::$app->request->post())) {
                echo $model->pemeriksaanHasil;
                $model->save();
                return Yii::$app->response->redirect(['/obat/listobat']);
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
