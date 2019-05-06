<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "resep".
 *
 * @property int $resepID
 * @property string $resepTanggal
 * @property int $apotekerID
 * @property int $pendaftaranID
 * @property string $resepStatus
 * @property int $resepTotalHarga
 *
 * @property Detailresep[] $detailreseps
 * @property Nota[] $notas
 * @property Pendaftaran $pendaftaran
 * @property Users $apoteker
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
            [['apotekerID', 'pendaftaranID', 'resepTotalHarga'], 'integer'],
            [['resepTanggal'], 'string', 'max' => 20],
            [['resepStatus'], 'string', 'max' => 30],
            [['pendaftaranID'], 'exist', 'skipOnError' => true, 'targetClass' => Pendaftaran::className(), 'targetAttribute' => ['pendaftaranID' => 'pendaftaranID']],
            [['apotekerID'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['apotekerID' => 'userId']],
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
            'apotekerID' => 'Apoteker ID',
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
    public function getApoteker()
    {
        return $this->hasOne(Users::className(), ['userId' => 'apotekerID']);
    }
}
