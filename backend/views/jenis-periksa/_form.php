<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\JenisPeriksa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jenis-periksa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'jenisPeriksaNama')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
