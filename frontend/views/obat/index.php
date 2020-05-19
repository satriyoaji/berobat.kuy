<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\Obat;
use frontend\models\Pendaftaran;
use yii\db\Query;
use yii\web\Linkable;
use yii\data\Pagination;
use yii\widgets\LinkPager;
use yii\db\ActiveQuery;
use yii\widgets\ActiveForm;
use frontend\models\Detailresep;
use frontend\models\Nota;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ObatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
//
$pendaftaranQuery=(new Query()) //ambil pendaftaranID
->select('pendaftaranID')
    ->from('pendaftaran')
    ->where('pasienID = :pasienID', [':pasienID' => Yii::$app->user->id])
    ->all();
$countQuery = 0;
foreach($pendaftaranQuery as $row){
    $pendaftaranID[$countQuery] = $row['pendaftaranID']; //ambil ID pendaftaran

    $resepQuery=(new Query())
        ->from('resep')
        ->where('pendaftaranID = :pendaftaranID', [':pendaftaranID' => $row['pendaftaranID']])
        ->one();  //1 pendaftaran/pemeriksaan hanya punya 1 resep. kelemahannya kalau ada pendaftaran yag baru diperiksa,
    //  maka hanya bisa ambil daya trakhir (resep dari pendaftaran sebelume meskipun blm diproses gaisa diambil).
    // jadi tiap pemeriksaan kudu nyelesaikan transaksi resepnya
    $resepsID[$countQuery]=$resepQuery['resepID'];

    $countQuery++;
}
for ($i = 0; $i<$countQuery; $i++){
    if ($resepsID[$i] != null)
        $resepID = $resepsID[$i];   //ambil resep ID dari pendaftaranID terakhir
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="http://localhost/siklinik/frontend/assets/css/bootstrap.css">
</head>
<div class="obat-index">
    <div id="carousel-example-multi" class="carousel slide carousel-multi-item v-2" data-ride="carousel">
        <div class="container">
            <div class="row">

                <div class="col-lg-3">
                    <br>
                    <div class="kategori" style="backgroud-colour:red">
                        <h4>Kategori</h4>
                    </div>
                    <hr>
                    <ul class="list-group">
                        <?php $countObat = 0;
                        $obatQuery=(new Query())
                            ->from('obat')
                            ->where(['obatGolongan' => 'ringan'])
                            ->all();
                        foreach ($obatQuery as $obatQ){
                            $countObat++;
                        } ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?= Html::a("Obat Ringan",['obat/index','id'=>'ringan'],['class' =>'list-group-item']) ?>
                            <span class="badge badge-primary badge-pill"><?= $countObat; ?></span>
                        </li>
                        <?php $countObat = 0;
                        $obatQuery=(new Query())
                            ->from('obat')
                            ->where(['obatGolongan' => 'sedang'])
                            ->all();
                        foreach ($obatQuery as $obatQ){
                            $countObat++;
                        } ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?= Html::a("Obat Sedang",['obat/index','id'=>'sedang'],['class' =>'list-group-item']) ?>
                            <span class="badge badge-primary badge-pill"><?= $countObat; ?></span>
                        </li>
                        <?php $countObat = 0;
                        $obatQuery=(new Query())
                            ->from('obat')
                            ->where(['obatGolongan' => 'keras'])
                            ->all();
                        foreach ($obatQuery as $obatQ){
                            $countObat++;
                        } ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?= Html::a("Obat Keras",['obat/index','id'=>'keras'],['class' =>'list-group-item']) ?>
                            <span class="badge badge-primary badge-pill"><?= $countObat; ?></span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php if($resepID == null){?>
                                <?= Html::a("Resep Saya", ['detailresep/index','ids'=>$resepsID], ['class' =>'list-group-item','data' => [
                                    'confirm' => ' maaf anda belum melakukan pemeriksaan?',
                                    'method' => 'post',],]) ?>
                            <?php } else { ?>
                                <?= Html::a("Resep Saya",['detailresep/index','ids'=>$resepsID],['class' =>'list-group-item']) ?>
                            <?php }  ?>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-9">

                    <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active">
                                <img class="d-block img-fluid" src="../../../assets/promo1.jpg" alt="First slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block img-fluid" src="../../../assets/promo2.jpg" alt="Second slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block img-fluid" src="../../../assets/promo3.jpg" alt="Third slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>

                    <div class="container">
                        <div class="row">
                            <?php if (isset($_SESSION['paid'])): ?>
                                <div class="alert alert-success col-md-12" role="alert">
                                    Pengambilan obat telah berhasil! silahkan di ambil pada loket apotek
                                    atau bisa hubungi <a href="https://api.whatsapp.com/send?phone=6287754478760&text=halo&source=&data=" target="_blank"> kontak ini</a>
                                </div>
                                <?php unset($_SESSION['paid']);
                            endif; ?>
                        </div>
                    </div>

                    <div class="row">
                        <?php
                        // di bawah ini akan menampung semoa obatID pada seluruh resep si pasien yg login
                        $detailreseps = Detailresep::find()
                            ->where(['resepID' => $resepID])
                            ->all();
                        $count = 0;
                        foreach ($detailreseps as $detailresep){
                            $listObatID[$count] = $detailresep['obatID'];
                            $count++;
                        }
                        //
                        $nota = Nota::find()
                            ->where(['resepID' => $resepID])
                            ->one();
                        //
                        $obatID=0;
                        $post=$dataProvider->getModels();
                        //var_dump($post);
                        foreach ($post as $rows):
                            ?>

                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card h-100">
                                    <img  src="<?= Yii::$app->request->baseUrl.'/img/obat/'.$rows['obatFoto'];?>" class="card-img-top">
                                    <div class="card-body">
                                        <h4 class="card-title">
                                        <h6><b><?= strtoupper($rows['obatNama']);?></b></h6>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#<?= $rows['obatID']; ?>">detail obat</button>
                                        <?php if ($pendaftaranQuery == null){ ?>
                                            <p><?= Html::a('Buat Order', ['obat/index'], ['class' => 'btn btn-success','data' => [
                                                    'confirm' => ' maaf anda belum melakukan pendaftaran?',
                                                    'method' => 'post',],]) ?></p>
                                        <?php } else if($resepID == null){?>
                                            <p><?= Html::a('Buat order', ['obat/index'], ['class' => 'btn btn-success','data' => [
                                                    'confirm' => ' maaf anda belum melakukan pemeriksaan?',
                                                    'method' => 'post',],]) ?></p>
                                        <?php } else if(!(in_array($rows['obatID'], $listObatID))){?>
                                            <p><?= Html::a('Buat order', ['obat/index'], ['class' => 'btn btn-success','data' => [
                                                    'confirm' => ' maaf obat ini tidak ada dalam list resep terbaru Anda',
                                                    'method' => 'post',],]) ?></p>
                                        <?php }
                                        else if((in_array($rows['obatID'], $listObatID)) && ($nota['kasirID'] == null)){ // hanya obat yg ada dalam detail resepnya & yg belum Dikonfirmasi kasir jadi gabisa ambil?>
                                            <p> <?= Html::a('Ambil obat', ['obat/index','idObat'=>$rows['obatID'],'resepID'=>$resepID], ['class' => 'btn btn-success','data' => [
                                                    'confirm' => 'maaf pembayaran anda sedang diproses oleh kasir, silahkan datangi untuk melakukan konfirmasi',
                                                    'method' => 'post',],]) ?></p>
                                        <?php }
                                        else if((in_array($rows['obatID'], $listObatID)) && ($nota['kasirID'] != null)){ //hanya obat yg ada dalam detail resepnya & yg sudah Dikonfirmasi kasir jadi bisa diambil ?>
                                            <p> <?= Html::a('Ambil obat', ['obat/take-pill','idObat'=>$rows['obatID']], ['class' => 'btn btn-success', 'data' => [
                                                    'confirm' => 'Apakah anda yakin mengambil obat sekarang ?']]) ?></p>
                                        <?php }?>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="<?= $rows['obatID']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"><?php echo $rows['obatNama'];?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <br>
                                            <div class="text-center">
                                                <img  src="<?= Yii::$app->request->baseUrl.'/img/obat/'.$rows['obatFoto'];?>" class="card-img-top">
                                            </div>
                                            <div class="row">

                                                <div class="product_content" style="padding-left:18px;padding-right:18px;">
                                                    <br>
                                                    <h6><?php echo $rows['obatDeskripsi'];?></h6>
                                                    <h6 class="cost text-right">Harga : <b><span class="glyphicon glyphicon-usd"></span>Rp.<?php echo $rows['obatHarga'];?></b></h6>
                                                    <div class="row">
                                                    </div>
                                                    <div class="space-ten"></div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endforeach; ?>
                    </div>
                    <!-- /.row -->
                    <center><?php echo LinkPager::widget(['pagination' => $dataProvider->pagination,]); ?> </center>
                </div>
                <!-- /.col-lg-9 -->


            </div>
            <!-- /.col-lg-3 -->


        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->
</div>

</html>
