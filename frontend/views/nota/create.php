<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Nota */

$this->title = 'Create Nota';
$this->params['breadcrumbs'][] = ['label' => 'Notas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nota-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
