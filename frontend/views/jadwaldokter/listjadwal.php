<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\db\Query;

$id = $_GET['idDokter'];

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\JadwaldokterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jadwal Dokter';
?>
<div class="jadwaldokter-index">

    <br>
    <div class="col-md-6">
    <h1>Jadwal Dokter</h1>
    <hr>
    </div>
    
    <?php
    $dataUser = (new Query())
        ->select('*')
        ->from('users')
        ->where(['userId'=>$id]);
    foreach($dataUser->each() as $user){ ?>
        <div class="detailDokter" style="padding-left:12px;">
        <h4><b><?php echo $user['userNama']; ?></b></h4>
        <?php $pekerjaan = $user['userPekerjaan'];?>
        <?php
        $dataPekerjaan = (new Query())
            ->select('*')
            ->from('pekerjaan')
            ->where(['pekerjaanID'=>$user['userPekerjaan']]);
        foreach($dataPekerjaan->each() as $pekerjaan){ ?>
            <div class="alert alert-primary col-md-4" role="alert">
            <i>sebagai <?php echo $pekerjaan['pekerjaanNama']; ?></i>
            </div>
        <?php } ?>
        </div>
    <?php } ?>
    <td><?= Html::a('Tambah Jadwal Dokter', ['jadwaldokter/create'], ['class' => 'btn btn-success']) ?></td>
    <div class="jadwal mb-3" style="padding-left:12px;">
    <table class="table table-striped">
    <thead class="">
        <tr>
        <th scope="col">No</th>
        <th scope="col">Tanggal</th>
        <th scope="col">Ruangan</th>
        <th scope="col">Waktu</th>
        <th scope="col">Kuota</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $i=1;
        $date = date('d-m-Y');  
        $dataJadwal = (new Query())
            ->select('*')
            ->from('jadwaldokter')
            ->where(['dokterid'=>$id]);
        foreach($dataJadwal->each() as $jadwal){
            $dataPendaftaran = (new Query())
                ->select('count(*)')
                ->from('pendaftaran')
                ->where(['jadwalID'=>$jadwal['jadwalID']]);
            foreach($dataPendaftaran->each() as $pendaftaran){
                $sisa = $jadwal['jadwalKuota']-$pendaftaran['count(*)'];
                if($sisa == 0){ ?>
                <?php 
                } else { ?>
                    <tr>
                    <th scope="row"><?php echo $i; $i++; ?></th>
                    <td><?php echo tgl_indo($jadwal['jadwalTanggal']);?></td>
                    <td><?php echo $jadwal['jadwalRuangan'];?></td>
                    <td><?php echo $jadwal['jadwalWaktu'];?></td>
                    <td><?php echo $sisa;?></td>
                    <?php $verifikasiPendaftaran = (new Query())
                        ->select('count(*)')
                        ->from('pendaftaran')
                        ->where(['jadwalID'=>$jadwal['jadwalID'],
                                 'pasienID'=>Yii::$app->user->id]);
                    foreach($verifikasiPendaftaran->each() as $data){
                        $verifikasi = $data['count(*)']; 
                    }?>
                        
                    
                    </tr>
                    <?php } ?>
            <?php } 
        }  ?>    
    </tbody>
    </table>
    </div>

    <br>
    <br>

    <?php
    function tgl_indo($tanggal){ //dipecah ke dalam bentuk
        $bulan = array (
            1 =>   'Januari', //cukup index pertama saja yang diberi key itu sudah bisa mengartikan key index selanjutnya
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal); //pemisah explode(pemisah, var.yang dipecah) bersifat case sensitive. DI EXPLODE MENJADI ARRAY OF CHAR
        // variabel pecahkan[0] = tahun
        // variabel pecahkan[1] = bulan
        // variabel pecahkan[2] = hari
        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0]; //disini diberi (argumen tipe data index) karena jika hanya $pecahkan[2] akan menampilkan bulan dalam bentuk angka. dan jika angka tersebut dijadikan index array $bulan yang sudah dibuat maka akan dikonversi ke dalam isi array
    }
    ?>