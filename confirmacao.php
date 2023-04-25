<?php
  $id = $_GET['id'];
  $chave = $_GET['c'];
  $num = $_GET['num'];

  if(is_null($num) || $num == '' || empty($num)){
    $txt = 'apagar.php?id=<?php echo $id;?>&c=<?php echo $chave?>?>';
  }else{
    $txt = 'apagar.php?id=<?php echo $id;?>&c=<?php echo $chave?>&num=<?php echo $num?>';
  }

?>

<script type="text/javascript">
      function ConfirmDelete(){
        var decis = confirm("Deseja realmente deletar o produto?");
        if(decis == true)
          window.location.href="apagar.php?id=<?php echo $id;?>&c=<?php echo $chave?>&num=<?php echo $num?>"
        else
        window.history.back();
    }
    ConfirmDelete();
  </script>




  