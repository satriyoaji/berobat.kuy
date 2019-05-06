<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PekerjaanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pekerjaans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pekerjaan-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Pekerjaan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'pekerjaanID',
            'pekerjaanNama',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
