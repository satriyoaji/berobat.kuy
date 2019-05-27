<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Users */

$this->title = $model->userId;

\yii\web\YiiAsset::register($this);
?>
<br>
<br>
<div class="col-md-12">
    <div class="text-right">
        <a href=""><button type="button" class="btn btn-raised btn-info">EDIT</button></a>
    </div>
    <div class="row">
        <div class="col-md-4 text-center">
            <img src="../../assets/FOTO USER/download.png" alt="..." class="img-thumbnail">
        </div> 
        <div class="col-md-8">
            <h1><b>Edy Ribowo</b></h1>
            <p><i>@username</i></p>
            <h6 style="color:#666768;">edyribowo@gmail.com</h6>
            <h6>Laki - laki</h6>
            <h6>081249078442</h6>
            <h6><i>Jl. Ahmad Yani No. 17</i></h6>
            <h6><b>30, Nopember 2000</b></h6>
            <br>
            <br>
            <br>
        </div>
    </div>
   
</div>
