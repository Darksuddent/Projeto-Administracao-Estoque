<?php
require_once '../connect.php';
include_once 'funcoes.php';

$i = $_POST['linhas'];
$aux = 0;

$chave = $_POST['chave'] ?? 0.1;
$custo_total = 0;
while($i>=$aux){
    $n[$aux] = $_POST["nome".$aux.""];
    $e[$aux] = $_POST["ean".$aux.""];
    $nc[$aux] = $_POST["ncm".$aux.""];
    $ce[$aux] = $_POST["cest".$aux.""];
    $t[$aux] = $_POST["tipo".$aux.""];
    $es[$aux] = $_POST["estoque".$aux.""];
    $val[$aux] = $_POST["validade".$aux.""];
    $cst[$aux] = $_POST["custo".$aux.""];
    $emis = $_POST["emis"];

    $nome = $n[$aux];
    $ean = $e[$aux];
    $ncm = $nc[$aux];
    $cest = $ce[$aux];
    $tipo = $t[$aux];
    $estoque = $es[$aux];
    $validade = $val[$aux];
    $custo = $cst[$aux];
    $result = $banco->query("SELECT * FROM banco WHERE ean = '$ean' AND chave = '$chave'");
    $obj = $result->fetch_object();
    if(is_null($obj->chave) || empty($obj->chave)){
        if(is_null($nome) || empty($nome)){
            break;
        }else{
            $query = "INSERT INTO banco (nome, ean, tipo, ncm, cest, emissao, estoque, custo, validade, chave, estoque_original) VALUES ('$nome', '$ean', '$tipo', '$ncm', '$cest', '$emis', '$estoque', format('$custo', 2), '$validade', $chave, '$estoque')";
            if($banco->query($query)){
                    echo "O produto $nome foi inserido com sucesso!<br><br>";
                    $custo_total+=$custo;
                    $banco->query("UPDATE banco SET custo_total_nfe = $custo_total where chave = $chave");
                }
                else{
                    echo "<script>alert(Error: ".$query."<br>".$banco->error.")</script>";
                }
            }
    }else{
        $aux++;
        continue;
    }
    $aux++;
}
header("Location: ../produtos.php");
exit();
?>