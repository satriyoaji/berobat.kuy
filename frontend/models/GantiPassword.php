<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $userId
 * @property string $username
 * @property string $userNama
 * @property string $password
 * @property string $userEmail
 * @property string $userTelephone
 * @property string $userAlamat
 * @property int $userPekerjaan
 * @property string $userFoto
 * @property string $userTanggalLahir
 * @property string $userJenisKelamin
 *
 * @property Jadwaldokter[] $jadwaldokters
 * @property Nota[] $notas
 * @property Pendaftaran[] $pendaftarans
 * @property Pendaftaran[] $pendaftarans0
 * @property Resep[] $reseps
 * @property Pekerjaan $userPekerjaan0
 */
class GantiPassword extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'userNama', 'userEmail', 'userTelephone', 'userAlamat'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Password Lama',
            'userNama' => 'Password Baru',
            'userEmail' => 'Verifikasi Password Baru',
        ];
    }
}
