<?php
$n = isset($argv[1]) ? $argv[1] : 0;
if($n < 2){
  return false;
}
for($w=0;;$w++){
  $s = $w * 10000;
  for($i=2;$i<=$n;$i++){
    $a[$i] = $i;
  }
  for($i=2;$i<=$n;$i++){
    for($j=2;;$j++){
      $d = $i * $j;
      if($d <= $n){
        unset($a[$d]);
      } else {
        break;
      }
    }
  }
  print_r($a);
}