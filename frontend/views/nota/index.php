<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\NotaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Riwayat Pembayaran';

$id = $_GET['id'];
?>
<br>
<div class="nota-index">


    <h1><?= Html::encode($this->title) ?></h1>
    <hr>
    <br>
    <table class="table text-center">
    <thead class="thead-dark">
    <tr>
    <th scope="col">No</th>
    <th scope="col">Status Transaksi</th>
    <th scope="col">Total Pembayaran</th>
    <th scope="col">Kode Transaksi</th>
    <th scope="col">Detail</th>
    </tr>
    </thead>
    <tbody>
        <?php
        $i=1;
        $pendaftaranQuery = (new Query())
            ->from('pendaftaran')
            ->where(['pasienID'=>$id]);
        foreach($pendaftaranQuery->each() as $pendaftaran){
            $status=0;
            $pemeriksaanQuery = (new Query())       // 1 Pemeriksaan pasti hanya dari 1 pendaftaranID
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
                            <td><?php echo $cekNota2['notaStatus'];?></td>
                            <td>Rp. <?php echo $cekNota2['notaTotalHarga'];?></td>
                            <td><?php echo $cekNota2['code'];?></td>
                            <td><?= Html::a('Detail Pembayaran', ['view','id'=>$cekNota2['notaID']], ['class' => 'btn btn-success']) ?></td>
                        </tr>
                    <?php
                    }
                }
            }
        }
        ?>
    </tbody>
    </table>
</div>
