<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Nota */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nota-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kasirID')->textInput() ?>

    <?= $form->field($model, 'notaTotalHarga')->textInput() ?>

    <?= $form->field($model, 'pemeriksaanID')->textInput() ?>

    <?= $form->field($model, 'resepID')->textInput() ?>

    <?= $form->field($model, 'notaStatus')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
