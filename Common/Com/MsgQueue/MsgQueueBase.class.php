<?php
/**
 * 消息队列接口
 * @copyright	    2013 — 2015
 * @author				c.k xiao <jihaoju@qq.com>
 * @date				2015-3-27
 */
namespace Common\Com\MsgQueue;

class MsgQueueBase{

	protected $_config;
	protected $_error = ''; // 错误信息
	
	public function __construct($config) {
		$this->_config = $config;
	}
	
	public function get_error() {
		return $this->_error;
	}
}