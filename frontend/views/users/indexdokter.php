<?php
/* @var $this yii\web\View */
use yii\helpers\Html; 
use yii\helpers\Url;
use yii\db\Query;
$this->title = 'Berobat.kuy';

$userQuery = (new Query())
  ->from('users')
  ->where(['userId'=>Yii::$app->user->id]);
foreach($userQuery->each() as $user){
  $nama = $user['userNama'];
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" integrity="sha256-aa0xaJgmK/X74WM224KMQeNQC2xYKwlAt08oZqjeF0E=" crossorigin="anonymous" />
    <!-- banner part start-->
    <section class="banner_part">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-xl-6">
                    <div class="banner_text">
                        <div class="banner_text_iner">
                            <h1>Bringing the future
                                of healthcare</h1>
                            <p>Deep created replenish herb without night fruit day earth evening Called his
                                green were they're fruitful to over Sea bearing sixth Earth face. Them lesser
                                great you'll second </p>

                            <!--  modal  -->
                            <button type="button" class="btn_2" data-toggle="modal" data-target="#projectOwnerTeam">
                                Project Team
                            </button>
                            <div class="modal fade" id="projectOwnerTeam" tabindex="-1" role="dialog" aria-labelledby="projectOwnerTeamTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header text-center">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Our Project Team</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!--Carousel Wrapper-->
                                            <div class="client_review_part owl-carousel">
                                                <div class="client_review_single text-center">
                                                    <div align="center" class="product-img mb-md-2">
                                                        <img class="h-50 w-50 text-center" src="../../assets/profil/profilAji.jpg" alt="First slide">
                                                    </div>
                                                    <h4>Ryo Aji</h4>
                                                    <div class="client_review_text mb-2">
                                                        <p>- as project owner</p>
                                                    </div>
                                                </div>
                                                <div class="client_review_single text-center">
                                                    <div align="center" class="product-img mb-md-2">
                                                        <img class="h-50 w-50 text-center" src="../../assets/profil/profilEkky.jpg" alt="First slide">
                                                    </div>
                                                    <h4>Ekky Regita</h4>
                                                    <div class="client_review_text mb-2">
                                                        <p>- as frontend dev</p>
                                                    </div>
                                                </div>
                                                <div class="client_review_single text-center">
                                                    <div align="center" class="product-img mb-md-2">
                                                        <img class="h-50 w-50 text-center" src="../../assets/profil/profilAan.jpg" alt="First slide">
                                                    </div>
                                                    <h4>Fahreza Anshori</h4>
                                                    <div class="client_review_text mb-2">
                                                        <p>- as backend dev</p>
                                                    </div>
                                                </div>
                                                <div class="client_review_single text-center">
                                                    <div align="center" class="product-img mb-md-2">
                                                        <img class="h-50 w-50 text-center" src="../../assets/profil/profilFaidza.jpg" alt="First slide">
                                                    </div>
                                                    <h4>Faidza F.</h4>
                                                    <div class="client_review_text mb-2">
                                                        <p>- as UI/UX design</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/.Carousel Wrapper-->
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- FEATURES -->
                            <div class="banner_item d-flex justify-content-around">
                                <div class="single_item">
                                    <a <?php if (Yii::$app->user->isGuest) {?>
                                        href="site/login"
                                    <?php } else {?>
                                        href="users/pasien"
                                    <?php }?> >
                                        <img class="" src="../../assets/icon/test.png" alt="" width="90">
                                        <h5>List Pasien</h5>
                                    </a>
                                </div>
                                <div class="single_item">
                                    <a <?php if (Yii::$app->user->isGuest) {?>
                                        href="site/login"
                                    <?php } else {?>
                                        href="pendaftaran/listharian"
                                    <?php }?> >
                                        <img class="" src="../../assets/icon/periksa.png" alt="" width="90">
                                        <h5>List Periksa</h5>
                                    </a>
                                </div>
                                <div class="single_item">
                                    <a <?php if (Yii::$app->user->isGuest) {?>
                                        href="site/login"
                                    <?php } else {?>
                                        href="jadwaldokter/listjadwal?idDokter=<?= Yii::$app->user->id ?>"
                                    <?php }?> >
                                        <img class="" src="../../assets/icon/questionnaire.png" alt="" width="90">
                                        <h5>List Jadwal</h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- our_ability part start-->
    <section class="our_ability section_padding">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-md-6 col-lg-6">
                    <div class="our_ability_img">
                        <img src="<?=Yii::$app->request->baseUrl?>/img/animationcorona.jpg" alt="">
                    </div>
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="our_ability_member_text">
                        <h2>Covid-19 real-time data</h2>
                        <p>SARS nCoV-2 is a global known as a seriously pandemic all around the world</p>
                        <ul>
                            <li><a href="site/coronaglobal"><span class="ti-flag"></span>Global</a></li>
                            <li><a href="site/coronalokal"><span class="ti-face-sad"></span>Indonesia</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- our_ability part end-->

    <!-- top_service part start-->
    <section class="top_service our_ability padding_bottom">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-md-5 col-lg-5">
                    <div class="our_ability_member_text">
                        <canvas id="linechart" width="100" height="100"></canvas>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="our_ability_img">
                        <img src="<?=Yii::$app->request->baseUrl?>/img/chart2.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- top_service part end-->
    <?php
    $pasiens = (new Query())
        ->from('users')
        ->where(['userPekerjaan'=>1])
        ->all();

    $count = [];
    $i = 0;
    foreach ($pasiens as $patien){
        $pendaftarans = (new Query())
            ->select('count(*)')
            //->addSelect('pasienID')
            ->from('pendaftaran')
            ->where(['pasienID'=>$patien['userId']])
            ->all();
        $count[$i] = $pendaftarans[0]['count(*)'];
        $i++;
    }
    ?>
    <script src="<?=Yii::$app->request->baseUrl?>/js/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js" integrity="sha256-nZaxPHA2uAaquixjSDX19TmIlbRNCOrf5HO1oHl5p70=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        var ctx = document.getElementById("linechart").getContext("2d");
        var data = {
            labels:
                [<?php foreach ($pasiens as $pasien)
                        {
                            echo '"'.$pasien['userNama'].'",';
                        }
                ?>],
            datasets: [{
                label: "Pendaftaran",
                backgroundColor: "#a2fff2",
                data: [<?php foreach ($pasiens as $pasien)
                        {
                            $pendaftarans = (new Query())
                                ->from('pendaftaran')
                                ->where(['pasienID'=>$pasien['userId']])
                                ->count();
                            echo '"'.$pendaftarans.'",';
                        }
                    ?>]
                //data: ["20", "30"]
            },],
        };
        var mychart = new Chart(ctx, {
           type: 'bar',
           data: data,
           options: {
               display: true
           },
            barValueSpacing: 10,
            scales: {
               yAxes: [{
                  ticks: {
                      max: 10,
                      min: 0,
                      stepSize: 1
                  }
               }],
                xAxes: [{
                   gridLines: {
                       color: "rgba(163, 0, 8, 0.5)",
                   }
                }]
            },
        });
    </script>

    `<div class="container mb-3">
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
                        pointStart: 0,
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

            <div class="col-md-4"></div>

        </div>
    </div>`

