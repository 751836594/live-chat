<?php
namespace  admin\modules\course\controllers;
use admin\helpers\DataHelper;
use admin\models\ChildPromotion;
use admin\models\Promotion;
use admin\models\BasePromotion;
use common\helper\AdminHelper;
use common\helper\DateTimeHelper;
use common\helper\StringHelper;
use common\models\Course;
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
                ->from(['course' => Course::tableName()]);
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

    public function actionSave()
    {
        $request = \Yii::$app->request;
        \Yii::$app->response->format = Response::FORMAT_JSON;
        if($request->isPost){
            $uuid = $request->post('uuid');
            $time = $request->post('time');
            $monday = $request->post('monday');
            $tuesday = $request->post('tuesday');
            $wednesday = $request->post('wednesday');
            $thursday = $request->post('thursday');
            $friday = $request->post('friday');
            $saturday = $request->post('saturday');
            $sunday = $request->post('sunday');

            if($uuid != -1){
                $course = Course::findOne(['uuid' => $uuid]);
                if(empty($course)){
                    return ['err_code' => '1', 'err_msg' => '保存失败'];
                }
                $course->time = $time;
                $course->monday = $monday;
                $course->tuesday = $tuesday;
                $course->wednesday = $wednesday;
                $course->thursday = $thursday;
                $course->friday = $friday;
                $course->sunday = $sunday;
                $course->saturday = $saturday;

            }else{
                $course  = new Course();
                $course->uuid = StringHelper::generateUuid();
                $course->time = $time;
                $course->monday = $monday;
                $course->tuesday = $tuesday;
                $course->wednesday = $wednesday;
                $course->thursday = $thursday;
                $course->friday = $friday;
                $course->sunday = $sunday;
                $course->saturday = $saturday;
            }

            $course->save();
            return ['err_code' => 0, 'err_msg' => '保存成功'];
        }
    }


    public function actionDel()
    {
        $request = \Yii::$app->request;
        \Yii::$app->response->format = Response::FORMAT_JSON;
        if($request->isPost){
            $uuid = $request->post('uuid');
            $course = Course::findOne(['uuid' => $uuid]);
            if(empty($course)){
                return ['err_code' => '1', 'err_msg' => '删除失败'];
            }
            $course->delete();
            return ['err_code' => 0, 'err_msg' => '删除成功'];
        }
    }




}