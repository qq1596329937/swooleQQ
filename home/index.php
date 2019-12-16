<!doctype html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>侯同学的聊天室</title>
	<link rel="stylesheet" type="text/css" href="css/normalize.css" />
	<link rel="stylesheet" type="text/css" href="css/default.css">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
	<div class="htmleaf-container">
		<div class="htmleaf-content bgcolor-3">
			<div id="chatbox">
				<div id="friendslist">
			    	<div id="topmenu">
			        	<span class="friends"></span>
<!--			            <span class="chats"></span>-->
<!--			            <span class="history"></span>-->
			        </div>
			        
			        <div id="friends">

			        </div>
			        
			    </div>	
			    
			    <div id="chatview" class="p1">    	
			        <div id="profile">

			            <div id="close">
			                <div class="cy"></div>
			                <div class="cx"></div>
			            </div>

			            <p>Miro Badev</p>
			            <span>miro@badev@gmail.com</span>
			        </div>
			        <div id="chat-messages">
			            
<!--			            <div class="message">-->
<!--			            	<img src="img/1_copy.jpg" />-->
<!--			                <div class="bubble">-->
<!--			                	Really cool stuff!-->
<!--			                    <div class="corner"></div>-->
<!--			                    <span>3 min</span>-->
<!--			                </div>-->
<!--			            </div>-->
<!--			            -->


			        </div>
			    	
			        <div id="sendmessage">
			        	<input type="text" id="send" value="Send message..." />
			            <button id="send"></button>
			        </div>

			    </div>        
			</div>	
		</div>
	</div>
	
	<script src="js/jquery-1.11.0.min.js"></script>
	<script>
        // 监听回车事件
        function listendown(e){
            if(!e) e = window.event;
            if(e.keyCode ==13){
                var sendData=$('#send').val();
                if (!send){
                    alert('请填写内容');
                }
                // 发生消息
                $uid=$("#profile .animate b").text();
                var str="\t\t\t            <div class=\"message right\">\n" +
                    "\t\t\t            \t<img src=\"img/2_copy.jpg\" />\n" +
                    "\t\t\t                <div class=\"bubble\">\n" +
                    "\t\t\t                "+sendData+
                    "\t\t\t                    <div class=\"corner\"></div>\n" +
                    "\t\t\t                    <span></span>\n" +
                    "\t\t\t                </div>\n" +
                    "\t\t\t            </div>";
                $('#chat-messages').append(str);
                send($uid,sendData)
               $('#send').val('');
            }
        }
        // 回车搜索
        $(document).on("keydown",function () {
            listendown(event);
        });

	function init() {
	    var preloadbg = document.createElement('img');
	    preloadbg.src = 'img/timeline1.png';
	    $('#searchfield').focus(function () {
	        if ($(this).val() == 'Search contacts...') {
	            $(this).val('');
	        }
	    });
	    $('#searchfield').focusout(function () {
	        if ($(this).val() == '') {
	            $(this).val('Search contacts...');
	        }
	    });
	    $('#sendmessage input').focus(function () {
	        if ($(this).val() == 'Send message...') {
	            $(this).val('');
	        }
	    });
	    $('#sendmessage input').focusout(function () {
	        if ($(this).val() == '') {
	            $(this).val('Send message...');
	        }
	    });
	    $('.friend').each(function () {
	        $(this).click(function () {
	            var childOffset = $(this).offset();
	            var parentOffset = $(this).parent().parent().offset();
	            var childTop = childOffset.top - parentOffset.top;
	            var clone = $(this).find('img').eq(0).clone();
	            var top = childTop + 12 + 'px';
	            $(clone).css({ 'top': top }).addClass('floatingImg').appendTo('#chatbox');
	            setTimeout(function () {
	                $('#profile p').addClass('animate');
	                $('#profile').addClass('animate');
	            }, 100);
	            setTimeout(function () {
	                $('#chat-messages').addClass('animate');
	                $('.cx, .cy').addClass('s1');
	                setTimeout(function () {
	                    $('.cx, .cy').addClass('s2');
	                }, 100);
	                setTimeout(function () {
	                    $('.cx, .cy').addClass('s3');
	                }, 200);
	            }, 150);
	            $('.floatingImg').animate({
	                'width': '68px',
	                'left': '108px',
	                'top': '20px'
	            }, 200);
	            var name = $(this).find('p strong').html();
	            var email = $(this).find('p span').html();
	            $('#profile p').html(name);
	            $('#profile span').html(email);
	            $('.message').not('.right').find('img').attr('src', $(clone).attr('src'));
	            $('#friendslist').fadeOut();
	            $('#chatview').fadeIn();
	            $('#close').unbind('click').click(function () {
	                $('#chat-messages, #profile, #profile p').removeClass('animate');
	                $('.cx, .cy').removeClass('s1 s2 s3');
	                $('.floatingImg').animate({
	                    'width': '40px',
	                    'top': top,
	                    'left': '12px'
	                }, 200, function () {
	                    $('.floatingImg').remove();
	                });
	                setTimeout(function () {
	                    $('#chatview').fadeOut();
	                    $('#friendslist').fadeIn();
	                }, 50);
	            });

	            // 获取与该用户的历史聊天记录
                setTimeout(function(){
                    var uid=$("#profile .animate b").text();
                    // 请求获取聊天记录
                    send(uid,'',2)
                },300);
	        });
	    });
	}
	</script>
