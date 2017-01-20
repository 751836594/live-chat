<?php
/* @var $this \yii\web\View */
/* @var $content string */

use admin\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
$url=  Yii::$app->urlManager;
$this->registerJs('
    $(document).ready(function() {
         App.init();
         Dashboard.init();
      });
    ', \yii\web\View::POS_END);
?>
<?php $this->beginPage() ?>

    <!DOCTYPE html>
    <!--[if IE 8]>
    <html lang="zh-CN" class="ie8"> <![endif]-->
    <!--[if !IE]><!-->
    <html lang="zh-CN">
    <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta content="" name="description"/>
        <meta content="" name="author"/>
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>

    <!--[if lt IE 9]>
    <script src="crossbrowserjs/html5shiv.js"></script>
    <script src="crossbrowserjs/respond.min.js"></script>
    <script src="crossbrowserjs/excanvas.min.js"></script>
    <![endif]-->

    <div id="page-loader" class="fade in"><span class="spinner"></span></div>

    <div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
        <div id="header" class="header navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="#" class="navbar-brand"><span class="navbar-logo"></span>直播后台系统</a>
                    <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <ul class="nav navbar-nav navbar-right">
<!--                    <li class="dropdown">-->
<!--                        <a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle f-s-14">-->
<!--                            <i class="fa fa-bell-o"></i>-->
<!--                            <span class="label">5</span>-->
<!--                        </a>-->
<!--                        <ul class="dropdown-menu media-list pull-right animated fadeInDown">-->
<!--                            <li class="dropdown-header">Notifications (5)</li>-->
<!--                            <li class="media">-->
<!--                                <a href="javascript:;">-->
<!--                                    <div class="media-left"><i class="fa fa-bug media-object bg-red"></i></div>-->
<!--                                    <div class="media-body">-->
<!--                                        <h6 class="media-heading">Server Error Reports</h6>-->
<!--                                        <div class="text-muted f-s-11">3 minutes ago</div>-->
<!--                                    </div>-->
<!--                                </a>-->
<!--                            </li>-->
<!--                            <li class="dropdown-footer text-center">-->
<!--                                <a href="javascript:;">View more</a>-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                    </li>-->
                    <li class="dropdown navbar-user">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="images/avatar.png" alt=""/>
                            <span class="hidden-xs">沃小米</span> <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu animated fadeInLeft">
<!--                            <li class="arrow"></li>-->
<!--                            <li><a href="javascript:;">Edit Profile</a></li>-->
<!--                            <li><a href="javascript:;"><span class="badge badge-danger pull-right">2</span> Inbox</a>-->
<!--                            </li>-->
<!--                            <li><a href="javascript:;">Calendar</a></li>-->
<!--                            <li><a href="javascript:;">Setting</a></li>-->
<!--                            <li class="divider"></li>-->
                            <li><a href="<?php echo Yii::$app->urlManager->createUrl(array('site/logout')); ?>">退出</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        <div id="sidebar" class="sidebar">
            <div data-scrollbar="true" data-height="100%">
                <ul class="nav">
                    <li class="nav-profile">
                        <div class="image">
                            <a href="javascript:;"><img src="/images/avatar.png" alt=""/></a>
                        </div>
                        <div class="info">
                            <small>系统管理员</small>
                        </div>
                    </li>
                </ul>
                <ul class="nav">
                    <li class="has-sub" id="sys-setting">
                        <a href="javascript:;">
                            <b class="caret pull-right"></b>
                            <i class="fa fa-cubes"></i>
                            <span>网站管理</span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="<?=$url->createUrl(['course/list/index'])?>">课程表</a></li>
                            <li><a href="<?=$url->createUrl(['chat/list/index'])?>">禁言管理</a></li>
                            <li><a href="<?=$url->createUrl(['yy/list/index'])?>">直播管理</a></li>
                        </ul>
                    </li>

                    <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i
                                class="fa fa-angle-double-left"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="sidebar-bg"></div>

        <?= $content ?>

        <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade"
           data-click="scroll-top"><i
                class="fa fa-angle-up"></i></a>
    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>