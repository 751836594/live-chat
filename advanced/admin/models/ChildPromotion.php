<?php

namespace admin\models;

use Yii;

/**
 */
class ChildPromotion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'child_promotion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [];
    }


}
