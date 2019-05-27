<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "jadwaldokter".
 *
 * @property int $jadwalID
 * @property int $dokterID
 * @property string $jadwalWaktu
 * @property int $jadwalKuota
 * @property string $jadwalRuangan
 * @property string $jadwalTanggal
 *
 * @property Users $dokter
 * @property Pendaftaran[] $pendaftarans
 */
class Jadwaldokter extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jadwaldokter';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dokterID', 'jadwalKuota'], 'integer'],
            [['jadwalWaktu'], 'string', 'max' => 30],
            [['jadwalRuangan'], 'string', 'max' => 15],
            [['jadwalTanggal'], 'string', 'max' => 100],
            [['dokterID'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['dokterID' => 'userId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'jadwalID' => 'Jadwal ID',
            'dokterID' => 'Dokter ID',
            'jadwalWaktu' => 'Jadwal Waktu',
            'jadwalKuota' => 'Jadwal Kuota',
            'jadwalRuangan' => 'Jadwal Ruangan',
            'jadwalTanggal' => 'Jadwal Tanggal',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDokter()
    {
        return $this->hasOne(Users::className(), ['userId' => 'dokterID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPendaftarans()
    {
        return $this->hasMany(Pendaftaran::className(), ['jadwalID' => 'jadwalID']);
    }
}
