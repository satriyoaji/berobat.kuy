<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Pendaftaran */

$this->title = 'Update Pendaftaran: ' . $model->pendaftaranID;
$this->params['breadcrumbs'][] = ['label' => 'Pendaftarans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pendaftaranID, 'url' => ['view', 'id' => $model->pendaftaranID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pendaftaran-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
