<?php
use frontend\assets\AppAsset;
AppAsset::addCss($this,'css/live/base.css');
AppAsset::addCss($this,'css/live/lighter.css');
AppAsset::addCss($this,'css/live/live.css');
AppAsset::addCss($this,'css/live/validationEngine.jquery.css');
AppAsset::addCss($this,'css/switchery.min.css');
AppAsset::addCss($this,'css/live/validationEngine.jquery.css');
AppAsset::addScript($this,'js/swfobject.js');
AppAsset::addScript($this,'js/web_socket.js');
AppAsset::addScript($this,'js/live/live.js');
AppAsset::addScript($this,'js/live/socket.js');
AppAsset::addScript($this,'js/switchery.min.js');
AppAsset::addScript($this,'js/form-slider-switcher.demo.js');
$this->title = '新侠财经_新侠直播间_金融直播室_现货白银直播间_大连贵金属交易所750会员单位';
$request = Yii::$app->request;
$url = Yii::$app->urlManager;
$yyRoom = empty($yy)?'0':$yy->yy_room;
$yyRoomTeacher = empty($yy)?'暂无':$yy->room_teacher;
$user = Yii::$app->user->identity;
$role = isset($user)&&!empty($user)?$user->role:-1;
$chatStatus = isset($user)&&!empty($user)?$user->status:10;
$status= empty($user)?false:true;
$roomId = $request->get('room_id',1);
$user = Yii::$app->user;
$UserName = \common\helper\DataHelper::getCurrentUser();
$roleImg = \common\helper\DataHelper::getRoleImg();
$onlineUserGuest = Yii::$app->params['live.online_people.guest'];
$onlineUserMember = Yii::$app->params['live.online_people.member'];
$onlineExpressionMin = Yii::$app->params['live.img.bqMin'];
$onlineExpressionMax = Yii::$app->params['live.img.bqMax'];
$setUserStatus = $url->createUrl(['live/set-user-status']);
$setUserIp = $url->createUrl(['live/set-user-ip']);
$setUser = $url->createUrl(['live/set-user']);
$close = $url->createUrl(['site/close']);
$course = \common\models\Course::find()->all();
/**
 * Created by PhpStorm.
 * User: steven
 * Date: 2016/12/28
 * Time: 上午11:51
 */
$js = <<<JS
    var rol = '$role';
    var setUserStatus = '$setUserStatus';
    var setUserIp = '$setUserIp';
    var setUser = '$setUser';
    var UserName = '$UserName';
    var roomId = '$roomId';
    var roleImg = '$roleImg';
    var role = '$role';
    var statu = '$status';
    var chatStatus = '$chatStatus';
    var close_url = '$close';
JS;

$this->registerJs($js,\yii\web\View::POS_HEAD);

?>

<!-- 随机弹出多个企鹅号之一 -->
<iframe style='display:none;' class='qq_iframe' src=''></iframe>
<!---top-->
<div class='navbar navbar-default navbar-fixed-top' role='navigation'>
    <div class='navbar-inner'>
        <div class='container' style='padding-top: 0px;'>
            <div class='navbar-header'>
                <a href='#' class='navbar-brand'>
                    <img style='' class='img-responsive' src='images/live/logo.png'>
                </a>
                <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-collapse'>
                    <span class='sr-only'>导航</span>
                    <span class='icon-bar'></span>
                    <span class='icon-bar'></span>
                    <span class='icon-bar'></span>
                </button>
            </div>

            <div class='collapse navbar-collapse navbar-ex1-collapse' style='background-color: #736553'>
                <ul class='nav navbar-nav ' style='margin-left:0px;'>
                    <li class='active'>
                        <a style='background-color: inherit;color: white' href='<?=$url->createUrl(['live/download'])?>'><img src='images/live/diann.png'>&nbsp;&nbsp;保存到桌面</a>
                    </li>
                    <li class='active'>
                        <a style='background-color: inherit;color: white' href='http://www.dlpmec.com/appdown/' target='_blank'>
                            <img src='images/live/xiaz.png'>&nbsp;&nbsp;下载软件
                        </a>
                    </li>
                    <li class=''>
                        <a target='_blank' id='qq_src1' href='http://wpa.qq.com/msgrd?v=3&uin=2997339850&site=qq&menu=yes'>
                            <img border='0' src='images/live/qq.png' alt='' title=''/>
                        </a>
                    </li>
                </ul>
                <ul class='nav navbar-nav navbar-right' style="padding-right: 50px;">
                    <li class='tmpUser'>
                        <?php if(Yii::$app->user->isGuest){?>
                            <a href='javascript:;' style='color: white'>
                                <img style='width:30px; height:30px;' src="images/live/<?=$roleImg?>">
                                <?=$UserName?>
                            </a>
                        <?php }else{?>

                            <a href='javascript:;' class="user-detail" style='color: white'>
                                <img style='width:30px; height:30px;' src="images/live/<?=$roleImg?>">
                                <span class="pull-right" style="display:block;width: 120px;height:30px;line-height: 30px;vertical-align: middle;font-size: 15px">&nbsp;<?=$UserName?></span>
                            </a>
                        <?php }?>

                        <ul style="display:none;position: absolute;top: 45px;left: 14px" class="dropdown-menu typeahead typeahead-long user-menu">
                            <li data-value="1" class="tag-id"><a href="#">消息</a></li>
                            <li data-value="1" class="tag-id"><a href="<?=$url->createUrl(['account/modify'])?>">修改密码</a></li>
