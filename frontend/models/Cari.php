<?php

namespace frontend\models;

use Yii;


class Cari extends \yii\db\ActiveRecord
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
            [['detailResepDosis'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'detailResepDosis' => 'Search Code',
        ];
    }

}
