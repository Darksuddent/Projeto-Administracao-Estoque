<!DOCTYPE html>
<html lang="pt-br">
<head>
<script type="text/javascript">
      function ConfirmDelete()
      {
            if (confirm(`Você realmente deseja apagar o produto?`))
                 location.href='apagar.php';
      }
  </script>
    <?php
    require_once "connect.php";
    require_once "bibliotecas/funcoes.php";

    
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
        <tr><td>Nome<td>EAN<td>Estoque <td>Validade <td> Custo Unitário <td>NCM<td>CEST<td> <a href='adicionar.php'><img src='bibliotecas/imagens/adicionar.png'></a>
        <?php
        $editar = $_GET['edit'];
        if($editar==0){
        $query = "SELECT * from banco"; 
        if($result = $banco->query($query)){
            while($obj = $result->fetch_object()){
                $imagem = thumb($obj->imagem);
                if(empty($obj->imagem) || is_null($obj->imagem)){
                    echo "<tr>
                    <td> $obj->nome 
                    <td> $obj->ean 
                    <td> $obj->estoque 
                    <br> <a href='bibliotecas/edit_estoque.php?add=1&sub=0&id=$obj->id&e=$obj->estoque'>
                    <img src='bibliotecas/imagens/adicionar.png' class='supermini' name='adiconar'></a>
                    <a href='bibliotecas/edit_estoque.php?add=0&sub=1&id=$obj->id&e=$obj->estoque'>
                    <img src='bibliotecas/imagens/subtrair.png' class='supermini' name='subtrair'></a>
                        </a>
                    <td> $obj->validade 
                    <td> $obj->custo 
                    <td>$obj->ncm 
                    <td> $obj->cest 
                    <td> <a href='index.php?edit=1&id=$obj->id'><img src='bibliotecas/imagens/editar.png' class='supermini'></a><br><a href='apagar.php?id=$obj->id'><img src='bibliotecas/imagens/apagar.png' onclick='ConfirmDelete()' style='padding-top: 5px;'class='supermini'></a>";
                }
                else{
                    echo "<tr>
                    <td> $obj->nome 
                    <td> $obj->ean 
                    <td> $obj->estoque 
                        <br> <a href='bibliotecas/edit_estoque.php?add=1&sub=0&id=$obj->id&e=$obj->estoque'>
                        <img src='bibliotecas/imagens/adicionar.png' class='supermini' name='adiconar'></a>
                        <a href='bibliotecas/edit_estoque.php?add=0&sub=1&id=$obj->id&e=$obj->estoque'>
                        <img src='bibliotecas/imagens/subtrair.png' class='supermini' name='subtrair'></a>
                    <td> $obj->validade <td> $obj->custo <td>$obj->ncm <td> $obj->cest <td> <a href='index.php?edit=1&id=$obj->id'><img class='supermini' src='bibliotecas/imagens/editar.png'></a><br><a href='apagar.php?id=$obj->id'><img onclick='ConfirmDelete()' src='bibliotecas/imagens/apagar.png' style='padding-top: 5px;'class='supermini'></a>";
                }
            }
        }
        }else{
            $query = "SELECT * from banco";
            if($result = $banco->query($query)){
                while($obj = $result->fetch_object()){
                    $imagem = thumb($obj->imagem);
                    if($_GET['id'] == $obj->id){
                        echo 
                        "<form action='bibliotecas/editar.php' method='post'><tr>
                        <input type='hidden' name='id' value='$obj->id'>
                        <td> <input name = 'nome' style='width: 100px;' class='nome' type='text' value='$obj->nome'>
                        <td> <input type='text' name='ean' style='margin-left: 20px;'class='ean' value='$obj->ean'>
                        <td> <input name='estoque' class='estoque' type='text' value='$obj->estoque'>
                        <td> <input type='text' name='validade' value='$obj->validade'>
                        <td> <input type='text' name='custo' value='$obj->custo'>
                        <td> <input type='text' style='width: 70px;' name='ncm' value='$obj->ncm'>
                        <td> <input type='text' style='width: 60px;' name='cest' value='$obj->cest'>
                        <td> <input type='image' src='bibliotecas/imagens/editar.png' class='supermini' formmethod='post'> <br><a href='apagar.php?id=$obj->id'><img src='bibliotecas/imagens/apagar.png' style='padding-top: 5px;'class='supermini' onclick='ConfirmDelete()'></a>";
                    }else{
                        echo "<tr><td> $obj->nome <td> $obj->ean <td> $obj->estoque <br> <a href='bibliotecas/edit_estoque.php?add=1&sub=0&id=$obj->id&e=$obj->estoque'><img src='bibliotecas/imagens/adicionar.png' class='supermini' name='adiconar'></a> <a href='bibliotecas/edit_estoque.php?add=0&sub=1&id=$obj->id&e=$obj->estoque'><img src='bibliotecas/imagens/subtrair.png' class='supermini' name='subtrair'></a> <td> $obj->validade <td> $obj->custo <td>$obj->ncm <td> $obj->cest <td> <a href='index.php?edit=1&id=$obj->id'><img src='bibliotecas/imagens/editar.png' class='supermini'></a><br><a href='apagar.php?id=$obj->id'><img src='bibliotecas/imagens/apagar.png' style='padding-top: 5px;'class='supermini' onclick='ConfirmDelete()'></a>";
                    }
                }
            }
        }
        ?>
        </table>      
    </div>
</body>
</html>