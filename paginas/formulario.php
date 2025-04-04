<?php
if (!isset($pagina)) {
    exit;
}
?>
<?php
// Inclui o arquivo de configuração formTermos
$selectOptions = require __DIR__ . '/../configs/select-options.php';
?>

<div class="card">
    <div class="card-header">
        <strong>Termos de Referencia simplificado</strong>
        <div class="float-end">
        </div>
    </div>
    <div class="card-body">
        <form name="formCadastro" method="post" action="#" id="formTermos" data-parsley-validate="">
            <div class="steps-container">

                <div class="step-form active" data-step="1">
                    <div class="pergunta-container">
                        <!--objeto resumido-->
                        <label for="object">Objeto resumido</label>
                        <input name="object" id="object" class="form-control borda " required data-parsley-required-message="Por favor, responda a pergunta">
                    </div>

                    <div class="pergunta-container">
                        <!-- PCA -->
                        <label for="PCA">TEM PREVISÃO NO PCA?</label>

                        <div class="opcoes-box-container" required data-toggle-target="#resposta-PCA-container">
                            <?php foreach ($selectOptions['PCA'] as $value => $label): ?>
                                <div class="opcao-box"
                                    data-value="<?= $value ?>"
                                    data-trigger-values='<?= ($label === "Sim") ? '["Sim"]' : '[]' ?>'>
                                    <?= $label ?>
                                </div>
                            <?php endforeach; ?>

                            <input type="hidden" name="PCA" id="PCA" required>
                        </div>
                        <div id="resposta-PCA-container" class="toggleable-field" style="display: none;">
                            <label for="Explicacao_sdPCA">Justifique:</label>
                            <input type="text" name="Explicacao_sdPCA" id="Explicacao_sdPCA"
                                class="form-control borda" placeholder="Justifique" required>
                        </div>
                    </div>

                    <div class="pergunta-container">

                        <!-- orçamento(valor) -->
                        <label for="orcamento(valor)">INFORME A DOTAÇÃO ORÇAMENTÁRIA</label>
                        <input type="text" name="orcamento(valor)" id="orcamento(valor)" class="form-control borda money-mask" placeholder="Coloque um valor" required data-parsley-required-message="Por favor, preencha a Dotação orçamentária">
                    </div>





                    <!-- Natureza da contratação-->
                    <label for="contrato">NATUREZA DA CONTRATAÇÃO</label>
                    <div class="opcoes-box-container" required data-toggle-target="#resposta-contrato">

                        <?php foreach ($selectOptions['contrato'] as $value => $label): ?>
                            <div class="opcao-box" data-value="<?= $value ?>" data-trigger-values='<?= ($label === "Outros") ? '["Outros"]' : '[]' ?>'>
                                <?= $label ?>
                            </div>
                        <?php endforeach; ?>
                        <input type="hidden" name="contrato" id="contrato" required>
                    </div>
                    <div id="resposta-contrato" class="toggleable-field" style="display: none;">
                        <label for="resposta-contrato">Informe:</label>
                        <input type="text" name="resposta-contrato" id="resposta-contrato" class="form-control borda" placeholder="INFORME:">
                    </div>



                    <div class="botoes-navegacao">
                        <button type="button" class="btn btn-primary proximo">Próximo ▶</button>
                    </div>
                </div>
                <!--fim da etapa 1-->

                <div class="step-form" data-step="2">
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
                    <div class="botoes-navegacao">
                        <button type="button" class="btn btn-primary voltar">◀ Voltar</button>
                    </div>
                    <div class="botoes-navegacao">
                        <button type="button" class="btn btn-primary proximo">Próximo ▶</button>
                    </div>


                </div>
                <!--fim da etapa 2-->

                <div class="step-form" data-step="3">
                    <div class="pergunta-container">
                        <!-- Modalidade-->
                        <label for="modalidade">MODALIDADE</label>
                        <select name="modalidade" id="modalidade" class="form-control borda  toggle-select" required data-parsley-required-message="Por favor, selecione uma opisão" data-target="#modal" data-trigger-values='["Licitação","Inexigibilidade e licitação","Chamamento público"]'>
                            <option value="">Selecione uma opção</option>
                            <?php foreach ($selectOptions['modalidade'] as $value => $label): ?>
                                <option value="<?= $value ?>"><?= $label ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="pergunta-container">
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
                    </div>



                    <div class="pergunta-container">
                        <!--trata de licitações,etc.-->
                        <label for="trata">TRATA-SE DE LICITAÇÕES DECORRENTE DE CONVÊNIO/CONTRATO DE REPASSE/OUTROS COM GOVERNO ESTADUAL/FEDERAL?</label>
                        <select name="trata" id="trata" class="form-control borda" required data-parsley-required-message="Por favor, selecione uma opisão">
                            <option value="">Selecione uma opção</option>
                            <?php foreach ($selectOptions['trata'] as $value => $label): ?>
                                <option value="<?= $value ?>"><?= $label ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="pergunta-container">
                        <!--definisão de quantidade-->
                        <label for="levantamento">COMO FORAM DEFINIDAS AS QUANTIDADES</label>
                        <select name="levantamento" id="levantamento" class="form-control borda toggle-trigger" required data-parsley-required-message="Por favor, selecione uma opisão" data-target="#leve" data-trigger-values='["Outros"]'>
                            <option value="">Selecione uma opção</option>
                            <?php foreach ($selectOptions['levantamento'] as $value => $label): ?>
                                <option value="<?= $value ?>"><?= $label ?></option>
                            <?php endforeach; ?>
                        </select>

                        <div id="leve" class="toggleable-field" style="display: none;">
                            <label for="leve_outro">Informe como foram definidas as quantidades</label>
                            <input type="text" name="leve_outro" id="leve_outro" class="form-control borda" placeholder="Informe como foram definidas as quantidades">
                        </div>
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

                    <div class="botoes-navegacao">
                        <button type="button" class="btn btn-primary voltar">◀ Voltar</button>
                    </div>
                    <div class="botoes-navegacao">
                        <button type="button" class="btn btn-primary proximo">Próximo ▶</button>
                    </div>
                </div>
                <!--fim da etapa 3-->

                <div class="step-form" data-step="4">
                    <div class="pergunta-container">
                        <!--Orçamento fas fa-ca-->
                        <label for="orcamento">FOI OBTIDO ORÇAMENTO COM, NO MÍNIMO, 03 FORNECEDORES ENQUADRADOS COMO MPE LOCAL OU REGIONAL OU, DE OUTRA FORMA, HÁ COMPROVAÇÃO DE QUE HÁ 03 FORNECEDORES MPE LOCAL OU REGIONAL?</label>
                        <select name="orcamento" id="orcamento" class="form-control borda" required data-parsley-required-message="Por favor, selecione uma opisão">
                            <option value="">Selecione uma opção</option>
                            <?php foreach ($selectOptions['orcamento'] as $value => $label): ?>
                                <option value="<?= $value ?>"><?= $label ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="pergunta-container">
                        <!--retrisão territorial -->
                        <label for="retricao">VAI SER APLICADA RESTRIÇÃO TERRITORIAL?</label>
                        <select name="retricao" id="retricao" class="form-control borda toggle-trigger" required data-parsley-required-message="Por favor, selecione uma opisão" data-target="#terri" data-trigger-values='["sim. Restrição regional","sim. Restrição local","Outros"]'>
                            <option value="">Selecione uma opção</option>
                            <?php foreach ($selectOptions['retricao'] as $value => $label): ?>
                                <option value="<?= $value ?>"><?= $label ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div id="terri" class="toggleable-field" style="display: none;">
                            <label for="restri-expli">Justifique</label>
                            <input type="text" name="restri-expli" id="restri-expli" class="form-control borda" placeholder="justifique">
                        </div>
                    </div>
                    <div class="botoes-navegacao">
                        <button type="button" class="btn btn-primary voltar">◀ Voltar</button>
                    </div>
                    <div class="botoes-navegacao">
                        <button type="button" class="btn btn-primary proximo">Próximo ▶</button>
                    </div>
                </div>
                <!--fim da etapa 4-->



                <div class="step-form" data-step="5">
                    <div class="pergunta-container">
                        <!--CARACTERÍSTICA DO CERTAME-->
                        <label for="certame">CARACTERÍSTICA DO CERTAME:</label>
                        <select name="certame" id="certame" class="form-control borda" required data-parsley-required-message="Por favor, selecione uma opisão">
                            <option value="">Selecione uma opção</option>
                            <?php foreach ($selectOptions['certame'] as $value => $label): ?>
                                <option value="<?= $value ?>"><?= $label ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="pergunta-container">
                        <!--FORMA DE SELEÇÃO*-->
                        <label for="selecao">FORMA DE SELEÇÃO:</label>
                        <select name="selecao" id="selecao" class="form-control borda toggle-trigger" required data-parsley-required-message="Por favor, selecione uma opisão" data-target="#selecasta" data-trigger-values='["Presencial","Sem disputas"]'>
                            <option value="">Selecione uma opção</option>
                            <?php foreach ($selectOptions['selecao'] as $value => $label): ?>
                                <option value="<?= $value ?>"><?= $label ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div id="selecasta" class="toggleable-field" style="display:none;">
                            <label for="seleca-esxpli">justifique</label>
                            <input type="text" name="seleca-expli" id="seleca-expli" class="form-control borda" placeholder="justifique">
                        </div>
                    </div>
                    <div class="botoes-navegacao">
                        <button type="button" class="btn btn-primary voltar">◀ Voltar</button>
                    </div>
                    <div class="botoes-navegacao">
                        <button type="button" class="btn btn-primary proximo">Próximo ▶</button>
                    </div>
                </div>
                <!--fim da etapa 5-->

                <div class="step-form" data-step="6">
                    <div class="pergunta-container">
                        <!--ANALISE DE CONFORMIDADE DA PROPOSTA*  leve-outro-->
                        <label for="proposta">ANALISE DE CONFORMIDADE DA PROPOSTA:</label>
                        <select name="proposta" id="proposta" class="form-control borda toggle-trigger" required data-parsley-required-message="Por favor, selecione uma opisão" data-target="#propostas" data-trigger-values='["Amostra","Exame de conformidade","Prova de conceito"]'>
                            <option value="">Selecione uma opção</option>
                            <?php foreach ($selectOptions['proposta'] as $value => $label): ?>
                                <option value="<?= $value ?>"><?= $label ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div id="propostas" class="toggleable-field" style="display: none;">
                            <label for="propos_expli">Defina os quesitos</label>
                            <input type="text" name="propos_expli" id="propos_expli" class="form-control borda" placeholder="justifique">
                        </div>
                    </div>
                    <div class="pergunta-container">
                        <!--justificativa-->
                        <label for="justificativa">JUSTIFICATIVA DA CONTRATAÇÃO:</label>
                        <input type="text" name="justificativa" id="justificativa" class="form-control borda" placeholder="Digite a justificativa" required data-parsley-required-message="Por favor, preencha o justificativa">
                    </div>
                    <div class="botoes-navegacao">
                        <button type="button" class="btn btn-primary voltar">◀ Voltar</button>
                    </div>
                    <div class="botoes-navegacao">
                        <button type="button" class="btn btn-primary proximo">Próximo ▶</button>
                    </div>
                </div>

                <!--fim da etapa 7-->

                <div class="step-form" data-step="7">
                    <div class="pergunta-container">
                        <!--condiçoes específicas do objeto-->
                        <label for="condicoes">CONDIÇÕES ESPECÍFICAS DO OBJETO (detalhamento completo do objeto)</label>
                        <input type="text" name="condicoes" id="condicoes" class="form-control borda" placeholder="Digite a condicoes" required data-parsley-required-message="Por favor, preencha o condicoes">
                    </div>
                    <div class="pergunta-container">
                        <!--prazo de vigência do(a) sistema registro de preços-->
                        <label for="prazo">PRAZO DE VIGÊNCIA DO(A) SISTEMA REGISTRO DE PREÇOS (ATA REGISTRO DE PREÇOS)</label>
                        <input type="text" name="prazo" id="prazo" class="form-control borda" placeholder="Digite a prazo" required data-parsley-required-message="Por favor, preencha o prazo">
                    </div>
                    <div class="pergunta-container">
                        <!--PRAZO DE EXECUÇÃO-->
                        <label for="execucao">DETALHE COMO DEVE SER O PRAZO DE EXECUÇÃO - PRAZO MÁXIMO PARA INICIAR E PRAZO PARA CONCLUSÃO</label>
                        <input type="text" name="execucao" id="execucao" class="form-control borda" placeholder="Digite a execucao" required data-parsley-required-message="Por favor, preencha o execucao">
                    </div>
                    <div class="pergunta-container">
                        <!--LOCAL DE EXECUÇÃO-->
                        <label for="local">LOCAL DE EXECUÇÃO</label>
                        <input type="text" name="local" id="local" class="form-control borda" placeholder="Digite a local" required data-parsley-required-message="Por favor, preencha o local">
                    </div>
                    <div class="botoes-navegacao">
                        <button type="button" class="btn btn-primary voltar">◀ Voltar</button>
                    </div>
                    <div class="botoes-navegacao">
                        <button type="button" class="btn btn-primary proximo">Próximo ▶</button>
                    </div>
                </div>
            </div>
            <!--fim da etapa 7-->

            <div class="step-form" data-step="8">
                <!-- unid REQUISITANTE -->
                <div class="mb-3">
                    <label for="proposta" class="form-label">unid REQUISITANTE</label>
                    <select name="proposta_unidade" id="proposta_unidade" class="form-control borda" required data-parsley-required-message="Por favor, selecione uma opção">
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






                <!--PRAZO DE EXECUÇÃO       DOMContentLoaded    #adicionar -->
                <label for="data">DATA E ASSINATURA</label>
                <input type="text" name="data" id="data" class="form-control borda" placeholder="Digite a datae e assinatura" required data-parsley-required-message="Por favor, preencha o compo">

                <div class="botoes-navegacao">
                    <button type="button" class="btn btn-primary voltar">◀ Voltar</button>
                </div>
                <button type="submit" class="btn btn-success" id="btn-enviar">
                    <i class="fas fa-paper-plane"></i> Enviar
                </button>
            </div>


    </div>
