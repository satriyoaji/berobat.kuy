<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\JadwaldokterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jadwaldokters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jadwaldokter-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row row-centered" style="padding-top: 10%; padding-bottom: 10%;">
    <table class="table table-condensed">
        <tbody>
            <tr>
                <td> Tanggal Periksa </td>
                <td> Kuota Periksa </td>
                <td> Ruangan Periksa </td>
                <td> Waktu Periksa </td>
                <td> </td>
            </tr>
            <?php
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
                            <td><?php echo $jadwal['jadwalTanggal'];?></td>
                            <td><?php echo $sisa;?></td>
                            <td><?php echo $jadwal['jadwalRuangan'];?></td>
                            <td><?php echo $jadwal['jadwalWaktu'];?></td>
                            <?php if (Yii::$app->user->isGuest){ ?>
                                <td><?= Html::a('Booking', ['site/login'], ['class' => 'btn btn-success']) ?></td>
                            <?php } else { ?>
                                <td><?= Html::a('Booking', ['pendaftaran/create','id'=>$jadwal['jadwalID']], ['class' => 'btn btn-success']) ?></td>
                            <?php } ?>
                        </tr> 
                    <?php } ?>
            <?php } 
        } ?>    
        </tbody>
    </table>



</div>
