<?php
$conexao=mysqli_connect("localhost","root","","franguino");

// setcookie('msgColaborador',null, -1);
if($_COOKIE['id_usuario']==''){
  HEADER("Location:login.php");
}
?>
<!DOCTYPE HTML>
<html lang="pt-br">
<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <meta charset="UTF-8">
  <title>Alteração Colaboradores</title>
  <link rel="icon" type="imagem/jpeg" href="img/franguinoLogo.jpeg" />
  <link rel="stylesheet" type="text/css"  href="estilo.css" />
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>

  <!-- Adicionando Javascript -->
  <style type="text/css">
  ::-webkit-scrollbar {
     width: 5px;
  }

  ::-webkit-scrollbar-thumb {
     -webkit-border-radius: 5px;
     border-radius: 5px;
     background: #b3e6b3;
     -webkit-box-shadow: inset 0 0 6px #b3e6b3;
  }
  ul{
    list-style-type:none;
  }
  </style>
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
          <div class="col">
            <button class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"><i class="bi bi-info"></i></button>
          </div>
        </nav>
        <div class="container-fluid justify-content-center col-6">
        <form action="functionColaboradores.php" method="post">
            <div class="row">


              <div class="form-group">
                <?php
                if(isset($_COOKIE['msgColaborador'])){
                  echo $_COOKIE['msgColaborador'];
                }
                ?>
                <input type="hidden" value="<?php echo $_COOKIE['id_usuario'];?>" name="id_cliente">
                <br><br>
                <?php
                $result_cliente = "select * FROM `tb_usuario` where id_usuario=".$_COOKIE['id_usuario'];
                $resultado_cliente = mysqli_query($conexao, $result_cliente);
                $lista = mysqli_fetch_array($resultado_cliente);
                $nome=$lista['nome_usuario'];
                $email=$lista['email'];
                ?>
                <div class="form-row">
                  <div class="form-group col-md-6">
                <label for="nomeCliente"> Nome: </label>
                <input class="form-control" value="<?php echo $nome;?>" type="text" id="nome" name="nome">
              </div>
              <div class="form-group col-md-6">
                <label for="telCliente">E-mail:</label>
                <input class="form-control" value="<?php echo $email;?>" type="email" id="telCliente" size="11" name="email">
              </div>
              </div>

                            <div class="form-row">
                              <div class="form-group col-md-6">
                              <label>Senha antiga:
                                <input  class="form-control" type="password" id="cpfCliente" name="senhaAntiga">
                              </div>
                              <div class="form-group col-md-6">
                                <label>Nova senha:
                                  <input  class="form-control" type="password" id="emailCliente" name="senha">
                            </div>
                            <div class="form-group col-md-6">
                              <label>Repita sua nova senha:
                                <input  class="form-control" type="password" id="emailCliente" name="resenha">
                          </div>
                          </div>
                                </div>
                                <div class="form row">
                                  <div class="form-group  col-md-6">
                                    <input type="submit"  class="btn btn-outline-success" value="Atualizar" name="enviar">
                                  </div>
                                  <div class="form-group  col-md-6">
                                    <input class="btn btn-outline-secondary" type="reset" value="      Limpar      ">
                                  </div>
                                </div>
                              </div>
                            </form>
                          </div>
                          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                </div>
                                <div class="modal-body">
                                Para alterar apenas o nome ou o login, deixe a senha em branco!
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-success" data-dismiss="modal">Fechar</button>
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

                      </body>
                      </html>
