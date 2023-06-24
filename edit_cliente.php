<?php
    session_start();
    include_once("conexao.php");
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $result_cliente = "SELECT * FROM cliente WHERE id = '$id'";
    $resultado_cliente = mysqli_query($conn, $result_cliente);
    $row_cliente = mysqli_fetch_assoc($resultado_cliente);
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
        <a class="nav-link active" href="#">Pesquisar</a>
      </li>
    </ul>
    <!--<form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar" aria-label="Pesquisar">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
    </form>-->
  </div>
</nav>

    <!-- Fim Menu -->
    <h1>Editar Cliente</h1>

    <?php
        if(isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }    
    ?>

    <div id="formulario">
    <form method="POST" action="proc_edit_cliente.php">
        <label>Nome: </label>
        <input type="hidden" name="id" 
            value="<?php echo $row_cliente['id']; ?>">

        <input type="text" name="nome" placeholder="Digite o nome completo" 
            value="<?php echo $row_cliente['nome']; ?>"><br /><br />

        <label>Nome da Empresa: </label>
        <input type="text" name="nempresa" placeholder="Digite o nome da Empresa"
            value="<?php echo $row_cliente['nempresa']; ?>"><br /><br />

        <label>CPF: </label>
        <input type="text" name="cpf" placeholder="Digite o CPF"
            value="<?php echo $row_cliente['cpf']; ?>"><br /><br />
        
        <label>E-mail: </label>
        <input type="text" name="email" placeholder="Digite o seu melhor E-mail"
            value="<?php echo $row_cliente['email']; ?>"><br /><br />

        <label>Site: </label>
        <input type="text" name="site" placeholder="Tem Site? Coloca o endereço"
            value="<?php echo $row_cliente['site']; ?>"><br /><br />

        <label>Contato: </label>
        <input type="text" name="contato" placeholder="Digite o seu contato"
            value="<?php echo $row_cliente['contato']; ?>"><br /><br />

        <label>Endereço: </label>
        <input type="text" name="endereco" placeholder="Digite seu endereço"
            value="<?php echo $row_cliente['endereco']; ?>"><br /><br />

        <label>Cidade: </label>
        <input type="text" name="cidade" placeholder="Informe a sua Cidade"
            value="<?php echo $row_cliente['cidade']; ?>"><br /><br />

        <label>Estado: </label>
        <input type="text" name="estado" placeholder="Informe o seu Estado"
            value="<?php echo $row_cliente['estado']; ?>"><br /><br />

        <label>Categoria: </label>
        <input type="text" name="categoria" placeholder="Digite a categoria do Serviço ex: Serviço"
            value="<?php echo $row_cliente['categoria']; ?>"><br /><br />
        
        <label>Classificação: </label>
        <input type="text" name="classificacao" placeholder="Digite uma pontuação ex:0.0 até 10.0"
            value="<?php echo $row_cliente['classificacao']; ?>"><br /><br />

        <label>Nome da imagem do Cartão: </label>
        <input type="text" name="imagem_cartao" placeholder="Nome do arquivo da imagem Formato jpg"
            value="<?php echo $row_cliente['imagem_cartao']; ?>"><br /><br />

            <button type="submit"> Editar </button>
    </form>
      </div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script src="js/header.js"></script>

</body>
</html>

