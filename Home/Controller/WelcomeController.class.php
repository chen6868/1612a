<?php 
namespace Home\Controller;
use Think\Controller;
class WelcomeController extends Controller {
      public function index(){
      	  $user = session('user');
      	  $userid=$user['id'];
      	  $sql  = "select * from power where powerid in(select pid from rolepower where rid in(select roleid from adminrole where userid=$userid))";
      	  $data = D('power');
      	  $power=$data->query($sql);
      	  $po   =$this->getTree($power);
      	  session('power',$po);
      	  $this->assign('data',$po);
      	  $this->display();
      }

      public function getTree($power,$leve1=1,$pid=0){
      	  static $arr =array();
      	  foreach ($power as $key => $value) {
      	  	  if ($value['pid']==$pid) {
      	  	  	  $value['leve1']=$leve1;
      	  	  	  $arr[]=$value;
      	  	  	  $this->getTree($power,$leve1+1,$value['powerid']);
      	  	  }
      	  }
      	  return $arr;
      }
}
 ?> 