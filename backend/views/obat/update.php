<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Obat */

$this->title = 'Update Obat: ' . $model->obatID;
$this->params['breadcrumbs'][] = ['label' => 'Obats', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->obatID, 'url' => ['view', 'id' => $model->obatID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="obat-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
