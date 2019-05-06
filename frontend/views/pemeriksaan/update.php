<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Pemeriksaan */

$this->title = 'Update Pemeriksaan: ' . $model->pemeriksaanID;
$this->params['breadcrumbs'][] = ['label' => 'Pemeriksaans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pemeriksaanID, 'url' => ['view', 'id' => $model->pemeriksaanID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pemeriksaan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
