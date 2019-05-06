<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DetailResepSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Detail Reseps';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detail-resep-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Detail Resep', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'detailResepID',
            'obatID',
            'detailResepDosis',
            'resepID',
            'detailResepQuantity',
            //'detailResepSubtotal',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
