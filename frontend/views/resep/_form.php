<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Resep */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="resep-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-md-6">

        <div = hidden>
        <?= $form->field($model, 'dokterID')->textInput(['value'=>Yii::$app->user->id]) ?>
        <?= $form->field($model, 'resepStatus')->textInput(['value'=>'Belum Dibuat']) ?>
        <?= $form->field($model, 'pendaftaranID')->textInput(['value'=>$_GET['id']]) ?>
        </div>

        <?php if (isset($_SESSION['resepID']))
            {
                var_dump($_SESSION['resepID']);
            }  //hanya untuk cek apakah telah memberikan detail resep?>

        <div class="alert alert-warning col-md-8" role="alert">
            <i>Anda harus mengisikan detail resep dengan mempertimbangkan obat yang ada pada sistem secara saksama!</i>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Next', ['class' => 'btn-block btn btn-success', 'data' => [
                'confirm' => ' Benar Ingin Memberi resep untuk pasien ini?  Setelah ini Anda harus memberikan informasi detail resep']]) ?>
        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>
