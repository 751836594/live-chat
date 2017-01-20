<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "yy_live_room".
 *
 * @property integer $id
 * @property string $uuid
 * @property string $yy_room
 * @property string $room_teacher
 * @property integer $create_time
 * @property integer $update_time
 * @property string $description
 * @property integer $status
 */
class YyLiveRoom extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'yy_live_room';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uuid', 'yy_room', 'room_teacher', 'create_time', 'update_time'], 'required'],
            [['create_time', 'update_time', 'status'], 'integer'],
            [['description'], 'string'],
            [['uuid', 'yy_room', 'room_teacher'], 'string', 'max' => 45],
            [['uuid'], 'unique'],
            [['yy_room'], 'unique'],
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
            'yy_room' => 'Yy Room',
            'room_teacher' => 'Room Teacher',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'description' => 'Description',
            'status' => 'Status',
        ];
    }
}
