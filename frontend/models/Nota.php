<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "nota".
 *
 * @property int $notaID
 * @property int $kasirID
 * @property int $notaTotalHarga
 * @property int $pemeriksaanID
 * @property int $resepID
 * @property string $notaStatus
 *
 * @property Users $kasir
 * @property Resep $resep
 * @property Pemeriksaan $pemeriksaan
 */
class Nota extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nota';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kasirID', 'notaTotalHarga', 'pemeriksaanID', 'resepID'], 'integer'],
            [['notaStatus'], 'string', 'max' => 15],
            [['kasirID'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['kasirID' => 'userId']],
            [['resepID'], 'exist', 'skipOnError' => true, 'targetClass' => Resep::className(), 'targetAttribute' => ['resepID' => 'resepID']],
            [['pemeriksaanID'], 'exist', 'skipOnError' => true, 'targetClass' => Pemeriksaan::className(), 'targetAttribute' => ['pemeriksaanID' => 'pemeriksaanID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'notaID' => 'Nota ID',
            'kasirID' => 'Kasir ID',
            'notaTotalHarga' => 'Nota Total Harga',
            'pemeriksaanID' => 'Pemeriksaan ID',
            'resepID' => 'Resep ID',
            'notaStatus' => 'Nota Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKasir()
    {
        return $this->hasOne(Users::className(), ['userId' => 'kasirID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResep()
    {
        return $this->hasOne(Resep::className(), ['resepID' => 'resepID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPemeriksaan()
    {
        return $this->hasOne(Pemeriksaan::className(), ['pemeriksaanID' => 'pemeriksaanID']);
    }
}
