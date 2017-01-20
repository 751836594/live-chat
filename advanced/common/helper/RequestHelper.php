<?php
/**
 * Created by PhpStorm.
 * User: steven
 * Date: 2016/12/21
 * Time: 上午10:25
 */

namespace common\helper;


class RequestHelper
{
    /**
     * 模拟发送POST请求
     * @param $curlPost
     * @param $url
     * @return mixed
     */
    public static function Post($curlPost,$url){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_NOBODY, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
        $return_str = curl_exec($curl);
        curl_close($curl);
        return $return_str;
    }
}