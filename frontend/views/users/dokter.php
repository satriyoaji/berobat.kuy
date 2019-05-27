<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= Html::a('Semua', ['users/dokter'], ['class' => 'btn btn-success']) ?>
    <?= Html::a('Dokter Mata', ['users/dokter','category'=>'5'], ['class' => 'btn btn-success']) ?>
    <?= Html::a('Dokter Jantung', ['users/dokter','category'=>'6'], ['class' => 'btn btn-success']) ?>
    <?= Html::a('Dokter Kulit', ['users/dokter','category'=>'7'], ['class' => 'btn btn-success']) ?>
    <table class="table table-condensed">
        <tbody>
            <tr>
                <td> Nama Dokter </td>
                <td> Spesialis </td>
            </tr>
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
                
                <tr>
                    <td><?php echo $user['userNama'];?></td>
                    <td><?php echo $pekerjaan['pekerjaanNama'];?></td>
                    <td><?= Html::a('Lihat Jadwal', ['jadwaldokter/index','idDokter'=>$user['userId']], ['class' => 'btn btn-success']) ?></td>
                </tr>
            <?php 
            } ?>    
        </tbody>
    </table> 


</div>
