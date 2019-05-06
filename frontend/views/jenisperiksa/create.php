<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Jenisperiksa */

$this->title = 'Create Jenisperiksa';
$this->params['breadcrumbs'][] = ['label' => 'Jenisperiksas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jenisperiksa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
