//上传封面图片，(添加和修改素材库)
/**
 * 上传单个图片
 * ①:必须要在上传文件的那个按钮选项中加入类(upload_single_img)
 * ②:必须要在这个按钮的兄弟级加入类(uploader-list);
 * 例:
 <div id="addMateri1" class="uploader-list "></div>
 <div id="addMaterialr1" class="upload_single_img">上传图片</div>
 <input class="csrf" name="" type="hidden" value="<?= Yii::$app->request->csrfToken ?>" />
 *
 */
var single_img_num = 0;
$('.upload_single_img').each(function () {
    var pick = '#'+this.id;
    var uploader = 'upload'+single_img_num;
    var list = 'lists'+single_img_num;
    var base_dom = '#'+$(this).siblings('.uploader-list').attr('id');
    var lists = $(base_dom);
    var  BASE_URL = "";
    var avatar = $(this).attr('data-avatar');
    if(avatar == 1){
        var url = 'index.php?r=common/file-storage/upload-image&avatar=1';
    }else{
        var url = 'index.php?r=common/file-storage/upload-image';
    }
    // 初始化Web Uploader
    var uploader = WebUploader.create({

        // 选完文件后，是否自动上传。
        auto: true,

        // swf文件路径
        swf: BASE_URL + '/js/Uploader.swf',
        formData: {
            _csrf: $('.csrf').attr('value')
        },
        // 文件接收服务端。
        //server: 'http://wom2.com?r=weixin/ad-owner-plan/upload',
        server: url,

        // 选择文件的按钮。可选。
        // 内部根据当前运行是创建，可能是input元素，也可能是flash.
        pick: ''+pick,

        // 只允许选择图片文件。
        accept: {
            title: 'Images',
            extensions: 'gif,jpg,jpeg,bmp,png',
            mimeTypes: 'image/*'
        }
    });
    // 当有文件添加进来的时候
    uploader.on( 'fileQueued', function( file ) {
        var $li = $(
                //'<div id="' + file.id + '" class="file-item thumbnail">' +
                '<div id="' + file.id + '" class="imgWrap" >' +
                    //'<img>' +

                '<img>' +
                '<div class="delete-image">' +
                '<span class="cancel"></span>'+
                    //'<i class="cover-close"></i>' +
                    //'<div class="info">' + file.name + '</div>' +
                    //'<input type="hidden" id="follower-screenshot" name="follower_screenshot" value="">'   +
                '</div>'  +
                '</div>'
            ),

            $img = $li.find('img');


        // $list为容器jQuery实例
        lists.append( $li );
        //隐藏上传按钮
        $(pick+' .color-fff').hide();
        $(pick).hide();
        // 创建缩略图
        // 如果为非图片文件，可以不用调用此方法。
        // thumbnailWidth x thumbnailHeight 为 100 x 100
        uploader.makeThumb( file, function( error, src ) {
            if ( error ) {
                $img.replaceWith('<span>不能预览</span>');
                return;
            }

            $img.attr( 'src', src );
        }, 200, 200 );
    });
    // 文件上传过程中创建进度条实时显示。
    uploader.on( 'uploadProgress', function( file, percentage ) {
        var $li = $( '#'+file.id ),
            $percent = $li.find('.progress span');

        // 避免重复创建
        if ( !$percent.length ) {
            $percent = $('<p class="progress"><span></span></p>')
                .appendTo( $li )
                .find('span');
        }

        $percent.css( 'width', percentage * 100 + '%' );
    });

    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
    uploader.on( 'uploadSuccess', function( file, response  ) {

        //$( '#'+file.id ).addClass('upload-state-done');
        //$('#filePicker .color-fff').remove();

        //$("input#follower-screenshot").val(response['_raw']);

        $('#'+file.id).attr('data-name', response.msg);
        //$( '#'+file.id ).attr('class','w');


    });

    // 文件上传失败，显示上传出错。
    uploader.on( 'uploadError', function( file ) {
        var $li = $( '#'+file.id ),
            $error = $li.find('div.error');

        // 避免重复创建
        if ( !$error.length ) {
            $error = $('<div class="error"></div>').appendTo( $li );
        }

        $error.text('上传失败');
    });

    // 完成上传完了，成功或者失败，先删除进度条。
    uploader.on( 'uploadComplete', function( file ) {
        $( '#'+file.id ).find('.progress').remove();
    });

    //添加文件选择按钮
    //uploader.addButton({
    //    id: '#btnContainer3',
    //    innerHTML: '选择文件'
    //});

    //定义按钮样式
    $(pick+" .webuploader-pick").attr("class","btn");

    //删除图片
    lists.on("click",".imgWrap .delete-image",function(file){
        var img= $(this).parent().attr('data-name');
        var img_dom = $(this).parent(".imgWrap");
        // TODO: 后台物理删除图片
        realDelImg(img,img_dom,uploader,pick,'图片');

    });
    single_img_num++;
});


