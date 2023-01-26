<?php
    require "funcoes.php";
    require "../connect.php"; 
    $quantidade_produtos = $_POST['p'];
    $nome = $_POST['nome'];
    $num = rand(1, 99999);
    $custo = 0;

    for($i=1;$i<$quantidade_produtos;$i++){
        $produto[$i-1] = substr($_POST["produto$i"], 0, strpos($_POST["produto$i"], " |"));

        $query = 'SELECT id, custo, estoque FROM banco WHERE nome LIKE "'.$produto[$i-1].'" AND estoque > 0';
        $result = $banco->query($query);
        $obj = $result->fetch_object();
        
        $custo += $obj->custo;
        $Aux[$i-1] = $obj->estoque;

        $query_2 = "UPDATE banco SET numero_kit = '$num' WHERE id='$obj->id'";
        $banco->query($query_2);
    }
    $estoque = min($Aux);
    $query_3 = "INSERT INTO `teste`.`kits` (`nome_kit`, `estoque`, `numero`, `custo`) VALUES ('$nome', '$estoque', '$num', '$custo')";
    $banco->query($query_3);

    header("Location: ../kits.php");
    exit();
?>