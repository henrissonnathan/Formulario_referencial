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
        <form name="formCadastro" method="post" action="salvar/salvarC" data-parsley-validate="">
            <!-- pca -->
            <label for="pca">TEM PREVISÃO NO PCA?</label>
            <select name="pca" id="pca" class="form-control borda toggle-trigger" required data-parsley-required-message="Por favor,selecione uma opisão" data-toggle-target="#resposta-pca-container" data-toggle-values='["Sim"]'>
                <option value="">Selecione uma opção</option>
                <?php foreach ($selectOptions['pca'] as $value => $label): ?>
                    <option value="<?= $value ?>"><?= $label ?></option>
                <?php endforeach; ?>
            </select>
            <br>

            <div id="resposta-pca-container" class="toggleable-field" style="display: none;">
                <label for="resposta-pca">Justifique:</label>
                <input type="number" name="resposta-pca" id="resposta-pca" class="form-control borda" placeholder="Justifique">
            </div>





            <!-- orçamento(valor) -->
            <label for="orcamento">INFORME A DOTAÇÃO ORÇAMENTÁRIA</label>
            <input type="text" name="orcamento" id="orcamento" class="form-control borda money-mask" value="0,00" placeholder="Coloque um valor" required data-parsley-required-message="Por favor, preencha a Dotação orçamentária">




            <!-- Natureza da contratação-->
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

            <!-- tabela-->
            <table id="tabela-itens" class="table table-bordered">
            <thead class="table-color">
                <tr>
            <th>ID</th>
            <th>Item</th>
            <th>Unid.</th>
            <th>Qtd.</th>
            <th>Valor Unit</th>
            <th>Total Item</th>
            <th>Descrição</th>
            <th>Obs.</th>
            <th>Ações</th>
                </tr>
            </thead>
                <tbody>
                    <!--Linha inicial  esta assim par no import não ter uma linha amis
                    <tr>
                <td>1</td>
                <td><input type="text" name="item[]" class="form-control" required></td>
                <td><input type="text" name="unid[]" class="form-control unidade" value="UN" required></td>
                <td><input type="number" name="qtd[]" class="form-control qtd-inteiro" min="1" value="1" required></td>
                <td><input type="text" name="valor_unitario[]" class="form-control money-mask" required></td>
                <td class="total-item">0,00</td>
                <td><input type="text" name="descricao[]" class="form-control"></td>
                <td><input type="text" name="obs[]" class="form-control"></td>
                <td><button type="button" class="btn btn-danger btn-sm remover-linha"><i class="fas fa-trash"></i></button></td>
                    </tr>-->
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

            <!-- Modalidade-->
            <label for="modalidade">MODALIDADE</label>
            <select name="modalidade" id="modalidade" class="form-control borda  toggle-trigger" required data-parsley-required-message="Por favor, selecione uma opisão" data-toggle-target="#modal" data-toggle-values='["Licitação","Inexigibilidade e licitação","Chamamento público",""]'>
                <option value="">Selecione uma opção</option>
                <?php foreach ($selectOptions['modalidade'] as $value => $label): ?>
                    <option value="<?= $value ?>"><?= $label ?></option>
                <?php endforeach; ?>
            </select>


            <!--Critério-->
            <div id="modal" class="toggleable-field" style="display: none;">
                <label for="criterio">CRITÉRIO DE ADJUDICAÇÃO DO OBJETO</label>
                <select name="criterio" id="criterio" class="form-control borda" required data-parsley-required-message="Por favor, selecione uma opisão">
                    <option value="">Selecione uma opção</option>
                    <?php foreach ($selectOptions['criterio'] as $value => $label): ?>
                        <option value="<?= $value ?>"><?= $label ?></option>
                    <?php endforeach; ?>
                </select>
            </div>


            <!--trata de licitações,etc.-->
            <label for="trata">TRATA-SE DE LICITAÇÕES DECORRENTE DE CONVÊNIO/CONTRATO DE REPASSE/OUTROS COM GOVERNO ESTADUAL/FEDERAL?</label>
            <select name="trata" id="trata" class="form-control borda" required data-parsley-required-message="Por favor, selecione uma opisão">
                <option value="">Selecione uma opção</option>
                <?php foreach ($selectOptions['trata'] as $value => $label): ?>
                    <option value="<?= $value ?>"><?= $label ?></option>
                <?php endforeach; ?>
            </select>
            <!--definisão de quantidade-->
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




            <!--definisão de quantidade-->
            <label for="parametro">PARÂMETRO UTILIZADO PARA OBTENÇÃO DO VALOR DE REFERÊNCIA:</label>
            <select name="parametro" id="parametro" class="form-control borda" required data-parsley-required-message="Por favor, selecione uma opisão">
                <option value="">Selecione uma opção</option>
                <?php foreach ($selectOptions['parametro'] as $value => $label): ?>
                    <option value="<?= $value ?>"><?= $label ?></option>
                <?php endforeach; ?>
            </select>

            <!--PARÂMETRO UTILIZADO PARA OBTENÇÃO DO VALOR DE REFERÊNCIA-->
            <label>FONTES DE PESQUISA </label>
            <!-- Container dos parâmetros -->
            <div id="fontes-container">
                <!-- Linha 1 -->
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

                <!-- Linha 2 (mínimo obrigatório) -->
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

            <!-- Botão para adicionar mais linhas -->
            <button type="button" id="adicionar-fonte" class="btn btn-primary btn-sm mt-2">
                <i class="fas fa-plus"></i> Adicionar Parâmetro
            </button>


            <!--Orçamento fas fa-ca-->
            <label for="orcamento">FOI OBTIDO ORÇAMENTO COM, NO MÍNIMO, 03 FORNECEDORES ENQUADRADOS COMO MPE LOCAL OU REGIONAL OU, DE OUTRA FORMA, HÁ COMPROVAÇÃO DE QUE HÁ 03 FORNECEDORES MPE LOCAL OU REGIONAL?</label>
            <select name="orcamento" id="orcamento" class="form-control borda" required data-parsley-required-message="Por favor, selecione uma opisão">
                <option value="">Selecione uma opção</option>
                <?php foreach ($selectOptions['orcamento'] as $value => $label): ?>
                    <option value="<?= $value ?>"><?= $label ?></option>
                <?php endforeach; ?>
            </select>

            <!--retrisão territorial -->
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





            <!--CARACTERÍSTICA DO CERTAME-->
            <label for="certame">CARACTERÍSTICA DO CERTAME:</label>
            <select name="certame" id="certame" class="form-control borda" required data-parsley-required-message="Por favor, selecione uma opisão">
                <option value="">Selecione uma opção</option>
                <?php foreach ($selectOptions['certame'] as $value => $label): ?>
                    <option value="<?= $value ?>"><?= $label ?></option>
                <?php endforeach; ?>
            </select>


            <!--FORMA DE SELEÇÃO*-->
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




            <!--ANALISE DE CONFORMIDADE DA PROPOSTA*-->
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


            <!--justificativa-->
            <label for="justificativa">JUSTIFICATIVA DA CONTRATAÇÃO:</label>
            <input type="text" name="justificativa" id="justificativa" class="form-control borda" placeholder="Digite a justificativa" required data-parsley-required-message="Por favor, preencha o justificativa">
            <!--condiçoes específicas do objeto-->
            <label for="condicoes">CONDIÇÕES ESPECÍFICAS DO OBJETO (detalhamento completo do objeto)</label>
            <input type="text" name="condicoes" id="condicoes" class="form-control borda" placeholder="Digite a condicoes" required data-parsley-required-message="Por favor, preencha o condicoes">
            <!--prazo de vigência do(a) sistema registro de preços-->
            <label for="prazo">PRAZO DE VIGÊNCIA DO(A) SISTEMA REGISTRO DE PREÇOS (ATA REGISTRO DE PREÇOS)</label>
            <input type="text" name="prazo" id="prazo" class="form-control borda" placeholder="Digite a prazo" required data-parsley-required-message="Por favor, preencha o prazo">
            <!--PRAZO DE EXECUÇÃO-->
            <label for="execucao">DETALHE COMO DEVE SER O PRAZO DE EXECUÇÃO - PRAZO MÁXIMO PARA INICIAR E PRAZO PARA CONCLUSÃO</label>
            <input type="text" name="execucao" id="execucao" class="form-control borda" placeholder="Digite a execucao" required data-parsley-required-message="Por favor, preencha o execucao">
            <!--LOCAL DE EXECUÇÃO-->
            <label for="local">LOCAL DE EXECUÇÃO</label>
            <input type="text" name="local" id="local" class="form-control borda" placeholder="Digite a local" required data-parsley-required-message="Por favor, preencha o local">



            <!-- UNIDADE REQUISITANTE -->
            <div class="mb-3">
                <label for="proposta" class="form-label">UNIDADE REQUISITANTE</label>
                <select name="proposta" id="proposta" class="form-control borda" required data-parsley-required-message="Por favor, selecione uma opção">
                    <option value="">Selecione uma opção</option>
                    <?php foreach ($selectOptions['requisitante'] as $value => $label): ?>
                        <option value="<?= $value ?>"><?= $label ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- RESPONSÁVEL PELO ETP -->
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

            <!-- RESPONSÁVEL PELO DFD -->
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

            <!-- RESPONSÁVEL PELO LEVANTAMENTO DE PREÇO -->
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


            <!--PRAZO DE EXECUÇÃO-->
            <label for="data">DATA E ASSINATURA</label>
            <input type="text" name="data" id="data" class="form-control borda" placeholder="Digite a datae e assinatura" required data-parsley-required-message="Por favor, preencha o compo">


            <button type="submit" class="btn btn-success">
                <i class="fas fa-check"></i> Salvar Dados
            </button>

        </form>
    </div>