<script>
    var url='ws://cs6.llqsjwd.cn:81';

    socket=new WebSocket(url);

    socket.onopen=function(){log1('登录成功')}

    socket.onmessage=function(msg){receive(msg.data);console.log(msg);}

    socket.onclose=function(){log1('断开连接')}


    // 处理 socket接收到的消息
    function receive(value) {
       var data=$.parseJSON(value)
       switch (data['type']) {
           case 1:
               flags(data['data']);
               break;
           case 2:
               // alert(data['data']['msg'])
              var  str="\t\t\t            <div class=\"message\">\n" +
                   "\t\t\t            \t<img src=\"img/1_copy.jpg\" />\n" +
                   "\t\t\t                <div class=\"bubble\">\n" +
                   "\t\t\t                "+data['data']['msg'] +
                   "\t\t\t                    <div class=\"corner\"></div>\n" +
                   "\t\t\t                    <span></span>\n" +
                   "\t\t\t                </div>\n" +
                   "\t\t\t            </div>\n" +
                   "\t\t\t            ";
               $('#chat-messages').append(str)                                                                                                                                                                                                                                                                                                                                          (str);
               break;
           case 3:
               show_history(data['data']['record'],data['data']['fd']);
               break;
       }
    }
    // 展示历史聊天记录
    function show_history(data,fd) {
        if (data){
            var str='';
            $.each(data,function (i,v) {
                if (fd==v[1]){
                    str+="<div class=\"message right\">\n" +
                        "<img src=\"img/2_copy.jpg\">\n" +
                        "<div class=\"bubble\">\n" +
                        "\t\t\t                "+v[4] +
                        "<div class=\"corner\"></div>\n" +
                        "<span></span>\n" +
                        "</div>\n" +
                        "</div>";
                }else {
                    str+="\t\t\t            <div class=\"message\">\n" +
                        "\t\t\t            \t<img src=\"img/1_copy.jpg\" />\n" +
                        "\t\t\t                <div class=\"bubble\">\n" +
                        "\t\t\t                "+v[4] +
                        "\t\t\t                    <div class=\"corner\"></div>\n" +
                        "\t\t\t                    <span></span>\n" +
                        "\t\t\t                </div>\n" +
                        "\t\t\t            </div>\n" +
                        "\t\t\t            ";
                }

            })
            $('#chat-messages').html(str);
        }
    }
    
    // 渲染用户列表
    function flags(data) {
       if (!data){
           return false
       }
       var str='';
       $.each(data,function (i,v) {
            str+="\t<div class=\"friend\">\n" +
               "\t\t\t            \t<img src=\"img/1_copy.jpg\" />\n" +
               "\t\t\t                <p>\n" +
               "\t\t\t                \t<strong>用户：<b>"+v+"</b></strong>\n" +
               "\t\t\t\t                <span></span>\n" +
               "\t\t\t                </p>\n" +
               "\t\t\t                <div class=\"status available\"></div>\n" +
               "\t\t\t            </div>";
       })
        if(!str){
            str='  <b style="text-align: center;margin-top: 20px">只有你一个人在线哦</b>';
        }
        $('#friends').html(str);
        init()
    }

    function send(uid,msg,type=1){
        var obj={
            uid: uid,
            msg: msg,
            type: type,
        }
        socket.send( JSON.stringify(obj));
    }


    function log(var1){
        var  v=$.parseJSON(var1)
        alert('用户'+v['no']);
    }

    function log1(var1){
        alert(var1);
    }
</script>
</body>
</html>