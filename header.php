
<?php
if (!isset($pagina)) {
  header("Location: index.php");
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-primary rounded-bottom">
    <div class="container-fluid px-4">
      

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon "></span>
      </button>
      <div class="collapse navbar-collapse navbar-nav colorase" id="navbarSupportedContent">
        <ul class="navbar-nav ">
          <li class="nav-item  ms-auto">
            <a class="nav-link  " href="paginas/formulario">formulario</a>
          </li>
          <?php if(!isset($_SESSION["usuario"])): ?>
            </ul>
            <li class="nav-item  ms-auto">
              
          <!--  <a class="nav-link " href="paginas/login">Logar</a>-->
          </li>
            <?php else: ?>
            <li class="nav-item me-auto">
            <a class="nav-link  " href="paginas/cadastro_revista">Cadastro de revistas</a>
          </li>
        </ul>
        <li class="nav-item dropdown ms-auto ">
            <a class="nav-link dropdown-toggle  " id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw "></i> Olá <?= $_SESSION["usuario"]["nome"]; ?></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                </li>
                <li><a class="dropdown-item" href="sair.php">Sair</a></li>
            </ul>
        </li>
    <?php endif; ?>
    

    </div>
    
  </nav>
  <main class="container" >