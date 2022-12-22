<style>
    body{
        background-color: rgb(104, 105, 159);
    }
    form{
        border-radius: 5px;
        background-color: white;
        width: 1000px;
        margin: auto;
        padding: 20px;
    }
    p{
        margin-left: 50px;
    }
</style>

<script>
    let myLabels = document.querySelectorAll('.lbl-toggle');

Array.from(myLabels).forEach(label => {
  label.addEventListener('keydown', e => {
    // 32 === spacebar
    // 13 === enter
    if (e.which === 32 || e.which === 13) {
      e.preventDefault();
      label.click();
    };
  });
});
</script>


<?php
$xml = $_POST['xml'];

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

    echo "<body><form action='cadastro.php' method='post'><center><fieldset style='width: 800px; text-align: left; margin-left: 50px;'>
        <legend>Confirme os valores...</legend>";
while(true){
    
    $n[$i] = $data['xProd'] = (strval($children->NFe->infNFe->det[$i]->prod->xProd)) ?? null;
    $e[$i] = $data['cEAN'] = (strval($children->NFe->infNFe->det[$i]->prod->cEAN))?? null;
    $nc[$i] = $data['NCM'] = (strval($children->NFe->infNFe->det[$i]->prod->NCM))?? null;
    $c[$i] = $data['CEST'] = (strval($children->NFe->infNFe->det[$i]->prod->CEST))?? null;
    $q[$i] = $data['qCom'] = (strval($children->NFe->infNFe->det[$i]->prod->qCom)) ?? null;
    $t[$i] = $data['uCom'] = (strval($children->NFe->infNFe->det[$i]->prod->uCom))?? null;
    $em[$i] = $data['dhEmi'] = (strval($children->NFe->infNFe->ide->dhEmi))?? null;

    $nome = $n[$i];
    $ean = $e[$i];
    $ncm = $nc[$i];
    $cest = $c[$i];
    $tipo = $t[$i];
    $emis = $em[$i];
    $quantidade = $q[$i];
     
    if(is_null($nome) || empty($nome)){
      $linhas = $i-1;  
      break;
    }else{
        echo "
        <h3>$nome</h3>
          <p>
            Nome = <input type='text' name='nome".$i."' style='width: 230px; margin-left:50px;'value='$nome'>
          </p>
          <p>
            EAN = <input type='text' name='ean".$i."' style='width: 230px; margin-left:55px;'value='$ean'>
          </p>
          <p>
            NCM = <input type='text' name='ncm".$i."' style='width: 230px; margin-left:51px;'value='$ncm'>
          </p>
          <p>
            CEST = <input type='text' name='cest".$i."' style='width: 230px; margin-left:47px;'value='$cest'>
          </p>
          <p>
            Estoque = <input type='text' name='estoque".$i."' style='width: 230px; margin-left:36px;'value='$quantidade'>
          </p>
          <p>
            Tipo = <input type='text' name='tipo".$i."' style='width: 230px; margin-left:57px;'value='$tipo'>
          </p>
          <p>
            Emissão NF = <input type='text' name='emis' style='width: 230px; margin-left:8px;'value='$emis'>
          </p>
          <p>
            Custo Unit. = <input type='text' name='custo".$i."' style='width: 230px; margin-left:16px;'value=''>
          </p>
          <p>
            Validade = <input type='text' name='validade".$i."' style='width: 230px; margin-left:30px;'value=''>
          </p>
        ";
        }
        $i++;
    }
    echo "<input type='hidden' name='linhas' value='$linhas'></fieldset></center><input type='submit' value='Confirmar' style='text-align: left; margin-left: 700px; margin-top: 20px; font-size: 20px';></form></body>";
?>


