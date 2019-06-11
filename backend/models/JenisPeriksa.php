<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "jenisperiksa".
 *
 * @property int $jenisPeriksaID
 * @property string $jenisPeriksaNama
 * @property int $jenisPeriksaHarga
 *
 * @property Pemeriksaan[] $pemeriksaans
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
            [['jenisPeriksaHarga'], 'integer'],
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
            'jenisPeriksaHarga' => 'Jenis Periksa Harga',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPemeriksaans()
    {
        return $this->hasMany(Pemeriksaan::className(), ['jenisPeriksaID' => 'jenisPeriksaID']);
    }
}
