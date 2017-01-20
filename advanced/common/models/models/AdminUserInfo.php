<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "admin_user_info".
 *
 * @property integer $id
 * @property string $uuid
 * @property string $username
 * @property string $password
 * @property string $nike_name
 * @property integer $sex
 * @property integer $mobile_phone
 * @property integer $status
 * @property string $auth_key
 * @property integer $role
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $last_login_time
 */
class AdminUserInfo extends \yii\db\ActiveRecord
{
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
            [['uuid', 'username', 'password', 'nike_name', 'sex', 'mobile_phone', 'create_time', 'update_time', 'last_login_time'], 'required'],
            [['sex', 'mobile_phone', 'status', 'role', 'create_time', 'update_time', 'last_login_time'], 'integer'],
            [['uuid', 'username', 'nike_name', 'auth_key'], 'string', 'max' => 45],
            [['password'], 'string', 'max' => 100],
            [['uuid'], 'unique'],
            [['username'], 'unique'],
            [['password'], 'unique'],
            [['mobile_phone'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uuid' => 'Uuid',
            'username' => 'Username',
            'password' => 'Password',
            'nike_name' => 'Nike Name',
            'sex' => 'Sex',
            'mobile_phone' => 'Mobile Phone',
            'status' => 'Status',
            'auth_key' => 'Auth Key',
            'role' => 'Role',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'last_login_time' => 'Last Login Time',
        ];
    }
}
