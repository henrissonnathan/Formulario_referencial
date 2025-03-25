<style>
    button[name="pesquisar"] {
        border: 3px solid #8B0000;
        background-color: white;
        border-radius: 15px;
        padding: 10px 20px;
        color: #8B0000;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s;
    }

    form {
        text-align: center;
        /* Centraliza o conteúdo do formulário */
    }

    form select {
        border: 2px solid #8B0000;
        background-color: white;
        border-radius: 15px;
        padding: 10px 20px;
        color: #8B0000;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        background-image: none;
    }

    form select:hover {
        border-color: #0056b3;
        color: #0056b3;
        text-decoration: none;

    }

    form label {
        display: block;
        /* Cada label em uma nova linha */
        margin: 10px 0;
        /* Espaçamento entre as labels */
        color: #8B0000;
    }

    form input {
        border: 2px solid #8B0000;
        background-color: white;
        border-radius: 15px;
        padding: 10px 20px;
        color: #8B0000;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s;
    }

    form input:hover {
        border-color: #0056b3;
        color: #0056b3;
        text-decoration: none;

    }

    form input::placeholder {
        color: #8B0000;
    }

    form input:hover::placeholder {
        color: #0056b3;
        /* Cor verde quando o mouse passa por cima */
    }

    .cardas {
        border: 3px solid #8B0000;
        background-color: white;
        border-radius: 15px;
        padding: 10px 20px;

        color: #8B0000;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s;
        text-decoration: none;

    }

    .cardas:hover {
        border-color: #0056b3;
        color: #0056b3;
        text-decoration: none;
    }

    .custom-border-info {
        border-color: #FFD700 !important;
    }

    button[name="pesquisar"]:hover {
        border-color: #0056b3;
        color: #0056b3;
    }

    button[name="ver_mais"] {
        border: 3px solid #8B0000;
        background-color: white;
        border-radius: 20px;
        padding: 10px 20px;

        color: #8B0000;
        cursor: pointer;
        transition: background-color 0.5s, color 0.5s;
    }

    button[name="ver_mais"]:hover {

        border-color: #0056b3;
        color: #0056b3;
    }

    .pagination-container {
        text-align: center;
        margin-top: 20px;
        /* Adapte conforme necessário */
    }

    .pagination {
        display: inline-block;
    }

    .pagination a {
        padding: 5px 10px;
        margin: 0 5px;
        text-decoration: none;
        border: 1px solid #ccc;
        background-color: #f2f2f2;
        color: #333;
        border-radius: 4px;
    }

    .pagination a:hover {
        background-color: #ddd;
    }

    .pagination a.active {
        background-color: #4CAF50;
        color: white;
    }

    .left {
        float: left;
    }

    /* Alinha à direita */
    .right {
        float: right;
    }

    /* Limpa a flutuação (clear float) */
    .clearfix::after {
        content: "";
        clear: both;
        display: table;
    }
</style>
<?php
if (!isset($pagina)) {
    exit;
}

$sqlorganizacoes = "SELECT r.id, r.ISSN, r.titulo as titulo, r.linkdireto, p.pais,r.aceita,
COALESCE(are.area, 'Não cadastrado') AS area,
COALESCE(o.nome, 'Não cadastrado') AS organizacao,
COALESCE(e.ano, 'Não cadastrado') AS ano,
COALESCE(e.estrato, 'Não cadastrado') AS estrato,
COALESCE(re.data_abertura, 'Não cadastrado') AS fim,
COALESCE(re.data_fechamento, 'Não cadastrado') AS comeso
FROM revista as  r 
left JOIN paises as  p ON r.id_paises = p.id  
left join requisitos as re on re.id_revista = r.id 
left join estrato as e on e.id_revista = r.id 
left join areas are on are.id = e.id_areas
left join organizacoes o on o.id = e.id_organizacao
left join status as s on s.id = re.id_status
left join margem as m on m.id = re.id_margem
left join tipos as  t on t.id = re.id_tipo
WHERE
   r.aceita = 0 and r.mudansa = 0 
  
ORDER BY r.titulo";

$consultorganizacoes = $pdo->prepare($sqlorganizacoes);
$consultorganizacoes->execute();



$dataAtual = new DateTime();
$ano = $dataAtual->format('y'); // Obtém os últimos dois dígitos do ano
$mes = $dataAtual->format('m'); // Obtém o mês
$dia = $dataAtual->format('d');

