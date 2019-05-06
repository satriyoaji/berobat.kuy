<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Pendaftaran */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pendaftaran-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pasienID')->textInput() ?>

    <?= $form->field($model, 'dokterID')->textInput() ?>

    <?= $form->field($model, 'pendaftaranTanggal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pendaftaranStatus')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
