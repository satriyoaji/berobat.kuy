<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $model frontend\models\Users */

$this->title = "Profil";

\yii\web\YiiAsset::register($this);

$id = Yii::$app->user->id;
?>
<br>
<br>
<div class="col-md-12">
    <div class="text-right">
        <?= Html::a('EDIT', ['users/update','id'=>Yii::$app->user->id,'kategori'=>1], ['class' => 'btn btn-raised btn-primary', 'style' => 'color:white']) ?>
        <?= Html::a('PASSWORD', ['users/update','id'=>Yii::$app->user->id,'kategori'=>2], ['class' => 'btn btn-raised btn-info', 'style' => 'color:white']) ?>
    </div>
    <div class="row">
        <div class="col-md-4 text-center">
            <img src="../../assets/FOTO USER/download.png" alt="..." class="img-thumbnail">
        </div> 
        <?php
        $dataUser = (new Query())
            ->from('users')
            ->where(['userId'=>Yii::$app->user->id]);
        foreach($dataUser->each() as $user) {
        ?>
            <div class="col-md-8">
                <h1><b><?php echo $user['userNama']; ?></b></h1>
                <p><i>@<?php echo $user['username']; ?></i></p>
                <h6 style="color:#666768;"><?php echo $user['userEmail']; ?></h6>
                <h6><?php echo $user['userJenisKelamin']; ?></h6>
                <h6><?php echo $user['userTelephone']; ?></h6>
                <h6><i><?php echo $user['userAlamat']; ?></i></h6>
                <h6><b><?php echo $user['userTanggalLahir']; ?></b></h6>
                <br>
                <br>
                <br>
            </div>
        <?php } ?>
    </div>
   
</div>
<br>
<br><br>