/**
 * 上传多个图片
 * ①:必须要在上传文件的那个按钮选项中加入类(upload_multiple_img)
 * ②:必须要在这个按钮的兄弟级加入类(uploader-list);
 * 例:
 <div id="addMateri1" class="uploader-list "></div>
 <div id="addMaterialr1" class="upload_multiple_img">上传图片</div>
 <input class="csrf" name="" type="hidden" value="<?= Yii::$app->request->csrfToken ?>" />
 *
 */
var multiple_img_num = 0;
$('.upload_multiple_img').each(function () {
    var pick = '#'+this.id;
    var uploader = 'upload'+multiple_img_num;
    var list = 'lists'+multiple_img_num;
    var base_dom = '#'+$(this).siblings('.uploader-list').attr('id');
    var lists = $(base_dom);
    var  BASE_URL = "";
    var numSize = $(pick).attr("data-size");
    // 初始化Web Uploader
    var uploader = WebUploader.create({

        // 选完文件后，是否自动上传。
        auto: true,

        // swf文件路径
        swf: BASE_URL + '/js/Uploader.swf',
        formData: {
            _csrf: $('.csrf').attr('value')
        },
        // 文件接收服务端。
        //server: 'http://wom2.com?r=weixin/ad-owner-plan/upload',
        server: 'index.php?r=common/file-storage/upload-image',

        // 选择文件的按钮。可选。
        // 内部根据当前运行是创建，可能是input元素，也可能是flash.
        pick: ''+pick,

        // 只允许选择图片文件。
        accept: {
            title: 'Images',
            extensions: 'gif,jpg,jpeg,bmp,png',
            mimeTypes: 'image/*'
        }
    });
    // 当有文件添加进来的时候
    uploader.on( 'fileQueued', function( file ) {
        var $li = $(
                //'<div id="' + file.id + '" class="file-item thumbnail">' +
                '<div id="' + file.id + '" class="imgWrap" >' +
                    //'<img>' +

                '<img>' +
                '<div class="delete-image">' +
                '<span class="cancel"></span>'+
                    //'<i class="cover-close"></i>' +
                    //'<div class="info">' + file.name + '</div>' +
                    //'<input type="hidden" id="follower-screenshot" name="follower_screenshot" value="">'   +
                '</div>'  +
                '</div>'
            ),

            $img = $li.find('img');


        // $list为容器jQuery实例
        lists.append( $li );
        //隐藏上传按钮
        //$(pick+' .color-fff').remove();
        //$(pick).remove();
        // 创建缩略图
        // 如果为非图片文件，可以不用调用此方法。
        // thumbnailWidth x thumbnailHeight 为 100 x 100
        uploader.makeThumb( file, function( error, src ) {
            if ( error ) {
                $img.replaceWith('<span>不能预览</span>');
                return;
            }

            $img.attr( 'src', src );
        }, 100, 100 );
    });
    // 文件上传过程中创建进度条实时显示。
    uploader.on( 'uploadProgress', function( file, percentage ) {
        var $li = $( '#'+file.id ),
            $percent = $li.find('.progress span');

        // 避免重复创建
        if ( !$percent.length ) {
            $percent = $('<p class="progress"><span></span></p>')
                .appendTo( $li )
                .find('span');
        }

        $percent.css( 'width', percentage * 100 + '%' );
    });

    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
    uploader.on( 'uploadSuccess', function( file, response  ) {

        //$( '#'+file.id ).addClass('upload-state-done');
        //$('#filePicker .color-fff').remove();

        //$("input#follower-screenshot").val(response['_raw']);

        $('#'+file.id).attr('data-name', response.msg);
        //$( '#'+file.id ).attr('class','w');
        if($(pick).siblings('.uploader-list').find(".imgWrap").length >= numSize){
            $(pick).css("display","none");
        }else{
            $(pick).css("display","inherit")
        }
    });

    // 文件上传失败，显示上传出错。
    uploader.on( 'uploadError', function( file ) {
        var $li = $( '#'+file.id ),
            $error = $li.find('div.error');

        // 避免重复创建
        if ( !$error.length ) {
            $error = $('<div class="error"></div>').appendTo( $li );
        }

        $error.text('上传失败');
    });

    // 完成上传完了，成功或者失败，先删除进度条。
    uploader.on( 'uploadComplete', function( file ) {
        $( '#'+file.id ).find('.progress').remove();
    });

    //添加文件选择按钮
    //uploader.addButton({
    //    id: '#btnContainer3',
    //    innerHTML: '选择文件'
    //});

    //定义按钮样式
    $(pick+" .webuploader-pick").attr("class","btn");

    //删除图片
    lists.on("click",".imgWrap .delete-image",function(file){
        var img= $(this).parent().attr('data-name');
        var img_dom = $(this).parent(".imgWrap");
        // TODO: 后台物理删除图片
        realDelImg(img,img_dom,uploader,pick,'图片');

    });
    multiple_img_num++;
});



