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
    $_SESSION['userCategory'] = $user['userPekerjaan'];
}

if(!isset($_SESSION['userCategory'])){
    $_SESSION['userCategory']=0;
}
?>
<div class="site-index">
    <div class="body" style="padding-top:40px;">
    <br>
    <br>
    <?php 
            if($_SESSION['userCategory'] >=5){ 
    // buat tampilan Dokter?>
    
    
    <?php } else if($_SESSION['userCategory']==4){ ?>

        <div class="comments-create">
            <?= $this->render('cari', ['model' => $model]) ?>
        </div>

        <?php 
        if(isset($_SESSION['cari'])){
        ?>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                <th scope="col">No</th>
                <th scope="col">Code</th>
                <th scope="col">Jumlah Harga</th>
                <th> </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <?php
                $i = 0;
                $notaQuery = (new Query())
                    ->select('*')
                    ->from('nota')
                    ->where(['code'=>$_SESSION['cari']]);
                foreach($notaQuery->each() as $nota){ 

                ?>
                <td><?php echo $i; $i++;?></td>
                <td><?php echo $nota['code'];?></td>
                <td><?php echo $nota['notaTotalHarga'];?></td>
                <td><?= Html::a('Bayar', ['nota/update','id'=>$nota['notaID']], ['class' => 'btn btn-success']) ?></td>
                </tr>
                <?php 
            } ?> 
            </tbody>
        </table>
        
        <?php 
        unset($_SESSION['cari']);
        }
    }else { ?>
        
        <div class="jumbotron" style="background-color:#FFFFFF;box-shadow: 10px 10px 133px -21px rgba(158,153,158,0.45);">
            <div class="row" style="padding-left:80px;">
                <h1 class="display-4" style="color:#35ad9f;"><b>SiKlinik !</b></h1>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <img src="../../assets/jumbotron.png" alt="" class="img-responsive" width="500" height="350">
                </div>
                <div class="col-md-6">
                    <br>
                    <br>
                    <div class="deskrpsi">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quibusdam consequuntur molestias perferendis voluptates, eius iure mollitia at reiciendis nemo nihil, esse delectus ut assumenda molestiae iste officiis rerum! Voluptatum, laborum.</div>
                    <div class="text-center">
                        <br>
                        <br>
                        <a href="#fitur" class="btn btn-primary btn-lg" role="button" aria-pressed="true">Get Started</a>
                    </div>
                </div>
            </div>
        </div>
        </div>
        
        <div class="body-content">
            <br>
            <br>
            <div class="row">
                <div id="fitur">
                    <div class="col-md-12" style="width: 1100px;display: flex;flex-direction: column;justify-content: center;text-align: center;">
                        <h1 align="center" style="color:#67696b;">FITUR</h1>
                        <br>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3" >
                                <p align="right" style="color:#797b7c;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique facilis vel, eveniet incidunt explicabo nisi doloremque reiciendis cumque, eaque velit repellendus ad adipisci, voluptas repellat! Neque minus ut alias enim.</p>
                            </div>
                            <div class="col-md-3"  >
                                <a href="">
                                <div class="card" style="min-height: 200px;">
                                    <div class="gambar" style="padding-top:20px;" align="center">
                                        <img src="../../assets/doctor.png" alt="" width="100" height="100">
                                    </div>
                                    <br>
                                    <?php if (Yii::$app->user->isGuest) {?>    
                                        <h3 class="card-title text-center"><?= Html::a('Check Up', ['site/login'], ['class' => 'card-title'])?></h3>
                                    <?php } else {?>
                                        <h3 class="card-title text-center"><?= Html::a('Check Up', ['users/dokter'], ['class' => 'card-title'])?></h3>
                                    <?php }?>
                                </div>
                                </a>
                            </div>
                            <div class="col-md-3">
                            <a href="">
                            <div class="card" style="width: 14rem;">
                                <div class="card-body">
                                    <div class="gambar" style="padding-top:20px;" align="center">
                                        <img src="../../assets/pills.png" alt="" width="100" height="100">
                                    </div>
                                    <?php if (Yii::$app->user->isGuest) {?>    
                                        <h3 class="card-title text-center"><?= Html::a('Beli Obat', ['site/login'], ['class' => 'card-title'])?></h3>
                                    <?php } else if($_SESSION['userCategory'] == 3){?>
                                        <h3 class="card-title text-center"><?= Html::a('Beli Obat', ['resep/index'], ['class' => 'card-title'])?></h3>
                                    <?php } else{ ?>
                                        <h3 class="card-title text-center"><?= Html::a('Beli Obat', ['obat/index'], ['class' => 'card-title'])?></h3>
                                    <?php } ?>
                                </div>
                            </div>
                            </a>
                            </div>
                            <div class="col-md-3">
                                <p align="left" style="color:#797b7c;">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eum maiores, culpa voluptatem alias earum mollitia a accusamus ex nobis, cumque omnis quidem ipsa saepe quos, corrupti aspernatur aliquam molestiae ullam?</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6 deskripsi">
                    <div class="judul">
                    
                    </div>
                    <div class="isi">
                    
                    </div>
                </div>
                <div class="col-md-6 gambar" align="right">
                    <!-- <img src="../../assets/check.png" alt=""> -->
                </div>
            </div>
            
        </div>
    <?php } ?>
