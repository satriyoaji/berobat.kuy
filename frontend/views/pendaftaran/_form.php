<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
$id = $_GET['id'];
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $model frontend\models\Pendaftaran */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pendaftaran-form">

    <table class="table table-condensed">
        <tbody>
            <?php
            $jadwalQuery = (new Query())
                ->from('jadwalDokter')
                ->where(['jadwalID'=>$id]);
            foreach($jadwalQuery->each() as $jadwal){
                $userQuery = (new Query())
                    ->from('users')
                    ->where(['userId'=>$jadwal['dokterID']]);
                foreach($userQuery->each() as $user){ ?>
                    <tr>
                        <td> Nama Dokter </td>
                        <td><?php echo $user['userNama'];?></td>
                    </tr>
                    <tr>
                        <td> Tanggal Pemeriksaan </td>
                        <td><?php echo $jadwal['jadwalTanggal'];?></td>
                    </tr>
                    <tr>
                        <td> Waktu Pemeriksaan </td>
                        <td><?php echo $jadwal['jadwalWaktu'];?></td>
                    </tr>
                    <tr>
                        <td> Ruang Pemeriksaan </td>
                        <td><?php echo $jadwal['jadwalRuangan'];?></td>
                    </tr>
                <?php
                }
            }
            ?>
        </tbody>
    </table>
            

    <?php 
    

    ?>
    <?php $form = ActiveForm::begin(); ?>    
    <div = hidden>
    <?= $form->field($model, 'pasienID')->textInput(['value' => Yii::$app->user->id]) ?>

    <?= $form->field($model, 'jadwalID')->textInput(['value' => $id]) ?>

    <?= $form->field($model, 'pendaftaranTanggal')->textInput(['maxlength' => true, 'value' =>date('d-m-Y')]) ?>
    
    <?= $form->field($model, 'pendaftaranStatus')->textInput(['maxlength' => true, 'value' =>"Belum Periksa"]) ?>
    </div>

    <div class="form-group">
        Yakin dengan Pemeriksaan? <?= Html::submitButton('Iya', ['class' => 'btn btn-success']) ?> 
        <?= Html::a('Tidak', ['jadwaldokter/index','idDokter'=>$user['userId']], ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
