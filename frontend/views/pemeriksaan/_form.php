<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Jenisperiksa;
use yii\helpers\ArrayHelper;
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $model frontend\models\Pemeriksaan */
/* @var $form yii\widgets\ActiveForm */

if(Yii::$app->request->pathInfo == 'pemeriksaan/update'){
    $_SESSION['pemeriksaanID'] = $_GET['id'];
    $_SESSION['pendaftaranID'] = $_GET['pendaftaranID'];
}else if (Yii::$app->request->pathInfo == 'pemeriksaan/create'){
    $_SESSION['pendaftaranID'] = $_GET['id'];
}

/*if (isset($_SESSION['resepID']))
    unset($_SESSION['resepID']);*/

$categories=Jenisperiksa::find()->all();

$listData=ArrayHelper::map($categories,'jenisPeriksaID','jenisPeriksaNama');

?>

<div class="pemeriksaan-form col-lg-10">

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
            ->where(['pendaftaranID'=>$_SESSION['pendaftaranID']]); //mencari jumlah resep hasil pemeriksaan sebelumnya
        foreach($verifikasiResep->each() as $verifikasi){
            $banyak = $verifikasi['count(*)'];
        }
        if($banyak == 0){ //jika ga ditemukan?>
        <tr>
            <th colspan="5"><center> Belum Ada Resep </center></th>
        </tr>
        <?php } else { //jika data ditemukan ( lbh dari 0 ) maka tampilkan resep
            $i=1;
            $resepQuery = (new Query())
                ->from('resep')
                ->where(['pendaftaranID'=>$_SESSION['pendaftaranID']]);
            //var_dump( $resepQuery); //kalau mau query all bisa ditambahkan di akhir statement SQL, tapi foreachnya GAPAKE DI EACH()
            foreach($resepQuery->each() as $resep){ //hasilnya cmn 1
                $idResep = $resep['resepID'];
                $_SESSION['resepID'] = $resep['resepID'];
            }
            $detailResepQuery = (new Query())
                ->from('detailresep')
                ->where(['resepID'=>$idResep])
                ->all();

            foreach($detailResepQuery as $detailResep){
                $obatQuery = (new Query())
                    ->from('obat')
                    ->where(['obatID'=>$detailResep['obatID']]);
                foreach($obatQuery->each() as $obat){ //bisa banyak?>
                <tr>
                    <th><?php echo $i; $i++; ?></th>
                    <th><?php echo $obat['obatNama'] ?></th>
                    <th><?php echo $detailResep['detailResepQuantity'] ?></th>
                    <th><?php echo $detailResep['detailResepDosis'] ?></th>
                    <th><?php echo $obat['obatGolongan'] ?></th>
                </tr>
                <?php }
                }
            }?>

    </tbody>
    </table>

    <div class="form-group">
            <td><?php if($banyak==0){ //jika belum ada resep
                    echo Html::a('Berikan Resep', ['resep/create', 'id' => $_GET['id']], ['class' => 'btn bg-primary', 'style'=>'color:white','data' => [

                    'method' => 'post',],]);
                } else{ //jika sudah ada resep
                    echo Html::a('Tambahkan Obat', ['detailresep/tambah', 'id' => $_GET['id']], ['class' => 'btn bg-primary', 'style'=>'color:white','data' => [

                        'method' => 'post',],]);
                }
                ?>
            </td>

        <?php if(isset($_SESSION['resep'])){    //untuk update ?>
            <td><?= Html::a('Done', ['pendaftaran/listharian', 'status'=> 1], ['class' => 'btn bg-info', 'style'=>'color:white','data' => [
                            'confirm' => ' Benar Ingin Menyelesaikan Pemeriksaan ini?',
                            'method' => 'post',],]) ?></td>
        <?php
        } else { ?>
                <td><?= Html::submitButton('Done', ['class' => 'btn bg-info', 'style'=>'color:white','data' => [
                                'confirm' => ' Benar Ingin Menyelesaikan Pemeriksaan ini?',
                                'method' => 'post',],]) ?></td>
        <?php } ?>


    </div>

    <?php ActiveForm::end(); ?>

</div>
