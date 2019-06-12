<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Comments */
/* @var $form yii\widgets\ActiveForm */
?>
<br>
<br>
<h3 style="color:grey" class="text-center">Masukkan Kode Transaksi</h3>

<div class="row">
    <div class="col-md-8">
        <div class="cari-form">
        <div class="form-label-group" style="padding-top: 7%">
            <div class="col-md-8 col-md-offset-2">
                <div id="custom-search-input">
                    <div class="input-group col-md-12">
                        <?php $form = ActiveForm::begin(); ?>
                        <?= $form->field($model, 'detailResepDosis')->textInput(['maxlength' => true]);?>
                        <span class="input-group-btn">
                        <button class="btn btn-info btn-lg" type="button">
                                <?= Html::submitButton('Cari', ['class' => 'btn bg-primary', 'style'=>'color:white']) ?>
                        </button>
                    </span>  
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="col-md-4">
    
    </div>
</div>

