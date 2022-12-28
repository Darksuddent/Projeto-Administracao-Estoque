<link rel="stylesheet" href="bibliotecas/botoes.css">
<?php
function thumb($foto) {
    $arquivo = "$foto";	
    if (is_null($foto) || !file_exists("imagens/$arquivo")){
        return "indisponivel.png";
    } else {
        return $arquivo;
    } 
}
function buscar($pag){
    echo "<form action='$pag.php' method='get'>
    <a href='index.php'><input style='width:auto; margin:0px; padding:10px; cursor: pointer;' type='button' class='orange' value='Menu principal' ></a>
    <input type='text' name='c' style='font-size: 10px; margin-left: 1250px; width: 120px;'>
    <input type='submit' value='Buscar' style='width: auto;'>
    </form>";
}