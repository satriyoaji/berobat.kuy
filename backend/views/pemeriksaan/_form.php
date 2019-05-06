<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Pemeriksaan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pemeriksaan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pendaftranID')->textInput() ?>

    <?= $form->field($model, 'pemeriksaanHasil')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jenisPeriksaID')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
