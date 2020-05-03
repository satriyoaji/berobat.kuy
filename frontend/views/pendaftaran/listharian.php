<?php
date_default_timezone_set('Asia/Jakarta');

use yii\helpers\Html;
use yii\grid\GridView;
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PendaftaranSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'List Pemeriksaan';
$id = Yii::$app->user->id;

if(isset($_SESSION['resep'])){ //jika menerima resepID
    if(isset($_GET['status'])){
        $resepQuery = (new Query())
            ->from('resep')
            ->where(['resepID'=>$_SESSION['resep']]);
        foreach($resepQuery->each() as $resep){ //hasil pasti hanya 1
            $hargaResep = $resep['resepTotalHarga'];
        }

        $resepQuery = (new Query())
            ->from('resep')
            ->where(['resepID'=>$_SESSION['resep']]);
        foreach($resepQuery->each() as $resep){ //hasil pasti hanya 1
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

        $code = rand(10,1000);
        $hargaAkhir = $hargaPeriksa + $hargaResep;
        Yii::$app->db->createCommand()->insert('nota', [
            'notaStatus' => 'belum dibayar',
            'pemeriksaanID' => $_SESSION['pemeriksaan'],
            'resepID' => $_SESSION['resep'],
            'notaTotalHarga' => $hargaAkhir,
            'code' => $code,
        ])->execute();
    }

    unset($_SESSION['pemeriksaanID']);
    unset($_SESSION['resepID']);
    unset($_SESSION['pendaftaranID']);
}
if(isset($_GET['tomorrow'])){
    $_SESSION['tomorrow'] = $_GET['tomorrow'];
    $dateEcho = date('d-M-Y', time() + ($_SESSION['tomorrow'] * 24 * 60 * 60)); //agar bisa lanjut ke hari setelahnya
    $date = date('Y-m-d', time() + (24 * 60 * 60));

} else {
    unset($_SESSION['tomorrow']);
    $dateEcho = date('d-M-Y');
    $date = date('Y-m-d');
}

?>
<div class="pendaftaran-index">
    <br>
    <h1><?= Html::encode($this->title) ?></h1>
    <i><?php echo "Tanggal Periksa $dateEcho"; ?></i><br>
    <br>
    <div class="row" style="padding-left:10px;">
        <td><?= Html::a('Hari ini', ['pendaftaran/listharian'], ['class' => 'btn bg-info', 'style'=>'color:white'])?></td>
        <!--DISINI OTOMATIS NGE UNSET $_SESSION['tomorrow'] kalo pencet tombol HARI INI-->
        <?php //kasih tombol kemarin jika pernah pencet tombol besok?>
        <?php if(isset($_SESSION['tomorrow'])): //jika pernah mencet tombol BESOK?>
            <?php   $_SESSION['tomorrow']+=1; ?>
            <div class="tombol" style="padding-left:10px;">
                <td><?= Html::a('Besok', ['pendaftaran/listharian','tomorrow'=> $_SESSION['tomorrow']], ['class' => 'btn bg-primary', 'style'=>'color:white']) ?></td>
            </div>
        <?php else: //jika blm pernah mencet tombol ini maka session['tomorrow'] blm ada?>
            <div class="tombol" style="padding-left:10px;">
                <td><?= Html::a('Besok', ['pendaftaran/listharian','tomorrow'=> 1], ['class' => 'btn bg-primary', 'style'=>'color:white']) ?></td>
            </div>
        <?php endif; ?>

    </div>
    
    <br>
    <table class="table table-striped">
    <thead class="thead-dark">
        <tr>
        <th scope="col">No</th>
        <th scope="col">Nama Pasien</th>
        <th scope="col">Waktu</th>
        <th scope="col">Status Pemeriksaan</th>
        <th scope="col">Keterangan Pemeriksaan</th>
        </tr>
    </thead>
    <tbody>
    <?php
            $i = 1;
            $jadwalQuery = (new Query())
                ->from('jadwaldokter') //haruse mek 1 karena ambil jadwal sesuai tanggal skrg
                ->where(['dokterID'=>$id, 
                         'jadwalTanggal' =>$date]);
            foreach($jadwalQuery->each() as $jadwal){
                $pendaftaranQuery = (new Query()) //bisa banyak
                    ->from('pendaftaran')
                    ->where(['jadwalID'=>$jadwal['jadwalID']]);
//                var_dump($pendaftaranQuery);
                foreach($pendaftaranQuery->each() as $pendaftaran){
                    $userQuery = (new Query()) //hanya 1
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
                            if(($banyak == 0) && (!isset($_SESSION['tomorrow']))){
                            ?>
                                <td><?= Html::a('Periksa', ['pemeriksaan/create','id'=>$pendaftaran['pendaftaranID']], ['class' => 'btn bg-danger', 'style'=>'color:white']) ?></td>
                                <?php unset($_SESSION['tomorrow']);
                            } else if(($banyak != 0) && (!isset($_SESSION['tomorrow']))){ ?>
                                <td><?= Html::a('Update Periksa', ['pemeriksaan/update','pendaftaranID'=>$pendaftaran['pendaftaranID'], 'id'=>$idPemeriksaan], ['class' => 'btn bg-warning', 'style'=>'color:white']) ?></td>
                            <?php } else {?>
                                <td><p class="text-info">Lakukan pemeriksaan pada waktunya</p></td>
                            <?php }?>
                        </tr>
                <?php }
                }
            } ?>
    </tbody>
    </table>
</div>
<br>
<br>
