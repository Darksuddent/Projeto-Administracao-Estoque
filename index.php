<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php
    require_once "connect.php";
    ?>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="bibliotecas/style.css">
    <title>Tabela teste</title>
</head>
<body>
    <div class='tabela'>
        <table class='resultado'>
        <h1>Título tabela</h1>
        <tr><td>Foto<td>Nome<td>EAN<td>Tipo<td>Estoque <td>Validade <td> Custo Unitário <td>NCM<td>CEST<td> <a href='adicionar.php'><img src='bibliotecas/imagens/adicionar.png'></a>
        <?php
        $query = "SELECT * from banco"; 
        if($result = $banco->query($query)){
            while($obj = $result->fetch_object()){
                echo "<tr><td><img class='mini' src='imagens/$obj->imagem'><td> $obj->nome <td> $obj->ean <td> $obj->tipo <td> $obj->estoque <td> $obj->validade <td> $obj->custo <td>$obj->ncm <td> $obj->cest <td> <a href='editar.php'><img src='bibliotecas/imagens/editar.png'></a>";
            }
        }
        ?>
        </table>      
    </div>
</body>
</html>