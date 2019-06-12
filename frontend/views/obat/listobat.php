<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PendaftaranSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'List Obat';
$this->params['breadcrumbs'][] = $this->title;
$id = Yii::$app->user->id;

if(!isset($_SESSION['pemeriksaan'])){
    $pemeriksaanQuery = (new Query())
        ->from('pemeriksaan')
        ->where(['pendaftranID'=>$_SESSION['pendaftaranID']]);
    foreach($pemeriksaanQuery->each() as $pemeriksaan){
        $_SESSION['pemeriksaan']=$pemeriksaan['pemeriksaanID'];
    }
}

echo $_SESSION['pemeriksaan'];

if(isset($_SESSION['resep'])){

}else{
    Yii::$app->db->createCommand()->insert('resep', [
        'pendaftaranID' => $_SESSION['pendaftaranID'],
        'resepStatus' => 'Belum Dibuat',
        'resepTanggal' => $date = date('d-m-Y'),
        'resepTotalHarga' => 0,
        'apotekerID' => 19,
    ])->execute();

    $resepQuery = (new Query())
        ->from('resep');
    foreach($resepQuery->each() as $resep){
        $_SESSION['resep']=$resep['resepID'];
    }

}
?>
<div class="pendaftaran-index">

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
            $i = 1;
            $obatQuery = (new Query())
                ->from('obat');
            foreach($obatQuery->each() as $obat){ ?>
                <tr>
                    <td><?php echo $i; $i++;?></td>
                    <td><?php echo $obat['obatNama'];?></td>
                    <td><?php echo $obat['obatGolongan'];?></td>
                    <?php $verifikasiResep = (new Query())
                        ->select('count(*)')
                        ->from('detailResep')
                        ->where(['obatID'=>$obat['obatID'],'resepID'=>$_SESSION['resep']]);
                    foreach($verifikasiResep->each() as $data){
                        $verifikasi = $data['count(*)']; 
                    }?>
                        
                    <?php
                    if($verifikasi>0){ ?>
                        <td><?= Html::a('Tambahkan', ['obat/listobat'], ['class' => 'btn btn-success','data' => [
                            'confirm' => ' maaf anda sudah menambahkan obat ini',
                            'method' => 'post',],]) ?></td>
                    <?php } else { ?>
                        <td><?= Html::a('Tambahkan', ['detailresep/create','id'=>$obat['obatID']], ['class' => 'btn btn-success']) ?></td>
                    <?php } ?>    
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <td><?= Html::a('Kembali', ['pemeriksaan/update','id'=>$_SESSION['pemeriksaan']], ['class' => 'btn btn-success']) ?></td>
</div>
