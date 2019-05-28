<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PendaftaranSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pendaftarans';
$this->params['breadcrumbs'][] = $this->title;
$id = Yii::$app->user->id;
?>
<div class="pendaftaran-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <table class="table table-condensed">
        <tbody>
            <tr>
                <td> No </td>
                <td> Nama Dokter </td>
                <td> Tanggal Periksa </td>
                <td> Status Pemeriksaan </td>
            </tr>
            <?php
            $i = 1;
            $pendaftaranQuery = (new Query())
                ->from('pendaftaran')
                ->where(['pasienID'=>$id]);
            foreach($pendaftaranQuery->each() as $pendaftaran){
                $jadwalQuery = (new Query())
                    ->from('jadwalDokter')
                    ->where(['jadwalID'=>$pendaftaran['jadwalID']]);
                foreach($jadwalQuery->each() as $jadwal){
                    $userQuery = (new Query())
                        ->from('users')
                        ->where(['userId'=>$jadwal['dokterID']]);
                    foreach($userQuery->each() as $user){ ?>
                        <tr>
                            <td><?php echo $i; $i++;?></td>
                            <td><?php echo $_SESSION['userType'];?></td>
                            <td><?php echo $pendaftaran['pendaftaranTanggal'];?></td>
                            <td><?php echo $pendaftaran['pendaftaranStatus'];?></td>
                        </tr>
                <?php }
                }
            } ?>
        </tbody>
    </table>

    


</div>
