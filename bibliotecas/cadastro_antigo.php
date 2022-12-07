<?php
require_once '../connect.php';
include_once 'funcoes.php';

$nome = $_POST['nome'];
$ean = $_POST['ean'];
$imagem = thumb($_POST['imagem']);
$new_imagem = thumb($imagem);
$tipo = $_POST['tipo'];
switch($tipo){
    case "Teste 1":
        $ncm=0;
        $cest=0;
        break;
    case "2 Teste":
        $ncm=1;
        $cest=0;
        break;
    case "Test 3":
        $ncm=0;
        $cest=1;
}
$query = "INSERT INTO banco (nome, ean, tipo, ncm, cest, imagem) VALUES ('$nome', '$ean', '$tipo', '$ncm', '$cest', '$new_imagem')";
if($nome==null || $ean == null){
    echo "<script>alert('O nome ou o Ean devem estar preenchidos')</script>";
}else{
    if($banco->query($query)){
        header('Location: ../index.php');
        exit();
    }
    else{
        echo "<script>alert(Error: ".$sql."<br>".$banco->error.")</script>";
    }
}
?>