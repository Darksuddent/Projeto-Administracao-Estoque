<?php
require_once '../connect.php';
include_once 'funcoes.php';


//$imagem = thumb($_POST['imagem']);

/*$arq = $_POST['xml'];
$xml= simplexml_load_file("../../../../XMLS/$arq");   
if (!$xml) {
    echo "Verifique se o arquivo está na pasta XMLS";
    echo $arq;
    echo realpath($arq);
    exit;
} 
$children = $xml->children();

$data = array();*/

$i = $_POST['linhas'];
$aux = 0;
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
    $result = $banco->query("SELECT * FROM banco WHERE ean = '$ean'");
    $obj = $result->fetch_object();

    if(is_null($nome) || empty($nome)){
        break;
    }else if(is_null($obj->ean)){
        $query = "INSERT INTO banco (nome, ean, tipo, ncm, cest, emissao, estoque, custo, validade) VALUES ('$nome', '$ean', '$tipo', '$ncm', '$cest', '$emis', '$estoque', '$custo', '$validade')";
            if($banco->query($query)){
                echo "O produto $nome foi inserido com sucesso!<br><br>";
            }
            else{
                echo "<script>alert(Error: ".$query."<br>".$banco->error.")</script>";
            }
        }else{
            $preco_antigo = $obj->custo;
            $preco_novo = ($preco_antigo + $custo)/2;
            $query = 'UPDATE banco SET estoque = estoque +'.$estoque.', custo = '.$preco_novo.' WHERE ean = '.$obj->ean.'';
            if($banco->query($query)){
                echo "O produto $nome foi adicionado ao estoque com sucesso!<br><br>";
            }
            else{
                echo "<script>alert(Error: ".$query."<br>".$banco->error.")</script>";
            }
        }
    $aux++;
}
header("Location: ../index.php");
exit();
?>