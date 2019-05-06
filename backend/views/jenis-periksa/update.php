<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\JenisPeriksa */

$this->title = 'Update Jenis Periksa: ' . $model->jenisPeriksaID;
$this->params['breadcrumbs'][] = ['label' => 'Jenis Periksas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->jenisPeriksaID, 'url' => ['view', 'id' => $model->jenisPeriksaID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jenis-periksa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
