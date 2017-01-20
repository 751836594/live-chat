<?php

namespace admin\models;

use Yii;

/**
 */
class BasePromotion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'base_promotion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [];
    }


}
