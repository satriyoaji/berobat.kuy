<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $model frontend\models\Detailresep */
/* @var $form yii\widgets\ActiveForm */
$id = $_GET['id'];
?>

<div class="detailresep-form">

    
    <?php $form = ActiveForm::begin(); ?>

    <div = hidden>
    <?= $form->field($model, 'obatID')->textInput(['value'=>$id]) ?>
    </div>

    <?= $form->field($model, 'detailResepDosis')->textInput(['maxlength' => true]) ?>

    <div = hidden>
    <?= $form->field($model, 'resepID')->textInput(['value'=>$_SESSION['resep']]) ?>
    </div>

    <?= $form->field($model, 'detailResepQuantity')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
