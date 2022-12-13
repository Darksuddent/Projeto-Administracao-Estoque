<?php
require "connect.php";

    $id = $_GET['id'];
    $query = "DELETE FROM banco WHERE (`id` = '$id')";
    if($banco->query($query)){
        "Sucesso";
    }
    header("Location:index.php");
    exit();
?>


  