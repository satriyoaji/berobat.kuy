<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\JenisPeriksaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jenis Periksas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jenis-periksa-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Jenis Periksa', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'jenisPeriksaID',
            'jenisPeriksaNama',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
