<?php
/**
 * Created by PhpStorm.
 * User: steven
 * Date: 2016/12/23
 * Time: 下午1:20
 */

namespace admin\helpers;


use admin\models\BasePromotion;
use admin\models\ChildPromotion;


class DataHelper
{
    public static function getAllBasePromotionUrl()
    {
        return BasePromotion::findAll(['status' => 1]);
    }


    public static function getPromotionDescription($url)
    {
        $string = '无';
        if(empty($url)){
            return $string;
        }
        $urlArr = explode('?',$url);
        if(empty($urlArr[1])){
            return $string;
        }
        $dataArr = explode('=',$urlArr[1]);
        if(empty($dataArr[1])){
            return $string;
        }
        $key = $dataArr[1];
        $parentObj = BasePromotion::findOne(['uuid' => $key]);
        if(empty($parentObj)){
            $childObj = ChildPromotion::findOne(['uuid' => $key]);
            if(empty($childObj)){
                return $string;
            }else{
                return $childObj->name;
            }
        }else{
            return $parentObj->name;
        }
    }
}