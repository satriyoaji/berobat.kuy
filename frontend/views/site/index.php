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
    $userID = $user['userId'];
    $_SESSION['userCategory'] = $user['userPekerjaan'];
}

if(!isset($_SESSION['userCategory'])){
    $_SESSION['userCategory']=0;
}
?>
<!doctype html>
<html lang="en">

<head>

</head>

<body>

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
                                        <div class="modal-header">
                                            <h5 class="modal-title text-center" id="exampleModalLongTitle">Our Project Team</h5>
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


                            <div class="banner_item d-flex justify-content-between">
                                <div class="single_item float-right">
                                    <a <?php if (Yii::$app->user->isGuest) {?>
                                        href="site/login"
                                    <?php } else {?>
                                        href="users/dokter"
                                    <?php }?> >
                                        <img src="img/icon/doctor.jpg" alt="">
                                        <h5>Check up</h5>
                                    </a>
                                </div>
                                <div class="single_item ">
                                    <a <?php if (Yii::$app->user->isGuest) {?>
                                        href="site/login"
                                    <?php } elseif ($_SESSION['userCategory'] == 3) {?>
                                        href="resep/index"
                                    <?php } else {?>
                                        href="obat/"
                                    <?php }?> >
                                        <img src="img/icon/banner_3.svg" alt="">
                                        <h5>Beli obat</h5>
                                    </a>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner part start-->

    <!-- feature_part start-->

    <!-- feature_part start-->

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
                            <li><a href="<?=Url::to('site/coronaglobal')?>"><span class="ti-flag"></span>Global</a></li>
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
                        <h2>We Analyse Your
                            Health States In Order
                            To Top Service</h2>
                        <p>Kind lesser bring said midst they're created signs made the beginni years
                            created Beast upon whales herb seas evening she'd day green dominion
                            evening in moved have fifth in won't in darkness fruitful god behold
                            whos without bring created creature.</p>
                        <a href="#" class="btn_2">read more</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="our_ability_img">
                        <img src="img/top_service.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- top_service part end-->

    <!--::review_part start::-->
    <section class="review_part">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="client_review_part owl-carousel">
                        <?php
                        $commentQuery = (new Query())
                            ->select('*')
                            ->from('comment')
                            ->all();
                        $count = 1;
                        foreach($commentQuery as $comment):
                        $usersQuery = (new Query())
                            ->select('*')
                            ->from('users')
                            ->where(['userId'=>$comment['userID']])
                            ->one();
                        ?>
                        <div class="client_review_single text-center">
<!--                            <img src="img/Quote.png" class="Quote" alt="quote">-->
                            <div align="center" class="product-img mb-md-2">
                                <?php if (!isset($usersQuery['userFoto'])):?>
                                    <img  src="../assets/img/profil.png" alt="Avatar" class="rounded-circle" style="width:130px;height:130px;">
                                <?php else:?>
                                    <img  src="../assets/img/user/<?= $usersQuery['userFoto']; ?>" alt="Avatar" class="img-rounded" style="width:140px;height:140px;">
                                <?php endif;?>
                            </div>
                            <div class="client_review_text mb-2">
                                <p>" <?= $comment['review'] ?> "</p>
                            </div>
                            <h4>- <?= $usersQuery['userNama'] ?></h4>
                        </div>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--::review_part end::-->

    <!--::regervation_part start::-->
    <section class="regervation_part">
        <div class="container">
            <div class="row align-items-center regervation_content">
                <div class="col-lg-7 col-md-6">
                    <div class="regervation_part_iner">
                        <form>
                            <h2>Make a review</h2>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <input type="email" class="form-control" id="inputEmail4" placeholder="Name">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="password" class="form-control" id="inputPassword4"
                                           placeholder="Email address">
                                </div>
                                <div class="form-group col-md-12">
                                        <textarea class="form-control" id="Textarea" rows="4"
                                                  placeholder="Your Note "></textarea>
                                </div>
                            </div>
                            <div class="regerv_btn">
                                <?= Html::a('Beri review', ['comment/create'], ['class' => 'regerv_btn_iner'])?>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6">
                    <div class="reservation_img">
                        <img src="img/reservation.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--::regervation_part end::-->

    <!--::doctor_part start::-->

    <!--::doctor_part end::-->

    <!-- intro_video_bg start-->

    <!-- intro_video_bg part start-->

    <!--::blog_part start::-->

    <!--::blog_part end::-->

    <!-- footer part start-->
    <footer class="footer-area">
        <div class="footer section_padding">
            <div class="container">
                <div class="row">
                    <div class="col-xl-2 col-sm-4 mb-4 mb-xl-0 single-footer-widget">
                        <h4>Services Link</h4>
                        <ul>
                            <li><a href="#">Eye treatment</a></li>
                            <li><a href="#">Skin Surgery</a></li>
                            <li><a href="#">Diagnosis clinic</a></li>
                            <li><a href="#"> Dental care</a></li>
                            <li><a href="#">Neurology service</a></li>
                            <li><a href="#">Plastic surgery</a></li>
                        </ul>
                    </div>
                    <div class="col-xl-2 col-sm-4 mb-4 mb-xl-0 single-footer-widget">
                        <h4>Quick Links</h4>
                        <ul>
                            <li><a href="#">About us</a></li>
                            <li><a href="#">Department</a></li>
                            <li><a href="#"> Online payment</a></li>
                            <li><a href="#">Careers</a></li>
                            <li><a href="#">Department</a></li>
                        </ul>
                    </div>

                    <div class="col-xl-2 col-sm-4 mb-4 mb-xl-0 single-footer-widget">
                        <h4>Explore</h4>
                        <ul>
                            <li><a href="#">In the community</a></li>
                            <li><a href="#">IU health foundation</a></li>
                            <li><a href="#">Family support </a></li>
                            <li><a href="#">Business solution</a></li>
                            <li><a href="#">Community clinic</a></li>
                        </ul>
                    </div>
                    <div class="col-xl-2 col-sm-4 mb-4 mb-xl-0 single-footer-widget">
                        <h4>Resources</h4>
                        <ul>
                            <li><a href="#">Lights were season</a></li>
                            <li><a href="#"> Their is let wherein</a></li>
                            <li><a href="#">which given over</a></li>
                            <li><a href="#">Without given She</a></li>
                            <li><a href="#">Isn two signs think</a></li>
                        </ul>
                    </div>
                    <div class="col-xl-4 col-sm-8 col-md-8 mb-4 mb-xl-0 single-footer-widget">
                        <h4>Newsletter</h4>
                        <p>Seed good winged wherein which night multiply
                            midst does not fruitful</p>
                        <div class="form-wrap" id="mc_embed_signup">
                            <form target="_blank"
                                  action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
                                  method="get" class="form-inline">
                                <input class="form-control" name="EMAIL" placeholder="Your Email Address"
                                       onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Email Address '"
                                       required="" type="email">
                                <button class="click-btn btn btn-default text-uppercase">subscribe</button>
                                <div style="position: absolute; left: -5000px;">
                                    <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value=""
                                           type="text">
                                </div>

                                <div class="info"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </footer>

    <!-- footer part end-->

</body>

</html>