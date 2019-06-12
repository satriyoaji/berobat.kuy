<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\NotaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Notas';
$this->params['breadcrumbs'][] = $this->title;

$id = $_GET['id'];
?>
<div class="nota-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <table class="table table-condensed">
        <tbody>
            <tr>
                <td> No </td>
                <td> Nama Obat </td>
                <td> Golongan Obat </td>
                <td> Status Pemeriksaan </td>
            </tr>
    <?php
    $i=1;
    $pendaftaranQuery = (new Query())
        ->from('pendaftaran')
        ->where(['pasienID'=>$id]);
    foreach($pendaftaranQuery->each() as $pendaftaran){
        $status=0;
        $pemeriksaanQuery = (new Query())
            ->from('pemeriksaan')
            ->where(['pendaftranID'=>$pendaftaran['pendaftaranID']]);
        foreach($pemeriksaanQuery->each() as $pemeriksaan){
            $cekNotaPemeriksaan = (new Query())
                ->from('nota')
                ->where(['pemeriksaanID'=>$pemeriksaan['pemeriksaanID']]);
            foreach($cekNotaPemeriksaan->each() as $nota){ ?>
                <tr>
                    <td><?php echo $i; $i++;?></td>
                    <td><?php echo $nota['notaStatus'];?></td>
                    <td><?php echo $nota['notaTotalHarga'];?></td>
                    <td><?php echo $nota['code'];?></td>
                    <td><?= Html::a('Detail Pembayaran', ['view','id'=>$nota['notaID']], ['class' => 'btn btn-success']) ?></td>
                </tr>
            <?php 
            $status = 1;
            }
        }
        if($status == 0){
        $resepQuery = (new Query())
            ->from('resep')
            ->where(['pendaftaranID'=>$pendaftaran['pendaftaranID']]);
        foreach($resepQuery->each() as $resep){
            $cekNotaResep = (new Query())
                ->from('nota')
                ->where(['resepID'=>$resep['resepID']]);
            foreach($cekNotaResep->each() as $cekNota2){ ?>
                <tr>
                    <td><?php echo $i; $i++;?></td>
                    <td><?php echo $nota['notaStatus'];?></td>
                    <td><?php echo $nota['notaTotalHarga'];?></td>
                    <td><?php echo $nota['code'];?></td>
                    <td><?= Html::a('Detail Pembayaran', ['view','id'=>$nota['notaID']], ['class' => 'btn btn-success']) ?></td>
                </tr>
            <?php }}
            
        }
    } ?>
      
        </tbody>
    </table>
</div>
