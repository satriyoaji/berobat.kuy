<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\db\Query;
use backend\models\Obat;
use frontend\models\Resep;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ResepSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Resep';
$this->params['breadcrumbs'][] = $this->title;
$i=1;
$userQuery=(new Query())
 ->select('userPekerjaan,userId')
 ->from('users')
 ->where('userId = :userId', [':userId' => Yii::$app->user->getId()]);
foreach($userQuery->each() as $row4){  
    $login=$row4['userPekerjaan'];
    $userId=$row4['userId'];
}
$post=$provider->getModels();
  
?>
<div>
<?php  if ($login == 3) {?>
<div class="row">
  <br><br>
  <div class="col-4">
    <div class="list-group" id="list-tab" role="tablist">
      <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Home</a>
      <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">List Resep</a>
      <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">List Obat</a>
      <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">Verifikasi Resep</a>
    </div>
  </div>
  <div class="col-8">
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
        <h4> Selamat datang apoteker <?php echo Yii::$app->user->identity->username ?> </h4>
      </div>
      
      <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
      <table class="table">
        <thead class="thead-dark">
        <tr>
        <th scope="col">No</th>
        <th scope="col">ID Resep</th>
        <th scope="col">Status</th>
        <th scope="col">Detail</th>
        </tr>
        </thead>
        <?php foreach ($post as $row) {  ?>
        <tbody>
        <td><?php echo $i;$i++;?></td>
        <td><?php echo $row['resepID'];?></td>
        <td><?php echo $row['resepStatus'];?></td>
        <td> <?= Html::a('Detail', ['detailresep/index','id'=>$row['resepID']], ['class' => 'btn btn-success']) ?></td>
        </tbody>
        <?php } ?>
        </table>
      </div>
      <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
      <?= Html::a('create', ['obat/create'], ['class' => 'btn btn-success']) ?>
      <table class="table">
        <thead class="thead-dark">
        <tr>
        <th scope="col">No</th>
        <th scope="col">ID Obat</th>
        <th scope="col">Nama Obat</th>
        <th scope="col">Obat Harga</th>
        <th scope="col">Obat Golongan</th>
        <th scope="col">Obat Deskripsi</th>
        <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?php 
        $i=1;
        $obatQuery = Obat::find()->all();
        foreach ($obatQuery as $rows) { ?>
        <td><?php echo $i;$i++;?></td>
        <td><?php echo $rows['obatID'];?></td>
        <td><?php echo $rows['obatNama'];?></td>
        <td><?php echo $rows['obatHarga'];?></td>
        <td><?php echo $rows['obatGolongan'];?></td>
        <td><?php echo $rows['obatDeskripsi'];?></td>
        <td> 
             <?= Html::a('update', ['obat/update','id'=>$rows['obatID']], ['class' => 'btn btn-success']) ?>
             <?= Html::a('Delete', ['delete', 'id'=>$rows['obatID']], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        </td>
        </tbody>
        <?php } ?>
        </table>
      </div>
      <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
         <?php
         $y=1;
         $resepQuery = Resep::find();
         $resepQuery->andFilterWhere(['LIKE','apotekerID',0]);
         foreach($resepQuery->each() as $roww){ ?>
          <table class="table">
        <thead class="thead-dark">
        <tr>
        <th scope="col">No</th>
        <th scope="col">ID Resep</th>
        <th scope="col">ID Apoteker</th>
        <th scope="col">Verifikasi</th>
        </tr>
        </thead>
        <tbody>
        <td><?php echo $y;$y++;?></td>
        <td><?php echo $roww['resepID'];?></td>
        <td><?php echo $roww['apotekerID'];?></td>
        <td> <?= Html::a('Verifikasi', ['uptodate','id'=>$row['resepID'],'apotekerID'=>$userId], ['class' => 'btn btn-success']) ?></td>
        </tbody>
        <?php } ?>
        </table>
      </div>
    </div>
  </div>
</div>

<script>
  $(function () {
    $('#myTab li:last-child a').tab('show')
  })
</script>
<?php } ?>
</div>

  

