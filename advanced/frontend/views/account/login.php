<?php
use frontend\assets\AppAsset;
AppAsset::addCss($this,'css/live/enroll_base.css');
AppAsset::addCss($this,'css/live/enroll_style.css');
AppAsset::addCss($this,'css/account/drag.css');
AppAsset::addScript($this,'js/account/drag.js');
$this->title = '新侠财经-登录';
$url = Yii::$app->urlManager;
$verifyLogin = $url->createUrl(['account/verify-login']);
$js = <<<JS
    $('#drag').drag();
    var phone,pass,verify= '';
    var regPhone = /^(((13[0-9]{1})|(14[0-9]{1})|(17[0]{1})|(15[0-3]{1})|(15[5-9]{1})|(18[0-9]{1}))+\d{8})$/;
    
    var regPass = /^[a-zA-Z0-9]{6,20}$/;
    var dom = $('.reg-data');
    var phoneStatus=verifyStatus = false;
    var passStatus = true;
    dom.on('click','.btn-primary',function() {
        verify = dom.find('.handler_ok_bg').attr('data-verify');
        if(verify != 'yes'){
            alert('请滑动验证码');
            $('#drag').html('');
            $('#drag').drag();
            return false;
        }
        phone = dom.find('#phone').val();
        pass = dom.find('#pass').val();
        if(phoneStatus == true && passStatus == true){
            $.ajax({
                url: '$verifyLogin',
                method: 'POST',
                dataType: 'json',
                data: {phone:phone,pass:pass},                
                success: function(resp) {
                    if(resp.err_code == 0){
                       location.href = resp.url;
                    }else{
                        alert(resp.err_msg);
                        $('#drag').html('');
                        $('#drag').drag();
                        return false;
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            })
        }else{
            $('#drag').html('');
            $('#drag').drag();
        }
        return false;
    });
    
    dom.find('#phone').blur(function() {
       phone = dom.find('#phone').val();
       if(!regPhone.test(phone)){
           phoneStatus = false;
           $(this).css('border-color','red');         
       }else{
           phoneStatus = true;
           $(this).css('border-color','inherit');
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

JS;
$this->registerJs($js);
?>

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
        .m-t-50 {
            margin-top: 50px;
        }.m-t-20 {
             margin-top: 20px;
         }
    </style>
</head>
<input type="text" >
<div id="enroll_bg">
    <div id="enroll_t">
        <a href="<?=$url->createUrl(['live/index'])?>" class="pull-right">返回直播间</a>
        <h2 class="title">账号登录</h2>
        <div class="m-t-50 reg-data">
            <div class="form-group block">
                <label class="text-right control-label col-md-3 col-sm-6" for="fullname"><span class="text-danger">*</span>手机号:</label>
                <div class="col-md-8 col-sm-6">
                    <input  class="form-control" type="text" id="phone" placeholder="请输入你的手机号码">

                </div>
            </div>


            <div class="form-group block m-t-20">
                <label class="text-right control-label col-md-3 col-sm-6" for="fullname"><span class="text-danger">*</span>密码:</label>
                <div class="col-md-8 col-sm-6">
                    <input class="form-control" type="password" id="pass" placeholder="由6-20位数字和英文字母组成的">
                </div>
            </div>


            <div class="form-group block m-t-20">
                <label class="text-right control-label col-md-3 col-sm-6" for="fullname">验证码:</label>
                <div class="col-md-6 col-sm-6">
                    <div id="drag"></div>
                </div>
            </div>
            <p class="m-t-50">
                <a href="javascript:;" class="btn btn-primary btn-block">登录</a>
                <a href="<?=$url->createUrl(['account/reg'])?>" class="btn btn-success btn-block">去注册</a>
                <a href="<?=$url->createUrl(['account/modify'])?>" class="btn btn-danger btn-block">忘记密码</a>
            </p>
        </div>
    </div>
</div>



