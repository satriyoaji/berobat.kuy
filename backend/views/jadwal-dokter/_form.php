<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Users;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\JadwalDokter */
/* @var $form yii\widgets\ActiveForm */
$query = (new Query())
    ->from('Users')
    ->where(['userPekerjaan'=>'2']);

$listData=query::map($categories,'id','name');
?>

<div class="jadwal-dokter-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dokterID')->textInput() ?>

    <?= $form->field($model, 'jadwalWaktu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jadwalKuota')->textInput() ?>

    <?= $form->field($model, 'jadwalRuangan')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
