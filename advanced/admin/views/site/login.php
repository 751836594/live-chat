<?php
use admin\assets\AppAsset;

$this->title = '新侠后台运营系统';

$loginUrl = Yii::$app->urlManager->createUrl(array('site/login'));
$adminHomeUrl = Yii::$app->urlManager->createUrl(array('site/home'));

$loginJs = <<<JS
    var loginForm = $('#login-form');
    loginForm.find('.btn-commit').on('click', function(){

        loginForm.find('.btn-commit').html('正在登录 ...');

        var loginAccount = $.trim(loginForm.find('.login-account').val());
        var loginPassword = $.trim(loginForm.find('.login-password').val());

        var hasError = 0;
        if(loginAccount == ''){
            loginForm.find('.login-account').next().html('用户名不能为空!');
            hasError++;
        }else{
            loginForm.find('.login-account').next().html('');
        }
        if(loginPassword == ''){
            loginForm.find('.login-password').next().html('密码不能为空!');
            hasError++;
        }else{
            loginForm.find('.login-password').next().html('');
        }
        if(hasError > 0){
            loginForm.find('.btn-commit').html('登录');
            return false;
        }
        $.ajax({
                            url: '$loginUrl',
                            type: 'POST',
                            cache: false,
                            dataType: 'json',
                            data: {login_account: loginAccount, login_password: loginPassword},
                            success: function (resp) {
                                if(resp.err_code == 0){
                                    //账号不存在or系统出错
                                    loginForm.find('.login-account').next().html(resp.err_msg);
                                    loginForm.find('.btn-commit').html('登录');
                                    return false;
                                } else if(resp.err_code == 2){
                                    //密码错误
                                    loginForm.find('.login-password').next().html(resp.err_msg);
                                    loginForm.find('.login-password').val('');
                                    loginForm.find('.btn-commit').html('登录');
                                    return false;
                                } else if(resp.err_code == 1){
                                    //注册成功
                                    window.location.href = '$adminHomeUrl';
                                }
                            },
                            error: function (XMLHttpRequest, msg, errorThrown) {
                                loginForm.find('.login-account').next().html('系统出错!');
                                loginForm.find('.btn-commit').html('登录');
                                return false;
                            }
        });
    });
    loginForm.find('.login-account').on('focus', function(){
        loginForm.find('.login-account').next().html('');
    });
    loginForm.find('.login-password').on('focus', function(){
        loginForm.find('.login-password').next().html('');
    });

JS;

$this->registerJs('
$(document).ready(function() {
        App.init();
        LoginV2.init();
    });
    ', \yii\web\View::POS_END);
AppAsset::addScript($this, '@web/js/login.min.js');
$this->registerJs($loginJs);
?>

<style>
    .help-block.error-msg{
        display: block;
        margin-top: 5px;
        color: #e5603b;
        font-size: 12px;
    }
</style>

<div class="login-cover">
    <div class="login-cover-image"><img src="assets/img/login-bg/bg-1.jpg" data-id="login-cover-image" alt=""/></div>
    <div class="login-cover-bg"></div>
</div>
<!-- begin #page-container -->
<div id="page-container" class="fade in">
    <!-- begin login -->
    <div class="login login-v2" data-pageload-addclass="animated fadeIn">
        <!-- begin brand -->
        <div class="login-header">
            <div class="brand">
                <span class="logo"></span> 新侠后台管理系统
            </div>
        </div>
        <!-- end brand -->
        <div class="login-content">
            <form id="login-form" role="form">
                <div class="form-group m-b-20">
                    <input type="text" class="form-control input-lg login-account" placeholder="请输入用户名"/>
                    <span class="help-block error-msg"></span>
                </div>
                <div class="form-group m-b-20">
                    <input type="password" class="form-control input-lg login-password" placeholder="请输入密码"/>
                    <span class="help-block error-msg"></span>
                </div>
                <div class="login-buttons">
                    <button type="button" class="btn btn-success btn-block btn-lg btn-commit">登&nbsp;&nbsp;录</button>
                </div>
            </form>
        </div>
    </div>
    <!-- end login -->

    <ul class="login-bg-list">
        <li class="active"><a href="#" data-click="change-bg"><img src="assets/img/login-bg/bg-1.jpg" alt=""/></a></li>
    </ul>
</div>
<!-- end page container -->
