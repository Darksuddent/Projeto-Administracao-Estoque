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
    <title>Tabela lotes</title>
</head>
<body>
    <div class='tabela'>
        <?php buscar('lotes', null, null, null);?>
        <h1>Lista de lotes</h1>

        <table class='resultado'>
            <tr><td>Lote<td>Chave NFe<td>Emissao<td>Custo total<td>Visualizar
            <?php
        $chave = $_GET['c'] ?? null;
        if(is_null($chave) || empty($chave)){
            $query = 'SELECT @lote := @lote + 1 lote, chave, emissao, sum(custo) as custo, custo_total_nfe  FROM `banco`, (SELECT @lote := 0) m GROUP BY chave order by min(lote);';
        }else{
            $query = "SELECT @lote := @lote + 1 lote, chave, emissao, sum(custo) as custo, custo_total_nfe  FROM `banco`, (SELECT @lote := 0) m where chave like '%$chave%' or nome like '%$chave%' or emissao like '%$chave%' GROUP BY chave order by min(lote)";
        } 
        if($result = $banco->query($query)){
            while($obj = $result->fetch_object()){
                if($obj->custo_total_nfe == 0){
                    echo "<tr>
                    <td> $obj->lote
                    <td> $obj->chave
                    <td> $obj->emissao
                    <td> R$$obj->custo
                    <td> <a href = 'produtos.php?c=".$obj->chave."'><img src='bibliotecas/imagens/redirecionar.png'></a>
                    ";
                }else{
                    echo "<tr>
                    <td> $obj->lote
                    <td> $obj->chave
                    <td> $obj->emissao
                    <td> R$$obj->custo_total_nfe
                    <td> <a href = 'produtos.php?c=".$obj->chave."'><img src='bibliotecas/imagens/redirecionar.png'></a>
                    ";
                }
                    
                }
            }
        ?>
        </table>
    </div>
</body>
</html>