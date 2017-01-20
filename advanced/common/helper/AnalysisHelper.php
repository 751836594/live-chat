<?php
/**
 * Created by PhpStorm.
 * User: steven
 * Date: 2016/12/21
 * Time: 上午10:27
 */

namespace common\helper;


class AnalysisHelper
{

    /**
     * 解析XML格式数据,返回Array
     * @param $xml
     * @return mixed
     */
    public static function xml_to_array($xml){
        $reg = "/<(\w+)[^>]*>([\\x00-\\xFF]*)<\\/\\1>/";
        if(preg_match_all($reg, $xml, $matches)){
            $count = count($matches[0]);
            for($i = 0; $i < $count; $i++){
                $subxml= $matches[2][$i];
                $key = $matches[1][$i];
                if(preg_match( $reg, $subxml )){
                    $arr[$key] = self::xml_to_array( $subxml );
                }else{
                    $arr[$key] = $subxml;
                }
            }
        }
        return $arr;
    }
}