<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php
    require_once "connect.php";
    require_once "bibliotecas/funcoes.php";
    ?>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="bibliotecas/style.css">
    <title>Tabela teste</title>
    <?php
        $editar = $_GET['edit'];
        $chave = $_GET['c'];
        ?>
</head>
<body>
    <div class='tabela'>
        <?php buscar('produtos');?>
        <table class='resultado'>
        <?php 
        if(is_null($chave) || empty($chave)){
            echo "<h1>Lista de produtos</h1>";
        }else{
            echo "<h1>Lista de produtos</h1> <h4>(Visão Geral)</h4>";
        }
        ?>
        <tr><td>Nome<td>EAN<td>Estoque <td>Validade <td> Custo Unitário <td>NCM<td>CEST<td>Emissão<td>Chave<td> <a href='adicionar.php'><img src='bibliotecas/imagens/adicionar.png'></a>
        <?php
        if(is_null($chave) || empty($chave)){
            $query = "SELECT * from vw_tabela order by nome";
        }else{
            $query = "SELECT * FROM banco where nome like '%$chave%' OR ean like '%$chave%' OR emissao like '%$chave%' OR chave like '%$chave%' order by nome;";
        }
        if($editar==0){ 
        if($result = $banco->query($query)){
            while($obj = $result->fetch_object()){
                    echo "<tr>
                    <td> $obj->nome 
                    <td> $obj->ean 
                    <td> $obj->estoque 
                    <br> <a href='bibliotecas/edit_estoque.php?add=1&sub=0&ean=$obj->id&e=$obj->estoque&c=$chave'>
                    <img src='bibliotecas/imagens/adicionar.png' class='supermini' name='adiconar'></a>
                    <a href='bibliotecas/edit_estoque.php?add=0&sub=1&ean=$obj->id&e=$obj->estoque&c=$chave'>
                    <img src='bibliotecas/imagens/subtrair.png' class='supermini' name='subtrair'></a>
                        </a>
                    <td> $obj->validade 
                    <td> R$$obj->custo 
                    <td>$obj->ncm 
                    <td> $obj->cest 
                    <td> $obj->emissao
                    <td> $obj->chave
                    <td> <a href='produtos.php?edit=1&id=$obj->id&c=$chave'><img src='bibliotecas/imagens/editar.png' class='supermini'></a><br><a href='confirmacao.php?id=$obj->id&c=$chave'><img src='bibliotecas/imagens/apagar.png'  style='padding-top: 5px;'class='supermini'></a>";
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
                        <td> <input type='text' style='width: 60px;' name='emissao' value='$obj->emissao'>
                        <td> <input type='text' style='width: 60px;' name='chave' value='$obj->chave' readonly>
                        <td> <input type='image' src='bibliotecas/imagens/editar.png' class='supermini' formmethod='post'> <br><a href='confirmacao.php?id=$obj->id&c=$chave'><img src='bibliotecas/imagens/apagar.png' style='padding-top: 5px;'class='supermini' ></a>";
                    }else{
                        echo "<tr><td> $obj->nome <td> $obj->ean <td> $obj->estoque <br> <a href='bibliotecas/edit_estoque.php?add=1&sub=0&ean=$obj->id&e=$obj->estoque&c=$chave'><img src='bibliotecas/imagens/adicionar.png' class='supermini' name='adiconar'></a> <a href='bibliotecas/edit_estoque.php?add=0&sub=1&ean=$obj->id&e=$obj->estoque&c=$chave'><img src='bibliotecas/imagens/subtrair.png' class='supermini' name='subtrair'></a> <td> $obj->validade <td> $obj->custo <td>$obj->ncm <td> $obj->cest <td>$obj->emissao<td>$obj->chave <td><a href='produtos.php?edit=1&id=$obj->id'><img src='bibliotecas/imagens/editar.png' class='supermini'></a><br><a href='confirmacao.php?id=$obj->id&c=$chave'><img src='bibliotecas/imagens/apagar.png' style='padding-top: 5px;'class='supermini' ></a>";
                    }
                }
            }
        }
        ?>
        </table>      
    </div>
</body>
</html>