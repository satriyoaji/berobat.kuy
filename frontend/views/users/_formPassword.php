<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>

    

    <?= $form->field($model, 'userAlamat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'userTanggalLahir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'userTelephone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'userJenisKelamin')->dropDownList(
            ['Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan']
    ); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>