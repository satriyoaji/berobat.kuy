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
            ?>  
                <tr>
                    <td><?php echo $jadwal['jadwalTanggal'];?></td>
                    <td><?php echo $jadwal['jadwalKuota'];?></td>
                    <td><?php echo $jadwal['jadwalRuangan'];?></td>
                    <td><?php echo $jadwal['jadwalWaktu'];?></td>
                    <td><?= Html::a('Booking', ['pendaftaran/create','id'=>$jadwal['jadwalID']], ['class' => 'btn btn-success']) ?></td>
                </tr>
            <?php } ?>    
        </tbody>
    </table>



</div>
