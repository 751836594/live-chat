<?php
namespace  admin\modules\chat\controllers;
use admin\helpers\DataHelper;
use admin\models\ChildPromotion;
use admin\models\Promotion;
use admin\models\BasePromotion;
use common\helper\AdminHelper;
use common\helper\DateTimeHelper;
use common\helper\StringHelper;
use common\models\Course;
use common\models\User;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\web\Controller;
use yii\web\Response;

/**
 * Created by PhpStorm.
 * User: steven
 * Date: 2016/12/20
 * Time: 下午2:02
 */
class ListController extends Controller
{

    public function actions()
    {

    }

    public function actionIndex()
    {
        $size = AdminHelper::getPageSize();
        $query = (new Query())
                ->select('*')
                ->from(['user' => User::tableName()])
                ->where(['status' => User::STATUS_SHUT_UP]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $size,

            ]
        ]);
        return $this->render('index',[
            'dataProvider' =>$dataProvider
        ]);
    }

    public function actionEdit()
    {
        $request = \Yii::$app->request;
        if($request->isPost){
            \Yii::$app->response->format = Response::FORMAT_JSON;
            $uuid = $request->post('uuid');
            $user = User::findOne(['uuid' => $uuid]);
            if(empty($user)){
                return ['err_code' => 1, 'err_msg' => '修改失败'];
            }
            $user->status = User::SCENARIO_DEFAULT;
            $user->update_time = time();
            $user->save();
            return ['err_code' => 0, 'err_msg' => '修改成功'];
        }
    }




}