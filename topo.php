<?php
require_once "bibliotecas/login.php";

echo"<p class='pequeno'>";
if(empty($_SESSION['user'])){
    echo "<a href='user_login.php' text-align='right'>Entrar</a>";
}else{
    echo "Bem vindo(a) <strong>". $_SESSION['nome']. "</strong>.";
}
echo "</p>";
?>