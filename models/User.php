<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $avatar
 * @property string $auth_key
 * @property int $follower_count
 * @property int $followed_count
 * @property string $updated_at
 * @property string $created_at
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
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
            [['name', 'email', 'password'], 'required'],
            [['follower_count', 'followed_count'], 'integer'],
            [['updated_at', 'created_at'], 'safe'],
            [['name', 'email', 'password', 'avatar', 'auth_key'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'             => 'ID',
            'name'           => 'Name',
            'email'          => 'Email',
            'password'       => 'Password',
            'avatar'         => 'Avatar',
            'auth_key'       => 'Auth Key',
            'follower_count' => 'Follower Count',
            'followed_count' => 'Followed Count',
            'updated_at'     => 'Updated At',
            'created_at'     => 'Created At',
        ];
    }

    // 通过 ID 获取用户
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    // 通过加密令牌获取用户
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    // 通过邮箱获取用户
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    // 获取当前对象的用户 id
    public function getId()
    {
        return $this->id;
    }

    // 获取基于 cookie 登陆时的认证密钥
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    // 验证密钥
    public function validateAuthKey($authKey)
    {
        return $this->auth_key = $authKey;
    }

    // 判断两次输入密码是否一致
    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

    public static function setPassword($password)
    {
        return Yii::$app->getSecurity()->generatePasswordHash($password);
    }

    public function getBlogs()
    {
        return $this->hasMany(Blog::className(), ['user_id' => 'id']);
    }

}
