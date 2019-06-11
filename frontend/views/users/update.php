<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Users */

$this->title = 'Update Users: ' . Yii::$app->user->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::$app->user->id, 'url' => ['view', 'id' => Yii::$app->user->id]];
$this->params['breadcrumbs'][] = 'Update';
$kategori = $_GET['kategori'];
?>
<div class="users-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if($kategori == 1){ ?>
    <?= $this->render('_formUpdate', [
        'model' => $model,
    ]) ?>
    <?php } else { ?>
        <?= $this->render('_formPassword', [
        'model' => $model,
        'model2' => $model2,
    ]) ?>
    <?php } ?>

</div>
