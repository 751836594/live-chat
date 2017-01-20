<?php
namespace  common\helper;
use yii\base\Object;

/**
 * Created by PhpStorm.
 * User: steven
 * Date: 2016/12/29
 * Time: 上午11:04
 */
class DataHelper
{

    public static function getCurrentUser()
    {
        $user = \Yii::$app->user->identity;
        if(!empty($user)){
            return $user->username;
        }else{
            return '游客_'.StringHelper::generateTouristName();
        }
    }

    public static function getRoleImg()
    {
        $user = \Yii::$app->user->identity;
        if(empty($user)){
            $img = 'User14.png';
        }else{
            switch ($user->role){
                case  1:
                    $img = 'role1.png';
                    break;
                case 10:
                    $img = 'master.jpeg';
                    break;
            }

        }

        return $img;
    }
}