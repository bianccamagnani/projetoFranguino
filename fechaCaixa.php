<?php
date_default_timezone_set ('America/Sao_Paulo');
$atual = new DateTime();
$today = $atual->format('Y-m-d');
$conexao=mysqli_connect("localhost","root","","franguino");
if(!$conexao){
  die("Erro".mysqli_error());
}
if(isset($_GET['fechar'])){
  $pessoaFechou=$_COOKIE['id_usuario'];
  $resgateId="select MAX(id_caixa) FROM `tb_caixa`";
  $id_ultimaVenda2=mysqli_query($conexao,$resgateId);
  $linha=mysqli_fetch_array($id_ultimaVenda2);
  $id_caixa=$linha['MAX(id_caixa)'];
  $pesquisa="select * from tb_vendas where tipo_pagamento=1 or tipo_pagamento=3";
  $exec2=mysqli_query($conexao,$pesquisa);
  $total=0;
  while($row=mysqli_fetch_array($exec2)){
    $dtVenda=date("Y-m-d",strtotime($row["data_venda"]));
    if($today==$dtVenda){
      $total+=$row['valor_venda'];
    }
  }
  $update="UPDATE `tb_caixa` SET `data_fechamento`='$today',`valor`=$total,`pessoaFechou`=$pessoaFechou WHERE id_Caixa=".$id_caixa;
  $exec=mysqli_query($conexao,$update);
  if($exec){
    header("Location: fecharCaixa.php");
  }
}
?>
