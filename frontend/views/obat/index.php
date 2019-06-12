<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\Obat;
use frontend\models\Pendaftaran;
use yii\db\Query;
use yii\web\Linkable;
use yii\data\Pagination;
use yii\widgets\LinkPager;
use yii\db\ActiveQuery;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ObatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$pendaftaranID=0;
$resepID=0;
$pendaftaranQuery=(new Query())
  ->select('pendaftaranID')
  ->from('pendaftaran')
  ->where('pasienID = :pasienID', [':pasienID' => Yii::$app->user->getId()]);
  foreach($pendaftaranQuery->each() as $row2){
    $pendaftaranID=$row2['pendaftaranID'];
  }
  $resepQuery=(new Query())
  ->select('resepID')
  ->from('resep')
  ->where('pendaftaranID = :pendaftaranID', [':pendaftaranID' => $pendaftaranID]);
  foreach($resepQuery->each() as $row3){
    $resepID=$row3['resepID'];
  }
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="http://localhost/siklinik/frontend/assets/css/bootstrap.css">
</head>
<div class="obat-index">
<div id="carousel-example-multi" class="carousel slide carousel-multi-item v-2" data-ride="carousel">
<div class="container">
<div class="row">

<div class="col-lg-3">
<br>
<br>
      <div class="kategori" style="backgroud-colour:red">
      <h4>Kategori</h4>
      </div>
      
            <hr>
            <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
            <?= Html::a("Obat Ringan",['obat/index','id'=>'Obat Ringan'],['class' =>'list-group-item']) ?>
               
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
            <?= Html::a("Obat Keras",['obat/index','id'=>'Obat Keras'],['class' =>'list-group-item']) ?>
                
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
            <?php if($resepID==0){?>
              <?= Html::a("Resep Saya", ['detailresep/index','id'=>$resepID], ['class' =>'list-group-item','data' => [
              'confirm' => ' maaf anda belum melakukan pemeriksaan?',
              'method' => 'post',],]) ?>
            <?php } else { ?> 
              <?= Html::a("Resep Saya",['detailresep/index','id'=>$resepID],['class' =>'list-group-item']) ?>
            <?php }  ?>
            </li>
            
            </ul>
        </div>



        <div class="col-lg-9">

<div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner" role="listbox">
    <div class="carousel-item active">
      <img class="d-block img-fluid" src="../../assets/promo1.jpg" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block img-fluid" src="../../assets/promo2.jpg" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block img-fluid" src="../../assets/promo3.jpg" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<div class="row">
 <?php  
     $obatID=0;
     $post=$provider->getModels();
    foreach ($post as $rows) {
  ?>
  
  <div class="col-lg-4 col-md-6 mb-4">
    <div class="card h-100">
      <img  src="<?php echo Yii::getAlias('@userImgUrl')."/".$rows['obatFoto'];?>" class="card-img-top">
      <div class="card-body">
        <h4 class="card-title">
          <center><h5><b><?php echo $rows['obatNama'];?></b></h5>
          <h5> RP. <?php echo $rows['obatHarga'];?></h5>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#<?php echo $rows['obatID']; ?>">detail obat</button>
          <?php if ($pendaftaranID==0){ ?>
            <p><?= Html::a('Buat Order', ['obat/index'], ['class' => 'btn btn-success','data' => [
            'confirm' => ' maaf anda belum melakukan pendaftaran?',
            'method' => 'post',],]) ?></p>
          <?php } else if(!isset($resepID)){?>
            <p><?= Html::a('Buat Order', ['obat/index'], ['class' => 'btn btn-success','data' => [
            'confirm' => ' maaf anda belum melakukan pemeriksaan?',
            'method' => 'post',],]) ?></p>
          <?php } else { ?>
            <p> <?= Html::a('buatOrder', ['detailresep/create','idObat'=>$rows['obatID'],'resepID'=>$resepID], ['class' => 'btn btn-success']) ?></p>
          <?php }  ?>
      </div>
    </div>
  </div>
<!-- Modal -->
<div class="modal fade" id="<?php echo $rows['obatID']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="row">
                <div class="col-md-6 product_img">
                <img  src="<?php echo Yii::getAlias('@userImgUrl')."/".$rows['obatFoto'];?>" class="card-img-top">
                </div>
                <div class="col-sm-6 col-md-5 col-lg-6" product_content">
                    <h3 class="modal-title"><?php echo $rows['obatNama'];?></h3><br>
                    <h3><?php echo $rows['obatDeskripsi'];?></h3>
                    <h3 class="cost"><span class="glyphicon glyphicon-usd"></span>Rp.<?php echo $rows['obatHarga'];?></h3>
                    <div class="row">
                    </div>  
                    <div class="space-ten"></div>            
                </div>
            </div>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php } ?>
</div>
<!-- /.row -->
<center><?php echo LinkPager::widget(['pagination' => $provider->pagination,]); ?> </center>
</div>
<!-- /.col-lg-9 -->


</div>
  <!-- /.col-lg-3 -->

 
</div>
<!-- /.row -->

</div>
<!-- /.container -->
</div>

</html>
