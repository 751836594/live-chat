<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace admin\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'plugins/jquery-ui/themes/base/minified/jquery-ui.min.css',
        'plugins/font-awesome/css/font-awesome.min.css',
        'css/animate.min.css',
        'css/style.css',
        'css/style-responsive.min.css',
        'css/theme/default.css',
        'plugins/gritter/css/jquery.gritter.css'
    ];
    public $js = [
        'plugins/pace/pace.min.js',
        'plugins/jquery/jquery-migrate-1.1.0.min.js',
        'plugins/jquery-ui/ui/minified/jquery-ui.min.js',
        'plugins/slimscroll/jquery.slimscroll.min.js',
        'plugins/jquery-cookie/jquery.cookie.js',
        'js/dashboard.js',
        'js/apps.js',
        'plugins/sparkline/jquery.sparkline.js',
        'plugins/gritter/js/jquery.gritter.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
    //定义按需加载JS方法，注意加载顺序在最后
    public static function addScript($view, $jsfile) {
        $view->registerJsFile($jsfile, ['depends' => ['yii\web\YiiAsset']]);
    }

    //定义按需加载css方法，注意加载顺序在最后
    public static function addCss($view, $cssfile) {
        $view->registerCssFile($cssfile, ['depends' => ['yii\bootstrap\BootstrapPluginAsset']]);
    }
}
