<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\Obat;
use yii\db\Query;
use yii\web\Linkable;
use yii\data\Pagination;
use yii\widgets\LinkPager;
use yii\db\ActiveQuery;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ObatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
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
    <div class="list-group">
      <?= Html::a("Obat Ringan",['obat/index','id'=>'Obat Ringan'],['class' =>'list-group-item']) ?>
      <?= Html::a("Obat Keras",['obat/index','id'=>'Obat Keras'],['class' =>'list-group-item']) ?>
    </div>

  </div>
  <!-- /.col-lg-3 -->

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
         $pendaftaranID = 0;
         $resepID=0;
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
              <?php
              $obatID = $rows['obatID'];
              $_SESSION['obatID'] = $obatID
              ?>
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#product_view"><i class="fa fa-search"></i> Quick View</button>
              <p> <?= Html::a('buatOrder', ['detailresep/create'], ['class' => 'btn btn-success']) ?></p>
          </div>
        </div>
      </div>
      <div class="modal fade product_view" id="product_view">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 product_img">
                    <img  src="<?php echo Yii::getAlias('@userImgUrl')."/".$rows['obatFoto'];?>" class="card-img-top">
                    </div>
                    <div class="col-md-6 product_content">
                        <h3 class="modal-title"><?php echo $rows['obatNama'];?></h3><br>
                        <h3><?php echo $rows['obatDeskripsi'];?></h3>
                        <h3 class="cost"><span class="glyphicon glyphicon-usd"></span>Rp.<?php echo $rows['obatHarga'];?></h3>
                        <div class="row">
                        </div>  
                        <div class="space-ten"></div>
                        
                    </div>
                </div>
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
<!-- /.row -->

</div>
<!-- /.container -->
</div>
</html>