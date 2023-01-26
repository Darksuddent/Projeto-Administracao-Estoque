<?php
require_once "../connect.php";

$id = $_GET['ean'];
$chave = $_GET['c'];
$add = $_GET['add'];
$sub = $_GET['sub'];
$num_kit = $_GET['num'];
$pag = $_GET['p'];
if($num_kit){
    $query_produtos_kit = "SELECT estoque FROM banco WHERE numero_kit = $num_kit";
    $kits = $banco->query($query_produtos_kit);
}
if($pag == 'kits'){
    $query_mais_antigo = "SELECT id, estoque FROM kits WHERE id = $id limit 1";
}else{
    $query_mais_antigo = "SELECT id, estoque FROM banco WHERE id = $id ORDER BY emissao ASC limit 1";
}

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
    if($pag == 'produtos'){
        if(is_null($num_kit) || empty($num_kit)){
            if($add == 1 && $sub == 0){
                $query = "UPDATE banco SET estoque = estoque+1 WHERE id='$id'";
            }else if($add == 0 && $sub == 1){
                $query = "UPDATE banco SET estoque = estoque-1 WHERE id='$id'";   
            }
            $banco->query($query);
        }
        else{
            if($add == 1 && $sub == 0){
                $query = "UPDATE banco SET estoque = estoque+1 WHERE id='$id'";
            }else if($add == 0 && $sub == 1){
                $query = "UPDATE banco SET estoque = estoque-1 WHERE id='$id'";   
            }
            $banco->query($query);
            $kits = $banco->query($query_produtos_kit);
            $i=0;
            while($produtos = $kits->fetch_object()){
                $prods[$i] = $produtos->estoque;
                $i++;
            }
            $estoque = min($prods);

            $query2 = "UPDATE kits SET estoque = $estoque WHERE numero like $num_kit";
            $banco->query($query2);
            
        }
    }else if(!is_null($num_kit) || !empty($num_kit) && $pag == 'kits'){
        if($add == 1 && $sub == 0){
            $query = "UPDATE banco SET estoque = estoque+1 WHERE numero_kit = '$num_kit'";
        }else if($add == 0 && $sub == 1){
            $query = "UPDATE banco SET estoque = estoque-1 WHERE numero_kit = '$num_kit'";   
        }
        $banco->query($query);
        
        $kits = $banco->query($query_produtos_kit);
        $i=0;
        while($produtos = $kits->fetch_object()){
            $prods[$i] = $produtos->estoque;
            $i++;
        }
        
        $estoque = min($prods);
        $query2 = "UPDATE kits SET estoque = $estoque WHERE numero like $num_kit";
        $banco->query($query2);
        
    }
       
header("Location: ../$pag.php?c=$chave");
exit();
