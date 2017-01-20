<?php
/**
 * Created by PhpStorm.
 * User: steven
 * Date: 2016/12/30
 * Time: 下午2:18
 */

namespace frontend\controllers;


use common\helper\AnalysisHelper;
use common\helper\RequestHelper;
use common\helper\StringHelper;
use common\models\User;
use yii\web\Controller;
use yii\web\Response;

class AccountController extends Controller
{

    /**
     * 注册页面
     * @return string
     */
    public function actionReg()
    {
        $this->layout = 'account';
        return $this->render('reg');
    }


    /**
     * 注册账号
     * @return array
     */
    public function actionVerifyReg()
    {
        $request = \Yii::$app->request;
        \Yii::$app->response->format = Response::FORMAT_JSON;
        if($request->isPost){
            $nikeName = $request->post('nike_name');
            $password = $request->post('pass');
            $qq = $request->post('qq');
            $phone = $request->post('phone');
            $weChat = $request->post('we_chat');
            $uuid = StringHelper::generateUuid();
            $userAccount = new User();
            $hashPassword = $userAccount->setPassword($password);
            $userAccount->uuid = $uuid;
            $userAccount->username = $nikeName;
            $userAccount->phone = $phone;
            $userAccount->password = $hashPassword;
            $userAccount->qq = $qq;
            $userAccount->wechat = $weChat;
            $userAccount->create_time = time();
            $userAccount->update_time = time();
            $userAccount->last_login_time = time();

            if($userAccount->save() && \Yii::$app->user->login($userAccount,3600*24*30)){
                return ['err_code' => 0, 'err_msg' => '注册成功'];
            }else{
                return ['err_code' => 1, 'err_msg' => '注册失败'];
            }


        }
    }


    /**
     * 登录页面
     * @return string
     */
    public function actionLogin()
    {
        $this->layout = 'account';
        return $this->render('login');
    }


    public function actionVerifyLogin()
    {
        $request = \Yii::$app->request;
        \Yii::$app->response->format = Response::FORMAT_JSON;
        if($request->isPost){
            $password = $request->post('pass');
            $phone = $request->post('phone');
            $userAccount = new User();
            $user = $userAccount::findOne(['phone'=>$phone]);
            if(empty($user)){
                return ['err_code' => 1, 'err_msg' => '该账号暂未注册'];
            }
            if($user->validatePassword($password) && \Yii::$app->user->login($user,3600*24*30)){
                $user->last_login_time = time();
                $user->save();
                return ['err_code' => 0,'url' => \Yii::$app->urlManager->createUrl(['live/index'])];

            }else{
                return ['err_code' => 2, 'err_msg' => '账号或密码错误'];
            }
        }

    }

    /**
     * ajax验证账号手机号是否被注册
     * @return array
     */
    public function actionAsyncCheckRegPhone()
    {
        $request = \Yii::$app->request;
        \Yii::$app->response->format = Response::FORMAT_JSON;
        if ($request->isPost) {
            $phone = $request->post('phone');
            $user = User::findByPhoneNum($phone);
            if(empty($user)){
                return ['err_code' => 0,'err_msg' => '手机号暂未注册'];
            }else{
                return ['err_code' =>1, 'err_msg' => '该账号已被注册'];
            }
        }
    }

    /**
     * ajax验证账号是否被注册
     * @return array
     */
    public function actionAsyncCheckRegNikeName()
    {
        $request = \Yii::$app->request;
        \Yii::$app->response->format = Response::FORMAT_JSON;
        if ($request->isPost) {
            $username = $request->post('nike_name');
            $user = User::findByUsername($username);
            if(empty($user)){
                return ['err_code' => 0,'err_msg' => '用户名暂未注册'];
            }else{
                return ['err_code' =>1, 'err_msg' => '此用户名已经存在'];
            }
        }
    }


    /**
     * 登出
     * @return Response
     */
    public function actionLogout()
    {
        \Yii::$app->user->logout();

        return $this->goHome();
    }


    /**
     * 修改密码
     * @return string
     */
    public function actionModify()
    {
        $this->layout = 'account';
        return $this->render('modify');
    }

    public function actionSendSms()
    {
        $session = \Yii::$app->session;
        $request = \Yii::$app->request;
        if($request->isPost){
            \Yii::$app->response->format = Response::FORMAT_JSON;
            $mobile = $request->post('phone');
            $target = "http://106.ihuyi.cn/webservice/sms.php?method=Submit";
            $mobile_code = StringHelper::randomSmsVerifyCode(4,1);
            $verifyString = rawurlencode("您的验证码是：".$mobile_code."。请不要把验证码泄露给其他人。");
            $postData="account=cf_xinxia&password=a5fafd61122c72952b2c77506a59b1d9&mobile=".$mobile."&content=".$verifyString;
            $gets =  AnalysisHelper::xml_to_array(RequestHelper::Post($postData, $target));
            if($gets['SubmitResult']['code']!=2){
                if ($gets['SubmitResult']['code']==4085){
                    return ['err_code' => 2,'err_msg' => '发送失败,每天最多发送5条'];
                }else{
                    return ['err_code' => 1,'err_msg' => '发送失败'];
                }
            }
            $session->set('mobile',$mobile);
            $session->set('sms_code',$mobile_code);
            return ['err_code' => 0,'err_msg' => '发送成功'];
        }
    }


    public function actionVerifyModifyPass()
    {
        $session = \Yii::$app->session;
        $request = \Yii::$app->request;
        if($request->isPost) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            $mobile = $request->post('phone');
            $pass = $request->post('pass');
            $verify = $request->post('verify');
            if($session->get('mobile') == $mobile && $session->get('sms_code') == $verify){

                $user = User::findByPhoneNum($mobile);
                if(empty($user)){
                    return ['err_code' => 1, 'err_msg' => '账号不存在'];
                }
                $hashPass = (new User())->setPassword($pass);
                $user->password = $hashPass;
                $user->update_time = time();
                $user->save();

                return ['err_code' => 0, 'err_msg' => '修改成功'];
            }
        }
    }

}