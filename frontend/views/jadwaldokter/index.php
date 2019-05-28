<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\JadwaldokterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jadwal Dokter';
?>
<div class="jadwaldokter-index">

    <br>
    <div class="col-md-6">
    <h1>Jadwal Dokter</h1>
    <hr>
    </div>
    <div class="detailDokter" style="padding-left:12px;">
    <h4><b>Nama Dokter</b></h4>
    <div class="alert alert-primary col-md-4" role="alert">
      <i>Spesialis Dokter</i>
    </div>
    </div>

    <div class="jadwal" style="padding-left:12px;">
    <table class="table table-striped">
    <thead>
        <tr>
        <th scope="col">No</th>
        <th scope="col">Tanggal</th>
        <th scope="col">Ruangan</th>
        <th scope="col">Waktu</th>
        <th scope="col">Kuota</th>
        <th scope="col">Booking</th>
        </tr>
    </thead>
    <tbody>
    <?php
            $i=1;
            $id = $_GET['idDokter'];
            $dataUser = (new Query())
                ->select('*')
                ->from('jadwaldokter')
                ->where(['dokterid'=>$id]);
            foreach($dataUser->each() as $jadwal){
                $dataPendaftaran = (new Query())
                    ->select('count(*)')
                    ->from('pendaftaran')
                    ->where(['jadwalID'=>$jadwal['jadwalID']]);
                foreach($dataPendaftaran->each() as $pendaftaran){
                    $sisa = $jadwal['jadwalKuota']-$pendaftaran['count(*)'];
                    if($sisa == 0){ ?>

                    <?php 
                    } else { ?>
        <tr>
        <th scope="row"><?php echo $i; $i++; ?></th>
        <td><?php echo $jadwal['jadwalTanggal'];?></td>
        <td><?php echo $jadwal['jadwalRuangan'];?></td>
        <td><?php echo $jadwal['jadwalWaktu'];?></td>
        <td><?php echo $sisa;?></td>
        <?php if (Yii::$app->user->isGuest){ ?>
            <td><?= Html::a('Booking', ['site/login'], ['class' => 'btn btn-success']) ?></td>
         <?php } else { ?>
            <td><?= Html::a('Booking', ['pendaftaran/create','id'=>$jadwal['jadwalID']], ['class' => 'btn btn-success']) ?></td>
        <?php } ?>
        </tr>
        <?php } ?>
            <?php } 
        }  ?>    
    </tbody>
    </table>
    </div>
