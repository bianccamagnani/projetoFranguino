<?php
if($_COOKIE['id_usuario']==''){
  HEADER("Location:login.php");
}
date_default_timezone_set ('America/Sao_Paulo');
$atual = new DateTime();

$conexao=mysqli_connect("localhost","root","","franguino");
if(!$conexao){
  die("Erro".mysqli_error());
}
$result_cliente = "select * FROM `tb_usuario` where id_usuario=".$_COOKIE['id_usuario'];
$resultado_cliente = mysqli_query($conexao, $result_cliente);
$lista = mysqli_fetch_array($resultado_cliente);
$tipoUsuario=$lista['tipo_usuario'];
if($tipoUsuario!=1){
  header("location: inicio.php");
}
?>
<!DOCTYPE HTML>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Relatórios</title>
  <link rel="icon" type="imagem/jpeg" href="img/franguinoLogo.jpeg" />
  <style type="text/css">
  ul{
    list-style-type:none;
  }
  ::-webkit-scrollbar {
    width: 5px;
  }

  ::-webkit-scrollbar-thumb {
    -webkit-border-radius: 5px;
    border-radius: 5px;
    background: #b3e6b3;
    -webkit-box-shadow: inset 0 0 6px #b3e6b3;
  }
  </style>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Franguino</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/simple-sidebar.css" rel="stylesheet">