</div>
</form>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>

<script>
    let tabelaItens; // Declaração global

    $(document).ready(function() {
        // Inicializar DataTables com paginação
        tabelaItens = $('#tabela-itens').DataTable({
            paging: true,
            pageLength: 10, // 10 itens por página
            lengthMenu: [
                [5, 10, 20, 50, -1],
                [5, 10, 20, 50, "Todos"]
            ],
            searching: false,
            ordering: true,
            responsive: true,
            dom: 'Blfrtip',
            buttons: [{
                extend: 'csv',
                text: 'Exportar CSV',
                className: 'btn btn-primary btn-sm',
                exportOptions: {
                    columns: ':visible'
                }
            }],
            language: {
                url: "pt-BR.json",
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

            columns: [{
                    data: 'id'
                },
                {
                    data: 'item'
                },
                {
                    data: 'unid'
                },
                {
                    data: 'quantidade'
                },
                {
                    data: 'valor_unitario'
                },
                {
                    data: 'descricao'
                },
                {
                    data: 'obs'
                },
                {
                    data: 'acoes'
                }
            ],
            createdRow: function(row, data, index) {
                // Vincular os inputs aos dados da linha
                $(row).find('td').eq(1).html(`<input type="text" class="form-control" name="item[]" value="${data.item}">`);
                $(row).find('td').eq(2).html(`<input type="text" class="form-control" name="unid[]" value="${data.unid}">`);
                $(row).find('td').eq(3).html(`<input type="number" class="form-control qtd-inteiro" name="qtd[]" value="${data.quantidade}">`);
                $(row).find('td').eq(4).html(`<input type="text" class="form-control money-mask" name="valor_unitario[]" value="${data.valor_unitario}">`);
                $(row).find('td').eq(5).html(`<input type="text" class="form-control" name="descricao[]" value="${data.descricao}">`);
                $(row).find('td').eq(6).html(`<input type="text" class="form-control" name="obs[]" value="${data.obs}">`);
                // Aplicar máscaras
                $(row).find('.money-mask').mask('#.##0,00', {
                    reverse: true
                });
            }
        });

        $('#adicionar-fonte').click(function() {
            // Clona a primeira linha e remove atributos desnecessários
            const novaLinha = $('.fonte-item').first().clone();
            novaLinha.find('select').val(''); // Limpa o valor selecionado
            novaLinha.find('.remover-fonte').prop('disabled', false); // Habilita o botão de remover
            $('#fontes-container').append(novaLinha);
        });

        // Remover fonte de pesquisa
        $('#fontes-container').on('click', '.remover-fonte', function() {
            // Mantém no mínimo 2 linhas (obrigatórias)
            if ($('.fonte-item').length > 2) {
                $(this).closest('.fonte-item').remove();
            }
        });

        // Adicionar nova linha   
        $('#adicionar-linha').click(function() {
            const novaLinha = {
                id: tabelaItens.rows().count() + 1,
                item: '',
                unid: 'UN',
                quantidade: 1,
                valor_unitario: '0,00',
                descricao: '',
                obs: '',
                acoes: '<button type="button" class="btn btn-danger btn-sm remover-linha"><i class="fas fa-trash"></i></button>'
            };

            tabelaItens.row.add(novaLinha).draw();

            // Aplicar máscaras aos novos campos
            const linhaAdicionada = $('#tabela-itens tbody tr:last');
            linhaAdicionada.find('.money-mask').mask('#.##0,00', {
                reverse: true
            });
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
                        const nome = rowData[0]?.trim() || '';
                        const unid = rowData[1]?.trim() || 'UN';
                        const quantidade = parseInt(rowData[2]?.trim()) || 1;
                        const valor = parseFloat(rowData[3]?.trim().replace('.', '').replace(',', '.')) || 0;
                        const descricao = rowData[4]?.trim() || '';
                        const obs = rowData[5]?.trim() || '';

                        const item = {
                            id: tabelaItens.rows().count() + 1,
                            item: nome,
                            unid: unid,
                            quantidade: quantidade,
                            valor_unitario: valor.toFixed(2).replace('.', ','),
                            descricao: descricao,
                            obs: obs,
                            acoes: '<button type="button" class="btn btn-danger btn-sm remover-linha"><i class="fas fa-trash"></i></button>'
                        };

                        tabelaItens.row.add(item).draw(); // Adicionar à tabela
                    }
                }

                // Aplicar máscaras
                $('.money-mask').mask('#.##0,00', {
                    reverse: true
                });

            } catch (error) {
                console.error('Erro ao processar CSV:', error);
                alert('Ocorreu um erro ao processar o arquivo CSV. Verifique o formato do arquivo.');
            }
        }

        // Processar Excel
        function processExcel(data) {
            try {
                const workbook = XLSX.read(data, {
                    type: 'array'
                });
                const firstSheet = workbook.Sheets[workbook.SheetNames[0]];
                const jsonData = XLSX.utils.sheet_to_json(firstSheet, {
                    header: 1
                });

                if (jsonData.length <= 1) {
                    alert('O arquivo Excel está vazio ou não possui dados válidos.');
                    return;
                }

                // Processar linhas de dados
                for (let i = 1; i < jsonData.length; i++) {
                    const rowData = jsonData[i];

                    // Verificar se a linha tem dados suficientes
                    if (rowData.length >= 4) {
                        const nome = rowData[0]?.toString().trim() || '';
                        const unid = rowData[1]?.toString().trim() || 'UN';
                        const quantidade = parseInt(rowData[2]) || 1;
                        const valor = parseFloat(rowData[3]?.toString().replace('.', '').replace(',', '.')) || 0;
                        const descricao = rowData[4]?.toString().trim() || '';
                        const obs = rowData[5]?.toString().trim() || '';

                        const item = {
                            id: tabelaItens.rows().count() + 1,
                            item: nome,
                            unid: unid,
                            quantidade: quantidade,
                            valor_unitario: valor.toFixed(2).replace('.', ','),
                            descricao: descricao,
                            obs: obs,
                            acoes: '<button type="button" class="btn btn-danger btn-sm remover-linha"><i class="fas fa-trash"></i></button>'
                        };

                        tabelaItens.row.add(item).draw(); // Adicionar à tabela
                    }
                }

                // Aplicar máscaras
                $('.money-mask').mask('#.##0,00', {
                    reverse: true
                });

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
            // Obter elementos corretamente dentro da linha
            const qtdInput = linha.find('input[name="qtd[]"]');
            const valorInput = linha.find('input[name="valor_unitario[]"]');

            // Verificar se os elementos existem
            if (!qtdInput.length || !valorInput.length) return 0;

            const qtd = parseInt(qtdInput.val()) || 0;
            const valorUnitario = parseFloat(
                valorInput.val().replace(/\./g, '').replace(',', '.')
            ) || 0;

            const totalItem = qtd * valorUnitario;

            // Atualizar exibição se necessário
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
            const linha = $(this).closest('tr');
            calcularItem(linha);
            calcularTotal();
        });

        // Inicializar máscaras
        $('.money-mask').mask('#.##0,00', {
            reverse: true
        });

        // [NOVO] CONTROLE DOS SELECTS ESTILIZADOS - PARTE COMPLETA
        $('.opcoes-box-container').each(function() {
            const container = $(this);
            const hiddenInput = container.find('input[type="hidden"]');
            const errorMessage = container.find('.erro-validacao');

            container.find('.opcao-box').on('click', function() {
                const opcao = $(this);

                // Desselecionar todas
                container.find('.opcao-box').removeClass('selecionado');

                // Selecionar atual
                opcao.addClass('selecionado');

                // Atualizar valor
                hiddenInput.val(opcao.data('value')).trigger('change');

                // Esconder mensagem de erro
                errorMessage.hide();

                // Disparar evento para atualizar campos condicionais
                if (typeof atualizarToggles === 'function') {
                    atualizarToggles();
                }
            });
            // Validação em tempo real (seu código novo)
            hiddenInput.on('change', function() {
                if (!this.value) {
                    container.addClass('nao-preenchido');
                } else {
                    container.removeClass('nao-preenchido');
                }
            });
        });

        function atualizarToggles() {
            $('.opcoes-box-container').each(function() {
                const container = $(this);
                const targetSelector = container.data('toggle-target');
                const selectedOption = container.find('.opcao-box.selecionado');
                const target = $(targetSelector);

                if (target.length && selectedOption.length) {
                    const triggerValues = selectedOption.data('trigger-values') || [];
                    const shouldShow = triggerValues.length > 0;

                    target.toggle(shouldShow);
                    target.find('input, select, textarea')
                        .prop('required', shouldShow)
                        .prop('disabled', !shouldShow);
                }
            });
        }

        // Remova o código antigo de validação no submit e substitua por este:
        $('form').on('submit', function(e) {
            e.preventDefault();
            let formValido = true;
            const camposInvalidos = [];

            // Verificar todos os steps
            $('.step-form').each(function() {
                const step = $(this);
                const camposStep = getCamposNaoPreenchidos(step[0]);

                if (camposStep.length > 0) {
                    formValido = false;
                    camposInvalidos.push({
                        step: step.data('step'),
                        campos: camposStep
                    });
                }
            });

            if (!formValido) {
                const mensagem = camposInvalidos.map(item =>
                    `Passo ${item.step}:<br>- ${item.campos.join('<br>- ')}`
                ).join('<br><br>');

                Swal.fire({
                    title: 'Formulário incompleto!',
                    html: `Preencha os seguintes campos:<br><br>${mensagem}`,
                    icon: 'error',
                    didOpen: () => {
                        const primeiroErro = $('.nao-preenchido').first();
                        if (primeiroErro.length) {
                            $('html, body').animate({
                                scrollTop: primeiroErro.offset().top - 100
                            }, 500);
                        }
                    }
                });
            } else {
                // Enviar formulário se estiver válido
                this.submit();
            }
        });

        // Mantenha este código para o controle das caixas de seleção
        $('.opcoes-box-container').each(function() {
            const container = $(this);
            const hiddenInput = container.find('input[type="hidden"]');
            const errorMessage = container.find('.erro-validacao');

            container.find('.opcao-box').on('click', function() {
                const opcao = $(this);

                container.find('.opcao-box').removeClass('selecionado');
                opcao.addClass('selecionado');

                hiddenInput.val(opcao.data('value')).trigger('change');
                container.removeClass('nao-preenchido');
                errorMessage.hide();

                if (typeof atualizarToggles === 'function') atualizarToggles();
            });

            hiddenInput.on('change', function() {
                container.toggleClass('nao-preenchido', !this.value);
            });
        });

        // Ensure only the first step is visible initially
        $('.step-form').hide();
        $('.step-form[data-step="1"]').show().addClass('active');

        // Function to navigate between steps
        function navigateSteps(direction) {
            const currentStep = $('.step-form.active');
            const currentStepNumber = parseInt(currentStep.data('step'));
            const nextStepNumber = direction === 'next' ? currentStepNumber + 1 : currentStepNumber - 1;
            const nextStep = $(`.step-form[data-step="${nextStepNumber}"]`);

            if (nextStep.length) {
                if (direction === 'next' && !validateStep(currentStep)) return;

                currentStep.removeClass('active').hide();
                nextStep.addClass('active').fadeIn();
            }
        }

        // Validate the current step
        function validateStep(step) {
            let isValid = true;
            const invalidFields = getCamposNaoPreenchidos(step);

            if (invalidFields.length > 0) {
                isValid = false;
                const stepNumber = step.data('step');
                const message = `Passo ${stepNumber}: Preencha os seguintes campos:<br>- ${invalidFields.join('<br>- ')}`;

                Swal.fire({
                    title: 'Campos obrigatórios',
                    html: message,
                    icon: 'error',
                    didOpen: () => {
                        $('html, body').animate({
                            scrollTop: step.find('.nao-preenchido').first().offset().top - 100
                        }, 500);
                    }
                });
            }

            return isValid;
        }

        // Get unfilled required fields
        function getCamposNaoPreenchidos(step) {
            const fields = [];

            step.find('input[required]:not([type="hidden"]), select[required], textarea[required]').each(function() {
                if (!this.value.trim() && $(this).closest('.toggleable-field').is(':visible')) {
                    const label = $(this).closest('.pergunta-container').find('label').text().trim();
                    fields.push(label);
                }
            });

            step.find('.opcoes-box-container[required]').each(function() {
                const container = $(this);
                if (!container.find('input[type="hidden"]').val()) {
                    const label = container.prev('label').text().trim();
                    fields.push(label);
                }
            });

            return fields;
        }

        // Attach event listeners for navigation buttons
        $('.proximo').on('click', function() {
            navigateSteps('next');
        });

        $('.voltar').on('click', function() {
            navigateSteps('prev');
        });

        // Initialize toggles on page load
        atualizarToggles();

        const formulario = document.getElementById('formTermos');

        formulario.addEventListener('submit', function(e) {
            e.preventDefault();

            const btnEnviar = document.getElementById('btn-enviar');
            btnEnviar.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enviando...';
            btnEnviar.disabled = true;

            // Coletar dados da tabela CORRETAMENTE}


            // Coletar dados usando a API do DataTables
            const tableData = [];
            tabelaItens.rows({
                search: 'applied',
                page: 'all'
            }).every(function() {
                const row = this.node();
                const valorInput = $(row).find('input[name="valor_unitario[]"]').val() || '0,00';
                const valorNumerico = valorInput.replace(/[^\d,]/g, '').replace(',', '.');

                const rowData = {
                    item: $(row).find('input[name="item[]"]').val() || '',
                    unid: $(row).find('input[name="unid[]"]').val() || 'UN',
                    quantidade: $(row).find('input[name="qtd[]"]').val() || 1,
                    valor_unitario: valorNumerico || '0.00',
                    descricao: $(row).find('input[name="descricao[]"]').val() || '',
                    obs: $(row).find('input[name="obs[]"]').val() || ''
                };
                tableData.push(rowData);
            });


            const formData = new FormData(formulario);
            formData.append('tableData', JSON.stringify(tableData));

            fetch('salvar/enviar-email.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    alert(data);
                    btnEnviar.innerHTML = '<i class="fas fa-paper-plane"></i> Enviar por Email';
                    btnEnviar.disabled = false;
                })
                .catch(error => {
                    alert('Erro: ' + error.message);
                    btnEnviar.innerHTML = '<i class="fas fa-paper-plane"></i> Enviar por Email';
                    btnEnviar.disabled = false;
                });
        }); // <-- Missing closing brace added here
    }); // <-- Ensure this closing brace matches the opening $(document).ready
</script>