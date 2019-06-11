<?php
/* @var $this yii\web\View */
use yii\helpers\Html; 
use yii\helpers\Url;
use yii\db\Query;
$this->title = 'Si Klinik';

?>
<div class="site-index">
    <div class="body" style="padding-top:40px;">
    <br>
    <br>
    <div class="col-md-12">
                        <div class="row">
                        <div class="col-md-3">
                                <a href="">
                                <div class="card" style="width: 14rem;">
                                    <div class="gambar" style="padding-top:20px;" align="center">
                                        <img src="../../assets/doctor.png" alt="" width="100" height="100">
                                    </div>
                                    <h3 class="card-title text-center"><?= Html::a('List Pasien', ['users/pasien'], ['class' => 'card-title'])?></h3>
                                </div>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="">
                                <div class="card" style="width: 14rem;">
                                    <div class="gambar" style="padding-top:20px;" align="center">
                                        <img src="../../assets/doctor.png" alt="" width="100" height="100">
                                    </div>
                                    <h3 class="card-title text-center"><?= Html::a('List Periksa', ['pendaftaran/listharian'], ['class' => 'card-title'])?></h3>
                                </div>
                                </a>
                            </div>
                            <div class="col-md-3">
                            <a href="">
                            <div class="card" style="width: 14rem;">
                                <div class="card-body">
                                    <div class="gambar" style="padding-top:20px;" align="center">
                                        <img src="../../assets/pills.png" alt="" width="100" height="100">
                                    </div>
                                    <h3 class="card-title text-center"><?= Html::a('Beli Obat', ['obat/index'], ['class' => 'card-title'])?></h3>
                                </div>
                            </div>
                            </a>
                            </div>
                            
                        </div>
                    </div>
                    <div class="row">
                <div class="col-md-6 deskripsi">
                    <div class="judul">
                    
                    </div>
                    <div class="isi">
                    
                    </div>
                </div>
                <div class="col-md-6 gambar" align="right">
                    <!-- <img src="../../assets/check.png" alt=""> -->
                </div>
            </div>