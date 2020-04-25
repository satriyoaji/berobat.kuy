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
        <?= $this->render('_formUpdate', [
            'model' => $model,
        ]) ?>

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
            <img src="../../../assets/background/password.png" alt="" style="width:500px;">
        </div>
        </div>
        </div>

    <?php } ?>

</div>
