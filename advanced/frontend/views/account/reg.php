<?php
use frontend\assets\AppAsset;
AppAsset::addCss($this,'css/live/enroll_base.css');
AppAsset::addCss($this,'css/live/enroll_style.css');
AppAsset::addCss($this,'css/account/drag.css');
AppAsset::addScript($this,'js/account/drag.js');
$url = Yii::$app->urlManager;
$verifyReg = $url->createUrl(['account/verify-reg']);
$asyncCheckRegPhone = $url->createUrl(['account/async-check-reg-phone']);
$asyncCheckRegNikeName = $url->createUrl(['account/async-check-reg-nike-name']);
$this->title = '新侠财经-注册';
$js = <<<JS
    var phone=nikename=qq=weChat=pass=verifyPass = '';
    var regPhone = /^(((13[0-9]{1})|(14[0-9]{1})|(17[0]{1})|(15[0-3]{1})|(15[5-9]{1})|(18[0-9]{1}))+\d{8})$/;
    var regNikename = /^([\u4e00-\u9fa5]{2,8}|[a-zA-Z]{6,16})$/g;
    var regPass = /^[a-zA-Z0-9]{6,20}$/;
    var dom = $('.reg-data');
    var phoneStatus=nikenameStatus=passStatus = false;
    dom.on('click','.btn-primary',function() {
        phone = dom.find('#phone').val();
        nikename = dom.find('#nike-name').val();
        qq = dom.find('#qq').val();
        weChat = dom.find('#we-chat').val();
        pass = dom.find('#pass').val();
        if(phoneStatus == true && nikenameStatus == true && passStatus == true){
            $.ajax({
                url: '$verifyReg',
                method: 'POST',
                dataType: 'json',
                data: {phone:phone,nike_name:nikename,pass:pass,qq:qq,we_chat:weChat},
                cache: false,
                success: function(resp) {
                    if(resp.err_code == 0){
                        location.href = 'http://'+location.host;
                    }else{
                        alert(resp.err_msg);
                        return false;
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            })
        }
        return false;
    });
    
    dom.find('#phone').blur(function() {
       phone = dom.find('#phone').val();
       if(!regPhone.test(phone)){
           phoneStatus = false;
           $(this).css('border-color','red');         
       }else{
           $.ajax({
                url: '$asyncCheckRegPhone',
                method: 'POST',
                dataType: 'json',
                data: {phone:phone},
                cache: false,
                success: function(resp) {
                    if(resp.err_code == 0){
                        phoneStatus = true;
                        dom.find('#phone').css('border-color','inherit');
                    }else{
                        alert(resp.err_msg);
                        phoneStatus = false;
                        dom.find('#phone').css('border-color','red');
                        
                    }
                },
                error: function(error) {
                    console.log(error);
                }
           })
           
       }
    });
    dom.find('#nike-name').blur(function() {
       nikename = dom.find('#nike-name').val();
       if(!regNikename.test(nikename)){
           nikenameStatus = false;
           $(this).css('border-color','red');         
       }else{
           $.ajax({
                url: '$asyncCheckRegNikeName',
                method: 'POST',
                dataType: 'json',
                data: {nike_name:nikename},
                cache: false,
                success: function(resp) {
                    if(resp.err_code == 0){
                        nikenameStatus = true;
                        dom.find('#nike-name').css('border-color','inherit');
                    }else{
                        alert(resp.err_msg);
                        nikenameStatus = false;
                        dom.find('#nike-name').css('border-color','red');
                        
                    }
                },
                error: function(error) {
                    console.log(error);
                }
           })
           
       }
    });
    dom.find('#pass').blur(function() {
       pass = dom.find('#pass').val();
       if(!regPass.test(pass)){
           passStatus = false;
           $(this).css('border-color','red');    
       }else{
           passStatus = true;
           $(this).css('border-color','inherit');
       }
    });

    dom.find('#verify-pass').blur(function() {
       pass = dom.find('#pass').val();
       verifyPass = dom.find('#verify-pass').val();
       if(verifyPass!=pass){
           passStatus = false;
           $(this).css('border-color','red');    
       }else{
           passStatus = true;
           $(this).css('border-color','inherit');
       }
    });
JS;
$this->registerJs($js);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <style>
        .title {
            color: #1f121b;
            text-shadow: 0 1px 0 #ccc, 0 2px 0 #c9c9c9, 0 3px 0 #bbb, 0 4px 0 #b9b9b9, 0 5px 0 #aaa, 0 6px 1px rgba(0,0,0,0.1), 0 0 5px rgba(0,0,0,0.1),0 1px 3px rgba(0,0,0,0.3),0 3px 5px rgba(0,0,0,0.2),0 5px 10px rgba(0,0,0,0.25);
        }

        .block{
            display: block;
            height: 34px;
            line-height: 34px;
            vertical-align: middle;
        }
        .m-t-30 {
            margin-top: 50px;
        }
    </style>
</head>
<input type="text" >
<div id="enroll_bg">
    <div id="enroll_t">
        <a href="<?=$url->createUrl(['live/index'])?>" class="pull-right">返回直播间</a>
        <h2 class="title">如果你还没有账号 &nbsp; 赶紧注册吧!</h2>
        <div class="m-t-30 reg-data">
            <div class="form-group block">
                <label class="text-right control-label col-md-3 col-sm-6" for="fullname"><span class="text-danger">*</span>手机号:</label>
                <div class="col-md-8 col-sm-6">
                    <input  class="form-control" type="text" id="phone" placeholder="请输入你的手机号码">

                </div>
            </div>

            <div class="form-group block">
                <label class="text-right control-label col-md-3 col-sm-6" for="fullname"><span class="text-danger">*</span>昵称:</label>
                <div class="col-md-8 col-sm-6">
                    <input class="form-control" type="text" id="nike-name" placeholder="由2-8位中文或6-12数字、英文字母组成的">
                </div>
            </div>
            <div class="form-group block">
                <label class="text-right control-label col-md-3 col-sm-6" for="fullname">QQ:</label>
                <div class="col-md-8 col-sm-6">
                    <input class="form-control" type="text" id="qq" placeholder="请输入你的QQ号码">
                </div>
            </div>
            <div class="form-group block">
                <label class="text-right control-label col-md-3 col-sm-6" for="fullname">微信:</label>
                <div class="col-md-8 col-sm-6">
                    <input class="form-control" type="text" id="we-chat" placeholder="请输入你的微信号码">
                </div>
            </div>
            <div class="form-group block">
                <label class="text-right control-label col-md-3 col-sm-6" for="fullname"><span class="text-danger">*</span>密码:</label>
                <div class="col-md-8 col-sm-6">
                    <input class="form-control" type="password" id="pass" placeholder="由6-20位数字或英文字母组成的">
                </div>
            </div>
            <div class="form-group block">
                <label class="text-right control-label col-md-3 col-sm-6" for="fullname"><span class="text-danger">*</span>确认密码:</label>
                <div class="col-md-8 col-sm-6">
                    <input class="form-control" type="password" id="verify-pass" placeholder="请再次输入你的密码">
                </div>
            </div>

            <!--            <div class="form-group block">-->
            <!--                <label class="text-right control-label col-md-3 col-sm-6" for="fullname">验证码:</label>-->
            <!--                <div class="col-md-6 col-sm-6">-->
            <!--                    <div id="drag"></div>-->
            <!--                </div>-->
            <!--            </div>-->
            <p class="m-t-30">
                <a href="javascript:;" class="btn btn-primary btn-block">注册</a>
                <a href="<?=$url->createUrl(['account/login'])?>" class="btn btn-success btn-block">去登陆</a>

            </p>
        </div>
    </div>
</div>



