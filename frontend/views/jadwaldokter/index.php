<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\db\Query;

$id = $_GET['idDokter'];

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
    <?php
    $dataUser = (new Query())
        ->select('*')
        ->from('users')
        ->where(['userId'=>$id]);
    foreach($dataUser->each() as $user){ ?>
        <div class="detailDokter" style="padding-left:12px;">
        <h4><b><?php echo $user['userNama']; ?></b></h4>
        <?php $pekerjaan = $user['userPekerjaan'];?>
        <?php
        $dataPekerjaan = (new Query())
            ->select('*')
            ->from('pekerjaan')
            ->where(['pekerjaanID'=>$user['userPekerjaan']]);
        foreach($dataPekerjaan->each() as $pekerjaan){ ?>
            <div class="alert alert-primary col-md-4" role="alert">
            <i><?php echo $pekerjaan['pekerjaanNama']; ?></i>
            </div>
        <?php } ?>
        </div>
    <?php } ?>

    <div class="jadwal" style="padding-left:12px;">
    <table class="table table-striped">
    <thead>
        <tr>
        <th scope="col">No</th>
        <th scope="col">Tanggal</th>
        <th scope="col">Ruangan</th>
        <th scope="col">Waktu</th>
        <th scope="col">Kuota</th>
        <?php if ($pekerjaan < 4){ ?>
        <th scope="col">Booking</th>
        <?php } ?>
        </tr>
    </thead>
    <tbody>
    <?php
        $i=1;     
        $dataJadwal = (new Query())
            ->select('*')
            ->from('jadwaldokter')
            ->where(['dokterid'=>$id]);
        foreach($dataJadwal->each() as $jadwal){
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
                    <?php $verifikasiPendaftaran = (new Query())
                        ->select('count(*)')
                        ->from('pendaftaran')
                        ->where(['jadwalID'=>$jadwal['jadwalID'],
                                 'pasienID'=>Yii::$app->user->id]);
                    foreach($verifikasiPendaftaran->each() as $data){
                        $verifikasi = $data['count(*)']; 
                    }?>
                        
                    <?php
                    if($verifikasi>0){ ?>
                        <td><?= Html::a('Booking', ['jadwaldokter/index','idDokter'=>$id], ['class' => 'btn btn-success','data' => [
                            'confirm' => ' maaf anda sudah terdaftar pada jadwal yang sama',
                            'method' => 'post',],]) ?></td>
                    <?php } else if (Yii::$app->user->isGuest){ ?>
                        <td><?= Html::a('Booking', ['site/login'], ['class' => 'btn btn-success']) ?></td>
                    <?php } else if ($pekerjaan > 4){ ?>
                         <td><?= Html::a('Booking', ['pendaftaran/create','id'=>$jadwal['jadwalID']], ['class' => 'btn btn-success']) ?></td>
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

    <br>
    <br>
