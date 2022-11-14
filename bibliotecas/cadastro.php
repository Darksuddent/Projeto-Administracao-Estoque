<?php
require_once '../connect.php';
include_once 'funcoes.php';

$nome = $_POST['nome'];
$ean = $_POST['ean'];
$imagem = $_POST['imagem'];
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
$query = "INSERT INTO banco (nome, ean, tipo, ncm, cest, imagem) VALUES ('$nome', '$ean', '$tipo', '$ncm', '$cest', '$imagem')";
if($nome==null || $ean == null){
    echo "<script>alert('Variáveis não podem ser vazias.')</script>";
}else{
    if($banco->query($query) === TRUE){
        echo "<script>alert(Registro feito com sucesso)</script>";
    }
    else{
        echo "<script>alert(Error: ".$sql."<br>".$banco->error.")</script>";
    }
}
header('Location: ../index.php');
exit();
?>