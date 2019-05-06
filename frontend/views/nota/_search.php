<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\NotaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nota-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'notaID') ?>

    <?= $form->field($model, 'kasirID') ?>

    <?= $form->field($model, 'notaTotalHarga') ?>

    <?= $form->field($model, 'pemeriksaanID') ?>

    <?= $form->field($model, 'resepID') ?>

    <?php // echo $form->field($model, 'notaStatus') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
