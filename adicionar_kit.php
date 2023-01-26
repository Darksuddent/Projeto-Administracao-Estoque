<!DOCTYPE html>
    <html lang="en">
        <?php 
            require "bibliotecas/funcoes.php";
            require "connect.php";
            $prods = 1;
            if(is_null($_GET['p']) || empty($_GET['p'])){
                $prods = $_GET['p'];
            }else{
                $prods = $_GET['p'];
            }
        ?> 
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="bibliotecas/style.css">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Adicionar Kit</title>
        </head>
        <body>
            <div class='corpo'>
                <table>
                    <td><h1>Adicionar Kit</h1>
                    <tr><td><h4 style='margin-left: 5px;'>Adicionar mais um produto: </h4>
                    <td><a style='margin-left: 20px;' href='adicionar_kit.php?p=<?php echo $prods+1;?>'>
                    <img src='bibliotecas/imagens/adicionar.png'></a>
                    <td><h4 style='margin-left: 160px;'>Remover um produto: </h4>
                    <td><a style='margin-left: 20px;' href='adicionar_kit.php?p=<?php echo $prods-1;?>'>
                    <img src='bibliotecas/imagens/subtrair.png' style='width: 37px;'></a>
                </table>
                <form action='bibliotecas/cadastro_kit.php' method='post'>
                    Nome do Kit: <input style='margin-left: 15px; width: 450px;' type="text" name="nome">
                    <?php
                        for($i=1;$i<$prods+1;$i++){
                            echo "<br><br>Produto $i:<input style='margin-left: 37px; width: 450px;' name='produto$i' list='brow'>
                            <datalist id='brow'>";
                            $query = 'SELECT nome, ean FROM banco WHERE estoque > 0 ORDER BY nome'; 
                                if($result = $banco->query($query)){
                                    while($obj = $result->fetch_object()){
                                        echo "<option value='$obj->nome | $obj->ean'>";
                                    }
                                }
                            echo " </datalist>";
                        }
                    ?>
                    <input type="hidden" name="p" value='<?php echo $i;?>'>
                    <br><br><input style='font-size: 23px;width: auto;margin-left:300px;' type="submit" value="Cadastrar">
                </form>  
            </div>
        </body>
    </html>