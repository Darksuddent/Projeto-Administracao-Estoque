<?php 
    require "../connect.php";
    require "../bibliotecas/funcoes.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../bibliotecas/style.css">
    <link rel="stylesheet" href="../bibliotecas/botoes.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Links</title>
</head>
<body>
    <div class='corpo'>
        <?php menu(true); ?>
        <h1 style='text-align: center;'>Links</h1>
        <form action='' method='post'>
            <h4 style='margin-left: 80px; margin-top: 50px;'>Nome do produto: <input type="text" name="nome" style='width: auto;'> <input type="submit" value="Confirmar" style='width:120px; height: 30px; font-size:20px; margin-left: 50px;'></h4>
        </form>
        <?php
  $nome = $_POST['nome'] ?? null;
  if(!is_null($nome) || !empty($nome)){

    echo gerarLink($nome);
    }
  

?>
    </div>
</body>
</html>