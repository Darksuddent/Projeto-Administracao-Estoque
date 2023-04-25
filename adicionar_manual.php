<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
    include "connect.php";
    $produtos = $_POST["prods"];?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bibliotecas/style.css">
    <style>
        input{
            width: auto;
        }
    </style>
    <title>Cadastro Manual</title>
</head>
<body>
    <table>
        <div class="form_add">
            <h1>Cadastrar Produtos</h1>
            <?php 
            if(is_null($produtos) || empty($produtos)){
                echo "<form method='post' action='adicionar_manual.php'>
                Quantidade de produtos: <input type='number' style='width: auto;' name='prods' id='prods'><br><br>
                <input type='submit' formmethod='post' value='Confirmar'>
            </form>";
            }
            else{
                echo "<form method='post' action='adicionar_manual.php'>";
                for($i=0; $i<$produtos; $i++){
                    echo"
                    <h2>Produto ".($i+1)."</h2>
                    <h4 style='margin-left: 25px;'>Nome do produto: <input style='margin-left: 25px;' type='text' name='nome$i'></h4>
                    <h4 style='margin-left: 25px;'>EAN do produto: <input style='margin-left: 37px;' type='text' name='ean$i'></h4>
                    <h4 style='margin-left: 25px;'>NCM: <input style='margin-left: 123px;' type='text' name='ncm$i'></h4>
                    <h4 style='margin-left: 25px;'>Categoria: <input style='margin-left: 85px;' type='text' name='ncm$i'></h4>
                    <h4 style='margin-left: 25px;'>CEST: <input style='margin-left: 117px;' type='text' name='cest$i'></h4>
                    <h4 style='margin-left: 25px;'>Estoque do produto: <input style='margin-left: 5px;' type='text' name='estoque$i'></h4>
                    <h4 style='margin-left: 25px;'>Custo Unitário: <input style='margin-left: 45px;' type='text' name='custo$i'></h4>
                    <h4 style='margin-left: 25px;'>Validade: <input style='margin-left: 92px;' type='text' name='validade$i'></h4>
                    ";
                }
            }
            ?>
        </div>
    </table>
</body>
</html>