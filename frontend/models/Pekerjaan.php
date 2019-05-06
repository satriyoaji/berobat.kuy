<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "pekerjaan".
 *
 * @property int $pekerjaanID
 * @property string $pekerjaanNama
 *
 * @property Users[] $users
 */
class Pekerjaan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pekerjaan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pekerjaanNama'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pekerjaanID' => 'Pekerjaan ID',
            'pekerjaanNama' => 'Pekerjaan Nama',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::className(), ['userPekerjaan' => 'pekerjaanID']);
    }
}
