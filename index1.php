<?php 

$arr = [3,32,321];

function get($arr){
   for ($i=0; $i <count($arr) ; $i++) { 
     for ($j=0; $j <count($arr) ; $j++) { 
     	for ($k=0; $k <count($arr) ; $k++) { 
     		if ($arr[$i] != $arr[$j] && $arr[$j] != $arr[$k] && $arr[$k] != $arr[$i]) {
     			$array[] = $arr[$i].$arr[$j].$arr[$k]; 
     			sort($array);
     		}
     	}
     }
   }
   return $array[0];
}
print_r(get($arr));

 ?>