<!DOCTYPE HTML>
<html lang="pt-br">

<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <?php
  date_default_timezone_set ('America/Sao_Paulo');
  if($_COOKIE['id_usuario']==''){
    HEADER("Location:login.php");
  }
  if(isset($_GET['excluir'])){

    $atual = new DateTime();
                $texto = new DateTime(' -1 day');
                $ontem=$texto->format('Y-m-d');
    $conexao=mysqli_connect("localhost","root","","franguino");
    $qt = mysqli_query($conexao,"UPDATE `tb_estoque` SET `data_validadeProduto`='$ontem',`quantidadeEstoque`=0 WHERE `id_estoque`=".$_GET['excluir']);
  }
  ?>
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

  <title>Alteração estoque</title>
  <link rel="icon" type="imagem/jpeg" href="img/franguinoLogo.jpeg" />
  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/simple-sidebar.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.quicksearch/2.3.1/jquery.quicksearch.js"></script>

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

        <div class="container-fluid">
          <br>
          <div class="form-group input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
            <input name="consulta" id="txt_consulta" placeholder="Consultar" type="text" class="form-control">
          </div>
          <table id="tabela" class="table table-hover">

            <thead class="table table-sm">

              <?php
              $conexao=mysqli_connect("localhost","root","","franguino");
              if(!$conexao){
                die(mysqli_error());
              }
              $consulta="Select * from tb_estoque order by data_validadeProduto asc";
              $linhas=mysqli_query($conexao,$consulta);
              while($dado=mysqli_fetch_array($linhas)){
                $consulta2="Select * from categoriaestoque where id_CategoriaEstoque=".$dado['categoriaEstoque'];;
                $linhas2=mysqli_query($conexao,$consulta2);
                $consulta3="Select * from tb_usuario where id_usuario=".$dado['id_usuario'];;
                $linhas3=mysqli_query($conexao,$consulta3);
                $datadehoje = date_create($dado['data_validadeProduto']);
                $database= date_create();
                $resultado2 = date_diff($database, $datadehoje);
                $resultado=date_interval_format($resultado2, '%R%a');
                if($resultado<=2 & $resultado>0 & $dado['quantidadeEstoque']!=0){ ?>
                  <tr  class="table-warning">
                    <td>Data de cadastro no Estoque</td>
                    <td>Data de validade</td>
                    <td>Categoria</td>
                    <td>Descrição</td>
                    <td>Quantidade</td>
                    <td>Usuário que registrou</td>
                    <td>Custo do produto</td>
                    <td>Valor de venda</td>
                    <td>Ação</td>
                  </tr>
                </thead>

                <tbody>
                  <tr>
                    <td><?php echo date('d/m/Y', strtotime($dado['data_cadastroEstoque'])); ?></td>
                    <td><?php echo date('d/m/Y', strtotime($dado['data_validadeProduto'])); ?></td>
                    <?php while($dado2=mysqli_fetch_array($linhas2)){ ?>
                      <td><?php echo $dado2['nomeCategoriaEstoque']; }?></td>
                      <?php if($dado['descricaoProduto']==""){?>
                      <td><?php echo " - "; ?></td>
                    <?php }else{ ?>
                      <td><?php echo $dado['descricaoProduto']; ?></td>
                    <?php } ?>
                      <td><?php echo $dado['quantidadeEstoque']; ?></td>
                      <?php while($dado3=mysqli_fetch_array($linhas3)){ ?>
                        <td><?php echo $dado3['nome_usuario']; } ?></td>
                        <td><?php

                        echo number_format($dado['custoProduto'],2); ?></td>
                        <td><?php echo number_format($dado['valorVenda'],2); ?></td>
                        <td>
                          <p><a href="editarEstoque.php?alterar=<?php echo $dado['id_estoque']; ?>"><button class="btn btn-outline-success">Editar</button></a>
                          </p><p><a href="alteracaoEstoque.php?excluir=<?php echo $dado['id_estoque']; ?>"  data-confirm='Tem certeza que deseja excluir?'><button class="btn btn-outline-danger">Excluir</button></a>
                          </p>
                        </td>
                      </tr>
                    <?php }elseif($resultado<=0 & $dado['quantidadeEstoque']!=0){?>
                      <tr class="table-danger">
                        <td>Data de cadastro no Estoque</td>
                        <td>Data de validade</td>
                        <td>Categoria</td>
                        <td>Descrição</td>
                        <td>Quantidade</td>
                        <td>Usuário que registrou</td>
                        <td>Custo do produto</td>
                        <td>Valor de venda</td>
                        <td>Ação</td>
                      </tr>
                    </thead>

                    <tbody>
                      <tr>
                        <td><?php echo date('d/m/Y', strtotime($dado['data_cadastroEstoque'])); ?></td>
                        <td><?php echo date('d/m/Y', strtotime($dado['data_validadeProduto'])); ?></td>
                        <?php while($dado2=mysqli_fetch_array($linhas2)){ ?>
                          <td><?php echo $dado2['nomeCategoriaEstoque']; }?></td>
                          <td><?php echo $dado['descricaoProduto']; ?></td>
                          <td><?php echo $dado['quantidadeEstoque']; ?></td>
                          <?php while($dado3=mysqli_fetch_array($linhas3)){ ?>
                            <td><?php echo $dado3['nome_usuario']; } ?></td>
                            <td><?php

                            echo number_format($dado['custoProduto'],2); ?></td>
                            <td><?php echo number_format($dado['valorVenda'],2); ?></td>
                            <td>
                              <p><a href="editarEstoque.php?alterar=<?php echo $dado['id_estoque']; ?>"><button class="btn btn-outline-success">Editar</button></a>
                              </p><p><a href="alteracaoEstoque.php?excluir=<?php echo $dado['id_estoque']; ?>" data-confirm='Tem certeza que deseja excluir?'><button class="btn btn-outline-danger">Excluir</button></a>
                              </p>
                            </td>
                          </tr>
                          <?php
                        }elseif($dado['quantidadeEstoque']==0 & $resultado>=0){?>
                          <tr class="table-active">
                            <td>Data de cadastro no Estoque</td>
                            <td>Data de validade</td>
                            <td>Categoria</td>
                            <td>Descrição</td>
                            <td>Quantidade</td>
                            <td>Usuário que registrou</td>
                            <td>Custo do produto</td>
                            <td>Valor de venda</td>
                            <td>Ação</td>
                          </tr>
                        </thead>

                        <tbody>
                          <tr  role="alert">
                            <td><?php echo date('d/m/Y', strtotime($dado['data_cadastroEstoque'])); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($dado['data_validadeProduto'])); ?></td>
                            <?php while($dado2=mysqli_fetch_array($linhas2)){ ?>
                              <td><?php echo $dado2['nomeCategoriaEstoque']; }?></td>
                              <td><?php echo $dado['descricaoProduto']; ?></td>
                              <td><?php echo $dado['quantidadeEstoque']; ?></td>
                              <?php while($dado3=mysqli_fetch_array($linhas3)){ ?>
                                <td><?php echo $dado3['nome_usuario']; } ?></td>
                                <td><?php

                                echo number_format($dado['custoProduto'],2); ?></td>
                                <td><?php echo number_format($dado['valorVenda'],2); ?></td>
                                <td>
                                  <p><a href="editarEstoque.php?alterar=<?php echo $dado['id_estoque']; ?>"><button class="btn btn-outline-success">Editar</button></a>
                                  </p><p><a href="alteracaoEstoque.php?excluir=<?php echo $dado['id_estoque']; ?>" data-confirm='Tem certeza que deseja excluir?' ><button class="btn btn-outline-danger">Excluir</button></a>
                                  </p>
                                </td>
                              </tr>
                              <?php
                            }elseif($dado['quantidadeEstoque']==0 & $resultado<=0){

                            }else{?>
                              <tr class="alert alert-success" role="alert">
                                <td>Data de cadastro no Estoque</td>
                                <td>Data de validade</td>
                                <td>Categoria</td>
                                <td>Descrição</td>
                                <td>Quantidade</td>
                                <td>Usuário que registrou</td>
                                <td>Custo do produto</td>
                                <td>Valor de venda</td>
                                <td>Ação</td>
                              </tr>
                            </thead>

                            <tbody>
                              <tr  role="alert">
                                <td><?php echo date('d/m/Y', strtotime($dado['data_cadastroEstoque'])); ?></td>
                                <td><?php echo date('d/m/Y', strtotime($dado['data_validadeProduto'])); ?></td>
                                <?php while($dado2=mysqli_fetch_array($linhas2)){ ?>
                                  <td><?php echo $dado2['nomeCategoriaEstoque']; }?></td>
                                  <td><?php echo $dado['descricaoProduto']; ?></td>
                                  <td><?php echo $dado['quantidadeEstoque']; ?></td>
                                  <?php while($dado3=mysqli_fetch_array($linhas3)){ ?>
                                    <td><?php echo $dado3['nome_usuario']; } ?></td>
                                    <td><?php

                                    echo number_format($dado['custoProduto'],2); ?></td>
                                    <td><?php echo number_format($dado['valorVenda'],2); ?></td>
                                    <td>
                                      <p><a href="editarEstoque.php?alterar=<?php echo $dado['id_estoque']; ?>"><button class="btn btn-outline-success">Editar</button></a>
                                      </p><p><a href="alteracaoEstoque.php?excluir=<?php echo $dado['id_estoque']; ?>" data-confirm='Tem certeza que deseja excluir?'><button class="btn btn-outline-danger">Excluir</button></a>
                                      </p>
                                    </td>
                                  </tr>

                                  <?php
                                }
                              }?>
                            </tbody>
                          </table>
                        </div>
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                              </div>
                              <div class="modal-body">
                                <table  class="table table-hover">
                                  <thead class="table table-sm">
                                    <tr class="table-active">
                                      <td>Não está para vencer, mas a quantidade é igual a zero</td>
                                    </tr>
                                    <tr class="table-warning">
                                      <td>Está vencendo, mas a quantidade está acima de 0 no estoque</td>
                                    </tr>
                                    <tr class="table-success">
                                      <td>Não está perto do vencimento e a quantidade no estoque está ok</td>
                                    </tr>
                                    <tr class="table-danger">
                                      <td>Está vencido, mas a quantidade do estoque é maior que 0.</td>
                                    </tr>
                                  </thead>
                                    </table>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-dismiss="modal">Fechar</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <script>
                        $('input#txt_consulta').quicksearch('table#tabela tbody tr');
                        </script>
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
                        // function funcao1($valor)
                        // {
                        //   var r=confirm("Deseja realmente excluir?");
                        //   if (r==true)
                        //   {
                        //     var link = document.getElementById("demo");
                        //     link.setAttribute("href", "alteracaoEstoque.php?excluir="+$valor);
                        //   }
                        //   else
                        //   {
                        //     link.setAttribute("href", " ");
                        //   }
                        // }
                        </script>

                      </body>
                      </html>
