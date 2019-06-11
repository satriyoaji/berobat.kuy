<?php
/* @var $this yii\web\View */
use yii\helpers\Html; 
use yii\helpers\Url;
use yii\db\Query;
$this->title = 'Si Klinik';
?>
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