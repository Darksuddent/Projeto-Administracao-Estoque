<link rel="stylesheet" href="bibliotecas/botoes.css">
<?php
function thumb($foto) {
    $arquivo = "$foto";	
    if (is_null($foto) || !file_exists("imagens/$arquivo")){
        return "indisponivel.png";
    } else {
        return $arquivo;
    } 
}
function buscar($pag, $c, $m, $t){
    if($pag == 'produtos' || $pag == 'kits'){
        echo "
            <form action='$pag.php' method='get'>
            <a href='index.php'><input style='width:auto; margin:0px; padding:10px; cursor: pointer;' type='button' class='orange' value='Menu principal' ></a>
            <b style='margin-left: 150px;'>Calcular para:</b> 
            <a style='margin-left: 150px;' href='$pag.php?c=$c&m=$m&t=1'>Mercado Livre</a>
            <a style='margin-left: 150px;' href='$pag.php?c=$c&m=$m&t=2'>Lojinha</a>
            <a style='margin-left: 150px;' href='$pag.php?c=$c&m=$m&t=3'>Full</a>
            <br>
            <b style='margin-left: 1074px;'>Margem pretendida:</b><input type='text' name='m' style='font-size: 10px; margin-left: 10px; width: 120px;' value='$m'>
            <b style='margin-left: 1038px;'>Informações do produto:</b><input type='text' name='c' style='font-size: 10px; margin-left: 10px; width: 120px;' value='$c'>
            <input type='hidden' name='t' value='$t'>
            <input type='submit' value='Buscar' style='width: auto;'>
            </form>";
    }else{
        echo "
            <form action='$pag.php' method='get'>
            <a href='index.php'><input style='width:auto; margin:0px; padding:10px; cursor: pointer;' type='button' class='orange' value='Menu principal' ></a>            <input type='text' name='c' style='font-size: 10px; margin-left: 1250px; width: 120px;' placeholder='Informações do produto'>
            <input type='submit' value='Buscar' style='width: auto;'>
            </form>";
    }
    
}
function menu($retorno){
    if(is_null($retorno) || empty($retorno) || $retorno == false){
        echo "<a href='index.php'><input style='width:auto; margin:0px; padding:10px; cursor: pointer;' type='button' class='orange' value='Menu principal' ></a>";
    }else{
        echo "<a href='../index.php'><input style='width:auto; margin:0px; padding:10px; cursor: pointer;' type='button' class='orange' value='Menu principal' ></a>";
    }
}
function calcularMargem($custo, $venda, $tipo){
    if($venda < 79){
        switch($tipo){
            case 1:
                $margem = number_format(((($venda*0.88)-5-5-$custo)/$custo)*100, 2, '.', ''); //MLB Padrão
                break;
            case 2:
                $margem = number_format(((($venda*0.83)-5-5-$custo)/$custo)*100, 2, '.', ''); //MLB Premium
                break;
            case 3:
                $margem = number_format(((($venda*0.88)-5-$custo)/$custo)*100, 2, '.', ''); //MLB Full
                break;
            case 4:
                $margem = number_format(((($venda*0.945)-5-$custo)/$custo)*100, 2, '.', '');
                break;
        }
    }else{
        switch($tipo){
            case 1:
                $margem = number_format(((($venda*0.88)-18.45-5-$custo)/$custo)*100, 2, '.', ''); //MLB Padrão
                break;
            case 2:
                $margem = number_format(((($venda*0.83)-18.45-5-$custo)/$custo)*100, 2, '.', ''); //MLB Premium
                break;
            case 3:
                $margem = number_format(((($venda*0.88)-18.45-$custo)/$custo)*100, 2, '.', ''); //MLB Full
                break;
            case 4:
                $margem = number_format(((($venda*0.945)-18.45-5-$custo)/$custo)*100, 2, '.', '');
                break;
        }
    }
    return $margem;
}

function calcularLucro($custo, $margem){
    $lucro = number_format($custo*$margem/100, 2, '.', '');
    return $lucro;
}

function preverMargem($custo, $margem, $tipo){
    //MLB
    $vendaMLBMen = number_format((1000 + (100 + $margem)*$custo)/88, 2, '.', '');
    $vendaMLBMai = number_format((2100 + (100 + $margem)*$custo)/88, 2, '.', '');
    //Lojinha
    $vendaLojinhaMen = number_format((500 + (100 + $margem)*$custo)/94.5, 2, '.', '');
    $vendaLojinhaMai = number_format((2300 + (100 + $margem)*$custo)/94.5, 2, '.', '');
    //Full  
    $vendaFullMen = number_format((500 + (100 + $margem)*$custo)/88, 2, '.', '');
    $vendaFullMai = number_format((1700 + (100 + $margem)*$custo)/88, 2, '.', '');
    if($vendaMLBMen >=79){
        $lucroDinMLB = $custo*$vendaMLBMai/100;
        $lucroDinLojinha = $custo*$vendaLojinhaMai/100;
        $lucroDinFull = $custo*$vendaFullMai/100;
        switch($tipo){
            case 1:
                return $vendaMLBMai; // MLB Padrão
                break;
            case 2:
                return $vendaLojinhaMai; // Loja
                break;
            case 3:
                return $vendaFullMai; // MLB Full
                break;
        }
    }else if ($vendaMLBMen < 79 && $custo != 0 || $margem != 0){
        $lucroDinMLB = $custo*$vendaMLBMen/100;
        $lucroDinLojinha = $custo*$vendaLojinhaMen/100;
        $lucroDinFull = $custo*$vendaFullMen/100;
        switch($tipo){
            case 1:
                return $vendaMLBMen;
                break;
            case 2:
                return $vendaLojinhaMen;
                break;
            case 3:
                return $vendaFullMen;
                break;
        }
    }  
}

function gerarLink($nome){
    $mlb_link = "https://lista.mercadolivre.com.br/beleza-cuidado-pessoal-em-sao-paulo/".$nome."_OrderId_PRICE_NoIndex_True";
    return "<a target='_blank' href='".$mlb_link."' value='".$mlb_link."'><b><h4>Link MLB</h4></b></a>";
}