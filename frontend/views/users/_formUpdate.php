<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

                <?= $form->field($model, 'userNama')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'userAlamat')->textInput(['maxlength' => true]) ?>

                <div class="form-group field-users-usertanggallahir bmd-form-group">
                    <label class="control-label bmd-label-static" for="users-usertanggallahir">User Tanggal Lahir</label>
                    <input type="date" id="users-usertanggallahir" class="form-control col-md-4" name="Users[userTanggalLahir]" value="<?= $model->userTanggalLahir?>">
                </div>

                <?= $form->field($model, 'userTelephone')->textInput(['maxlength' => true, 'class'=>'col-md-6']) ?>

                <?= $form->field($model, 'userJenisKelamin')->dropDownList(
                    ['Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan']
                ); ?>
                <div class="form-group text-center">
                    <?= Html::submitButton('Save', ['class' => 'btn bg-primary', 'style' => 'color:white']) ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <div class="text-center">
                    <?php if (!isset($model->userFoto)):?>
                        <img src='../../assets/img/profil.png' width="200px" alt="..." class="img-thumbnail">
                    <?php else:?>
                        <img src='../../assets/img/user/<?= $model->userFoto; ?>' width="200px" alt="..." class="img-thumbnail">
                    <?php endif;?>
                </div>
                <?= $form->field($model, 'userFoto')->fileInput() ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>


</div>
