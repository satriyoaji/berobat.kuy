<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\UsersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'userId') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'userNama') ?>

    <?= $form->field($model, 'userPassword') ?>

    <?= $form->field($model, 'userEmail') ?>

    <?php // echo $form->field($model, 'userTelephone') ?>

    <?php // echo $form->field($model, 'userAlamat') ?>

    <?php // echo $form->field($model, 'userPekerjaan') ?>

    <?php // echo $form->field($model, 'userFoto') ?>

    <?php // echo $form->field($model, 'userTanggalLahir') ?>

    <?php // echo $form->field($model, 'userJenisKelamin') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
