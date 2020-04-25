<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Masuk';
?>
<div class="row">
    <div class="col-md-6">
            <div class="site-login">
            <h1><?= Html::encode($this->title) ?></h1>

            <p>Selamat datang kembali, nikmati akses SiKlinik tanpa batas</p>

            <div class="row">
                <div class="col-lg-8">
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                        <?= $form->field($model, 'password')->passwordInput() ?>

                        <?= $form->field($model, 'rememberMe')->checkbox() ?>

                        <div style="color:#999;margin:1em 0">
                            If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
                            <br>
                            Need new verification email? <?= Html::a('Resend', ['site/resend-verification-email']) ?>
                        </div>

                        <div class="form-group text-right">
                            <?= Html::submitButton('Login', ['class' => 'btn bg-primary', 'name' => 'login-button', 'style'=>'color:white']) ?>
                        </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 text-center img-thumbnail">
        <img src="../../../assets/background/jumbotron.png" alt="" style="width:500px;">
    </div>
</div>

<br>
<br>
<br>
