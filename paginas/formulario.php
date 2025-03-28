<?php
if (!isset($pagina)) {
    exit;
}
?>
<?php
// Inclui o arquivo de configuração
$selectOptions = require __DIR__ . '/../configs/select-options.php';
?>

<div class="card">
    <div class="card-header">
        <strong>Termos de Referencia simplificado</strong>
        <div class="float-end">
        </div>
    </div>
    <div class="card-body">
        <form name="formCadastro" method="post" action="salvar/formartar" id="formTermos" data-parsley-validate="">
        <div class="steps-container">
            

            <div class="step active" data-step="1">
            <!-- pca -->
             <div class="pergunta" data-toggle-target="#resposta-pca-container" data-toggle-values='["Sim"]'>
            <label for="pca">TEM PREVISÃO NO PCA?</label>
            <div class="opcoes-grid">
                <?php foreach ($selectOptions['pca'] as $value => $label): ?>
                    <div class="opcao_box"
                    data-resposta="<?= $value ?>"
                    data-toggle-target="#resposta-pca-container">
                    <?= $label ?>
                </div>
                <?php endforeach; ?>
                <input type="hidden" name="pca" required >
            </div>
                    <div class="erro-validacao">Por favor, selecione um oprção</div>
        </div>
            

            <div id="resposta-pca-container" class="pergunta-condicional" style="display: none;">
                <label for="resposta-pca">Justifique:</label>
                <input type="text" name="resposta-pca" id="resposta-pca" class="form-control" >
            </div>
            <div class="botoes-navegacao mt-4">
                <button type="button" class="btn btn-primary proximo">Próximo</button>
            </div>
            </div>
             
        </div>
            <!-- orçamento(valor) 
            <label for="orcamento">INFORME A DOTAÇÃO ORÇAMENTÁRIA</label>
            <input type="text" name="orcamento" id="orcamento" class="form-control borda money-mask" value="0,00" placeholder="Coloque um valor" required data-parsley-required-message="Por favor, preencha a Dotação orçamentária">


            <!--segunda

            <!-- Natureza da contratação
            <label for="contrato">NATUREZA DA CONTRATAÇÃO</label>
            <select name="contrato" id="contrato" class="form-control borda toggle-trigger" required data-toggle-target="#resposta-contrato" data-toggle-values='["Outros"]'>data-parsley-required-message="Por favor, selecione uma opisão">
                <option value="">Selecione uma opção</option>
                <?php foreach ($selectOptions['contrato'] as $value => $label): ?>
                    <option value="<?= $value ?>"><?= $label ?></option>
                <?php endforeach; ?>
            </select>
            <div id="resposta-contrato" class="toggleable-field" style="display: none;">
                <label for="resposta-contrato">Informe:</label>
                <input type="text" name="resposta-contrato" id="resposta-contrato" class="form-control borda" placeholder="INFORME:">
            </div>

                    <!--etapa 3
            <div class="mb-4">
                <div class="file-upload-container border p-3 rounded bg-light">
                    <label class="form-label">Importar Tabela:</label>
                    <div class="drag-drop-area border rounded p-4 text-center mb-3">
                        Arraste o arquivo aqui ou
                        <input type="file" id="file-input" accept=".csv, .xlsx, .xls" class="form-control mt-2">
                    </div>
                    <small class="text-muted">Formatos suportados: CSV, XLSX (Excel), XLS (Excel antigo)</small>
                </div>
            </div>
            <br>
            <h5 class="mt-4">Itens</h5>

            <!-- tabela
            <table id="tabela-itens" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Item</th>
                        <th>Unid.</th>
                        <th>Qtd.</th>
                        <th>Valor Unit</th>
                        <th>Descrição</th>
                        <th>Obs.</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

            <div class="d-flex gap-2 mt-3">
                <button type="button" id="adicionar-linha" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Adicionar Linha
                </button>
                <button type="button" id="remover-linha" class="btn btn-danger btn-sm">
                    <i class="fas fa-minus"></i> Remover Última Linha
                </button>
            </div>

            <div class="mt-4 p-3 bg-light rounded">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h5>Total Geral: <span id="total-geral">0,00</span></h5>
                    </div>

                </div>
            </div>
                    <!--etapa 4
            <!-- Modalidade
            <label for="modalidade">MODALIDADE</label>
            <select name="modalidade" id="modalidade" class="form-control borda  toggle-trigger" required data-parsley-required-message="Por favor, selecione uma opisão" data-toggle-target="#modal" data-toggle-values='["Licitação","Inexigibilidade e licitação","Chamamento público",""]'>
                <option value="">Selecione uma opção</option>
                <?php foreach ($selectOptions['modalidade'] as $value => $label): ?>
                    <option value="<?= $value ?>"><?= $label ?></option>
                <?php endforeach; ?>
            </select>



                    <!--etapa 5
            <!--Critério
            <div id="modal" class="toggleable-field" style="display: none;">
                <label for="criterio">CRITÉRIO DE ADJUDICAÇÃO DO OBJETO</label>
                <select name="criterio" id="criterio" class="form-control borda" required data-parsley-required-message="Por favor, selecione uma opisão">
                    <option value="">Selecione uma opção</option>
                    <?php foreach ($selectOptions['criterio'] as $value => $label): ?>
                        <option value="<?= $value ?>"><?= $label ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

                            <!--etapa 6
            <!--trata de licitações,etc.
            <label for="trata">TRATA-SE DE LICITAÇÕES DECORRENTE DE CONVÊNIO/CONTRATO DE REPASSE/OUTROS COM GOVERNO ESTADUAL/FEDERAL?</label>
            <select name="trata" id="trata" class="form-control borda" required data-parsley-required-message="Por favor, selecione uma opisão">
                <option value="">Selecione uma opção</option>
                <?php foreach ($selectOptions['trata'] as $value => $label): ?>
                    <option value="<?= $value ?>"><?= $label ?></option>
                <?php endforeach; ?>
            </select>

                    <!--etapa 7  
            <!--definisão de quantidade
            <label for="levantamento">COMO FORAM DEFINIDAS AS QUANTIDADES</label>
            <select name="levantamento" id="levantamento" class="form-control borda toggle-trigger" required data-parsley-required-message="Por favor, selecione uma opisão" data-toggle-target="#leve" data-toggle-values='["Outros"]'>
                <option value="">Selecione uma opção</option>
                <?php foreach ($selectOptions['levantamento'] as $value => $label): ?>
                    <option value="<?= $value ?>"><?= $label ?></option>
                <?php endforeach; ?>
            </select>

            <div id="leve" class="toggleable-field" style="display: none;">
                <label for="leve-outro">Informe como foram definidas as quantidades</label>
                <input type="text" name="leve-outro" id="leve-outro" class="form-control borda" placeholder="Informe como foram definidas as quantidades">
            </div>



                    <!--etapa 8
            <!--definisão de quantidade
            <label for="parametro">PARÂMETRO UTILIZADO PARA OBTENÇÃO DO VALOR DE REFERÊNCIA:</label>
            <select name="parametro" id="parametro" class="form-control borda" required data-parsley-required-message="Por favor, selecione uma opisão">
                <option value="">Selecione uma opção</option>
                <?php foreach ($selectOptions['parametro'] as $value => $label): ?>
                    <option value="<?= $value ?>"><?= $label ?></option>
                <?php endforeach; ?>
            </select>
                        <!--etapa 9
            <!--PARÂMETRO UTILIZADO PARA OBTENÇÃO DO VALOR DE REFERÊNCIA
            <label>FONTES DE PESQUISA </label>
            <!-- Container dos parâmetros 
            <div id="fontes-container">
                <!-- Linha 1 
                <div class="input-group mb-2 fonte-item">
                    <select name="fonte[]" class="form-control borda toggle-trigger" required
                        data-parsley-required-message="Por favor, selecione uma opção">
                        <option value="">Selecione uma opção</option>
                        <?php foreach ($selectOptions['fonte'] as $value => $label): ?>
                            <option value="<?= $value ?>"><?= $label ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="button" class="btn btn-danger remover-fonte" disabled>
                        <i class="fas fa-minus"></i>
                    </button>
                </div>

                <!-- Linha 2 (mínimo obrigatório) 
                <div class="input-group mb-2 fonte-item">
                    <select name="fonte[]" class="form-control borda" required
                        data-parsley-required-message="Por favor, selecione uma opção">
                        <option value="">Selecione uma opção</option>
                        <?php foreach ($selectOptions['fonte'] as $value => $label): ?>
                            <option value="<?= $value ?>"><?= $label ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="button" class="btn btn-danger remover-fonte">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <!-- Botão para adicionar mais linhas 
            <button type="button" id="adicionar-fonte" class="btn btn-primary btn-sm mt-2">
                <i class="fas fa-plus"></i> Adicionar Parâmetro
            </button>

                            <!--etapa 10
            <!--Orçamento fas fa-ca
            <label for="orcamento">FOI OBTIDO ORÇAMENTO COM, NO MÍNIMO, 03 FORNECEDORES ENQUADRADOS COMO MPE LOCAL OU REGIONAL OU, DE OUTRA FORMA, HÁ COMPROVAÇÃO DE QUE HÁ 03 FORNECEDORES MPE LOCAL OU REGIONAL?</label>
            <select name="orcamento" id="orcamento" class="form-control borda" required data-parsley-required-message="Por favor, selecione uma opisão">
                <option value="">Selecione uma opção</option>
                <?php foreach ($selectOptions['orcamento'] as $value => $label): ?>
                    <option value="<?= $value ?>"><?= $label ?></option>
                <?php endforeach; ?>
            </select>
                   <!--etapa11
            <!--retrisão territorial 
            <label for="retricao">VAI SER APLICADA RESTRIÇÃO TERRITORIAL?</label>
            <select name="retricao" id="retricao" class="form-control borda toggle-trigger" required data-parsley-required-message="Por favor, selecione uma opisão" data-toggle-target="#terri" data-toggle-values='["sim. Restrição regional","sim. Restrição local","Outros"]'>
                <option value="">Selecione uma opção</option>
                <?php foreach ($selectOptions['retricao'] as $value => $label): ?>
                    <option value="<?= $value ?>"><?= $label ?></option>
                <?php endforeach; ?>
            </select>
            <div id="terri" class="toggleable-field" style="display: none;">
                <label for="restri-expli">Justifique</label>
                <input type="text" name="restri-expli" id="restri-expli" class="form-control borda" placeholder="justifique">
            </div>



                <!--etapa 12

            <!--CARACTERÍSTICA DO CERTAME
            <label for="certame">CARACTERÍSTICA DO CERTAME:</label>
            <select name="certame" id="certame" class="form-control borda" required data-parsley-required-message="Por favor, selecione uma opisão">
                <option value="">Selecione uma opção</option>
                <?php foreach ($selectOptions['certame'] as $value => $label): ?>
                    <option value="<?= $value ?>"><?= $label ?></option>
                <?php endforeach; ?>
            </select>

                        <!--etapa 13
            <!--FORMA DE SELEÇÃO*
            <label for="selecao">FORMA DE SELEÇÃO:</label>
            <select name="selecao" id="selecao" class="form-control borda toggle-trigger" required data-parsley-required-message="Por favor, selecione uma opisão" data-toggle-target="#selecasta" data-toggle-values='["Presencial","Sem disputas"]'>
                <option value="">Selecione uma opção</option>
                <?php foreach ($selectOptions['selecao'] as $value => $label): ?>
                    <option value="<?= $value ?>"><?= $label ?></option>
                <?php endforeach; ?>
            </select>
            <div id="selecasta" class="toggleable-field" style="display:none;">
                <label for="seleca-esxpli">justifique</label>
                <input type="text" name="seleca-expli" id="seleca-expli" class="form-control borda" placeholder="justifique">
            </div>



                        <!--etapa 14
            <!--ANALISE DE CONFORMIDADE DA PROPOSTA*
            <label for="proposta">ANALISE DE CONFORMIDADE DA PROPOSTA:</label>
            <select name="proposta" id="proposta" class="form-control borda toggle-trigger" required data-parsley-required-message="Por favor, selecione uma opisão" data-toggle-target="#propostaas" data-toggle-values='["Amostra","Exame de conformidade","Prova de conceito"]'>
                <option value="">Selecione uma opção</option>
                <?php foreach ($selectOptions['proposta'] as $value => $label): ?>
                    <option value="<?= $value ?>"><?= $label ?></option>
                <?php endforeach; ?>
            </select>
            <div id="propostaas" class="toggleable-field" style="display: nene;">
                <label for="propos-expli">Defina os quesitos</label>
                <input type="text" name="propos-expli" id="propos-expli" class="form-control borda" placeholder="justifique">
            </div>

                    <!--etapa 15
            <!--justificativa
            <label for="justificativa">JUSTIFICATIVA DA CONTRATAÇÃO:</label>
            <input type="text" name="justificativa" id="justificativa" class="form-control borda" placeholder="Digite a justificativa" required data-parsley-required-message="Por favor, preencha o justificativa">
            
                    <!--etapa 16
            <!--condiçoes específicas do objeto
            <label for="condicoes">CONDIÇÕES ESPECÍFICAS DO OBJETO (detalhamento completo do objeto)</label>
            <input type="text" name="condicoes" id="condicoes" class="form-control borda" placeholder="Digite a condicoes" required data-parsley-required-message="Por favor, preencha o condicoes">
            
                    <!--etapa 17
            <!--prazo de vigência do(a) sistema registro de preços
            <label for="prazo">PRAZO DE VIGÊNCIA DO(A) SISTEMA REGISTRO DE PREÇOS (ATA REGISTRO DE PREÇOS)</label>
            <input type="text" name="prazo" id="prazo" class="form-control borda" placeholder="Digite a prazo" required data-parsley-required-message="Por favor, preencha o prazo">
            <!-- etapa 18
            <!--PRAZO DE EXECUÇÃO
            <label for="execucao">DETALHE COMO DEVE SER O PRAZO DE EXECUÇÃO - PRAZO MÁXIMO PARA INICIAR E PRAZO PARA CONCLUSÃO</label>
            <input type="text" name="execucao" id="execucao" class="form-control borda" placeholder="Digite a execucao" required data-parsley-required-message="Por favor, preencha o execucao">
            <!-- etapa 19
            <!--LOCAL DE EXECUÇÃO
            <label for="local">LOCAL DE EXECUÇÃO</label>
            <input type="text" name="local" id="local" class="form-control borda" placeholder="Digite a local" required data-parsley-required-message="Por favor, preencha o local">


                        <!--etapa 20
            <!-- UNIDADE REQUISITANTE 
            <div class="mb-3">
                <label for="proposta" class="form-label">UNIDADE REQUISITANTE</label>
                <select name="proposta" id="proposta" class="form-control borda" required data-parsley-required-message="Por favor, selecione uma opção">
                    <option value="">Selecione uma opção</option>
                    <?php foreach ($selectOptions['requisitante'] as $value => $label): ?>
                        <option value="<?= $value ?>"><?= $label ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- RESPONSÁVEL PELO ETP 
            <div class="mb-3">
                <label class="form-label">RESPONSÁVEL PELO ETP</label>
                <div class="row">
                    <div class="col-md-6">
                        <label for="matricula_etp" class="form-label">Matrícula</label>
                        <input type="text" class="form-control" name="matricula_etp" id="matricula_etp">
                    </div>
                    <div class="col-md-6">
                        <label for="nome_etp" class="form-label">Nome</label>
                        <input type="text" class="form-control" name="nome_etp" id="nome_etp">
                    </div>
                </div>
            </div>

            <!-- RESPONSÁVEL PELO DFD 
            <div class="mb-3">
                <label class="form-label">RESPONSÁVEL PELO DFD</label>
                <div class="row">
                    <div class="col-md-6">
                        <label for="matricula_dfd" class="form-label">Matrícula</label>
                        <input type="text" class="form-control" name="matricula_dfd" id="matricula_dfd">
                    </div>
                    <div class="col-md-6">
                        <label for="nome_dfd" class="form-label">Nome</label>
                        <input type="text" class="form-control" name="nome_dfd" id="nome_dfd">
                    </div>
                </div>
            </div>

            <!-- RESPONSÁVEL PELO LEVANTAMENTO DE PREÇO 
            <div class="mb-3">
                <label class="form-label">RESPONSÁVEL PELO LEVANTAMENTO DE PREÇO</label>
                <div class="row">
                    <div class="col-md-6">
                        <label for="matricula_preco" class="form-label">Matrícula</label>
                        <input type="text" class="form-control" name="matricula_preco" id="matricula_preco">
                    </div>
                    <div class="col-md-6">
                        <label for="nome_preco" class="form-label">Nome</label>
                        <input type="text" class="form-control" name="nome_preco" id="nome_preco">
                    </div>
                </div>
            </div>



            <br>
                    
                    <!--  etapa 21
            <!--PRAZO DE EXECUÇÃO
            
            <label for="data">DATA E ASSINATURA</label>
            <input type="text" name="data" id="data" class="form-control borda" placeholder="Digite a datae e assinatura" required data-parsley-required-message="Por favor, preencha o compo">

                    -->
            <button type="submit" class="btn btn-success">
                <i class="fas fa-check"></i> Salvar Dados
            </button>
        
        
        </div>
        </form>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>

