<?php
    session_start();
    include_once("conexao.php");
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
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
    </form>-->
  </div>
</nav>

    <!-- Fim Menu -->
    <div id="conteudo"><h1>Lista de Clientes</h1>
    
    <div id="clientes">

    <?php
        if(isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        } 

        // Receber o número da página

        $pagina_atual = filter_input (INPUT_GET, 'pagina',
        FILTER_SANITIZE_NUMBER_INT);
        $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;

        // Setar a quantidade de itens por pagina

        $qnt_result_pg = 3;

        // Calcular o inicio visualização

        $inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;

        $result_clientes = "SELECT * FROM cliente LIMIT $inicio, $qnt_result_pg";
        $resultado_clientes = mysqli_query($conn, $result_clientes);
        while($row_clientes = mysqli_fetch_assoc($resultado_clientes)) {
            echo "<div id='cliente'> <p> ID: " . $row_clientes['id'] . "</p>";
            echo "<p> Nome: " . $row_clientes['nome'] . "</p>";
            echo "<p> Nome da Empresa: " . $row_clientes['nempresa'] . "</p>";
            echo "<p> Contato: " . $row_clientes['contato'] . "</p>";
            echo "<p> Categoria: " . $row_clientes['categoria'] . "</p>";
            echo "<p> Classificação: " . $row_clientes['classificacao'] . "</p>";
            echo "<div id='button'> <a class='buttonStyle' href='edit_cliente.php?id=" . $row_clientes['id'] . "'>Editar</a><br/>";
            echo "<a class='buttonStyle' href='proc_apagar_cliente.php?id=" . $row_clientes['id'] . "'>Apagar</a><br/></div></div>";
        }   
        
        echo "</div>";
    // Paginação - Somar a quantidade de Clientes

    $result_pg = "SELECT COUNT(id) AS num_result FROM cliente";
    $resultado_pg = mysqli_query($conn, $result_pg);
    $row_pg = mysqli_fetch_assoc($resultado_pg);
    //echo $row_pg['num_result'];

    // Quantidade de paginas

    $quantidade_pg = ceil($row_pg['num_result']  /  $qnt_result_pg);

    // Limitar os Links Antes e Depois
    $max_links = 2;
    echo "<div id='paginas'><div class='btnPagina'> <a href='listar.php?pagina=1'>Primeira</a> </div> ";

    for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant ++) {
        if($pag_ant >= 1) {
            echo "<a class='numPagina' href='listar.php?pagina=$pag_ant'>$pag_ant</a>";
        }
    }
    
    echo "<div class='numPagina'> <p> $pagina </p></div>";

    for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep ++) {
        if($pag_dep <= $quantidade_pg) {
            echo "<a class='numPagina' href='listar.php?pagina=$pag_dep'>$pag_dep</a>";
        }
    }
    
    echo "<div class='btnPagina'> <a href='listar.php?pagina=$quantidade_pg'>Ultima</a> </div></div>";    
    ?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="js/header.js"></script>

</body>
</html>

