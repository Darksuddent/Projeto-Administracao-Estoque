<?php
function thumb($foto) {
    $arquivo = "$foto";	
    if (is_null($foto) || !file_exists($arquivo)){
        return "indisponivel.png";
    } else {
        return $arquivo;
    } 
}