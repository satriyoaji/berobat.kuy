<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Detailresep */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="detailresep-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'obatID')->textInput() ?>

    <?= $form->field($model, 'detailResepDosis')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resepID')->textInput() ?>

    <?= $form->field($model, 'detailResepQuantity')->textInput() ?>

    <?= $form->field($model, 'detailResepSubtotal')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
