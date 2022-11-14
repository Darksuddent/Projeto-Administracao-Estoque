<?php
require_once "../connect.php";

$nome = $_POST['nome'];
$ean = $_POST['ean'];
$imagem = $_POST['imagem'];
$tipo = $_POST['tipo'];
$custo = $_POST['custo'];
$estoque = $_POST['estoque'];
$validade = $_POST['validade'];
$ncm = $_POST['ncm'];
$cest = $_POST['cest'];

$query = "UPDATE `teste`.`banco` SET nome = '$nome', ean = '$ean', tipo = '$tipo', ncm = '$ncm', cest = '$cest', estoque = '$estoque', validade = '$validade', custo = '$custo' WHERE (`nome` = '$nome');";
if($nome==null || $ean == null){
    echo "<script>alert('Variáveis não podem ser vazias.')</script>";
}else{
    if($banco->query($query) === TRUE){
        echo "<script>alert(Alteração feita com sucesso)</script>";
    }
    else{
        echo "<script>alert(Error: ".$sql."<br>".$banco->error.")</script>";
    }
}
header('Location: ../index.php');
exit();
?>