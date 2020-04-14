<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Pemeriksaan */

$this->title = 'Update Pemeriksaan: ' . $model->pemeriksaanID;

?>
<br>
<div class="pemeriksaan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
