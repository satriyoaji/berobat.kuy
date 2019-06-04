<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $model frontend\models\Detailresep */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="detailresep-form">

    <?php if(isset($_SESSION['resep'])){


    }else{
        Yii::$app->db->createCommand()->insert('resep', [
            'pendaftaranID' => $_SESSION['pendaftaranID'],
            'resepStatus' => 'Belum Dibuat',
            'resepTanggal' => $date = date('d-m-Y'),
            'resepTotalHarga' => 0,
        ])->execute();

        $resepQuery = (new Query())
            ->from('resep');
        foreach($resepQuery->each() as $resep){
            $_SESSION['resep']=$resep['resepID'];
        }

    }?>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'obatID')->textInput() ?>

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
