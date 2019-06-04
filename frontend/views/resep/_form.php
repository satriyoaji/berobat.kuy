<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Resep */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="resep-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'apotekerID')->textInput() ?>

    <?= $form->field($model, 'pendaftaranID')->textInput() ?>

    <?= $form->field($model, 'resepStatus')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resepTotalHarga')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
