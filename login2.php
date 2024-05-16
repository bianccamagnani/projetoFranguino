<?php
if(isset($_POST['button'])){
  $conexao=mysqli_connect("localhost","root","","franguino");
  if(!$conexao){
    die("Erro".mysqli_error());
  }
  $email=$_POST['nome'];
  $senha=trim($_POST['senha']);
  $exec= mysqli_query($conexao,"select * FROM `tb_usuario` where email='$email'");
  $dados= mysqli_fetch_array($exec);
  $id_usuario=$dados['id_usuario'];
  $senhaBanco=trim($dados['senha_usuario']);
  if($senha===$senhaBanco){
    header("Location: inicio.php");
    setcookie('id_usuario', $id_usuario, (time() + (3600 * 6))); 
  }else{
    setcookie('msgLogin', '<br><div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>
	  Usuário ou senha incorretos!
		</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	</div>');
    header("Location: login.php");
  }

}
?>
