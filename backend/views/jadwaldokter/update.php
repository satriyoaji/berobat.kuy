<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Jadwaldokter */

$this->title = 'Update Jadwaldokter: ' . $model->jadwalID;
$this->params['breadcrumbs'][] = ['label' => 'Jadwaldokters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->jadwalID, 'url' => ['view', 'id' => $model->jadwalID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jadwaldokter-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