</div>
<!---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropArea = document.querySelector('.drag-drop-area');
        const fileInput = document.getElementById('file-input');

        // Drag and Drop
        dropArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropArea.classList.add('dragover');
        });

        dropArea.addEventListener('dragleave', () => {
            dropArea.classList.remove('dragover');
        });

        dropArea.addEventListener('drop', (e) => {
            e.preventDefault();
            dropArea.classList.remove('dragover');
            const files = e.dataTransfer.files;
            if (files.length) handleFile(files[0]);
        });

        // Seleção manual
        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length) handleFile(e.target.files[0]);
        });

        // Processar arquivo
        function handleFile(file) {
    const reader = new FileReader();

    reader.onload = function(e) {
        const data = e.target.result;

        // Verifica se é um arquivo CSV
        if (file.name.endsWith('.csv')) {
            const rows = data.split('\n').map(row => row.split(','));

            // Verifica se há dados no arquivo
            if (rows.length <= 1) {
                alert('O arquivo está vazio ou não possui dados válidos.');
                return;
            }

            // Converter para formato da tabela
            const items = rows.slice(1).map(row => ({
                item: row[0]?.trim() || '',
                unidade: row[1]?.trim() || 'UN',
                qtd: parseInt(row[2]?.trim()) || 1,
                valor: parseFloat(row[3]?.trim()) || 0.00,
                descricao: row[4]?.trim() || '',
                obs: row[5]?.trim() || ''
            }));

            // Adicionar à tabela
            items.forEach(item => {
                $('#tabela-itens tbody').append(`
                    <tr>
                        <td>${$('#tabela-itens tbody tr').length + 1}</td>
                        <td><input type="text" value="${item.item}" class="form-control" required></td>
                        <td><input type="text" value="${item.unidade}" class="form-control" required></td>
                        <td><input type="number" value="${item.qtd}" class="form-control qtd-inteiro" required></td>
                        <td><input type="text" value="${item.valor.toFixed(2)}" class="form-control money-mask" required></td>
                        <td class="total-item">${(item.qtd * item.valor).toFixed(2)}</td>
                        <td><input type="text" value="${item.descricao}" class="form-control"></td>
                        <td><input type="text" value="${item.obs}" class="form-control"></td>
                        <td><button class="btn btn-danger btn-sm remover-linha"><i class="fas fa-trash"></i></button></td>
                    </tr>
                `);
            });

            // Atualizar máscaras
            $('.money-mask').mask('000.000.000.000.000,00', { reverse: true });
        } else {
            // Processar arquivos XLSX
            const workbook = XLSX.read(new Uint8Array(data), { type: 'array' });
            const firstSheet = workbook.Sheets[workbook.SheetNames[0]];
            const jsonData = XLSX.utils.sheet_to_json(firstSheet, { header: 1 });

            // Verifica se há dados no arquivo
            if (jsonData.length <= 1) {
                alert('O arquivo está vazio ou não possui dados válidos.');
                return;
            }

            // Converter para formato da tabela
            const items = jsonData.slice(1).map(row => ({
                item: row[0] || '',
                unidade: row[1] || 'UN',
                qtd: parseInt(row[2]) || 1,
                valor: parseFloat(row[3]) || 0.00,
                descricao: row[4] || '',
                obs: row[5] || ''
            }));

            // Adicionar à tabela
            items.forEach(item => {
                $('#tabela-itens tbody').append(`
                    <tr>
                        <td>${$('#tabela-itens tbody tr').length + 1}</td>
                        <td><input type="text" value="${item.item}" class="form-control" required></td>
                        <td><input type="text" value="${item.unidade}" class="form-control" required></td>
                        <td><input type="number" value="${item.qtd}" class="form-control qtd-inteiro" required></td>
                        <td><input type="text" value="${item.valor.toFixed(2)}" class="form-control money-mask" required></td>
                        <td class="total-item">${(item.qtd * item.valor).toFixed(2)}</td>
                        <td><input type="text" value="${item.descricao}" class="form-control"></td>
                        <td><input type="text" value="${item.obs}" class="form-control"></td>
                        <td><button class="btn btn-danger btn-sm remover-linha"><i class="fas fa-trash"></i></button></td>
                    </tr>
                `);
            });

            // Atualizar máscaras
            $('.money-mask').mask('000.000.000.000.000,00', { reverse: true });
        }
    };

    if (file.name.endsWith('.csv')) {
        reader.readAsText(file);
    } else {
        reader.readAsArrayBuffer(file);
    }
}
    });



    $(document).ready(function() {
        let contadorLinhas = 0

        // Adicionar nova linha
        $('#adicionar-linha').click(function() {
            contadorLinhas++;
            const novaLinha = `
        <tr>
            <td>${contadorLinhas}</td>
            <td><input type="text" name="item[]" class="form-control" required></td>
            <td><input type="text" name="unid[]" class="form-control unidade" value="UN" required></td>
            <td><input type="number" name="qtd[]" class="form-control qtd-inteiro" min="1" value="1" required></td>
            <td><input type="text" name="valor_unitario[]" class="form-control money-mask" required></td>
            <td class="total-item">0,00</td>
            <td><input type="text" name="descricao[]" class="form-control"></td>
            <td><input type="text" name="obs[]" class="form-control"></td>
            <td><button type="button" class="btn btn-danger btn-sm remover-linha"><i class="fas fa-trash"></i></button></td>
        </tr>`;
            $('#tabela-itens tbody').append(novaLinha);

            // Aplica máscaras aos novos campos
            $('.money-mask').mask('#.##0,00', {
                reverse: true
            });
        });

        // Remover última linha
        $('#remover-linha').click(function() {
            if ($('#tabela-itens tbody tr').length > 1) {
                $('#tabela-itens tbody tr:last').remove();
                contadorLinhas--;
                calcularTotal();
            } else {
                alert('Pelo menos um item deve ser mantido!');
            }
        });

        // Remover linha específica
        $(document).on('click', '.remover-linha', function() {
            if ($('#tabela-itens tbody tr').length > 1) {
                $(this).closest('tr').remove();
                // Atualiza IDs
                $('#tabela-itens tbody tr').each(function(index) {
                    $(this).find('td:first').text(index + 1);
                });
                contadorLinhas = $('#tabela-itens tbody tr').length;
                calcularTotal();
            } else {
        alert('Pelo menos um item deve ser mantido!');        
    }
});

        // Validação para aceitar apenas inteiros
        $(document).on('input', '.qtd-inteiro', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
            if (this.value < 1) this.value = 1;
            calcularItem($(this).closest('tr'));
        });

        // Máscara para orçamento
        $('#orcamento').mask('#.##0,00', {
            reverse: true
        });

        // Mostrar/ocultar resposta
        $(document).ready(function() {
            $(document).on('change', '.toggle-trigger', function() {
                const target = $(this).data('toggle-target');
                const triggerValues = $(this).data('toggle-values') || [];
                const noClearValues = $(this).data('no-clear-values') || [];
                const currentValue = $(this).val();

                const shouldShow = triggerValues.includes(currentValue);
                $(target).toggle(shouldShow);

                // Atualiza obrigatoriedade do campo condicional
                const $conditionalField = $(target).find('select, input');
                $conditionalField.prop('required', shouldShow);

                // Limpa apenas se não estiver em noClearValues
                if (!shouldShow && !noClearValues.includes(currentValue)) {
                    $conditionalField.val('');
                }
            });
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

        // Botão calcular
        $('#calcular-total').click(calcularTotal);
    });
    $(document).ready(function() {
        // Contador de parâmetros
        let contadorfontes = 2;

        // Adicionar novo parâmetro
        $('#adicionar-parametro').click(function() {
            contadorfontes++;
            const novoParametro = `
        <div class="input-group mb-2 parametro-item">
            <select name="parametro[]" class="form-control borda" required
                    data-parsley-required-message="Por favor, selecione uma opção">
                <option value="">Selecione uma opção</option>
                <?php foreach ($selectOptions['parametro'] as $value => $label): ?>
                    <option value="<?= $value ?>"><?= $label ?></option>
                <?php endforeach; ?>
            </select>
            <button type="button" class="btn btn-danger remover-parametro">
                <i class="fas fa-minus"></i>
            </button>
        </div>`;

            $('#fontes-container').append(novoParametro);
        });

        
        // Remover parâmetro
        $(document).on('click', '.remover-parametro', function() {
            if ($('.parametro-item').length > 2) {
                $(this).closest('.parametro-item').remove();
                contadorfontes--;
            } else {
                alert('É necessário manter pelo menos 2 parâmetros!');
            }
        });
    });
    $(document).ready(function() {
    $('#tabela-itens').DataTable({
        paging: true,
        searching: false,
        ordering: true,
        responsive: true,
        language: {
            url: "js/pt-BR.json"
        },
        columns: [
            null, null, null, null, null, null, null, null, null // 9 colunas
        ],
        dom: 'Bfrtip', // Adiciona botões para exportação
        buttons: [
            {
                extend: 'csvHtml5',
                text: 'Exportar CSV',
                bom: true, // Garante a codificação UTF-8 com BOM
                exportOptions: {
                    columns: ':visible', // Exporta apenas as colunas visíveis
                    modifier: {
                        order: 'current', // Exporta na ordem atual
                        page: 'all' // Exporta todas as páginas
                    }
                }
            }
        ]
    });
});
</script>