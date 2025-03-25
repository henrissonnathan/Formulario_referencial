<?php
if (!isset($pagina))
    exit;
    




$ano= trim($_POST["ano"] ?? NULL);
$estrato= trim($_POST["estrato"] ?? NULL);
$area= trim($_POST["area"] ?? NULL);



$statu = trim($_POST["Status"]  ?? NULL);
$direita = trim($_POST["direita"]  ?? NULL);
$esquerdo = trim($_POST["esquerda"]  ?? NULL);
$topo = trim($_POST["topo"]  ?? NULL);
$inferior = trim($_POST["inferior"]  ?? NULL);
$paginas_min = trim($_POST["pagina_min"]  ?? NULL);
$pagina_max = trim($_POST["pagina_max"]  ?? NULL);
$data_abertura = trim($_POST["abertura"] ?? NULL);
$data_fechamento = trim($_POST["fechamento"]  ?? NULL);
$citacoes_curta = trim($_POST["cita_curta"]  ?? NULL);
$citacoes_longa = trim($_POST["cita_longa"]  ?? NULL);
$formatacao = trim($_POST["formatacao"]  ?? NULL);
$espassamento_linha = trim($_POST["espassamento_linha"]  ?? NULL);
$texto_tamanho = trim($_POST["texto_tamanho"]  ?? NULL);
$titulo_tamanho = trim($_POST["titulo_tamanho"]  ?? NULL);
$tipo = trim($_POST["tipo"]  ?? NULL);
$preso_valor = trim($_POST["preso_valor"]  ?? NULL);



$idiomas  = $_POST["idiomas"] ?? [];
$arquivos= $_POST["arquivos"] ?? [];
$fontes = $_POST["fontes"] ?? [];


if (!$_POST)
    mensagem("Erro", "Requisiçã inválida");



$ISSN = trim($_POST["ISSN"] ?? NULL);
$titulo = trim($_POST["titulo"] ?? NULL);
$linkdireto = trim($_POST["linkdireto"] ?? NULL);
$id_paises = trim($_POST["paispublicacao"] ?? NULL);
$aceita = 1;
$mudansa = 0;


$sqlNome = "select id from revista where ISSN= :ISSN 
        AND id <> :id limit 1";
$consultaNome = $pdo->prepare($sqlNome);
$consultaNome->bindParam(":id", $id);
$consultaNome->bindParam(":ISSN", $ISSN);
$consultaNome->execute();

$dados = $consultaNome->fetch(PDO::FETCH_OBJ);

if (!empty($dados->id))
$aceita = 0;
$mudansa = 1;


//verificar se vamos dar um insert ou um update
try {
    $pdo->beginTransaction();
    //insert
    $sql = "INSERT into revista(ISSN,titulo,linkdireto,id_paises,aceita,mudansa) values (:ISSN,:titulo,:linkdireto,:id_paises,:aceita,:mudansa) limit 1";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":ISSN", $ISSN);
    $consulta->bindParam(":titulo", $titulo);
    $consulta->bindParam(":linkdireto", $linkdireto);
    $consulta->bindParam(":id_paises", $id_paises);
    $consulta->bindParam(":aceita", $aceita);
    $consulta->bindParam(":mudansa", $mudansa);
    $consulta->execute();

    $id_revista = $pdo->lastInsertId();
    foreach ($fontes as $id_fonte) {
        $sql = "INSERT INTO fontes_revista (id_revista, id_fonte) VALUES (:id_revista, :id_fonte)";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(':id_revista', $id_revista);
        $consulta->bindParam(':id_fonte', $id_fonte);
        $consulta->execute();
    }
     $sqlIdiomas = "INSERT INTO idiomas_revista (id_revista, id_idioma) VALUES (:id_revista, :id_idioma)";
     $consultaIdiomas = $pdo->prepare($sqlIdiomas);
     foreach ($idiomas as $id_idioma) {
         $consultaIdiomas->bindParam(':id_revista', $id_revista);
         $consultaIdiomas->bindParam(':id_idioma', $id_idioma);
         $consultaIdiomas->execute();
     }
 
     // Insere os arquivos associados à revista
     $sqlArquivos = "INSERT INTO arquivos_revista (id_revista, id_arquivo) VALUES (:id_revista, :id_arquivo)";
     $consultaArquivos = $pdo->prepare($sqlArquivos);
     foreach ($arquivos as $id_arquivo) {
         $consultaArquivos->bindParam(':id_revista', $id_revista);
         $consultaArquivos->bindParam(':id_arquivo', $id_arquivo);
         $consultaArquivos->execute();
     }
    
     $sql = "insert into margem values (NULL,:direita,:inferior,:esquerdo,:topo)";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":direita", $direita);
    $consulta->bindParam(":inferior", $inferior);
    $consulta->bindParam(":esquerdo", $esquerdo);
    $consulta->bindParam(":topo", $topo);
    //insert
    $consulta->execute();
    $id_margem = $pdo->lastInsertId();

    $sql = "insert into requisitos values (NULL, :id_revista,:statu,:paginas_min,:paginas_max,:data_abertura,:data_fechamento,:citacoes_curta,:citacoes_longa,:id_margem,:formatacao,:espasamento_linhas,:texto_tamanho,:titulo_tamanho,:preso_valor,:tipo)";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":id_revista", $id_revista);
    $consulta->bindParam(":statu", $statu);
    $consulta->bindParam(":paginas_min", $paginas_min);
    $consulta->bindParam(":paginas_max", $pagina_max);
    $consulta->bindParam(":data_abertura", $data_abertura);
    $consulta->bindParam(":data_fechamento", $data_fechamento);
    $consulta->bindParam(":citacoes_curta", $citacoes_curta);
    $consulta->bindParam(":citacoes_longa", $citacoes_longa);
    $consulta->bindParam(":id_margem", $id_margem);
    $consulta->bindParam(":formatacao", $formatacao);
    $consulta->bindParam(":espasamento_linhas", $espasamento_linhas);
    $consulta->bindParam(":texto_tamanho", $texto_tamanho);
    $consulta->bindParam(":titulo_tamanho", $titulo_tamanho);
    $consulta->bindParam(":preso_valor", $preso_valor);
    $consulta->bindParam(":tipo", $tipo);
    $consulta->execute();


    $sql = "insert into estrato values (NULL, :id_revista,:id_area,:ano,:estrato,1)";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":id_revista",$id_revista);
    $consulta->bindParam(":id_area", $area);
    $consulta->bindParam(":ano", $ano);
    $consulta->bindParam(":estrato", $estrato);

     $pdo->commit();


} catch (PDOException $e) {
    // Em caso de erro, desfaz a transação (rollback)
    $pdo->rollBack();

    mensagem("Erro", "Não foi possível salvar o registro. Erro: " . $e->getMessage());
}
    mensagem("sucesso", " revista cadastrada" );







