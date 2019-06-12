<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Pendaftaran */

$this->title = "Detail";
\yii\web\YiiAsset::register($this);
?>
<div class="pendaftaran-view">

    <br>
    <br>

    <!-- <p>
        <?= Html::a('Update', ['update', 'id' => $model->pendaftaranID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->pendaftaranID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p> -->
    
    <h2>Bukti Pendaftaran Check Up</h2>
    <br>

    <div class="row">
    <div class="col-md-7">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pendaftaranID',
            'pasien.userNama',
            'jadwal.jadwalTanggal',
            'pendaftaranTanggal',
            'pendaftaranStatus',
        ],
    ]) ?>
    </div>

    <div class="col-md-5">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script type="text/javascript">
            function generateBarCode()
            {
                var nric = $('#text').val();
                var url = 'https://api.qrserver.com/v1/create-qr-code/?data=' + nric + '&amp;size=50x50';
                $('#barcode').attr('src', url);
            }
        </script>

        <img id='barcode' 
                src="https://api.qrserver.com/v1/create-qr-code/?data=<?php echo $model->pendaftaranID; ?>&amp;size=100x100" 
                alt="" 
                title="HELLO" 
                width="200" 
                height="200" />
                <br>
                <br>
        <p><small><i>Harap datang 15 menit sebelum pemeriksaan.</i></small></p>
        <p><small><i>Tunjukan bukti ini ke petugas.</i></small></p>
    </div>
    </div>
</div>

