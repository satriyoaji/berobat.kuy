<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'userNama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'userPassword')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'userEmail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'userTelephone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'userAlamat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'userPekerjaan')->textInput() ?>

    <?= $form->field($model, 'userFoto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'userTanggalLahir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'userJenisKelamin')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
