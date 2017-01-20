<?php
namespace admin\controllers;

use admin\models\Account;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * Class BaseAppController
 * @package admin\controllers
 * @author Pony Gu <pony@51wom.com>
 * @since 1.0
 */
class BaseAppController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
//            'access' => [
//                'class' => AccessControl::className(),
//                'rules' => [
//                    [
//                        'actions' => ['login', 'error'],
//                        'allow' => true,
//                    ],
//                    [
//                        'actions' => ['logout', 'index'],
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ],
//                ],
//            ],
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'logout' => ['post'],
//                ],
//            ],
        ];
    }

    /**
     * 获取当前登录账号的信息
     * @return array
     */
    public function getCurrentLoginUser()
    {
        $accountUUID = Yii::$app->user->id; // account uuid
        $loginAccount = Yii::$app->user->identity->getLoginAccount(); // login account
        $userName = Yii::$app->user->identity->getUserName(); // user name

        // Yii::trace('account uuid = ' . $accountUUID . '; login account = ' . $loginAccount . '; user name : ' . $userName, 'dev\#' . __METHOD__);

        return ['account_uuid' => $accountUUID, 'login_account' => $loginAccount, 'user_name' => $userName];
    }
}
