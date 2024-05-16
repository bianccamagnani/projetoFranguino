<?php
	if(isset($_POST['enviar'])){
		// letras em maiusculo mb_strtoupper ($string,"utf-8" );
		//letras em minusculo strtolower
		// primeira letra em minusculo ucfirst
		// em minusculo mb_strtolower ($string,"utf-8" );
		$nome=mb_strtoupper ($_POST['nomeCliente'],"utf-8" );
		$telefone=$_POST['telefone'];
		$cep=preg_replace('/[^\p{L}\p{N}\s]/','',$_POST['cep']);
		$rua= ucwords(mb_strtolower($_POST['rua'], "utf-8"));
    $numero=$_POST['numero'];
    $bairro=ucfirst(mb_strtolower($_POST['bairro'],"utf-8"));
		$cidade=ucfirst(mb_strtolower($_POST['cidade'],"utf-8"));
    $estado=strtoupper($_POST['uf']);
    $cpf=$_POST['cpfCliente'];
		$email=mb_strtolower($_POST['emailCliente'], "utf-8");
    $endereco="CEP: ".$cep."  Rua: ".$rua."  Numero: ".$numero."  Bairro: ".$bairro." Cidade: ".$cidade."  Estado: ".$estado;
		$con=mysqli_connect("localhost",
							"root","","franguino");
		if(!$con){
			die("Erro".mysqli_error());
		}
		$inserir="INSERT INTO `tb_clientes`(`nome_cliente`, `telefone_cliente`,
      `endereço_cliente`, `cpf_cliente`, `email`) VALUES ('$nome','$telefone','$endereco','$cpf','$email')";
		$exec=mysqli_query($con,$inserir);
		if($exec){
			setcookie('msgCliente', '<br><div class="alert alert-success alert-dismissible fade show" role="alert">
	  <strong>
		  Cadastrado com sucesso!
			</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>',  time() + (5));
      header("Location: cadastroCliente2.php");
		}
    }

?>