<script>
$(document).ready(function() {
    // Inicializar DataTables com paginação
    const tabelaItens = $('#tabela-itens').DataTable({
        paging: true,
        pageLength: 10, // 10 itens por página
        lengthMenu: [[5, 10, 20, 50, -1], [5, 10, 20, 50, "Todos"]],
        searching: false,
        ordering: true,
        responsive: true,
        dom: 'Blfrtip',
        buttons: [
            {
                extend: 'csv',
                text: 'Exportar CSV',
                className: 'btn btn-primary btn-sm',
                exportOptions: {
                    columns: ':visible'
                }
            }
        ],
        language: {
            url: "//cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json",
            emptyTable: "Nenhum item cadastrado - adicione linhas ou importe dados",
            info: "Mostrando _START_ a _END_ de _TOTAL_ itens",
            infoEmpty: "Mostrando 0 itens",
            infoFiltered: "(filtrado de _MAX_ itens no total)",
            lengthMenu: "Mostrar _MENU_ itens por página",
            loadingRecords: "Carregando...",
            processing: "Processando...",
            search: "Pesquisar:",
            zeroRecords: "Nenhum item encontrado",
            paginate: {
                first: "Primeira",
                last: "Última",
                next: "Próxima",
                previous: "Anterior"
            }
        },
        columnDefs: [
            
            {targets: '_all', // Aplica a todas as colunas
                searchable: false // Desativa a pesquisa
                }
            
        ]
    });

    // Adicionar nova linha
    $('#adicionar-linha').click(function() {
        const novaLinha = [
            tabelaIten.rows().count() + 1,
            `<input type="text" name="item[]" class="form-control" required>`,
            `<input type="text" name="unid[]" class="form-control unidade" value="UN" required>`,
            `<input type="number" name="qtd[]" class="form-control qtd-inteiro" min="1" value="1" required>`,
            `<input type="text" name="valor_unitario[]" class="form-control money-mask" required>`,
            `<input type="text" name="descricao[]" class="form-control">`,
            `<input type="text" name="obs[]" class="form-control">`,
            `<button type="button" class="btn btn-danger btn-sm remover-linha"><i class="fas fa-trash"></i></button>`
        ];
        
        tabelaItens.row.add(novaLinha).draw();
        
        // Aplica máscaras aos novos campos
        $('.money-mask').mask('#.##0,00', {reverse: true});
    });

    // Remover última linha
    $('#remover-linha').click(function() {
        if (tabelaItens.rows().count() > 0) {
            tabelaItens.row(':last').remove().draw();
        } else {
            alert('Não há linhas para remover!');
        }
    });

    // Remover linha específica
    $('#tabela-itens tbody').on('click', '.remover-linha', function() {
        tabelaItens.row($(this).parents('tr')).remove().draw();
    });

    // Configuração do drag and drop
    const dropArea = document.querySelector('.drag-drop-area');
    const fileInput = document.getElementById('file-input');

    // Função para processar arquivo
    function handleFile(file) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            const data = e.target.result;
            
            if (file.name.endsWith('.csv')) {
                processCSV(data);
            } else {
                processExcel(data);
            }
        };
        
        reader.onerror = function() {
            alert('Erro ao ler o arquivo. Por favor, tente novamente.');
        };
        
        if (file.name.endsWith('.csv')) {
            reader.readAsText(file);
        } else {
            reader.readAsArrayBuffer(file);
        }
    }

    // Processar CSV
    function processCSV(data) {
        try {
            const rows = data.split('\n').filter(row => row.trim() !== '');
            if (rows.length <= 1) {
                alert('O arquivo CSV está vazio ou não possui dados válidos.');
                return;
            }
            
            // Obter cabeçalhos (se houver)
            const headers = rows[0].split(',').map(h => h.trim());
            
            // Processar linhas de dados
            for (let i = 1; i < rows.length; i++) {
                const rowData = rows[i].split(',');
                
                // Verificar se a linha tem dados suficientes
                if (rowData.length >= 4) {
                    const item = {
                        nome: rowData[0]?.trim() || '',
                        unidade: rowData[1]?.trim() || 'UN',
                        quantidade: parseInt(rowData[2]?.trim()) || 1,
                        valor: parseFloat(rowData[3]?.trim().replace('.', '').replace(',', '.')) || 0,
                        descricao: rowData[4]?.trim() || '',
                        obs: rowData[5]?.trim() || ''
                    };
                    
                    // Adicionar à tabela
                    tabelaItens.row.add([
                        tabelaItens.rows().count() + 1,
                        `<input type="text" value="${item.nome}" class="form-control" required>`,
                        `<input type="text" value="${item.unidade}" class="form-control" required>`,
                        `<input type="number" value="${item.quantidade}" class="form-control qtd-inteiro" required>`,
                        `<input type="text" value="${item.valor.toFixed(2).replace('.', ',')}" class="form-control money-mask" required>`,
                        `<input type="text" value="${item.descricao}" class="form-control">`,
                        `<input type="text" value="${item.obs}" class="form-control">`,
                        `<button type="button" class="btn btn-danger btn-sm remover-linha"><i class="fas fa-trash"></i></button>`
                    ]).draw();
                }
            }
            
            // Aplicar máscaras
            $('.money-mask').mask('#.##0,00', {reverse: true});
            
        } catch (error) {
            console.error('Erro ao processar CSV:', error);
            alert('Ocorreu um erro ao processar o arquivo CSV. Verifique o formato do arquivo.');
        }
    }

    // Processar Excel
    function processExcel(data) {
        try {
            const workbook = XLSX.read(data, {type: 'array'});
            const firstSheet = workbook.Sheets[workbook.SheetNames[0]];
            const jsonData = XLSX.utils.sheet_to_json(firstSheet, {header: 1});
            
            if (jsonData.length <= 1) {
                alert('O arquivo Excel está vazio ou não possui dados válidos.');
                return;
            }
            
            // Processar linhas de dados
            for (let i = 1; i < jsonData.length; i++) {
                const rowData = jsonData[i];
                
                // Verificar se a linha tem dados suficientes
                if (rowData.length >= 4) {
                    let valor = 0;
                    
                    // Tratar diferentes formatos de valor
                    if (typeof rowData[3] === 'number') {
                        valor = rowData[3];
                    } else if (typeof rowData[3] === 'string') {
                        valor = parseFloat(rowData[3].replace('.', '').replace(',', '.')) || 0;
                    }
                    
                    const item = {
                        nome: rowData[0]?.toString().trim() || '',
                        unidade: rowData[1]?.toString().trim() || 'UN',
                        quantidade: parseInt(rowData[2]) || 1,
                        valor: valor,
                        descricao: rowData[4]?.toString().trim() || '',
                        obs: rowData[5]?.toString().trim() || ''
                    };
                    
                    // Adicionar à tabela
                    tabelaItens.row.add([
                        tabelaItens.rows().count() + 1,
                        `<input type="text" value="${item.nome}" class="form-control" required>`,
                        `<input type="text" value="${item.unidade}" class="form-control" required>`,
                        `<input type="number" value="${item.quantidade}" class="form-control qtd-inteiro" required>`,
                        `<input type="text" value="${item.valor.toFixed(2).replace('.', ',')}" class="form-control money-mask" required>`,
                        `<input type="text" value="${item.descricao}" class="form-control">`,
                        `<input type="text" value="${item.obs}" class="form-control">`,
                        `<button type="button" class="btn btn-danger btn-sm remover-linha"><i class="fas fa-trash"></i></button>`
                    ]).draw();
                }
            }
            
            // Aplicar máscaras
            $('.money-mask').mask('#.##0,00', {reverse: true});
            
        } catch (error) {
            console.error('Erro ao processar Excel:', error);
            alert('Ocorreu um erro ao processar o arquivo Excel. Verifique o formato do arquivo.');
        }
    }

    // Eventos de drag and drop
    dropArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropArea.classList.add('dragover');
        dropArea.innerHTML = 'Solte o arquivo aqui para importar';
    });

    dropArea.addEventListener('dragleave', () => {
        dropArea.classList.remove('dragover');
        dropArea.innerHTML = 'Arraste o arquivo aqui ou <input type="file" id="file-input" accept=".csv, .xlsx, .xls" class="form-control mt-2">';
    });

    dropArea.addEventListener('drop', (e) => {
        e.preventDefault();
        dropArea.classList.remove('dragover');
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            const file = files[0];
            if (file.name.endsWith('.csv') || file.name.endsWith('.xlsx') || file.name.endsWith('.xls')) {
                handleFile(file);
            } else {
                alert('Por favor, selecione um arquivo CSV ou Excel.');
            }
        }
    });

    // Evento de seleção de arquivo
    fileInput.addEventListener('change', (e) => {
        if (e.target.files.length > 0) {
            const file = e.target.files[0];
            if (file.name.endsWith('.csv') || file.name.endsWith('.xlsx') || file.name.endsWith('.xls')) {
                handleFile(file);
            } else {
                alert('Por favor, selecione um arquivo CSV ou Excel.');
            }
        }
    });

    // Função para calcular total por item
    function calcularItem(linha) {
        const qtd = parseInt(linha.find('.qtd-inteiro').val()) || 0;
        const valorUnitario = parseFloat(
            linha.find('.money-mask').val().replace(/\./g, '').replace(',', '.')
        ) || 0;

        const totalItem = qtd * valorUnitario;
        linha.find('.total-item').text(totalItem.toLocaleString('pt-BR', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }));

        return totalItem;
    }

    // Função para calcular o total geral
    function calcularTotal() {
        let totalGeral = 0;

        $('#tabela-itens tbody tr').each(function() {
            totalGeral += calcularItem($(this));
        });

        // Formata o total geral
        $('#total-geral').text(totalGeral.toLocaleString('pt-BR', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }));
    }

    // Calcular ao modificar valores
    $(document).on('input', '.money-mask, .qtd-inteiro', function() {
        calcularItem($(this).closest('tr'));
        calcularTotal();
    });

    // Inicializar máscaras
    $('.money-mask').mask('#.##0,00', {reverse: true});
});
$(document).ready(function() {
    let currentStep = 1;
    const totalSteps = $('.step').length;

    // Navegação para frente
    $('.proximo').click(function() {
        if(validarPasso(currentStep)) {
            mudarPasso(currentStep + 1);
        }
    });

    // Navegação para trás
    $('.anterior').click(function() {
        mudarPasso(currentStep - 1);
    });

    function mudarPasso(novoPasso) {
        // Esconder etapa atual
        $(`.step[data-step="${currentStep}"]`).removeClass('active');
        
        // Mostrar nova etapa
        currentStep = novoPasso;
        $(`.step[data-step="${currentStep}"]`).addClass('active');
    }

    function validarPasso(passo) {
        let valido = true;
        
        // Verificar todos os campos obrigatórios
        $(`.step[data-step="${passo}"] [required]`).each(function() {
            if(!$(this).val()) {
                $(this).closest('.pergunta').find('.erro-validacao').show();
                valido = false;
            }
        });
        
        return valido;
    }

    // Controle de opções selecionadas
    $('.opcao-box').click(function() {
        // Remover seleção anterior
        $(this).siblings('.opcao-box').removeClass('selecionada');
        
        // Marcar seleção atual
        $(this).addClass('selecionada');
        
        // Atualizar valor do input
        const valor = $(this).data('resposta');
        $(this).siblings('input').val(valor);
        
        // Mostrar/ocultar campos condicionais
        const target = $(this).data('toggle-target');
        if(target) {
            const deveMostrar = $(this).data('toggle-values').includes(valor);
            $(target).toggle(deveMostrar);
        }
    });
});


</script>
