<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Users */

$this->title = 'Update Profil ';

$kategori = $_GET['kategori'];
?>
<br>

<div class="users-update">

    <h2><?= Html::encode($this->title) ?></h2>

    
    <?php if($kategori == 1){ ?>
    <div class="row">
    <div class="col-md-5">
    <?= $this->render('_formUpdate', [
        'model' => $model,
    ]) ?>
    </div>

    <div class="col-md-7 text-center">
    <p> <i>Ganti Photo</i> </p>
    <img src="../../assets/FOTO USER/download.png" alt="..." class="img-thumbnail">
    <form>
    <div class="form-group">
        <input type="file" class="form-control-file" id="exampleFormControlFile1" style="display:block;
        outline: none;
        height: 45px;
        width: 218px;
        padding:0 16px;
        font-family: Helvetica Neue;  
        font-size: 18px;
        background-color: rgb(250,250,250);
        margin:0 auto;">
    </div>
    </form>
    </div>
    </div>

    <?php } else { ?>

    <div class="row">

    <div class="col-md-5">
        <?= $this->render('_formPassword', [
        'model' => $model,
        'model2' => $model2,
    ]) ?>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-6 text-center">
    <div class="img-thumbnail">
        <img src="../../assets/background/password.png" alt="" style="width:500px;">
    </div>
    </div>
    </div>
    <?php } ?>
    

</div>
