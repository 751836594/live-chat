<?php
/**
 * Created by PhpStorm.
 * User: steven
 * Date: 2016/12/21
 * Time: 下午3:56
 */

namespace common\helper;


class ApiHelper
{
    public static function getMobileAddress($mobile='13488888888')
    {
        $phoneAddress= file_get_contents('http://sj.apidata.cn/?mobile='.$mobile);
        $data = json_decode($phoneAddress,true);
        $province = $data['data']['province'];
        $city = $data['data']['city'];
        $types = $data['data']['types'];
        $address = $province.'省'.$city.'市'.$types;

        return $address;
    }

    public static function getIpAddress($ip='180.175.208.209')
    {
        $ipAddress = file_get_contents("http://ip.taobao.com/service/getIpInfo.php?ip=".$ip);
        $data = json_decode($ipAddress,true);
        $country = $data['data']['country'];
        $region = $data['data']['region'];
        $city = $data['data']['city'];
        $isp = $data['data']['isp'];
        $address = $country.$region.$city.$isp;

        return $address;
    }

    public static function getFullHost()
    {
        return 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
    }


    public static function getClientType()
    {
        $params = \Yii::$app->params;
        if(isset($_SERVER['HTTP_X_WAP_PROFILE'])){
            $client = $params['promotion.client']['WAP'];
        }else{
            $client = $params['promotion.client']['PC'];
        }

        return $client;
    }
}
