<?php
if(isset($_POST['enviar'])){
  $id=$_POST['id_despesa'];
  $data=$_POST['dataDespesa'];
  $fornecedor=$_POST['fornecedorDespesa'];
  $categoria=$_POST['categoriaDespesa'];
  $valor=$_POST['valorDespesa'];
  $vencimento=$_POST['vencimentoDespesa'];
  $pago=$_POST['situacaoDespesa'];
  $porQuantidade=$_POST['porQuantidade'];
  $quantidade=$_POST['quantidade'];
  $obs=ucwords(mb_strtolower(addslashes($_POST['obs']), "utf-8"));
  $descricao= mb_strtoupper(addslashes($_POST['descricao']), "utf-8");
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
  $inserir="UPDATE `tb_despesa` SET `data_despesa`='$data',
            `id_fornecedor`='$fornecedor',`id_categoriaDespesa`='$categoria',`valorDespesa`='$valor',`vencimentoDespesa`='$vencimento',
  `situacao`='$situacao',`porQuantidade`='$porQuantidade',`quantidade`='$quantidade',`descricao`='$descricao',`observacao`='$obs' WHERE id_despesa='$id'";
  $exec=mysqli_query($con,$inserir);
  print_r($exec);
  if($exec){
  header("Location: alteracaoDespesa.php");
  }
  }
?>
