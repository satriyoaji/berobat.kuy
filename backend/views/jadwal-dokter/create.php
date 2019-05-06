<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\JadwalDokter */

$this->title = 'Create Jadwal Dokter';
$this->params['breadcrumbs'][] = ['label' => 'Jadwal Dokters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jadwal-dokter-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
