<?php
if($_COOKIE['id_usuario']==''){
  HEADER("Location:login.php");
}
$conexao=mysqli_connect("localhost","root","","franguino");
if(!$conexao){
  die("Erro".mysqli_error());
}
$id_estoque=$_GET['alterar'];
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
  <meta charset="UTF-8">
    <title>Edição de Estoque</title>
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
<form action="functionEstoque.php" method="post">
  <?php
  $result_cliente = "select * FROM `tb_estoque` where id_estoque=".$id_estoque;
  $resultado_cliente = mysqli_query($conexao, $result_cliente);
  $lista = mysqli_fetch_array($resultado_cliente);
  $dataCadastro=$lista['data_cadastroEstoque'];
  $validade=$lista['data_validadeProduto'];
  $id_categoria=$lista['categoriaEstoque'];
  $descricao=$lista['descricaoProduto'];
  $quantidade=$lista['quantidadeEstoque'];
  $id_usuario=$lista['id_usuario'];
  $custo=$lista['custoProduto'];
  $valor=$lista['valorVenda'];

  $consulta="Select nomeCategoriaEstoque from categoriaestoque where id_CategoriaEstoque=".$id_categoria;
  $linhas=mysqli_query($conexao,$consulta);
  $dado=mysqli_fetch_array($linhas);
  $dados=$dado['nomeCategoriaEstoque'];
  ?>
  <br><br>
  <div class="form-group">
  <input type="hidden" id="usuario" name="usuario" value="1">
  <input type="hidden" id="id_estoque" name="id_estoque" value="<?php echo $id_estoque;?>">
  <div class="form-row">
    <div class="form-group col-md-4">
  <label for="dataCadastro">Data cadastro</label>
  <input class="form-control" type="date" id="dateEstoqueCadastro" value="<?php $dateCadastro = str_replace("/", "-", $dataCadastro); echo $dateCadastro;?>" name="dateEstoqueCadastro">
</div>
<div class="form-group col-md-4">
  <label for="dataValidade">Data validade</label>
  <input class="form-control" type="date" id="dateEstoqueValidade" value="<?php echo $validade;?>" name="dateEstoqueValidade">
</div>
<div class="form-group col-md-4">
  <label for="categoriaEstoque">Categoria estoque</label>
  <select class="form-control" name="categoriaEstoque" id="categoriaEstoque">
    <option value="<?PHP echo $id_categoria; ?>">
      <?php echo $dados; ?>
    </option>
    <?php
      $consulta="Select * from categoriaestoque";
      $linhas=mysqli_query($conexao,$consulta);
      while($dados=mysqli_fetch_array($linhas)){
        if($id_categoria!=$dados['id_CategoriaEstoque']){
          ?>
      <option value="<?PHP echo $dados['id_CategoriaEstoque'];?>">
        <?php echo $dados['nomeCategoriaEstoque']; ?>
      </option>
    <?php }
  }?>
  </select></p>
</div>
</div>
<div class="form-row">
  <div class="form-group col-md-4">
  <label for="custo">Custo unitário:</label>
  <input class="form-control" type="number" id="custo" step="0.01" min="0"  value="<?php echo $custo;?>" name="custo">
</div>
<div class="form-group col-md-4">
  <label for="custo">Quantidade:</label>
  <input class="form-control" type="number" value="<?php echo $quantidade;?>" id="quantidade" name="quantidade">
</div>
<div class="form-group col-md-4">
  <label for="valorVenda">Valor de venda:</label>
  <input class="form-control" type="number" step="0.01" min="0"  id="valorVenda" value="<?php echo $valor;?>" name="valorVenda">
</div>
</div>
  <label for="descricao">Descrição:</label>
  <textarea class="form-control" type="text" id="descricao" name="descricao"><?php echo $descricao;?></textarea>

</div>
  <input class="btn btn-outline-success" type="submit" value="Atualizar estoque" name="enviar">
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
