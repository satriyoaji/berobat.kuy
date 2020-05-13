<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\MyAsset;
use common\widgets\Alert;
use yii\db\Query;

\frontend\assets\MedisenAsset::register($this);

$userQuery = (new Query())
  ->from('users')
  ->where(['userId'=>Yii::$app->user->id]);
foreach($userQuery->each() as $user){
  $kategory = $user['userPekerjaan'];
  $fotoProfil = $user['userFoto'];
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--  LIHAT LINK REL DAN HREF DI FILE ASLI  -->

    <style>
        .img-profile{
            border-bottom-left-radius: 40%;
            border-top-right-radius: 40%;
            border-bottom-right-radius: 40%;
            border-top-left-radius: 40%;
            width: 50px;
            border-style: ridge;
        }
    </style>

    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

</head>
<body>
<?php $this->beginBody() ?>

<!--<div class="wrap">-->

<!-- <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
    
  <a class="navbar-brand" href="#"><img src="../../assets/logo.png" alt="" class="img-responsive" width="200" height="55"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

</nav> -->

    <!--::header part start::-->
    <header class="main_menu home_menu">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="<?= Yii::$app->request->baseUrl?>"> <img src="<?= Yii::$app->getHomeUrl(); ?>../../assets/logo.png" alt="logo" class="img-responsive" width="200" height="55"> </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse main-menu-item justify-content-end" id="navbarSupportedContent">
                            <ul class="navbar-nav align-items-center">
                                <li class="nav-item active">
                                    <a class="nav-link text-primary font-weight-bold" href="<?= Yii::$app->request->baseUrl?>">Home</a>
                                </li>

                                <?php if (Yii::$app->user->isGuest){ ?>
                                    <li class="nav-item">
                                        <?= Html::a('Register', ['users/create'], ['class' => 'nav-link font-weight-bold']) ?>
                                    </li>
                                    <li class="nav-item">
                                        <?= Html::a('Sign in', ['site/login'], ['class' => 'nav-link font-weight-bold']) ?>
                                    </li>
                                <?php } else{?>
                                    <?php if($kategory == 1) { ?>
                                        <li class="nav-item">
                                            <?= Html::a('List Periksa', ['pendaftaran/index', 'id'=>Yii::$app->user->id], ['class' => 'dropdown-item']) ?>
                                        </li>
                                        <li class="nav-item">
                                            <?= Html::a('Pembayaran', ['nota/index', 'id'=>Yii::$app->user->id], ['class' => 'dropdown-item']) ?>
                                        </li>
                                    <?php } ?>

                                    <li class="nav-item dropdown">
                                        <button class="btn btn-outline-light dropdown-toggle" type="button" id="navbarDropdown_1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <!--          <img src= alt="Avatar" style="border-radius: 50%; width: 50px;border-style: ridge;">-->
                                            <?php if (!isset($fotoProfil)):?>
                                                <img src="<?php if(Yii::$app->request->pathInfo == "") {echo '..';}
                                                else {echo '../..';}?>/assets/img/profil.png" alt="Avatar" class="img-profile" style="">
                                            <?php else:?>
                                                <img src="<?php if(Yii::$app->request->scriptUrl == "/siklinik/frontend/web/index.php") {echo '..';}
                                                else {echo '../..';}?>/assets/img/user/<?= $fotoProfil; ?>" alt="Avatar" class="img-profile" style="">
                                            <?php endif;?>
                                        </button>
<!--                                        <a class="nav-link dropdown-toggle" href="blog.html" id="navbarDropdown_1"-->
<!--                                           role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
<!--                                            blog-->
<!--                                        </a>-->
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown_1">
                                            <?= Html::a('Profile', ['users/view', 'id'=>Yii::$app->user->id], ['class' => 'dropdown-item', 'style'=>'color:#35a373']) ?>
                                            <?= Html::a('Logout (' . Yii::$app->user->identity->username . ')', ['/site/logout'], ['class' => 'dropdown-item', 'style'=>'color:#35a373','data'=>['method'=>'post']] ) ?>
                                        </div>
                                    </li>
                                <?php }?>
<!--                                    <li class="d-none d-lg-block">-->
<!--                                        <a class="btn_1" href="#">learn more</a>-->
<!--                                    </li>-->
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Header part end-->

    <div class="pb-5 mb-5"></div>
    <?php if ( (isset($kategory) && ( ($kategory != 1 && Yii::$app->request->url != '/berobatkuy/frontend/web/') ||
                ($kategory != 5 && Yii::$app->request->url != '/berobatkuy/frontend/web/')) ) ||
        (Yii::$app->request->pathInfo == 'site/login') || (Yii::$app->request->pathInfo == 'users/create') || (Yii::$app->request->pathInfo == 'comment/create') ):
        // (jika sudah login dan bukan dokter & pasien) atau (jika mengunjungi halaman login/register/createComment)?>
        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    <?php else:?>
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    <?php endif;?>


<!--</div>-->

<footer class="footer">
    <div class="container mt-3 pt-3">
        <p class="pull-left">&copy; <h9>Berobat.Kuy </h9> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
<!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
<!--<script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js" integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous"></script>-->
<!---->
<!--<script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js" integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous"></script>-->
<!--<script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>-->
</body>
</html>
<?php $this->endPage() ?>