// Formata a data como string no formato desejado (DD/MM/AA)
$dataFormatada = "$ano/$mes/$dia";
$ISSN = trim($_POST["ISSN"] ?? NULL);

$resultadosPorPagina = 50;
$totalResultados = $consultorganizacoes->rowCount();
$totalPaginas = ceil($totalResultados / $resultadosPorPagina);


$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$indiceInicio = ($paginaAtual - 1) * $resultadosPorPagina;

$sqlorganizacoes .= " LIMIT {$indiceInicio}, {$resultadosPorPagina}";

?>

<form method="post" action="paginas/pesquisa" class="clearfix">
    <div class="left">
        <label for="ISSN"> <input type="text" name="ISSN" id="ISSN" maxlength="9" oninput="formatISSN(this)" placeholder="Digite o ISSN para pesquisar uma revista específica" value="<?= $ISSN ?>">
            :Digite o ISSN para achar a revista
        </label>
    </div>
    <div class="right">
        <?php
        $sqlPaises = "SELECT id, idioma FROM idiomas order by idioma";
        $stmtPaises = $pdo->query($sqlPaises);
        $optionsIdiomas = "";
        while ($rowPais = $stmtPaises->fetch(PDO::FETCH_OBJ)) {
            //$selected = ($pais == $rowPais->id) ? 'selected' : ''; $selected
            $optionsIdiomas .= "<option value='{$rowPais->id}' >{$rowPais->idioma}  </option>";
        } ?>
        <label for="idioma ">Idiomas aceito na revista:
            <select name="idioma" id="idioma">
                <option value="">Selecione o idioma </option>
                <?= $optionsIdiomas ?>
            </select></label>
    </div>
    <div class="left">
        <?php
        $sqlPaise = "SELECT id, nome FROM tipos order by nome";
        $stmtPaise = $pdo->query($sqlPaise);
        $optionsTipo = "";
        while ($rowPai = $stmtPaise->fetch(PDO::FETCH_OBJ)) {
            //para edisa
            //$selected = ($pai == $rowPai->id) ? 'selected' : ''; no caos colocar $selected npo de baixo
            $optionsTipo .= "<option value='{$rowPai->id}' >{$rowPai->nome}  </option>";
        } ?>

        <label for="tipo">
            <select name="tipo" id="tipo">
                <option value="">Selecione se há custo para a incrisão </option>
                <?= $optionsTipo ?>
            </select> :Modalidade de Inscrição </label>


            
    </div>
    <div class="right">
        <label for="inscricao_aberta">Inscrição Aberta:
            <select name="inscricao_aberta" id="inscricao_aberta">
                <option value="">Selecione a opisão desejada</option>
                <option value="nao">Não</option>
                <option value="sim">Sim</option>
            </select></label>
    </div>
        
    <div class="left">
        <label for="estrato"  style="margin-right: 170px;">
            <select name="estrato" id="estrato">
                <option value="">Selecione a nota da revista</option>
                <option value="A1">A1</option>
                <option value="A2">A2</option>
                <option value="A3">A3</option>
                <option value="B1">B1</option>
                <option value="B2">B2</option>
                <option value="B3">B3</option>
                <option value="C">C</option>
            </select> :Nota da revista(estrato)</label>
    </div>
    <div class="right">
        <?php
        $sqlArea = "SELECT id, area FROM areas order by area";
        $stmtArea = $pdo->query($sqlArea);
        $optionsArea = "";
        while ($rowArea = $stmtArea->fetch(PDO::FETCH_OBJ)) {
            //para edisa
            //$selected = ($pai == $rowPai->id) ? 'selected' : ''; no caos colocar $selected npo de baixo
            $optionsArea .= "<option value='{$rowArea->id}' >{$rowArea->area}  </option>";
        } ?>
        <label for="area">Area que a revista é avaliada:
            <select name="area" id="area">
                <option value="">Selecione se há area avaliada</option>
                <?= $optionsArea ?>
            </select></label>
    </div>

    <br>
    <!-- Botão de Pesquisa -->
    <button type="submit" name="pesquisar"  style="margin-right: 150px;margin-top: 50px;">Pesquisar</button>

</form>
<?php
$consultorganizacoes = $pdo->prepare($sqlorganizacoes);
$consultorganizacoes->execute();


// Filtros fornecidos pelo usuário


