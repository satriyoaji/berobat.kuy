<?php
/* @var $this yii\web\View */
use yii\helpers\Html; 
use yii\helpers\Url;
use yii\db\Query;
$this->title = 'Si Klinik';

?>
<br>
<div class="row">
<div class="col-md-8"></div>
<div class="col-md-4 text-right">
<div class="alert alert-primary" role="alert">
  Selamat datang dr. <b>Nama Dokter</b>
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
        <h5 class="card-title">Beli Obat</h5>
        <div class="row">
            <div class="col-md-4">
                <img src="../../assets/pills.png" alt="" width="80" height="80">
            </div>
            <div class="col-md-8">
            <p class="card-text">Halaman yang menampilkan list pasien yang melakukan pemeriksaan.</p>
            </div>
        </div>
        <br>
        <?= Html::a('Kunjungi Laman', ['obat/index'], ['class' => 'card-link'])?>
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
            6, 6, 6, 6, 6, 6, 11, 32, 110, 235,
            369, 640, 1005, 1436, 2063, 3057, 4618, 6444, 9822, 15468,
            20434, 24126, 27387, 29459, 31056, 31982, 32040, 31233, 29224, 27342,
            26662, 26956, 27912, 28999, 28965, 27826, 25579, 25722, 24826, 24605,
            24304, 23464, 23708, 24099, 24357, 24237, 24401, 24344, 23586, 22380,
            21004, 17287, 14747, 13076, 12555, 12144, 11009, 10950, 10871, 10824,
            10577, 10527, 10475, 10421, 10358, 10295, 10104, 9914, 9620, 9326,
            5113, 5113, 4954, 4804, 4761, 4717, 4368, 4018
        ]
    }, {
        name: 'Pasien Pendaftar',
        data: [null, null, null, null, null, null, null, null, null, null,
            5, 25, 50, 120, 150, 200, 426, 660, 869, 1060,
            1605, 2471, 3322, 4238, 5221, 6129, 7089, 8339, 9399, 10538,
            11643, 13092, 14478, 15915, 17385, 19055, 21205, 23044, 25393, 27935,
            30062, 32049, 33952, 35804, 37431, 39197, 45000, 43000, 41000, 39000,
            37000, 35000, 33000, 31000, 29000, 27000, 25000, 24000, 23000, 22000,
            21000, 20000, 19000, 18000, 18000, 17000, 16000, 15537, 14162, 12787,
            12600, 11400, 5500, 4512, 4502, 4502, 4500, 4500
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