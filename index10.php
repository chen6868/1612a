<?php 
$array = [2,4,3,6,3,2,5,5];

function get($array){
   $arr = array_count_values($array);
   print_r($arr);
   foreach ($arr as $key => $value) {
   	   if ($value == 1) {
   	   	echo "$key";
   	   }
   }
}
print_r(get($array));
 ?>