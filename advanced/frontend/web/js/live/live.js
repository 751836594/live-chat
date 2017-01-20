/**
 * Created by steven on 2016/12/30.
 */
/**********游客栏切换***********/
$(function(){
    $("#tab_wz li").click(function(){
        $(this).children("a").addClass("hover").parent().siblings().children().removeClass("hover");
        var i=$(this).index();
        $("#tab_img li").show()
    })
});
/**********公告栏切换***********/
$(function(){
    $("#gongg_wz li").click(function(){
        $(this).children("a").addClass("hover").parent().siblings().children().removeClass("hover");
        var i=$(this).index();
        $("#gongg_img li").eq(i).show().siblings().hide();
    })
});
$("#all").height($(document).height());

$(".biaoqing").click(function(){
    $('#expression').toggle('slow')
});


$('.bqMin').on('click','img',function () {
    var content = $('#content');
    var expression = $(this).clone(true);
    content.append(expression);
    content.focus();
});
$('.bqMax').on('click','img',function () {
    var content = $('#content');
    var expression = $(this).clone(true);
    content.append(expression);
    content.focus();
})
$(".hecai").click(function(){
    var content = $('#content');
    var hcHtm = '<img class="contentImg" src="images/live/zanS.gif"><img class="contentImg" src="images/live/xianhua.gif"><img class="contentImg" src="images/live/zhangsheng.gif">';
    content.append(hcHtm);
    content.focus();
});
$(".ww").click(function(){
    var content = $('#content');
    var vHtm = '<img class="contentImg" src="images/live/ww.gif"><img class="contentImg" src="images/live/wg.gif"><img class="contentImg" src="images/live/xhh.gif"><img class="contentImg" src="images/live/gl.gif"><img class="contentImg" src="images/live/xf.gif">';
    content.append(vHtm);
});

/**
 * 个人信息选项
 */
$('.user-detail').click(function() {
    var width = $(this).width();
    $('.dropdown-menu').css('width',width);
    $('.dropdown-menu').css('max-width',width);
    $('.dropdown-menu').css('min-width','0px');
    $('.user-menu').toggle('slow');
})

/**
 * 课程表的展示
 */
$('.course').click(function() {
    $('#mask').show();
    $('#log').show();
});

$('#log').on('click','.close',function() {
    $('#mask').hide();
    $('#log').hide();
})



$('#expression').on('click','.curq',function() {
    $(this).css('background','#0072e3');
    $(this).css('color','white');
    $('#expression').find('.big').css('background','white');
    $('#expression').find('.big').css('color','black');
    $('#expression').find('.bqMin').css('display','block');
    $('#expression').find('.bqMax').css('display','none');
});
$('#expression').on('click','.big',function() {
    $(this).css('background','#0072e3');
    $(this).css('color','white');
    $('#expression').find('.curq').css('background','white');
    $('#expression').find('.curq').css('color','black');
    $('#expression').find('.bqMin').css('display','none');
    $('#expression').find('.bqMax').css('display','block');
});

$("#yyRefresh").click(function(){
    var yySrc = $("#yy").attr("src");
    // yySrc = yySrc+"?re="+Math.random();
    // $("#yy").attr("src",yySrc);
    var embed = '<embed id="yy"  align="middle" allowfullscreen="true" width="100%" height="450px" allowscriptaccess="always" mode="transparent" quality="high" src="'+yySrc+'" type="application/x-shockwave-flash"></embed>';
    $("embed").remove();
    $("#yyP").after(embed);
});

