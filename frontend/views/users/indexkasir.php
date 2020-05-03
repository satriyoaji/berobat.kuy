<?php
/* @var $this yii\web\View */
use yii\helpers\Html; 
use yii\helpers\Url;
use yii\db\Query;
$this->title = 'Si Klinik';
?>
<div class="comments-create">
    <?php if (isset($model)) {
        echo $this->render('cari', ['model' => $model]);
    }
    ?>
</div>

        <?php 
        if(isset($_SESSION['cari'])){
        ?>
        <div class="container">
            <div class="row">
                <table class="table text-center">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Code</th>
                        <th scope="col">Jumlah Harga</th>
                        <th scope="col">Info</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
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
                        <td><?php echo $i; $i++;?></td>
                        <td><?php echo $nota['code'];?></td>
                        <td>Rp. <?php echo $nota['notaTotalHarga'];?></td>
                        <?php if (($nota['notaStatus'] == 'sudah bayar') && ($nota['kasirID'] == null)):
                        $_SESSION['kasirID'] = Yii::$app->user->id;
                            if (isset($nota['resepID'])):
                                if (isset($resep['apotekerID'])): //untuk nota pembayaran resep/obat jika sudah dibuat apoteker?>
                                    <td><?= Html::a('Proses transaksi', ['nota/update','id'=>$nota['notaID'], 'kasirProcess'=>1], ['class' => 'btn btn-success']) ?></td>
                                <?php else:?>
                                    <td><?= Html::a('Resep/obat dari transaksi ini belum dibuat', null, ['class' => 'btn btn-info bg-light']) ?></td>
                                <?php endif;
                            else:
                            //dibawah ini untuk nota pembayaran pemeriksaan ?>
                                <td><?= Html::a('Proses transaksi', ['nota/update','id'=>$nota['notaID'], 'kasirProcess'=>1], ['class' => 'btn btn-success']) ?></td>
                            <?php endif; ?>
                        <?php elseif($nota['notaStatus'] != 'sudah bayar'): ?>
                            <td><?= Html::a('Transaksi ini belum dibayarkan', null, ['class' => 'btn btn-info bg-light']) ?></td>
                        <?php elseif(isset($nota['kasirID'])) : ?>
                            <td><?= Html::a('Transaksi ini telah diselesaikan', null, ['class' => 'btn btn-primary', 'style' => 'color: green']) ?></td>
                        <?php endif; ?>
                    </tr>
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