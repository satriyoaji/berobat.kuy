<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "pendaftaran".
 *
 * @property int $pendaftaranID
 * @property int $pasienID
 * @property int $dokterID
 * @property string $pendaftaranTanggal
 * @property string $pendaftaranStatus
 *
 * @property Pemeriksaan[] $pemeriksaans
 * @property Users $pasien
 * @property Users $dokter
 * @property Resep[] $reseps
 */
class Pendaftaran extends \yii\db\ActiveRecord
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
            [['pasienID', 'dokterID'], 'integer'],
            [['pendaftaranTanggal'], 'string', 'max' => 20],
            [['pendaftaranStatus'], 'string', 'max' => 15],
            [['pasienID'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['pasienID' => 'userId']],
            [['dokterID'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['dokterID' => 'userId']],
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
            'dokterID' => 'Dokter ID',
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
    public function getDokter()
    {
        return $this->hasOne(Users::className(), ['userId' => 'dokterID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReseps()
    {
        return $this->hasMany(Resep::className(), ['pendaftaranID' => 'pendaftaranID']);
    }
}
