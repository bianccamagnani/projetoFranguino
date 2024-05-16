<?php
if(isset($_POST['enviar'])){
  $conexao=mysqli_connect("localhost","root","","franguino");
  if(!$conexao){
    die("Erro".mysqli_error());
  }
  $id_cliente=$_POST['id_cliente'];
  $nomeEmpresa= mb_strtoupper($_POST['nomeCliente'],"utf-8" );
  $cpf=$_POST['cpfCliente'];
  $cep=preg_replace('/[^\p{L}\p{N}\s]/','',$_POST['cep']);
  $rua=ucwords(mb_strtolower($_POST['rua'], "utf-8"));
  $numero=$_POST['numero'];
  $bairro=ucfirst(mb_strtolower($_POST['bairro']));
  $cidade=ucfirst(mb_strtolower($_POST['cidade']));
  $estado=strtoupper($_POST['uf']);
  $telefone=$_POST['telCliente'];
  $contato=ucfirst(mb_strtolower($_POST['emailCliente']));
  $endereco="CEP:".$cep."   Rua:".$rua."    Numero:".$numero."   Bairro:".$bairro."  Cidade:".$cidade."   Estado:".$estado;
  $update="UPDATE `tb_clientes` SET`nome_cliente`='$nomeEmpresa',`telefone_cliente`='$telefone',
  `endereço_cliente`='$endereco',`cpf_cliente`='$cpf',`email`='$contato' WHERE id_cliente=".$id_cliente;
  $exec=mysqli_query($conexao,$update);
  if($exec){
    header("Location: alteracaoCliente.php");
  }
}
?>
