<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\db\Query;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        $astaga=0;
        if (!$this->hasErrors()) {
            
            $user = $this->getUser();
            $query = (new Query())
                    ->from('users')
                    ->where('username = :username', [':username' => $this->username]);
            foreach ($query->each() as $rows) {
                $id=$rows['id'];
            }
            //$user = $this->getUser();
                if (!$user || !$user->validatePassword($this->password, $astaga) ) {
                        $this->addError($attribute, 'Username and Password did not match');
                }
                else{
                    $_SESSION['id']=$id;
                }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
