<?php
/**
 * 消息队列接口
 * @copyright	    2013 — 2015
 * @author				c.k xiao <jihaoju@qq.com>
 * @date				2015-3-27
 */
namespace Common\Com\MsgQueue;

interface MsgQueueImpl {

	/**
	 * 从队列中去一条消息
	 * @param string $key			队列名
	 * @return bool
	 */
	public function get($key);
	
	/**
	 * 往队列中出入一条消息
	 * @param string $key			队列名
	 * @param mixed $val			消息内容
	 * @param int $flag				是否压缩
	 * @return mixed
	 */
	public function set($key, $val, $flag = 0);
	
	/**
	 * 删除一个消息队列
	 * @param unknown $key
	 */
	public function delete($key);
	
	/**
	 * 清空消息队列
	 */
	public function flush();
	
}