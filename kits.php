<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php
    require_once "connect.php";
    require_once "bibliotecas/funcoes.php";
    ?>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="bibliotecas/style.css">
    <title>Tabela kits</title>
    <?php
        $editar = $_GET['edit'];
        $chave = $_GET['c'];
        $margem = $_GET['m'];
        $tipo = $_GET['t'];
        $pag = 'kits';
        if(is_null($margem) || empty($margem)){
            $margem = 30;
        }
        if(is_null($tipo) || empty($tipo)){
            $tipo = 1;
        }
        ?>
</head>
<body>
    <div class='tabela'>
        <?php buscar('kits', $chave, $margem, $tipo);?>
        <table class='resultado'>
        <?php 
        if(is_null($chave) || empty($chave)){
            echo "<h1>Lista de conjuntos</h1>";
        }else{
            echo "<h1>Lista de conjuntos</h1> <h4>(Visão Geral)</h4>";
        }
        ?>
        <?php 
        switch($tipo){
            case 1:
                echo "<tr><td>Nome<td>Estoque <td>Validade <td> Custo Unitário <td>NCM<td>CEST<td>Emissão<td>Preço de venda recomendado (MLB Padrão)<td>Concorrência<td> <a href='adicionar_kit.php'><img src='bibliotecas/imagens/adicionar.png'></a>";
                break;
            case 2:
                echo "<tr><td>Nome<td>Estoque <td>Validade <td> Custo Unitário <td>NCM<td>CEST<td>Emissão<td>Preço de venda recomendado (Lojinha)<td>Concorrência<td> <a href='adicionar_kit.php'><img src='bibliotecas/imagens/adicionar.png'></a>";
                break;
            case 3:
                echo "<tr><td>Nome<td>Estoque <td>Validade <td> Custo Unitário <td>NCM<td>CEST<td>Emissão<td>Preço de venda recomendado (Full)<td>Concorrência<td> <a href='adicionar_kit.php'><img src='bibliotecas/imagens/adicionar.png'></a>";
                break;
            }
            ?>
        <?php
        if(is_null($chave) || empty($chave)){
            $query = "SELECT kits.id, kits.nome_kit, banco.numero_kit, kits.estoque, banco.emissao, kits.custo, banco.validade, banco.ncm, banco.cest from kits inner join banco on kits.numero = banco.numero_kit group by banco.numero_kit order by banco.emissao DESC";
        }else{
            $query = "SELECT kits.id, kits.nome_kit, banco.numero_kit, kits.estoque, banco.emissao, kits.custo, banco.validade, banco.ncm, banco.cest from kits inner join banco on kits.numero = banco.numero_kit where nome like '%$chave%' OR ean like '%$chave%' OR emissao like '%$chave%' OR chave like '%$chave%' group by banco.numero_kit order by banco.emissao DESC;";
        }
        if($editar==0){ 
            if($result = $banco->query($query)){
                while($obj = $result->fetch_object()){
                    $link = gerarLink($obj->nome_kit);
                    if(calcularLucro($obj->custo, preverMargem($obj->custo, 30, 1)) > 0){
                        echo "<tr>
                        <td> $obj->nome_kit 
                        <td> $obj->estoque 
                        <br> <a href='bibliotecas/edit_estoque.php?add=1&sub=0&ean=$obj->id&e=$obj->estoque&c=$chave&num=$obj->numero_kit&p=kits'>
                        <img src='bibliotecas/imagens/adicionar.png' class='supermini' name='adiconar'></a>
                        <a href='bibliotecas/edit_estoque.php?add=0&sub=1&ean=$obj->id&e=$obj->estoque&c=$chave&num=$obj->numero_kit&p=kits'>
                        <img src='bibliotecas/imagens/subtrair.png' class='supermini' name='subtrair'></a>
                            </a>
                        <td> $obj->validade 
                        <td> R$$obj->custo 
                        <td>$obj->ncm 
                        <td> $obj->cest 
                        <td> $obj->emissao
                        <td style='background-color: rgba(195, 241, 149, 0.485); color: rgba(125, 219, 32, 1);'> ".preverMargem($obj->custo, $margem, $tipo)."
                        <td> $link
                        <td> <a href='kits.php?edit=1&id=$obj->id&c=$chave&p=$pag'><img src='bibliotecas/imagens/editar.png' class='supermini'></a><br>
                        <a href='confirmacao.php?id=$obj->id&c=$chave&num=$obj->numero_kit'><img src='bibliotecas/imagens/apagar.png'  style='padding-top: 5px;'class='supermini'></a>
                        <br><a href = 'produtos.php?c=".$obj->numero_kit."'><img style='padding-top: 5px;'class='supermini' src='bibliotecas/imagens/redirecionar.png'></a>";
                    }else{
                        echo "<tr>
                    <td> $obj->nome_kit  
                    <td> $obj->estoque 
                    <br> <a href='bibliotecas/edit_estoque.php?add=1&sub=0&ean=$obj->id&e=$obj->estoque&c=$chave&num=$obj->numero_kit&p=kits'>
                    <img src='bibliotecas/imagens/adicionar.png' class='supermini' name='adiconar'></a>
                    <a href='bibliotecas/edit_estoque.php?add=0&sub=1&ean=$obj->id&e=$obj->estoque&c=$chave&num=$obj->numero_kit&p=kits'>
                    <img src='bibliotecas/imagens/subtrair.png' class='supermini' name='subtrair'></a>
                        </a>
                    <td> $obj->validade 
                    <td> R$$obj->custo 
                    <td>$obj->ncm 
                    <td> $obj->cest 
                    <td> $obj->emissao
                    <td style='background-color: rgba(249, 138, 130, 0.422); color: rgb(235, 59, 46);'> ".preverMargem($obj->custo, $margem, $tipo)."
                    <td> $link
                    <td> <a href='kits.php?edit=1&id=$obj->id&c=$chave&p=$pag'><img src='bibliotecas/imagens/editar.png' class='supermini'></a><br><a href='confirmacao.php?id=$obj->id&c=$chave&num=$obj->numero_kit'><img src='bibliotecas/imagens/apagar.png'  style='padding-top: 5px;'class='supermini'></a><br><a href = 'produtos.php?c=".$obj->numero_kit."'><img style='padding-top: 5px;'class='supermini' src='bibliotecas/imagens/redirecionar.png'></a>";
                    }
                        
                }
            }
        }else{
            if($result = $banco->query($query)){
                while($obj = $result->fetch_object()){
                    $imagem = thumb($obj->imagem);
                    $link = gerarLink($obj->nome_kit);
                    if($_GET['id'] == $obj->id){
                        if(calcularLucro($obj->custo, preverMargem($obj->custo, 30, 1)) > 0){
                        echo 
                        "<form action='bibliotecas/editar.php' method='post'><tr>
                        <input type='hidden' name='id' value='$obj->id'>
                        <input type='hidden' name='c' value='$chave'>
                        <input type='hidden' name='p' value='$pag'>
                        <td> <input name = 'nome' style='width: 100px;' class='nome' type='text' value='$obj->nome_kit'>
                        <td> <input name='estoque' class='estoque' type='text' value='$obj->estoque' readonly>
                        <td> <input type='text' name='validade' value='$obj->validade' readonly>
                        <td> <input type='text' name='custo' value='$obj->custo' readonly>
                        <td> <input type='text' style='width: 70px;' name='ncm' value='$obj->ncm' readonly>
                        <td> <input type='text' style='width: 60px;' name='cest' value='$obj->cest' readonly>
                        <td> <input type='text' style='width: 80px;' name='emissao' value='$obj->emissao' readonly>
                        <td style='background-color: rgba(195, 241, 149, 0.485); '> <input type='text' style='width: 60px; color: rgba(125, 219, 32, 1); -webkit-appearance: none; border: none;  background-color: rgba(195, 241, 149, 0.485); ' name='chave' value='".preverMargem($obj->custo, $margem, $tipo)."' readonly>
                        <td> $link
                        <td> <input type='image' src='bibliotecas/imagens/editar.png' class='supermini' formmethod='post'> <br><a href='confirmacao.php?id=$obj->id&c=$chave&num=$obj->numero_kit'><img src='bibliotecas/imagens/apagar.png' style='padding-top: 5px;'class='supermini' ></a><br><a href = 'produtos.php?c=".$obj->numero_kit."'><img style='padding-top: 5px;'class='supermini' src='bibliotecas/imagens/redirecionar.png'></a>";
                        }else{
                            echo 
                            "<form action='bibliotecas/editar.php' method='post'><tr>
                            <input type='hidden' name='id' value='$obj->id'>
                            <input type='hidden' name='c' value='$chave'>
                            <input type='hidden' name='p' value='$pag'>
                            <td> <input name = 'nome' style='width: 100px;' class='nome' type='text' value='$obj->nome_kit'>
                            <td> <input type='text' name='ean' style='margin-left: 20px; width: 115px;'class='ean' value='$obj->ean' readonly>
                            <td> <input name='estoque' class='estoque' type='text' value='$obj->estoque' readonly>
                            <td> <input type='text' name='validade' value='$obj->validade' readonly>
                            <td> <input type='text' name='custo' value='$obj->custo' readonly>
                            <td> <input type='text' style='width: 70px;' name='ncm' value='$obj->ncm' readonly>
                            <td> <input type='text' style='width: 60px;' name='cest' value='$obj->cest' readonly>
                            <td> <input type='text' style='width: 80px;' name='emissao' value='$obj->emissao' readonly>
                            <td style='background-color: rgba(249, 138, 130, 0.422);> <input type='text' style='width: 60px; background-color: rgba(249, 138, 130, 0.422);  -webkit-appearance: none; border: none; color: rgb(235, 59, 46); color: rgb(235, 59, 46);' name='chave' value='".preverMargem($obj->custo, $margem, $tipo)."' readonly>
                            <td> $link
                            <td> <input type='image' src='bibliotecas/imagens/editar.png' class='supermini' formmethod='post'> <br><a href='confirmacao.php?id=$obj->id&c=$chave&num=$obj->numero_kit'><img src='bibliotecas/imagens/apagar.png' style='padding-top: 5px;'class='supermini' ></a><br><a href = 'produtos.php?c=".$obj->numero_kit."'><img style='padding-top: 5px;'class='supermini' src='bibliotecas/imagens/redirecionar.png'></a>";
                        }
                    }else{
                        if(calcularLucro($obj->custo, preverMargem($obj->custo, $margem, $tipo)) > 0){
                        echo "<tr>
                        <td> $obj->nome_kit  
                        <td> $obj->estoque 
                        <br> 
                        <a href='bibliotecas/edit_estoque.php?add=1&sub=0&ean=$obj->id&e=$obj->estoque&c=$chave&num=$obj->numero_kit&p=kits'>
                        <img src='bibliotecas/imagens/adicionar.png' class='supermini' name='adiconar'></a>
                        <a href='bibliotecas/edit_estoque.php?add=0&sub=1&ean=$obj->id&e=$obj->estoque&c=$chave&num=$obj->numero_kit&p=kits'>
                        <img src='bibliotecas/imagens/subtrair.png' class='supermini' name='subtrair'></a>
                        <td> $obj->validade 
                        <td> $obj->custo 
                        <td>$obj->ncm 
                        <td> $obj->cest 
                        <td>$obj->emissao
                        <td style='background-color: rgba(195, 241, 149, 0.485); color: rgba(125, 219, 32, 1);'>".preverMargem($obj->custo, $margem, $tipo)." 
                        <td>$link
                        <td><a href='kits.php?edit=1&id=$obj->id&c=$chave&p=$pag'><img src='bibliotecas/imagens/editar.png' class='supermini'></a><br><a href='confirmacao.php?id=$obj->id&c=$chave&num=$obj->numero_kit'><img src='bibliotecas/imagens/apagar.png' style='padding-top: 5px;'class='supermini' ></a><br><a href = 'produtos.php?c=".$obj->numero_kit."'><img style='padding-top: 5px;'class='supermini' src='bibliotecas/imagens/redirecionar.png'></a>";
                        }else{
                            echo "<tr>
                        <td> $obj->nome_kit  
                        <td> $obj->estoque 
                        <br> 
                        <a href='bibliotecas/edit_estoque.php?add=1&sub=0&ean=$obj->id&e=$obj->estoque&c=$chave&num=$obj->numero_kit&p=kits'>
                        <img src='bibliotecas/imagens/adicionar.png' class='supermini' name='adiconar'></a>
                        <a href='bibliotecas/edit_estoque.php?add=0&sub=1&ean=$obj->id&e=$obj->estoque&c=$chave&num=$obj->numero_kit&p=kits'>
                        <img src='bibliotecas/imagens/subtrair.png' class='supermini' name='subtrair'></a>
                        <td> $obj->validade 
                        <td> $obj->custo 
                        <td>$obj->ncm 
                        <td> $obj->cest 
                        <td>$obj->emissao
                        <td style='background-color: rgba(249, 138, 130, 0.422); color: rgb(235, 59, 46);'>".preverMargem($obj->custo, $margem, $tipo)." 
                        <td>$link
                        <td><a href='kits.php?edit=1&id=$obj->id'><img src='bibliotecas/imagens/editar.png' class='supermini'></a>
                        <br><a href='confirmacao.php?id=$obj->id&c=$chave&num=$obj->numero_kit'><img src='bibliotecas/imagens/apagar.png' style='padding-top: 5px;'class='supermini' ></a>
                        <br><a href = 'produtos.php?c=".$obj->numero_kit."'><img style='padding-top: 5px;'class='supermini' src='bibliotecas/imagens/redirecionar.png'></a>";
                            
                        }
                    }
                }
            }
        }
        ?>
        </table>      
    </div>
</body>
</html>