<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php
    require_once "connect.php";
    require_once "bibliotecas/funcoes.php"
    ?>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="bibliotecas/style.css">
    <title>Tabela teste</title>
</head>
<body>
    <div class='tabela'>
        <?php include "topo.php"; ?>
        <table class='resultado'>
        </script>
        <h1>Lista de produtos</h1>
        <tr><td>Foto<td>Nome<td>EAN<td>Estoque <td>Validade <td> Custo Unitário <td>NCM<td>CEST<td> <a href='adicionar.php'><img src='bibliotecas/imagens/adicionar.png'></a>
        <?php
        $editar = $_GET['edit'];
        if($editar==0){
        $query = "SELECT * from banco"; 
        if($result = $banco->query($query)){
            while($obj = $result->fetch_object()){
                echo "<tr><td><img class='mini' src='imagens/$obj->imagem'><td> $obj->nome <td> $obj->ean <td> $obj->estoque <br> <a href='bibliotecas/edit_estoque.php?add=1&sub=0&id=$obj->id&e=$obj->estoque'><img src='bibliotecas/imagens/adicionar.png' class='supermini' name='adiconar'></a> <a href='bibliotecas/edit_estoque.php?add=0&sub=1&id=$obj->id&e=$obj->estoque'><img src='bibliotecas/imagens/subtrair.png' class='supermini' name='subtrair'></a> <td> $obj->validade <td> $obj->custo <td>$obj->ncm <td> $obj->cest <td> <a href='index.php?edit=1&id=$obj->id'><img src='bibliotecas/imagens/editar.png'></a>";
            }
        }
        }else{
            $query = "SELECT * from banco";
            if($result = $banco->query($query)){
                while($obj = $result->fetch_object()){
                    if($_GET['id'] == $obj->id){
                        echo 
                        "<form action='bibliotecas/editar.php' method='post'><tr>
                        <input type='hidden' name='id' value='$obj->id'>
                        <td> <input type='file' class='mini' name='imagem'>
                        <td> <input name = 'nome' class='nome' type='text' value='$obj->nome'>
                        <td> <input type='text' name='ean' class='ean' value='$obj->ean'>
                        <td> <input name='estoque' class='estoque' type='text' value='$obj->estoque'>
                        <td> <input type='text' name='validade' value='$obj->validade'>
                        <td> <input type='text' name='custo' value='$obj->custo'>
                        <td> <input type='text' name='ncm' value='$obj->ncm'>
                        <td> <input type='text' name='cest' value='$obj->cest'>
                        <td> <input type='image' src='bibliotecas/imagens/editar.png' class='imagem' formmethod='post'>";
                    }else{
                        echo "<tr><td><img class='mini' src='imagens/$obj->imagem'><td> $obj->nome <td> $obj->ean <td> $obj->tipo <td> $obj->estoque <br> <a href='bibliotecas/edit_estoque.php?add=1&sub=0&id=$obj->id&e=$obj->estoque'><img src='bibliotecas/imagens/adicionar.png' class='supermini' name='adiconar'></a> <a href='bibliotecas/edit_estoque.php?add=0&sub=1&id=$obj->id&e=$obj->estoque'><img src='bibliotecas/imagens/subtrair.png' class='supermini' name='subtrair'></a> <td> $obj->validade <td> $obj->custo <td>$obj->ncm <td> $obj->cest <td> <a href='index.php?edit=1&id=$obj->id'><img src='bibliotecas/imagens/editar.png'></a>";
                    }
                }
            }
        }
        ?>
        </table>      
    </div>
</body>
</html>