/**
 * 上传多个图片-------------只显示图片名
 * ①:必须要在上传文件的那个按钮选项中加入类(upload_multiple_img)
 * ②:必须要在这个按钮的兄弟级加入类(uploader-list);
 * 例:
 <div id="addMateri1" class="uploader-list "></div>
 <div id="addMaterialr1" class="upload_multiple_imgName">上传图片-只显示图片name</div>
 <input class="csrf" name="" type="hidden" value="<?= Yii::$app->request->csrfToken ?>" />
 *
 */
var multiple_img_num = 0;
$('.upload_multiple_imgName').each(function () {


    var pick = '#'+this.id;
    var uploader = 'upload'+multiple_img_num;
    var list = 'lists'+multiple_img_num;
    var base_dom = '#'+$(this).siblings('.uploader-list').attr('id');
    var lists = $(base_dom);
    var  BASE_URL = "";
    var numSize = $(pick).attr("data-size");
    // 初始化Web Uploader
    var uploader = WebUploader.create({

        // 选完文件后，是否自动上传。
        auto: true,

        // swf文件路径
        swf: BASE_URL + '/js/Uploader.swf',
        formData: {
            _csrf: $('.csrf').attr('value')
        },
        // 文件接收服务端。
        //server: 'http://wom2.com?r=weixin/ad-owner-plan/upload',
        server: 'index.php?r=common/file-storage/upload-image',

        // 选择文件的按钮。可选。
        // 内部根据当前运行是创建，可能是input元素，也可能是flash.
        pick: ''+pick,

        // 只允许选择图片文件。
        accept: {
            title: 'Images',
            extensions: 'gif,jpg,jpeg,bmp,png',
            mimeTypes: 'image/*'
        }
    });
    // 当有文件添加进来的时候
    uploader.on( 'fileQueued', function( file ) {
        //截取文件名后7个字符
        var textLength = file.name.length;
        if(textLength > 14){
            var name = "..." + file.name.substring(textLength-14,textLength);
        }else{
            var name =  file.name;
        }
        var $li = $(
                '<div id="' + file.id + '" class="file-list material"><div class="file">' +
                '<img style="display: none;">' +
                '<span class="info">' + name + '</span>' +
                '<div class="delete-image"></div>' +
                '</div>' +
                '</div>'
            ),
            $img = $li.find('img');
        // $list为容器jQuery实例
        lists.append( $li );
        //隐藏上传按钮
        //$(pick+' .color-fff').remove();
        //$(pick).remove();
        // 创建缩略图
        // 如果为非图片文件，可以不用调用此方法。
        // thumbnailWidth x thumbnailHeight 为 100 x 100
        uploader.makeThumb( file, function( error, src ) {
            if ( error ) {
                $img.replaceWith('<span>不能预览</span>');
                return;
            }

            $img.attr( 'src', src );
        }, 100, 100 );
        //进度条
    });
    // 文件上传过程中创建进度条实时显示。
    uploader.on( 'uploadProgress' , function( file, percentage ) {

        var $li = $( '#'+file.id ),
            $percent = $li.find('.progress span');
        //console.log(percentage);
        // 避免重复创建
        if ( !$percent.length ) {
            //  percentage 为已上传的大小之比
            $percent = $('<p class="progress">' + percentage * 100 + '%<span></span></p>')
                .appendTo( $li )
                .find('span');
        }
        $percent.css( 'width', percentage * 100 + '%' );
    });

    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
    uploader.on( 'uploadSuccess', function( file, response  ) {

        //$( '#'+file.id ).addClass('upload-state-done');
        //$('#filePicker .color-fff').remove();

        //$("input#follower-screenshot").val(response['_raw']);

        $('#'+file.id).attr('data-name', response.msg);
        if($(pick).siblings('.uploader-list').find(".file-list").length >= numSize){
            $(pick).css("display","none");
        }else{
            $(pick).css("display","inherit")
        }

    });

    // 文件上传失败，显示上传出错。
    uploader.on( 'uploadError', function( file ) {
        var $li = $( '#'+file.id ),
            $error = $li.find('div.error');

        // 避免重复创建
        if ( !$error.length ) {
            $error = $('<div class="error"></div>').appendTo( $li );
        }

        $error.text('上传失败');
    });

    // 完成上传完了，成功或者失败，先删除进度条。
    uploader.on( 'uploadComplete', function( file ) {
        //$( '#'+file.id ).find('.progress').fadeOut();
    });

    //添加文件选择按钮
    //uploader.addButton({
    //    id: '#btnContainer3',
    //    innerHTML: '选择文件'
    //});

    //定义按钮样式
    $(pick+" .webuploader-pick").attr("class","btn");

    //删除图片
    lists.on("click",".file-list .delete-image",function(file){
        var img= $(this).parents().parents().attr('data-name');
        var img_dom = $(this).parents(".file-list");
        // TODO: 后台物理删除图片
        realDelImg(img,img_dom,uploader,pick,'图片');

    });
    multiple_img_num++;
});




