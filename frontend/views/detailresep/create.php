<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Detailresep */

$this->title = 'Create Detailresep';
$this->params['breadcrumbs'][] = ['label' => 'Detailreseps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detailresep-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
