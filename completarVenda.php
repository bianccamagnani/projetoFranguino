<?php
session_start();
if(isset($_POST['enviar'])){
  $totalVenda1=$_POST['total'];
  $id_cliente=$_POST['id_cliente'];
  $cep=$_POST['cep'];
  $rua=$_POST['rua'];
  $numero=$_POST['numero'];
  $bairro=$_POST['bairro'];
  $cidade=$_POST['cidade'];
  $estado=$_POST['uf'];
  $entregaValor=$_POST['valorEntrega'];
  $pagar=$_POST['pago'];
  $pagamento=$_POST['pagamento'];
  if($pagamento=="CartaoDinheiro"){
      $pagamento=3;
  }
  $pagoCartao=$_POST['cartaoPago'];
  $desconto=$_POST['desconto'];
  $totalVenda=$totalVenda1-$pagoCartao;
  date_default_timezone_set('America/Sao_Paulo');
  $timestamp=time();
  $data= date("Y/m/d");
  $endereco="CEP:".$cep."   Rua:".$rua."    Numero:".$numero."   Bairro:".$bairro."  Cidade:".$cidade."   Estado:".$estado;
  if ($pagar==0) {
    $pago = 0;
  }else{
    $pago=1;
  }
  if (isset($_POST['selecionado'])) {
    $entregar = 1;
  }else{
    $entregar= 0;
  }
  $totalreal=$totalVenda-$desconto;
  $conexao=mysqli_connect("localhost","root","","franguino");
  if(!$conexao){
    die("Erro".mysqli_error());
  }
  $vendedor=$_COOKIE['id_usuario'];
  $consulta="select * from tb_clientes where id_cliente=".$id_cliente;
  $telefone= mysqli_query($conexao,$consulta);
  if($desconto<$totalVenda*0.5){
  while($list=mysqli_fetch_array($telefone)){
    $telefoneCliente=$list['telefone_cliente'];
    $today = date("Y-m-d");
    $inserir="insert into tb_vendas(`valor_venda`, `id_vendedor`, `id_cliente`, `status_venda`, `telefone_venda`,
    `radio_entrega`, `entrega_venda`, `valorEntrega`,`tipo_pagamento`,`valorCartao`, `desconto`, `data_venda`) VALUES ('$totalreal',$vendedor,
    $id_cliente,$pago, $telefoneCliente, $entregar, '$endereco', '$entregaValor', $pagamento,'$pagoCartao', '$desconto','$today')";
    $insercaoVenda=mysqli_query($conexao,$inserir);
  }
  $resgateId="select MAX(id_venda) FROM `tb_vendas`";
  $id_ultimaVenda2=mysqli_query($conexao,$resgateId);
  while($linha=mysqli_fetch_array($id_ultimaVenda2)){
    $id_ultimaVenda=$linha['MAX(id_venda)'];
  }
  // $id_ultimaVenda=mysqli_field_tell($id_ultimaVenda2);
  // print_r($id_ultimaVenda);
  foreach ($_SESSION as $nome => $quantidade) {
    //verificar se a quantidade não está zerada
    if(substr($nome,0,9) == 'produtos_'){
      //limitou a palavra a nove caracteres
      //pegar o id da session
      $id = substr($nome, 9, (strlen($nome) -9));
      //montar Carrinho
      $conexao=mysqli_connect("localhost","root","","franguino");
      $insercaoVendas="insert INTO `tb_carrinho`(`quantidade`, `id_produto`, `id_venda`) VALUES ($quantidade,$id,$id_ultimaVenda)";
      $queryFinal=mysqli_query($conexao,$insercaoVendas);
      $consulta3="select quantidadeEstoque from tb_estoque where id_estoque=".$id;
      $quantidadeEstoque= mysqli_query($conexao,$consulta3);
      while($list2=mysqli_fetch_array($quantidadeEstoque)){
        $quantidadeEstoqueFinal=$list2['quantidadeEstoque'] - $quantidade;

        $alteracaoEstoque="UPDATE `tb_estoque` SET `quantidadeEstoque`=".$quantidadeEstoqueFinal." WHERE id_estoque=".$id;
        $queryExclusaoEstoque=mysqli_query($conexao,$alteracaoEstoque);
      }
    }
  }
  session_destroy();
  header('Location:inicio.php');
}else{
  setcookie('msgVenda', '<br><div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>
  Valor de desconto é maior que 50%
  </strong><button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  </div>',  time() + (5));
  header("Location: completarVenda2.php");
}
}


?>
