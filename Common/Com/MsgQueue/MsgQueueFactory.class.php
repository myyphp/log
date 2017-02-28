<?php
/**
 * 消息队列工厂类
 * @copyright	    2013 — 2015
 * @author				c.k xiao <jihaoju@qq.com>
 * @date				2015-3-27
 */
namespace Common\Com\MsgQueue;

define('MSG_QUEUE_ROOT', dirname(__FILE__));

class MsgQueueFactory {

	/**
	 * 获取一个消息队列对象
	 *
	 * @return MsgQueueImpl
	 */
	public static function getInstance($type = '', array $config = array()) {
		static $return = null;
		if($return instanceof MsgQueueImpl) {
			return $return;
		}
		if (empty($config)) {
            $host    = C('redis_host');
            $port    = C('redis_port');
            $prefix  = C('redis_prefix');
            $type    = C('redis_type');
            $config['config'] = array(
                'host'      => $host,
                'port'      => $port,
                'prefix'    => $prefix
            );
        }

		$type = empty($type) ? $config['type'] : $type;
		require_once (MSG_QUEUE_ROOT . '/interface/' . $type . '.class.php');

		$mq = new $type($config['config']);
		if(!$mq instanceof MsgQueueImpl) {
			monitor_record('mall_queue', 'mall_queue_error', '商城消息队列读写失败。');
			throw_exception('message_queue_interface_invalid');
		}
		return $mq;
	}

}