# live-chat

代码框架为yii2，内嵌YY直播，以workman-chat为socket服务器，
客户端采用socket.io来进行聊天室的即时通讯聊天
####1.socket服务器用的是workman框架的workman-chat,
wokerman的composer下载地址:

composer require workerman/gateway-worker


####2.开启端口监听
运用命令启动监听:

php start.php start -d


