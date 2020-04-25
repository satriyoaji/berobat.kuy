<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "artikel".
 *
 * @property int $artikelID
 * @property string $isiArtikel
 */
class Artikel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'artikel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['isiArtikel'], 'required'],
            [['isiArtikel'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'artikelID' => 'Artikel ID',
            'isiArtikel' => 'Isi Artikel',
        ];
    }
}
