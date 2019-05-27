<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "pendaftaran".
 *
 * @property int $pendaftaranID
 * @property int $pasienID
 * @property int $jadwalID
 * @property string $pendaftaranTanggal
 * @property string $pendaftaranStatus
 *
 * @property Pemeriksaan[] $pemeriksaans
 * @property Users $pasien
 * @property Jadwaldokter $jadwal
 * @property Resep[] $reseps
 */
class Jadwaldokter extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pendaftaran';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pasienID', 'jadwalID'], 'integer'],
            [['pendaftaranTanggal'], 'string', 'max' => 20],
            [['pendaftaranStatus'], 'string', 'max' => 15],
            [['pasienID'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['pasienID' => 'userId']],
            [['jadwalID'], 'exist', 'skipOnError' => true, 'targetClass' => Jadwaldokter::className(), 'targetAttribute' => ['jadwalID' => 'jadwalID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pendaftaranID' => 'Pendaftaran ID',
            'pasienID' => 'Pasien ID',
            'jadwalID' => 'Jadwal ID',
            'pendaftaranTanggal' => 'Pendaftaran Tanggal',
            'pendaftaranStatus' => 'Pendaftaran Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPemeriksaans()
    {
        return $this->hasMany(Pemeriksaan::className(), ['pendaftranID' => 'pendaftaranID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPasien()
    {
        return $this->hasOne(Users::className(), ['userId' => 'pasienID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJadwal()
    {
        return $this->hasOne(Jadwaldokter::className(), ['jadwalID' => 'jadwalID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReseps()
    {
        return $this->hasMany(Resep::className(), ['pendaftaranID' => 'pendaftaranID']);
    }
}
