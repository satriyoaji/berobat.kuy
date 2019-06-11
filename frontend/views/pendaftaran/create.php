<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Pendaftaran */

$this->title = 'Pendaftaran Check Up';
?>
<br>
<div class="pendaftaran-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <br>

    <div class="row">
    <div class="col-md-7">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>
    <div class="col-md-5s">
        
    </div>
    </div>
    
    

</div>
