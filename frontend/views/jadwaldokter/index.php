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
    <?= Html::a('Semua', ['jadwaldokter/index'], ['class' => 'btn btn-success']) ?>
    <?= Html::a('Dokter Mata', ['jadwaldokter/index','category'=>'5'], ['class' => 'btn btn-success']) ?>
    <?= Html::a('Dokter Jantung', ['jadwaldokter/index','category'=>'6'], ['class' => 'btn btn-success']) ?>
    <?= Html::a('Dokter Kulit', ['jadwaldokter/index','category'=>'7'], ['class' => 'btn btn-success']) ?>
    <table class="table table-condensed">
        <tbody>
            <?php
            $id = $_GET['idDokter'];
            $dataUser = (new Query())
                ->select('*')
                ->from('jadwaldokter')
                ->where(['dokterid'=>$id]);
            foreach($dataUser->each() as $user){
                $dataJadwal = (new Query())
                    ->select('*')
                    ->from('jadwaldokter')
                    ->where(['dokterID'=>$user['userId']]); 
                foreach($dataJadwal->each() as $jadwal){?>
                <tr>
                    <td><?php echo $user['userNama'];?></td>
                    <td><?php echo $jadwal['jadwalKuota'];?></td>
                    <td><?php echo $jadwal['jadwalRuangan'];?></td>
                    <td><?php echo $jadwal['jadwalWaktu'];?></td>
                    <td><?= Html::a('Booking', ['pendaftaran/create','idDokter'=>$jadwal['dokterID']], ['class' => 'btn btn-success']) ?></td>
                </tr>
            <?php }
            } ?>    
        </tbody>
    </table>



</div>
