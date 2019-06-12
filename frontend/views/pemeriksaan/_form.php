<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Jenisperiksa;
use yii\helpers\ArrayHelper;
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $model frontend\models\Pemeriksaan */
/* @var $form yii\widgets\ActiveForm */
if(!isset($_SESSION['pendaftaranID'])){
    $_SESSION['pendaftaranID'] = $_GET['id'];
    echo $_SESSION['pendaftaranID'];
}


$categories=Jenisperiksa::find()->all();

$listData=ArrayHelper::map($categories,'jenisPeriksaID','jenisPeriksaNama');

if(isset($_SESSION['pendaftaranID'])){
    echo $_SESSION['pendaftaranID'];
}
if(isset($_SESSION['resep'])){
    echo $_SESSION['resep'];
}
if(isset($_SESSION['pemeriksaan'])){
    echo $_SESSION['pemeriksaan'];
}
?>

<div class="pemeriksaan-form">

    <?php $form = ActiveForm::begin(); ?>

    <div = hidden>
    <?= $form->field($model, 'pendaftranID')->textInput(['value' => $_GET['id']]) ?>
    </div>

    <?= $form->field($model, 'jenisPeriksaID')->dropDownList(
		 $listData,
        ['jenisPeriksaID'=>'jenisPeriksaNama']) ?>

    <?= $form->field($model, 'pemeriksaanHasil')->textInput(['maxlength' => true]) ?>

    <table class="table table-striped">
    <thead>
        <tr>
        <th scope="col">No</th>
        <th scope="col">Nama Obat</th>
        <th scope="col">Banyak Obat</th>
        <th scope="col">Dosis</th>
        <th scope="col">Keterangan</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $verifikasiResep = (new Query())
            ->select('count(*)')
            ->from('resep')
            ->where(['pendaftaranID'=>$_SESSION['pendaftaranID']]);
        foreach($verifikasiResep->each() as $verifikasi){
            $banyak = $verifikasi['count(*)'];
        }
        if($banyak == 0){ ?>
        <tr>
            <th colspan="5"><center> Belum Ada Resep </center></th>
        </tr>
        <?php } else {
            $i=1;
            $resepQuery = (new Query())
                ->from('resep')
                ->where(['pendaftaranID'=>$_SESSION['pendaftaranID']]);
            foreach($resepQuery->each() as $resep){
                $id = $resep['resepID'];
            }
            $resepQuery = (new Query())
                ->from('detailresep')
                ->where(['resepID'=>$id]);
            foreach($resepQuery->each() as $resep){
                $obatQuery = (new Query())
                    ->from('obat')
                    ->where(['obatID'=>$resep['obatID']]);
                foreach($obatQuery->each() as $obat){?>
                <tr>
                    <th><?php echo $i; $i++; ?></th>
                    <th><?php echo $obat['obatNama'] ?></th>
                    <th><?php echo $resep['detailResepQuantity'] ?></th>
                    <th><?php echo $resep['detailResepDosis'] ?></th>
                    <th><?php echo $obat['obatGolongan'] ?></th>
                </tr>
                <?php }
                }
            }?>

    </tbody>
    </table>

    <div class="form-group">
        <?php if(isset($_SESSION['resep'])){ ?>
            <td><?= Html::a('Done', ['pendaftaran/listharian', 'status'=> 1], ['class' => 'btn btn-success','data' => [
                            'confirm' => ' Benar Ingin Menyelesaikan Pemeriksaan ini?',
                            'method' => 'post',],]) ?></td>
        <?php 
            
            
    } else { ?>
            <?= Html::submitButton('Done', ['class' => 'btn btn-success','data' => [
                            'confirm' => ' Benar Ingin Menyelesaikan Pemeriksaan ini?',
                            'method' => 'post',],]) ?></td>
        <?php } ?>
        <?= Html::submitButton('Tambah Obat', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
