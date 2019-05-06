<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "obat".
 *
 * @property int $obatID
 * @property string $obatNama
 * @property int $obatHarga
 * @property string $obatGolongan
 * @property string $obatFoto
 *
 * @property Detailresep[] $detailreseps
 */
class Obat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'obat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['obatHarga'], 'integer'],
            [['obatNama'], 'string', 'max' => 30],
            [['obatGolongan'], 'string', 'max' => 15],
            [['obatFoto'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'obatID' => 'Obat ID',
            'obatNama' => 'Obat Nama',
            'obatHarga' => 'Obat Harga',
            'obatGolongan' => 'Obat Golongan',
            'obatFoto' => 'Obat Foto',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetailreseps()
    {
        return $this->hasMany(Detailresep::className(), ['obatID' => 'obatID']);
    }
}
