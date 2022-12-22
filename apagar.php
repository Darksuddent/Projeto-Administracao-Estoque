<?php
require "connect.php";
        $id = intval($_GET['id']);
        $chave = $_GET['c'];
        $query = "DELETE FROM banco WHERE (`id` = '$id')";
        echo $id;
        if($banco->query($query)){
            header("Location: index.php?c=$chave");
            exit();
        }
        
?>