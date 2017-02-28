<?php
return array(
    'redis_host'   => '127.0.0.1',         //消息队列服务器ip
    'redis_prot'   => '6397',              //消息队列服务器端口
    'redis_prefix' => 'mq_log_',           //消息队列前缀
    'redis_type'   => 'redis_mq',          //消息队列类型，类名
);

