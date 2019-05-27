<?php

use yii\helpers\Html;
use yii\db\Query;
use frontend\models\Obat;

/* @var $this yii\web\View */
/* @var $model frontend\models\Detailresep */

$this->title = 'Create Detailresep';
$this->params['breadcrumbs'][] = ['label' => 'Detailreseps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detailresep-create">

    <h1><?= Html::encode($this->title) ?></h1>
     
    <?= $this->render('detail', [
        'model' => $model,
    ]) ?>
</div>

