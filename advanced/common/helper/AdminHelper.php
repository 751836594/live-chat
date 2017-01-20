<?php
namespace  common\helper;
/**
 * Created by PhpStorm.
 * User: steven
 * Date: 2016/12/20
 * Time: 下午2:14
 */
class AdminHelper
{

    public static function getPageSize()
    {
        return \Yii::$app->params['admin.page-size'];
    }
}