while ($dados = $consultorganizacoes->fetch(PDO::FETCH_OBJ)) {
    //print_r($_POST); 
    $idioma = trim($_POST["idioma"] ?? NULL);
    $tipo = trim($_POST["tipo"] ?? NULL);
    $inscricaoAberta = trim($_POST["inscricao_aberta"] ?? NULL);
    $estrato = trim($_POST["estrato"] ?? NULL);
    $area = trim($_POST["area"] ?? NULL);
    $ISSN = trim($_POST["ISSN"] ?? NULL);



    $abertura = DateTime::createFromFormat('Y/m/d', $dados->comeso);
    $fechamento = DateTime::createFromFormat('Y/m/d', $dados->fim);


    if ($dataFormatada >= $abertura && $dataFormatada <= $fechamento) {
        $inscricaoAberta = true;
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
    $consulidioma->bindParam(':id', $dados->id, PDO::PARAM_INT);
    $consulidioma->execute();
    $idiomas = "";
    $certo = false;
    while ($dado = $consulidioma->fetch(PDO::FETCH_OBJ)) {
        $idiomas .= $dado->idioma . ", ";
        if ($dado->idioma = $idioma) {
            $certo = true;
        }
    }
    $idiomas = trim($idiomas, ", ");

    $sqltipo = "SELECT
    r.id,
    COALESCE(i.nome, 'Não cadastrado') AS tipo
    FROM  revista AS r
    LEFT JOIN requisitos AS ir ON ir.id_revista = r.id
    LEFT JOIN tipos i ON i.id = ir.id_tipo
    WHERE r.id = :id
    ";
    $consultipo = $pdo->prepare($sqltipo);
    $consultipo->bindParam(':id', $dados->id, PDO::PARAM_INT);
    $consultipo->execute();
    $dado = $consultipo->fetch(PDO::FETCH_OBJ);

    if ($idioma == NULL or $certo == true) {
        if ($tipo == NULL or $tipo == $dado->tipo) {
            if ($inscricaoAberta == NULL or $inscricaoAberta == true) {
                if ($estrato == NULL or $estrato == $dados->estrato) {
                    if ($area == NULL or $area == $dados->area) {
                        if ($ISSN == NULL or $ISSN == $dados->ISSN) {
?>
                            <br>
                            <a class="card rounded-4 p-3 cardas" href="paginas/revista/<?= $dados->id ?>">

                                <p class="titulo "><strong>Titulo da revista: <?= $dados->titulo ?></strong></p>
                                <div class="row">
                                    <div class="col-12  mb-3">
                                        <div>

                                            <lu class=" list-unstyled d-flex">
                                                <li class="me-4">ISSN: <?= $dados->ISSN ?></li>
                                                <li class="me-4">País de publicação: <?= $dados->pais ?></li>
                                                <li>idiomas aceitos: <?= $idiomas ?> </li>

                                            </lu>
                                            <lu class=" list-unstyled d-flex">
                                                <li>area de avaliada: <?= $dados->area ?> nota avaliada da revista: <?= $dados->estrato ?> organização: <?= $dados->organizacao ?> ano: <?= $dados->ano ?></li>
                                            </lu>
                                            <li class=" list-unstyled d-flex"> Modalidade de Inscrição: <?= $dado->tipo ?></li>
                                        </div>


                                    </div>

                                </div>
                            </a>

<?php
                        }
                    }
                }
            }
        }
    }
}
echo "<div class='pagination-container'>";
echo "<div class='pagination'>";
for ($pagina = 1; $pagina <= $totalPaginas; $pagina++) {
    echo "<a href='paginas/pesquisa?pagina={$pagina}'>{$pagina}</a> ";
}
echo "</div>";
echo "</div>";
?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var inputISSN = document.getElementById("ISSN"); // Obtém o elemento de entrada ISSN

        function formatISSN(input) {
            var sanitized = input.value.replace(/[^0-9]/g, ''); // Remove caracteres não numéricos
            if (sanitized.length > 4) {
                sanitized = sanitized.substr(0, 4) + '-' + sanitized.substr(4, 4); // Adiciona hífen após os quatro primeiros dígitos
            }
            input.value = sanitized; // Atualiza o valor do campo ISSN na interface do usuário
        }

        // Associa a função formatISSN ao evento de entrada (por exemplo, a mudança no valor do campo)
        inputISSN.addEventListener("input", function() {
            formatISSN(inputISSN);
        });
    }); //retira o idioma artigo fontes da revista e colocar separadamente
</script>