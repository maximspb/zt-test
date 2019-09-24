<?php

namespace app\models;

use Yii;
use yii\base\Exception;
use yii\base\Model;
use yii\web\NotFoundHttpException;

class SwitchUserForm extends Model
{
    public $username;

    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['username'], 'required'],
            ['rememberMe', 'boolean'],
        ];
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->switchIdentity($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * @return User|bool|null
     * @throws Exception
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
            if (empty($this->_user)) {
                throw new NotFoundHttpException('Пользователь с таким ником не найден');
            }
        }

        return $this->_user;
    }
}