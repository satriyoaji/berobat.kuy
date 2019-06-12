<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Detailresep;
use frontend\models\DetailresepSearch;
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
use yii\db\Query;
/**
 * DetailresepController implements the CRUD actions for Detailresep model.
 */
class DetailresepController extends Controller
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
     * Lists all Detailresep models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DetailresepSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $provider = new ActiveDataProvider([
                'query'=>Detailresep::find()
                 ->where(['resepID'=>$id]),
                'Pagination'=>[
                'pageSize'=>6,
                ],
            ]);
        }
        else{
            $provider = new ActiveDataProvider([
                'query'=>Detailresep::find(),
                'Pagination'=>[
                'pageSize'=>6,
                ],
            ]);
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'provider'=> $provider,
        ]);
    }

    /**
     * Displays a single Detailresep model.
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
     * Creates a new Detailresep model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Detailresep();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $banyak = $model->detailResepQuantity;
            $obatQuery=(new Query())
                ->from('obat')
                ->where(['obatID' => $model->obatID]);
            foreach($obatQuery->each() as $obat){ 
                $harga = $obat['obatHarga'];
            }
            $harga = $harga * $banyak;
            $model->detailResepSubtotal = $harga;
            $model->save();

            $hargaAkhir = 0;
            $resepQuery=(new Query())
                ->from('detailResep')
                ->where(['resepID' => $_SESSION['resep']]);
            foreach($resepQuery->each() as $resep){ 
                $hargaAkhir = $resep['detailResepSubtotal'] + $hargaAkhir;
            }
            Yii::$app->db->createCommand()->update('resep', ['resepTotalHarga' => $hargaAkhir], ['resepID'=>$_SESSION['resep']])->execute();
            return $this->redirect(['pemeriksaan/update','id'=>$_SESSION['pemeriksaan']]);
        }
        return $this->render('create',[
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Detailresep model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->detailResepID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Detailresep model.
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
     * Finds the Detailresep model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Detailresep the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Detailresep::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
