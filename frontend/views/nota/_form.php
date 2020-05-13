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

    <div class="col-md-4 p-2">
        <?= $form->field($model, 'notaTotalHarga')->textInput(['value' => $resep['resepTotalHarga'] ,'readonly'=>true]) ?>

        <?php if(isset($model->code)): //kalau belum dibayar ?>
        <?= $form->field($model, 'code')->textInput(['value' => $model->code, 'readonly'=>true]) ?>
        <?php else: //kalau belum pernah menyelesaikan transksi ?>
        <?= $form->field($model, 'code')->textInput(['value' => strval(rand(10, 1000)), 'readonly'=>true]) ?>
        <?php endif; ?>

        <?php if (isset($_GET['kasirProcess'])):?>
        <div class="mb-4">
            <?= $form->field($model, 'notaStatus')->textInput(['value' => $model->notaStatus, 'readonly'=>true]); ?>
        </div>
    </div>
    <?php else:?>
    <?= $form->field($model, 'notaStatus', ['class'=>'pb-4'])->dropDownList(
        ['belum dibayar' => 'Tunda bayar', 'sudah bayar' => 'Langsung dibayar']
    ); ?>
    <?php endif;?>


    <div class="form-group mt-lg-4 pt-2">
        <?php if (isset($_SESSION['kasirID'])) {
                echo Html::submitButton('Process', ['class' => 'btn btn-outline-info', 'data' => [
                    'confirm' => 'Yakin mengonfirmasi process transaksi dari pasien ini?',
                    'method' => 'post',]]);
                unset($_SESSION['kasirID']);
        } else { ?>
            <?php echo Html::submitButton('Bayar', ['class' => 'btn btn-outline-info', 'data' => [
                'confirm' => 'Yakin selesaikan pembayaran resep ini?',
                'method' => 'post',]]);
        }
        ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
