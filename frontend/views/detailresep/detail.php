<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\db\Query;
use backend\models\Obat;
use backend\models\Resep;
use backend\models\Pendaftaran;
   $resepID =$_GET['resepID'];
   $obatId = $_GET['idObat'];
   $query4 = Obat::find();
   $query4->andFilterWhere(['like','obatID',$obatId]);
   foreach($query4->each() as $rows){ 
     $obatID = $rows['obatID'];
     $obatharga = $rows['obatHarga'];
  }
     
?>
  <?php $form = ActiveForm::begin(); ?>
 <div class="row">
     <div class="col-md-6 product_img">
        <img  src="<?php echo Yii::getAlias('@userImgUrl')."/".$rows['obatFoto'];?>" class="card-img-top">
      </div>
      <div class="col-md-6 product_content">
           <h3 class="modal-title"><?php echo $rows['obatNama'];?></h3><br>
           <h3><?php echo $rows['obatDeskripsi'];?></h3>
           <h3 class="cost"><span class="glyphicon glyphicon-usd"></span>Rp.<?php echo $rows['obatHarga'];?></h3>
      <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="form-group">
            <div class = 'hide'>
                <?= $form->field($model, 'detailResepQuantity')->textInput() ?>
            </div>
          </div>
        </div>
      </div>  
         <div = hidden>
          <?= $form->field($model, 'obatID')->textInput(['value'=>$obatID]) ?>
          <?= $form->field($model, 'detailResepDosis')->textInput() ?>
          <?= $form->field($model, 'resepID')->textInput(['value'=>$resepID]) ?>
        </div>
         <div class="form-group">
           <?= Html::submitButton('Submit', ['class' => 'btn bg-primary', 'name' => 'contact-button', 'style' => 'color:white']) ?>
         </div>
      </div>
      <div class="space-ten"></div>
     </div>
  </div>
<?php ActiveForm::end(); ?>