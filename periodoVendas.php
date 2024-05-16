<?php
$conexao=mysqli_connect("localhost","root","","franguino");
if($_COOKIE['id_usuario']==''){
  HEADER("Location:login.php");
}
if(isset($_GET['excluir'])){

  $linhas=mysqli_query($conexao, "select * from tb_carrinho where id_venda=".$_GET['excluir']);
  while($dado=mysqli_fetch_array($linhas)){
    $produto=$dado['id_produto'];
    $qt=$dado['quantidade'];
    $pesquisa=mysqli_query($conexao, "select * from tb_estoque where id_estoque=".$produto);
    while($dado2=mysqli_fetch_array($pesquisa)){
      $quantidade=$dado2['quantidadeEstoque'];
      $quantidadeTotal=($qt+$quantidade);
      $alterar=mysqli_query($conexao, "update tb_estoque set quantidadeEstoque='$quantidadeTotal' where id_estoque=".$produto);
    }
  }
  $varia = mysqli_query($conexao,"DELETE FROM `tb_carrinho` WHERE id_venda=".$_GET['excluir']);
  $vari= mysqli_query($conexao,"DELETE FROM `tb_vendas` WHERE id_venda=".$_GET['excluir']);

  }
if(isset($_GET['pago'])){
  $conexao=mysqli_connect("localhost","root","","franguino");
  $linhas=mysqli_query($conexao, "update tb_vendas set status_venda=1 where id_venda=".$_GET['pago']);
}
?>
<!DOCTYPE HTML>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Faturamento por período</title>
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
  <link href="css/simple-sidebar.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.quicksearch/2.3.1/jquery.quicksearch.js"></script>
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
              <div class="col-1">
              <button id="down" class="btn btn-secondary"><i class="bi bi-arrow-down-square"></i></button>
            </div>

            </nav>

            <div class="container-fluid justify-content-center">
              <br><br>
              <form action="periodoVendas.php" method="POST">

                  <div class="form-group">
                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label for="dataCadastro">De: </label>
                        <input class="form-control" value="<?php echo date("Y-m-d");?>" type="date"  id="dataInicial" name="dataInicial">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="dataValidade">Até:</label>
                        <input class="form-control" type="date" value="<?php echo date("Y-m-d");?>" id="dataFinal" name="dataFinal">
                      </div>

                      <div class="form-group col-4">
                        <br>
                        <p>
                          <input type="submit" class="btn btn-outline-success" value="Pesquisar" name="enviar">
                        </p>
                      </div>
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
                  $dataInicio = $_POST['dataInicial'];
                  $dataFim = $_POST['dataFinal'];

                      ?>
                      <div class="form-group input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                        <input name="consulta" id="txt_consulta" placeholder="Consultar" type="text" class="form-control">
                      </div>
                      <table id="tabela" class="table table-hover">
                        <thead class="table ">

                        <?php
                        $consulta="Select * from tb_vendas where data_venda between '$dataInicio' and '$dataFim' order by data_venda desc";
                        $linhas=mysqli_query($conexao,$consulta);
                        while($dado=mysqli_fetch_array($linhas)){
                          $consulta2="Select * from tb_usuario where id_usuario=".$dado['id_vendedor'];
                          $linhas2=mysqli_query($conexao,$consulta2);
                          $consulta3="Select * from tb_clientes where id_cliente=".$dado['id_cliente'];
                          $linhas3=mysqli_query($conexao,$consulta3);
                          ?>
                          <tr class="table-success table-sm">
                            <td>Valor da venda</td>
                            <td>Vendedor</td>
                            <td>Cliente</td>
                            <td>Status venda</td>
                            <td>Telefone</td>
                            <td>Para entregar</td>
                            <td>Endereço de entrega</td>
                            <td>Valor da entrega</td>
                            <td>Tipo de pagamento</td>
                            <td>Data da venda</td>
                            <td>Desconto</td>
                            <td>Ações</td>
                          </tr>
                        </thead>
                          <tbody>
                            <tr>
                              <td><?php echo "R$ ".number_format($dado['valor_venda'],2); ?></td>
                              <?php while($dado2=mysqli_fetch_array($linhas2)){ ?>
                                <td><?php echo $dado2['nome_usuario'];} ?></td>
                                <?php while($dado3=mysqli_fetch_array($linhas3)){
                                    $enderecoCliente=$dado3['endereço_cliente']; ?>
                                  <td><?php echo $dado3['nome_cliente']; }?></td>
                                  <td><?php if($dado['status_venda']==1){
                                    echo "Pago";
                                  }else{
                                    echo "Não pago";
                                  }; ?></td>
                                  <td><?php echo $dado['telefone_venda']; ?></td>
                                  <?php if($dado['radio_entrega']==0 & $dado['status_venda']==0){
                                    echo '<td class="table-active">Não</td>';
                                  }elseif($dado['radio_entrega']==1){
                                    echo '<td >Sim</td>';
                                  }else{
                                    echo "<td>Não </td>";
                                  }
                                  if($dado['id_cliente']!=3 & $dado['radio_entrega']==1){?>
                                  <td><?php echo $enderecoCliente; ?> </td><?php }else{ ?>
                                    <td>
                                    <?php echo "Endereço não registrado";} ?></td>
                                  <td><?php echo "R$ ".$dado['valorEntrega']; ?></td>
                                  <td><?php if($dado['tipo_pagamento']==1){
                                    echo "Dinheiro";
                                  }elseif($dado['tipo_pagamento']==2){
                                    echo "Cartão";
                                  }else{
                                    echo "Din. e Cart.";
                                  } ?></td>
                                  <td><?php echo date('d/m/Y', strtotime($dado['data_venda'])); ?></td>
                                  <td><?php echo "R$ ".number_format($dado['desconto'],2); ?></td>
                                  <td>
                                    <p><a href="periodoVendas.php?excluir=<?php echo $dado['id_venda']; ?>" data-confirm='Tem certeza que deseja excluir?'><button class="btn btn-outline-danger" >Excluir</button></a>
                                      <?php
                                      if($dado['status_venda']==0){
                                        ?>
                                      </p><p>
                                        <a href="periodoVendas.php?pago=<?php echo $dado['id_venda']; ?>" ><button type="button" class="btn btn-outline-info">Pago</button></a>
                                        <?php
                                      }
                                      ?>
                                    </p>
                                  </td>
                                </tr>

                              <?php } ?>
                            </tbody>
                          </table>
                        </div>
                                <?php
                              }
                            }
                            ?>
                            <a href="#" class="btn btn-secondary scrollToTop"><i class="bi bi-arrow-up-square"></i></a>
                            <script>
                            $('input#txt_consulta').quicksearch('table#tabela tbody tr');
                            </script>
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
