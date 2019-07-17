<?php 
namespace Home\Model;
use Think\Model;
class StudentModel extends Model {
     public function sh(){
     	$p = I('get.p',1);
     	$count=$this->count();
     	$size = 6;
     	$last = ceil($count/$size);
     	$page['up']=$p-1>1?$p-1:1;
     	$page['down']=$p+1<$last?$p+1:$last;
     	$data = $this->page($p,$size)->select();
     	$page['last']=$last;
     	$arr['data']=$data;
     	$arr['page']=$page;
     	return $arr;
     }

     public function dian(){
     	$name =I('get.name');
     	$id   =I('get.id');
     	$re   = $this->where("id='$id'")->find();
     	$re['name']=$name;
     	$this->where("id='$id'")->save($re);
     }
     public function dels(){
      $id = I('get.id');
      $this->delete($id);
     }
}
 ?>