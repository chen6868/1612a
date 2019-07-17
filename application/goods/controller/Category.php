<?php
namespace app\goods\controller;

use think\Controller;

class Category extends Controller
{
    public function index() {
        die('分类默认方法');
    }

    public function check() {
        $data = \think\Db::table('category')->select();

        $this->assign('data',$data);
        return view('check');
    }

    public function add_show() {
        return view();
    }

    public function add() {
        $data =[];
        $data['name'] = input('post.name');
        $data['path'] = 0;

        \think\Db::table('category')->insert($data);

        $this->redirect('goods/category/check');
    }
}
