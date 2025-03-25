<?php
    //iniciar sessao
    session_start();
    //destruir aquela sessao
    unset($_SESSION["usuario"]);
    //redirecionar
    header("Location: paginas/pesquisa");