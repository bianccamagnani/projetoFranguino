<?php
$conexao=mysqli_connect("localhost","root","","franguino");
if(!$conexao){
  die("Erro".mysqli_error());
}
$resultado = '';
if(isset($_POST['venda_id'])){
  $pesquisa="Select * from tb_vendas where id_venda='". $_POST['venda_id'] ."' LIMIT 1 ";
  $exec=mysqli_query($conexao, $pesquisa);
  $linha=mysqli_fetch_assoc($exec);
  $pesquisa2="Select * from tb_carrinho where id_venda=".$_POST['venda_id'];
  $exec2=mysqli_query($conexao, $pesquisa2);
  $resultado .= '<dl class="row">';
  $resultado .= '<dt class="col-sm-3"><p>     Valor da venda </p></dt> ';
  $resultado .= '<dd class="col-sm-9"> R$ '. number_format(($linha['valor_venda']+$linha['valorCartao']),2) .' </dd>';
  $resultado .= '<dt class="col-sm-3">    Produtos</dt> ';
    $resultado .= '</dl>';
  while($linha2=mysqli_fetch_assoc($exec2)){
    $pesquisa3="Select * from tb_estoque where id_estoque=".$linha2['id_produto'];
    $exec3=mysqli_query($conexao, $pesquisa3);
    while($linha3=mysqli_fetch_assoc($exec3)){
      $resultado .= '--------------------------------------';
      $resultado .= '<dd class="col-sm-9"> '. $linha3['descricaoProduto'] .' </dd>';
      $resultado .= '<dt class="col-sm-3">    Quantidade </dt> ';
      $resultado .= '<dd class="col-sm-9"> '. $linha2['quantidade'] .' </dd>';

  }
  }
  $resultado .= '</br>';
  echo $resultado;

}
?>
