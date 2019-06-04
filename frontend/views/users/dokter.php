<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jadwal Dokter';
?>
<div class="users-index">
    <br>
    <h1>List Dokter</h1>
    <hr>
    <br>
    <div class="row">
        <div class="col-md-3">
            <h4>Kategori</h4>
            <hr>
            <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <?= Html::a('Semua', ['users/dokter'], ['class' => 'btn btn-success', 'style' => 'color:#006d55']) ?>
                <?php
                $jumlahUser = (new Query())
                    ->select('count(*)')
                    ->from('users')
                    ->where('userPekerjaan >=5 ');
                foreach($jumlahUser->each() as $user)
                ?>
                <span class="badge badge-primary badge-pill"><?php echo $user['count(*)']; ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <?= Html::a('Dokter Mata', ['users/dokter','category'=>'5'], ['class' => 'btn btn-success', 'style' => 'color:#006d55']) ?>
                <?php
                $jumlahUser = (new Query())
                    ->select('count(*)')
                    ->from('users')
                    ->where('userPekerjaan =5 ');
                foreach($jumlahUser->each() as $user)
                ?>
                <span class="badge badge-primary badge-pill"><?php echo $user['count(*)']; ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
            <?= Html::a('Dokter Jantung', ['users/dokter','category'=>'6'], ['class' => 'btn btn-success', 'style' => 'color:#006d55']) ?>
            <?php
                $jumlahUser = (new Query())
                    ->select('count(*)')
                    ->from('users')
                    ->where('userPekerjaan = 6 ');
                foreach($jumlahUser->each() as $user)
                ?>
                <span class="badge badge-primary badge-pill"><?php echo $user['count(*)']; ?></span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
            <?= Html::a('Dokter Kulit', ['users/dokter','category'=>'7'], ['class' => 'btn btn-success', 'style' => 'color:#006d55']) ?>
            <?php
                $jumlahUser = (new Query())
                    ->select('count(*)')
                    ->from('users')
                    ->where('userPekerjaan =7 ');
                foreach($jumlahUser->each() as $user)
                ?>
                <span class="badge badge-primary badge-pill"><?php echo $user['count(*)']; ?></span>
            </li>
            </ul>
        </div>
        <div class="col-md-9">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                <th scope="col">Nama</th>
                <th scope="col">Spesialis</th>
                <th scope="col">Lihat Jadwal</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <?php
            if(isset($_GET['category'])){
                $id = $_GET['category'];
                $dataUser = (new Query())
                    ->select('*')
                    ->from('users')
                    ->where('userPekerjaan = :id',  ['id'=>$id]);
            }
            else {
                $dataUser = (new Query())
                    ->select('*')
                    ->from('users')
                    ->where('userPekerjaan >=5 ');
            }
            foreach($dataUser->each() as $user){ 
                $jenisPekerjaan = (new Query())
                    ->select('*')
                    ->from('pekerjaan')
                    ->where(['pekerjaanID'=>$user['userPekerjaan']]);
                foreach($jenisPekerjaan->each() as $pekerjaan)
                ?>
                
                <td><?php echo $user['userNama'];?></td>
                <td><?php echo $pekerjaan['pekerjaanNama'];?></td>
                <td><?= Html::a('Lihat Jadwal', ['jadwaldokter/index','idDokter'=>$user['userId']], ['class' => 'btn btn-success']) ?></td>
                </tr>
                <?php 
            } ?> 
            </tbody>
            </table>
        </div>
    </div>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <br>
    <br>
    <br>
    


</div>