<br>
<br>
<div class="col-md-12" style="width: 1100px;display: flex;flex-direction: column;justify-content: center;text-align: center;">
    <h1 align="center" style="color:#67696b;">OUR TEAM</h1>
    <br>
</div> 

<div class="col-md-12 text-center" style="padding-left:90px;">
<div class="card" style="width: 60rem; padding-left:20px;">
  <div class="card-body">
  <section class="carousel slide testimonials-slider cid-qyvf5AQs7c" id="testimonials-slider1-3" data-rv-view="767">
    <div class="container text-center">
        <div class="carousel slide" data-ride="carousel" role="listbox">
            <div class="carousel-inner">
                
                
            <div class="carousel-item active">
                    <div class="user col-md-12">
                    <br>
                        <img src="../../assets/profil/lana.jpg" class="rounded-circle" style="width:220px;height:220px;border;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" alt="Cinque Terre">
                        
                        <div class="user_text pb-3">
                        <br>
                        <br>
                            <p class="mbr-fonts-style display-7">
                                Good afternoon. I am very pleased with the quality of the work of your employee representing your wonderful company.
                            </p>
                        </div>
                        <div class="user_name mbr-bold pb-2 mbr-fonts-style display-7">
                            Shafiyah
                        </div>
                        <div class="user_desk mbr-light mbr-fonts-style display-7">
                            BACKEND
                        </div>
                    </div>
                </div><div class="carousel-item">
                    <div class="user col-md-12">
                    <br>
                    <img src="../../assets/profil/shaf.jpg" class="rounded-circle" style="width:220px;height:220px;border;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" alt="Cinque Terre">
                        <div class="user_text pb-3">
                        <br>
                        <br>
                            <p class="mbr-fonts-style display-7">
                                All issues are resolved promptly. In communication, the employees are pleasant, helpful. Always offer new ideas, new ways to develop, improve our project.
                            </p>
                        </div>
                        <div class="user_name mbr-bold pb-2 mbr-fonts-style display-7">
                            Hanun
                        </div>
                        <div class="user_desk mbr-light mbr-fonts-style display-7">
                            DEVELOPER
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="user col-md-12">
                    <br>
                        <img src="../../assets/profil/hanun.jpg" class="rounded-circle" style="width:220px;height:220px;border;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" alt="Cinque Terre">
                        <br>
                        <br>
                        <div class="user_text pb-3">
                            <p class="mbr-fonts-style display-7">
                                Excellent client manager. He is always accurate, all promises are fulfilled, all questions get answers, the company presents very attentive and positive approach.
                            </p>
                        </div>
                        <div class="user_name mbr-bold pb-2 mbr-fonts-style display-7">
                            Edy
                        </div>
                        <div class="user_desk mbr-light mbr-fonts-style display-7">
                            FrontEnd Developer
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="user col-md-12">
                    <br>
                        <img src="../../assets/profil/edy.jpg" class="rounded-circle" style="width:220px;height:220px;border;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" alt="Cinque Terre">
                        <div class="user_text pb-3">
                        <br>
                        <br>
                            <p class="mbr-fonts-style display-7">
                                Excellent client manager. He is always accurate, all promises are fulfilled, all questions get answers, the company presents very attentive and positive approach.
                            </p>
                        </div>
                        <div class="user_name mbr-bold pb-2 mbr-fonts-style display-7">
                            Zulfa
                        </div>
                        <div class="user_desk mbr-light mbr-fonts-style display-7">
                            FrontEnd Developer
                        </div>
                    </div>
                </div>
                </div>

            <div class="carousel-controls">
                <a class="carousel-control-prev" role="button" data-slide="prev" href="#testimonials-slider1-3">
                  <span aria-hidden="true" class="mbri-arrow-prev mbr-iconfont"></span>
                  <span class="sr-only">Previous</span>
                </a>
                
                <a class="carousel-control-next" role="button" data-slide="next" href="#testimonials-slider1-3">
                  <span aria-hidden="true" class="mbri-arrow-next mbr-iconfont"></span>
                  <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</div>
</section>

<script src="assets/web/assets/jquery/jquery.min.js"></script>
<script src="assets/popper/popper.min.js"></script>
<script src="assets/tether/tether.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/dropdown/js/script.min.js"></script>
  <script src="assets/touch-swipe/jquery.touch-swipe.min.js"></script>
  <script src="assets/bootstrap-carousel-swipe/bootstrap-carousel-swipe.js"></script>
  <script src="assets/smooth-scroll/smooth-scroll.js"></script>
  <script src="assets/theme/js/script.js"></script>
  <script src="assets/formoid/formoid.min.js"></script>
</div>

  </div>
</div>

<br>
<br>

