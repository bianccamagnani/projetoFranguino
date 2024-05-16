<?php
if(isset($_POST['enviar'])){
  $conexao=mysqli_connect("localhost","root","","franguino");
  if(!$conexao){
    die("Erro".mysqli_error());
  }
  $id=$_POST['id_cliente'];
  $nome= ucwords(mb_strtolower($_POST['nome']));
  $email=mb_strtolower($_POST['email']);
  $senhaAnt=$_POST['senhaAntiga'];
  $senhaAtual=$_POST['senha'];
  $resenha=$_POST['resenha'];
  $result_cliente = "select * FROM `tb_usuario` where id_usuario=".$id;
  $resultado_cliente = mysqli_query($conexao, $result_cliente);
  $lista = mysqli_fetch_array($resultado_cliente);
  $senha = $lista['senha_usuario'];
  if($senhaAtual ==""){
    $update="UPDATE `tb_usuario` SET `nome_usuario`='$nome',`email`='$email' WHERE `id_usuario`='$id'";
    $exec=mysqli_query($conexao,$update);
    if($exec){
      setcookie('msgColaborador','</br><div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>
      Atualizado com sucesso!
      </strong><button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>', time() + (5));
      header("Location: alteracaoColaboradores.php");
    }
}elseif($senhaAtual==$resenha & $senhaAnt==$senha){
    $update="UPDATE `tb_usuario` SET `nome_usuario`='$nome',`senha_usuario`='$resenha',`email`='$email' WHERE `id_usuario`='$id'";
    $exec=mysqli_query($conexao,$update);
    if($exec){
      setcookie('msgColaborador','<br><div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>
      Atualizado com sucesso!
      </strong><button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>',  time() + (5));
      header("Location: alteracaoColaboradores.php");
    }
  }else{
    header("Location: alteracaoColaboradores.php");
    setcookie('msgColaborador', '<br><div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>
	  Algum dado não corresponde
		</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	</div>', time() + (5));
  }
}
?>
