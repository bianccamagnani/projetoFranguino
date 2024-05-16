<?php
session_start();
//instanciar a página do carrinho
$pagina = 'inicio.php';
//iniciar a class
class shopping {
  private $banco = 'franguino';
  private $login = 'root';
  private $hostname = 'localhost';
  //conexao com o banco
function conexao(){
  mysqli_connect($this->hostname, $this->login, '') or die ("Não foi possível conectar ao banco".mysqli_error());

  //mysqli_query("SET NAME 'utf8'");
  //mysqli_query("SET character_set_conection='utf8'");
  //mysqli_query("SET character_set_client='utf8'");
  //mysqli_query("SET character_set_results='utf8'");
}

//mostrar carrinho de compra
function carrinho(){
  $Total=0;
  //verifica se existe uma session
  if($_SESSION){
    //separar nome de quantidade ou valores

    //em cada session vai transformar uma quantidade (nome)

    foreach ($_SESSION as $nome => $quantidade) {
      //verificar se a quantidade não está zerada
      if($quantidade>0){
      if(substr($nome,0,9) == 'produtos_'){
        //limitou a palavra a nove caracteres

        //pegar o id da session
        $id = substr($nome, 9, (strlen($nome) -9));
        //montar Carrinho
        $conexao=mysqli_connect("localhost","root","","franguino");
        $PD = mysqli_query($conexao,"select id_estoque, descricaoProduto, quantidadeEstoque, valorVenda FROM tb_estoque WHERE id_estoque=".$id);
        while($list=mysqli_fetch_array($PD)){
          $subTotal = $quantidade* $list['valorVenda'];
          echo '
          <tr>
            <td> '.$list['descricaoProduto'].'</td>
            <th> '.$quantidade.'x</th>
            <th> '.number_format($list['valorVenda'],2).' </th>
            <td>
            <a href="processa.php?add='.(int)$id.'">
            <button type="button" class="btn btn-outline-secondary"><i class="bi bi-cart-plus"></i></button></a></td>
            <td width ="4" height="4"><a href="processa.php?menos='.(int)$id.'">
            <button type="button" class="btn btn-outline-secondary"><i class="bi bi-cart-dash"></i></button></a></td>
            <td width ="4" height="4"><a href="processa.php?del='.(int)$id.'">
            <button type="button" class="btn btn-outline-danger"><i class="bi bi-trash"></i></button></a></td>
              <th> '.number_format($subTotal,2).' </th>
          </tr>' ;
          $Total+=$subTotal;
        } //ex:   notebook 1 x R$ 15,00 = R$ 15,00
      }
    }

  }



  }
  if($Total == 0){
    echo '
    <tr class="table-success">
      <td> </td>
      <th> <i class="bi bi-cart-x"></i> Seu carrinho está vazio</th>
      </tr> ';
  }else{
    echo '
    <tr class="table-success">
      <td> </td>
      <th> Total: </th>
      <th> '.number_format($Total,2).'</th>
      <th> <a href="completarVenda2.php"><button class="btn btn-outline-success"> <i class="bi bi-check2-square"></i> Finalizar compras</button>
      </a></th>
      </tr>          ';
  }
}
//fim da class
}
//verificacao de adicao
if(isset($_GET['add'])){
  $conexao=mysqli_connect("localhost","root","","franguino");
  $qt = mysqli_query($conexao,
  "select id_estoque, quantidadeEstoque FROM tb_estoque WHERE id_estoque=".$_GET['add']);
$list = mysqli_fetch_array($qt);
if($_SESSION['produtos_'.$_GET['add']] != $list['quantidadeEstoque']){
  $_SESSION['produtos_'.$_GET['add']]+='1';
}

  //produto 1, produto 2....
  header('Location: inicio.php');
}
//verificacao de subtracao
if(isset($_GET['menos'])){
  $_SESSION['produtos_'.$_GET['menos']]--;
  //produto 1, produto 2....
  header('Location:inicio.php');
}
//verificacao de exclusao
if(isset($_GET['del'])){
  $_SESSION['produtos_'.$_GET['del']] = '0';
  //produto 1, produto 2....
  header('Location:inicio.php');
}

?>
