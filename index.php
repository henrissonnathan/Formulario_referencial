<?php
//abrir e utilizar uma sessao
session_start();
//incluir a conexao com banco de dados
require "configs/conexao.php";
require "configs/functions.php";
date_default_timezone_set('America/Sao_Paulo');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario
</title>
    <base href="<?= $base ?>formulario">

    <!----- arquivos css ---->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/datatables.min.css">
    <link rel="stylesheet" href="css/summernote-lite.min.css">
    <link rel="stylesheet" href="css/sweetalert2.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/style.css">
   
    <!----- arquivos javascript ---->
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/datatables.min.js"></script>
    <script src="js/parsley.min.js"></script>
    <script src="js/summernote-lite.min.js"></script>
    <script src="js/summernote-pt-BR.js"></script>
    <script src="js/sweetalert2.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/vanilla-masker.js"></script>
</head>

<body>
    
    <?php
    //definir uma variavel $pagina
  
    //incluir o header
   
    //verificar se a pessoa esta logada
    //se não estiver mostrar o formulário de login
    //if (!isset($_SESSION["usuarioAdm"]["id"])) {
    // require "paginas/login.php";
    // } else {
    //definir uma variavel $pageina
    $pagina = "formulario";
    //incluir o header
    require "header.php";

    //print_r($_GET["param"]);
    if (isset($_GET["param"])) {
        //recuperar o parametro
        // cadastros/categorias/1
        $param = explode("/", $_GET["param"]);
    }

    $pasta = $param[0] ?? NULL;
    $arquivo = $param[1] ?? NULL;
    $id = $param[2] ?? NULL;
   // echo $pasta;
    if (($pasta == "formulario") or ($pasta == "index.php")) {
        $pagina = "paginas/formulario.php";
    } else {
        $pagina = "{$pasta}/{$arquivo}.php";
    }

    //echo $pagina;
    if (file_exists($pagina)) {
        require $pagina;
    } else {
        require "paginas/erro.php";
    }

    //incluir o footer
    require "footer.php";
    //}
    ?>
</body>

</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>