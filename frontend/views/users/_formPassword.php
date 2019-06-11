<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>

    

    <?= $form->field($model2, 'username')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model2, 'userNama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model2, 'userEmail')->passwordInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
