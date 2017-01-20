/**
 * Created by steven on 2017/1/5.
 */
$(document).ready(function(){
    connect();
    FormSliderSwitcher.init();
});
if (typeof console == "undefined") {    this.console = { log: function (msg) {  } };}
// 如果浏览器不支持websocket，会使用这个flash自动模拟websocket协议，此过程对开发者透明
WEB_SOCKET_SWF_LOCATION = "/swf/WebSocketMain.swf";
// 开启flash的websocket debug
WEB_SOCKET_DEBUG = true;
var ws, name, client_list={};

// 连接服务端
function connect() {
    // 创建websocket
    ws = new WebSocket("ws://"+document.domain+":7272");
    // 当socket连接打开时，输入用户名
    ws.onopen = onopen;
    // 当有消息时根据消息类型显示不同信息
    ws.onmessage = onmessage;
    ws.onclose = function() {
        // console.log("连接关闭，定时重连");
        connect();
    };
    ws.onerror = function() {
        // console.log("出现错误");
    };
}

// 连接建立时发送登录信息
function onopen()
{
    var data = '{"type":"login","client_name":"'+UserName+'","room_id":"'+roomId+'","roleImg":"'+roleImg+'","role":"'+role+'"}';
    //console.log("websocket握手成功，发送登录数据:"+login_data);
    ws.send(data);
}



/**
 * 服务端发来消息时
 * @param e
 */
function onmessage(e)
{

    var data = eval("("+e.data+")");
    switch(data['type']){
        // 服务端ping客户端
        case 'ping':
            ws.send('{"type":"pong"}');
            break;
        // 禁言(实时禁言)
        case 'shutup':

                if(data['shutup'] == 1){
                    $('#chatSub').attr('data-shut-up',data['shutup'])
                }
            break;
        case 'getout':
            if(data['getout'] == 1){
                alert('你已经被踢出直播间');
                location.href = close_url;
                return false;
            }
            break;
        // 登录
        case 'login':
            say(data['client_id'], data['client_name'],  data['client_name']+' 加入了聊天室', data['time'],data['role'],data['role_grade']);

            if(data['client_list'])
            {

                client_list = data['client_list'];
            }
            else
            {
                client_list[data['client_id']] = new Object();
                client_list[data['client_id']]['client_name'] = data['client_name'];
                client_list[data['client_id']]['role'] = data['role'];
                client_list[data['client_id']]['role_grade'] = data['role_grade'];
            }

            flush_client_list();
            break;

        // 发言
        case 'say':

            say(data['from_client_id'], data['from_client_name'], data['content'], data['time'],data['role'],data['role_grade']);
            break;

        // 用户退出 更新用户列表
        case 'logout':
            delete client_list[data['from_client_id']];
    }
}

/**
 *   禁止发言(socket+数据库双向禁言)
 *   实时禁言
 */
$('.thumbnail').on('click','.shut-up',function() {
    var username = $(this).text();
    var from_client_id = $(this).attr('data-from-client-id');
    var user_role = rol;
    var role_grade = $(this).attr('data-role-grade');

    if(user_role == '10' && role_grade != 10 && role_grade != -1){
        $('#setting').find('.btn-primary').attr('data-username',username);
        $('#setting').find('.btn-primary').attr('data-from-client-id',from_client_id);
        $('#setting').modal('show');

        return false;
    }
    return false;
})

$('#setting').on('click','.btn-primary',function () {

    var username = $(this).attr('data-username');
    var from_client_id = $(this).attr('data-from-client-id');
    var dom = $('#setting');
    var shut_up = dom.find('.shut-up').siblings('span').children().css('left');
    var get_out = dom.find('.get-out').siblings('span').children().css('left');
    if (shut_up == '20px' && get_out == '0px') {
        $.ajax({
            url: setUserStatus,
            method: 'POST',
            dataType: "json",
            data: {username: username},
            success: function (resp) {
                if (resp.err_code != 2) {
                    var data = '{"type":"shutup","client_name":"' + UserName + '","from_client_id":"' + from_client_id + '","room_id":"' + roomId + '"}';
                    ws.send(data);
                    alert(resp.err_msg);
                    $('#setting').find('.btn-default').trigger('click');
                }
                return false;
            },
            error: function (error) {
                console.log(error);
            }
        })
    } else if (shut_up == '0px' && get_out == '20px') {
        $.ajax({
            url: setUserIp,
            method: 'POST',
            dataType: "json",
            data: {username: username},
            success: function (resp) {
                if (resp.err_code != 2) {
                    var data = '{"type":"getout","client_name":"' + UserName + '","from_client_id":"' + from_client_id + '","room_id":"' + roomId + '"}';
                    ws.send(data);
                    alert(resp.err_msg);
                    $('#setting').find('.btn-default').trigger('click');
                }
                return false;
            },
            error: function (error) {
                console.log(error);
            }
        })
    }else if(shut_up == '20px' && get_out == '20px'){
        $.ajax({
            url: setUser,
            method: 'POST',
            dataType: "json",
            data: {username: username},
            success: function (resp) {
                if (resp.err_code != 2) {
                    var data = '{"type":"getout","client_name":"' + UserName + '","from_client_id":"' + from_client_id + '","room_id":"' + roomId + '"}';
                    ws.send(data);
                    alert(resp.err_msg);
                    $('#setting').find('.btn-default').trigger('click');
                }
                return false;
            },
            error: function (error) {
                console.log(error);
            }
        })
    }else{
        return false;
    }

})

