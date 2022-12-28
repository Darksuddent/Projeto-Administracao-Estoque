<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require "connect.php";
    require "bibliotecas/funcoes.php";
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="bibliotecas/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class='tabela'>
        <?php buscar('lotes');?>
        <h1>Lista de lotes</h1>

        <table class='resultado'>
            <tr><td>Lote<td>Chave NFe<td>Visualizar
            <?php
        $chave = $_GET['c'] ?? null;
        if(is_null($chave) || empty($chave)){
            $query = 'SELECT @lote := @lote + 1 lote, chave FROM `banco`, (SELECT @lote := 0) m GROUP BY chave order by lote;';
        }else{
            $query = "SELECT @lote := @lote + 1 lote, chave FROM `banco`, (SELECT @lote := 0) m GROUP BY chave order by lote where chave like '$chave' or lote like '%$chave%';";
        } 
        if($result = $banco->query($query)){
            while($obj = $result->fetch_object()){
                    echo "<tr>
                    <td> $obj->lote
                    <td> $obj->chave
                    <td> <a href = 'produtos.php?c=".$obj->chave."'><img src='bibliotecas/imagens/redirecionar.png'></a>
                    ";
                }
            }
        ?>
        </table>
    </div>
</body>
</html>