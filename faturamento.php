<?php
if($_COOKIE['id_usuario']==''){
  HEADER("Location:login.php");
}
date_default_timezone_set ('America/Sao_Paulo');
$atual = new DateTime();
$today = $atual->format('Y-m-d');
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
  <title>Faturamento</title>
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
  .scrollToTop{
    position:fixed;
    top:75px;
    right:40px;
    display:none;
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
                    <p><li> <a class="btn btn-light border border-dark btn-sm" href="alteracaoCliente.php">Modicação</a></li>
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
              <div class="col-1">
              <button id="down" class="btn btn-secondary"><i class="bi bi-arrow-down-square"></i></button>
            </div>
              <div class="col">

                <a href="faturamentoLiquido.php"><button type="button" class="btn btn-outline-secondary">Faturamento líquido</button></a>


                <a href="dataFaturamento.php"><button type="button"  class="btn btn-outline-secondary">Valores vendidos</button></a>

                <a href="itens.php"><button type="button" class="btn btn-outline-secondary">Quantidade de itens vendidos</button></a>

                <a href="relatorios.php"><button type="button" class="btn btn-outline-secondary">Relatórios</button></a>
              </div>
            </nav>

            <div class="container-fluid justify-content-center col-6">
              <br>
              <form action="faturamento.php" method="POST">
                <div class="row">
                  <div class="form-group col-md-5">
                    <label for="dataCadastro">De: </label>
                    <input class="form-control" value="<?php echo date("Y-m-d");?>" type="date"  id="dataInicial" name="dataInicial">
                  </div>
                  <div class="form-group col-md-5">
                    <label for="dataValidade">Até:</label>
                    <input class="form-control" type="date" value="<?php echo date("Y-m-d");?>" id="vencimentoDespesa" name="dataFinal">
                  </div>
                  <div class="form-group col-2">
                    <br>
                    <p>
                      <input type="submit" class="btn btn-outline-success" value="Pesquisar" name="enviar">
                    </p>
                  </div>
                </div>
              </form>

              <?php
              if(isset($_POST['enviar'])){
                if($_POST['dataInicial']=="" or $_POST['dataFinal']==""){
                  echo '<br><div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>
                  Datas vazias!
                  </strong><button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
                  </div>';
                }else{
                  // SELECT * FROM Tabela WHERE Status = 1 AND Data > '2017-01-01' AND Data < '2017-01-17
                  //SELECT * FROM TABELA WHERE status='1' and data between '2017-01-13' and '2017-01-20';
                  $dataInicio = $_POST['dataInicial'];
                  $dataFim = $_POST['dataFinal'];
                  ?>
                  <table> <?php
                  $totalDinheiro=0;
                  $totalCartao=0;
                  $result_cliente3 = "select * FROM `tb_vendas` where (data_venda between '$dataInicio' and '$dataFim') and status_venda=1";
                  $resultado_cliente3 = mysqli_query($conexao, $result_cliente3);
                  while($lista3 = mysqli_fetch_array($resultado_cliente3)){
                    if ($lista3['tipo_pagamento']==3){
                      $totalCartao+=$lista3['valorCartao'];
                      $totalDinheiro+=$lista3['valor_venda'];
                       ?>
                      <thead class="table table-sm table-info">
                        <tr>
                          <td>Valor Din.</td>
                          <td>Valor Cart.</td>
                          <td>Data</td>
                          <td>Pagamento</td>

                          <td></td>
                          <td> </td>
                        </tr>
                      </thead>
                    <?php }elseif($lista3['tipo_pagamento']==2){
                        $totalCartao+=$lista3['valor_venda']; ?>
                      <thead class="table table-sm table-info">
                        <tr>
                          <td>Valor Cart.</td>
                          <td>Data</td>
                          <td> </td>
                          <td>Pagamento</td>
                          <td> </td>
                          <td> </td>
                        </tr>
                      </thead>
                    <?php }else{
                      $totalDinheiro+=$lista3['valor_venda'];
                      ?>
                      <thead class="table table-sm table-info">
                        <tr>
                          <td>Valor Din.</td>
                          <td>Data</td>
                          <td></td>
                          <td>Pagamento</td>
                          <td></td>
                          <td> </td>
                        </tr>
                      </thead>
                    <?php } ?>
                    <?php if($lista3['tipo_pagamento']==3){?>
                      <tbody>
                        <tr>

                          <?php if($lista3['valor_venda']!=""){?>
                            <td><?php echo "R$ ".number_format($lista3['valor_venda'],2); ?></td>
                          <?php }else{ ?>
                            <td> - </td>
                          <?php } ?>
                          <?php if($lista3['valorCartao']!=""){?>
                            <td><?php echo "R$ ".number_format($lista3['valorCartao'],2); ?></td>
                          <?php }else{ ?>
                            <td> - </td>
                          <?php }?>
                          <td><?php echo date('d/m/Y', strtotime($lista3['data_venda'])); ?></td>
                          <td>Din. e Cart.</td>

                          <td></td>

                          <td>
                            <button type="button" class="btn btn-light border border-dark btn-sm  view_data" id="<?php echo $lista3['id_venda']; ?>">Ver</button>  </td>
                          </tr>
                        <?php }elseif($lista3['tipo_pagamento']==2){ ?>
                          <tbody>
                            <tr>

                              <?php if($lista3['valor_venda']!=""){?>
                                <td><?php echo "R$ ".number_format($lista3['valor_venda'],2); ?></td>
                              <?php }else{ ?>
                                <td> - </td>
                              <?php }?>
                              <td><?php echo date('d/m/Y', strtotime($lista3['data_venda'])); ?></td>
                              <td>Cartão</td>
                              <td></td>
                              <td>
                                <button type="button" class="btn btn-light border border-dark btn-sm  view_data" id="<?php echo $lista3['id_venda']; ?>">Ver</button>  </td>
                              </tr>
                            <?php }else{ ?>
                              <tbody>
                                <tr>

                                  <?php if($lista3['valor_venda']!=""){?>
                                    <td><?php echo "R$ ".number_format($lista3['valor_venda'],2); ?></td>
                                  <?php }else{ ?>
                                    <td> - </td>
                                  <?php }?>
                                  <td><?php echo date('d/m/Y', strtotime($lista3['data_venda'])); ?></td>
                                  <td></td>
                                  <td>Dinheiro</td>
                                  <td></td>
                                  <td>
                                    <button type="button" class="btn btn-light border border-dark btn-sm  view_data" id="<?php echo $lista3['id_venda']; ?>">Ver</button>  </td>
                                  </tr>
                                <?php }
                              } ?>
                            </tbody>
                          </table>
                          <br>
                          <br>

                          <?php
                          $totalDespesa=0;
                          $result_cliente4 = "select * FROM `tb_despesa` where (data_despesa between '$dataInicio' and '$dataFim') and situacao='sim'";
                          $resultado_cliente4 = mysqli_query($conexao, $result_cliente4);
                          while($lista4 = mysqli_fetch_array($resultado_cliente4)){
                            $totalDespesa+=$lista4['valorDespesa'];
                            ?>
                            <table>
                              <thead class="table table-sm table-danger">
                                <tr>
                                  <td>Descrição</td>
                                  <td></td>
                                  <td>Valor</td>
                                  <td></td>
                                  <td>Vencimento</td>
                                  <td></td>
                                  <td>Data</td>
                                  <td></td>
                                  <td>Quantidade</td>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <?php if($lista4['descricao']!=""){?>
                                    <td><?php echo $lista4['descricao']; ?></td>
                                  <?php }else{ ?>
                                    <td> - </td>
                                  <?php } ?>
                                  <td></td>
                                  <?php if($lista4['valorDespesa']!=0){?>
                                    <td><?php echo "R$ ".number_format($lista4['valorDespesa'],2); ?></td>
                                  <?php }else{ ?>
                                    <td> - </td>
                                  <?php } ?>
                                  <td></td>
                                  <?php if($lista4['vencimentoDespesa']!="1970-01-01"){?>
                                    <td><?php echo date('d/m/Y', strtotime($lista4['vencimentoDespesa'])); ?></td>
                                  <?php }else{ ?>
                                    <td> - </td>
                                  <?php }?>
                                  <td></td>
                                  <td><?php echo date('d/m/Y', strtotime($lista4['data_despesa'])); ?></td>
                                  <td></td>
                                  <?php if($lista4['quantidade']!=0){?>
                                    <td><?php echo $lista4['quantidade']; ?></td>
                                  <?php }else{ ?>
                                    <td> - </td>
                                  <?php } ?>
                                </table>
                                <br><br>
                              <?php } ?>

                              <?php
                              $totalSangria=0;
                              $result_cliente5 = "select * FROM `tb_sangria` where (data_sangria between '$dataInicio' and '$dataFim')";
                              $resultado_cliente5 = mysqli_query($conexao, $result_cliente5);
                              while($lista5 = mysqli_fetch_array($resultado_cliente5)){
                                $totalSangria+=$lista5['valorSangria'];
                                ?>
                                <table>
                                  <thead class="table table-sm table-warning">
                                    <tr>
                                      <td>Descrição</td>
                                      <td></td>
                                      <td>Valor</td>
                                      <td></td>
                                      <td>Data</td>
                                      <td></td>
                                      <td>Nº nota</td>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <?php if($lista5['descricao']!=""){?>
                                        <td><?php echo $lista5['descricao']; ?></td>
                                      <?php }else{ ?>
                                        <td> - </td>
                                      <?php } ?>
                                      <td></td>
                                      <?php if($lista5['valorSangria']!=0){?>
                                        <td><?php echo "R$ ".number_format($lista5['valorSangria'],2); ?></td>
                                      <?php }else{ ?>
                                        <td> - </td>
                                      <?php } ?>
                                      <td></td>
                                      <?php if($lista5['data_sangria']!="1970-01-01"){?>
                                        <td><?php echo date('d/m/Y', strtotime($lista5['data_sangria'])); ?></td>
                                      <?php }else{ ?>
                                        <td> - </td>
                                      <?php }?>
                                      <td></td>
                                      <?php if($lista5['nota']!=""){?>
                                        <td><?php echo $lista5['nota']; ?></td>
                                      <?php }else{ ?>
                                        <td> - </td>
                                      <?php } ?>
                                    </table>
                                    <br><br>
                                  <?php } ?>
                                  <div class="row">
                                    <div class="col-6">
                                      <button type="button" class="btn btn-outline-info" disabled>
                                        <strong><?php echo "Vendido no Cart.: R$ ".number_format($totalCartao, 2); ?>
                                        </strong>
                                      </button>
                                    </div>
                                    <div class="col-6">
                                      <button type="button" class="btn btn-outline-info" disabled>
                                        <strong><?php echo "Vendido em Din.: R$ ".number_format($totalDinheiro, 2); ?>  </strong>
                                      </button>
                                    </div>
                                  </div>
                                  <br><br>
                                  <div class="row">
                                    <div class="col-4">
                                      <button type="button" class="btn btn-outline-danger" disabled>
                                        <strong><?php echo "Despesa: R$ ".number_format($totalDespesa, 2); ?>
                                        </strong>
                                      </button>
                                    </div>
                                    <div class="col-3">
                                      <button type="button" class="btn btn-outline-warning" disabled>
                                        <strong><?php echo "Sangria: R$ ".number_format($totalSangria, 2); ?>  </strong>
                                      </button>
                                    </div>
                                    <div class="col-3">
                                      <button type="button" class="btn btn-outline-success" disabled>
                                        <strong>
                                          <?php echo "Total: R$ ".number_format((($totalDinheiro+$totalCartao)-$totalDespesa-$totalSangria), 2); ?>
                                        </strong>
                                      </button>
                                    </div>
                                    <a href="#" class="btn btn-secondary scrollToTop"><i class="bi bi-arrow-up-square"></i></a>

                                  </div>
                                  <br><br>

                                  <?php

                                }
                              }
                              ?>

                              <div id="visuVendasModal" class="modal" tabindex="-1" role="dialog">
                                <div  class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title">Produtos da venda</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <p><span id="visul_vendas"> </span></p>
                                    </div>
                                    <div class="modal-footer">
                                    </div>
                                  </div>
                                </div>
                              </div>

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
                              <script>
                              $(document).ready(function(){
                                $(document).on('click', '.view_data', function(){
                                  var venda_id= $(this).attr("id");
                                  // alert(venda_id);
                                  if(venda_id !== ''){
                                    var dados = {
                                      venda_id: venda_id
                                    };
                                    $.post('visualizar.php', dados, function(retorna){
                                      $('#visul_vendas').html(retorna);
                                      $('#visuVendasModal').modal('show');
                                    });
                                  };
                                });
                              });
                              </script>
                              <script>
                              $('#down').on('click', function() {
                                $('html, body').animate({
                                  scrollTop: $(document).height()
                                }, 700);
                              });
                              </script>
                              <script>
                              $(document).ready(function(){

                                //Verifica se a Janela está no topo
                                $(window).scroll(function(){
                                  if ($(this).scrollTop() > 100) {
                                    $('.scrollToTop').fadeIn();
                                  } else {
                                    $('.scrollToTop').fadeOut();
                                  }
                                });

                                //Onde a mágia acontece! rs
                                $('.scrollToTop').click(function(){
                                  $('html, body').animate({scrollTop : 0},800);
                                  return false;
                                });

                              });
                              </script>
                            </body>
                            </html>
