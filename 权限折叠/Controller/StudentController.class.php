<?php 
namespace Home\Controller;
use Think\Controller;
class StudentController extends Controller {
         public function __construct(){
         	 parent::__construct();
         	 $power = session('power');
         	 foreach ($power as $key => $value) {
         	 	 if ($value['controller']==CONTROLLER_NAME) {
         	 	 	  $copower=true;
         	 	 }
         	 	 if ($value['action']==ACTION_NAME) {
         	 	 	  $action =true;
         	 	 }
         	     }

         	     if (ACTION_NAME=='page') {
         	     	 $action=true;
         	     }
         	     if (ACTION_NAME=='del') {
         	     	 $action=true;
         	     }
         	     if (ACTION_NAME=='ji') {
         	     	 $action=true;
         	     }

         	     if ((!$action)||(!$copower)) {
         	     	$this->error("你没有权限");
         	     }
         }



	    public function showstudent(){
            $arr = D('student');
            $re  = $arr->sh();
            $this->assign('data',$re['data']);
            $this->assign('page',$re['page']);
            $power = session('power');
            foreach ($power as $key => $value) {
            	if ($value['action']=='updatastudent') {
            		 $updatastudent=true;
            	}
            	if ($value['action']=='delstudent') {
            		$delstudent=true;
            	}
            }
            $this->assign('ji',$updatastudent);
            $this->assign('del',$delstudent);
            $this->display('index');
	    }

	    public function ji(){
	    	$arr = D('student');
	    	$arr->dian();
	    }
	    public function del(){
             $arr = D('student');
	    	 $arr->dels();
	    	 $re  = $arr->sh();
	    	 echo json_encode($re);
	    }

	    public function page(){
	    	 $arr = D('student');
	    	 $re  = $arr->sh();
	    	 echo json_encode($re);
	    }
}
 ?>