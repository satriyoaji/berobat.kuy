<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Resep;

/* @var $this yii\web\View */
/* @var $model frontend\models\Nota */
/* @var $form yii\widgets\ActiveForm */

$idResep = $_GET['id'];
$resep = Resep::findOne($idResep);
?>

<div class="nota-form col-lg-8">

    <?php $form = ActiveForm::begin(); ?>

    <div = hidden>
    <?php if(isset($_SESSION['kasirID'])){
            echo $form->field($model, 'kasirID')->textInput(['value'=>$_SESSION['kasirID']]);
        } else{
            echo $form->field($model, 'kasirID')->textInput();
        }
        ?>

    <?= $form->field($model, 'pemeriksaanID')->textInput() ?>

    <?php if(isset($model->code)): //kalau belum dibayar ?>
    <?= $form->field($model, 'resepID')->textInput() ?>
    <?php else: //kalau belum pernah menyelesaikan transksi ?>
    <?= $form->field($model, 'resepID')->textInput(['value'=>$idResep]) ?>
    <?php endif; ?>
    </div>

    <div class="col-md-4">
        <?= $form->field($model, 'notaTotalHarga')->textInput(['value' => $resep['resepTotalHarga'] ,'readonly'=>true]) ?>
        <?php if(isset($model->code)): //kalau belum dibayar ?>
        <?= $form->field($model, 'code')->textInput(['value' => $model->code, 'readonly'=>true]) ?>
        <?php else: //kalau belum pernah menyelesaikan transksi ?>
        <?= $form->field($model, 'code')->textInput(['value' => strval(rand(10, 1000)), 'readonly'=>true]) ?>
        <?php endif; ?>
    </div>

    <?= $form->field($model, 'notaStatus')->dropDownList(
            ['Belum dibayar' => 'Tunda bayar', 'Sudah Bayar' => 'Langsung dibayar']
    ); ?>

    <div class="form-group">
        <?php if (isset($_SESSION['kasirID'])) {
                echo Html::submitButton('Process', ['class' => 'btn btn-success btn-outline-primary', 'data' => [
                    'confirm' => 'Yakin mengonfirmasi process transaksi dari pasien ini?',
                    'method' => 'post',]]);
        } else { ?>
            <?php echo Html::submitButton('Bayar', ['class' => 'btn btn-success btn-outline-primary', 'data' => [
                'confirm' => 'Yakin selesaikan pembayaran resep ini?',
                'method' => 'post',]]);
        }
        ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
