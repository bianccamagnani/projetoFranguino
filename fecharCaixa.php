<?php
if($_COOKIE['id_usuario']==''){
  HEADER("Location:login.php");
}
$conexao=mysqli_connect("localhost",
"root","","franguino");
if(!$conexao){
  die("Erro".mysqli_error());
}
date_default_timezone_set ('America/Sao_Paulo');
$atual = new DateTime();
$today = $atual->format('Y-m-d');
$resgateId3="select MAX(id_caixa) FROM `tb_caixa`";
$id_ultimaVenda4=mysqli_query($conexao,$resgateId3);
$linha=mysqli_fetch_array($id_ultimaVenda4);
$id_caixa2=$linha['MAX(id_caixa)'];
$pesquisa2="select * from tb_caixa where id_caixa='$id_caixa2'";
$query=mysqli_query($conexao,$pesquisa2);
$array=mysqli_fetch_array($query);
$verifica = $array['data_fechamento'];
$vai=$array['data_abertura'];
if($verifica=="1970-01-01" & $vai!=$today){
  $pesquisar="select * from tb_vendas where data_venda='$vai' and (tipo_pagamento=1 or tipo_pagamento=3)";
  $exec3=mysqli_query($conexao,$pesquisar);
  $total1=0;
  while($row2=mysqli_fetch_array($exec3)){
    $total1+=$row2['valor_venda'];
  }
  $update2="UPDATE `tb_caixa` SET `data_fechamento`='$vai',`valor`='$total1',`trocoFinal`=0 WHERE id_Caixa='$id_caixa2'";
  $exec=mysqli_query($conexao,$update2);
  header("Location: fecharCaixa.php");
}


