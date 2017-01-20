<?php
use frontend\assets\AppAsset;
AppAsset::addCss($this,'css/live/enroll_base.css');
AppAsset::addCss($this,'css/live/enroll_style.css');
AppAsset::addCss($this,'css/account/drag.css');
AppAsset::addScript($this,'js/account/drag.js');
$this->title = '新侠财经-修改密码';
$url = Yii::$app->urlManager;
$verifyModifyPass = $url->createUrl(['account/verify-modify-pass']);
$sendSms = $url->createUrl(['account/send-sms']);
$js = <<<JS
    var phone,pass,verify= '';
    var phoneStatus=passStatus=verifyStatus = false;
    var regPhone = /^(((13[0-9]{1})|(14[0-9]{1})|(17[0]{1})|(15[0-3]{1})|(15[5-9]{1})|(18[0-9]{1}))+\d{8})$/;
    
    var regPass = /^[a-zA-Z0-9]{6,20}$/;
    var dom = $('.modify-pass');
    
    dom.on('click','.btn-primary',function() {
        
        phone = dom.find('#phone').val();
        pass = dom.find('#pass').val();
        verify = dom.find('#verify').val();
        if(verify.length <=0){
            alert('请输入验证码');
            return false;
        }
        if(phoneStatus == true && passStatus == true){
            $.ajax({
                url: '$verifyModifyPass',
                method: 'POST',
                dataType: 'json',
                data: {phone:phone,pass:pass,verify:verify},                
                success: function(resp) {
                    alert(resp.err_msg);
                    if(resp.err_code == 0){
                       location.href = location.host;
                    }else{
                        
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
    dom.find('#verify-pass').blur(function() {
       var verify_pass = dom.find('#verify-pass').val();
       if(verify_pass != pass){
           passStatus = false;
           $(this).css('border-color','red');    
       }else{
           passStatus = true;
           $(this).css('border-color','inherit');
       }
    });
    dom.find('#phone-verify').click(function () {
        if(phoneStatus == false){
            alert('请输入手机号');
            return false;
        }
        var countdown=60; 
        setInterval(function() {
            if(countdown == 0){
                $('#phone-verify').val('获取验证码');
                $('#phone-verify').attr('disabled',false);
            }else{
                $('#phone-verify').val(countdown--);
                $('#phone-verify').attr('disabled','disabled');
            }
            
        }, 1000);
        $.ajax({
			url: '$sendSms',
			method: 'POST',
			data: {phone:phone},
			dataType: 'json',
			success:function(resp) {
			    if(resp.err_code != 0){
			        alert(resp.err_msg);
			        return false;
			    }			    
			},
			error: function(error) {
			    console.log(error);
			}
		})
	})
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
        <h2 class="title">修改密码</h2>
        <div class="m-t-50 modify-pass">
            <div class="form-group block m-t-20">
                <label class="text-right control-label col-md-3 col-sm-6" for="fullname"><span class="text-danger">*</span>手机号码:</label>
                <div class="col-md-7 col-sm-6">
                    <input class="form-control" type="text" id="phone" placeholder="请输入你的手机号码">
                </div>
            </div>
            <div class="form-group block">
                <label class="text-right control-label col-md-3 col-sm-6" for="fullname"><span class="text-danger">*</span>验证码:</label>
                <div class="col-md-8 col-sm-6 ">

                        <input  class="form-control pull-left" type="text" id="verify" style="width: 70%" placeholder="请输入你的手机验证码">
                    <input type="button" style="width: 68px;" class="btn btn-info pull-left" id="phone-verify" value="验证码">
                </div>

            </div>


            <div class="form-group block m-t-20">
                <label class="text-right control-label col-md-3 col-sm-6" for="fullname"><span class="text-danger">*</span>新密码:</label>
                <div class="col-md-7 col-sm-6">
                    <input class="form-control" type="password" id="pass" placeholder="由6-20位数字和英文字母组成的">
                </div>
            </div>

            <div class="form-group block m-t-20">
                <label class="text-right control-label col-md-3 col-sm-6" for="fullname"><span class="text-danger">*</span>确认密码:</label>
                <div class="col-md-7 col-sm-6">
                    <input class="form-control" type="password" id="verify-pass" placeholder="由6-20位数字和英文字母组成的">
                </div>
            </div>


            <p class="m-t-50">
                <a href="javascript:;" class="btn btn-primary btn-block">修改密码</a>
                <a href="<?=$url->createUrl(['account/reg'])?>" class="btn btn-success btn-block">去注册</a>

            </p>
        </div>
    </div>
</div>



