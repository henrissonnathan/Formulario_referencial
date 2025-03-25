<style>
  .font-size-20 {
    font-size: 20px;
    color: #8B0000;
  }

  div span {
    display: inline-block;
    border: 1px solid #D4BE00;
    padding: 10px;
    margin: 10px;
    margin-right: 15px;
    border-radius: 15px;
    padding: 5px;
    margin-bottom: 2px;
  }

  text {
    color: #006400;
  }
</style>
<?php
function capitalizeFirstLetter($str) {
  return ucwords(mb_strtolower($str));
}
if (!isset($pagina)) {
  exit;
}
$sqlidioma = "SELECT
r.id,
COALESCE(i.idioma, 'Não cadastrado') AS idioma
FROM  revista AS r
LEFT JOIN idiomas_revista AS ir ON ir.id_revista = r.id
LEFT JOIN idiomas i ON i.id = ir.id_idioma
WHERE r.id = :id
";

$consulidioma = $pdo->prepare($sqlidioma);
$consulidioma->bindParam(':id', $id, PDO::PARAM_INT);
$consulidioma->execute();

$sqlFontes = "SELECT
r.id,
COALESCE(f.fonte, 'Não cadastrado') AS fonte
FROM revista AS r
LEFT JOIN fontes_revista AS fr ON fr.id_revista = r.id
left join fontes f on f.id = fr.id_fonte
WHERE r.id = :id
";
$consultaFontes = $pdo->prepare($sqlFontes);
$consultaFontes->bindParam(':id', $id, PDO::PARAM_INT);
$consultaFontes->execute();

$sqlEstrato = "SELECT
r.id,
COALESCE(are.area, 'Não cadastrado') AS area,
COALESCE(o.nome, 'Não cadastrado') AS organizacao,
COALESCE(e.ano, 'Não cadastrado') AS ano,
COALESCE(e.estrato, 'Não cadastrado') AS estrato
FROM revista AS r
LEFT JOIN estrato AS e ON e.id_revista = r.id 
LEFT JOIN organizacoes o ON o.id = e.id_organizacao
LEFT JOIN areas are ON are.id = e.id_areas
WHERE r.id = :id
";
$consultaEstrato = $pdo->prepare($sqlEstrato);
$consultaEstrato->bindParam(':id', $id, PDO::PARAM_INT);
$consultaEstrato->execute();
$sqlEstra = "SELECT
r.id,
COALESCE(are.area, 'Não cadastrado') AS area,
COALESCE(o.nome, 'Não cadastrado') AS organizacao,
COALESCE(e.ano, 'Não cadastrado') AS ano,
COALESCE(e.estrato, 'Não cadastrado') AS estrato
FROM revista AS r
LEFT JOIN estrato AS e ON e.id_revista = r.id 
LEFT JOIN organizacoes o ON o.id = e.id_organizacao
LEFT JOIN areas are ON are.id = e.id_areas
WHERE r.id = :id
";
$consultaEstra = $pdo->prepare($sqlEstra);
$consultaEstra->bindParam(':id', $id, PDO::PARAM_INT);
$consultaEstra->execute();

$sqlArquivos = "SELECT
r.id,
COALESCE(a.arquivo,'Não cadastrado') As arquivo
FROM revista AS r
LEFT JOIN arquivos_revista AS ar ON ar.id_revista = r.id
LEFT JOIN arquivos AS a ON a.id = ar.id_arquivo
WHERE r.id = :id
";
$consultaArquivos = $pdo->prepare($sqlArquivos);
$consultaArquivos->bindParam(':id', $id, PDO::PARAM_INT);
$consultaArquivos->execute();
$sqlorganizacoes = "SELECT
r.id,
    COALESCE(r.ISSN, 'Não cadastrado') AS ISSN,
    COALESCE(r.titulo, 'Não cadastrado') AS titulo,
    COALESCE(p.pais, 'Não cadastrado') AS pais,

    COALESCE(s.statu,'Não cadastrado') As statu,

    COALESCE(m.direita,'Não cadastrado') As direita,
    COALESCE(m.esquerdo,'Não cadastrado') As esquerda, 
    COALESCE(m.topo,'Não cadastrado') As topo,
    COALESCE(m.inferior,'Não cadastrado') As inferior,

    COALESCE(t.nome,'Não cadastrado') As tipos,
    COALESCE(re.paginas_min,'Não cadastrado') As pagina_min,
    COALESCE(re.paginas_max,'Não cadastrado') As pagina_max,
    re.data_abertura As abertura,
    re.data_fechamento As fechamento,
    COALESCE(re.citacoes_curta,'Não cadastrado') As cita_curta,
    COALESCE(re.citacoes_longa,'Não cadastrado') As cita_longa,
    COALESCE(re.formatacao,'Não cadastrado') As formatacao,
    COALESCE(re.espasamento_linhas,'Não cadastrado') As espassamento_linha,
    COALESCE(re.texto_tamanho,'Não cadastrado') As texto_tamanho,
    COALESCE(re.titulo_tamanho,'Não cadastrado') As titulo_tamanho,
    COALESCE(re.preso_valor,NULL) As preso_valor

FROM revista AS r
    LEFT JOIN paises AS p ON r.id_paises = p.id 
    LEFT JOIN requisitos AS re ON re.id_revista = r.id 
    LEFT JOIN status AS s ON s.id = re.id_status
    LEFT JOIN margem AS m ON m.id = re.id_margem
    LEFT JOIN tipos AS t ON t.id = re.id_tipo
    WHERE
    r.id = :id

    
";

$consultorganizacoes = $pdo->prepare($sqlorganizacoes);
$consultorganizacoes->bindParam(':id', $id, PDO::PARAM_INT);
$consultorganizacoes->execute();

