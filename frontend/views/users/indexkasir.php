<?php
/* @var $this yii\web\View */
use yii\helpers\Html; 
use yii\helpers\Url;
use yii\db\Query;
$this->title = 'Si Klinik';
?>
<div class="container text-center">
    <div class="col-xl-12 col-md-12 align-self-center">
        <div class="single_feature_text ">
            <h4><span><img src="../../assets/icon/kasir2.jpg" width="60%" alt=""></span></h4>
        </div>
    </div>
</div>
    <div class="comments-create">
        <?php if (isset($model)) {
            echo $this->render('cari', ['model' => $model]);
        }
        ?>
    <!--  HALAMAN INI TERHUBUNG DGN views/users/cari  -->
    </div>
        <?php 
        if(isset($_SESSION['cari'])){
        ?>
        <div class="container mt-5">
            <div class="row">
                <table class="table text-center table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Code</th>
                        <th scope="col">Jumlah Harga</th>
                        <th scope="col">Info</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    $nota = (new Query())
                        ->select('*')
                        ->from('nota')
                        ->where(['code'=>$_SESSION['cari']])
                        ->one();

                    $resep = (new Query())
                        ->select('*')
                        ->from('resep')
                        ->where(['resepID'=>$nota['resepID']])
                        ->one();
                    ?>
                    <?php if ($nota!=false): ?>
                    <tr>
                        <td><?php echo $i; $i++;?></td>
                        <td><?php echo $nota['code'];?></td>
                        <td>Rp. <?php echo $nota['notaTotalHarga'];?></td>
                        <?php if (($nota['notaStatus'] == 'sudah bayar') && ($nota['kasirID'] == null)):
                        $_SESSION['kasirID'] = Yii::$app->user->id;
                            if (isset($nota['resepID'])):
                                if (isset($resep['apotekerID'])): //untuk nota pembayaran resep/obat jika sudah dibuat apoteker?>
                                    <td><?= Html::a('Proses transaksi', ['nota/update','id'=>$nota['notaID'], 'kasirProcess'=>1], ['class' => 'btn btn-outline-success']) ?></td>
                                <?php else:?>
                                    <td><?= Html::a('Resep/obat dari transaksi ini belum dibuat', null, ['class' => 'btn btn-outline-danger']) ?></td>
                                <?php endif;
                            else:
                            //dibawah ini untuk nota pembayaran pemeriksaan ?>
                                <td><?= Html::a('Proses transaksi', ['nota/update','id'=>$nota['notaID'], 'kasirProcess'=>1], ['class' => 'btn btn-outline-success']) ?></td>
                            <?php endif; ?>
                        <?php elseif($nota['notaStatus'] != 'sudah bayar'): ?>
                            <td><?= Html::a('Transaksi ini belum dibayarkan', null, ['class' => 'btn btn-outline-danger']) ?></td>
                        <?php elseif(isset($nota['kasirID'])) : ?>
                            <td><?= Html::a('Transaksi ini telah diselesaikan', null, ['class' => 'btn btn-outline-info']) ?></td>
                        <?php endif; ?>
                    </tr>
                    <?php else: ?>
                        <tr>
                            <td>#</td>
                            <td colspan="3" class="text-danger">Code Nota tidak ditemukan</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>

            </div>
        </div>
        <?php 
        unset($_SESSION['cari']);
        } ?>

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