<?php
require_once "../connect.php";
$chave = $_POST['c'];
$id = $_POST['id'] ?? null;
$nome = $_POST['nome'] ?? null ;
$ean = $_POST['ean'] ?? null;
$tipo = $_POST['tipo'] ?? null;
$custo = $_POST['custo'] ?? null;
$estoque = $_POST['estoque'] ?? null;
$validade = $_POST['validade'] ?? null;
$ncm = $_POST['ncm'] ?? null;
$cest = $_POST['cest'] ?? null;
$emissao = $_POST['emissao'] ?? null;

if(empty($nome) || empty($ean)){
    echo "<script>alert('Variáveis não podem ser vazias.')</script>";
}else{
    $query = "UPDATE teste.banco SET nome = '$nome', ean = '$ean', tipo = '$tipo', ncm = '$ncm', cest = '$cest', estoque = '$estoque', validade = '$validade', custo = '$custo', emissao='$emissao' WHERE id = '$id';";
    if($banco->query($query)){
        header("Location: ../produtos.php?c=$chave");
        exit();
    }
    else{
        echo "<script>alert(Error: ".$sql."<br>".$banco->error.")</script>";
    }
}
?>