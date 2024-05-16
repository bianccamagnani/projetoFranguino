<?php
if(isset($_POST['enviar'])){
  $conexao=mysqli_connect("localhost","root","","franguino");
  if(!$conexao){
    die("Erro".mysqli_error());
  }
  $id_estoque=$_POST['id_estoque'];
  $usuario=$_POST['usuario'];
  $dataCadastro=$_POST['dateEstoqueCadastro'];
  $validade=$_POST['dateEstoqueValidade'];
  $categoria=$_POST['categoriaEstoque'];
  $descricao=mb_strtoupper(addslashes($_POST['descricao']));
  $custo=$_POST['custo'];
  $valor=$_POST['valorVenda'];
  $quantidade=$_POST['quantidade'];
  setcookie('msg');
  if ($quantidade==0 or $quantidade==""){
    setcookie('msg', '<br><div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>
    Quantidade é igual a zero!
    </strong><button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>',  time() + (5));
  header("Location: editarEstoque.php?alterar=".$id_estoque);
}elseif($custo<$valor){
  $update="UPDATE `tb_estoque` SET `data_cadastroEstoque`='$dataCadastro',`data_validadeProduto`='$validade',
  `categoriaEstoque`=$categoria,`descricaoProduto`='$descricao',
  `quantidadeEstoque`=$quantidade,`id_usuario`=$usuario,`custoProduto`=$custo,`valorVenda`=$valor
  WHERE id_estoque=".$id_estoque;
  $exec=mysqli_query($conexao,$update);
    if($exec){
    header("Location: alteracaoEstoque.php");
}
}else{
  setcookie('msg', '<br><div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong>
  Valor de custo é maior que o de venda
  </strong><button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>',  time() + (5));
header("Location: editarEstoque.php?alterar=".$id_estoque);
}
}
?>
