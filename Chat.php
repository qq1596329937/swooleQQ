<?php
include 'Db.php';

class Chat
{
    const HOST = '0.0.0.0';//ip地址 0.0.0.0代表接受所有ip的访问
    const PART = 81;//端口号
    private $server = null;//单例存放websocket_server对象
    public $fds=[];
    private $db;


    public function __construct()
    {
        $this->db = new Db();
        //实例化swoole_websocket_server并存储在我们Chat类中的属性上，达到单例的设计
        $this->server = new swoole_websocket_server(self::HOST, self::PART);
        //监听连接事件
        $this->server->on('open', [$this, 'onOpen']);
        //监听接收消息事件
        $this->server->on('message', [$this, 'onMessage']);
        //监听关闭事件
        $this->server->on('close', [$this, 'onClose']);
        //设置允许访问静态文件
        $this->server->set([
//            'document_root' => '/grx/swoole/public',//这里传入静态文件的目录
            'enable_static_handler' => true//允许访问静态文件
        ]);
        //开启服务
        $this->server->start();
    }


    /**
     * 连接成功回调函数
     * @param $server
     * @param $request
     */
    public function onOpen($server, $request)
    {
        echo '用户'. $request->fd . '连接了' . PHP_EOL;//打印到我们终端
        $this->fds=[];
        foreach ($server->connections as $fd) {//遍历TCP连接迭代器，拿到每个在线的客户端id
            $this->fds[$fd]=$fd;
        }
        //将所有用户的信息(不包括自己)，推送给所有用户
        foreach ($server->connections as $fd) {//遍历TCP连接迭代器，拿到每个在线的客户端id
            $fds=$this->fds;
            unset($fds[$fd]);
            $this->pushData($server,1,$fd,$fds);
        }
    }

    /**
     * 接收到信息的回调函数
     * @param $server
     * @param $frame
     */
    public function onMessage($server, $frame)
    {
        $data=json_decode($frame->data);


        if ($data->type==1){
            echo '用户'.$frame->fd . '来了，说：' . $frame->data . PHP_EOL;//打印到我们终端
            $data=json_decode($frame->data);
            $this->pushData($server,2,$data->uid,['msg'=>$data->msg]);

//            接收到的消息插入到数据库
            $this->db->table('record')->insert([
                'send_id'=>$frame->fd,
                'receiver_id'=>$data->uid,
                'time'=>time(),
                'msg'=>$data->msg,
            ]);
        }elseif ($data->type==2){
            $record=$this->db->table('record')
                ->where("send_id in ($frame->fd,$data->uid) and receiver_id in ($frame->fd,$data->uid)")
                ->order('time')
                ->select();
            $this->pushData($server,3,$frame->fd,['record'=>$record,'fd'=>$frame->fd,'uid'=>$data->uid]);
        }

    }

    /**
     * 断开连接回调函数
     * @param $server
     * @param $fd
     */
    public function onClose($server, $fd)
    {
        echo '用户'. $fd . '走了' . PHP_EOL;//打印到我们终端
        $this->fds=[];
        foreach ($server->connections as $fd) {//遍历TCP连接迭代器，拿到每个在线的客户端id
            $this->fds[$fd]=$fd;
        }
        //将所有用户的信息(不包括自己)，推送给所有用户
        foreach ($server->connections as $fd) {//遍历TCP连接迭代器，拿到每个在线的客户端id
            $fds=$this->fds;
            unset($fds[$fd]);
            $this->pushData($server,1,$fd,$fds);
        }
    }


    /**
     * @param $server
     * @param $type 消息类型  1=用户登录、用户退出  2=用户发送消息   3=获取历史聊天记录
     * @param $fd  接收者
     * @param $data
     */
    public function pushData($server,$type,$fd,$data){
        $server->push($fd, json_encode(['type' => $type, 'data' => $data]));
    }
}

$obj = new Chat();