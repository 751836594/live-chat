<?php
/**
 * Created by PhpStorm.
 * User: steven
 * Date: 2016/12/29
 * Time: 上午11:07
 */

namespace common\helper;
use yii\base\Security;

class StringHelper 
{
    public static function generateTouristName()
    {
        return (new Security())->generateRandomString(7);
    }

    public static function generateUuid()
    {
        return time().(new Security())->generateRandomString(7);
    }

    public static function randomSmsVerifyCode($length = 6 , $numeric = 0) {
        PHP_VERSION < '4.2.0' && mt_srand((double)microtime() * 1000000);
        if($numeric) {
            $hash = sprintf('%0'.$length.'d', mt_rand(0, pow(10, $length) - 1));
        } else {
            $hash = '';
            $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789abcdefghjkmnpqrstuvwxyz';
            $max = strlen($chars) - 1;
            for($i = 0; $i < $length; $i++) {
                $hash .= $chars[mt_rand(0, $max)];
            }
        }
        return $hash;
    }
}