<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "websit_setting".
 *
 * @property integer $id
 * @property string $uuid
 * @property string $banner
 * @property string $yy
 * @property string $qq
 * @property string $wei_chat
 * @property string $background
 */
class WebsitSetting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'websit_setting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uuid'], 'required'],
            [['banner', 'yy', 'qq', 'wei_chat', 'background'], 'string'],
            [['uuid'], 'string', 'max' => 45],
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
            'banner' => 'Banner',
            'yy' => 'Yy',
            'qq' => 'Qq',
            'wei_chat' => 'Wei Chat',
            'background' => 'Background',
        ];
    }
}
