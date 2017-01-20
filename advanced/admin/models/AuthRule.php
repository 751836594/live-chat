<?php
/**
 * @copyright Copyright (c) 2016 沃米优选
 * @create: 5/18/16 12:02 AM
 */
namespace admin\models;

use yii\db\ActiveRecord;

/**
 * 定义规则(rule)
 *
 * Class AuthRule
 * @package admin\models
 * @author Pony Gu <pony@51wom.com>
 * @since 1.0
 *
 * @property string $name
 * @property string $cn_name
 * @property string $data
 * @property integer $create_time
 * @property integer $last_update_time
 */
class AuthRule extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return 'wom_admin_account_auth_rule';
    }

    public function attributeLabels()
    {
        return array();
    }
}