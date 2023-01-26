<?php
require "../connect.php";
require "../bibliotecas/funcoes.php" ;
$custo = $_POST['custo'] ?? null;
$venda = $_POST['venda'] ?? null;

if(!is_null($custo) || !is_null($venda) || !empty($custo) || !empty($venda)){
  if ($venda < 79){
    $margem_mlb = calcularMargem($custo, $venda, 1);
    $margem_premium = calcularMargem($custo, $venda, 2);
	$margem_full = calcularMargem($custo, $venda, 3);
	$margem_loja = calcularMargem($custo, $venda, 4);
    
  } else{
    $margem_mlb = calcularMargem($custo, $venda, 1);
    $margem_premium = calcularMargem($custo, $venda, 2);
	$margem_full = calcularMargem($custo, $venda, 3);
	$margem_loja = calcularMargem($custo, $venda, 4);
  }

  $margem_shopee = ($venda*0.95-5-$custo)/$custo*100;
  $margem_shopee = number_format($margem_shopee, 2, '.', '');

  $lucro_mlb = calcularLucro($custo, $margem_mlb);
  $lucro_premium = calcularLucro($custo, $margem_premium);
  $lucro_full = calcularLucro($custo, $margem_full);
  $lucro_shopee = number_format($custo*$margem_shopee/100, 2, '.', '');
  $lucro_loja = calcularLucro($custo, $margem_loja);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../bibliotecas/style.css">
    <link rel="stylesheet" href="../bibliotecas/slider.css">
    <link rel="stylesheet" href="../bibliotecas/botoes.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Margem</title>
</head>
<body>
    <div class='corpo'>
    <?php menu(true); ?>
    <h1 style='text-align: center;'>Margem</h1>
    <form action='' method='post'>
    <h4 style='text-align: left;'>Custo do produto: <input type="number" name="custo" step='.01' style='width: auto;'><br><br></h4>
    <h4 style='text-align: center;'><input style='width:auto; margin: -25px; margin-left: 30px; font-size: 25px;' type="submit" value="Calcular"></h4>
    <h4 style='text-align: left;'>Valor de venda: <input type="number" name="venda" step='.01' style='width: auto; margin-left: 21px;'></h4>
    </form>
    <?php
    if(is_null($custo) == false || empty($custo == false || is_null($venda) == false || empty($venda) == false)){
        echo '<div style="text-align: center;"><p style="font-size: 30px ">Custo Inserido: R$'.$custo.' &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Venda Inserida: R$'.$venda.'</p></div> ';
        echo "<table  style='border-spacing: 10px; margin-bottom: 30px; margin-top: 30px; margin-left: 200px;'>
        <td>Margem MLB: <b>$margem_mlb%</b> <td>Lucro MLB: <b>R$$lucro_mlb</b>
        <tr><td>Margem Premium: <b>$margem_premium%</b> <td>Lucro Premium: <b>R$$lucro_premium</b>
        <tr><td>Margem Full: <b>$margem_full%</b> <td>Lucro Full: <b>R$$lucro_full</b>
        <tr><td>Margem Loja: <b>$margem_loja%</b> <td>Lucro Loja: <b>R$$lucro_loja</b>
        </table>";
      }
    ?>
    </div>
</body>
</html>