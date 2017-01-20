<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = '错误';
?>
<head>
    <style>
        .site-error{
            height: 100%;
            width: 100%;
        }
        .content{
            font-size: 5em;
            text-align: center;
        }

        .url{
            margin-top: 3em;
            font-size: 2em;
            text-align: center;
        }
    </style>
</head>
<div class="site-error">
    <div class="content">
        对不起,你没有访问该网站的权限
    </div>

    <div class="url">
        想要恢复权限,请 <a  href="http://wpa.qq.com/msgrd?v=3&uin=2997339850&site=qq&menu=yes" target='_blank' id='qq_src1'>点击</a> 解除封禁
    </div>
</div>
