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
?>
<!DOCTYPE HTML>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Posição do caixa</title>
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

            </nav>

          <div class="container-fluid justify-content-center col-6">
            <br>

            <form action="posicao.php" method="POST">
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
                    <div class="form-group col-4">
                      <br>
                      <p>
                      <input type="submit" class="btn btn-outline-success" value="Pesquisar" name="enviar">
                    </p>
                  </div>
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
              // SELECT * FROM Tabela WHERE Status = 1 AND Data > '2017-01-01' AND Data < '2017-01-17
              //SELECT * FROM TABELA WHERE status='1' and data between '2017-01-13' and '2017-01-20';
              $totalDinheiro = 0;
              $totalSangria = 0;
              $totalTroco= 0;
              $pessoaAbriu=0;
              $pessoaFechou=0;
              $pessoaRetirou=0;
              $nomeAbriu="";
              $nomeFechou="";
              $nomeRetirou="";
              $dataInicio = $_POST['dataInicial'];
              $dataFim = $_POST['dataFinal'];
              $result_cliente = "select * FROM `tb_vendas` where (data_venda between '$dataInicio' and '$dataFim') and (tipo_pagamento=1 or tipo_pagamento=3)";
              $resultado_cliente = mysqli_query($conexao, $result_cliente);
              while($lista = mysqli_fetch_array($resultado_cliente)){
                $totalDinheiro +=$lista['valor_venda'];
              }
                $result_cliente2 = "select * FROM `tb_caixa` where data_abertura between '$dataInicio' and '$dataFim'";
                $resultado_cliente2 = mysqli_query($conexao, $result_cliente2);

                while($lista2 = mysqli_fetch_array($resultado_cliente2)){
                  $totalTroco +=$lista2['troco'];
                  $pessoaAbriu=$lista2['pessoaAbriu'];
                  $pessoaFechou=$lista2['pessoaFechou'];
                  $pessoaRetirou=$lista2['pessoaRetirada'];
                }
                  $result_cliente3 = "select * FROM `tb_sangria` where data_sangria between '$dataInicio' and '$dataFim'";
                  $resultado_cliente3 = mysqli_query($conexao, $result_cliente3);
                  while($lista3 = mysqli_fetch_array($resultado_cliente3)){
                    $totalSangria +=$lista3['valorSangria'];
                  }
                  $result_pessoas = "select nome_usuario FROM `tb_usuario` where id_usuario='$pessoaAbriu'";
                  $resultado_pessoas = mysqli_query($conexao, $result_pessoas);
                  while($array = mysqli_fetch_array($resultado_pessoas)){
                    $nomeAbriu =$array['nome_usuario'];
                  }
                  $result_pessoas2 = "select nome_usuario FROM `tb_usuario` where id_usuario='$pessoaFechou'";
                  $resultado_pessoas2 = mysqli_query($conexao, $result_pessoas2);
                  while($array2 = mysqli_fetch_array($resultado_pessoas2)){
                    $nomeFechou =$array2['nome_usuario'];
                  }
                  $result_pessoas3 = "select nome_usuario FROM `tb_usuario` where id_usuario='$pessoaRetirou'";
                  $resultado_pessoas3 = mysqli_query($conexao, $result_pessoas3);
                  while($array3 = mysqli_fetch_array($resultado_pessoas3)){
                    $nomeRetirou =$array3['nome_usuario'];
                  }
                  ?>
                  <table id="tabela" class="table table-hover">
                  <thead class="table table-sm">
                  <tr  class="table-sucess">
                    <td>Total em venda</td>
                    <td>Total em troco</td>
                    <td>Total em sangria</td>
                    <td>Valor no caixa</td>
                    <td>Pessoa que abriu</td>
                    <td>Pessoa que retirou</td>
                    <td>Pessoa que fechou</td>

                  </tr>
                </thead>

                <tbody>
                  <tr>
                    <td><?php echo "R$ ". number_format($totalDinheiro,2); ?></td>
                    <td><?php echo "R$ ".number_format($totalTroco,2); ?></td>
                    <td><?php echo "R$ ".number_format($totalSangria, 2); ?></td>
                    <td><?php echo "R$ ".number_format(($totalDinheiro+$totalTroco-$totalSangria),2); ?></td>
                    <td><?php echo $nomeAbriu; ?></td>
                    <td><?php echo $nomeRetirou; ?></td>
                    <td><?php echo $nomeFechou; ?></td>
                  </tbody>
                </table>
            <?php
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
