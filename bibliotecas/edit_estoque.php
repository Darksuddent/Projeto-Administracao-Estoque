<?php
require_once "../connect.php";

$id = $_GET['ean'];
$chave = $_GET['c'];
$add = $_GET['add'];
$sub = $_GET['sub'];

$query_mais_antigo = "SELECT id, estoque FROM banco WHERE id = $id ORDER BY emissao ASC limit 1";
$res = $banco->query($query_mais_antigo);
$obj = $res->fetch_object();

$id = $obj->id; 
$e = $obj->estoque;


if($e == null){
    $e = 0;
}

if($add == 1 && $sub == 0){
    $e += 1;
}else if($add == 0 && $sub == 1){
    $e--;
    if($e < 0){
        $e++;
    }
}
    $query = "UPDATE banco SET estoque = '$e' WHERE id='$id'";
    $banco->query($query);
    
header("Location: ../produtos.php?c=$chave");
exit();
