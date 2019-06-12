<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\DetailresepSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<?php
  $total=0; 
  $i =1;
  $resepID=$_GET['id'];
  $resepQuery=(new Query())
  ->select('resepID,resepTanggal')
  ->from('resep')
  ->where('resepID = :resepID', [':resepID' => $resepID]);
  foreach($resepQuery->each() as $row3){ 
   $resepID=$row3['resepID'];
   $resepTanggal =$row3['resepTanggal'];
  }                     
?>
<div>
  <br><h3>Resep</h3>
  <h7> ID Resep : <?php echo $resepID;?></h7><br>
  <h7> Date : <?php echo $resepTanggal;?></h7><br>
  <h7> Name : <?php echo Yii::$app->user->identity->username ?></h7>
</div>
<div class="detailresep-index">
  <table class="table">
  <thead class="thead-dark">
  <tr>
   <th scope="col">No</th>
   <th scope="col">Nama Obat</th>
   <th scope="col">Jumlah</th>
   <th scope="col">Harga</th>
  </tr>
  </thead>
    <tbody>
     <?php 
        $post=$provider->getModels();
        foreach ($post as $row1) { 
      ?>
       <td><?php echo $i;$i++?></td>
      <?php 
        $obatQuery=(new Query())
        ->select('obatNama,obatHarga')
        ->from('obat')
        ->where('obatID = :obatID', [':obatID' => $row1['obatID']]);
        foreach($obatQuery->each() as $row2){ ?>
          <td><?php echo $row2['obatNama'];?></td>
          <td><?php echo $row1['detailResepQuantity'];?></td>
          <?php $subTotal = $row1['detailResepSubtotal']?>
          <td><?php echo $row1['detailResepSubtotal'] ;?></td>
          <?php $total +=$subTotal;?>
         <?php } ?>
      </tbody>
      <?php } ?>
     <thead class="">
        <tr>
        <th scope="col"></th>
        <th scope="col"></th> 
        <th scope="col">TOTAL</th>
        <th scope="col"><?php echo $total;?></th>
        </tr>
      </thead>
    </table> 
</div>
