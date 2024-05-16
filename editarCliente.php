<?php
if($_COOKIE['id_usuario']==''){
  HEADER("Location:login.php");
}
$conexao=mysqli_connect("localhost","root","","franguino");
if(!$conexao){
  die("Erro".mysqli_error());
}
$id_cliente=$_GET['alterar'];
?>
<!DOCTYPE HTML>
<html lang="pt-br">
<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <meta charset="UTF-8">
  <title>Edição de Clientes</title>
  <link rel="icon" type="imagem/jpeg" href="img/franguinoLogo.jpeg" />
  <link rel="stylesheet" type="text/css"  href="estilo.css" />
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/152/jquery.min.js">
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
  <!-- Adicionando Javascript -->

  <script>

  $(document).ready(function() {

    function limpa_formulário_cep() {
      // Limpa valores do formulário de cep.
      $("#rua").val("");
      $("#bairro").val("");
      $("#cidade").val("");
      $("#uf").val("");
      $("#ibge").val("");
    }

    //Quando o campo cep perde o foco.
    $("#cep").blur(function() {

      //Nova variável "cep" somente com dígitos.
      var cep = $(this).val().replace(/\D/g, '');

      //Verifica se campo cep possui valor informado.
      if (cep != "") {

        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if(validacep.test(cep)) {

          //Preenche os campos com "..." enquanto consulta webservice.
          $("#rua").val("...");
          $("#bairro").val("...");
          $("#cidade").val("...");
          $("#uf").val("...");
          $("#ibge").val("...");

          //Consulta o webservice viacep.com.br/
          $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

            if (!("erro" in dados)) {
              //Atualiza os campos com os valores da consulta.
              $("#rua").val(dados.logradouro);
              $("#bairro").val(dados.bairro);
              $("#cidade").val(dados.localidade);
              $("#uf").val(dados.uf);
              $("#ibge").val(dados.ibge);
            } //end if.
            else {
              //CEP pesquisado não foi encontrado.
              limpa_formulário_cep();
              alert("CEP não encontrado.");
            }
          });
        } //end if.
        else {
          //cep é inválido.
          limpa_formulário_cep();
          alert("Formato de CEP inválido.");
        }
      } //end if.
      else {
        //cep sem valor, limpa formulário.
        limpa_formulário_cep();
      }
    });
  });

  </script><style type="text/css">
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

  <title>Franguino</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/simple-sidebar.css" rel="stylesheet">

</head>
<body>
  <div class="d-flex" id="wrapper">

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
          <form action="functionCliente.php" method="post">
            <div class="form group">
              <?php
              $result_cliente = "select * FROM `tb_clientes` where id_cliente=".$id_cliente;
              $resultado_cliente = mysqli_query($conexao, $result_cliente);
              $lista = mysqli_fetch_array($resultado_cliente);
              $endereco=$lista['endereço_cliente'];
              $cep = intval(trim(substr($endereco, 4, 11)));
              $pos1 = strpos($endereco, "Numero");
              $pos2 = strpos($endereco, "Bairro");
              $numero = intval(trim(substr($endereco, ($pos1+7), $pos2)));
              $nome=$lista['nome_cliente'];
              $cpf=$lista['cpf_cliente'];
              $telefone=$lista['telefone_cliente'];
              $email=$lista['email'];
              ?>
              <br><br>
              <input type="hidden" value="<?php echo $id_cliente;?>" name="id_cliente">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="nomeCliente"> Nome cliente: </label>
                  <input class="form-control" type="text" id="nomeCliente" value="<?php echo $nome;?>" name="nomeCliente">
                </div>
                <div class="form-group col-md-6">
                  <label for="telCliente">Telefone cliente:</label>
                  <input class="form-control" type="text" value="<?php echo $telefone;?>" id="telCliente" name="telCliente">
                </div>
              </div>
              <label> Endereço do cliente<br><br>
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label>CEP:
                      <input class="form-control" name="cep" type="text" id="cep" value="<?php echo $cep;?>" /></label><br />
                    </div>
                    <div class="form-group col-md-5">
                      <label>Rua:
                        <input class="form-control" name="rua" type="text" id="rua" size="60" /></label>
                      </div>
                      <div class="form-group col-md-3">
                        <label>Nº:
                          <input class="form-control" name="numero" value="<?php echo $numero;?>" type="number" id="numero" size="2" /></label>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-5">
                          <label>Bairro:
                            <input class="form-control" name="bairro" type="text" id="bairro" size="40" /></label>
                          </div>
                          <div class="form-group col-md-4">
                            <label>Cidade:
                              <input class="form-control" name="cidade" type="text" id="cidade" size="40" /></label>
                            </div>
                            <div class="form-group col-md-3">
                              <label>Estado:
                                <input class="form-control" name="uf" type="text" id="uf" size="2" /></label>
                              </div>
                            </div>
                            <div class="form-row">
                              <div class="form-group col-md-4">
                                <label>CPF do cliente:
                                  <input class="form-control" type="text" id="cpfCliente" value="<?php echo $cpf;?>" name="cpfCliente">
                                </div>
                                <div class="form-group col-md-8">
                                  <label>E-mail do cliente:
                                    <input class="form-control" type="email" id="emailCliente" value="<?php echo $email;?>" name="emailCliente">
                                  </div>
                                </div>
                              </div>
                              <div class="form row">
                                <div class="form-group  col-md-6">
                                  <input class="btn btn-outline-success" type="submit" value="Atualizar cliente" name="enviar">
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