/**
 * 上传单个文件(doc*)
 * ①:必须要在上传文件的那个按钮选项中加入类(upload_single_file)
 * ②:必须要在这个按钮的兄弟级加入类(uploader-list);
 * 例:
 <div id="addMateri1" class="uploader-list "></div>
 <div id="addMaterialr1" class="upload_single_file">上传文件</div>
 <input class="csrf" name="" type="hidden" value="<?= Yii::$app->request->csrfToken ?>" />
 *
 */
var single_file_num = 0;
$('.upload_single_file').each(function () {
    var pick = '#'+this.id;
    var uploader = 'upload'+single_file_num;
    var list = 'lists'+single_file_num;
    var base_dom = '#'+$(this).siblings('.uploader-list').attr('id');
    var lists = $(base_dom);
    var  BASE_URL = "";

    // 初始化Web Uploader
    var uploader = WebUploader.create({

        // 选完文件后，是否自动上传。
        auto: true,

        // swf文件路径
        swf: BASE_URL + '/js/Uploader.swf',
        formData: {
            _csrf: $('.csrf').attr('value')
        },
        // 文件接收服务端。
        //server: 'http://wom2.com?r=weixin/ad-owner-plan/upload',
        server: 'index.php?r=common/file-storage/upload-file',

        // 选择文件的按钮。可选。
        // 内部根据当前运行是创建，可能是input元素，也可能是flash.
        pick: ''+pick,

        // 只允许选择图片文件。
        accept: {
            title: 'doc',
            extensions: 'doc,docx',
            mimeTypes: 'doc/*'
        }
    });
    // 当有文件添加进来的时候
    uploader.on( 'fileQueued', function( file ) {
        var $li = $(
                //'<div id="' + file.id + '" class="file-item thumbnail">' +
                '<div id="' + file.id + '" class="imgWrap" >' +
                    //'<img>' +

                '<img>' +
                '<div class="delete-image" style="height: 22px;position:absolute;float:right;z-index:100;background: url(http://fex.baidu.com/webuploader/images/icons.png);background-position: -42px -18px;cursor: pointer;right:0;top:0;">' +
                '<span class="cancel" style="visibility:hidden;">删除</span>'+
                    //'<i class="cover-close"></i>' +
                    //'<div class="info">' + file.name + '</div>' +
                    //'<input type="hidden" id="follower-screenshot" name="follower_screenshot" value="">'   +
                '</div>'  +
                '</div>'
            ),

            $img = $li.find('img');


        // $list为容器jQuery实例
        lists.append( $li );
        //隐藏上传按钮
        $(pick+' .color-fff').hide();
        $(pick).hide();
        // 创建缩略图
        // 如果为非图片文件，可以不用调用此方法。
        // thumbnailWidth x thumbnailHeight 为 100 x 100
        uploader.makeThumb( file, function( error, src ) {
            if ( error ) {
                $img.replaceWith('<span>上传成功</span>');
                return;
            }

            $img.attr( 'src', src );
        }, 100, 100 );
    });
    // 文件上传过程中创建进度条实时显示。
    uploader.on( 'uploadProgress', function( file, percentage ) {
        var $li = $( '#'+file.id ),
            $percent = $li.find('.progress span');

        // 避免重复创建
        if ( !$percent.length ) {
            $percent = $('<p class="progress"><span></span></p>')
                .appendTo( $li )
                .find('span');
        }

        $percent.css( 'width', percentage * 100 + '%' );
    });

    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
    uploader.on( 'uploadSuccess', function( file, response  ) {

        //$( '#'+file.id ).addClass('upload-state-done');
        //$('#filePicker .color-fff').remove();

        //$("input#follower-screenshot").val(response['_raw']);

        $('#'+file.id).attr('data-name', response.msg);
        //$( '#'+file.id ).attr('class','w');


    });

    // 文件上传失败，显示上传出错。
    uploader.on( 'uploadError', function( file ) {
        var $li = $( '#'+file.id ),
            $error = $li.find('div.error');

        // 避免重复创建
        if ( !$error.length ) {
            $error = $('<div class="error"></div>').appendTo( $li );
        }

        $error.text('上传失败');
    });

    // 完成上传完了，成功或者失败，先删除进度条。
    uploader.on( 'uploadComplete', function( file ) {
        $( '#'+file.id ).find('.progress').remove();
    });

    //添加文件选择按钮
    //uploader.addButton({
    //    id: '#btnContainer3',
    //    innerHTML: '选择文件'
    //});

    //定义按钮样式
    $(pick+" .webuploader-pick").attr("class","btn");

    //删除图片
    lists.on("click",".imgWrap .delete-image",function(file){
        var img= $(this).parent().attr('data-name');
        var img_dom = $(this).parent(".imgWrap");
        // TODO: 后台物理删除图片
        realDelImg(img,img_dom,uploader,pick,'文档');

    });
    single_file_num++;
});


