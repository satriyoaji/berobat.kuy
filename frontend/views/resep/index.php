<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\db\Query;
use backend\models\Obat;
use frontend\models\Resep;
use phpDocumentor\Reflection\Types\Null_;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ResepSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Resep';
$this->params['breadcrumbs'][] = $this->title;
$i=1;
$userQuery=(new Query())
 ->from('users')
 ->where('userId = :userId', [':userId' => Yii::$app->user->getId()]);
foreach($userQuery->each() as $row4){  
    $login=$row4['userPekerjaan'];
    $userId=$row4['userId'];
    $email = $row4['userEmail'];
    $telephon = $row4['userTelephone']; 
    $alamat =  $row4['userAlamat']; 
    
}
if (isset($_GET['id']))
{
  $id = $_GET['id'];
  Yii::$app->db->createCommand()->update('resep', ['apotekerID' => Yii::$app->user->getId(),'resepStatus' => 'Sudah dibuat' ], ['resepID' =>  $id])->execute();
}
?>
<div>
<?php  if ($login == 3) {?>
  <div class="jumbotron text-center" style="margin-bottom:0">
  <h1>Welcome to the Pharmacist's Menu</h1>
  <p>All Pharmaceutical Services are Available Here !</p>
</div>
<br><br>
<div class="row">
  <br><br>
  <div class="col-4">
    <div class="list-group" id="list-tab" role="tablist">
      <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Home</a>
      <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">List Resep</a>
      <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">List Obat</a>
      
    </div>
  </div>
  <div class="col-8">
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
      <div class="modal-body">
        <center>
         <img src="../../assets/icon/nurse.png" name="aboutme" width="140" height="140" border="0" class="img-circle"></a>
        <h3 class="media-heading"><?php echo Yii::$app->user->identity->username; ?></h3>
        </center>
        <hr>
        <p class="text-left"><strong>Bio: </strong><br></p>
         <p> Memberikan sarana pada profesional kesehatan bagaimana pemilian dan penggunaan obat yang tepat</p>
         <p> memberikan informasi mengenai efek samping dari obat</p>
         <p>memastikan bahwa obat aman untuk dikonsumsi oleh pasien baik secara terpisah atau bersamaan dengan objeck lain</p>
        <br>
        </div>
      </div>
      <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list"> 
      <table class="table text-center">
        <thead class="thead-dark">
        <tr>
        <th scope="col">No</th>
        <th scope="col">ID Resep</th>
        <th scope="col">Detail</th>
        <th scope="col">Verifikasi</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $post = Resep::find()->all();
         foreach ($post as $row) { 
          ?>
            <td><?php echo $i;$i++;?></td>
            <td><?php echo $row['resepID'];?></td>
            <td> <?= Html::a('Look detail', ['detailresep/index','id'=>$row['resepID']], ['class' => 'btn btn-success']) ?></td>

            <?php
            $apotekerQuery=(new Query())
                ->from('users')
                ->where('userId = :apotekerId', [':apotekerId' => $row['apotekerID']])
                ->one();
            $namaApoteker = $apotekerQuery['userNama'];
            ?>
            <?php if($row['resepStatus'] == 'Sudah Dibuat'){?>
                <td>Sudah Diverifikasi oleh <p class="text-info"><?= $namaApoteker ?></p></td>
            <?php } else { //'Belum DIbuat' ?>
              <td> <?= Html::a('Verifikasi', ['resep/verificate','id'=>$row['resepID']], ['class' => 'btn btn-danger', 'style' => 'color:white', 'data' => [
                      'confirm' => ' Benar Ingin memverifikasi resep ini?  Resep yang telah diverif tidak akan bisa dikembalikan']]) ?></td>
            <?php }  ?>
            </tbody>
        <?php 
        } ?>
        </table>
      </div>
      <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
      <?= Html::a('create', ['obat/create'], ['class' => 'btn btn-success', 'style' => 'color:white']) ?>
      <table class="table text-center">
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
      
  </div>
</div>

<script>
  $(function () {
    $('#myTab li:last-child a').tab('show')
  })
</script>
<?php } ?>
</div>

  

