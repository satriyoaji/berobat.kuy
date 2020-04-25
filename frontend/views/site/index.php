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
<div class="site-index">
    <div class="body" style="padding-top:40px;">
    <br>
    <br>
    <?php 
         if($_SESSION['userCategory'] >=5){
    // buat tampilan Dokter?>
    
    
    <?php } else if($_SESSION['userCategory']==4){ ?>

        <div class="comments-create">
            <?= $this->render('cari', ['model' => $model]) //menginclude kan views/cari ?>
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
                    <div class="deskrpsi">Aplikasi “Berobat.kuy” merupakan platform web based yang bergerak di bidang medical checkup.
                        di sini kami memiliki prioritas utama untuk kesehatan dan kenyamanan pengguna.
                    </div>
                    <div class="text-center">
                        <br>
                        <br>
                        <a href="#fitur" class="btn btn-primary btn-lg" role="button" aria-pressed="true">Get Started</a>
                        <br>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-light btn-outline-primary bg-light" data-toggle="modal" data-target="#projectOwnerTeam">
                            Project Team
                        </button>
                    </div>
                </div>
            </div>
        </div>
        </div>

    <!-- Modal -->
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
                    <div id="carousel-example-2" class="carousel slide carousel-fade z-depth-1-half" data-ride="carousel">
                        <!--Indicators-->
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-2" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-2" data-slide-to="1"></li>
                            <li data-target="#carousel-example-2" data-slide-to="2"></li>
                            <li data-target="#carousel-example-2" data-slide-to="3"></li>
                        </ol>
                        <!--/.Indicators-->
                        <!--Slides-->
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active">
                                <div class="view w-75">
                                    <img class="d-block w-75 text-center" src="../../assets/profil/profilAji.jpg" alt="First slide">
                                    <div class="mask rgba-black-strong"></div>
                                </div>
                                <div class="carousel-caption">
                                    <h3 class="h3-responsive text-dark">Aji </h3>
                                    <p class="text-dark">as a Project Owner</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <!--Mask color-->
                                <div class="view w-75">
                                    <img class="d-block w-75 text-center" src="../../assets/profil/profilEkky.jpg" alt="Second slide">
                                    <div class="mask rgba-black-slight"></div>
                                </div>
                                <div class="carousel-caption">
                                    <h3 class="h3-responsive text-dark">Ekky</h3>
                                    <p class="text-dark">as Frontend Dev</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <!--Mask color-->
                                <div class="view w-75">
                                    <img class="d-block w-75 text-center" src="../../assets/profil/profilAan.jpg" alt="Third slide">
                                    <div class="mask rgba-black-slight"></div>
                                </div>
                                <div class="carousel-caption">
                                    <h3 class="h3-responsive text-dark">Aan</h3>
                                    <p class="text-dark">as Backend dev</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <!--Mask color-->
                                <div class="view w-75">
                                    <img class="d-block w-75 text-center" src="../../assets/profil/profilFaidza.jpg" alt="Fourth slide">
                                    <div class="mask rgba-black-slight"></div>
                                </div>
                                <div class="carousel-caption">
                                    <h3 class="h3-responsive text-dark">Faidza</h3>
                                    <p class="text-dark">as UI/UX</p>
                                </div>
                            </div>
                        </div>
                        <!--/.Slides-->
                        <!--Controls-->
                        <a class="carousel-control-prev" href="#carousel-example-2" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel-example-2" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                        <!--/.Controls-->
                    </div>
                    <!--/.Carousel Wrapper-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
    <h1 align="center" style="color:#67696b;">User Review</h1>
    <br>
</div> 

<div class="col-md-12 text-center" style="padding-left:90px;">
    <div class="card" style="width: 60rem; padding-left:20px;">
      <div class="card-body mb-4 pb-3">
         <section class="carousel slide testimonials-slider cid-qyvf5AQs7c" id="testimonials-slider1-3" data-rv-view="767">
            <div class="container text-center">
                <div class="carousel slide" data-ride="carousel" role="listbox">
                    <div class="carousel-inner">
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
                        <?php if ($count==1): ?>
                        <div class="carousel-item active">
                        <?php else: ?>
                        <div class="carousel-item">
                        <?php endif;?>
                            <div class="user col-md-12 mb-3">
                            <br>
                                <?php if (!isset($usersQuery['userFoto'])):?>
                                    <img src="../assets/img/profil.png" alt="Avatar" class="rounded-circle" style="width:200px;height:200px;border;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                <?php else:?>
                                    <img src="../assets/img/user/<?= $usersQuery['userFoto']; ?>" alt="Avatar" class="rounded-circle" style="width:220px;height:220px;border;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                <?php endif;?>
                                <div class="user_text pb-3">
                                <br>
                                    <p class="mbr-fonts-style display-7">
                                        "<?= $comment['review'] ?>"
                                    </p>
                                </div>
                                <div class="user_name text-primary mbr-bold pb-2 mbr-fonts-style display-7">
                                    <strong>- <?= $usersQuery['userNama'] ?></strong>
                                </div>
                                <div class="user_desk mbr-light mbr-fonts-style display-7">
                                </div>
                            </div>
                        </div>
                        <?php $count++;
                        endforeach;?>
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
    </div>
    <div class="pt-2 mt-3">
        <?= Html::a('Beri review', ['comment/create'], ['class' => 'btn btn-success btn-outline-primary'])?></h3>
    </div>

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

<br>
<br>