/**
 * 上传多个文件(doc*)
 * ①:必须要在上传文件的那个按钮选项中加入类(upload_multiple_file)
 * ②:必须要在这个按钮的兄弟级加入类(uploader-list);
 * 例:
 <div id="addMateri1" class="uploader-list "></div>
 <div id="addMaterialr1" class="upload_multiple_file">上传文件</div>
 <input class="csrf" name="" type="hidden" value="<?= Yii::$app->request->csrfToken ?>" />
 *
 */
var multiple_file_num = 0;
$('.upload_multiple_file').each(function () {
    var pick = '#'+this.id;
    var uploader = 'upload'+multiple_file_num;
    var list = 'lists'+multiple_file_num;
    var base_dom = '#'+$(this).siblings('.uploader-list').attr('id');
    var lists = $(base_dom);
    var  BASE_URL = "";

    // 初始化Web Uploader
    var uploader = WebUploader.create({

        // 选完文件后，是否自动上传。
        auto: true,

        // swf文件路径
        swf: BASE_URL + '/js/Uploader.swf',
        formData: {
            _csrf: $('.csrf').attr('value')
        },
        // 文件接收服务端。
        //server: 'http://wom2.com?r=weixin/ad-owner-plan/upload',
        server: 'index.php?r=common/file-storage/upload-file',

        // 选择文件的按钮。可选。
        // 内部根据当前运行是创建，可能是input元素，也可能是flash.
        pick: ''+pick,

        // 只允许选择图片文件。
        accept: {
            title: 'doc',
            extensions: 'doc,docx',
            mimeTypes: 'doc/*'
        }
    });
    // 当有文件添加进来的时候
    uploader.on( 'fileQueued', function( file ) {
        var $li = $(
                //'<div id="' + file.id + '" class="file-item thumbnail">' +
                '<div id="' + file.id + '" class="imgWrap" >' +
                    //'<img>' +

                '<img>' +
                '<div class="delete-image" style="height: 22px;position:absolute;float:right;z-index:100;background: url(http://fex.baidu.com/webuploader/images/icons.png);background-position: -42px -18px;cursor: pointer;right:0;top:0;">' +
                '<span class="cancel" style="visibility:hidden;">删除</span>'+
                    //'<i class="cover-close"></i>' +
                    //'<div class="info">' + file.name + '</div>' +
                    //'<input type="hidden" id="follower-screenshot" name="follower_screenshot" value="">'   +
                '</div>'  +
                '</div>'
            ),

            $img = $li.find('img');


        // $list为容器jQuery实例
        lists.append( $li );
        //隐藏上传按钮
        //$(pick+' .color-fff').remove();
        //$(pick).remove();
        // 创建缩略图
        // 如果为非图片文件，可以不用调用此方法。
        // thumbnailWidth x thumbnailHeight 为 100 x 100
        uploader.makeThumb( file, function( error, src ) {
            if ( error ) {
                $img.replaceWith('<span>不能预览</span>');
                return;
            }

            $img.attr( 'src', src );
        }, 100, 100 );
    });
    // 文件上传过程中创建进度条实时显示。
    uploader.on( 'uploadProgress', function( file, percentage ) {
        var $li = $( '#'+file.id ),
            $percent = $li.find('.progress span');

        // 避免重复创建
        if ( !$percent.length ) {
            $percent = $('<p class="progress"><span></span></p>')
                .appendTo( $li )
                .find('span');
        }

        $percent.css( 'width', percentage * 100 + '%' );
    });

    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
    uploader.on( 'uploadSuccess', function( file, response  ) {

        //$( '#'+file.id ).addClass('upload-state-done');
        //$('#filePicker .color-fff').remove();

        //$("input#follower-screenshot").val(response['_raw']);

        $('#'+file.id).attr('data-name', response.msg);
        //$( '#'+file.id ).attr('class','w');


    });

    // 文件上传失败，显示上传出错。
    uploader.on( 'uploadError', function( file ) {
        var $li = $( '#'+file.id ),
            $error = $li.find('div.error');

        // 避免重复创建
        if ( !$error.length ) {
            $error = $('<div class="error"></div>').appendTo( $li );
        }

        $error.text('上传失败');
    });

    // 完成上传完了，成功或者失败，先删除进度条。
    uploader.on( 'uploadComplete', function( file ) {
        $( '#'+file.id ).find('.progress').remove();
    });

    //添加文件选择按钮
    //uploader.addButton({
    //    id: '#btnContainer3',
    //    innerHTML: '选择文件'
    //});

    //定义按钮样式
    $(pick+" .webuploader-pick").attr("class","btn");

    //删除图片
    lists.on("click",".imgWrap .delete-image",function(file){
        var img= $(this).parent().attr('data-name');
        var img_dom = $(this).parent(".imgWrap");
        // TODO: 后台物理删除图片
        realDelImg(img,img_dom,uploader,pick,'文档');

    });
    multiple_file_num++;
});

/***
 * 物理删除上传图片
 * @param img 上传图片的文件名称
 * @param img_dom 需要删除图片的样式dom结构
 * @param uploader 插件的实例
 * @param option_dom 按钮所在的id;例:#filePickCoverImg
 */
function realDelImg(img,img_dom,uploader,option_dom,type_str){
    swal({
        title: '确认删除'+type_str+'吗？',
        text: '',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: '确认',
        cancelButtonText: '取消',
        closeOnConfirm: false
    },function () {
        $.ajax({
            url:'index.php?r=common/file-storage/del-file',
            method: 'POST',
            dataType: 'json',
            cache: false,
            data: {img:img},
            success: function(resp) {
                if(resp.err_code == 0){
                    swal({title:resp.err_msg,text:'',type:'success'}, function () {
                        img_dom.remove();
                        $(option_dom).find('.color-fff').show();
                        $(option_dom).show();
                        uploader.reset();
                    })
                }else{
                    swal({title:resp.err_msg,text:'','type':'error'})
                    return false;
                }
            },
            error: function (XMLHttpRequest, msg, errorThrown) {
                swal({title: "系统出错!", text: "请联系系统管理员", type: "error"});
            }
        })
    })
}

