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

class redis_mq extends MsgQueueBase implements MsgQueueImpl {
	
	private $_server = null;
	
	public function __construct($config) {
		parent::__construct($config);
//		$this->_config['prefix'] = $this->_config['prefix'] . ':';
		$this->get_server();
	}
	
	private function get_server() {
		if($this->_server !== null) {
			return $this->_server;
		}
		$this->_server = new \Redis();
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
		if($this->_server === null) {
			return null;
		}
		$key = $this->_config['prefix'] . $key;
		$result = $this->_server->rPop($key);
		return $result ? json_decode($result, true) : null;
	}
	
	/**
	 * 往队列中出入一条消息
	 * @param string $key			队列名
	 * @param mixed $val			消息内容
	 * @param int $flag				是否压缩
	 * @return mixed
	*/
	public function set($key, $val, $flag = 0) {
		if($this->_server === null) {
			return false;
		}
		$key = $this->_config['prefix'] . $key;
//		if(is_array($val) || is_object($val)) {
//			$val = json_encode($val);
//		}
        dump($key);
		$val = json_encode($val);
		return $this->_server->lPush($key, $val);
	}
	
	/**
	 * 删除一个消息队列
	 * @param string $key
	 * @return bool
	*/
	public function delete($key) {
		if($this->_server === null) {
			return false;
		}
		$key = $this->_config['prefix'] . $key;
		return $this->_server->delete($key);
	}
	
	/**
	 * 清空消息队列
	*/
	public function flush() {
		if($this->_server === null) {
			return false;
		}
		return $this->_server->delete();
	}
	
	public function __destruct() {
		if($this->_server != null) {
			$this->_server->close();
		}
	}


	/**
	 * 计算消息队列长度
	 * @author 南极村民 < yinpoo@126.com >
	 * @time   2016-04-07 12:49
	 */
	public function length($key) {
		if($this->_server === null) {
			return false;
		}
		$key = $this->_config['prefix'] . $key;
		return $this->_server->lLen($key);
	}

	/**
	 * @see  返回列表 key 中指定区间内的元素，区间以偏移量 start 和 stop 指定。
	 * @link http://redis.io/commands/lrange
	 * @author 南极村民 < yinpoo@126.com >
	 * @time   2016-04-07 12:49
	 * @param string $key
	 * @param int $start
	 * @param int $end
	 * @return bool
	 */
	public function get_list($key, $start, $end) {
		if($this->_server === null) {
			return false;
		}
		$key = $this->_config['prefix'] . $key;

		return $this->_server->lRange($key, $start, $end);
	}

	
}