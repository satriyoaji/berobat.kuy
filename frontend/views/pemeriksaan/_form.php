<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Jenisperiksa;
use yii\helpers\ArrayHelper;
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $model frontend\models\Pemeriksaan */
/* @var $form yii\widgets\ActiveForm */
$_SESSION['pendaftaranID'] = $_GET['id'];

$categories=Jenisperiksa::find()->all();

$listData=ArrayHelper::map($categories,'jenisPeriksaID','jenisPeriksaNama');
?>

<div class="pemeriksaan-form">

    <?php $form = ActiveForm::begin(); ?>

    <div = hidden>
    <?= $form->field($model, 'pendaftranID')->textInput(['value' => $_SESSION['pendaftaranID']]) ?>
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
        <?php if(!isset($_SESSION['resep'])){ ?>
        <tr>
            <th colspan="5"><center> Belum Ada Resep </center></th>
        </tr>
        <?php } else {
            $i=1;
            $resepQuery = (new Query())
                ->from('detailresep')
                ->where(['resepID'=>$_SESSION['resep']]);
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
        <?php if(isset($_SESSION['pemeriksaan'])){ ?>
            <td><?= Html::a('Done', ['obat/listobat'], ['class' => 'btn btn-success','data' => [
                            'confirm' => ' Benar Ingin Menyelesaikan Pemeriksaan ini?',
                            'method' => 'post',],]) ?></td>
        <?php } else { ?>
            <?= Html::submitButton('Done', ['class' => 'btn btn-success','data' => [
                            'confirm' => ' Benar Ingin Menyelesaikan Pemeriksaan ini?',
                            'method' => 'post',],]) ?></td>
        <?php } ?>
        
        <?= Html::submitButton('Tambah Obat', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
