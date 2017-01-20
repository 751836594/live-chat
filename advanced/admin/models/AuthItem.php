<?php
/**
 * @copyright Copyright (c) 2016 沃米优选
 * @create: 5/18/16 12:02 AM
 */
namespace admin\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * 角色（role）和权限（permission）表
 * Class AuthItem
 * @package erm\models
 * @author Pony Gu <pony@51wom.com>
 * @since 1.0
 *
 * @property integer id
 * @property string $name
 * @property string $cn_name
 * @property integer $type
 * @property string $description
 * @property string $rule_name
 * @property integer $create_time
 * @property integer $last_update_time
 */
class AuthItem extends ActiveRecord
{
    const TYPE_ROLE = 1; // 角色
    const TYPE_PERMISSION = 2; // 权限

    const ROLE_SUPER_ADMIN = 'r-super-admin'; // 超级管理员
    const ROLE_ADMIN = 'r-admin'; // 管理员

    /**
     * @return string
     */
    public static function tableName()
    {
        return 'wom_admin_account_auth_item';
    }

    public function attributeLabels()
    {
        return array();
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['create_time', 'last_update_time'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['last_update_time']
                ],
            ]
        ];
    }
}