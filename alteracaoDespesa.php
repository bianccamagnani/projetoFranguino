<!DOCTYPE HTML>
<html lang="pt-br">

<head>

  <?php
  date_default_timezone_set ('America/Sao_Paulo');
  if($_COOKIE['id_usuario']==''){
    HEADER("Location:login.php");
  }
  if(isset($_GET['excluir'])){
    $conexao=mysqli_connect("localhost","root","","franguino");
    $qt = mysqli_query($conexao,"DELETE FROM `tb_despesa` WHERE id_despesa=".$_GET['excluir']);
  }
  if(isset($_GET['pago'])){
    $conexao=mysqli_connect("localhost","root","","franguino");
    $linhas=mysqli_query($conexao, "update tb_despesa set `situacao`='sim' where id_despesa=".$_GET['pago']);
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

  <title>Alteração despesa</title>
  <link rel="icon" type="imagem/jpeg" href="img/franguinoLogo.jpeg" />
  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


  <!-- Custom styles for this template -->
  <link href="css/simple-sidebar.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
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
                <thead class="table">
                  <?php
                  $consulta="Select * from tb_despesa order by vencimentoDespesa asc";
                  $linhas=mysqli_query($conexao,$consulta);
                  while($dado=mysqli_fetch_array($linhas)){
                    $consulta2="Select * from tb_fornecedores where id_fornecedores=".$dado['id_fornecedor']; ;
                    $linhas2=mysqli_query($conexao,$consulta2);
                    $consulta3="Select * from tb_categoriadespesa where id_categoriaDespesa=".$dado['id_categoriaDespesa'];;
                    $linhas3=mysqli_query($conexao,$consulta3);
                    $datadehoje = date_create($dado['vencimentoDespesa']);
                    $database= date_create();
                    $resultado2 = date_diff($database, $datadehoje);
                    $resultado=date_interval_format($resultado2, '%R%a');
                    if($resultado<=2 & $resultado>0 & $dado['quantidade']>5 & $dado['vencimentoDespesa']!="1970-01-01"){
                      ?>
                      <tr class="table-warning table-sm">
                        <td>Descrição</td>
                        <td>Data do registro</td>
                        <td>Fornecedor</td>
                        <td>Categoria</td>
                        <td>Valor</td>
                        <td>Data de vencimento</td>
                        <td>Pago</td>
                        <td>Por qt?</td>
                        <td>Quantidade</td>
                        <td>Observação</td>
                        <td>Ações</td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <?php if($dado['descricao']!=""){?>
                          <td><?php echo $dado['descricao']; ?></td>
                        <?php }else{ ?>
                          <td> - </td>
                        <?php }?>
                        <td><?php echo date('d/m/Y', strtotime($dado['data_despesa'])); ?></td>
                        <?php while($dado2=mysqli_fetch_array($linhas2)){ ?>
                          <td><?php echo $dado2['nome_empresa']; }?></td>
                          <?php while($dado3=mysqli_fetch_array($linhas3)){ ?>
                            <td><?php echo $dado3['nome_categoriaDespesa'];}?></td>
                            <?php if($dado['valorDespesa']==0){ ?>
                              <td><?php echo number_format($dado['valorDespesa'],2); ?></td>
                            <?php } else { ?>
                              <td><?php echo number_format($dado['valorDespesa'],2); ?></td>
                            <?php } ?>
                            <td><?php echo date('d/m/Y', strtotime($dado['vencimentoDespesa'])); ?></td>
                            <td><?php echo $dado['situacao']; ?></td>
                            <?php if($dado['porQuantidade']=="sim"){?>
                              <td><?php echo $dado['porQuantidade']; ?></td>
                            <?php }else { ?>
                              <td> - </td>
                            <?php          } ?>
                            <?php if($dado['quantidade']==0){?>
                              <td> - </td>
                            <?php }else { ?>
                              <td><?php echo $dado['quantidade']; ?></td>
                            <?php }?>
                            <?php
                            if($dado['observacao']!=""){?>
                              <td><?php echo $dado['observacao']; ?></td>
                            <?php }else{ ?>
                              <td> - </td>
                            <?php } ?>
                            <td>
                              <a href="editarDespesa.php?alterar=<?php echo $dado['id_despesa']; ?>"> <button class="btn btn-outline-success">Editar</button></a>
                              <a href="alteracaoDespesa.php?excluir=<?php echo $dado['id_despesa']; ?>" data-confirm='Tem certeza que deseja excluir?'><button class="btn btn-outline-danger">Excluir</button></a>
                              <?php
                              if($dado['situacao']=="nao"){
                                ?>
                                <a href="alteracaoDespesa.php?pago=<?php echo $dado['id_despesa']; ?>" ><button type="button" class="btn btn-outline-info">Pago</button></a>
                                <?php
                              }
                              ?>
                            </td>
                          </tr>

                        </tbody>
                      <?php }elseif($resultado<=0 & $dado['quantidade']>5 & $dado['vencimentoDespesa']!="1970-01-01"){?>
                        <tr class="table-danger table-sm">
                          <td>Descrição</td>
                          <td>Data do registro</td>
                          <td>Fornecedor</td>
                          <td>Categoria</td>
                          <td>Valor</td>
                          <td>Data de vencimento</td>
                          <td>Pago</td>
                          <td>Por qt?</td>
                          <td>Quantidade</td>
                          <td>Observação</td>
                          <td>Ações</td>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <?php if($dado['descricao']!=""){?>
                            <td><?php echo $dado['descricao']; ?></td>
                          <?php }else{ ?>
                            <td> - </td>
                          <?php }?>
                          <td><?php echo date('d/m/Y', strtotime($dado['data_despesa'])); ?></td>
                          <?php while($dado2=mysqli_fetch_array($linhas2)){ ?>
                            <td><?php echo $dado2['nome_empresa']; }?></td>
                            <?php while($dado3=mysqli_fetch_array($linhas3)){ ?>
                              <td><?php echo $dado3['nome_categoriaDespesa'];}?></td>
                              <?php if($dado['valorDespesa']==0){ ?>
                                <td><?php echo number_format($dado['valorDespesa'],2); ?></td>
                              <?php } else { ?>
                                <td><?php echo number_format($dado['valorDespesa'],2); ?></td>
                              <?php } ?>
                              <td><?php echo date('d/m/Y', strtotime($dado['vencimentoDespesa'])); ?></td>
                              <td><?php echo $dado['situacao']; ?></td>
                              <?php if($dado['porQuantidade']=="sim"){?>
                                <td><?php echo $dado['porQuantidade']; ?></td>
                              <?php }else { ?>
                                <td> - </td>
                              <?php          } ?>
                              <?php if($dado['quantidade']==0){?>
                                <td> - </td>
                              <?php }else { ?>
                                <td><?php echo $dado['quantidade']; ?></td>
                              <?php }?>
                              <?php
                              if($dado['observacao']!=""){?>
                                <td><?php echo $dado['observacao']; ?></td>
                              <?php }else{ ?>
                                <td> - </td>
                              <?php } ?>
                              <td>
                                <a href="editarDespesa.php?alterar=<?php echo $dado['id_despesa']; ?>"> <button class="btn btn-outline-success">Editar</button></a>
                                <a href="alteracaoDespesa.php?excluir=<?php echo $dado['id_despesa']; ?>" data-confirm='Tem certeza que deseja excluir?'><button class="btn btn-outline-danger">Excluir</button></a>
                                <?php
                                if($dado['situacao']=="nao"){
                                  ?>
                                  <a href="alteracaoDespesa.php?pago=<?php echo $dado['id_despesa']; ?>" ><button type="button" class="btn btn-outline-info">Pago</button></a>
                                  <?php
                                }
                                ?>
                              </td>
                            </tr>
                          <?php }elseif($dado['quantidade']==0 & $resultado>=5 & $dado['vencimentoDespesa']!="1970-01-01"){ ?>
                            <tr class="table-light table-sm">
                              <td>Descrição</td>
                              <td>Data do registro</td>
                              <td>Fornecedor</td>
                              <td>Categoria</td>
                              <td>Valor</td>
                              <td>Data de vencimento</td>
                              <td>Pago</td>
                              <td>Por qt?</td>
                              <td>Quantidade</td>
                              <td>Observação</td>
                              <td>Ações</td>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <?php if($dado['descricao']!=""){?>
                                <td><?php echo $dado['descricao']; ?></td>
                              <?php }else{ ?>
                                <td> - </td>
                              <?php }?>
                              <td><?php echo date('d/m/Y', strtotime($dado['data_despesa'])); ?></td>
                              <?php while($dado2=mysqli_fetch_array($linhas2)){ ?>
                                <td><?php echo $dado2['nome_empresa']; }?></td>
                                <?php while($dado3=mysqli_fetch_array($linhas3)){ ?>
                                  <td><?php echo $dado3['nome_categoriaDespesa'];}?></td>
                                  <?php if($dado['valorDespesa']==0){ ?>
                                    <td><?php echo number_format($dado['valorDespesa'],2); ?></td>
                                  <?php } else { ?>
                                    <td><?php echo number_format($dado['valorDespesa'],2); ?></td>
                                  <?php } ?>
                                  <td><?php echo date('d/m/Y', strtotime($dado['vencimentoDespesa'])); ?></td>
                                  <td><?php echo $dado['situacao']; ?></td>
                                  <?php if($dado['porQuantidade']=="sim"){?>
                                    <td><?php echo $dado['porQuantidade']; ?></td>
                                  <?php }else { ?>
                                    <td> - </td>
                                  <?php          } ?>
                                  <?php if($dado['quantidade']==0){?>
                                    <td> - </td>
                                  <?php }else { ?>
                                    <td><?php echo $dado['quantidade']; ?></td>
                                  <?php }?>
                                  <?php
                                  if($dado['observacao']!=""){?>
                                    <td><?php echo $dado['observacao']; ?></td>
                                  <?php }else{ ?>
                                    <td> - </td>
                                  <?php } ?>
                                  <td>
                                    <a href="editarDespesa.php?alterar=<?php echo $dado['id_despesa']; ?>"> <button class="btn btn-outline-success">Editar</button></a>
                                    <a href="alteracaoDespesa.php?excluir=<?php echo $dado['id_despesa']; ?>" data-confirm='Tem certeza que deseja excluir?'><button class="btn btn-outline-danger">Excluir</button></a>
                                    <?php
                                    if($dado['situacao']=="nao"){
                                      ?>
                                      <a href="alteracaoDespesa.php?pago=<?php echo $dado['id_despesa']; ?>" ><button type="button" class="btn btn-outline-info">Pago</button></a>
                                      <?php
                                    }
                                    ?>
                                  </td>
                                </tr>
                              </tbody>
                            <?php }elseif($dado['quantidade']<=5 & $dado['quantidade']>0 & $dado['vencimentoDespesa']!="1970-01-01"){ ?>
                              <tr class="table-info table-sm">
                                <td>Descrição</td>
                                <td>Data do registro</td>
                                <td>Fornecedor</td>
                                <td>Categoria</td>
                                <td>Valor</td>
                                <td>Data de vencimento</td>
                                <td>Pago</td>
                                <td>Por qt?</td>
                                <td>Quantidade</td>
                                <td>Observação</td>
                                <td>Ações</td>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <?php if($dado['descricao']!=""){?>
                                  <td><?php echo $dado['descricao']; ?></td>
                                <?php }else{ ?>
                                  <td> - </td>
                                <?php }?>
                                <td><?php echo date('d/m/Y', strtotime($dado['data_despesa'])); ?></td>
                                <?php while($dado2=mysqli_fetch_array($linhas2)){ ?>
                                  <td><?php echo $dado2['nome_empresa']; }?></td>
                                  <?php while($dado3=mysqli_fetch_array($linhas3)){ ?>
                                    <td><?php echo $dado3['nome_categoriaDespesa'];}?></td>
                                    <?php if($dado['valorDespesa']==0){ ?>
                                      <td><?php echo number_format($dado['valorDespesa'],2); ?></td>
                                    <?php } else { ?>
                                      <td><?php echo number_format($dado['valorDespesa'],2); ?></td>
                                    <?php } ?>
                                    <td><?php echo date('d/m/Y', strtotime($dado['vencimentoDespesa'])); ?></td>
                                    <td><?php echo $dado['situacao']; ?></td>
                                    <?php if($dado['porQuantidade']=="sim"){?>
                                      <td><?php echo $dado['porQuantidade']; ?></td>
                                    <?php }else { ?>
                                      <td> - </td>
                                    <?php          } ?>
                                    <?php if($dado['quantidade']==0){?>
                                      <td> - </td>
                                    <?php }else { ?>
                                      <td><?php echo $dado['quantidade']; ?></td>
                                    <?php }?>
                                    <?php
                                    if($dado['observacao']!=""){?>
                                      <td><?php echo $dado['observacao']; ?></td>
                                    <?php }else{ ?>
                                      <td> - </td>
                                    <?php } ?>
                                    <td>
                                      <a href="editarDespesa.php?alterar=<?php echo $dado['id_despesa']; ?>"> <button class="btn btn-outline-success">Editar</button></a>
                                      <a href="alteracaoDespesa.php?excluir=<?php echo $dado['id_despesa']; ?>" data-confirm='Tem certeza que deseja excluir?'><button class="btn btn-outline-danger">Excluir</button></a>
                                      <?php
                                      if($dado['situacao']=="nao"){
                                        ?>
                                        <a href="alteracaoDespesa.php?pago=<?php echo $dado['id_despesa']; ?>" ><button type="button" class="btn btn-outline-info">Pago</button></a>
                                        <?php
                                      }
                                      ?>
                                    </td>
                                  </tr>

                                <?php }elseif($dado['vencimentoDespesa']=="1970-01-01" and $dado['quantidade']>5){ ?>
                                  <tr class="table-primary table-sm">
                                    <td>Descrição</td>
                                    <td>Data do registro</td>
                                    <td>Fornecedor</td>
                                    <td>Categoria</td>
                                    <td>Valor</td>
                                    <td>Data de vencimento</td>
                                    <td>Pago</td>
                                    <td>Por qt?</td>
                                    <td>Quantidade</td>
                                    <td>Observação</td>
                                    <td>Ações</td>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <?php if($dado['descricao']!=""){?>
                                      <td><?php echo $dado['descricao']; ?></td>
                                    <?php }else{ ?>
                                      <td> - </td>
                                    <?php }?>
                                    <td><?php echo date('d/m/Y', strtotime($dado['data_despesa'])); ?></td>
                                    <?php while($dado2=mysqli_fetch_array($linhas2)){ ?>
                                      <td><?php echo $dado2['nome_empresa']; }?></td>
                                      <?php while($dado3=mysqli_fetch_array($linhas3)){ ?>
                                        <td><?php echo $dado3['nome_categoriaDespesa'];}?></td>
                                        <?php if($dado['valorDespesa']==0){ ?>
                                          <td><?php echo number_format($dado['valorDespesa'],2); ?></td>
                                        <?php } else { ?>
                                          <td><?php echo number_format($dado['valorDespesa'],2); ?></td>
                                        <?php } ?>
                                        <td><?php echo "Não tem vencimento";?></td>
                                        <td><?php echo $dado['situacao']; ?></td>
                                        <?php if($dado['porQuantidade']=="sim"){?>
                                          <td><?php echo $dado['porQuantidade']; ?></td>
                                        <?php }else { ?>
                                          <td> - </td>
                                        <?php          } ?>
                                        <?php if($dado['quantidade']==0){?>
                                          <td> - </td>
                                        <?php }else { ?>
                                          <td><?php echo $dado['quantidade']; ?></td>
                                        <?php }?>
                                        <?php
                                        if($dado['observacao']!=""){?>
                                          <td><?php echo $dado['observacao']; ?></td>
                                        <?php }else{ ?>
                                          <td> - </td>
                                        <?php } ?>
                                        <td>
                                          <a href="editarDespesa.php?alterar=<?php echo $dado['id_despesa']; ?>"> <button class="btn btn-outline-success">Editar</button></a>
                                          <a href="alteracaoDespesa.php?excluir=<?php echo $dado['id_despesa']; ?>" data-confirm='Tem certeza que deseja excluir?'><button class="btn btn-outline-danger">Excluir</button></a>

                                          <?php
                                          if($dado['situacao']=="nao"){
                                            ?>
                                            <a href="alteracaoDespesa.php?pago=<?php echo $dado['id_despesa']; ?>" ><button type="button" class="btn btn-outline-info">Pago</button></a>
                                            <?php
                                          }
                                          ?>
                                        </td>
                                      </tr>
                                    <?php }elseif($dado['vencimentoDespesa']=="1970-01-01" and $dado['quantidade']<=5){ ?>
                                      <tr class="table-active  table-sm">
                                        <td>Descrição</td>
                                        <td>Data do registro</td>
                                        <td>Fornecedor</td>
                                        <td>Categoria</td>
                                        <td>Valor</td>
                                        <td>Data de vencimento</td>
                                        <td>Pago</td>
                                        <td>Por qt?</td>
                                        <td>Quantidade</td>
                                        <td>Observação</td>
                                        <td>Ações</td>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <?php if($dado['descricao']!=""){?>
                                          <td><?php echo $dado['descricao']; ?></td>
                                        <?php }else{ ?>
                                          <td> - </td>
                                        <?php }?>
                                        <td><?php echo date('d/m/Y', strtotime($dado['data_despesa'])); ?></td>
                                        <?php while($dado2=mysqli_fetch_array($linhas2)){ ?>
                                          <td><?php echo $dado2['nome_empresa']; }?></td>
                                          <?php while($dado3=mysqli_fetch_array($linhas3)){ ?>
                                            <td><?php echo $dado3['nome_categoriaDespesa'];}?></td>
                                            <?php if($dado['valorDespesa']==0){ ?>
                                              <td><?php echo number_format($dado['valorDespesa'],2); ?></td>
                                            <?php } else { ?>
                                              <td><?php echo number_format($dado['valorDespesa'],2); ?></td>
                                            <?php } ?>
                                            <td><?php echo "Não tem vencimento";?></td>
                                            <td><?php echo $dado['situacao']; ?></td>
                                            <?php if($dado['porQuantidade']=="sim"){?>
                                              <td><?php echo $dado['porQuantidade']; ?></td>
                                            <?php }else { ?>
                                              <td> - </td>
                                            <?php          } ?>
                                            <?php if($dado['quantidade']==0){?>
                                              <td> - </td>
                                            <?php }else { ?>
                                              <td><?php echo $dado['quantidade']; ?></td>
                                            <?php }?>
                                            <?php
                                            if($dado['observacao']!=""){?>
                                              <td><?php echo $dado['observacao']; ?></td>
                                            <?php }else{ ?>
                                              <td> - </td>
                                            <?php } ?>
                                            <td>
                                              <a href="editarDespesa.php?alterar=<?php echo $dado['id_despesa']; ?>"> <button class="btn btn-outline-success">Editar</button></a>
                                              <a href="alteracaoDespesa.php?excluir=<?php echo $dado['id_despesa']; ?>" data-confirm='Tem certeza que deseja excluir?'><button class="btn btn-outline-danger">Excluir</button></a>

                                              <?php
                                              if($dado['situacao']=="nao"){
                                                ?>
                                                <a href="alteracaoDespesa.php?pago=<?php echo $dado['id_despesa']; ?>" ><button type="button" class="btn btn-outline-info">Pago</button></a>
                                                <?php
                                              }
                                              ?>
                                            </td>
                                          </tr>
                                        <?php }else{ ?>
                                          <tr class="table-success table-sm">
                                            <td>Descrição</td>
                                            <td>Data do registro</td>
                                            <td>Fornecedor</td>
                                            <td>Categoria</td>
                                            <td>Valor</td>
                                            <td>Data de vencimento</td>
                                            <td>Pago</td>
                                            <td>Por qt?</td>
                                            <td>Quantidade</td>
                                            <td>Observação</td>
                                            <td>Ações</td>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <?php if($dado['descricao']!=""){?>
                                              <td><?php echo $dado['descricao']; ?></td>
                                            <?php }else{ ?>
                                              <td> - </td>
                                            <?php }?>
                                            <td><?php echo date('d/m/Y', strtotime($dado['data_despesa'])); ?></td>
                                            <?php while($dado2=mysqli_fetch_array($linhas2)){ ?>
                                              <td><?php echo $dado2['nome_empresa']; }?></td>
                                              <?php while($dado3=mysqli_fetch_array($linhas3)){ ?>
                                                <td><?php echo $dado3['nome_categoriaDespesa'];}?></td>
                                                <?php if($dado['valorDespesa']==0){ ?>
                                                  <td><?php echo number_format($dado['valorDespesa'],2); ?></td>
                                                <?php } else { ?>
                                                  <td><?php echo number_format($dado['valorDespesa'],2); ?></td>
                                                <?php } ?>
                                                <td><?php echo date('d/m/Y', strtotime($dado['vencimentoDespesa'])); ?></td>
                                                <td><?php echo $dado['situacao']; ?></td>
                                                <?php if($dado['porQuantidade']=="sim"){?>
                                                  <td><?php echo $dado['porQuantidade']; ?></td>
                                                <?php }else { ?>
                                                  <td> - </td>
                                                <?php          } ?>
                                                <?php if($dado['quantidade']==0){?>
                                                  <td> - </td>
                                                <?php }else { ?>
                                                  <td><?php echo $dado['quantidade']; ?></td>
                                                <?php }?>
                                                <?php
                                                if($dado['observacao']!=""){?>
                                                  <td><?php echo $dado['observacao']; ?></td>
                                                <?php }else{ ?>
                                                  <td> - </td>
                                                <?php } ?>
                                                <td>
                                                  <a href="editarDespesa.php?alterar=<?php echo $dado['id_despesa']; ?>"> <button class="btn btn-outline-success">Editar</button></a>
                                                  <a href="alteracaoDespesa.php?excluir=<?php echo $dado['id_despesa']; ?>" data-confirm='Tem certeza que deseja excluir?'><button class="btn btn-outline-danger">Excluir</button></a>
                                                  <?php
                                                  if($dado['situacao']=="nao"){
                                                    ?>
                                                    <a href="alteracaoDespesa.php?pago=<?php echo $dado['id_despesa']; ?>" ><button type="button" class="btn btn-outline-info">Pago</button></a>
                                                    <?php
                                                  }
                                                  ?>
                                                </td>
                                              </tr>
                                            <?php } ?>
                                          </tbody>



                                        <?php } ?>
                                        <thead class="table">
                                          <?php
                                          $consulta10="Select * from tb_sangria order by data_sangria desc";
                                          $linhas10=mysqli_query($conexao,$consulta10);
                                          while($dado10=mysqli_fetch_array($linhas10)){
                                            $consulta11="Select * from tb_usuario where id_usuario=".$dado10['pessoaAdicionou'];
                                            $linhas11=mysqli_query($conexao,$consulta11);
                                            ?>

                                            <tr class="table-warning table-sm">
                                              <td>Tipo de despesa</td>
                                              <td></td>
                                              <td>Descrição</td>
                                              <td></td>
                                              <td>Usuário que registrou</td>
                                              <td></td>
                                              <td>Nº da nota</td>
                                              <td></td>
                                              <td>Data da sangria</td>
                                              <td></td>
                                              <td>Valor da sangria</td>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <tr>
                                              <td>Sangria</td>

                                              <td></td>
                                              <td><?php echo $dado10['descricao']; ?></td>
                                              <td></td>
                                              <?php if($dado10['pessoaAdicionou']!=0){
                                                while($dado11=mysqli_fetch_array($linhas11)){?>
                                                  <td><?php echo $dado11['nome_usuario']; } ?></td>
                                                <?php }else{ ?>
                                                  <td><?php echo "Sem registro"; ?></td>
                                                <?php } ?>

                                                <td></td>
                                                <td><?php echo $dado10['nota']; ?></td>
                                                <td></td>
                                                <td><?php echo date('d/m/Y', strtotime($dado10['data_sangria'])); ?></td>
                                                <td></td>
                                                <td><?php echo "R$ ".number_format($dado10['valorSangria'],2); ?></td>
                                              </tr>

                                            </tbody>


                                            <?php
                                          } ?>
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
                                                    <td>Não tem vencimento, mas a quantidade está abaixo de 6 ou não é por quantidade</td>
                                                  </tr>
                                                  <tr class="table-warning">
                                                    <td>Está vencendo, mas a quantidade está acima de 6 no estoque</td>
                                                  </tr>
                                                  <tr class="table-primary">
                                                    <td>Não tem vencimento e a quantidade no estoque está ok </td>
                                                  </tr>
                                                  <tr class="table-success">
                                                    <td>Não está perto do vencimento e a quantidade no estoque está ok</td>
                                                  </tr>
                                                  <tr class="table-info">
                                                    <td>Não está para vencer, porém está abaixo de 5 a quantidade no estoque </td>
                                                  </tr>
                                                  <tr class="table-light">
                                                    <td>Não está para vencer, porém a quantidade no estoque é igual a zero</td>
                                                  </tr>
                                                  <tr class="table-danger">
                                                    <td>Está vencido, mas a quantidade do estoque é maior que 5.</td>
                                                  </tr>
                                                  <tr class="table-warning">
                                                    <td>Sangria</td>
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
                                      $('#exampleModal').on('show.bs.modal', function (event) {
                                        var button = $(event.relatedTarget) // Botão que acionou o modal
                                        var recipient = button.data('whatever') // Extrai informação dos atributos data-*
                                        // Se necessário, você pode iniciar uma requisição AJAX aqui e, então, fazer a atualização em um callback.
                                        // Atualiza o conteúdo do modal. Nós vamos usar jQuery, aqui. No entanto, você poderia usar uma biblioteca de data binding ou outros métodos.
                                        var modal = $(this)
                                        modal.find('.modal-title').text('Nova mensagem para ' + recipient)
                                        modal.find('.modal-body input').val(recipient)
                                      })
                                      </script>
                                      <script>
                                      // function funcao1($valor)
                                      // {
                                      //   var r=confirm("Deseja realmente excluir?");
                                      //   if (r==true)
                                      //   {
                                      //     var link = document.getElementById("demo");
                                      //     link.setAttribute("href", "alteracaoDespesa.php?excluir="+$valor);
                                      //   }
                                      //   else
                                      //   {
                                      //     link.setAttribute("href", " ");
                                      //   }
                                      // }
                                      $("#menu-toggle").click(function(e) {
                                        e.preventDefault();
                                        $("#wrapper").toggleClass("toggled");
                                      });
                                      </script>

                                    </body>
                                    </html>
