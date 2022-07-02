<?php
function Fibonacci ($n){
    $v1=0;$v2=1;
    for($i=0;$i<$n;$i++)
	{	
        if($i<=1){
            $v3=$i;
        }  else  {
            $v3=$v1+$v2;
            $v1=$v2;
            $v2=$v3;
        }

        echo  "$v3 <br>";
    }   
}

Fibonacci (14);
?>