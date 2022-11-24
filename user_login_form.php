<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bibliotecas/style.css">
    <title>Document</title>
    <style>
        div.corpo{
            width: 300px;
        }
    </style>
</head>
<body>
    <form action="user_login.php" method="post">
        <div class='corpo'><h1>Login</h1>
            <p>Usuário: <input type="text" style="width: 70px;" name="usuario" id="usuario"></p>
            <p>Senha: <input type="password" style="width: 70px; margin-left:9px;" name="senha" id="senha"></p>
            <input type="submit" style='width:auto;' value="Confirmar">
        </div>
    </form>
    <?php
    ?>
</body>
</html>