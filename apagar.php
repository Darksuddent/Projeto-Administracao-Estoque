<?php
require "connect.php";
        $id = intval($_GET['id']);
        $query = "SELECT ean, chave FROM banco where id = $id";
        $c = $banco->query($query)->fetch_object()->chave;
        $ean = $banco->query($query)->fetch_object()->ean;
        $chave = $_GET['c'];
        $query = "DELETE FROM banco WHERE (`id` = '$id')";
        echo $id;
        if($banco->query($query)){
            header("Location: produtos.php?c=$chave");
            exit();
        }
        
?>