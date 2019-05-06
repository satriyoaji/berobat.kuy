<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $userId
 * @property string $username
 * @property string $userNama
 * @property string $userPassword
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
class Users extends \yii\db\ActiveRecord
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
            [['userPekerjaan'], 'integer'],
            [['username', 'userNama', 'userPassword', 'userEmail', 'userTelephone', 'userAlamat'], 'string', 'max' => 30],
            [['userFoto'], 'string', 'max' => 50],
            [['userTanggalLahir'], 'string', 'max' => 20],
            [['userJenisKelamin'], 'string', 'max' => 15],
            [['userPekerjaan'], 'exist', 'skipOnError' => true, 'targetClass' => Pekerjaan::className(), 'targetAttribute' => ['userPekerjaan' => 'pekerjaanID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'userId' => 'User ID',
            'username' => 'Username',
            'userNama' => 'User Nama',
            'userPassword' => 'User Password',
            'userEmail' => 'User Email',
            'userTelephone' => 'User Telephone',
            'userAlamat' => 'User Alamat',
            'userPekerjaan' => 'User Pekerjaan',
            'userFoto' => 'User Foto',
            'userTanggalLahir' => 'User Tanggal Lahir',
            'userJenisKelamin' => 'User Jenis Kelamin',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJadwaldokters()
    {
        return $this->hasMany(Jadwaldokter::className(), ['dokterID' => 'userId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotas()
    {
        return $this->hasMany(Nota::className(), ['kasirID' => 'userId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPendaftarans()
    {
        return $this->hasMany(Pendaftaran::className(), ['pasienID' => 'userId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPendaftarans0()
    {
        return $this->hasMany(Pendaftaran::className(), ['dokterID' => 'userId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReseps()
    {
        return $this->hasMany(Resep::className(), ['apotekerID' => 'userId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserPekerjaan0()
    {
        return $this->hasOne(Pekerjaan::className(), ['pekerjaanID' => 'userPekerjaan']);
    }
}
