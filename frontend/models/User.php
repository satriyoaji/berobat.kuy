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
            [['username', 'userPassword'], 'required'],
            [['username', 'userPassword'], 'string', 'max' => 100]            
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'username' => 'Username',
            'userPassword' => 'Password',
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
   
    public function validateAuthKey($authKey)
    {
        //throw new \yii\base\NotSupportedException();
    }
    public function validatePassword($userPassword, $roles_id)
    {
        return $this->userPassword === sha1($userPassword);
    }
}
