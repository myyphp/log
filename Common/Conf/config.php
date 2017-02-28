<?php
return array(
	//'配置项'=>'配置值'
    'LOAD_EXT_CONFIG'       => 'db,redis',
    //注册根命名空间
    'AUTOLOAD_NAMESPACE'    => array(
        'Common' => WWW_PATH . '/Common',
    ),
    /* 日志设置 */
    'LOG_RECORD'            => true,                                // 默认不记录日志
    'LOG_TYPE'              => 'async',                              // 日志记录类型 默认为文件方式
    'LOG_LEVEL'             => 'EMERG,ALERT,CRIT,ERR,WARN,INFO,SQL',// 允许记录的日志级别
    'LOG_FILE_SIZE'         => 2097152,                             // 日志文件大小限制
    
);

