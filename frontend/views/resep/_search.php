<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ResepSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="resep-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'resepID') ?>

    <?= $form->field($model, 'resepTanggal') ?>

    <?= $form->field($model, 'dokterID') ?>

    <?= $form->field($model, 'pendaftaranID') ?>

    <?= $form->field($model, 'apotekerID') ?>

    <?php // echo $form->field($model, 'resepStatus') ?>

    <?php // echo $form->field($model, 'resepTotalHarga') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
