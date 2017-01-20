<?php
/**
 * @copyright Copyright (c) 2016 沃米优选
 * @create: 5/18/16 12:02 AM
 */
namespace admin\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * 将角色（role）or 权限（permission） 分配给用户（user）
 *
 * Class AuthAssignment
 * @package admin\models
 * @author Pony Gu <pony@51wom.com>
 * @since 1.0
 *
 * @property integer $id
 * @property string $account_uuid
 * @property string $auth_item
 * @property integer $create_time
 */
class AuthAssignment extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return 'wom_admin_account_auth_assignment';
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
                    ActiveRecord::EVENT_BEFORE_INSERT => ['create_time']
                ],
            ]
        ];
    }
}