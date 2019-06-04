<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "pemeriksaan".
 *
 * @property int $pemeriksaanID
 * @property int $pendaftranID
 * @property string $pemeriksaanHasil
 * @property int $jenisPeriksaID
 *
 * @property Nota[] $notas
 * @property Jenisperiksa $jenisPeriksa
 * @property Pendaftaran $pendaftran
 */
class Pemeriksaan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pemeriksaan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pendaftranID', 'jenisPeriksaID'], 'integer'],
            [['pemeriksaanHasil'], 'string', 'max' => 50],
            [['jenisPeriksaID'], 'exist', 'skipOnError' => true, 'targetClass' => Jenisperiksa::className(), 'targetAttribute' => ['jenisPeriksaID' => 'jenisPeriksaID']],
            [['pendaftranID'], 'exist', 'skipOnError' => true, 'targetClass' => Pendaftaran::className(), 'targetAttribute' => ['pendaftranID' => 'pendaftaranID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pemeriksaanID' => 'Pemeriksaan ID',
            'pendaftranID' => 'Pendaftran ID',
            'pemeriksaanHasil' => 'Pemeriksaan Hasil',
            'jenisPeriksaID' => 'Jenis Periksa ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotas()
    {
        return $this->hasMany(Nota::className(), ['pemeriksaanID' => 'pemeriksaanID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJenisPeriksa()
    {
        return $this->hasOne(Jenisperiksa::className(), ['jenisPeriksaID' => 'jenisPeriksaID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPendaftran()
    {
        return $this->hasOne(Pendaftaran::className(), ['pendaftaranID' => 'pendaftranID']);
    }
}
