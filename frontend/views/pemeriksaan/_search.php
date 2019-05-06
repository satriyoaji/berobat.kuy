<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PemeriksaanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pemeriksaan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pemeriksaanID') ?>

    <?= $form->field($model, 'pendaftranID') ?>

    <?= $form->field($model, 'pemeriksaanHasil') ?>

    <?= $form->field($model, 'jenisPeriksaID') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
