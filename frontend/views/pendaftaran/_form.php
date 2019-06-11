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
                ->from('jadwaldokter')
                ->where(['jadwalID'=>$id]);
            foreach($jadwalQuery->each() as $jadwal){
                $userQuery = (new Query())
                    ->from('users')
                    ->where(['userId'=>$jadwal['dokterID']]);
                foreach($userQuery->each() as $user){ ?>
                    <tr>
                        <td><i>Nama Dokter </i> </td>
                        <td><b><?php echo $user['userNama'];?></b> </td>
                    </tr>
                    <tr>
                        <td> <i>Tanggal Pemeriksaan </i> </td>
                        <td><?php echo $jadwal['jadwalTanggal'];?></td>
                    </tr>
                    <tr>
                        <td> <i>Waktu Pemeriksaan </i> </td>
                        <td><?php echo $jadwal['jadwalWaktu'];?></td>
                    </tr>
                    <tr>
                        <td> <i>Ruang Pemeriksaan</i>  </td>
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
        <br>
        Yakin dengan Pemeriksaan ? 
        <br>
        <br>
        <?= Html::submitButton('Iya', ['class' => 'btn bg-primary', 'style' => 'color:white;']) ?> 
        <?= Html::a('Tidak', ['jadwaldokter/index','idDokter'=>$user['userId']], ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <br>
    <br>
    <br>

</div>
