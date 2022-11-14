<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bibliotecas/style.css">
    <style>
        input{
            width: auto;
        }
    </style>
    <title>Document</title>
</head>
<body>
    <table>
        <div class="form_add">
            <h1>Adicionar Produto</h1>
            <form method="post" action="bibliotecas/cadastro.php">
                Nome: <input type="text" name='nome'><br><br>
                EAN: <input type="text" name='ean'><br><br>
                Categoria: <select name="tipo" id="tipo">
                    <option value="Teste 1">Teste 1</option>
                    <option value="2 Teste">2 Teste</option>
                    <option value="Test 3">Test 3</option>
                </select><br><br>
                Imagem: <input type="file" name='imagem' accept="image/png, image/jpeg"><br><br>
                <input type="submit" formmethod="post" value="Confirmar">
            </form>
        </div>
    </table>
</body>
</html>