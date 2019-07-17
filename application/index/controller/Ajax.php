<?php
namespace app\index\controller;

use think\Controller;

class Ajax extends Controller
{
    public function index() {
        $data = \think\Db::table('goods')->select();
        $this->assign('data',$data);
        return view('index/index');
    }

    //ajax搜索的数据
    public function search(){
        //接收的搜索关键字
        $name = input('post.search');
        $page = input('post.page');

        $curent = $page*2;

        //按照条件，搜索所有的符合条件的商品数据
        $data = \think\Db::table('goods')->where('name','like','%'.$name.'%')->limit($curent,2)->select();

        $new_data = [];
        //根据商品的分类id去商品分类表里找对应的商品分类名称
        foreach ($data as $goods){
            $goods['c_id'] = \think\Db::table('category')->where('id',$goods['c_id'])->column('name');
            //$goods['c_id'] = (string)$goods['c_id'];
            array_push($new_data,$goods);
        }

        //拼接返回的整串字符串
        $str ='';
        foreach ($new_data as $sin){
            $str.='<tr>';
            $str.='<td>';
            $str.=$sin['c_id'][0];
            $str.='</td>';

            $str.='<td>';
            $str.=$sin['name'];
            $str.='</td>';
            $str.='</tr>';
        }
        //返回字符串
        if($str)return $str;
        return 'empty';
    }

    public function check() {
        $code = input('post.code');
        if(!captcha_check($code)){
            //验证失败
            return 'bad';
        }
        return 'ok';
    }
}
