<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Jenisperiksa;
use yii\helpers\ArrayHelper;

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

    
    <div class="form-group">
        <?= Html::submitButton('Tambah Obat', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
