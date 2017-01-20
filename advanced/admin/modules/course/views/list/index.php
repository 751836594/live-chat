<?php
use admin\assets\AppAsset;
use yii\grid\GridView;
use yii\helpers\Html;
$this->title= '课程表';
date_default_timezone_set('PRC');
$url = Yii::$app->urlManager;
AppAsset::addScript($this, '@web/plugins/select2/dist/js/select2.min.js');
AppAsset::addCss($this, '@web/plugins/select2/dist/css/select2.min.css');
AppAsset::addScript($this, '@web/plugins/bootstrap-daterangepicker/moment.min.js');
AppAsset::addScript($this, '@web/plugins/bootstrap-daterangepicker/daterangepicker.js');
AppAsset::addScript($this, '@web/plugins/bootstrap-daterangepicker/lang/zh-cn.js');
AppAsset::addCss($this, '@web/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css');
$save = $url->createUrl(['course/list/save']);
$del = $url->createUrl(['course/list/del']);
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

    $('#add-course').click(function() {
        var table = $('.detail').find('table tbody');
        var size = table.find('td').size();
        if(size <= 1){
            $('#course-add').modal('show');
            return false;
        }
        var add_tr = table.find('tr:last').clone(true);
        add_tr.find('td').each(function() {
            if($(this).hasClass('comp-name')){
                var html = '<input style="width:80px;" type="text"/>';
                $(this).html(html);
            }else{
                
                var button = '<button type="button" class="btn btn-link btn-xs btn-save">确定</button>&nbsp;<button type="button" class="btn btn-link btn-xs btn-del">删除</button>';
                $(this).html(button);
            }
            
        })
        table.append(add_tr);
    })
    
    $('#course-add').on('click','.btn-commit',function() {
        var time = $('#course-add').find('.add-time').val();
        var monday = $('#course-add').find('.add-monday').val();
        var tuesday = $('#course-add').find('.add-tuesday').val();
        var wednesday = $('#course-add').find('.add-wednesday').val();
        var thursday = $('#course-add').find('.add-thursday').val();
        var friday = $('#course-add').find('.add-friday').val();
        var saturday = $('#course-add').find('.add-saturday').val();
        var sunday = $('#course-add').find('.add-sunday').val();
          $.ajax({
                url: '$save',
                method: 'POST',
                dataType: 'json',
                data: {uuid:-1,time:time,monday:monday,tuesday:thursday,wednesday:wednesday,thursday:thursday,friday:friday,saturday:saturday,sunday:sunday},
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
    })
    
    $('.detail').on('click','.btn-del',function() {
        var uuid = $(this).attr('data-uuid');
        var dom = $(this);
        if(uuid == undefined){
            dom.parents('tr').remove();
        }else{
            if(confirm('确定删除当前记录吗')){
                $.ajax({
                    url: '$del',
                    method: 'POST',
                    dataType: 'json',
                    data: {uuid:uuid},
                    success: function(resp) {
                        if(resp.err_code == 0){
                            dom.parents('tr').remove();
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
        }
        
    });
    
    $('.detail').on('click','.btn-save',function() {
        var uuid = $(this).attr('data-uuid');
        var dom = $(this);
        var tr = dom.parents('tr');
        var time,monday,tuesday,wednesday,thursday,friday,saturday,sunday = '';
        tr.find('td.comp-name').each(function() {
            if($(this).hasClass('time')){
                time = $(this).children().val();
            }else if($(this).hasClass('monday')){
                monday = $(this).children().val();
            }else if($(this).hasClass('tuesday')){
                tuesday = $(this).children().val();
            }else if($(this).hasClass('wednesday')){
                wednesday = $(this).children().val();
            }else if($(this).hasClass('thursday')){
                thursday = $(this).children().val();
            }else if($(this).hasClass('friday')){
                friday = $(this).children().val();
            }else if($(this).hasClass('saturday')){
                saturday = $(this).children().val();
            }else if($(this).hasClass('sunday')){
                sunday = $(this).children().val();
            }   
        })
        if(uuid == undefined){
            uuid = '-1';
        }
        $.ajax({
            url: '$save',
            method: 'POST',
            dataType: 'json',
            data: {uuid:uuid,time:time,monday:monday,tuesday:tuesday,wednesday:wednesday,thursday:thursday,friday:friday,saturday:saturday,sunday:sunday},
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
    })
    
    $('.detail').on('click','.btn-edit',function() {
        var uuid = $(this).attr('data-uuid');
        var dom = $(this);
        dom.parents('tr').find('td').each(function() {
            var value = $(this).text();
            if($(this).hasClass('comp-name')){
                var html = '<input style="width:80px;" type="text" value="'+value+'"/>';
                $(this).html(html);
            }else{
                var button = '<button type="button" class="btn btn-link btn-xs btn-save" data-uuid="'+uuid+'">确定</button>&nbsp;<button type="button" class="btn btn-link btn-xs btn-del" data-uuid="'+uuid+'">删除</button>';
                $(this).html(button);
            }
            
        })
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
//                'summary' => false,
                'columns' => [
//                    [
//                        'class' => 'yii\grid\SerialColumn',
//                        'headerOptions' => ['data-sort-ignore' => 'true'],
//                        'contentOptions' => ['class' => 'serial'],
//                    ],
                    [
                        'header' => '时间',
                        'format' => 'html',
                        'headerOptions' => ['data-sort-ignore' => 'true'],
                        'contentOptions' => ['class' => 'comp-name time'],
                        'value' => function ($model, $key, $index, $column) {
                            return $model['time'];
                        },
                    ],[
                        'header' => '星期一',
                        'format' => 'html',
                        'headerOptions' => ['data-sort-ignore' => 'true'],
                        'contentOptions' => ['class' => 'comp-name monday'],
                        'value' => function ($model, $key, $index, $column) {
                            return $model['monday'];
                        },
                    ],[
                        'header' => '星期二',
                        'format' => 'html',
                        'headerOptions' => ['data-sort-ignore' => 'true'],
                        'contentOptions' => ['class' => 'comp-name tuesday'],
                        'value' => function ($model, $key, $index, $column) {
                            return $model['tuesday'];
                        },
                    ],[
                        'header' => '星期三',
                        'format' => 'html',
                        'headerOptions' => ['data-sort-ignore' => 'true'],
                        'contentOptions' => ['class' => 'comp-name wednesday'],
                        'value' => function ($model, $key, $index, $column) {
                            return $model['wednesday'];
                        },
                    ],[
                        'header' => '星期四',
                        'format' => 'html',
                        'headerOptions' => ['data-sort-ignore' => 'true'],
                        'contentOptions' => ['class' => 'comp-name thursday'],
                        'value' => function ($model, $key, $index, $column) {
                            return $model['thursday'];
                        },
                    ],[
                        'header' => '星期五',
                        'format' => 'html',
                        'headerOptions' => ['data-sort-ignore' => 'true'],
                        'contentOptions' => ['class' => 'comp-name friday'],
                        'value' => function ($model, $key, $index, $column) {
                            return $model['friday'];
                        },
                    ],[
                        'header' => '星期六',
                        'format' => 'html',
                        'headerOptions' => ['data-sort-ignore' => 'true'],
                        'contentOptions' => ['class' => 'comp-name saturday'],
                        'value' => function ($model, $key, $index, $column) {
                            return $model['saturday'];
                        },
                    ],[
                        'header' => '星期日',
                        'format' => 'html',
                        'headerOptions' => ['data-sort-ignore' => 'true'],
                        'contentOptions' => ['class' => 'comp-name sunday'],
                        'value' => function ($model, $key, $index, $column) {
                            return $model['sunday'];
                        },
                    ],[
                        'class' => 'yii\grid\ActionColumn',
                        'header' => '操作',
                        'template' => '{edit}&nbsp;{del}',
                        'buttons' => [
                            'edit' => function ($url, $model) {
                                return Html::button('修改', ['class' => 'btn btn-link btn-xs btn-edit','data'=>['uuid'=>$model['uuid']]]);
                            },
                            'del' => function ($url, $model) {
                                return Html::button('删除', ['class' => 'btn btn-link btn-xs btn-del','data'=>['uuid'=>$model['uuid']]]);
                            },

                        ],
                        'headerOptions' => ['data-sort-ignore' => 'true'],
                        'contentOptions' => ['class' => '']
                    ],

                ]
            ])?>
            <i class="glyphicon glyphicon-plus pull-right" style="font-size: large;cursor: pointer" id="add-course"></i>
        </div>

    </div>
</div>


<div class="modal fade" id="course-add"  tabindex="-1" role="dialog" aria-hidden="true"
     data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <h4 class="modal-title">添加课程表</h4>
            </div>
            <div class="modal-body">
                <div class="panel panel-inverse">
                    <div class="panel-body">
                        <div class="form-horizontal">
                            <input type="hidden" class="vendor-uuid" value="">
                            <input type="hidden" class="vendor-name" value="">
                            <div class="form-group">
                                <label class="col-md-3 control-label">时间段:</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control add-time" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">星期一:</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control add-monday" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">星期二:</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control add-tuesday" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">星期三:</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control add-wednesday" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">星期四:</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control add-thursday" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">星期五:</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control add-friday" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">星期六:</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control add-saturday" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">星期日:</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control add-sunday" placeholder="">
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