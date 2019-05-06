<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "detailresep".
 *
 * @property int $detailResepID
 * @property int $obatID
 * @property string $detailResepDosis
 * @property int $resepID
 * @property int $detailResepQuantity
 * @property int $detailResepSubtotal
 *
 * @property Resep $resep
 * @property Obat $obat
 */
class DetailResep extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detailresep';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['obatID', 'resepID', 'detailResepQuantity', 'detailResepSubtotal'], 'integer'],
            [['detailResepDosis'], 'string', 'max' => 15],
            [['resepID'], 'exist', 'skipOnError' => true, 'targetClass' => Resep::className(), 'targetAttribute' => ['resepID' => 'resepID']],
            [['obatID'], 'exist', 'skipOnError' => true, 'targetClass' => Obat::className(), 'targetAttribute' => ['obatID' => 'obatID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'detailResepID' => 'Detail Resep ID',
            'obatID' => 'Obat ID',
            'detailResepDosis' => 'Detail Resep Dosis',
            'resepID' => 'Resep ID',
            'detailResepQuantity' => 'Detail Resep Quantity',
            'detailResepSubtotal' => 'Detail Resep Subtotal',
        ];
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
    public function getObat()
    {
        return $this->hasOne(Obat::className(), ['obatID' => 'obatID']);
    }
}
