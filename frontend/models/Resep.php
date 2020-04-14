<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "resep".
 *
 * @property int $resepID
 * @property string $resepTanggal
 * @property int $dokterID
 * @property int $pendaftaranID
 * @property string $resepStatus
 * @property int $resepTotalHarga
 *
 * @property Detailresep[] $detailreseps
 * @property Nota[] $notas
 * @property Pendaftaran $pendaftaran
 * @property Users $dokter
 */
class Resep extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resep';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['resepTanggal', 'dokterID'], 'required'],
            [['dokterID', 'pendaftaranID', 'resepTotalHarga'], 'integer'],
            [['resepTanggal'], 'string', 'max' => 50],
            [['resepStatus'], 'string', 'max' => 30],
            [['pendaftaranID'], 'exist', 'skipOnError' => true, 'targetClass' => Pendaftaran::className(), 'targetAttribute' => ['pendaftaranID' => 'pendaftaranID']],
            [['dokterID'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['dokterID' => 'userId']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'resepID' => 'Resep ID',
            'resepTanggal' => 'Resep Tanggal',
            'dokterID' => 'Dokter ID',
            'pendaftaranID' => 'Pendaftaran ID',
            'resepStatus' => 'Resep Status',
            'resepTotalHarga' => 'Resep Total Harga',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetailreseps()
    {
        return $this->hasMany(Detailresep::className(), ['resepID' => 'resepID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotas()
    {
        return $this->hasMany(Nota::className(), ['resepID' => 'resepID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPendaftaran()
    {
        return $this->hasOne(Pendaftaran::className(), ['pendaftaranID' => 'pendaftaranID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDokter()
    {
        return $this->hasOne(Users::className(), ['userId' => 'dokterID']);
    }
}
