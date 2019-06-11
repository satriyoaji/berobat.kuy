<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Nota */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nota-form">

    <?php $form = ActiveForm::begin(); ?>

    <div = hidden>
    <?= $form->field($model, 'kasirID')->textInput(['value'=>Yii::$app->user->id]) ?>

    

    <?= $form->field($model, 'pemeriksaanID')->textInput() ?>

    <?= $form->field($model, 'resepID')->textInput() ?>
    </div>

    <?= $form->field($model, 'notaTotalHarga')->textInput() ?>

    <?= $form->field($model, 'notaStatus')->dropDownList(
            ['Belum dibayar' => 'Belum dibayar', 'Sudah Bayar' => 'Sudah Bayar']
    ); ?>

    <div class="form-group">
        <?= Html::submitButton('Bayar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
