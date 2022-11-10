<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php
    require_once "connect.php";

    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabela teste</title>
</head>
<body>
    <div name='tabela' >
        <table border='5'>
        <tr><td>Nome<td>Ean
        <?php
        $query = "SELECT * from banco"; 
        if($result = $banco->query($query)){
            while($obj = $result->fetch_object()){
                echo "<tr><td> $obj->nome <td> $obj->ean";
            }
        }
        ?>
        </table>      
    </div>
</body>
</html>