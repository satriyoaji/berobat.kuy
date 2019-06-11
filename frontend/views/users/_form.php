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

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'userEmail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'userJenisKelamin')->dropDownList(
            ['Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan']
    ); ?>
    <br>
    <div class="form-group text-center">
        <?= Html::submitButton('DAFTAR', ['class' => 'btn bg-primary', 'name' => 'login-button', 'style'=>'color:white']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
