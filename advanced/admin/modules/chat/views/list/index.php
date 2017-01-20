<?php
use admin\assets\AppAsset;
use yii\grid\GridView;
use yii\helpers\Html;
$this->title= '禁言列表';
date_default_timezone_set('PRC');
$url = Yii::$app->urlManager;
AppAsset::addScript($this, '@web/plugins/select2/dist/js/select2.min.js');
AppAsset::addCss($this, '@web/plugins/select2/dist/css/select2.min.css');
AppAsset::addScript($this, '@web/plugins/bootstrap-daterangepicker/moment.min.js');
AppAsset::addScript($this, '@web/plugins/bootstrap-daterangepicker/daterangepicker.js');
AppAsset::addScript($this, '@web/plugins/bootstrap-daterangepicker/lang/zh-cn.js');
AppAsset::addCss($this, '@web/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css');
$edit = $url->createUrl(['chat/list/edit']);
$promotionPlatform = \admin\helpers\AdminHelper::getPromotionPlatform();
$getPromotionChosePageSize = \admin\helpers\AdminHelper::getPromotionChosePageSize();
$js = <<<JS
    $('#promotion-platform').select2();
    $('#user-status').select2();
    $('#client').select2();
    $('#page-size').select2();
    $('.begin-time-range').daterangepicker({
                'singleDatePicker': false,
                'format': 'YYYY-MM-DD',
                'autoApply': true,
                'opens': 'center',
                'drops': 'down',
                'timePicker': false,
                'timePicker24Hour': false,
                'startDate' : new Date()
        });

    $('.detail').on('click','.btn-edit',function() {
        var uuid = $(this).attr('data-uuid');
        if(confirm("确定解除当前账号的禁言吗")){
            $.ajax({
                url: '$edit',
                method: 'POST',
                datatType: 'json',
                data: {uuid:uuid},
                success: function(resp) {
                    if(resp.err_code == 0){
                        location.reload();
                    }else{
                        alert(resp.err_msg);
                        return false;
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            })
        }
        return false;
    })
JS;
$request = Yii::$app->request->get();
$this->registerJs($js);
?>

<div id="content" class="content">
    <div class="panel panel-inverse pjax-area">
        <div class="panel-body detail">
            <?=GridView::widget([
                'dataProvider' => $dataProvider,
                'pager' => [
                    'nextPageLabel' => '下一页',
                    'prevPageLabel' => '上一页',
                    'firstPageLabel' => '首页',
                    'lastPageLabel' => '尾页',
                    'maxButtonCount' => 10,
                ],
                'summary' => false,
                'columns' => [
                    [
                        'class' => 'yii\grid\SerialColumn',
                        'headerOptions' => ['data-sort-ignore' => 'true'],
                        'contentOptions' => ['class' => 'serial'],
                    ],
                    [
                        'header' => '用户名',
                        'format' => 'html',
                        'headerOptions' => ['data-sort-ignore' => 'true'],
                        'contentOptions' => ['class' => 'comp-name sunday'],
                        'value' => function ($model, $key, $index, $column) {
                            return $model['username'];
                        },
                    ],[
                        'header' => '禁言时间',
                        'format' => 'html',
                        'headerOptions' => ['data-sort-ignore' => 'true'],
                        'contentOptions' => ['class' => 'comp-name sunday'],
                        'value' => function ($model, $key, $index, $column) {
                            return date('Y-m-d H:i:s',$model['update_time']);
                        },
                    ],[
                        'class' => 'yii\grid\ActionColumn',
                        'header' => '操作',
                        'headerOptions' => ['data-sort-ignore' => 'true'],
                        'contentOptions' => ['class' => 'text-center'],
                        'template' => '{edit}',
                        'buttons' => [
                            'edit' => function ($url, $model) {
                                return Html::button('解除禁言', ['class' => 'btn btn-link btn-xs btn-edit','data'=>['uuid'=>$model['uuid']]]);
                            },

                        ],

                    ],

                ]
            ])?>
            <i class="glyphicon glyphicon-plus pull-right" style="font-size: large;cursor: pointer" id="add-course"></i>
        </div>

    </div>
</div>
