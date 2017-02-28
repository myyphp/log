<?php
// +----------------------------------------------------------------------
// | TOPThink [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2011 http://topthink.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

namespace Think\Log\Driver;

use Common\Com\MsgQueue\MsgQueueFactory;
use Think\Exception;

class Async {

    protected $config  =   array(
        'log_time_format'   =>  ' c '
    );

    protected $msg_queue_key = '';

    // 实例化并传入参数
    public function __construct($config=array()){
        $this->config        =   array_merge($this->config,$config);
        $this->msg_queue_key = MQ_QUEUE_SYSTEM_LOG;
    }

    /**
     * 日志写入接口
     *
     * @access public
     * @param string $log 日志信息
     * @param string $destination  写入目标
     * @return void
     */
    public function write($log,$destination='') {

        $post = array(
            'env'               => C('ENV'),
            'root_path'         => ROOT_PATH,
            'app'               => APP_NAME,
            'module'            => MODULE_NAME,
            'controller'        => CONTROLLER_NAME,
            'action'            => ACTION_NAME,
            'date'              => time(),
            'ip'                => get_client_ip(0, true),
            'server_ip'         => $this->get_server_ip(),
            'request_uri'       => $_SERVER['REQUEST_URI'],
            'request_get_paras' => urlencode($this->_params2str(I('get.'))),
            'request_post_paras'=> urlencode($this->_params2str(I('post.'))),
            'logs'              => urlencode($log),
        );


        $host    = C('redis_host');
        $port    = C('redis_port');
        $prefix  = C('redis_prefix');
        $type    = C('redis_type');

        $config['config'] = array(
            'host'      => $host,
            'port'      => $port,
            'prefix'    => $prefix
        );

        $msg_queue = MsgQueueFactory::getInstance($type, $config);
        $msg_queue->set(MQ_QUEUE_SYSTEM_LOG, $post);
    }

    private function _params2str($req) {
        $str = '';
        foreach ($req as $key => $val) {
            if(stripos($key, 'pwd') !== false || stripos($key, 'password') !== false || stripos($key, 'token') !== false || stripos($key, 'auth') !== false) {
                $val = '***';
            }

            if(is_array($val)) {
                $val = json_encode($val);
            }

            $str .= ($str ? '&' : '') . $key . '=' . $val;
        }
        return $str;
    }

    /**
     * 获取服务器端IP地址
     * @return string
     */
    private function get_server_ip() {
        if (isset($_SERVER)) {
            if($_SERVER['SERVER_ADDR']) {
                $server_ip = $_SERVER['SERVER_ADDR'];
            } else {
                $server_ip = $_SERVER['LOCAL_ADDR'];
            }
        } else {
            $server_ip = getenv('SERVER_ADDR');
        }
        return $server_ip;
    }
}
