<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Obat */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="obat-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'obatNama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'obatHarga')->textInput() ?>

    <?= $form->field($model, 'obatGolongan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
