<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Pekerjaan;

/* @var $this yii\web\View */
/* @var $model frontend\models\Users */
/* @var $form yii\widgets\ActiveForm */
$categories=Pekerjaan::find()->all();

$listData=ArrayHelper::map($categories,'pekerjaanID','pekerjaanNama');
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'userNama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'userEmail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'userPekerjaan')->dropDownList(
		 $listData,
        ['pekerjaanID'=>'pekerjaanNama']) ?>

    <?= $form->field($model, 'userJenisKelamin')->dropDownList(
            ['Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan']
    ); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