<!--                            <li data-value="1" class="tag-id"><a href="#">个人中心</a></li>-->
                            <li data-value="1" class="tag-id"><a href="<?=$url->createUrl(['account/logout'])?>">登出</a></li>
                        </ul>

                    </li>
                    <li>
                        <a href='http://kh.dlpmec.cn/SelfOpenAccount/toAssessment.action?memberNo=D44' target='_blank'><img src='images/live/kaihu.png'></a>
                    </li>
                    <?php if(Yii::$app->user->isGuest){?>
                    <li >
                        <a href='<?=$url->createUrl(['account/login'])?>'>
                            <img src='images/live/login.png'>
                        </a>
                    </li>
                    <li >
                        <a href='<?=$url->createUrl(['account/reg'])?>'>
                            <img src='images/live/registration.png'>
                        </a>
                    </li>
                    <?php }?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--/top-->

<!--content-->
<div class='jumbotron1 ' id='help'>
    <div class='container'>
        <div class='row'>
            <div class='col-md-2 clearfix content-left' id='tb'>
                <table id='tb_1'>
                    <tr>
                        <?php if($user->isGuest){?>
                            <td style='width:50%;'>
                                <a href='<?=$url->createUrl(['account/login'])?>'>
                                    <img src='images/live/left_t_1.png'>
                                </a>
                            </td>
                            <td style='width:50%; padding-left:1%;'>
                                <a href='<?=$url->createUrl(['account/login'])?>'>
                                    <img src='images/live/left_t_2.png'>
                                </a>
                            </td>
                        <?php } else{?>
                            <td style='width:50%;'>
                                <a target='_blank' id='qq_src1' href='http://wpa.qq.com/msgrd?v=3&uin=2997339850&site=qq&menu=yes'>
                                    <img src='images/live/left_t_1.png'>
                                </a>
                            </td>
                            <td style='width:50%; padding-left:1%;'>
                                <a target='_blank' id='qq_src1' href='http://wpa.qq.com/msgrd?v=3&uin=2997339850&site=qq&menu=yes'>
                                    <img src='images/live/left_t_2.png'>
                                </a>
                            </td>
                        <?php }?>

                    </tr>
                    <tr>
                        <?php if($user->isGuest){?>
                            <td style='width:50%;'>
                                <a href='<?=$url->createUrl(['account/login'])?>'>
                                    <img src='images/live/left_t_3.png'>
                                </a>
                            </td>
                            <td style='width:50%; padding-left:1%;'>
                                <a href='<?=$url->createUrl(['account/login'])?>'>
                                    <img src='images/live/left_t_6.png'>
                                </a>
                            </td>
                        <?php } else{?>
                            <td style='width:50%;'>
                                <a target='_blank' id='qq_src1' href='http://wpa.qq.com/msgrd?v=3&uin=2997339850&site=qq&menu=yes'>
                                    <img src='images/live/left_t_3.png'>
                                </a>
                            </td>
                            <td style='width:50%; padding-left:1%;'>
                                <a href='javascript:;' class="course">
                                    <img src='images/live/left_t_6.png'>
                                </a>
                            </td>
                        <?php }?>
                    </tr>
                    <tr>
                        <td style='width:100%; padding-left:1%;'>
                            <a>
                                <img src='images/live/ewm.jpg' style='width: 260px;height: 210px;'>
                            </a>
                        </td>
                    </tr>
                </table>
                <div id='tab'>
                    <ul id='tab_wz' style='margin-bottom: 0px;margin-left: 2px;width: 260px;' class='clearfix'>
                        <li style="width: 100%;">
                           <span class="user-list-title">在线人数(<span class="all-live-count">232</span>)</span>
                        </li>