// Imprimir cabeçalho
echo "<h2 class=' list-unstyled' style='color: #800080'>Título: ";
if ($row = $consultorganizacoes->fetch(PDO::FETCH_ASSOC)) {
  echo " <text>{$row['titulo']}</text>";


  $idiomas = "";
  $fontes = "";
  $arquivo = "";
  $areas = "";
  while ($dad = $consultaEstra->fetch(PDO::FETCH_OBJ)) {
    $areas .= capitalizeFirstLetter($dad->area . ", ");
  }
  $areas = trim($areas, ", ");

  while ($dado = $consulidioma->fetch(PDO::FETCH_OBJ)) {
    $idiomas .= capitalizeFirstLetter($dado->idioma . ", ");
  }
  $idiomas = trim($idiomas, ", ");

  while ($dados = $consultaFontes->fetch(PDO::FETCH_OBJ)) {
    $fontes .= capitalizeFirstLetter($dados->fonte . ", ");
  }
  $fontes = trim($fontes, ", ");

  while ($dadoso = $consultaArquivos->fetch(PDO::FETCH_OBJ)) {
    $arquivo .= capitalizeFirstLetter($dadoso->arquivo . ", ");
  }
  $arquivo  = trim($arquivo, ", ");
}
//formtatsão de datas abertura e fechamento respectivamente
$aberturaNUM = preg_replace('/[^0-9]/', '', $row['abertura']);
$fechamentoNUM = preg_replace('/[^0-9]/', '', $row['fechamento']);
if (is_numeric($aberturaNUM)) {
  list($anoa, $mesa, $diaa) = explode("-", $row['abertura']);
  $abertura = $diaa . "/" . $mesa . "/" . $anoa;
} else {
  $abertura = 'Não cadastrado';
}
if (is_numeric($fechamentoNUM)) {
  list($anob, $mesb, $diab) = explode("-", $row['fechamento']);
  $fechamento = $diab . "/" . $mesb . "/" . $anob;
} else {
  $fechamento = 'Não cadastrado';
}
echo "</h2>";

// Imprimir dados
$consultorganizacoes->execute();  // Executar novamente para obter os dados

$row = $consultorganizacoes->fetch(PDO::FETCH_ASSOC);

$preso_valor = $row['preso_valor'];
if($row['statu'] == 'Grátis' or $preso_valor == NULL ){
$preso_valor =' 0.00';
};



?>
<div class="font-size-20 " style="color: #800080">

  <span>ISSN:<text> <?= capitalizeFirstLetter($row['ISSN']) ?> </text> </span>
  <span>Pais publicação:<text> <?= capitalizeFirstLetter($row['pais']) ?> </text> </span>
  <span>Idioma aceitos:<text> <?= capitalizeFirstLetter($idiomas) ?> </text> </span>
  <span>Fontes aceitos:<text> <?= capitalizeFirstLetter($fontes) ?> </text> </span>
  <span>Datas
    <span>Abertura de publicação:<text> <?= capitalizeFirstLetter($abertura) ?> </text> </span>
    <span>Fechamento de publicação:<text> <?= capitalizeFirstLetter($fechamento) ?> </text> </span></span>
    <span>Áreas da revista:<text><?= capitalizeFirstLetter($areas) ?></text></span>
  <span>Status da revista:<text> <?= capitalizeFirstLetter($row['statu']) ?> </text> </span>
  <span>Inscrição de revista:<text> <?= capitalizeFirstLetter($row['tipos']) ?> </text> </span>
  <span>Caso pago o valor: R$<text> <?=capitalizeFirstLetter($preso_valor)?> </text> </span>
  <span>Organização da avaliação: <text>Capes</text>
    <?php
    while ($dados = $consultaEstrato->fetch(PDO::FETCH_OBJ)) {
    ?>
    <br>
      <span>Área avaliada:<text> <?= capitalizeFirstLetter($dados->area) ?> </text> </span> <span> Nota avaliada da revista:<text> <?= capitalizeFirstLetter($dados->estrato) ?> </text></span> <span> Ano<text>:<?= capitalizeFirstLetter($dados->ano) ?> </text> </span>
    <?php
    }
    ?>
  </span>

  </br>
  </br>
  <span>Margens:
    <span>Direita:<text> <?= capitalizeFirstLetter($row['direita']) ?> </text> </span>
    <span>Esquerda:<text> <?= capitalizeFirstLetter($row['esquerda']) ?> </text> </span>
    <span> Topo:<text> <?= capitalizeFirstLetter($row['topo']) ?> </text> </span>
    <span> Inferior:<text> <?= capitalizeFirstLetter($row['inferior']) ?> </text> </span></span>
  <span>Páginas mínima da publicação:<text> <?= capitalizeFirstLetter($row['pagina_min']) ?> </text> </span>
  <span>Páginas máximas da publicação:<text> <?= capitalizeFirstLetter($row['pagina_max']) ?> </text> </span>
  <span>Estilo citações curta:<text> <?= capitalizeFirstLetter($row['cita_curta']) ?> </text> </span>
  <span>Estilo citações longa :<text> <?= capitalizeFirstLetter($row['cita_longa']) ?> </text> </span>
  <span>Formatação de texto:<text> <?= capitalizeFirstLetter($row['formatacao']) ?> </text> </span>
  <span>Espaçamento de linha da publicação:<text> <?= capitalizeFirstLetter($row['espassamento_linha']) ?> </text> </span>
  <span>Tamanho de texto da publicação:<text> <?= capitalizeFirstLetter($row['texto_tamanho']) ?> </text> </span>
  <span>Tamanho de título da publicação:<text> <?= capitalizeFirstLetter($row['titulo_tamanho']) ?> </text> </span>

</div>