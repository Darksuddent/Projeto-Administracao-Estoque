<?php
//Aguarde
function WaitForSec($sec){
    $i = 1;
    $last_time = $_SERVER['REQUEST_TIME'];
    while($i > 0){
        $total = $_SERVER['REQUEST_TIME'] - $last_time;
        if($total >= 2){
            return 1;
            $i = -1;
        }
    }
}