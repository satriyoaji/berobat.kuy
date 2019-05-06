<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\JadwaldokterSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jadwaldokter-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'jadwalID') ?>

    <?= $form->field($model, 'dokterID') ?>

    <?= $form->field($model, 'jadwalWaktu') ?>

    <?= $form->field($model, 'jadwalKuota') ?>

    <?= $form->field($model, 'jadwalRuangan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
