<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PendaftaranSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'List Pemeriksaan';
$id = Yii::$app->user->id;
if(isset($_SESSION['resep'])){
    if(isset($_GET['status'])){
        $resepQuery = (new Query())
            ->from('resep')
            ->where(['resepID'=>$_SESSION['resep']]);
        foreach($resepQuery->each() as $resep){
            $hargaResep = $resep['resepTotalHarga'];
        }

        $resepQuery = (new Query())
            ->from('resep')
            ->where(['resepID'=>$_SESSION['resep']]);
        foreach($resepQuery->each() as $resep){
            $hargaResep = $resep['resepTotalHarga'];
        }

        $pemeriksaanQuery = (new Query())
            ->from('pemeriksaan')
            ->where(['pemeriksaanID'=>$_SESSION['pemeriksaan']]);
        foreach($pemeriksaanQuery->each() as $pemeriksaan){
            $jenisQuery = (new Query())
                ->from('jenisperiksa')
                ->where(['jenisPeriksaID'=>$pemeriksaan['jenisPeriksaID']]);
            foreach($jenisQuery->each() as $jenis){
                $hargaPeriksa = $jenis['jenisPeriksaHarga'];
            }
        }

        $code = $password = rand(1,10000);
        $hargaAkhir = $hargaPeriksa + $hargaResep;
        Yii::$app->db->createCommand()->insert('nota', [
            'notaStatus' => 'Belum dibayar',
            'pemeriksaanID' => $_SESSION['pemeriksaan'],
            'resepID' => $_SESSION['resep'],
            'notaTotalHarga' => $hargaAkhir,
            'code' => $code,
        ])->execute();
    }


    unset($_SESSION['pemeriksaan']);
    unset($_SESSION['resep']);
    unset($_SESSION['pendaftaranID']);
}
if(isset($_GET['id'])){
    $date = date('d-m-Y', time() + (24 * 60 * 60));
} else {
    $date = date('d-m-Y');
}

?>
<div class="pendaftaran-index">
    <br>
    <h1><?= Html::encode($this->title) ?></h1>
    <i><?php echo "Tanggal Periksa $date"; ?></i><br>
    <br>
    <div class="row" style="padding-left:10px;">
    <td><?= Html::a('Hari ini', ['pendaftaran/listharian'], ['class' => 'btn bg-info', 'style'=>'color:white']) ?></td>
    <div class="tombol" style="padding-left:10px;">
        <td><?= Html::a('Besok', ['pendaftaran/listharian','id'=>1], ['class' => 'btn bg-primary', 'style'=>'color:white']) ?></td>
    </div>
    </div>
    
    <br>
    <table class="table table-striped">
    <thead class="thead-dark">
        <tr>
        <th scope="col">No</th>
        <th scope="col">Nama Dokter</th>
        <th scope="col">Waktu</th>
        <th scope="col">Status Pemeriksaan</th>
        <th scope="col">Update Pemeriksaan</th>
        </tr>
    </thead>
    <tbody>
    <?php
            $i = 1;
            $jadwalQuery = (new Query())
                ->from('jadwaldokter')
                ->where(['dokterID'=>$id, 
                         'jadwalTanggal' =>$date]);
            foreach($jadwalQuery->each() as $jadwal){
                $pendaftaranQuery = (new Query())
                    ->from('pendaftaran')
                    ->where(['jadwalID'=>$jadwal['jadwalID']]);
                foreach($pendaftaranQuery->each() as $pendaftaran){
                    $userQuery = (new Query())
                        ->from('users')
                        ->where(['userId'=>$pendaftaran['pasienID']]);
                    foreach($userQuery->each() as $user){ ?>
                        <tr>
                            <td><?php echo $i; $i++;?></td>
                            <td><?php echo $user['userNama'];?></td>
                            <td><?php echo $jadwal['jadwalWaktu'];?></td>
                            <td><?php echo $pendaftaran['pendaftaranStatus'];?></td>
                            <?php 
                            $validasiPendaftaran = (new Query())
                                ->select('count(*),pemeriksaanID')
                                ->from('pemeriksaan')
                                ->where(['pendaftranID'=>$pendaftaran['pendaftaranID']]);
                            foreach($validasiPendaftaran->each() as $validasi){ 
                                $banyak = $validasi['count(*)'];
                                $idPemeriksaan = $validasi['pemeriksaanID'];
                            }
                            if($banyak == 0){
                            ?>
                                <td><?= Html::a('Periksa', ['pemeriksaan/create','id'=>$pendaftaran['pendaftaranID']], ['class' => 'btn bg-danger', 'style'=>'color:white']) ?></td>
                            <?php } else { ?>
                                <td><?= Html::a('Update Periksa', ['pemeriksaan/update','id'=>$idPemeriksaan], ['class' => 'btn bg-warning', 'style'=>'color:white']) ?></td>
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
