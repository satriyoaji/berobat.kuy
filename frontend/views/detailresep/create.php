<?php

use yii\helpers\Html;
use yii\db\Query;
use frontend\models\Obat;

/* @var $this yii\web\View */
/* @var $model frontend\models\Detailresep */

$this->title = 'Beli Obat';

?>
<div class="detailresep-create">
    <br>

    <h1><?= Html::encode($this->title) ?></h1>
     <br>
     <?php if(isset($_SESSION['pendaftaranID'])){?>
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    <?php } else {?>
        <?= $this->render('detail', [
            'model' => $model,
        ]) ?>
    <?php } ?>
</div>

