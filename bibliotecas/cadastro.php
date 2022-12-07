<?php
require_once '../connect.php';
include_once 'funcoes.php';


$imagem = thumb($_POST['imagem']);

$arq = $_POST['xml'];
$xml= simplexml_load_file("../../../../XMLS/$arq");   
if (!$xml) {
    echo "Verifique se o arquivo está na pasta XMLS";
    exit;
} 
$children = $xml->children();

$data = array();
$i = 0;
/*while($i < max($children->NFe->infNFe->det->prod[])){
    $nome = $data['xProd'] = (strval($children->NFe->infNFe->det->prod[$i]->xProd));
    $ean = $data['cEAN'] = (strval($children->NFe->infNFe->det->prod[$i]->cEAN));
    $ncm = $data['NCM'] = (strval($children->NFe->infNFe->det->prod[$i]->NCM));
    $cest = $data['CEST'] = (strval($children->NFe->infNFe->det->prod[$i]->CEST));
    //$quantidade = $data['uCom'] = (strval($children->NFe->infNFe->det->prod->uCom));
    $tipo = $data['qCom'] = (strval($children->NFe->infNFe->det->prod[$i]->qCom));
    $emis = $data['dhEmi'] = (strval($children->NFe->infNFe->ide->dhEmi));
    if(is_null($ean) || is_null($ncm) || is_null($cest) || is_null($nome) || is_null($tipo)){
        $i = -1; 
    }else{
        $i = $i;
    }
    $i++;
}*/

    $nome = $data['xProd'] = (strval($children->NFe->infNFe->det->prod[$i]->xProd));
    $ean = $data['cEAN'] = (strval($children->NFe->infNFe->det->prod[$i]->cEAN));
    $ncm = $data['NCM'] = (strval($children->NFe->infNFe->det->prod[$i]->NCM));
    $cest = $data['CEST'] = (strval($children->NFe->infNFe->det->prod[$i]->CEST));
    //$quantidade = $data['uCom'] = (strval($children->NFe->infNFe->det->prod->uCom));
    $tipo = $data['qCom'] = (strval($children->NFe->infNFe->det->prod[$i]->qCom));
    $emis = $data['dhEmi'] = (strval($children->NFe->infNFe->ide->dhEmi));

$query = "INSERT INTO banco (nome, ean, tipo, ncm, cest, imagem, emissao) VALUES ('$nome', '$ean', '$tipo', '$ncm', '$cest', '$imagem', '$emis')";
if($nome==null || $ean == null){
    echo "<script>alert('O nome ou o Ean devem estar preenchidos')</script>";
    header("Location: adicionar.php");
    exit();
}else{
    if($banco->query($query)){
        echo max($children->NFe->infNFe->det->prod['nItem']);
        //header('Location: ../index.php');
        //exit();
    }
    else{
        echo "<script>alert(Error: ".$sql."<br>".$banco->error.")</script>";
    }
}

?>