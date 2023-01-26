<?php
require "connect.php";
        $id = intval($_GET['id']);
        $query = "SELECT ean, chave FROM banco where id = $id";
        $c = $banco->query($query)->fetch_object()->chave;
        $ean = $banco->query($query)->fetch_object()->ean;
        $chave = $_GET['c'];
        $num = $_GET['num'] ?? null;
        if(!is_null($num) || !empty($num)){
            $query = "DELETE FROM kits WHERE (`numero` = '$num')";
            $query2 = "UPDATE banco SET numero_kit = null WHERE numero_kit = $num";
            $banco->query($query2);
        }else{
            $query = "DELETE FROM banco WHERE (`id` = '$id')";
        }
        if($banco->query($query)){
            if(is_null($num) || empty($num)){
                header("Location: produtos.php?c=$chave");
            }else{
                header("Location: kits.php?c=$chave");
            }
            exit();
        }
?>