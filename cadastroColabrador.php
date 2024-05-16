<?php
	if(isset($_POST['enviar'])){
		$email=trim(strtolower($_POST['email']));
		$nome=$_POST['nome'];
		$senha=trim(strtolower($_POST['senha']));
		$con=mysqli_connect("localhost",
							"root","","franguino");
		if(!$con){
			die("Erro".mysqli_error());
		}
		$inserir="INSERT INTO `tb_usuario`(`nome_usuario`, `senha_usuario`, `tipo_usuario`, `email`)
    VALUES ('$nome','$senha',2,'$email')";
		$exec=mysqli_query($con,$inserir);
		if($exec){
			setcookie('msg', '<br><div class="alert alert-success alert-dismissible fade show" role="alert">
		<strong>
		 Colaborador cadastrado com sucesso
			</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>',  time() + (5));
    header("Location: cadastroColaboradores.php");
		}
    }
?>
