<?php
namespace Mall\Controller;
use Think\Controller;

class IndexController extends Controller {

    public function index(){
        \Think\Log::record('fafa');
        $stock_model = logic('Goods');
        $res = $stock_model->get_info();
        var_dump($res);
    }
}