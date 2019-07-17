<?php
namespace app\goods\controller;

use think\Controller;

class Sku extends Controller
{
    public function index() {
        $this->assign('name','ThinkPHP');
        return $this->fetch('index');
    }

    public function add_show() {

        $data = \think\Db::table('goods')->select();
        $this->assign('goods',$data);
        return view();
    }

    public function add() {
        $data =[];
        $data['name'] = input('post.goods');
        $data['path'] = 0;
        $data['g_id'] = input('post.g_id');
        \think\Db::table('sku')->insert($data);

//        $this->redirect('goods/sku/check');
    }
}
