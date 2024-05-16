<?php
session_start();
if(isset($_POST['enviar'])){
	$usuario=$_POST['usuario'];
	$dataCadastro=$_POST['dateEstoqueCadastro'];
	$validade=$_POST['dateEstoqueValidade'];
	$categoria=$_POST['categoriaEstoque'];
	$descricao=mb_strtoupper(addslashes($_POST['descricao']), "utf-8");
	$custo=$_POST['custo'];
	$venda=$_POST['valorVenda'];
	$quantidade=$_POST['quantidade'];
	$con=mysqli_connect("localhost",
	"root","","franguino");
	if(!$con){
		die("Erro".mysqli_error());
	}
	setcookie('msg');
	if ($quantidade==""){
		setcookie('msg', '<br><div class="alert alert-danger alert-dismissible fade show" role="alert">
	<strong>
		Quantidade é igual a zero!
		</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>',  time() + (5));
	header("Location: cadastroEstoque2.php");
	}
	elseif($custo<$venda){
	$inserir="INSERT INTO `tb_estoque`(`data_cadastroEstoque`, `data_validadeProduto`,
		`categoriaEstoque`, `descricaoProduto`, `quantidadeEstoque`, `id_usuario`, `custoProduto`, `valorVenda`)
		VALUES ('$dataCadastro','$validade',$categoria,'$descricao','$quantidade','$usuario','$custo','$venda')";
		$exec=mysqli_query($con,$inserir);
		if($exec){
			header("Location: cadastroEstoque2.php");
			setcookie('msg','<br><div class="alert alert-success alert-dismissible fade show" role="alert">
	  <strong>
		  Estoque registrado com sucesso!
			</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>',  time() + (5));
		}
	}else{
		setcookie('msg', '<br><div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>
	  Valor de custo é maior que o de venda
		</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	</div>',  time() + (5));
	header("Location: cadastroEstoque2.php");
	}
	}
	if(isset($_POST['categoria'])){
		$con=mysqli_connect("localhost",
		"root","","franguino");
		if(!$con){
			die("Erro".mysqli_error());
		}

		$descricao=mb_strtoupper(addslashes($_POST['descricaoCategoria']),"utf-8");
		$pesquisar="SELECT * FROM categoriaestoque WHERE soundex(nomeCategoriaEstoque) = soundex('$descricao')";
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
		header("Location: cadastroEstoque2.php");
		}else{
	 		$inserir="INSERT INTO `categoriaestoque`(`nomeCategoriaEstoque`) VALUES ('$descricao')";
				$exec=mysqli_query($con,$inserir);

					setcookie('msgCategoria', '<br><div class="alert alert-success alert-dismissible fade show" role="alert">
			  <strong>
				 Categoria cadastrada com sucesso!
					</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>',  time() + (5));
					header("Location: cadastroEstoque2.php");

		}
}

	?>
