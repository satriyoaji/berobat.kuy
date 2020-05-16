<?php
function http_request($url){
    //persiapkan CURL
    $ch = curl_init();

    //set URL
    curl_setopt($ch, CURLOPT_URL, $url);

    //aktifkan fungsi trans nilai
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    //matikan SSL agar bisa diakses di localhost
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

    //Akses nilainya dan tampung hasil
    $output = curl_exec($ch);

    //close
    curl_close($ch);

    return $output;
}

//panggil http_req
$data = http_request("https://api.kawalcorona.com/indonesia/provinsi/");

//ubah format JSON to array assoc
$data = json_decode($data, TRUE);

$jumlah = count($data);

//for ($i=0; $i<$jumlah; $i++){
//$hasil = $data[$i]['attributes'];

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
<body>
<div class="container">
    <!-- feature_part start-->
    <section class="feature_part single_feature_part">
        <div class="container">
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
        </div>
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

</div>


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

    })
</script>