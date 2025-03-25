<?php
if (!isset($pagina)) {
    exit;
}

require "configs/functions.php";

$id = trim($_POST["id"] ?? NULL);
$nome = trim($_POST["nome"] ?? NULL);
$login = trim($_POST["login"] ?? NULL);
$senha = trim($_POST["senha"] ?? NULL);
$senha2 = trim($_POST["senhaC"] ?? NULL);


//verificar se os campos estão em branco
if (empty($nome)) {
    mensagem("Erro", "Preencha o nome");
} else if ((empty($senha))) {
    mensagem("Erro", "Preencha a senha");
} else if ($senha != $senha2) {
    mensagem("Erro", "As senhas devem ser iguais");
}else if(empty($login ) ){
    mensagem("Erro","digite o email");
}else if(!filter_var($login ,FILTER_VALIDATE_EMAIL)){
    mensagem("Erro","preencha um email valido");
}

//verificar se já existe o login no banco
$sqladministradores = "select id from usuarios where e_mail = :login AND id <> :id limit 1";
$consultaadministradores = $pdo->prepare($sqladministradores);
$consultaadministradores->bindParam(":login", $login);
$consultaadministradores->bindParam(":id", $id);
$consultaadministradores->execute();

//recuperar os dados
$dadosadministradores = $consultaadministradores->fetch(PDO::FETCH_OBJ);
if (!empty($dadosadministradores->id)) {
    mensagem("Erro", "Já existe alguém com este Login no sistema");
}



//salvar o cliente
if (empty($id)) {
    $senha = password_hash($senha, PASSWORD_DEFAULT);
    //inserir
    $sql = "INSERT into usuarios   (usuario,e_mail, senha) values ( :nome, :login, :senha)";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":nome", $nome);
    $consulta->bindParam(":login", $login);
    $consulta->bindParam(":senha", $senha);
    
} else {
    $senha = password_hash($senha, PASSWORD_DEFAULT);
    //mudar todos os campos, inclusive a foto
    $sql = "update usuarios set usuario = :nome, e_mail =:login,
        ativo = :ativo, senha = :senha where id = :id LIMIT 1";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":nome", $nome);
    $consulta->bindParam(":login", $login);
    
    $consulta->bindParam(":senha", $senha);
    $consulta->bindParam(":id", $id);
}

//executar
if ($consulta->execute()) {
    mensagem("Sucesso!", "Registro Salvo/Atualizado com sucesso!");
    echo "<script>
       setTimeout(() => {
         window.location.href = 'paginas/login';
       }, 1000);    
     </script>";
} else {
    mensagem("Erro", "Erro ao tentar Salvar/Atualizar registro!");
}
