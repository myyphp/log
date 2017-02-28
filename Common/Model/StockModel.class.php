<?php
/**
 * Created by PhpStorm.
 * User: Carisok
 * Date: 2017/2/22
 * Time: 14:20
 */

namespace Common\Model;
use Think\Model;

class StockModel extends  Model{
    public function info() {
        return $this->find(array('goods_id' => 1));
    }
}