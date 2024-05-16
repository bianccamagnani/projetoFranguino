<?php
if($_COOKIE['id_usuario']==''){
  HEADER("Location:login.php");
}
?>


<!DOCTYPE HTML>
<html lang="pt-br">
<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
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
  <?php

  require 'processa.php';
  $conecta = new shopping();
  $conecta->conexao();
  ?>
  <meta charset="UTF-8">
  <title>Carrinho</title>
  <style type="text/css">
  #wrapper {
    padding-left: 0;
    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    transition: all 0.5s ease;
  }
  #wrapper.toggled {
    padding-left: 250px;
  }
  #sidebar-wrapper {
    position: fixed;
    width: 0;
    height: 100%;
    margin-left: -250px;
    overflow-y: auto;
    overflow-x: hidden;
    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    transition: all 0.5s ease;
  }
  #wrapper.toggled #sidebar-wrapper {
    width: 250px;
  }

  ul{
    list-style-type:none;
  }
  #tgl{
    display: none;
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

  .brand_logo_container {
    position: absolute;
    height: 170px;
    width: 170px;
    top: 5%;
    left: 80%;
    border-radius: 50%;
    padding: 10px;
    text-align: center;
  }
  .brand_logo {
    height: 170px;
    width: 170px;
    border-radius: 50%;
    border: 2px solid white;
  }
  </style>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Completar venda</title>
  <link rel="icon" type="imagem/jpeg" href="img/franguinoLogo.jpeg" />
  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/simple-sidebar.css" rel="stylesheet">
  <script type="text/javascript">
  window.onload=function(){
  document.getElementById('pagamento').addEventListener('change', function () {
      var style = this.value == 'CartaoDinheiro' ? 'block' : 'none';
      document.getElementById('hidden_div').style.display = style;
  });
  }
  </script>
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

            <div class="container-fluid justify-content-center col-10">

              <?php
              $resgateId="select MAX(id_caixa) FROM `tb_caixa`";
              $id_ultimaVenda2=mysqli_query($conexao,$resgateId);
              $linha=mysqli_fetch_array($id_ultimaVenda2);
              $id_caixa=$linha['MAX(id_caixa)'];
              $pesquisa="select * FROM `tb_caixa` where id_caixa=".$id_caixa;
              $query=mysqli_query($conexao,$pesquisa);
              $linhas=mysqli_fetch_array($query);
              $fechamento=date("Y-m-d",strtotime($linhas['data_fechamento']));
              $abertura=date("Y-m-d",strtotime($linhas['data_abertura']));
              date_default_timezone_set('America/Sao_Paulo');
              $hoje=date("Y-m-d");
              if($abertura!=$hoje){ ?>
              </br></br>
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>
                  Caixa não aberto hoje!
                </strong><button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <?php
            }elseif($fechamento==$hoje){ ?>
            </br></br>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>
                Caixa já foi fechado hoje!
              </strong><button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <?php
          }else{
            ?>
            <div id="conteudo-master">
              <div id="conteudo">
                <table  class="table table-sm">
                  <?php
                  $Total=0;
                  foreach ($_SESSION as $nome => $quantidade) {
                    //verificar se a quantidade não está zerada
                    if($quantidade>0){
                      if(substr($nome,0,9) == 'produtos_'){
                        //limitou a palavra a nove caracteres

                        //pegar o id da session
                        $id = substr($nome, 9, (strlen($nome) -9));
                        //montar Carrinho
                        $PD = mysqli_query($conexao,"select id_estoque, descricaoProduto,
                        quantidadeEstoque, valorVenda FROM tb_estoque WHERE id_estoque=".$id);
                        while($list=mysqli_fetch_array($PD)){
                          $subTotal = $quantidade* $list['valorVenda'];
                          echo '
                          <tr>
                          <td> '.$list['descricaoProduto'].'</td>
                          <th> '.$quantidade.'</th>
                          <th> '.number_format($list['valorVenda'],2).' </th>
                          <td>
                          <th> '.number_format($subTotal,2).' </th>
                          </tr>          ' ;
                          $Total+=$subTotal;
                        } //ex:   notebook 1 x R$ 15,00 = R$ 15,00

                      }

                    }

                  }

                  echo '
                  <tr height=40 class="table-success">
                  <td >
                  <th> <h3>Total: </h3></th>
                  <th ><h3> '.number_format($Total,2).'</h3></th>
                  </td>
                  </tr>
                  <br><br>';

                  ?>
                </table>
              </div>
            </div>
            <div class="container-fluid justify-content-center col-10">
              <div id="conteudo">
                <form action="completarVenda.php" method="post">
                  <div class="row col-8">
                    <input type="hidden" size="" name="total" id="total" value="<?PHP echo $Total;?>">
                    <?php
                    if(isset($_COOKIE['msgVenda'])){
                      echo $_COOKIE['msgVenda'];
                    }?>
                    <div class="form-group">
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="categoriaEstoque">Recebido:</label>
                          <input class="form-control" name="soma2" id="soma2" value="" type="text">
                        </div>
                        <div class="form-group col-md-6">
                          <label for="categoriaEstoque">Troco:</label>
                          <input disabled class="form-control" style="background-color: white; border-color:white;" name="result" id="result" value="" type="text">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-row">
                      <div class="form-group col-md-3">
                        <label for="categoriaEstoque">Cliente:</label>
                        <select class="form-control" name="id_cliente" id="id_cliente">
                          <?php
                          $consulta="Select * from tb_clientes";
                          $linhas=mysqli_query($conexao,$consulta);
                          while($dados=mysqli_fetch_array($linhas)){
                            ?>
                            <option value="<?PHP echo $dados['id_cliente'];?>">
                              <?php echo $dados['nome_cliente']; ?>
                            </option>
                          <?php } ?>
                        </select></p>
                      </div>
                      <br>
                      <div class="form-group col-md-3">
                        <label>Tipo de pagamento:</label>
                        <select class="form-control"  name="pagamento" id="pagamento">
                          <option value="1">Dinheiro</option>
                          <option value="2">Cartão</option>
                          <option id="CartaoDinheiro" value="CartaoDinheiro"> Dinheiro e Cartão</option>
                        </select>
                      </div>

                      <div id="hidden_div" style="display: none;">
                      <div class="form-group col-md-7">
                        <label for="categoriaEstoque">Pago no cartão:</label>
                        <input class="form-control" name="cartaoPago" value=0 type="number" step="0.01" min="0">
                      </div>
                      </div>
                      <br>

                      <div class="form-group col-md-9">
                        <label>Para entregar?</label>
                        <div  class="custom-control custom-switch">
                          <input type="checkbox" name="selecionado" class="custom-control-input" id="customSwitch1"> <label class="custom-control-label" for="customSwitch1"></label>
                        </div>
                      </div>
                    </div>
                    <div class="tgl" id="tgl">
                      <div class="form-group col-md-8">
                        <label>Desconto:
                          <input class="form-control" name="desconto" type="number" value=0  step="0.01" min="0" /></label>
                        </div>
                      <div class="form-group col-md-7">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="pago" id="exampleRadios1" value=1 checked>
                          <label class="form-check-label" for="exampleRadios1">
                            Pago
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="pago" id="exampleRadios2" value=0>
                          <label class="form-check-label" for="exampleRadios2">
                            Não pago
                          </label>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-4">
                          <label>CEP:
                            <input class="form-control" name="cep" type="text" id="cep" value=""  /></label>
                          </div>
                          <div class="form-group col-md-4">
                            <label>Rua:
                              <input class="form-control" name="rua" type="text" id="rua" size="60" /></label>
                            </div><div class="form-group col-md-3">
                              <label>Nº:
                                <input class="form-control" name="numero" type="number" id="numero" size="2" /></label>
                              </div></div>
                              <div class="form-row">
                                <div class="form-group col-md-4">
                                  <label>Bairro:
                                    <input class="form-control" name="bairro" type="text" id="bairro" size="40" /></label>
                                  </div>
                                  <div class="form-group col-md-5">
                                    <label>Cidade:
                                      <input class="form-control" name="cidade" type="text" id="cidade" size="40" /></label>
                                    </div>
                                    <div class="form-group col-md-3">
                                      <label>Estado:
                                        <input class="form-control" name="uf" type="text" id="uf" size="2" /></label>
                                      </div>
                                    </div>

                                    <div class="form-row">
                                      <div class="form-group col-md-7">
                                        <label>Valor da entrega:
                                          <input class="form-control" type="number" id="valorEntrega" name="valorEntrega">
                                        </div>
                                      </div>
                                    </div>

                                    <br><br>
                                    <div class="form-group">
                                      <div class="form-row">
                                        <div class="form-group col-md-5">
                                          <input class="btn btn-outline-success" type="submit" value="Registrar venda" name="enviar">
                                        </div>
                                        <div class="form-group col-md-5">
                                          <input class="btn btn-outline-secondary" type="reset" value="      Limpar      ">
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="brand_logo_container">
                                    <img src="img/franguinoLogo.jpeg" class="brand_logo" alt="Logo">
                                  </div>
                                </div>
                              <?php } ?>

                              <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
                              <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
                              <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
                              <script src="vendor/jquery/jquery.min.js"></script>
                              <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
                              <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                              <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

                              <!-- Menu Toggle Script -->
                              <script>
                              jQuery(document).ready(function(){
                                jQuery('input').on('keyup',function(){
                                  if(jQuery(this).attr('name') === 'result'){
                                    return false;
                                  }
                                  var soma1 = (jQuery('#total').val() == '' ? 0 : jQuery('#total').val());
                                  var soma2 = (jQuery('#soma2').val() == '' ? 0 : jQuery('#soma2').val()).replace(',','.');
                                  var result = (parseFloat(soma2) - parseFloat(soma1));
                                  if(result <= 0 || result == '') {result = null}else{
                                    result = result.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });}
                                    jQuery('#result').val(result);
                                  });
                                });

                                $("#menu-toggle").click(function(e) {
                                  e.preventDefault();
                                  $("#wrapper").toggleClass("toggled");
                                });
                                </script>
                                <script type="text/javascript">
                                $('input[type="checkbox"]').on('click touchstart', function(){
                                  //capturando a quantidade de checkboxs checados
                                  let quantCheck = $('input[type="checkbox"]:checked').length;

                                  /*verificando se o número de itens checados é diferente
                                  de zero para então mostrar o botão*/
                                  if(quantCheck != 0) {
                                    $('#tgl').css('display', 'block')
                                  }
                                  else {
                                    $('#tgl').css('display', 'none')
                                  }
                                });
                                </script>
                                <script type="text/javascript">
                                  $("#cep").mask("00000-000");
                                </script>
                              </body>
                              </html>
