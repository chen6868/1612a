<?php
namespace app\goods\controller;

use think\Controller;

class Goods extends Controller
{
    public function index() {
    }

    public function add_show() {
        $category = \think\Db::table('category')->select();

        $this->assign('category',$category);

        return view();
    }

    public function add() {
        $data=[];
        $data['name']=input('post.goods');
        $data['c_id']=input('post.c_id');

        \think\Db::table('goods')->insert($data);

        $this->redirect('check');
    }

    public function check() {
        $goods = \think\Db::table('goods')->select();

        $data = [];
        foreach ($goods as $s){
            $category_name = \think\Db::table('category')->where('id',$s['c_id'])->find();
            $s['c_id'] = $category_name['name'];
            array_push($data,$s);
        }
        $this->assign('goods',$data);
        return view();
    }
}
