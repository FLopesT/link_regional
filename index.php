<?php
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
        <a class="nav-link dropdown-toggle "  href="cadastra_cliente.php" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
    <!-- Inicio Carrossel -->
    <main>
    <div id="carouselExampleRide" class="carousel slide" data-bs-ride="true">

    <div id="carouselExampleIndicators" class="carousel slide">
          
            <div class="carousel-indicators">
                <?php 
                    $contole_ativo = 2;
                    $controle_num_slide = 1;
                    $result_carousel = "SELECT * FROM cliente ORDER BY id ASC";
                    $resultado_carousel = mysqli_query($conn, $result_carousel);
                    while($row_carousel = mysqli_fetch_assoc($resultado_carousel)){ 
                      if($contole_ativo == 2){ ?>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button><?php
                    $contole_ativo = 1;
                      }else { ?>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $controle_num_slide; ?>" aria-label="Slide 2"></button><?php
                    $controle_num_slide++;
                      }
                        
                    }
                  ?>
            
          </div>
  
    <?php 
      $controle_ativo = 2;
      $result_carousel = "SELECT * FROM cliente ORDER BY id   ASC";
      $resultado_carousel = mysqli_query($conn, $result_carousel);
      while($row_carousel = mysqli_fetch_assoc($resultado_carousel)){ 
        if($controle_ativo == 2){ ?>
      <div class="carousel-inner">
      <div class="carousel-item active">
      <img src="imagens/carousel/<?php echo $row_carousel['imagem_cartao']; ?>" class="d-block w-100" alt="<?php echo $row_carousel['nempresa']; ?>">
      </div><?php
      $controle_ativo = 1;
        }else { ?>
      <div class="carousel-item">
      <img src="imagens/carousel/<?php echo $row_carousel['imagem_cartao']; ?>" class="d-block w-100" alt="<?php echo $row_carousel['nempresa']; ?>">
      </div><?php
        }
          
      }
    ?> 
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
</main>

    <!-- Fim Carrossel -->

    <h1>Pesquisa Cliente</h1>
    <div id="formulario">
    <form method="POST" action="">
        <label>Nome: </label>
        <input type="text" name="nome" placeholder="Digite o nome"><br /><br />
      
        <input name="SendPesqClient" type="submit">
    </form><br /><br /></div>

    <?php
      $SendPesqClient = filter_input(INPUT_POST, 'SendPesqClient', FILTER_SANITIZE_STRING);
      if($SendPesqClient) {
        $nempresa = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
        $result_cliente = "SELECT * FROM cliente WHERE nempresa LIKE '%$nempresa%'";
        $resultado_cliente = mysqli_query($conn, $result_cliente);
        while ($row_cliente = mysqli_fetch_assoc($resultado_cliente)) {
          echo "########->ID: " . $row_cliente['id'] . "<br>";
          echo "########->Nome da Empresa: " . $row_cliente['nempresa'] . "<br>";
          echo "########->Contato: " . $row_cliente['contato'] . "<br>";
          
          echo "########-><a href='edit_cliente.php?id=" . $row_cliente['id'] . "'>Editar</a><br/>";
          echo "########-><a href='proc_apagar_cliente.php?id=" . $row_cliente['id'] . "'>Apagar</a><br/><hr>";
        }
      }
    ?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script src="js/header.js"></script>
</body>
</html>