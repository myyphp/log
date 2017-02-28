<?php
/**
 * memecacheq接口
 * @copyright	    2013 — 2015
 * @author				c.k xiao <jihaoju@qq.com>
 * @date				2015-3-27
 */
use Common\Com\MsgQueue\MsgQueueBase;
use Think\Log;
use Common\Com\MsgQueue\MsgQueueImpl;

class memecacheq extends MsgQueueBase implements MsgQueueImpl {
	
	private $_server = null;
	
	public function __construct($config) {
		parent::__construct($config);
		$this->get_server();
	}
	
	private function get_server() {
		$this->_server = new \Memcache();
		$result = $this->_server->connect($this->_config['host'], $this->_config['port']);
		if(!$result) {
			// throw new \Exception("memecacheq connected failed.");
			//Log::record('memecacheq connected failed.');
			return $this->_server = null;
		}
		return $this->_server;
	}
	
	/**
	 * 从队列中去一条消息
	 * @param string $key			队列名
	 * @return bool
	 */
	public function get($key) {
		$key = $this->_config['prefix'] . $key;
		return $this->_server->get($key);
	}
	
	/**
	 * 往队列中出入一条消息
	 * @param string $key			队列名
	 * @param mixed $val			消息内容
	 * @param int $flag				是否压缩
	 * @return mixed
	*/
	public function set($key, $val, $flag = 0) {
		$key = $this->_config['prefix'] . $key;
		$result = $this->_server->set($key, $val, $flag, 0);
		return $result;
	}
	
	/**
	 * 删除一个消息队列
	 * @param string $key
	 * @return bool
	*/
	public function delete($key) {
		$key = $this->_config['prefix'] . $key;
		return $this->_server->delete($key);
	}
	
	/**
	 * 清空消息队列
	*/
	public function flush() {
		return $this->_server->flush();
	}
	
	public function __destruct() {
		if($this->_server != null) {
			$this->_server->close();
		}
	}
	
}