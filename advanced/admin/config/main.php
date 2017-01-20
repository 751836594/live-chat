<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-admin',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'admin\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'course' => [
            'class' => 'admin\modules\course\Module'
        ],
        'chat' => [
            'class' => 'admin\modules\chat\Module'
        ],
        'yy' => [
            'class' => 'admin\modules\yy\Module'
        ],
    ],
    'components' => [
        'user' => [
            'identityClass' => 'admin\models\Account',
            'enableAutoLogin' => false,
            'enableSession' => true,
            'loginUrl' => ['site/index'],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'itemTable' => 'erm_sys_auth_item',
            'itemChildTable' => 'erm_sys_auth_item_child',
            'ruleTable' => 'erm_sys_auth_rule',
            'assignmentTable' => 'erm_biz_auth_assignment'
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'flushInterval' => 1,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['trace'],
                    'logVars' => [],
                    'categories' => ['dev\*'],//表示以 dev 开头的分类
                    'logFile' => '@runtime/logs/dev-trace.log',
                    'exportInterval' => 1,
                    'enabled' => true
                ],//Yii::trace('message', 'dev\#' . __METHOD__);
                [
                    'class' => 'yii\log\EmailTarget',
                    'levels' => ['trace', 'error'],
                    'categories' => ['dev\*', 'yii\db\*'],
                    'message' => [
                        'from' => ['wpronet@163.com'],
                        'to' => ['wpronet@163.com'],
                        'subject' => 'Database errors at example.com',
                    ],
                    'enabled' => false
                ],
                [
                    'class' => 'yii\log\DbTarget',
                    'levels' => ['trace', 'error', 'warning'],
                    'categories'=>['dev\*'],
                    'db' => 'db',
                    'logTable' => 'wom_dev_log',
                    'exportInterval' => 1,
                    'enabled' => true
                ],
                [
                    'class' => 'yii\log\DbTarget',
                    'levels' => ['error'],
                    'db' => 'db',
                    'logTable' => 'wom_error_log',
                    'exportInterval' => 1,
                    'enabled' => true
                ],
                [
                    'class' => 'yii\log\EmailTarget',
                    'levels' => ['error'],
                    'message' => [
                        'from' => ['wpronet@163.com'],
                        'to' => ['wpronet@163.com'],
                        'subject' => 'Error in 51wom.com',
                    ],
                    'enabled' => false
                ],
            ],
        ]
    ],
    'params' => $params,
];
