<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $model frontend\models\Pemeriksaan */

//$this->title = $model->pemeriksaanID;
$this->params['breadcrumbs'][] = ['label' => 'Pemeriksaans', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;


$id=$_GET['id'];
?>
<div class="pemeriksaan-view">

    
    <table class="table table-striped">
        <tbody>
        <?php 
            $pemeriksaanQuery = (new Query())
                ->from('pemeriksaan')
                ->where(['pendaftranID'=>$id]);
            foreach($pemeriksaanQuery->each() as $pemeriksaan){ ?>
            <tr>
                <td> Hasil Pemeriksaan : </td>
                <td> <?php echo $pemeriksaan['pemeriksaanHasil']?> </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    

    <table class="table table-striped">
    <thead>
        <tr>
        <th scope="col">No</th>
        <th scope="col">Nama Obat</th>
        <th scope="col">Banyak Obat</th>
        <th scope="col">Dosis</th>
        <th scope="col">Keterangan</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $resepValidasi = (new Query())
            ->select('count(*)')
            ->from('resep')
            ->where(['pendaftaranID'=>$id]);
        foreach($resepValidasi->each() as $validasi){
            $banyak = $validasi['count(*)'];
        }
        if($banyak==0){ ?>
        <tr>
            <th colspan="5"><center> Tidak Ada Resep Obat </center></th>
        </tr>
        <?php } else {
            $i=1;
            $resepQuery = (new Query())
                ->from('resep')
                ->where(['pendaftaranID'=>$id]);
            foreach($resepQuery->each() as $resep){
                $detailresepQuery = (new Query())
                    ->from('detailresep')
                    ->where(['resepID'=>$resep['resepID']]);
                foreach($detailresepQuery->each() as $detailresep){
                    $obatQuery = (new Query())
                        ->from('obat')
                        ->where(['obatID'=>$detailresep['obatID']]);
                    foreach($obatQuery->each() as $obat){?>
                    <tr>
                        <th><?php echo $i; $i++; ?></th>
                        <th><?php echo $obat['obatNama'] ?></th>
                        <th><?php echo $detailresep['detailResepQuantity'] ?></th>
                        <th><?php echo $detailresep['detailResepDosis'] ?></th>
                        <th><?php echo $obat['obatGolongan'] ?></th>
                    </tr>
                    <?php }
                    }
                }
            }?>

    </tbody>
    </table>
</div>
