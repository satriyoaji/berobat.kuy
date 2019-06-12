<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Resep;
use frontend\models\ResepSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Configurable; 
use yii\web\Linkable;
use yii\data\Pagination;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\Helpers\ArrayHelper;
use yii\data\SqlDataProvider;

/**
 * ResepController implements the CRUD actions for Resep model.
 */
class ResepController extends Controller
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
     * Lists all Resep models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ResepSearch();
        $provider = new ActiveDataProvider([
            'query'=>Resep::find(),
            'Pagination'=>[
            'pageSize'=>6,
            ],
        ]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'provider' => $provider,
        ]);
    }

    /**
     * Displays a single Resep model.
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
     * Creates a new Resep model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Resep();
        $model->resepTanggal=Yii::$app->formatter->asDate('now', 'dd-MM-yyyy');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->resepID]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Resep model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->resepID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionUptodate($id,$apotekerID)
    {
        $model = $this->findModel($id);
        $model->apotekerID = $apotekerID;
        $model->save();
        return Yii::$app->response->redirect(['/resep/index']);  
    }
    /**
     * Deletes an existing Resep model.
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
     * Finds the Resep model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Resep the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Resep::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
