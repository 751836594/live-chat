<?php
/**
 * @copyright Copyright (c) 2016 沃米优选
 * @create: 5/18/16 12:02 AM
 */
namespace admin\models;

use yii\db\ActiveRecord;

/**
 * 角色和权限之间的关系
 *
 * Class AuthItemChild
 * @package admin\models
 * @author Pony Gu <pony@51wom.com>
 * @since 1.0
 *
 * @property string $parent
 * @property string $child
 */
class AuthItemChild extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return 'wom_admin_account_auth_item_child';
    }

    public function attributeLabels()
    {
        return array();
    }
}