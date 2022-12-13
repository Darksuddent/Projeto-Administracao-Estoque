<?php
require_once '../connect.php';
include_once 'funcoes.php';


//$imagem = thumb($_POST['imagem']);

$arq = $_POST['xml'];
$xml= simplexml_load_file("../../../../XMLS/$arq");   
if (!$xml) {
    echo "Verifique se o arquivo está na pasta XMLS";
    exit;
} 
$children = $xml->children();

$data = array();
$prod = $_POST['produtos'];
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

    
    $i = 0;
    echo "<form action:'cadastro.php' method='post'><center><fieldset style='width: 800px; text-align: left; margin-left: 50px;'>
        <legend>Quais produtos serão cadastrados?</legend>";
while(true){
    
    $n[$i] = $data['xProd'] = (strval($children->NFe->infNFe->det[$i]->prod->xProd)) ?? null;
    $e[$i] = $data['cEAN'] = (strval($children->NFe->infNFe->det[$i]->prod->cEAN))?? null;
    $nc[$i] = $data['NCM'] = (strval($children->NFe->infNFe->det[$i]->prod->NCM))?? null;
    $c[$i] = $data['CEST'] = (strval($children->NFe->infNFe->det[$i]->prod->CEST))?? null;
    //$quantidade = $data['uCom'] = (strval($children->NFe->infNFe->det->prod->uCom));
    $t[$i] = $data['qCom'] = (strval($children->NFe->infNFe->det[$i]->prod->qCom))?? null;
    $em[$i] = $data['dhEmi'] = (strval($children->NFe->infNFe->ide->dhEmi))?? null;

    $nome = $n[$i];
    $ean = $e[$i];
    $ncm = $nc[$i];
    $cest = $c[$i];
    $tipo = $t[$i];
    $emis = $em[$i];

    $i++;
    if(is_null($nome) || empty($nome)){
        break;
    }else{
        $query = "INSERT INTO banco (nome, ean, tipo, ncm, cest,  emissao) VALUES ('$nome', '$ean', '$tipo', '$ncm', '$cest', '$emis')";
        echo "
        <div>
          <input type='checkbox' id='$nome' name='produtos' value='$nome' checked>
          <label for='$nome'>$nome</label>
        </div>
    ";
            /*if($banco->query($query)){
                echo "O produto $nome foi inserido com sucesso!";
            }
            else{
                echo "<script>alert(Error: ".$query."<br>".$banco->error.")</script>";
            }*/
        }
    }
    echo "</fieldset></center><input type='submit' value='Confirmar' style='text-align: left; margin-left: 700px; margin-top: 20px; font-size: 20px';></form>";
?>