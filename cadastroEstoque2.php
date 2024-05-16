
<?php
// setcookie('msg',null, -1);
$conexao=mysqli_connect("localhost","root","","franguino");
$variavel = mysqli_query($conexao,"select * from tb_usuario where id_usuario=".$_COOKIE['id_usuario']);
$dado2=mysqli_fetch_array($variavel);
$tipoUsuario=$dado2['tipo_usuario'];
if($tipoUsuario==2){
  header("Location:inicio.php");
}
if($_COOKIE['id_usuario']==''){
  HEADER("Location:login.php");
}
?>
<!DOCTYPE HTML>
<html lang="pt-br">
<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <meta charset="UTF-8">
  <title>Cadastro de Estoque</title>
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
        $conexao=mysqli_connect("localhost","root","","franguino");
        if(!$conexao){
          die("Erro".mysqli_error());
        }
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
              <li><a <a class="btn btn-light border border-dark btn-sm" href="cadastroFornecedores2.php">Cadastro</a></li>
            <p>  <li><a <a class="btn btn-light border border-dark btn-sm" href="alteracaoFornecedores.php">Modificação</a></li>
            </p>
      </ul>
      </li>
      <?php }?>
      <li>  <i class="bi bi-people-fill"></i> Colaboradores
      <ul>
      <?php
        if($tipoUsuario==1){?>
              <li><a <a class="btn btn-light border border-dark btn-sm" href="cadastroColaboradores.php">Cadastro</a></li>
            <?php }?>
            <p>  <li><a <a class="btn btn-light border border-dark btn-sm" href="alteracaoColaboradores.php">Alterar perfil</a></li>
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
          <?php
          if(isset($_COOKIE['msg'])){
            echo $_COOKIE['msg'];
          }?>
          <form action="cadastroEstoque.php" method="post">
              <input type="hidden" id="usuario" name="usuario" value="<?php echo $_COOKIE['id_usuario'];?>">
              <br><br>

              <div class="form-group">
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="dataCadastro">Data cadastro</label>
                    <input class="form-control" type="date" id="dateEstoqueCadastro" value="<?php echo date("Y-m-d")?>" name="dateEstoqueCadastro">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="dataValidade">Data validade</label>
                    <input class="form-control" type="date" id="dateEstoqueValidade" name="dateEstoqueValidade">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group ">
                    <label for="categoriaEstoque">Categoria estoque</label>
                    <select class="form-control col-15" name="categoriaEstoque" id="categoriaEstoque">
                      <?php
                      $conexao=mysqli_connect("localhost","root","","franguino");
                      if(!$conexao){
                        die(mysqli_error());
                      }
                      $consulta="Select * from categoriaestoque";
                      $linhas=mysqli_query($conexao,$consulta);
                      while($dados=mysqli_fetch_array($linhas)){
                        ?>
                        <option value="<?PHP echo $dados['id_CategoriaEstoque'];?>">
                          <?php echo $dados['nomeCategoriaEstoque']; ?>
                        </option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group col-2">
                    <label for="custo">Qt:</label>
                    <input class="form-control col-15" type="number"  min="0" id="quantidade" name="quantidade">
                  </div>
                  <div class="form-group  col-md-3">
                    <label for="custo">Custo unitário:</label>
                    <input class="form-control col-15" type="number" step="0.01" min="0" id="custo" name="custo">
                  </div>
                  <div class="form-group  col-md-3">
                    <label for="valorVenda">Valor de venda:</label>
                    <input class="form-control col-15" type="number" step="0.01" min="0" id="valorVenda" name="valorVenda">
                  </div>

                  <label for="descricao">Descrição:</label>
                  <textarea class="form-control col-15" type="text" id="descricao" name="descricao"></textarea>

              </div>
              </div>
              <div class="form row">
                <div class="form-group  col-md-6">
                  <input class="btn btn-outline-success" type="submit" value="Registrar no estoque" name="enviar">
                </div>
                <div class="form-group  col-md-6">
                  <input class="btn btn-outline-secondary" type="reset" value="      Limpar      ">
                </div>
              </div>
            </div>
        <div class="container-fluid justify-content-center col-6">
          <?php
          if(isset($_COOKIE['msgCategoria'])){
            echo $_COOKIE['msgCategoria'];
          }?>
          <form action="cadastroEstoque.php" method="post">
                <div class="form-row">
                  <label for="descricao">Categoria do estoque:</label>
                  <input class="form-control col-23" type="text" id="descricao" name="descricaoCategoria"></input>
                </div>
              </br>
              <div class="form row">
                <div class="form-group  col-md-6">
                  <input class="btn btn-outline-success" type="submit" value="Registrar categoria" name="categoria">
                </div>
                <div class="form-group  col-md-6">
                  <a <a class="btn btn-outline-secondary" href="editarCategorias.php">Editar categorias</a>
                </div>
              </div>
          </form>
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Menu Toggle Script -->
        <script>
        $("#menu-toggle").click(function(e) {
          e.preventDefault();
          $("#wrapper").toggleClass("toggled");
        });
      </script>

    </body>
    </html>
