<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Users */

$this->title = 'Daftar SiKlinik';

?>
<div class="users-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
    <div class="col-md-6">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>

    <div class="col-md-6 text-center img-thumbnail">
        <img src="../../assets/background/home.png" alt="" style="width:500px;">
    </div>
    </div>
    

</div>
