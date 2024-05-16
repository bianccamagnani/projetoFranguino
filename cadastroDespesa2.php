<?php
if(isset($_POST['enviar'])){
	$data=$_POST['dataDespesa'];
	$fornecedor=$_POST['fornecedorDespesa'];
	$categoria=$_POST['categoriaDespesa'];
	$valor=$_POST['valorDespesa'];
	$vencimento=$_POST['vencimentoDespesa'];
	$pago=$_POST['situacaoDespesa'];
	$porQuantidade=$_POST['porQuantidade'];
	$quantidade=$_POST['quantidade'];
	$obs=$_POST['obs'];
	$descricao=$_POST['descricao'];
	$indeterminada = $_POST['vencimentoIndeterminado'];
	if(isset($indeterminada)){
		$vencimento = '1970-01-01';
	}
	if ($pago==0) {
		$situacao = "nao";
	}else{
		$situacao="sim";
	}
	if ($porQuantidade==0) {
		$porQuantidade = "nao";
	}else{
		$porQuantidade="sim";
	}
	$con=mysqli_connect("localhost",
	"root","","franguino");
	if(!$con){
		die("Erro".mysqli_error());
	}
	$inserir="INSERT INTO `tb_despesa`(`data_despesa`,
		`id_fornecedor`, `id_categoriaDespesa`, `valorDespesa`,`vencimentoDespesa`,`situacao`, `porQuantidade`, `quantidade`, `descricao`, `observacao`) VALUES
		('$data',$fornecedor,'$categoria',$valor,'$vencimento', '$situacao', '$porQuantidade', '$quantidade', '$descricao', '$obs')";
		$exec=mysqli_query($con,$inserir);
		if($exec){
			setcookie('msg', '<br><div class="alert alert-success alert-dismissible fade show" role="alert">
			<strong>
			Despesa cadastrada com sucesso
			</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>',  time() + (5));
			header("Location: cadastroDespesa.php");
		}
	}
	if(isset($_POST['categoria'])){
		$con=mysqli_connect("localhost",
		"root","","franguino");
		if(!$con){
			die("Erro".mysqli_error());
		}
		$descricao=mb_strtoupper(addslashes($_POST['descricaoCategoria']));
		$pesquisar="SELECT * FROM tb_categoriadespesa WHERE soundex(nome_CategoriaDespesa) = soundex('$descricao')";
		$exec2=mysqli_query($con,$pesquisar);
		$teste=mysqli_fetch_array($exec2);
		if($teste){
			setcookie('msgCategoria', '<br><div class="alert alert-danger alert-dismissible fade show" role="alert">
			<strong>
			Essa categoria já existe!
			</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>',  time() + (5));
			header("Location: cadastroDespesa.php");

		}else{
			$inserir="INSERT INTO `tb_categoriadespesa`(`nome_CategoriaDespesa`) VALUES ('$descricao')";
			$exec=mysqli_query($con,$inserir);
			setcookie('msgCategoria', '<br><div class="alert alert-success alert-dismissible fade show" role="alert">
			<strong>
			Categoria cadastrada com sucesso
			</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>',  time() + (5));
			header("Location: cadastroDespesa.php");

		}
	}
	?>
