<?php
require_once "connect.php";
include_once "bibliotecas/login.php";
$u = $_POST['usuario'] ?? null;
$s = gerarHash($_POST['senha']) ?? null;

if(is_null($u) || is_null($s)){
    require "user_login_form.php";
}else{
    $q = "Select nome, usuario, senha, tipo from usuarios where usuario = '$u'";
    $busca = $banco->query($q);
    if(!$busca){
        echo "Erro.";
    }else{
        if($busca->num_rows > 0){
            $reg = $busca->fetch_object();
            if(testarHash($s, $reg->senha)){
                echo "Logado com sucesso";
                $_SESSION['nome'];
                $_SESSION['usuario'];
                $_SESSION['tipo'];
            }else{
                echo "Login inválido";
            }
        }{
            echo "Usuário não existe";
        }
        echo "<a href='index.php'><img src='bibliotecas/icones/icoback.png'></a>";
    }
}
?>