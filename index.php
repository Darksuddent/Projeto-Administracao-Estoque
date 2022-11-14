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
        $editar = $_GET['edit'];
        if($editar==0){
        $query = "SELECT * from banco"; 
        if($result = $banco->query($query)){
            while($obj = $result->fetch_object()){
                echo "<tr><td><img class='mini' src='imagens/$obj->imagem'><td> $obj->nome <td> $obj->ean <td> $obj->tipo <td> $obj->estoque <td> $obj->validade <td> $obj->custo <td>$obj->ncm <td> $obj->cest <td> <a href='index.php?edit=1'><img src='bibliotecas/imagens/editar.png'></a>";
            }
        }
        }else{
            $query = "SELECT * from banco"; 
            if($result = $banco->query($query)){
                while($obj = $result->fetch_object()){
                    echo 
                    "<form action='bibliotecas/editar.php' method='post'><tr>
                    <td> <img class='mini' src='imagens/$obj->imagem'>
                    <td> <input name = 'nome' type='text' value='$obj->nome'>
                    <td> <input type='text' name='ean' value='$obj->ean'>
                    <td> <input name='tipo' type='text' value='$obj->tipo'>
                    <td> <input name='estoque' type='text' value='$obj->estoque'>
                    <td> <input type='text' name='validade' value='$obj->validade'>
                    <td> <input type='text' name='custo' value='$obj->custo'>
                    <td> <input type='text' name='ncm' value='$obj->ncm'>
                    <td> <input type='text' name='cest' value='$obj->cest'>
                    <td> <input type='image' ' src='bibliotecas/imagens/editar.png' class='imagem' formmethod='post'>";
                }
            }
        }
        ?>
        </table>      
    </div>
</body>
</html>