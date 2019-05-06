<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\JadwalDokter */

$this->title = 'Update Jadwal Dokter: ' . $model->jadwalID;
$this->params['breadcrumbs'][] = ['label' => 'Jadwal Dokters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->jadwalID, 'url' => ['view', 'id' => $model->jadwalID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jadwal-dokter-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
