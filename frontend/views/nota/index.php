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
            ->where(['pasienID'=>$id])
            ->all();
        //var_dump($pendaftaranQuery);
        foreach($pendaftaranQuery as $pendaftaran){
            $status=0;
            $pemeriksaanQuery = (new Query())       // 1 Pemeriksaan pasti hanya dari 1 pendaftaranID
                ->from('pemeriksaan')
                ->where(['pendaftranID'=>$pendaftaran['pendaftaranID']])
                ->all();
            foreach($pemeriksaanQuery as $pemeriksaan){
                //untuk nota pembayaran pemeriksaan
                $cekNotaPemeriksaan = (new Query())
                    ->from('nota')
                    ->where(['pemeriksaanID'=>$pemeriksaan['pemeriksaanID']])
                    ->all();
                foreach($cekNotaPemeriksaan as $nota){ ?>
                    <tr>
                        <td><?php echo $i; $i++;?></td>
                        <td><?= $nota['notaStatus'];?></td>
                        <td>Rp. <?= $nota['notaTotalHarga'];?></td>
                        <td><?= $nota['code'];?></td>
                        <td><?= Html::a('Detail Pembayaran', ['view','id'=>$nota['notaID']], ['class' => 'btn btn-success']) ?></td>
                    </tr>
                <?php 
                $status = 1;
                }
            }
                //untuk nota pembayaran resep
            $resepQuery = (new Query())
                ->from('resep')
                ->where(['pendaftaranID'=>$pendaftaran['pendaftaranID']])
                ->all();
                foreach($resepQuery as $resep){
                    $cekNotaResep = (new Query())
                        ->from('nota')
                        ->where(['resepID'=>$resep['resepID']])
                        ->all();
                    foreach($cekNotaResep as $cekNota2){ ?>
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
        ?>
    </tbody>
    </table>
</div>
