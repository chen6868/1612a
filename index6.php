<?php 

function calFn($n,$m){
    for ($i=$n; $i <=$m ; $i++) { 
    	 @$str.=$i;
         $shu = substr_count($str,"1");
    }
    return $shu;
}

print_r(calFn(1,13));

 ?>