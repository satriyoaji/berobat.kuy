<?php

use frontend\models\Obat;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $model frontend\models\Detailresep */
/* @var $form yii\widgets\ActiveForm */

$categories=Obat::find()->all();

$listData=ArrayHelper::map($categories,'obatID','obatNama');

?>

<div class="detailresep-form col-lg-8">

    <?php $form = ActiveForm::begin(); ?>

    <div = hidden>
        <?= $form->field($model, 'resepID')->textInput(['value'=>$_SESSION['resepID']]) ?>
    </div>

    <?= $form->field($model, 'obatID')->dropDownList(
        $listData,
        ['obatID'=>'obatNama']) ?>

    <?= $form->field($model, 'detailResepDosis')->textInput(['maxlength' => true]) ?>

    <div class="form-group field-detailresep-detailresepquantity bmd-form-group is-filled">
        <label class="control-label bmd-label-static" for="detailresep-detailresepquantity">Detail Resep Quantity</label>
        <input type="number" id="detailresep-detailresepquantity" class="form-control" name="Detailresep[detailResepQuantity]">
    </div>

    <table>
    <div class="inline form-inline">
        <tr>
            <td class="form-group ">
                <?= Html::a('Kembali', ['pemeriksaan/update', 'id' => $_SESSION['pendaftaranID']], ['class' => 'btn bg-primary', 'style'=>'color:white','data' => [
                     'method' => 'post',],]);?>
            </td>
            <td class="form-group ">
                <?= Html::submitButton('Save', ['class' => 'btn btn-block bg-info', 'style'=>'color:white','data' => [
                    'confirm' => ' Benar akan menambahkan obat ini dalam resep?',
                    'method' => 'post',],]) ?>
            </td>
        </tr>
    </div>
    </table>

    <?php ActiveForm::end(); ?>

</div>
