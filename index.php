<?php
/**
 * Created by PhpStorm.
 * User: mayy
 * Date: 2017/2/28
 * Time: 11:20
 */

// 定义应用目录
define('ROOT_PATH', rtrim(dirname(__FILE__), '/\\'));

define('WWW_PATH', ROOT_PATH . DIRECTORY_SEPARATOR);

define('APP_PATH', ROOT_PATH . '/App/');

define('RUNTIME_PATH','./Runtime/');

define('COMMON_PATH','./Common/');

define('APP_NAME','App');

define('BIND_MODULE','Mall');

//线上关闭
define('APP_DEBUG', true);

//
define('TP_IN', true);
include_once COMMON_PATH . './Conf/const.php';

require './ThinkPHP/ThinkPHP.php';