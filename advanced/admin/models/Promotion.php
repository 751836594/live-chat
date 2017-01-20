<?php

namespace admin\models;

use Yii;

/**
 * This is the model class for table "promotion".
 *
 * @property integer $id
 * @property string $uuid
 * @property string $username
 * @property integer $industry_type
 * @property integer $promotion_platform
 * @property integer $user_status
 * @property integer $create_time
 * @property integer $client
 * @property integer $mobile_phone_num
 * @property string $mobile_phone_address
 * @property integer $mobile_phone_type
 * @property string $keyword
 * @property string $keyword_url
 * @property string $ip
 * @property string $ip_address
 */
class Promotion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'promotion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uuid', 'industry_type', 'promotion_platform', 'user_status', 'create_time', 'client', 'mobile_phone_num', 'mobile_phone_address', 'mobile_phone_type'], 'required'],
            [['industry_type', 'promotion_platform', 'user_status', 'create_time', 'client', 'mobile_phone_num', 'mobile_phone_type'], 'integer'],
            [['keyword_url'], 'string'],
            [['uuid', 'username', 'mobile_phone_address', 'keyword', 'ip', 'ip_address'], 'string', 'max' => 45],
            [['uuid'], 'unique'],
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
            'industry_type' => 'Industry Type',
            'promotion_platform' => 'Promotion Platform',
            'user_status' => 'User Status',
            'create_time' => 'Create Time',
            'client' => 'Client',
            'mobile_phone_num' => 'Mobile Phone Num',
            'mobile_phone_address' => 'Mobile Phone Address',
            'mobile_phone_type' => 'Mobile Phone Type',
            'keyword' => 'Keyword',
            'keyword_url' => 'Keyword Url',
            'ip' => 'Ip',
            'ip_address' => 'Ip Address',
        ];
    }
}
