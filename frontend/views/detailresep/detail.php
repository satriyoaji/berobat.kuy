<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\db\Query;
use frontend\models\Obat;
   $resepID =0;
   $query4 = Obat::find();
   $query4->andFilterWhere(['like','obatID', $_SESSION['id']]);
   foreach($query4->each() as $rows){
?>
  <?php $form = ActiveForm::begin(); ?>
 <div class="row">
     <div class="col-md-6 product_img">
        <img  src="<?php echo Yii::getAlias('@userImgUrl')."/".$rows['obatFoto'];?>" class="card-img-top">
               </div>
                    <div class="col-md-6 product_content">
                        <h3 class="modal-title"><?php echo $rows['obatNama'];?></h3><br>
                        <p>obat batuk dan pilek yang terbuat dari herbal alami yang kasiat menyembuhka batuk dan flu</p>
                        <h3 class="cost"><span class="glyphicon glyphicon-usd"></span>Rp.<?php echo $rows['obatHarga'];?></h3>
                        <div class="row">
                            <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                            <div class="hide">
                            <?= $form->field($model, 'detailResepQuantity')->textInput() ?>
                            </div>
                           </div>
                            </div>
                            <!-- end col -->
                        </div>  
                        <?php
                          $query = (new Query())
                          ->select('pendaftaranID')
                          ->from('pendaftaran')
                          ->where('pasienID = :pasienID', [':pasienID' => Yii::$app->user->identity->username]);
                          $pendaftaranID = $query;
                           $query2 = (new Query())
                           ->select('resepID')
                           ->from('resep')
                           ->where('pendaftaranID = :pendaftaranID', [':pendaftaranID' => $pendaftaranID]);
                            foreach($query->each() as $row){
                               $resepID = $row['pendaftaranID'];
                            }
                            $_SESSION['status']=$pendaftaranID;    
                        ?>  
                         <div class="form-group">
                          <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                         </div>

                        </div>
                        <div class="space-ten"></div>
                        
                    </div>
                </div>
    
<?php } ?>
<?php ActiveForm::end(); ?>