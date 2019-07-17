<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->display();
    }

    public function yan(){
    	$arr = D('admin');
    	$re  = $arr->zhen();
    	echo $re;
    }
}