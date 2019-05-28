<?php
namespace frontend\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
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

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userPekerjaan'], 'integer'],
            [['username', 'password'], 'required'],
            [['username', 'password'], 'string', 'max' => 100]            
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'username' => 'Username',
            'password' => 'Password',
            'userPekerjaan' => 'User Pekerjaan',
        ];
    } 
    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }
    public static function findIdentityByAccessToken($token, $type = null)
    {
          throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }
    
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

  
    public function getId()
    {
        
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        return $this->id;
    }

    public function getuserPekerjaan()
    {
        
        return $this->userPekerjaan;
    }
   
    public function validateAuthKey($authKey)
    {
        //throw new \yii\base\NotSupportedException();
    }
    public function validatePassword($password)
    {
        return $this->password === sha1($password);
    }

    public function getUserPekerjaan0()
    {
        return $this->hasOne(Pekerjaan::className(), ['pekerjaanID' => 'userPekerjaan']);
    }
}
