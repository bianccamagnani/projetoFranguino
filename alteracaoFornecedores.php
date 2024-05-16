<!DOCTYPE HTML>
<html lang="pt-br">

<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <?php
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
  if(isset($_GET['excluir'])){
    $conexao=mysqli_connect("localhost","root","","franguino");
    $qt = mysqli_query($conexao,"DELETE FROM `tb_fornecedores` WHERE id_fornecedores=".$_GET['excluir']);
    HEADER("Location:alteracaoFornecedores.php");
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
  .morecontent span {
    display: none;
}
.morelink {
    display: block;
}
  </style>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Alteração fornecedores</title>
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
        </nav>

        <div class="container-fluid">
          <br>
          <div class="form-group input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
            <input name="consulta" id="txt_consulta" placeholder="Consultar" type="text" class="form-control">
          </div>
          <table id="tabela" class="table table-hover">
            <thead class="table table-sm">
            <tr class="table-success">
              <td>Nome da empresa</td>
              <td>CNPJ</td>
              <td>Endereço da empresa</td>
              <td style="width:150px">Telefone</td>
              <td>Outro contato</td>
              <td>Observação</td>
            </tr>
          </thead>
            <?php
            $conexao=mysqli_connect("localhost","root","","franguino");
            if(!$conexao){
              die(mysqli_error());
            }
            $consulta="Select * from tb_fornecedores";
            $linhas=mysqli_query($conexao,$consulta);
            $quebra = chr(13).chr(10);
            while($dado=mysqli_fetch_array($linhas)){ ?>
              <tbody>
              <tr>
                <td><?php echo $dado['nome_empresa']; ?></td>
                <td><?php echo $dado['cnpj_empresa']; ?></td>
                <td><span class="more"><?php echo $dado['endereco_empresa']; ?></span></td>
                <td><?php echo $dado['telefone_empresa']; ?></td>
                <?php if($dado['contato_empresa']==""){?>
                  <td> - </td>
                <?php }else{ ?>
                <td><?php echo $dado['contato_empresa']; ?></td>
              <?php }
              if($dado['observacao_empresa']==""){ ?>
              <td> - </td>
            <?php } else {?>
              <td><?php echo $dado['observacao_empresa']; ?></td>
            <?php } ?>
                <td>
                  <p><a href="editarFornecedor.php?alterar=<?php echo $dado['id_fornecedores']; ?>"><button class="btn btn-outline-success">Editar</button></a>
                  </p><p><a href="alteracaoFornecedores.php?excluir=<?php echo $dado['id_fornecedores']; ?> " data-confirm='Tem certeza que deseja excluir?'><button class="btn btn-outline-danger">Excluir</button></a>
                  </p>
                </td>
              </tr>
            <?php } ?>
          </tbody>
          </table>
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
        </script>
        <script>
        function funcao1($valor)
        {
          var r=confirm("Deseja realmente excluir?");
          if (r==true)
          {
            var link = document.getElementById("demo");
            link.setAttribute("href", "alteracaoFornecedores.php?excluir="+$valor);
          }
          else
          {
            link.setAttribute("href", " ");
          }
        }
        $(document).ready(function() {
        var showChar = 12;
        var ellipsestext = "...";
        var moretext = "Exibir endereço completo";
        var lesstext = "Ocultar";
        $('.more').each(function() {
          var content = $(this).html();
          if(content.length > showChar) {
              var c = content.substr(0, showChar);
              var h = content.substr(showChar, content.length - showChar);
              var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
          $(this).html(html);
          }
        });


        $(".morelink").click(function(){
            if($(this).hasClass("less")) {
                $(this).removeClass("less");
                $(this).html(moretext);
            } else {
                $(this).addClass("less");
                $(this).html(lesstext);
            }
            $(this).parent().prev().toggle();
            $(this).prev().toggle();
            return false;
        });
    });
        </script>
      </body>
      </html>
