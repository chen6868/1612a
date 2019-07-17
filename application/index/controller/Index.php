<?php
namespace app\index\controller;

use think\Controller;

class Index extends Controller
{
    public function index() {
        $data = \think\Db::table('goods')->select();

        $this->assign('data',$data);

        return view();
    }

    //ajax搜索的数据
    public function search(){
        //接收的搜索关键字
        $name = input('post.search');
        //按照条件，搜索所有的符合条件的商品数据
        $data = \think\Db::table('goods')->where('name','like','%'.$name.'%')->select();

        //准备空数组，存放新的数据
        $new_data=[];
        foreach ($data as $sin){
            $category = \think\Db::table('category')->where('id',$sin['c_id'])->find();
            $sin['id'] = $sin['id'];
            $sin['c_id'] = $category['name'];
            $sin['name'] = $sin['name'];

            array_push($new_data,$sin);
        }

        $str ='';
        for($i=0;$i<count($new_data);$i++){
            $str = $str .'<tr>';
            foreach ($new_data[$i] as $val){
                $str = $str .'<td>';
                $str = $str .$val;
                $str = $str .'</td>';
            }
            $str = $str .'</tr>';
        }
        return $str;
    }

    public function check() {
        $code = input('post.code');

        if(!captcha_check($code)){
            //验证失败
            return 'bad';
        }

        return 'ok';
    }

    public function get_code(){
        $code = new \think\Captcha();
        print_r($code);
        $code->entry();
    }
}
