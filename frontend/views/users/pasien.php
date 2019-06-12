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
        <div class="col-md-9">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Pasien</th>
                <th scope="col">Detail Pasien</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <?php
                $i = 0;
                $dataUser = (new Query())
                    ->select('*')
                    ->from('users')
                    ->where('userPekerjaan = 1 ');
                foreach($dataUser->each() as $user){ 

                ?>
                <td><?php echo $i; $i++;?></td>
                <td><?php echo $user['userNama'];?></td>
                <td><?= Html::a('Lihat Jadwal', ['pendaftaran/listriwayat','id'=>$user['userId']], ['class' => 'btn btn-success']) ?></td>
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
