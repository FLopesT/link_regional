<?php
    include_once "conexao.php";
?>

<!DOCTYPE html>
<html lang="pt=br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/personalizado.scss">
    <title>Link Regional</title>
</head>
<body>
  
  <!---->
    <!-- Inicio Menu -->

    <nav class="navbar navbar-expand-lg navbar-light bg-light p-2">

    <a class="navbar-brand" href="#">
  <img class="icone" src="./imagens/icon.png" alt="">
</a>
  
  <!--
  <a class="navbar-brand" href="#">Navbar</a>
-->
<button class="navbar-toggler" type="button" onclick="showNavBar()" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse d-flex justify-content-end" id="conteudoNavbarSuportado">
    <ul class="navbar-nav mr-2">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Contato</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="cadastra_cliente.php" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Área Admin
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="cadastra_cliente.php">Cadastra Novo Cliente</a>
          <a class="dropdown-item" href="listar.php">Lista de Clientes</a>
      <!--<a class="dropdown-item" href="listar.php">Listar Clientes</a> -->
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="pesquisar.php">Pesquisar</a>
      </li>
    </ul>
    <!--<form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar" aria-label="Pesquisar">
      <button name="SendPesqClient" type="submit" value="Pesquisar" class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
    </form>-->
  </div>
</nav>

    <!-- Fim Menu -->
    <h1>Pesquisa Cliente</h1>

    <div id="formulario">

    <form method="POST" action="">
        <label>Nome: </label>
        <input type="text" name="nome" placeholder="Digite o nome"><br /><br />
      
        <button name="SendPesqClient" type="submit" value="Pesquisar">Pesquisar</button>
      </form>
    </div>

    <div id="formulario">

    <?php
      $SendPesqClient = filter_input(INPUT_POST, 'SendPesqClient', FILTER_SANITIZE_STRING);
      if($SendPesqClient) {
        $nempresa = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
        $result_cliente = "SELECT * FROM cliente WHERE nempresa LIKE '%$nempresa%'";
        $resultado_cliente = mysqli_query($conn, $result_cliente);
        while ($row_cliente = mysqli_fetch_assoc($resultado_cliente)) {
            echo "<div id='cliente'><p> ID: " . $row_cliente['id'] . "</p>";
            echo "<p>Nome da Empresa: " . $row_cliente['nempresa'] . "</p>";
            echo "<p>Contato: " . $row_cliente['contato'] . "</p>";
            echo "<div id='button'></br>";
            echo "<a class='buttonStyle' href='edit_cliente.php?id=" . $row_cliente['id'] . "'>Editar</a><br/>";
            echo "<a class='buttonStyle' href='proc_apagar_cliente.php?id=" . $row_cliente['id'] . "'>Apagar</a><br/></div></div>";
          }
      }
    ?>
        
    </div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="js/header.js"></script>

</body>
</html>

