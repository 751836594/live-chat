<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "get_out_ip_list".
 *
 * @property integer $id
 * @property string $uuid
 * @property string $user_uuid
 * @property integer $ip
 * @property integer $create_time
 */
class GetOutIpList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'get_out_ip_list';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [];
    }


}
