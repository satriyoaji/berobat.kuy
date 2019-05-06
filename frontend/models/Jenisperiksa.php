<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "jenisperiksa".
 *
 * @property int $jenisPeriksaID
 * @property string $jenisPeriksaNama
 *
 * @property Pemeriksaan $pemeriksaan
 */
class Jenisperiksa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jenisperiksa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['jenisPeriksaNama'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'jenisPeriksaID' => 'Jenis Periksa ID',
            'jenisPeriksaNama' => 'Jenis Periksa Nama',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPemeriksaan()
    {
        return $this->hasOne(Pemeriksaan::className(), ['jenisPeriksaID' => 'jenisPeriksaID']);
    }
}
