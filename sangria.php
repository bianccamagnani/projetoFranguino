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
?>
<!DOCTYPE HTML>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Sangria</title>
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

            </nav>

            <div class="container-fluid justify-content-center col-6">
              <form action="sangria.php" method="post">
                <input type="hidden" name="id_usuario" value="<?php echo $_COOKIE['id_usuario']; ?>"></input>
                
                  <div class="form-group">
                    <br><br>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="nomeCliente"> Descrição: </label>
                        <input class="form-control" type="text" id="nomeCliente" name="descricao">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="telCliente">Nota:</label>
                        <input class="form-control" type="text" id="telCliente"  name="nota">
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="nomeCliente"> Valor: </label>
                        <input class="form-control" type="number" id="nomeCliente" value="0" step="0.01" min="0" name="valor">
                      </div>

                    </div>

                  </div>
                  <div class="form row">
                    <div class="form-group  col-md-6">
                      <input type="submit"  class="btn btn-outline-success" value="Registrar sangria" name="enviar">
                    </div>
                    <div class="form-group  col-md-6">
                      <input class="btn btn-outline-secondary" type="reset" value="      Limpar      ">
                    </div>
                  </div>
              </form>
              <?php
              if(isset($_POST['enviar'])){
                if($_POST['descricao']=="" or $_POST['nota']==""){
                  echo '<br><div class="alert alert-warning alert-dismissible fade show" role="alert">
          			     <strong>
          			 Os campos de nº da nota e de descrição são obrigatórios!
          				</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close">
          					<span aria-hidden="true">&times;</span>
          				</button>
          			</div>';
              }else{
                $valor=$_POST['valor'];
                $descricao=$_POST['descricao'];
                $nota=$_POST['nota'];
                $usuario=$_POST['id_usuario'];
                $insert="INSERT INTO `tb_sangria`(`data_sangria`, `descricao`, `nota`, `valorSangria`, `pessoaAdicionou`) VALUES ('$today','$descricao','$nota','$valor', '$usuario')";
                $query=mysqli_query($conexao, $insert);
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
