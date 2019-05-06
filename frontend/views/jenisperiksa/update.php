<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Jenisperiksa */

$this->title = 'Update Jenisperiksa: ' . $model->jenisPeriksaID;
$this->params['breadcrumbs'][] = ['label' => 'Jenisperiksas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->jenisPeriksaID, 'url' => ['view', 'id' => $model->jenisPeriksaID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jenisperiksa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
