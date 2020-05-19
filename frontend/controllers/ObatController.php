<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Obat;
use frontend\models\ObatSearch;
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
use yii\web\UploadedFile;

/**
 * ObatController implements the CRUD actions for Obat model.
 */
class ObatController extends Controller
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
     * Lists all Obat models.
     * @return mixed
     */
    public function actionIndex($id = null)
    {
        $searchModel = new ObatSearch();
        $provider = $searchModel->search(Yii::$app->request->queryParams);
        if($id != null){
            $dataProvider = new ActiveDataProvider([
                'query'=>Obat::find()
                 ->where(['obatGolongan'=>$id]),
                'Pagination'=>[
                'pageSize'=>6,
                ],
            ]);
        }
        else{
            $dataProvider = new ActiveDataProvider([
                'query'=>Obat::find(),
                'Pagination'=>[
                'pageSize'=>6,
                ],
            ]);
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'provider' => $provider,
        ]);
    }

    public function actionListobat()
    {   

        $searchModel = new ObatSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('listobat', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Obat model.
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
     * Creates a new Obat model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Obat();
       
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->obatID]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Obat model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            //upload file
            $model->obatFoto = UploadedFile::getInstance($model, 'obatFoto');
            $photo = $model->obatFoto->baseName. '.' .$model->obatFoto->extension;
            $model->obatFoto->saveAs(Yii::getAlias('@frontend/web/img/obat/') .$photo);
            //save to database
            Yii::$app->db->createCommand()->update('obat', ['obatFoto' => $photo], ['obatId' => $model->obatID])->execute();
            //$model->save();

            return $this->redirect(['view', 'id' => $model->obatID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionTakePill()
    {
        $_SESSION['paid'] = 1;

        return $this->redirect(['obat/index']);
    }

    /**
     * Deletes an existing Obat model.
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
     * Finds the Obat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Obat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Obat::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
