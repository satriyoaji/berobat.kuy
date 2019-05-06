<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\DetailresepSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="detailresep-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'detailResepID') ?>

    <?= $form->field($model, 'obatID') ?>

    <?= $form->field($model, 'detailResepDosis') ?>

    <?= $form->field($model, 'resepID') ?>

    <?= $form->field($model, 'detailResepQuantity') ?>

    <?php // echo $form->field($model, 'detailResepSubtotal') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