/**
 * 发送信息
 */
$('#send-message').on('click','#chatSub',function() {
    var status = statu;
    var chat_status = chatStatus;
    var shut_up_status = $(this).attr('data-shut-up');
    if(status == false){
        alert('请先登录');
        return false;
    }
    var input = $('#content');
    var content = input.html().replace(/\"/g,"'");
    if(content.length <= 0){
        alert('请输入聊天内容');
        return false;
    }

    if(chat_status == 10 || shut_up_status == 1){
        alert('您已被禁言,请联系管理员解封');
        return false;
    }

    var to_client_id = 'all';
    var to_client_name = '所有人';

    ws.send('{"type":"say","to_client_id":"'+to_client_id+'","to_client_name":"'+to_client_name+'","content":"'+content+'"}');
    input.text("");
    $('#expression').hide();
    input.focus();
})

$('#send-message').on('keydown','#content',function (e) {
    if(e.keyCode == 13){
        $('#send-message').find('#chatSub').trigger('click');
    }
})

/**
 * 刷新用户在线列表框
 */
function flush_client_list(){
    var userlist_window = $("#onlineUser");
    var memberlist_window = $("#member-list");
    var guestlist_window = $("#guest-list");
    var client_list_slelect = $("#client_list");
    var i= 0;
    userlist_window.empty();
    memberlist_window.empty();
    guestlist_window.empty();
    client_list_slelect.empty();

    for(var p in client_list){
        i++;
        var html = '<a data-role-grade="'+client_list[p].role_grade+'"><dl id="tab_img_l" class="clearfix"><dd class="f1 pull-left"><img style="height:25px;width:25px;" src="images/live/'+client_list[p]['role']+'">&nbsp;&nbsp;<em>'+client_list[p]['client_name']+'</em></dd></dl></a>';

        //巡管
        if(client_list[p].role_grade == '10'){
            userlist_window.append(html);
        }
        //游客
        else if(client_list[p].role_grade == '-1'){
            guestlist_window.prepend(html);
        }
        //会员
        else{
            memberlist_window.prepend(html);
        }

    }
    $('.all-live-count').text(232+i);
}

/**
 * 实时获取发言信息
 * @param from_client_id
 * @param from_client_name
 * @param content
 * @param time
 * @param role
 * @param role_grade
 */
function say(from_client_id, from_client_name, content, time,role,role_grade){
    var reg1 = new RegExp("<div>","g")
    var reg2 = new RegExp("</div>","g")
    var html1 = content.replace(reg1,"<br/>");
    var html2 = html1.replace(reg2,'');
    var style =role_grade==10?'style="color:red;max-width:320px;font-size:16px"':'max-width:320px;';
    var html = '<div class="speech_item"><div><span name="919" class="tm">['+time+']</span><img style="width:35px;height:35px" src="images/live/'+role+'" class="user_icon" /> <span usertype="0" name="74" class="userId"><span usertype="0" name="74" class="userId shut-up" data-role-grade="'+role_grade+'" data-from-client-id="'+from_client_id+'">'+from_client_name+'</span></div>'+'<div style="clear:both;"></div><p class="triangle-isosceles top" style="width:340px"><span class="content pull-left" '+style+'>'+html2+'<div style="clear:both;"></div></span></p> </div>';
    $("#back").append(html);
    $('#back').scrollTop(1000000);
}

$(function(){
    select_client_id = 'all';
    $("#client_list").change(function(){
        select_client_id = $("#client_list option:selected").attr("value");
    });
});

