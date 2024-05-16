<?php
if(isset($_POST['enviar'])){
  $conexao=mysqli_connect("localhost","root","","franguino");
  if(!$conexao){
    die("Erro".mysqli_error());
  }
  $id=$_POST['id'];
  $descricao= mb_strtoupper(addslashes($_POST['descricao']),"utf-8");
  $update="UPDATE `tb_categoriadespesa` SET `nome_categoriaDespesa`='$descricao' WHERE `id_categoriaDespesa`='$id'";
  $exec=mysqli_query($conexao,$update);
  if($exec){
    header("Location: editarCategoriaDespesa.php");
  }
}
?>
