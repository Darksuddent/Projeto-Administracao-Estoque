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
    <title>Adicionar XML</title>
</head>
<body>
    <table>
        <div class="form_add">
            <h1>Adicionar Produto</h1>
            <form method="post" action="bibliotecas/dados.php">
                Arquivo NFe: <input type="file" style='width: auto;' name="xml" id="xml" accept=".xml"><br><br>
                <input type="submit" formmethod="post" value="Confirmar">
            </form>
        </div>
    </table>
</body>
</html>