<?php
require_once "../connect.php";

$add = $_GET['add'];
$sub = $_GET['sub'];
$id = $_GET['id'];
$e = $_GET['e'];

if($e == null){
    $e = 0;
}

if($add == 1 && $sub == 0){
    $e += 1;
}else if($add == 0 && $sub == 1){
    $e--;
}

$query = "UPDATE banco SET estoque = '$e' WHERE id='$id'";

if($banco->query($query)){
    header("Location: ../index.php");
    exit();
}
