<?php
if(isset($_POST['enviar'])){
  $conexao=mysqli_connect("localhost","root","","franguino");
  if(!$conexao){
    die("Erro".mysqli_error());
  }
  $id_fornecedor=$_POST['id_fornecedor'];
  $nomeEmpresa=addslashes(mb_strtoupper($_POST['nomefornecedor'],"utf-8"));
  $cnpj=$_POST['cnpjfornecedor'];
  $cep=preg_replace('/[^\p{L}\p{N}\s]/','',$_POST['cep']);
  $rua=ucwords(mb_strtolower($_POST['rua'], "utf-8"));
  $numero=$_POST['numero'];
  $bairro=ucfirst(mb_strtolower($_POST['bairro'], "utf-8"));
  $cidade=ucfirst(mb_strtolower($_POST['cidade'], "utf-8"));
  $estado=strtoupper($_POST['uf']);
  $telefone=$_POST['telfornecedor'];
  $contato=addslashes(mb_strtoupper($_POST['contatofornecedor'], "utf-8"));
  $obs=addslashes(mb_strtoupper($_POST['obsFornecedor'], "utf-8"));
  $endereco="CEP:".$cep."   Rua:".$rua."    Numero:".$numero."   Bairro:".$bairro."  Cidade:".$cidade."   Estado:".$estado;
  $update="UPDATE `tb_fornecedores` SET `nome_empresa`='$nomeEmpresa',`cnpj_empresa`='$cnpj',
`endereco_empresa`='$endereco',`telefone_empresa`='$telefone',`contato_empresa`='$contato',`observacao_empresa`='$obs' WHERE id_fornecedores=".$id_fornecedor;

  $exec=mysqli_query($conexao,$update);

  if($exec){
    header("Location: alteracaoFornecedores.php");
  }
}
?>
