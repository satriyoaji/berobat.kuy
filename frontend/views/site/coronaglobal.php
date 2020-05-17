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
$data = http_request("https://api.kawalcorona.com/");

//ubah format JSON to array assoc
$data = json_decode($data, TRUE);

$jumlah = count($data);

//for ($i=0; $i<$jumlah; $i++){
//$hasil = $data[$i]['attributes'];

?>

<html>
<head>
</head>
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
    <div class="text-center">
        <img src="<?=Yii::$app->request->baseUrl?>/img/prevention2.jpg" alt="">
        <h2 style="color: whitesmoke" class="display-4"></h2>
    </div>
    <!-- feature_part start-->
    <section class="feature_part single_feature_part">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-md-4 align-self-center">
                    <div class="single_feature_text ">
                        <h2>Data Covid-19 Global</h2>
                        <h4><span><img src="<?=Yii::$app->request->baseUrl?>/img/coronavirus.gif" alt=""></span></h4>
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
            Data Pasien Covid-19 dunia tiap Negara
        </div>
        <div class="card-body">
            <div class="">
                <table id="datatable" class="table table-hover table-striped text-center">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Negara</th>
                        <th>Positif</th>
                        <th>Sembuh</th>
                        <th>Meninggal</th>
                        <th>Dirawat</th>
                    </tr>
                    </thead>
                    <tbody id="table-data">
                    <?php
                    $no = 1;
                    foreach ($data as $singledata){
                        $hasil = $singledata['attributes'];
                        ?>
                        <tr>
                            <td><?=$no++; ?></td>
                            <td><?=$hasil['Country_Region']; ?></td>
                            <td><?=$hasil['Confirmed']; ?></td>
                            <td><?=$hasil['Deaths']; ?></td>
                            <td><?=$hasil['Recovered']; ?></td>
                            <td><?=$hasil['Active']; ?></td>
                        </tr>
                    <?php }
                    ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

</div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
</body>
</html>


<script>
    $(document).ready(function () {
        $('#datatable').DataTable();
        semuaData();

        setInterval(function () {
            semuaData();
        }, 2000);

        function semuaData() {
            $.ajax({
                url: 'https://coronavirus-19-api.herokuapp.com/all',
                success: function (data) {
                    try {
                        var json = data;
                        var kasus = json.cases;
                        var meninggal = json.deaths;
                        var sembuh = json.recovered;

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