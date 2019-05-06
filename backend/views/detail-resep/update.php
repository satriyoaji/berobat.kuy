<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\DetailResep */

$this->title = 'Update Detail Resep: ' . $model->detailResepID;
$this->params['breadcrumbs'][] = ['label' => 'Detail Reseps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->detailResepID, 'url' => ['view', 'id' => $model->detailResepID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="detail-resep-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