if(isset($_GET['trocos'])){
  $troco=$_GET['trocos'];
  $today = date("Y-m-d");
  $pessoaAbriu=$_COOKIE['id_usuario'];
  $inserir="INSERT INTO `tb_caixa`( `data_abertura`, `data_fechamento`,  `troco`, `trocoFinal`, `pessoaAbriu`) VALUES ('$today', '1970-01-01','$troco', -1,$pessoaAbriu)";
  $exec=mysqli_query($conexao,$inserir);
  if($exec){
    header("Location: fecharCaixa.php");
  }
}
if(isset($_GET['retirado'])){
  $id=$_GET['id_caixa'];
  $usuarioRetirada=$_COOKIE['id_usuario'];
  $valor=$_GET['retirado'];
  $update="UPDATE `tb_caixa` SET `trocoFinal`=$valor,`pessoaRetirada`=$usuarioRetirada WHERE id_caixa=$id";
  $exec=mysqli_query($conexao,$update);
  if($exec){
    header("Location: fecharCaixa.php");
  }
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
  <title>Fechamento de caixa</title>
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

            <div class="container-fluid justify-content-center col-10">
              <br>
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>O caixa só pode ser fechado uma vez ao dia!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="container-fluid justify-content-center col-10">
                <div id="conteudo">

                  <form action="fecharCaixa.php" method="post">
                    <input type="hidden" name="id_usuario" value="<?php echo $_COOKIE['id_usuario']; ?>"></input>

                    <div class="form-group">
                      <div class="form-row">
                        <div class="form-group col-md-7">
                          <br><br><br>
                          <?php
                          $totalSangria2=0;
                          $resgateId="select MAX(id_caixa) FROM `tb_caixa`";
                          $id_ultimaVenda2=mysqli_query($conexao,$resgateId);
                          $linha=mysqli_fetch_array($id_ultimaVenda2);
                          $id_caixa=$linha['MAX(id_caixa)'];
                          $pesquisa="select * FROM `tb_caixa` where id_caixa=".$id_caixa;
                          $query=mysqli_query($conexao,$pesquisa);
                          $linhas=mysqli_fetch_array($query);
                          $dataSangria=$linhas['data_abertura'];
                          $pesquisa4="select * FROM `tb_sangria` where data_sangria='$dataSangria'";
                          $query4=mysqli_query($conexao,$pesquisa4);
                          while($linhas4=mysqli_fetch_array($query4)){
                            $totalSangria2+=$linhas4['valorSangria'];
                          }
                          $noCaixa1=$linhas['troco'];
                          $noCaixa2=$linhas['valor'];
                          $noCaixa3=$linhas['trocoFinal'];
                          $fechamento=date("Y-m-d",strtotime($linhas['data_fechamento']));
                          $abertura=date("Y-m-d",strtotime($linhas['data_abertura']));
                          $trocoFinal=$linhas['trocoFinal'];
                          $noCaixa=($noCaixa1+$noCaixa2)-$noCaixa3-$totalSangria2;
                          date_default_timezone_set('America/Sao_Paulo');
                          $hoje=date("Y-m-d");
                          if($fechamento!=$hoje){
                            if($fechamento!="1970-01-01"){ ?>
                              <div class="form-group col-md-5">
                                <?php if(isset($_POST['trocoCaixa'])){
                                  echo "";
                                }else { ?>
                                  <label>Troco anterior: <?php echo "R$: ".number_format($noCaixa,2); ?></label>
                                  <label for="categoriaEstoque">Troco atual:</label>
                                  <input type="number" step="0.01" min="0" class="form-control" name="troco"></input>
                                  <br></br>
                                  <input type="submit" name="trocoCaixa" class="btn btn-outline-success" value="Confirmar valor do caixa"></input>
                                <?php } ?>
                              </div>
                            </form>
                            <br><br>
                            <div class="form-group">
                              <div class="form-row">
                                <div class="form-group col-md-5">
                                  <?php if(isset($_POST['trocoCaixa'])){?>
                                    <a href="fecharCaixa.php?trocos=<?php echo $_POST['troco']; ?>" data-confirm='Tem certeza que deseja abrir o caixa?'><input type="submit" class="btn btn-outline-success" value="               Abrir               "></input></a>
                                  <?php } ?>
                                </div>
                              <?php }elseif($abertura!="1970-01-01" && $trocoFinal==(-1)){ ?>
                                  <form action="fecharCaixa.php" method="POST">
                                    <input type="hidden" value="<?php echo $id_caixa; ?>" name="idCaixa" id="idCaixa">
                                    <label> Retirado do caixa: </label>
                                    <div class="col-md-5">
                                      <input class="form-control" type="number" step="0.01" min="0" value=0 name="valor" id="retirada">
                                    </div>
                                    <br>
                                    <div class="col-md-5">
                                      <a href="" id="demo2" onclick="funcao2()" ><button type="button" class="btn btn-outline-info">               Retirar               </button></a>
                                    </div>

                                  </form>
                                <?php }elseif($abertura!="1970-01-01" && $trocoFinal!=(-1)){ ?>

                                <div class="col-md-5">
                                  <a href="" id="demo" onclick="funcao1()" ><button type="button" class="btn btn-outline-danger">               Fechar               </button></a>
                                </div>

                                <?php
                              }
                            }
                            ?>

                            <div class="brand_logo_container">
                              <img src="img/franguinoLogo.jpeg" class="brand_logo" alt="Logo">
                            </div>
                          </div>
                        </div>

                      </div>
                      <?php

                      if(isset($_POST['botao'])){
                        $id=$_POST['idCaixa'];
                        $usuarioRetirada=$_POST['id_usuario'];
                        $valor=$_POST['valor'];
                        $update="UPDATE `tb_caixa` SET `trocoFinal`=$valor,`pessoaRetirada`=$usuarioRetirada WHERE id_caixa=$id";
                        $exec=mysqli_query($conexao,$update);
                      }
                      ?>


                      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
                      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
                      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
                      <script src="vendor/jquery/jquery.min.js"></script>
                      <script src="js/personalizado.js"></script>
                      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

                      <!-- Menu Toggle Script -->
                      <script>
                      $("#menu-toggle").click(function(e) {
                        e.preventDefault();
                        $("#wrapper").toggleClass("toggled");
                      });
                      function funcao1(){
                        var r=confirm("Deseja realmente fechar o caixa?");
                        if (r==true)
                        {
                          var link = document.getElementById("demo");
                          link.setAttribute("href", "fechaCaixa.php?fechar=1");
                        }
                        else
                        {
                          link.setAttribute("href", " ");
                        }
                      }

                      </script>
                      <script>
                      function funcao2(){
                        var r=confirm("Deseja realmente fechar o caixa?");
                         var valor = parseFloat(document.getElementById("retirada").value);
                         var idcaixa = parseInt(document.getElementById("idCaixa").value);
                        if (r==true)
                        {
                          var link = document.getElementById("demo2");
                          link.setAttribute("href", "fecharCaixa.php?retirado="+valor+"&id_caixa="+idcaixa);
                        }
                        else
                        {
                          link.setAttribute("href", " ");
                        }
                      }
                      </script>
                    </body>
                    </html>
