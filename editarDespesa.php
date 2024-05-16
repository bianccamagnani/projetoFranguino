
<!DOCTYPE HTML>
<?php
$id_despesa=$_GET['alterar'];
if($_COOKIE['id_usuario']==''){
  HEADER("Location:login.php");
}
$conexao=mysqli_connect("localhost","root","","franguino");
if(!$conexao){
  die("Erro".mysqli_error());
}
$variavel = mysqli_query($conexao,"select * from tb_usuario where id_usuario=".$_COOKIE['id_usuario']);
$dado2=mysqli_fetch_array($variavel);
$tipoUsuario=$dado2['tipo_usuario'];
if($tipoUsuario==2){
  header("Location:inicio.php");
}
?>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Editar despesa</title>
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
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
                  </ul>                </li>
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
              <form action="functionDespesa.php" method="post">
                <?php
                $result_cliente = "select * FROM `tb_despesa` where id_despesa=".$id_despesa;
                $resultado_cliente = mysqli_query($conexao, $result_cliente);
                $lista = mysqli_fetch_array($resultado_cliente);
                $data=$lista['data_despesa'];
                $id_fornecedor=$lista['id_fornecedor'];
                $id_categoriaDespesa=$lista['id_categoriaDespesa'];
                $valor=$lista['valorDespesa'];
                $vencimento=$lista['vencimentoDespesa'];
                $situacao=$lista['situacao'];
                $porQuantidade=$lista['porQuantidade'];
                $quantidade=$lista['quantidade'];
                $obs=$lista['observacao'];
                $descricao=$lista['descricao'];

                $consulta="Select nome_empresa from tb_fornecedores where id_fornecedores=".$id_fornecedor;
                $linhas=mysqli_query($conexao,$consulta);
                $dado=mysqli_fetch_array($linhas);
                $dados=$dado['nome_empresa'];
                $consulta2="Select nome_categoriaDespesa from tb_categoriadespesa where id_categoriaDespesa=".$id_categoriaDespesa;
                $linhas2=mysqli_query($conexao,$consulta2);
                $dado1=mysqli_fetch_array($linhas2);
                $dados1=$dado1['nome_categoriaDespesa'];
                ?>
                <br><br>
                <div class="form-group">
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <input type="hidden" value="<?php echo $id_despesa; ?>" name="id_despesa"></input>
                      <label for="dataCadastro">Data da compra:</label>
                      <input class="form-control" type="date" id="dataDespesa" name="dataDespesa" value="<?php echo $data;?>">
                    </div>
                    <div class="form-group col-md-4">
                      <?php if($vencimento=='1970-01-01'){ ?>
                      <label for="dataValidade" id="labelVencimento" style="display: none;" name="labelVencimento">Data do vencimento:</label>
                      <input class="form-control"  type="hidden" id="id_data" name="vencimentoDespesa" value="<?php echo $vencimento; ?>">
                    <?php }else{ ?>
                      <label for="dataValidade" id="labelVencimento" style="" name="labelVencimento">Data do vencimento:</label>
                      <input class="form-control"  type="date" id="id_data" name="vencimentoDespesa" value="<?php echo $vencimento; ?>">
                    <?php } ?>
                    </div>
                    <div class="form-group col-md-4">
                      <br>
                      <label for="dataCadastro">Data indeterminada:  </label>
                      <?php if($vencimento=='1970-01-01'){ ?>
                      <input  type="checkbox" id="id_checkbox" name="vencimentoIndeterminado" checked>
                    <?php }else{ ?>
                      <input  type="checkbox" id="id_checkbox" name="vencimentoIndeterminado">
                    <?php } ?>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="categoriaEstoque">Fornecedor:</label>
                      <select class="form-control"  name="fornecedorDespesa" id="fornecedorDespesa">
                        <option value="<?PHP echo $id_fornecedor; ?>">
                          <?php echo $dados; ?>
                        </option>
                        <?php
                        $consulta="Select * from tb_fornecedores";
                        $linhas=mysqli_query($conexao,$consulta);
                        while($dados=mysqli_fetch_array($linhas)){
                          if($id_fornecedor!=$dados['id_fornecedores']){?>
                            <option value="<?PHP echo $dados['id_fornecedores']; ?>">
                              <?php echo $dados['nome_empresa']; ?>
                            </option>

                          <?php }
                        } ?>
                      </select></p>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="categoriaEstoque">Categoria:</label>
                      <select class="form-control"  name="categoriaDespesa" id="categoriaDespesa">
                        <option value="<?PHP echo $id_categoriaDespesa; ?>">
                          <?php echo $dados1; ?>
                        </option>
                        <?php
                        $consulta="Select * from tb_categoriadespesa";
                        $linhas=mysqli_query($conexao,$consulta);
                        while($dados=mysqli_fetch_array($linhas)){
                            if($id_categoriaDespesa!=$dados['id_categoriaDespesa']){ ?>
                            <option value="<?PHP echo $dados['id_categoriaDespesa'];?>">
                              <?php echo $dados['nome_categoriaDespesa']; ?>
                            </option>
                          <?php   }
                        }
                        ?>
                      </select></p>
                    </div>
                  </div>
                  <div class="form row">
                    <div class="form-group col-md-10">
                      <fieldset id="situacaoDespesa">
                        <label>Situação:</label> <br>
                        <?php if($porQuantidade=="sim"){?>
                          <input class="form-check-input" type="radio" name="situacaoDespesa" checked value=1><label class="form-check-label" for="cMasc" > Pago   </label><br>
                          <input class="form-check-input" type="radio" name="situacaoDespesa"  value=0><label class="form-check-label" for="cFem">A pagar</label>
                        <?php }else{ ?>
                          <input class="form-check-input" type="radio" name="situacaoDespesa"  value=1><label class="form-check-label" for="cMasc" > Pago   </label><br>
                          <input class="form-check-input" type="radio" name="situacaoDespesa"  checked value=0><label class="form-check-label" for="cFem">A pagar</label>

                        <?php } ?>
                      </fieldset>
                    </div>
                    <div class="form-group col-10">
                      <fieldset id="situacaoDespesa">
                        <label>Por quantidade?</label> <br>
                        <?php if($porQuantidade=="nao"){?>
                          <input class="form-check-input" type="radio" name="porQuantidade"  value=1><label class="form-check-label" for="cMasc" > Sim   </label><br>
                          <input class="form-check-input" type="radio" name="porQuantidade" checked  value=0><label class="form-check-label" for="cFem">Não</label>

                        <?php }else{ ?>
                          <input class="form-check-input" type="radio" name="porQuantidade"  checked  value=1><label class="form-check-label" for="cMasc" > Sim   </label><br>

                          <input class="form-check-input" type="radio" name="porQuantidade"  value=0><label class="form-check-label" for="cFem">Não</label>
                        <?php } ?>
                      </fieldset>
                    </div>
                  </div>
                  <div class="form row">
                    <div class="form-group col-md-6">
                      <label for="valorVenda">Valor da despesa:</label>
                      <input class="form-control"  type="number" step="0.01" min="0" id="valorDespesa" name="valorDespesa" value="<?php echo $valor; ?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="valorVenda">Quantidade:</label>
                      <input class="form-control"  type="number" step="0.01" min="0" id="valorDespesa" name="quantidade" value="<?php echo $quantidade; ?>">
                    </div>
                  </div>
                  <div class="form row">
                    <div class="form-group col-md-6">

                      <label for="valorVenda">Descrição</label>
                      <textarea class="form-control" type="text" id="valorDespesa" name="descricao" ><?php echo $descricao; ?></textarea>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="valorVenda">Observação</label>
                      <textarea class="form-control" type="text" id="valorDespesa" name="obs"><?php echo $obs; ?></textarea>
                    </div>
                  </div>

                  <input type="submit" class="btn btn-outline-success" value="Atualizar despesa" name="enviar">

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
            <script>
            document.getElementById('id_checkbox').addEventListener('change', function() {
              if(this.checked) {
                document.getElementById('id_data').setAttribute('type', 'hidden');
                 document.getElementById('labelVencimento').style.display = 'none';
              } else{
                document.getElementById('id_data').removeAttribute('type', 'hidden');
                document.getElementById('id_data').setAttribute('type', 'date');
                document.getElementById('labelVencimento').style.display = '';

            }
            });
            </script>

          </body>
          </html>
