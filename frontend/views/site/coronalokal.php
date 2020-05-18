<?php
function tglIndo($time){ //dipecah ke dalam bentuk
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
    $pecahkan = explode('-', $time); //pemisah explode(pemisah, var.yang dipecah) bersifat case sensitive. DI EXPLODE MENJADI ARRAY OF CHAR
    // variabel pecahkan[0] = tahun; variabel pecahkan[1] = bulan;  variabel pecahkan[2] = hari

    $hari = explode(' ', $pecahkan[2]);
    $d = (int)$hari[0];
    $d -= 1;
    $month = (int)$pecahkan[1];
    $year = $pecahkan[0];
    if ($d<=0){
        $month-=1;
        if ($month<=0){
            $year-=1;
            $month = 12 + $month;
        }
        if (($month%2) != 0) //bulan ganjil
            $d = 31 + $d;
        else
            $d = 30 + $d; //februari akan gagal
    }

    return $d . ' ' . $bulan[ (int)$month ] ; //disini diberi (argumen tipe data index) karena jika hanya $pecahkan[2] akan menampilkan bulan dalam bentuk angka. dan jika angka tersebut dijadikan index array $bulan yang sudah dibuat maka akan dikonversi ke dalam isi array
}
?>
<html>
<head></head>
    <style>
        .box{
            padding: 30px; 40px;
            border-radius: 5px;
        }
        .scrollable{
            display: block;
            height: 400px;
            overflow-y: auto;
            /*overflow: scroll;*/
        }
    </style>
<!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" integrity="sha256-aa0xaJgmK/X74WM224KMQeNQC2xYKwlAt08oZqjeF0E=" crossorigin="anonymous" />-->

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['line']});
        google.charts.setOnLoadCallback(drawChart);

        $day = date('d');
        $month = date('M');
        $year = date('Y');

        function drawChart() {

            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Data per-hari');
            data.addColumn('number', 'Pasien sembuh');
            data.addColumn('number', 'Pasien meninggal');
            data.addColumn('number', 'Pasien positif');

            data.addRows([
                <?php if (isset($aRegion)) {
                    foreach ($aRegion as $region) {
                        echo '["' . tglIndo($region["lastUpdate"]) . '", ' . $region["recovered"] . ', ' . $region["deaths"] . ', ' . $region["confirmed"] . '],';
                    }
                }
                //echo '["'.tglIndo($aRegion[2]["lastUpdate"]).'", '.$aRegion[2]["recovered"].', '.$aRegion[2]["deaths"].', '.$aRegion[2]["confirmed"].'],';
                ?>
            ]);

            var formatter = new google.visualization.NumberFormat({pattern: '#,###',negativeParens: true});
            formatter.format(data, 1);
            formatter.format(data, 2);
            formatter.format(data, 3);

            var options = {
                chart: {
                    title: 'Data ini diambil dalam 20 hari terakhir'
                },
                height: 500,
                axes: {
                    x: {
                        0: {side: 'bottom'}
                    }
                }
            };

            var chart = new google.charts.Line(document.getElementById('line_top_x'));

            chart.draw(data, google.charts.Line.convertOptions(options));
        }
    </script>

<body>
<div class="container">
    <!-- feature_part start-->
    <section class="feature_part single_feature_part">
<!--        <div class="container">-->
            <div class="row">
                <div class="col-xl-4 col-md-4 align-self-center">
                    <div class="single_feature_text ">
                        <h2>Data Covid-19 Indonesia</h2>
                        <h4><span><img src="<?=Yii::$app->request->baseUrl?>/img/covidindonesia.jpg" width="60%" alt=""></span></h4>
                    </div>
                </div>

                <div class="col-lg-8 col-md-8">
                    <div class="feature_item">
                        <div class="row">

                            <div class="col-sm-2"></div>
                            <div class="col-sm-8 mb-3">
                                <div class="bg-warning box text-white">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5>Kasus Positif</h5>
                                            <h2 id="data-kasus"></h2>
                                            <h5> orang</h5>
                                        </div>
                                        <div class="col-md-4">
                                            <img src="<?=Yii::$app->request->baseUrl?>/img/emoji/sad.svg" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2"></div>

                            <div class="col-sm-6 mt-3">
                                <div class="bg-danger box text-white">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5>Pasien Meninggal</h5>
                                            <h2 id="data-meninggal"></h2>
                                            <h5> orang</h5>
                                        </div>
                                        <div class="col-md-4">
                                            <img src="<?=Yii::$app->request->baseUrl?>/img/emoji/cry.svg" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 mt-3">
                                <div class="bg-success box text-white">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5>Pasien sembuh</h5>
                                            <h2 id="data-sembuh"></h2>
                                            <h5> orang</h5>
                                        </div>
                                        <div class="col-md-4">
                                            <img src="<?=Yii::$app->request->baseUrl?>/img/emoji/happy.svg" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
<!--        </div>-->
    </section>
    <!-- feature_part start-->

    <div class="card mt-3">
        <div class="card-header text-white text-center bg-info">
            Data Pasien Covid-19 Indonesia berdasarkan Provinsi
        </div>
        <div class="card-body">
            <div class="scrollable">
                <table class="table table-hover table-striped text-center">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Provinsi</th>
                            <th>Positif</th>
                            <th>Sembuh</th>
                            <th>Meninggal</th>
                        </tr>
                    </thead>
                    <tbody id="table-data">
                    <?php
                    $nomor = 1;
                    foreach ($data as $singledata){
                        $hasil = $singledata['attributes'];
                        ?>
                        <tr>
                            <td><?=$nomor++; ?></td>
                            <td><?=$hasil['Provinsi']; ?></td>
                            <td><?=$hasil['Kasus_Posi']; ?></td>
                            <td><?=$hasil['Kasus_Semb']; ?></td>
                            <td><?=$hasil['Kasus_Meni']; ?></td>
                        </tr>
                    <?php }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card mt-3 mb-3">
        <div class="card-body">
            <!-- Area Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary text-center">Data Pasien Covid-19 Indonesia hari sebelumnya</h6>
                </div>
                <div class="card-body">
                    <?php if (isset($aRegion)):?>
                    <div class="chart-area">
                        <div id="line_top_x"></div>
                    </div>
                    <?php endif;?>
                    <hr>
                </div>
            </div>

        </div>
    </div>

</div>
    <script src="<?=Yii::$app->request->baseUrl?>/js/Chart.min.js"></script>
<!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js" integrity="sha256-nZaxPHA2uAaquixjSDX19TmIlbRNCOrf5HO1oHl5p70=" crossorigin="anonymous"></script>-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
</body>
</html>

<script>
    $(document).ready(function () {
        semuaData();

        setInterval(function () {
            semuaData();
        }, 3000);

        function semuaData() {
            $.ajax({
                url: 'https://coronavirus-19-api.herokuapp.com/countries',
                success: function (data) {
                    try {
                        var json = data;
                        var html = [];

                        if (json.length > 0){
                            var i;
                            for (i=0; i<json.length; i++){
                                var dataNegara = json[i];
                                var namaNegara = dataNegara.country;
                                if (namaNegara === 'Indonesia'){
                                    var kasus = dataNegara.cases;
                                    var meninggal = dataNegara.deaths;
                                    var sembuh = dataNegara.recovered;
                                }
                            }
                        }
                        $('#data-kasus').html(kasus)
                        $('#data-meninggal').html(meninggal)
                        $('#data-sembuh').html(sembuh)
                    } catch {
                        alert('error!');
                    }
                }

            });
        }

    });

</script>