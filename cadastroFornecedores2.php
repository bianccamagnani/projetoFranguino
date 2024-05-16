<?php
$conexao=mysqli_connect("localhost","root","","franguino");
$variavel = mysqli_query($conexao,"select * from tb_usuario where id_usuario=".$_COOKIE['id_usuario']);
$dado2=mysqli_fetch_array($variavel);
$tipoUsuario=$dado2['tipo_usuario'];
if($tipoUsuario==2){
  header("Location:inicio.php");
}
?>
<!DOCTYPE HTML>
<html lang="pt-br">
<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <meta charset="UTF-8">
  <title>Cadastro de fornecedores</title>
  <link rel="icon" type="imagem/jpeg" href="img/franguinoLogo.jpeg" />
  <link rel="stylesheet" type="text/css"  href="estilo.css" />
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"
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

  </script>
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
        </nav>


        <div class="container-fluid justify-content-center col-6">
          <?php
          if(isset($_COOKIE['msg'])){
            echo $_COOKIE['msg'];
          }?>
          <form action="cadastroFornecedores.php" method="post">
            <br><br>
            <div class="row">
              <div class="form-group">
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="nomeCliente"> Nome da empresa: </label>
                    <input  class="form-control" type="text" id="nomefornecedor" name="nomefornecedor">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="telCliente">Telefone do fornecedor:</label>
                    <input  class="form-control" type="text" id="telfornecedor" name="telfornecedor"></div>
                    <div class="form-group col-md-4">
                      <label>CNPJ do fornecedor:</label>
                      <input  class="form-control" type="text" id="cnpjfornecedor" name="cnpjfornecedor"></div>
                    </div>
                    <label> Endereço do fornecedor</label><br>
                    <div class="form-row">
                      <div class="form-group col-md-4"><label>CEP:
                        <input  class="form-control" name="cep" type="text" id="cep" value=""  /></label>
                      </div><div class="form-group col-md-4">
                        <label>Rua:
                          <input  class="form-control" name="rua" type="text" id="rua" size="60" /></label>
                        </div><div class="form-group col-md-4">
                          <label>Nº:
                            <input  class="form-control" name="numero" type="number" id="numero" size="2" /></label>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-4">
                            <label>Bairro:
                              <input  class="form-control" name="bairro" type="text" id="bairro" size="40" /></label>
                            </div><div class="form-group col-md-4"><label>Cidade:
                              <input  class="form-control" name="cidade" type="text" id="cidade" size="40" /></label>
                            </div><div class="form-group col-md-4">  <label>Estado:
                              <input  class="form-control" name="uf" type="text" id="uf" size="2" /></label>
                            </div>
                          </div>
                          <div class="form-row">
                            <div class="form-group col-mb-6">
                              <label>Contato do fornecedor:
                                <textarea  class="form-control" id="contatofornecedor" name="contatofornecedor"></textarea>
                              </div><div class="form-group col-mb-6">
                                <label>Observação:
                                  <textarea  class="form-control" id="obsFornecedor" name="obsFornecedor"></textarea>
                                </div>
                              </div>
                              <div class="form row">
                                <div class="form-group  col-md-6">
                                  <input class="btn btn-outline-success" type="submit" name="enviar" value="Registrar fornecedor">
                                </div>
                                <div class="form-group  col-md-6">
                                  <input class="btn btn-outline-secondary" type="reset" value="      Limpar      ">
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
                        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
                        <script src="vendor/jquery/jquery.min.js"></script>
                        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

                        <!-- Menu Toggle Script -->
                        <script>
                        $("#menu-toggle").click(function(e) {
                          e.preventDefault();
                          $("#wrapper").toggleClass("toggled");
                        });
                        </script>
                        <script type="text/javascript">
                          $("#telfornecedor").mask("(00) 0000-0000");
                          $("#cep").mask("00000-000");
                          $("#cnpjfornecedor").mask("00.000.000/0000-00");

                        </script>

                      </body>
                      </html>