<!--                        <li style='width: 130px;'>-->
<!--                            <a class='lager'>我的客服<br>（0）</a>-->
<!--                        </li>-->
                    </ul>
                    <ul id='tab_img' style='height: 203px;margin-bottom:0px;margin-left: 2px;width: 260px;'>
                        <li id='onlineUser' style='display:block;'>
                        </li>
                        <li id='member-list' style='display:block;'>

                        </li>
                        <li style="display: block">
                            <?php foreach ($onlineUserMember as $onlineMember){?>
                                <a data-role-grade="'+client_list[p].role_grade+'"><dl id="tab_img_l" class="clearfix"><dd class="f1 pull-left"><img style="height:25px;width:25px;" src="images/live/<?=$onlineMember['img']?>">&nbsp;&nbsp;<em><?=$onlineMember['name']?></em></dd></dl></a>
                            <?php }?>
                        </li>
                        <li id='guest-list' style='display:block;'>

                        </li>
                        <li style="display: block">
                            <?php foreach ($onlineUserGuest as $onlineGuest){?>
                                <a data-role-grade="'+client_list[p].role_grade+'"><dl id="tab_img_l" class="clearfix"><dd class="f1 pull-left"><img style="height:25px;width:25px;" src="images/live/<?=$onlineGuest['img']?>">&nbsp;&nbsp;<em><?=$onlineGuest['name']?></em></dd></dl></a>
                            <?php }?>
                        </li>
                        <li style="display: block" class="text-center">
                            <a href="javascript:;">查看更多</a>
                        </li>
                        <li id='ownCustom'></li>
                    </ul>
                </div>
            </div>
            <div class='col-md-7 content-center' id='sp_2'><!-- yy：http://yy.com/s/23614648/23614648/yyscene.swf -->
                <div id='yyTop'>
                    <ul>
                        <li class='laoshi'>
                            <a id='laoshi'>当前老师：<?=$yyRoomTeacher?></a>
                        </li>
                        <li class='yyRefresh'><a id='yyRefresh'>刷新</a></li>
                    </ul>
                </div>
                <div class='thumbnail_2'>
                    <div class='caption_2'>
                        <div id='yyP' style='display:none;width:100%;height:450px;background:#020E16'></div>
                        <embed id='yy'  align='middle' allowfullscreen='true' width='100%' height='450px' allowscriptaccess='always' mode='transparent' quality='high' src='http://yy.com/s/<?=$yyRoom?>/<?=$yyRoom?>/yyscene.swf' type='application/x-shockwave-flash'></embed>
                    </div>
                    <img style='height: 100%;width: 100%;' src='images/live/main.png' alt=''>
                </div>

            </div>
            <div class='col-md-3 content-right'>
                <div class='thumbnail' style='padding: 0px'>
                    <div class='caption' style='padding: 0px;'>
                        <div class='name'>
                            公告：<marquee style='width:90%;height:30px;line-height:30px;padding-top:5px;' scrollAmount='6' onmouseout='this.start();' onmouseover='this.stop();' direction='left' class='gGao'>冲刺高收益，锁定直播室！最及时的喊单信息，把握最新行情波动！开户入金联系助理！</marquee>
                        </div>
                        <div id='back' class='clearfix'>
                        </div>
                        <div id='qq'>
                            <ul class='clearfix'>
                                <li>
                                    <img src='images/live/jpkf.png'>
                                </li>
                                <li>
                                    <a id='qq_src2' target='_blank' href='http://wpa.qq.com/msgrd?v=3&uin=2997339850&site=qq&menu=yes'>
                                        <img border='0' src='images/live/counseling_style_52.gif' alt='' title=''/>
                                    </a>
                                </li>
                                <li>
                                    <a id='qq_src3' target='_blank' href='http://wpa.qq.com/msgrd?v=3&uin=2997339850&site=qq&menu=yes'>
                                        <img border='0' src='images/live/counseling_style_52.gif' alt='' title=''/>
                                    </a>
                                </li>


                            </ul>
                        </div>
                        <div id='send-message'>
                            <div id='qq_1'>
                                <ul class='clearfix'>
                                    <li class='biaoqing'>
                                        <a>
                                            <img src='images/live/biaoqing.png' class="show-expression">
                                        </a>
                                    </li>
                                    <li class='hecai'>
                                        <a>
                                            <img src='images/live/caitiao.png'>
                                        </a>
                                    </li>
                                    <li class='ww'>
                                        <a>
                                            <img src='images/live/ww.gif'>
                                        </a>
                                    </li>

                                    <li>
                                        <span toUserType='3' class='toUserId' name='0' href='#'>
                                            对&nbsp;<font>所有人</font>
                                            <img class='remove' style='display:none;' src='images/live/del.png' />&nbsp;说
                                        </span>
                                    </li>
                                </ul>
                            </div>
                            <div id='textarea'>
                                <table>
                                    <tr>
                                        <td class='td1'>
                                            <div id='content' contenteditable='true'></div>
                                        </td>
                                        <td class='td2'>
                                            <img id='chatSub' src='images/live/btnSendMsg.png'>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /content -->

