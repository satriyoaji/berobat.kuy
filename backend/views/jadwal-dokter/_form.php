<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Users;
use yii\helpers\ArrayHelper;
use yii\db\ActiveQuery;
use yii\data\ActiveDataProvider;
use yii\db\Query;
//use yii\widgets\ActiveField::widget();

/* @var $this yii\web\View */
/* @var $model backend\models\JadwalDokter */
/* @var $form yii\widgets\ActiveForm */

$categories=Users::find('userPekerjaan'== '2')->all();
$listData=ArrayHelper::map($categories,'userId','userNama');
?>

<div class="jadwal-dokter-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dokterID')->dropDownList(
		 $listData,
        ['userId'=>'userNama']) ?>

    <?= $form->field($model, 'jadwalWaktu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jadwalKuota')->textInput() ?>

    <?= $form->field($model, 'jadwalRuangan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jadwalTanggal')->widget(\yii\jui\DatePicker::class, [
    //'language' => 'ru',
    //'dateFormat' => 'yyyy-MM-dd',
]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
