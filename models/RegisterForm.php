<?php

namespace app\models;

use Yii;
use yii\base\Model;

class RegisterForm extends Model
{
    public $name;
    public $password;
    public $repeat_password;
    public $email;

    public function rules()
    {
        return [

            ['name', 'trim'],
            ['name', 'required'],
            ['name', 'unique', 'targetClass' => '\app\models\User', 'message' => '用户名已经存在'],
            ['name', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => '邮箱已经存在'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['password', 'validatePassword'],

            ['repeat_password', 'required'],
            ['repeat_password', 'string', 'min' => 6],
            ['repeat_password', 'validatePassword'],
        ];
    }

    public function validatePassword($attribute, $params)
    {
        // 判断密码是否相同
        if ($this->password != $this->repeat_password) {
            $this->addError($attribute, '两次密码不相同');
        }
    }

    public function register()
    {
        if (!$this->validate()) {
            return null;
        }

        $user           = new User();
        $user->name     = $this->name;
        $user->email    = $this->email;
        $user->password = User::setPassword($this->password);
        // 保存用户信息
        return $user->save() ? $user : null;
    }

    public function attributeLabels()
    {
        return [
            'name'            => '用户名',
            'email'           => '邮箱',
            'password'        => '密码',
            'repeat_password' => '重复密码',
        ];
    }


}