</head>
<body>
  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="list-group list-group-flush">
        <ul "dropdown-menu " role="menu" >
          <p>
            <?php
            $result_cliente = "select * FROM `tb_usuario` where id_usuario=".$_COOKIE['id_usuario'];
            $resultado_cliente = mysqli_query($conexao, $result_cliente);
            $lista = mysqli_fetch_array($resultado_cliente);
            $tipoUsuario=$lista['tipo_usuario'];?>
            <li class="nav-item" aria-labelledby="dropdownMenu">
              <a class="btn btn-light border border-dark" href="inicio.php"> Venda</a>
              <a class="btn btn-danger" href="sair.php"><i class="bi bi-box-arrow-in-left"> Sair</i></a>
              <?php if($tipoUsuario==1){?>
                <li><i class="bi bi-stack"></i> Estoque
                  <ul>
                    <li><a class="btn btn-light border border-dark btn-sm" href="cadastroEstoque2.php">Cadastro </a></li>
                    <p>
                      <li><a class="btn btn-light border border-dark btn-sm" href="alteracaoEstoque.php">Modificação</a></li>
                    </p>
                  </ul>
                </li>
              <?php } if($tipoUsuario==1){?>
                <li><i class="bi bi-bag-dash"></i> Despesa
                  <ul>
                    <li><a class="btn btn-light border border-dark btn-sm" href="cadastroDespesa.php">Cadastro</a></li>
                    <p><li><a class="btn btn-light border border-dark btn-sm" href="alteracaoDespesa.php">Modificação</a></li>
                    </p>
                  </ul>
                </li><?php }?>
                <li><i class="bi bi-basket2"></i> Venda
                  <ul>
                    <li><a class="btn btn-light border border-dark btn-sm" href="alteracaoVenda.php">Modificação</a></li>
                  </ul>
                </li>
                <li><i class="bi bi-cash-stack"></i> Caixa
                  <ul>
                          <li><a <a class="btn btn-light border border-dark btn-sm" href="posicao.php">Posição do caixa</a></li>
                          <p><li><a <a class="btn btn-light border border-dark btn-sm" href="sangria.php">Sangria</a></li></p>
                          <p><li><a <a class="btn btn-light border border-dark btn-sm" href="fecharCaixa.php">Fechar/Abrir</a></li></p>
                          <?php if($tipoUsuario==1){?>
                          <p><li><a class="btn btn-light border border-dark btn-sm" href="faturamento.php">Faturamento</a></li></p>
                        <?php } ?>
                  </ul>
                </li>
                <li><i class="bi bi-person-lines-fill"></i> Clientes
                  <ul>
                    <li><a class="btn btn-light border border-dark btn-sm" href="cadastroCliente2.php">Cadastro</a></li>
                    <p><li><a <a class="btn btn-light border border-dark btn-sm" href="alteracaoCliente.php">Modicação</a></li>
                    </p>
                  </ul>
                </li>
                <?php if($tipoUsuario==1){?>
                  <li><i class="bi bi-truck"></i> Fornecedores
                    <ul>
                      <li><a  class="btn btn-light border border-dark btn-sm" href="cadastroFornecedores2.php">Cadastro</a></li>
                      <p>  <li><a class="btn btn-light border border-dark btn-sm" href="alteracaoFornecedores.php">Modificação</a></li>
                      </p>
                    </ul>
                  </li>
                <?php }?>
                <li>  <i class="bi bi-people-fill"></i> Colaboradores
                  <ul>
                    <?php
                    if($tipoUsuario==1){?>
                      <li><a class="btn btn-light border border-dark btn-sm" href="cadastroColaboradores.php">Cadastro</a></li>
                    <?php }?>
                    <p>  <li><a class="btn btn-light border border-dark btn-sm" href="alteracaoColaboradores.php">Alterar perfil</a></li>
                    </p>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
          <div id="page-content-wrapper">

            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
              <button class="btn btn-secondary" id="menu-toggle"><i class="bi bi-list"></i></button>

              <div class="col">
                <a href="faturamentoLiquido.php"><button type="button" class="btn btn-outline-secondary">Faturamento líquido</button></a>
                <a href="dataFaturamento.php"><button type="button" class="btn btn-outline-secondary">Valores vendidos</button></a>

                <a href="itens.php"><button type="button" class="btn btn-outline-secondary">Quantidade de itens vendidos</button></a>

              </div>
            </nav>

            <div class="container-fluid justify-content-center col-6">
              <br>

              <form action="relatorios.php" method="POST">
                <div class="row">
                  <div class="form-group">
                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label for="dataCadastro">De: </label>
                        <input class="form-control" value="<?php echo date("Y-m-d");?>" type="date"  id="dataInicial" name="dataInicial">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="dataValidade">Até:</label>
                        <input class="form-control" type="date" value="<?php echo date("Y-m-d");?>" id="vencimentoDespesa" name="dataFinal">
                      </div>
                      <div class="form-group col-md-4">
                        <label>Tipos de relatórios:</label>
                        <select class="form-control"  name="escolha" id="escolha">
                          <option value="1">Vendas</option>
                          <option value="2">Estoque</option>
                          <option value="3">Caixa</option>
                          <option value="4">Retirada do caixa</option>
                        </select>
                      </div>
                      <div class="form-group col-4">
                        <br>
                        <p>
                          <input type="submit" class="btn btn-outline-success" value="Gerar" name="enviar">
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
              <?php
              if(isset($_POST['enviar'])){
                if($_POST['escolha']==1){
                  // SELECT * FROM Tabela WHERE Status = 1 AND Data > '2017-01-01' AND Data < '2017-01-17
                  //SELECT * FROM TABELA WHERE status='1' and data between '2017-01-13' and '2017-01-20';
                  $totalDinheiro = 0;
                  $quebra = chr(13).chr(10);
                  $totalSangria = 0;
                  $totalTroco= 0;
                  $dataInicio = $_POST['dataInicial'];
                  $dataFim = $_POST['dataFinal'];
                  $dataInicioArq=date('d-m-Y', strtotime($dataInicio));
                  $dataFimArq=date('d-m-Y', strtotime($dataFim));
                  if(file_exists("docs/'$dataInicioArq'  a  '$dataFimArq' - Vendas.txt")){
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Este arquivo já existe!</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>';
                  }else{
                    $arquivo = fopen("docs/'$dataInicioArq'  a  '$dataFimArq' - Vendas.txt","a");
                    $resultCaixa = "select * FROM `tb_caixa` where (data_abertura between '$dataInicio' and '$dataFim')";
                    $resultadoCaixa = mysqli_query($conexao, $resultCaixa);
                    while($caixa = mysqli_fetch_array($resultadoCaixa)){
                      fwrite($arquivo,"______________________________________".$quebra."Data: ".$caixa['data_abertura'].$quebra);
                      $resultVendas = "select * FROM `tb_vendas` where (data_venda between '$dataInicio' and '$dataFim')";
                      $resultadoVendas = mysqli_query($conexao, $resultVendas);
                      while($venda = mysqli_fetch_array($resultadoVendas)){
                        $id_venda=$venda['id_venda'];
                        $resultCarrinho = "select * FROM `tb_carrinho` where id_venda='$id_venda'";
                        $resultadoCarrinho = mysqli_query($conexao, $resultCarrinho);
                        fwrite($arquivo, "--------------------------------".$quebra);
                        while($Carrinho = mysqli_fetch_array($resultadoCarrinho)){
                          $id_carrinho=$Carrinho['id_produto'];
                          $resultProduto = "select * FROM `tb_estoque` where id_estoque='$id_carrinho'";
                          $resultadoProduto = mysqli_query($conexao, $resultProduto);
                          while($produto = mysqli_fetch_array($resultadoProduto)){
                            fwrite($arquivo, "Produto: ".$produto['descricaoProduto'].$quebra."Quantidade: ".$Carrinho['quantidade'].$quebra);

                          }
                        }
                        fwrite($arquivo, $quebra."Valor: R$ ".$venda['valor_venda'].$quebra);

                      }
                    }
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Arquivo gerado com sucesso!</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>';
                  }
                }elseif($_POST['escolha']==2){

                  $quebra = chr(13).chr(10);
                  $timestamp=time();
                  $data= date("d-m-Y");
                  if(file_exists("docs/'$data' - Estoque.txt")){
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Este arquivo já existe!</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>';
                  }else{
                    $arquivo = fopen("docs/'$data' - Estoque.txt","a");
                    $resultEstoque = "select * FROM `tb_estoque` where quantidadeEstoque!=0";
                    $resultadoEstoque = mysqli_query($conexao, $resultEstoque);
                    while($Estoque = mysqli_fetch_array($resultadoEstoque)){
                      fwrite($arquivo,"______________________________________".$quebra."Data: ".$Estoque['descricaoProduto'].$quebra."Quantidade: ".$Estoque['quantidadeEstoque'].$quebra);
                    }

                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Arquivo gerado com sucesso!</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>';
                  }
                }elseif($_POST['escolha']==3){

                  $quebra = chr(13).chr(10);
                  $timestamp=time();
                  $data= date("d-m-Y");
                  $dataBanco= date("Y-m-d");
                  if(file_exists("docs/'$data' - Caixa.txt")){
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Este arquivo já existe!</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>';
                  }else{
                    $arquivo = fopen("docs/'$data' - Caixa.txt","a");
                    $totalDinheiro = 0;
                    $totalSangria = 0;
                    $totalTroco= 0;
                    $result_cliente = "select * FROM `tb_vendas` where data_venda='$dataBanco' and (tipo_pagamento=1 or tipo_pagamento=3)";
                    $resultado_cliente = mysqli_query($conexao, $result_cliente);
                    while($lista = mysqli_fetch_array($resultado_cliente)){
                      $totalDinheiro=$lista['valor_venda'];
                    }
                    $result_cliente2 = "select * FROM `tb_caixa` where data_abertura='$dataBanco'";
                    $resultado_cliente2 = mysqli_query($conexao, $result_cliente2);
                    while($lista2 = mysqli_fetch_array($resultado_cliente2)){
                      $totalTroco=$lista2['troco'];
                    }
                    $result_cliente3 = "select * FROM `tb_sangria` where data_sangria='$dataBanco'";
                    $resultado_cliente3 = mysqli_query($conexao, $result_cliente3);
                    while($lista3 = mysqli_fetch_array($resultado_cliente3)){
                      $totalSangria =$lista3['valorSangria'];
                    }
                    fwrite($arquivo,"______________________________________".$quebra."Data: ".$data.$quebra."Total em venda: R$ ".number_format($totalDinheiro,2).$quebra."Total em troco: R$: ".number_format($totalTroco,2).$quebra."Total em Sangria: R$: ".number_format($totalSangria,2).$quebra."Total no caixa: R$ ".number_format(($totalDinheiro+$totalTroco-$totalSangria),2).$quebra);


                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Arquivo gerado com sucesso!</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>';
                  }

                }else{
                  $totalDinheiro = 0;
                  $quebra = chr(13).chr(10);
                  $totalSangria = 0;
                  $totalTroco= 0;
                  $dataInicio = $_POST['dataInicial'];
                  $dataFim = $_POST['dataFinal'];
                  $dataInicioArq=date('d-m-Y', strtotime($dataInicio));
                  $dataFimArq=date('d-m-Y', strtotime($dataFim));
                  if(file_exists("docs/'$dataInicioArq'  a  '$dataFimArq' - Retiradas.txt")){
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Este arquivo já existe!</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>';
                  }else{
                    $arquivo = fopen("docs/'$dataInicioArq'  a  '$dataFimArq' - Retiradas.txt","a");
                    $resultCaixa = "select * FROM `tb_caixa` where (data_abertura between '$dataInicio' and '$dataFim')";
                    $resultadoCaixa = mysqli_query($conexao, $resultCaixa);
                    while($caixa = mysqli_fetch_array($resultadoCaixa)){
                      $id_caixa=$caixa['id_caixa'];
                      $id_penultimo = "select * from tb_caixa where (id_caixa < (select max(id_caixa) from tb_caixa)) and id_caixa<$id_caixa order by id_caixa desc limit 1";
                      $query2=mysqli_query($conexao,$id_penultimo);
                      $array2=mysqli_fetch_array($query2);
                      $id_caixa2=$array2['id_caixa'];
                      $pesquisa2="select * from tb_caixa where id_caixa=".$id_caixa2;
                      $query=mysqli_query($conexao,$pesquisa2);
                      while($array=mysqli_fetch_array($query)){
                        $noCaixa1=$array['troco'];
                        $noCaixa2=$array['valor'];
                        $noCaixa3=$array['trocoFinal'];
                        $noCaixa=($noCaixa1+$noCaixa2)-$noCaixa3;
                        fwrite($arquivo,"______________________________________".$quebra."Data: ".date('d-m-Y', strtotime($caixa['data_abertura'])).$quebra."Deveria ter no caixa: R$ ".number_format($noCaixa,2).$quebra."Tinha no caixa: R$: ".number_format($caixa['troco'],2).$quebra."Foi retirado: R$: ".number_format($caixa['trocoFinal'],2).$quebra);
                      }
                    }
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Arquivo gerado com sucesso!</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>';
                  }
                }
              }




              ?>
              <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
              <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
              <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
              <script src="vendor/jquery/jquery.min.js"></script>
              <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
              <script src="js/perso.js"></script>
              <!-- Menu Toggle Script -->
              <script>
              $("#menu-toggle").click(function(e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
              });
              </script>

            </body>
            </html>
