<?php
/**
 * Created by PhpStorm.
 * User: steven
 * Date: 2016/12/29
 * Time: 上午10:43
 */

namespace frontend\controllers;


use common\helper\StringHelper;
use common\models\Course;
use common\models\GetOutIpList;
use common\models\User;
use common\models\YyLiveRoom;
use yii\web\Controller;
use yii\web\Response;

class LiveController extends Controller
{
    /**
     * 直播室
     * @return string
     */
    public function actionIndex()
    {
        $clientIp = $_SERVER['REMOTE_ADDR'];
        $userInfo = \Yii::$app->user->identity;
        if(!empty($userInfo)){
            $user = GetOutIpList::findOne(['user_uuid' => $userInfo->uuid]);
        }else{

            $user = GetOutIpList::findOne(['ip' => $clientIp]);
        }

        if(!empty($user)){
            $this->redirect(['site/close']);
        }
        $course = Course::findAll(['status' => 1]);
        $yy = YyLiveRoom::findOne(['status' => 1]);

        $this->layout = 'live';
        return $this->render('index',[
            'course' => $course,
            'yy' => $yy,
            'ip' => $clientIp
        ]);
    }


    /**
     * 查询账号的uuid
     * @return array
     */
    public function actionSetUserStatus()
    {
        $request = \Yii::$app->request;
        if($request->isPost){
            \Yii::$app->response->format = Response::FORMAT_JSON;
            $username = $request->post('username');
            $user = User::findByUsername($username);
            if(empty($user)){
                return ['err_code' => 1, 'err_msg' => '未知错误,禁言失败'];
            }

            if($user->role == User::ROLE_MASTER){
                return ['err_code' => 2];
            }
            $user->status = User::STATUS_SHUT_UP;
            $user->update_time = time();
            $user->save();
            return ['err_code' => 0 ,'err_msg' => '禁言成功'];
        }
    }

    public function actionSetUserIp()
    {
        $request = \Yii::$app->request;
        if($request->isPost){
            \Yii::$app->response->format = Response::FORMAT_JSON;
            $username = $request->post('username');
            $user = User::findByUsername($username);
            if(empty($user)){
                return ['err_code' => 1, 'err_msg' => '未知错误,踢人失败'];
            }
            $getOut = new GetOutIpList();
            $getOut->uuid = StringHelper::generateUuid();
            $getOut->ip = $_SERVER['REMOTE_ADDR'];
            $getOut->create_time = time();
            $getOut->user_uuid = $user->uuid;
            $getOut->save();
            return ['err_code' => 0 ,'err_msg' => '踢人成功'];
        }
    }

    public function actionSetUser()
    {
        $request = \Yii::$app->request;
        if($request->isPost){
            \Yii::$app->response->format = Response::FORMAT_JSON;
            $username = $request->post('username');
            $user = User::findByUsername($username);
            if(empty($user)){
                return ['err_code' => 1, 'err_msg' => '未知错误,禁言失败'];
            }

            if($user->role == User::ROLE_MASTER){
                return ['err_code' => 2];
            }
            $user->status = User::STATUS_SHUT_UP;
            $user->update_time = time();
            $getOut = new GetOutIpList();
            $getOut->uuid = StringHelper::generateUuid();
            $getOut->ip = $_SERVER['REMOTE_ADDR'];
            $getOut->create_time = time();
            $getOut->user_uuid = $user->uuid;
            $getOut->save();
            $user->save();
            return ['err_code' => 0 ,'err_msg' => '操作成功'];
        }
    }

    /**
     * 保存到桌面
     */
    public function actionDownload()
    {
        $filename = '3+3直播室.url';
        $url = 'http://www.xinxiacj.com';
        // 创建基本代码
        $shortCut = "[InternetShortcut]\r\nIDList=[{000214A0-0000-0000-C000-000000000046}]\r\nProp3=19,2\r\n";
        $shortCut .= "URL=".$url."\r\n";
        header("content-type:application/octet-stream");

        // 获取用户浏览器
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $encode_filename = rawurlencode($filename);

        // 不同浏览器使用不同编码输出
        if(preg_match("/MSIE/", $user_agent)){
            header('content-disposition:attachment; filename="'.$encode_filename.'"');
        }else if(preg_match("/Firefox/", $user_agent)){
            header("content-disposition:attachment; filename*=\"utf8''".$filename.'"');
        }else{
            header('content-disposition:attachment; filename="'.$filename.'"');
        }

        echo $shortCut;
    }
}