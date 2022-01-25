<?php

namespace app\models;

use yii\base\Model;

class SignupForm extends Model
{
    public $username;
    public $password;
    public $email;

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['username', 'email'], 'unique', 'targetClass' => User::class],
            ['email', 'email']
        ];
    }

    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->password_hash = \Yii::$app->security->generatePasswordHash($this->password);
            if ($user->save()) {
                return true;
            }
        }
        return false;
    }
}