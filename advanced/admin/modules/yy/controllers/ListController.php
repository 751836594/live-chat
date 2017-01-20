<?php
namespace  admin\modules\yy\controllers;
use admin\helpers\DataHelper;
use admin\models\ChildPromotion;
use admin\models\Promotion;
use admin\models\BasePromotion;
use common\helper\AdminHelper;
use common\helper\DateTimeHelper;
use common\helper\StringHelper;
use common\models\Course;
use common\models\User;
use common\models\YyLiveRoom;
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
                ->from(['yy' => YyLiveRoom::tableName()]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $size,

            ]
        ]);
        $liveAccount = YyLiveRoom::findOne(['status' => 1]);
        return $this->render('index',[
            'dataProvider' =>$dataProvider,
            'liveAccount' => empty($liveAccount)?'无':$liveAccount->yy_room
        ]);
    }

    public function actionSave()
    {
        $request = \Yii::$app->request;
        if($request->isPost){
            \Yii::$app->response->format = Response::FORMAT_JSON;
            $uuid = $request->post('uuid');
            $yy = YyLiveRoom::findOne(['uuid' => $uuid]);
            if(empty($yy)){
                return ['err_code' => 1, 'err_msg' => '修改失败'];
            }
            $currentLiveAccount = YyLiveRoom::findOne(['status' => 1]);

            if(!empty($currentLiveAccount)){
                if($currentLiveAccount->yy_room == $yy->yy_room){
                    return ['err_code' =>2 , 'err_msg' => '此账号为当前直播账号'];
                }
                $currentLiveAccount->status = -1;
                $currentLiveAccount->save();
            }

            $yy->status = 1;
            $yy->save();
            return ['err_code' => 0, 'err_msg' => '修改成功'];
        }
    }



    public function actionEdit()
    {
        $request = \Yii::$app->request;
        if($request->isPost){
            \Yii::$app->response->format = Response::FORMAT_JSON;
            $uuid = $request->post('uuid');
            $roomId = $request->post('room_id');
            $roomTeacher = $request->post('room_teacher');
            $description = $request->post('description');
            $yy = YyLiveRoom::findOne(['uuid' => $uuid]);

            if(empty($yy)) {
                return ['err_code' => 1, 'err_msg' => '修改失败'];
            }
            $yy->yy_room = $roomId;
            $yy->room_teacher = $roomTeacher;
            $yy->description = $description;
            $yy->save();
            return ['err_code' => 0, 'err_msg' => '修改成功'];
        }
    }

    public function actionAdd()
    {
        $request = \Yii::$app->request;
        if($request->isPost){
            \Yii::$app->response->format = Response::FORMAT_JSON;
            $roomId = $request->post('room_id');
            $roomTeacher = $request->post('room_teacher');
            $description = $request->post('description');
            $yy = new YyLiveRoom();
            $yy->uuid = StringHelper::generateUuid();
            $yy->yy_room = $roomId;
            $yy->room_teacher = $roomTeacher;
            $yy->description = $description;
            $yy->create_time = time();
            $yy->update_time = time();
            $yy->save();
            return ['err_code' => 0, 'err_msg' => '添加成功'];
        }
    }


    public function actionDel()
    {
        $request = \Yii::$app->request;
        if($request->isPost){
            \Yii::$app->response->format = Response::FORMAT_JSON;
            $uuid = $request->post('uuid');
            $yy = YyLiveRoom::findOne(['uuid' => $uuid]);
            if(empty($yy)) {
                return ['err_code' => 1, 'err_msg' => '删除失败'];
            }
            $yy->delete();
            return ['err_code' => 0, 'err_msg' => '删除成功'];
        }
    }


}