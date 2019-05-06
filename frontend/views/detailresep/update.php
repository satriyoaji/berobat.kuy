<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Detailresep */

$this->title = 'Update Detailresep: ' . $model->detailResepID;
$this->params['breadcrumbs'][] = ['label' => 'Detailreseps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->detailResepID, 'url' => ['view', 'id' => $model->detailResepID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="detailresep-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
