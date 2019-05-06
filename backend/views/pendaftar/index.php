<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PendaftanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pendaftarans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pendaftaran-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Pendaftaran', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'pendaftaranID',
            'pasienID',
            'dokterID',
            'pendaftaranTanggal',
            'pendaftaranStatus',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
