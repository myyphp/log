<?php
/**
 * Created by PhpStorm.
 * User: Carisok
 * Date: 2017/2/22
 * Time: 11:42
 */

namespace Common\Logic;

class GoodsLogic extends BaseLogic {

    public function get_info()
    {
        return D('Stock')->info();
    }
}