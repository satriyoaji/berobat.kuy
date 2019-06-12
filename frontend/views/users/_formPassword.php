<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form text-center">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model2, 'username')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model2, 'userNama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model2, 'userEmail')->passwordInput(['maxlength' => true]) ?>

    <br>
    <div class="form-group text-center">
        <?= Html::submitButton('Ganti Password', ['class' => 'btn bg-primary', 'style' => 'color:white']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
