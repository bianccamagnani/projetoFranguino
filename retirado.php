<?php
$conexao=mysqli_connect("localhost","root","","franguino");
if(!$conexao){
  die("Erro".mysqli_error());
}
if(isset($_POST['botao'])){
  $id=$_POST['idCaixa'];
  $valor=$_POST['valor'];
  $update="UPDATE `tb_caixa` SET `trocoFinal`=$valor WHERE id_caixa=$id";
  $exec=mysqli_query($conexao,$update);
  if($exec){
    header("Location: fecharCaixa.php");
  }
}
?>
