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
  <title>Listagem por itens</title>
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
                <a href="dataFaturamento.php"><button type="button"  class="btn btn-outline-secondary">Valores vendidos</button></a>

                <a href="relatorios.php"><button type="button" class="btn btn-outline-secondary">Relatórios</button></a>
              </div>
            </nav>

            <div class="container-fluid justify-content-center col-6">
              <form action="itens.php" method="post">
                <br><br>
                <div class="form-group">
                    <label for="categoriaEstoque">Estoque</label>
                    <div class="form-group col-md-5">
                      <select class="form-control" name="id_categoriaEstoque" id="categoriaEstoque">
                        <?php
                        $consulta="select DISTINCT categoriaEstoque.nomeCategoriaEstoque, categoriaEstoque.id_CategoriaEstoque from categoriaEstoque, tb_estoque where tb_estoque.categoriaEstoque=categoriaEstoque.id_CategoriaEstoque";
                        $linhas=mysqli_query($conexao,$consulta);
                        while($dados=mysqli_fetch_array($linhas)){
                          ?>
                          <option value="<?PHP echo $dados['id_CategoriaEstoque'];?>">
                            <?php echo $dados['nomeCategoriaEstoque']; ?>
                          </option>
                          <?php
                        }?>
                      </select></p>
                    </div>
                    <div class="form-group col-md-4">
                      <input class="btn btn-outline-success" type="submit" value="Pesquisar itens" name="botao">
                    </div>
                    <?php if(isset($_POST['botao'])){?>
                      <div class="form-row">
                        <div class="form-group col-md-5">
                          <label for="dataCadastro">De: </label>
                          <input class="form-control" value="<?php echo date("Y-m-d");?>" type="date"  id="dataInicial" name="dataInicial">
                        </div>

                        <div class="form-group col-md-5">
                          <label for="dataValidade">Até:</label>
                          <input class="form-control" type="date" value="<?php echo date("Y-m-d");?>" id="vencimentoDespesa" name="dataFinal">
                        </div>
                          </div>
                    <br>

                    <div class="form-row">
                    <br>
                    <label for="categoriaEstoque">Produto vendido</label>
                    <div class="form-group col-md-6">
                      <select class="form-control" name="categoriaEstoque" id="categoriaEstoque">
                        <?php
                        $consulta="select DISTINCT tb_carrinho.id_produto, tb_estoque.descricaoProduto from tb_carrinho, tb_estoque where tb_carrinho.id_produto=tb_estoque.id_estoque and tb_estoque.categoriaEstoque=".$_POST['id_categoriaEstoque'];
                        $linhas=mysqli_query($conexao,$consulta);
                        while($dados=mysqli_fetch_array($linhas)){
                          ?>
                          <option value="<?PHP echo $dados['id_produto'];?>">
                            <?php echo $dados['descricaoProduto']; ?>
                          </option>
                          <?php
                        }?>
                      </select></p>
                    </div>
                    <br>
                    <div class="form-group col-md-4">
                      <input class="btn btn-outline-success" type="submit" value="Pesquisar itens" name="enviar">
                    </div>
                    </div>
                  <?php } ?>
                </div>
                </form>
                <?php
                if(isset($_POST['enviar'])){
                  $dataInicio = $_POST['dataInicial'];
                  $dataFim = $_POST['dataFinal'];
                  $quantidade=0;
                  $nome=0;
                  $id_estoque=$_POST['categoriaEstoque'];
                  $result_cliente = "select sum(tb_carrinho.quantidade), tb_vendas.data_venda, tb_estoque.descricaoProduto from tb_carrinho, tb_vendas, tb_estoque where tb_estoque.id_estoque=$id_estoque and (tb_vendas.data_venda between '$dataInicio' and '$dataFim') and (tb_carrinho.id_venda=tb_vendas.id_venda) and (tb_carrinho.id_produto=tb_estoque.id_estoque)";
                  $resultado_cliente = mysqli_query($conexao, $result_cliente);
                  while($lista = mysqli_fetch_array($resultado_cliente)){
                      ?>
                          <table id="tabela" class="table table-hover">
                            <thead class="table table-sm">
                              <tr  class="table-warning">
                                <td>Produto</td>
                                <td>Quantidade</td>
                              </tr>
                            </thead>

                            <tbody>
                              <tr>
                                <td><?php echo $lista['descricaoProduto']; ?></td>
                                <?php if($lista['sum(tb_carrinho.quantidade)']!=""){ ?>
                                <td><?php echo $lista['sum(tb_carrinho.quantidade)']; ?></td>
                              <?php } else { ?>
                                <td><?php echo " 0 " ?></td>
                              <?php } ?>
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
