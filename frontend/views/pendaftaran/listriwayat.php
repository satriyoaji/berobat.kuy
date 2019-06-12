<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PendaftaranSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'List Check Up';

$id = $_GET['id'];
?>
<div class="pendaftaran-index">
    <br>
    <h1><?= Html::encode($this->title) ?></h1>
    <br>
    <table class="table table-condensed">
        <thead class="thead-dark text-center">
                <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Dokter</th>
                <th scope="col">Tanggal Periksa</th>
                <th scope="col">Waktu</th>
                <th scope="col">Detail Periksa</th>
                
                </tr>
        </thead>
        <tbody class="text-center">
            <?php
            $i = 1;
            $pendaftaranQuery = (new Query())
                ->from('pendaftaran')
                ->where(['pasienID'=>$id]);
            foreach($pendaftaranQuery->each() as $pendaftaran){
                $jadwalQuery = (new Query())
                    ->from('jadwaldokter')
                    ->where(['jadwalID'=>$pendaftaran['jadwalID']]);
                foreach($jadwalQuery->each() as $jadwal){
                    $userQuery = (new Query())
                        ->from('users')
                        ->where(['userId'=>$jadwal['dokterID']]);
                    foreach($userQuery->each() as $user){ ?>
                        <tr>
                            <td><?php echo $i; $i++;?></td>
                            <td><?php echo $user['userNama'];?></td>
                            <td><?php echo $jadwal['jadwalTanggal'];?></td>
                            <td><?php echo $jadwal['jadwalWaktu'];?></td>
                            <?php if($pendaftaran['pendaftaranStatus'] == 'Sudah Diperiksa'){ ?> 
                                <td><?= Html::a($pendaftaran['pendaftaranStatus'], ['pemeriksaan/view','id'=>$pendaftaran['pendaftaranID']], ['class' => 'btn btn-success', 'style' => 'color:#006d55']) ?></td>
                            <?php } else { ?>
                                <td><?= Html::a($pendaftaran['pendaftaranStatus'], ['pendaftaran/index','id'=>$id], ['class' => 'btn btn-success', 'style' => 'color:#006d55']) ?></td></td>
                            <?php } ?>
                            
                        </tr>
                <?php }
                }
            } ?>
        </tbody>
    </table>

    


</div>
<br>
<br>
<br>