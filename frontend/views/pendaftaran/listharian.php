<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PendaftaranSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pendaftarans';
$this->params['breadcrumbs'][] = $this->title;
$id = Yii::$app->user->id;
if(isset($_GET['id'])){
    $date = date('d-m-Y', time() + (24 * 60 * 60));
} else {
    $date = date('d-m-Y');
}
echo "Tanggal Periksa $date";
?>
<div class="pendaftaran-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <td><?= Html::a('Hari ini', ['pendaftaran/listharian'], ['class' => 'btn btn-success']) ?></td>
    <td><?= Html::a('Besok', ['pendaftaran/listharian','id'=>1], ['class' => 'btn btn-success']) ?></td>
    <table class="table table-condensed">
        <tbody>
            <tr>
                <td> No </td>
                <td> Nama Dokter </td>
                <td> Tanggal Periksa </td>
                <td> Status Pemeriksaan </td>
            </tr>
            <?php
            $i = 1;
            $jadwalQuery = (new Query())
                ->from('jadwalDokter')
                ->where(['dokterID'=>$id, 
                         'jadwalTanggal' =>$date]);
            foreach($jadwalQuery->each() as $jadwal){
                $pendaftaranQuery = (new Query())
                    ->from('pendaftaran')
                    ->where(['jadwalID'=>$jadwal['jadwalID']]);
                foreach($pendaftaranQuery->each() as $pendaftaran){
                    $userQuery = (new Query())
                        ->from('users')
                        ->where(['userId'=>$pendaftaran['pasienID']]);
                    foreach($userQuery->each() as $user){ ?>
                        <tr>
                            <td><?php echo $i; $i++;?></td>
                            <td><?php echo $user['userNama'];?></td>
                            <td><?php echo $jadwal['jadwalWaktu'];?></td>
                            <td><?php echo $pendaftaran['pendaftaranStatus'];?></td>
                            <td><?= Html::a('Periksa', ['pemeriksaan/create','id'=>$pendaftaran['pendaftaranID']], ['class' => 'btn btn-success']) ?></td>
                        </tr>
                <?php }
                }
            } ?>
        </tbody>
    </table>

    


</div>