<!-- 表情 -->
<div id='expression'>
    <div id='bq'>
        <table class='bq bqMin' style="display: block" >
            <?php foreach ($onlineExpressionMin as $bqMinStair){?>
            <tr>
                <?php foreach ($bqMinStair as $bqMinSecondLevel){?>
                    <td>
                        <img src='images/live/<?=$bqMinSecondLevel?>'  width='28' height='28' /></td>
                <?php }?>
            </tr>
            <?php }?>
        </table>
        <table class='bq bqMax' style='display:none;'>
            <?php foreach ($onlineExpressionMax as $bqMaxStair){?>
                <tr>
                    <?php foreach ($bqMaxStair as $bqMaxSecondLevel){?>
                        <td>
                            <img src='images/live/<?=$bqMaxSecondLevel?>'  width='28' height='28' /></td>
                    <?php }?>
                </tr>
            <?php }?>
        </table>
    </div>
    <div class='qiehuan ' >
        <dl class='pull-left' style='margin: 0px'>
            <dt class='curq'>默认</dt>
            <dt class='big'>大表情</dt>
        </dl>
    </div>
</div>

<!-- 课程表  -->
<div id='log' >
    <div class='log_t clearfix'>
        <div class='log_t_1 fl'>
            课表安排
        </div>
        <a class='close fl'>×</a>
    </div>
    <div id='tb_xingq'>
        <table id='tb_xingq_1' border='1' cellpadding='5' cellspacing='0' bordercolor='#999999'>
            <tr>
                <th>上课时间</th>
                <th>星期一</th>
                <th>星期二</th>
                <th>星期三</th>
                <th>星期四</th>
                <th>星期五</th>
                <th>星期六</th>
                <th>星期日</th>
            </tr>
            <?php
            foreach ($course as $value){?>
            <tr>
                <td><?=$value->time?></td>
                <td><?=$value->monday?></td>
                <td><?=$value->tuesday?></td>
                <td><?=$value->wednesday?></td>
                <td><?=$value->thursday?></td>
                <td><?=$value->friday?></td>
                <td><?=$value->saturday?></td>
                <td><?=$value->sunday?></td>
            </tr>
            <?php }?>
        </table>
    </div>
</div>

<!-- 公告栏 -->
<div id='gGaoLog'>
    <div class='log_t'>
        系统公告
        <a class='close'>×</a>
    </div>
    <p>本直播室每周一至周五，上午08:00-凌晨02:00，不间断18个小时在线直播，授之以鱼不如授之以渔，各位朋友如果想跟讲师学技术,想要下载相关资料课件学习的朋友请点下方金牌助理交谈！（投资有风险，操作需谨慎）</p>
</div>
<!-- /公告栏 -->

<div id="mask" class="mask" style="display: none;"></div>

<div class="modal fade" id="setting" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="color: black">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">会话管理</h4>
            </div>
            <div class="modal-body text-center ">
                <div class="pull-left m-l-40 m-r-40">
                    禁言:<input class="shut-up"  type="checkbox" data-classname="switchery" data-render="switchery" data-theme="red"  />

                </div>
                <div class="pull-left m-l-40 m-r-40">
                    封IP:<input class="get-out" type="checkbox" data-render="switchery" data-theme="red" />
                </div>
                <div style="clear: both"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary">提交更改</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>