<?php

namespace backend\controllers;

use Yii;
use backend\models\Obat;
use frontend\models\Resep;
use backend\models\ObatSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile; 
use yii\db\Query;

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
    public function actionIndex()
    {   

        $searchModel = new ObatSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
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
            //upload file
            $model->obatFoto = UploadedFile::getInstance($model, 'obatFoto');
            $model->obatFoto->saveAs('gambar/' .$model->obatFoto->baseName. '.' .$model->obatFoto->extension);
            //save to database
            $model->obatFoto = $model->obatFoto->baseName. '.' .$model->obatFoto->extension;
            $model->save();
            return $this->redirect(['view', 'id' => $model->obatID]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionResep($id){
        $model = new Resep;
        $model['resepTanggal'] ="22-11-20018";
        $model['apotekerID']="";
        $model['pendaftaranID']=$id;
        $model['resepStatus']="";
        $model['resepTotalHarga']=0;
        $model->save();
        return $this->redirect(['create']);
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
             //upload file
             $model->obatFoto = UploadedFile::getInstance($model, 'obatFoto');
             $model->obatFoto->saveAs('gambar/' .$model->obatFoto->baseName. '.' .$model->obatFoto->extension);
             //save to database
             $model->obatFoto = $model->obatFoto->baseName. '.' .$model->obatFoto->extension;
             $model->save();
            return $this->redirect(['view', 'id' => $model->obatID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
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
