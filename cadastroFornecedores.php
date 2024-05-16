<?php
if(isset($_POST['enviar'])){
	$nome=mb_strtoupper(addslashes($_POST['nomefornecedor']),"utf-8");
	$cnpj=$_POST['cnpjfornecedor'];
	$cep=preg_replace('/[^\p{L}\p{N}\s]/','',$_POST['cep']);
	$rua=ucwords(mb_strtolower($_POST['rua'], "utf-8"));
	$numero=$_POST['numero'];
	$bairro=ucfirst(mb_strtolower($_POST['bairro'], "utf-8"));
	$cidade=ucfirst(mb_strtolower($_POST['cidade'], "utf-8"));
	$estado=strtoupper($_POST['uf']);
	$telefone=$_POST['telfornecedor'];
	$contato=addslashes($_POST['contatofornecedor']);
	$obs=addslashes($_POST['obsFornecedor']);
	$endereco="CEP:".$cep."   Rua:".$rua."    Numero:".$numero."   Bairro:".$bairro."  Cidade:".$cidade."   Estado:".$estado;
	$con=mysqli_connect("localhost",
	"root","","franguino");
	if(!$con){
		die("Erro".mysqli_error());
	}
	$inserir="INSERT INTO `tb_fornecedores`(`nome_empresa`,
		`cnpj_empresa`, `endereco_empresa`, `telefone_empresa`,`contato_empresa`,`observacao_empresa`) VALUES
		('$nome','$cnpj','$endereco','$telefone','$contato', '$obs')";
		$exec=mysqli_query($con,$inserir);
		if($exec){
			setcookie('msg', '<br><div class="alert alert-success alert-dismissible fade show" role="alert">
		<strong>
		 Fornecedor cadastrado com sucesso
			</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>',  time() + (5));
			header("Location: cadastroFornecedores2.php");
		}
	}

?>
