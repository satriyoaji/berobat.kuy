<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\db\Query;
use frontend\models\Nota;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\DetailresepSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<?php
if (isset($_GET['ids']))
  $resepsID=$_GET['ids'];
else
  $resepID=$_GET['id'];
?>
<div>
    <br>
    <h1 style="padding-left:10px;">Resep </h1>
    <div class="col-md-4">
        <hr>
        </div>
        <div class="detailResep" style="padding-left:10px;">
            <i>
            </i>
        </div>
        <br>
    </div>
    <div class="detailresep-index">
    <?php if (isset($resepID)){     //untuk content apoteker
        $resepQuery=(new Query())
            ->select('*')
            ->from('resep')
            ->where('resepID = :resepID', [':resepID' => $resepID])
            ->one();
        $resepID=$resepQuery['resepID'];
        $dokterID=$resepQuery['dokterID'];
        $resepTanggal =$resepQuery['resepTanggal'];

        $dokterQuery=(new Query())
            ->from('users')
            ->where('userId = :userId', [':userId' => $dokterID])
            ->one();
        $namaDokter = $dokterQuery['userNama'];

        $total=0;
        $i =1;
    ?>
        <div class="accordion" id="accordionExample">
            <div class="card">
                <div class="card-header text-center" id="heading<?= $resepID;?>">
                    <div class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse<?= $resepID;?>" aria-expanded="true" aria-controls="collapse<?= $resepID;?>">
                            <div class="text-primary text-bold">
                                <h3>ID Resep :  <?= $resepID;?></h3>
                            </div>
                        </button>
                    </div>
                </div>
                <div id="collapse<?= $resepID;?>" class="collapse show" aria-labelledby="heading<?= $resepID;?>" data-parent="#accordionExample">
                    <div class="card-body">
                        <h5> Date : <?= $resepTanggal;?></h5><br>
                        <h5> Created by : <?= $namaDokter ?></h5><br>
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Obat</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Harga</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $detailresepQuery=(new Query())
                                ->select('*')
                                ->from('detailresep')
                                ->where('resepID = :resepID', [':resepID' => $resepID])
                                ->all();
                            foreach ($detailresepQuery as $row1) {
                            ?>
                            <td><?php echo $i;$i++?></td>
                            <?php
                            $obatQuery=(new Query())
                                ->select('obatNama,obatHarga')
                                ->from('obat')
                                ->where('obatID = :obatID', [':obatID' => $row1['obatID']]);
                            foreach($obatQuery->each() as $row2){ ?>
                                <td><?php echo $row2['obatNama'];?></td>
                                <td><?php echo $row1['detailResepQuantity'];?></td>
                                <?php $subTotal = $row1['detailResepSubtotal']?>
                                <td><?php echo "Rp ".$row1['detailResepSubtotal']." ,- " ;?></td>
                                <?php $total +=$subTotal;?>
                            <?php } ?>
                            </tbody>
                            <?php } ?>
                            <tfoot class="">
                            <tr>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col">TOTAL</th>
                                <th scope="col">Rp. <?php echo $total;?></th>
                            </tr>
                            <?php

                            $nota = Nota::find()
                                ->where(['resepID' => $resepID])
                                ->one();
                            if (isset($nota)){
                                if(($nota['notaStatus']) == 'belum dibayar') {
                                    ?>
                                    <tr align="center">
                                        <th colspan="4" scope="col"><?= Html::a('Belum dibayar oleh pasien',
                                                null,
                                                ['class' => 'btn btn-light btn-outline-danger']) ?></th>
                                    </tr>
                                    <?php
                                } else if(($nota['notaStatus']) == 'sudah bayar'){
                                    ?>
                                    <tr align="center">
                                        <th colspan="4" scope="col"><?= Html::a('Telah Dibayar', null ,
                                                ['class' => 'btn btn-light btn-outline-primary']) ?></th>
                                    </tr>
                                    <?php
                                }
                                ?>
                                <?php
                            } else{
                                ?>
                                <tr align="center">
                                    <th colspan="4" scope="col"><?= Html::a('Belum dilakukan pembayaran oleh pasien',
                                            null,
                                            ['class' => 'btn btn-light btn-outline-danger']) ?></th>
                                </tr>
                                <?php
                            } ?>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

  <?php } elseif (isset($resepsID)){    //untuk content pasien
  foreach ($resepsID as $resepID){
      $resepQuery=(new Query())
      ->select('*')
      ->from('resep')
      ->where('resepID = :resepID', [':resepID' => $resepID])
      ->one();
      $resepID=$resepQuery['resepID'];
      $dokterID=$resepQuery['dokterID'];
      $resepTanggal =$resepQuery['resepTanggal'];

      $dokterQuery=(new Query())
      ->from('users')
      ->where('userId = :userId', [':userId' => $dokterID])
      ->one();
      $namaDokter = $dokterQuery['userNama'];

      $total=0;
      $i =1;
  ?>

        <div class="accordion mb-3 pb-2" id="accordionExample">
            <div class="card">
                <div class="card-header text-center" id="heading<?= $resepID;?>">
                    <div class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse<?= $resepID;?>" aria-expanded="true" aria-controls="collapse<?= $resepID;?>">
                            <div class="text-primary text-bold">
                                <h3>ID Resep :  <?= $resepID;?></h3>
                            </div>
                        </button>
                    </div>
                </div>
                <div id="collapse<?= $resepID;?>" class="collapse show" aria-labelledby="heading<?= $resepID;?>" data-parent="#accordionExample">
                    <div class="card-body">
                        <h5> Date : <?= $resepTanggal;?></h5><br>
                        <h5> Created by : <?= $namaDokter ?></h5><br>
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Obat</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Harga</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $detailresepQuery=(new Query())
                                ->select('*')
                                ->from('detailresep')
                                ->where('resepID = :resepID', [':resepID' => $resepID])
                                ->all();
                            foreach ($detailresepQuery as $row1) {
                            ?>
                            <td><?php echo $i;$i++?></td>
                            <?php
                            $obatQuery=(new Query())
                                ->select('obatNama,obatHarga')
                                ->from('obat')
                                ->where('obatID = :obatID', [':obatID' => $row1['obatID']]);
                            foreach($obatQuery->each() as $row2){ ?>
                                <td><?php echo $row2['obatNama'];?></td>
                                <td><?php echo $row1['detailResepQuantity'];?></td>
                                <?php $subTotal = $row1['detailResepSubtotal']?>
                                <td><?php echo "Rp ".$row1['detailResepSubtotal']." ,- " ;?></td>
                                <?php $total +=$subTotal;?>
                            <?php } ?>
                            </tbody>
                            <?php } ?>
                            <tfoot class="">
                            <tr>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col">TOTAL</th>
                                <th scope="col">Rp. <?php echo $total;?></th>
                            </tr>
                            <?php

                            $nota = Nota::find()
                                ->where(['resepID' => $resepID])
                                ->one();
                            if (isset($nota)){
                                if(($nota['notaStatus']) == 'belum dibayar') {
                                    ?>
                                    <tr align="center">
                                        <th colspan="4" scope="col"><?= Html::a('Selesaikan Pembayaran',
                                                ['nota/update', 'id' => $nota['notaID']],
                                                ['class' => 'btn btn-success']) ?></th>
                                    </tr>
                                    <?php
                                } else if(($nota['notaStatus']) == 'sudah bayar'){
                                    ?>
                                    <tr align="center">
                                        <th colspan="4" scope="col"><?= Html::a('Telah Dibayar', null ,
                                                ['class' => 'btn btn-light btn-outline-primary']) ?></th>
                                    </tr>
                                    <?php
                                }
                                ?>
                                <?php
                            } else{
                                ?>
                                <tr align="center">
                                    <th colspan="4" scope="col"><?= Html::a('Lanjut Pembayaran',
                                            ['nota/create', 'id' => $resepID],
                                            ['class' => 'btn btn-success']) ?></th>
                                </tr>
                                <?php
                            } ?>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

      <?php }?>
    <?php }?>
    </div>
