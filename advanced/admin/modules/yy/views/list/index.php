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
$save = $url->createUrl(['yy/list/save']);
$del = $url->createUrl(['yy/list/del']);
$edit = $url->createUrl(['yy/list/edit']);
$add = $url->createUrl(['yy/list/add']);
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

    $('.detail').on('click','.btn-save',function() {
        var uuid = $(this).attr('data-uuid');
        if(confirm("确定设为当前直播讲师吗")){
            $.ajax({
                url: '$save',
                method: 'POST',
                datatType: 'json',
                data: {uuid:uuid},
                success: function(resp) {
                    alert(resp.err_msg);
                    if(resp.err_code == 0){
                        location.reload();
                    }
                    return false;
                },
                error: function(error) {
                    console.log(error);
                }
            })
        }
        return false;
    })
    $('.detail').on('click','.btn-edit',function() {
        var uuid = $(this).attr('data-uuid');
        var dom = $(this).parents('tr');
        var model = $('#room-modify');
        var room_id = dom.find('.yy-room').text();
        var room_teacher = dom.find('.room-teacher').text();
        var description = dom.find('.description').text();
        model.find('.btn-commit').attr('data-uuid',uuid);
        model.find('.edit-room-id').val(room_id);
        model.find('.edit-room-teacher').val(room_teacher);
        model.find('.edit-description').val(description);
        $('#room-modify').modal('show');
        
    })
    
    $('.detail').on('click','#add-live',function() {
        $('#room-add').modal('show');    
    })
    
    $('#room-modify').on('click','.btn-commit',function() {
        var uuid = $(this).attr('data-uuid');
        var model = $('#room-modify');
        var room_id = model.find('.edit-room-id').val();
        var room_teacher = model.find('.edit-room-teacher').val();
        var description = model.find('.edit-description').val();
        $.ajax({
            url: '$edit',
            method: 'POST',
            datatType: 'json',
            data: {uuid:uuid,room_id:room_id,room_teacher:room_teacher,description:description},
            success: function(resp) {
                alert(resp.err_msg);
                if(resp.err_code == 0){
                    location.reload();
                }
                return false;
            },
            error: function(error) {
                console.log(error);
            }
        })
    })
    
    $('#room-add').on('click','.btn-commit',function() {
        var model = $('#room-add');
        var room_id = model.find('.add-room-id').val();
        var room_teacher = model.find('.add-room-teacher').val();
        var description = model.find('.add-description').val();
        $.ajax({
            url: '$add',
            method: 'POST',
            datatType: 'json',
            data: {room_id:room_id,room_teacher:room_teacher,description:description},
            success: function(resp) {
                alert(resp.err_msg);
                if(resp.err_code == 0){
                    location.reload();
                }
                return false;
            },
            error: function(error) {
                console.log(error);
            }
        })
    })
    
    
    $('.detail').on('click','.btn-del',function() {
        var uuid = $(this).attr('data-uuid');
        if(confirm("确定删除当前直播讲师吗")){
            $.ajax({
                url: '$del',
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
            <h2 class="pull-left">当前直播房间号:<span class="text-danger"><?=$liveAccount?></span></h2>

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
                        'header' => '直播房间号',
                        'format' => 'html',
                        'headerOptions' => ['data-sort-ignore' => 'true'],
                        'contentOptions' => ['class' => 'comp-name yy-room'],
                        'value' => function ($model, $key, $index, $column) {
                            return $model['yy_room'];
                        },
                    ],[
                        'header' => '直播讲师',
                        'format' => 'html',
                        'headerOptions' => ['data-sort-ignore' => 'true'],
                        'contentOptions' => ['class' => 'comp-name room-teacher'],
                        'value' => function ($model, $key, $index, $column) {
                            return $model['room_teacher'];
                        },
                    ],[
                        'header' => '讲师描述',
                        'format' => 'html',
                        'options' => [],
                        'headerOptions' => ['data-sort-ignore' => 'true','width'=>'700px'],
                        'contentOptions' => ['class' => 'comp-name description'],
                        'value' => function ($model, $key, $index, $column) {
                            return $model['description'];
                        },
                    ],[
                        'class' => 'yii\grid\ActionColumn',
                        'header' => '操作',
                        'headerOptions' => ['data-sort-ignore' => 'true'],
//                        'contentOptions' => ['class' => 'text-center'],
                        'template' => '{edit}&nbsp;{del}&nbsp;{save}',
                        'options' => ['width'=>'220px'],
                        'buttons' => [

                            'edit' => function ($url, $model) {
                                return Html::button('修改', ['class' => 'btn btn-link btn-xs btn-edit','data'=>['uuid'=>$model['uuid']]]);
                            },
                            'del' => function ($url, $model) {
                                return Html::button('删除', ['class' => 'btn btn-link btn-xs btn-del','data'=>['uuid'=>$model['uuid']]]);
                            },
                            'save' => function ($url, $model) {
                                return Html::button('设为当前直播房间', ['class' => 'btn btn-link btn-xs btn-save','data'=>['uuid'=>$model['uuid']]]);
                            },

                        ],

                    ],

                ]
            ])?>
            <i class="glyphicon glyphicon-plus pull-right" style="font-size: large;cursor: pointer" id="add-live"></i>
        </div>

    </div>
</div>


<div class="modal fade" id="room-modify"  tabindex="-1" role="dialog" aria-hidden="true"
     data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <h4 class="modal-title">修改直播信息</h4>
            </div>
            <div class="modal-body">
                <div class="panel panel-inverse">
                    <div class="panel-body">
                        <div class="form-horizontal">
                            <input type="hidden" class="vendor-uuid" value="">
                            <input type="hidden" class="vendor-name" value="">
                            <div class="form-group">
                                <label class="col-md-3 control-label">直播房间号:</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control edit-room-id" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">直播讲师:</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control edit-room-teacher" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">讲师描述:</label>
                                <div class="col-md-6">
                                    <textarea style="width: 100%;height: 10em;" class="edit-description"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div data-uuid="" class="btn btn-sm btn-success btn-commit">确&nbsp;&nbsp;认</div>
                    <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">关闭</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="room-add"  tabindex="-1" role="dialog" aria-hidden="true"
     data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <h4 class="modal-title">添加直播信息</h4>
            </div>
            <div class="modal-body">
                <div class="panel panel-inverse">
                    <div class="panel-body">
                        <div class="form-horizontal">
                            <input type="hidden" class="vendor-uuid" value="">
                            <input type="hidden" class="vendor-name" value="">
                            <div class="form-group">
                                <label class="col-md-3 control-label">直播房间号:</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control add-room-id" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">直播讲师:</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control add-room-teacher" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">讲师描述:</label>
                                <div class="col-md-6">
                                    <textarea style="width: 100%;height: 10em;" class="add-description"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div data-uuid="" class="btn btn-sm btn-success btn-commit">确&nbsp;&nbsp;认</div>
                    <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">关闭</a>
                </div>
            </div>
        </div>
    </div>
</div>