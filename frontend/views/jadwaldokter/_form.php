<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Jadwaldokter */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jadwaldokter-form">

    <?php $form = ActiveForm::begin(); ?>

    <div = hidden>
    <?= $form->field($model, 'dokterID')->textInput(['value'=>Yii::$app->user->id]) ?>
    </div>

<!--    <div class="form-group field-jadwaldokter-jadwaltanggal bmd-form-group">-->
<!--        <label class="control-label bmd-label-static" for="jadwaldokter-jadwaltanggal">Jadwal Tanggal</label>-->
<!--        <input type="text" id="jadwaldokter-jadwaltanggal" class="form-control" name="Jadwaldokter[jadwalTanggal]" maxlength="100">-->
<!---->
<!--        <div class="help-block"></div>-->
<!--    </div>-->

    <div class="col-md-8 form-group field-jadwaldokter-jadwalwaktu form-inline">
        <div class="col-md-4 form-group">
            <label class="control-label bmd-label-static" for="jadwaldokter-jadwaltanggal">Jadwal Tanggal</label>
            <input type="date" id="jadwaldokter-jadwaltanggal" class="form-control" name="Jadwaldokter[jadwalTanggal]" data-date="" data-date-format="DD MMMM YYYY">
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>

        <div class="col-md-4 form-group">
            <label class="control-label bmd-label-static inline" for="jadwaldokter-jadwalwaktu">Jadwal Waktu</label>
            <input type="time" id="jadwaldokter-jadwalwaktu" class="form-control" name="Jadwaldokter[jadwalWaktu]" maxlength="30">
        </div>

        <div class="col-md-4 form-group">
            <label class="control-label bmd-label-static" for="jadwaldokter-jadwaldurasi">Jadwal Durasi</label>
            <input type="number" id="jadwaldokter-jadwaldurasi" class="form-control" name="Jadwaldokter[jadwalDurasi]" maxlength="2" max="24">
        </div>
        <div class="help-block"></div>
    </div>

    <?= $form->field($model, 'jadwalKuota')->textInput() ?>

    <?= $form->field($model, 'jadwalRuangan')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    $("input").on("change", function() {
        this.setAttribute(
            "data-date",
            moment(this.value, "YYYY-MMMM-DD")
                .format( this.getAttribute("data-date-format") )
        )
    }).trigger("change")
</script>