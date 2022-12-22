<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php
    require_once "connect.php";
    require_once "bibliotecas/funcoes.php";
    error_reporting(E_ERROR | E_PARSE);
    ?>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="bibliotecas/style.css">
    <title>Tabela teste</title>
</head>
<body>
    <div class='tabela'>
        <form action="index.php" method='get'>
        <input type="text" name="c" style='font-size: 10px; margin-left: 1000px; width: 120px;'>
        <input type="submit" value="Buscar" style='width: auto;'>
        </form>
        <table class='resultado'>
        <h1>Lista de produtos</h1>
        <tr><td>Nome<td>EAN<td>Estoque <td>Validade <td> Custo Unitário <td>NCM<td>CEST<td> <a href='adicionar.php'><img src='bibliotecas/imagens/adicionar.png'></a>
        <?php
        $editar = $_GET['edit'];
        $chave = $_GET['c'];
        if(is_null($chave) || empty($chave)){
            $query = "SELECT * from banco";
        }else{
            $query = "SELECT * FROM banco where nome like '%$chave%' OR ean like '%$chave%' OR emissao like '%$chave%';";
        }
        if($editar==0){ 
        if($result = $banco->query($query)){
            while($obj = $result->fetch_object()){
                    echo "<tr>
                    <td> $obj->nome 
                    <td> $obj->ean 
                    <td> $obj->estoque 
                    <br> <a href='bibliotecas/edit_estoque.php?add=1&sub=0&id=$obj->id&e=$obj->estoque&c=$chave'>
                    <img src='bibliotecas/imagens/adicionar.png' class='supermini' name='adiconar'></a>
                    <a href='bibliotecas/edit_estoque.php?add=0&sub=1&id=$obj->id&e=$obj->estoque&c=$chave'>
                    <img src='bibliotecas/imagens/subtrair.png' class='supermini' name='subtrair'></a>
                        </a>
                    <td> $obj->validade 
                    <td> $obj->custo 
                    <td>$obj->ncm 
                    <td> $obj->cest 
                    <td> <a href='index.php?edit=1&id=$obj->id&c=$chave'><img src='bibliotecas/imagens/editar.png' class='supermini'></a><br><a href='confirmacao.php?id=$obj->id&c=$chave'><img src='bibliotecas/imagens/apagar.png'  style='padding-top: 5px;'class='supermini'></a>";
                }
            }
        }else{
            if($result = $banco->query($query)){
                while($obj = $result->fetch_object()){
                    $imagem = thumb($obj->imagem);
                    if($_GET['id'] == $obj->id){
                        echo 
                        "<form action='bibliotecas/editar.php' method='post'><tr>
                        <input type='hidden' name='id' value='$obj->id'>
                        <input type='hidden' name='c' value='$chave'>
                        <td> <input name = 'nome' style='width: 100px;' class='nome' type='text' value='$obj->nome'>
                        <td> <input type='text' name='ean' style='margin-left: 20px;'class='ean' value='$obj->ean'>
                        <td> <input name='estoque' class='estoque' type='text' value='$obj->estoque'>
                        <td> <input type='text' name='validade' value='$obj->validade'>
                        <td> <input type='text' name='custo' value='$obj->custo'>
                        <td> <input type='text' style='width: 70px;' name='ncm' value='$obj->ncm'>
                        <td> <input type='text' style='width: 60px;' name='cest' value='$obj->cest'>
                        <td> <input type='image' src='bibliotecas/imagens/editar.png' class='supermini' formmethod='post'> <br><a href='confirmacao.php?id=$obj->id&c=$chave'><img src='bibliotecas/imagens/apagar.png' style='padding-top: 5px;'class='supermini' ></a>";
                    }else{
                        echo "<tr><td> $obj->nome <td> $obj->ean <td> $obj->estoque <br> <a href='bibliotecas/edit_estoque.php?add=1&sub=0&id=$obj->id&e=$obj->estoque&c=$chave'><img src='bibliotecas/imagens/adicionar.png' class='supermini' name='adiconar'></a> <a href='bibliotecas/edit_estoque.php?add=0&sub=1&id=$obj->id&e=$obj->estoque&c=$chave'><img src='bibliotecas/imagens/subtrair.png' class='supermini' name='subtrair'></a> <td> $obj->validade <td> $obj->custo <td>$obj->ncm <td> $obj->cest <td> <a href='index.php?edit=1&id=$obj->id'><img src='bibliotecas/imagens/editar.png' class='supermini'></a><br><a href='confirmacao.php?id=$obj->id&c=$chave'><img src='bibliotecas/imagens/apagar.png' style='padding-top: 5px;'class='supermini' ></a>";
                    }
                }
            }
        }
        ?>
        </table>      
    </div>
</body>
</html>