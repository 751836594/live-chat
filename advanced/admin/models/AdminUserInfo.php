<?php
/**
 * @copyright Copyright (c) 2016 沃米优选
 * @create: 5/18/16 12:02 AM
 */
namespace admin\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * WOM Admin账户表
 *
 * Class Account
 * @package admin\models
 * @author Pony Gu <pony@51wom.com>
 * @since 1.0
 *
 * @property integer $id
 * @property string $uuid
 * @property string $auth_key
 * @property string $login_account
 * @property string $login_password
 * @property string $user_name
 * @property integer $last_login_time
 * @property integer $status
 */
class AdminUserInfo extends ActiveRecord implements IdentityInterface
{
    public $rememberMe = true;

    const STATUS_ENABLED = 1; //有效
    const STATUS_DISABLED = 0; //无效

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_user_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
        ];
    }

    /**
     * @param int|string $uuid
     * @return null|static
     */
    public static function findIdentity($uuid)
    {
        return static::findOne(['uuid' => $uuid, 'status' => self::STATUS_ENABLED]);
    }

    /**
     * @param $account
     * @return null|static
     */
    public static function findByAccount($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ENABLED]);
    }

    /**
     * @param mixed $token
     * @param null $type
     * @return void|IdentityInterface
     * @throws NotSupportedException
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|integer an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        return $this->uuid;
    }

    /**
     * 获取用户名
     * @return mixed
     */
    public function getUserName()
    {
        return $this->nike_name;
    }

    /**
     * 获取登录的用户账号
     * @return string
     */
    public function getLoginAccount()
    {
        return $this->username;
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return boolean whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->login_password = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->auth_key = Yii::$app->getSecurity()->generateRandomString();
            }
            return true;
        }
        return false;
    }
}
