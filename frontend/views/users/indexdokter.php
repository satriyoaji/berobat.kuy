<?php
/* @var $this yii\web\View */
use yii\helpers\Html; 
use yii\helpers\Url;
use yii\db\Query;
$this->title = 'Si Klinik';

$userQuery = (new Query())
  ->from('users')
  ->where(['userId'=>Yii::$app->user->id]);
foreach($userQuery->each() as $user){
  $nama = $user['userNama'];
}
?>
<br>
<div class="row">
    <div class="col-md-8"></div>
        <div class="col-md-4 text-right">
            <div class="alert alert-primary" role="alert">
                Selamat datang dr. <b><?php echo $nama;?></b>
        </div>
    </div>
</div>

<br>
<div class="row">
    <div class="col-md-4">
    <div class="card" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title">List Pasien</h5>
        <div class="row">
            <div class="col-md-4">
                <img src="../../assets/icon/test.png" alt="" width="80" height="80">
            </div>
            <div class="col-md-8">
            <p class="card-text">Halaman yang menampilkan list pasien yang melakukan pemeriksaan.</p>
            </div>
        </div>
        <br>
        <?= Html::a('Kunjungi Laman', ['users/pasien'], ['class' => 'card-link'])?>
    </div>
    </div>
    </div>

    <div class="col-md-4">
    <div class="card" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title">List Periksa</h5>
        <div class="row">
            <div class="col-md-4">
                <img src="../../assets/icon/periksa.png" alt="" width="80" height="80">
            </div>
            <div class="col-md-8">
            <p class="card-text">Halaman yang menampilkan list riwayat pemeriksaan pasien.</p> 
            </div>
        </div>
        <br>
        <?= Html::a('Kunjungi Laman', ['pendaftaran/listharian'], ['class' => 'card-link'])?>
    </div>
    </div>
    </div>

    <div class="col-md-4">
    <div class="card" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title">List Jadwal</h5>
        <div class="row">
            <div class="col-md-4">
            <img src="../../assets/icon/questionnaire.png" alt="" width="80" height="80">
            </div>
            <div class="col-md-8">
            <p class="card-text">Halaman yang menampilkan list jadwal dokter.</p>
            </div>
        </div>
        <br>
        <?= Html::a('Kunjungi Laman', ['jadwaldokter/listjadwal','idDokter'=>Yii::$app->user->id], ['class' => 'card-link'])?>
    </div>
    </div>
    </div>

</div>
<br>
<br>

<div class="row">
<div class="col-md-8">
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
<?php 
$jadwalQuery = (new Query())
->from('jadwaldokter');

foreach($jadwalQuery->each() as $jadwal){
    $pendaftaranQuery = (new Query())
    ->select('count(*)')
    ->from('pendaftaran')
    ->where(['jadwalID'=>$jadwal['jadwalID'],
    'pendaftaranStatus'=>'Sudah Periksa']);


    foreach($pendaftaranQuery->each() as $pendaftaran){
    $jumlah = $pendaftaran['count(*)'];
    }

}




?>
<script>

Highcharts.chart('container', {
    chart: {
        type: 'area'
    },
    title: {
        text: 'Grafik Pasien Pendaftar dan Pasien Hadir'
    },
    subtitle: {
        text: 'Sources: Si Klinik'
    },
    xAxis: {
        allowDecimals: false,
        labels: {
            formatter: function () {
                return this.value; // clean, unformatted number for year
            }
        }
    },
    yAxis: {
        title: {
            text: 'Jumlah Pasien'
        },
        labels: {
            formatter: function () {
                return this.value;
            }
        }
    },
    tooltip: {
        pointFormat: '{series.name} tercatat sebanyak <b>{point.y:,.0f}</b><br/> pada ID Jadwal Dokter : {point.x}'
    },
    plotOptions: {
        area: {
            pointStart: 60,
            marker: {
                enabled: false,
                symbol: 'circle',
                radius: 2,
                states: {
                    hover: {
                        enabled: true
                    }
                }
            }
        }
    },
    series: [{
        name: 'Pasien Hadir',
        data: [
            14,15,16,13,14,15,17,3,0,0,0,5,5,13
        ]
    }, {
        name: 'Pasien Pendaftar',
        data: [20,21,23,23,19,20,27,30,40,10,9,8,12,19
        ]
    }]
});
</script>
</div>

<div class="col-md-4">

</div>
</div>

<br>
<br>