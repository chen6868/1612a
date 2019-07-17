      <?php 
namespace Home\Model;
use Think\Model;
class AdminModel extends Model {
	public function zhen(){
		$name = I('get.name');
		$pwd  = I('get.pwd');
		$re   = $this->where("name='$name' and pwd='$pwd'")->find();
		if ($re) {
			session('user',$re);
			return 1;
		}else{
			return 2;
		}
	}
}

 ?>