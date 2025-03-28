<?php
if (!isset($pagina)) {
    exit;
}

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
                    <div class="pergunta-container">
                        <div class="pergunta-texto">TEM PREVISÃO NO PCA?</div>

                        <div class="opcoes-grid" data-toggle-target="#resposta-pca-container">
                            <?php foreach ($selectOptions['pca'] as $value => $label): ?>
                                <div class="opcao-box"
                                    data-resposta="<?= $value ?>"
                                    data-toggle-values='["Sim"]'>
                                    <?= $label ?>
                                </div>
                            <?php endforeach; ?>
                            <input type="hidden" name="pca" required>
                            <div class="erro-validacao">Por favor selecione uma opção!</div>
                        </div>
                    </div>

                    <!-- Campo condicional -->
                    <div id="resposta-pca-container" class="pergunta-condicional">
                        <div class="pergunta-container">
                            <div class="pergunta-texto">Justificativa</div>
                            <input type="text" name="resposta-pca" class="form-control borda"
                                placeholder="Digite sua justificativa">
                        </div>
                    </div>
                    <!-- orçamento(valor) -->
                    <div class="pergunta-container">
                        <div class="pergunta-texto">INFORME A DOTAÇÃO ORÇAMENTÁRIA</div>
                        <input type="text" name="orcamento" id="orcamento"
                            class="form-control borda money-mask"
                            value="0,00"
                            placeholder="Coloque um valor"
                            required
                            data-parsley-required-message="Por favor, preencha a Dotação orçamentária">
                    </div>
                    <div class="botoes-navegacao">
                        <button type="button" class="btn btn-primary proximo">Próximo ▶</button>
                    </div>
                </div>

                <!--segunda-->
                <!-- Natureza da contratação-->
                <div class="step" data-step="2">
                    <div class="pergunta-container">
                        <div class="pergunta-texto">NATUREZA DA CONTRATAÇÃO</div>

                        <div class="opcoes-grid" data-toggle-target="#resposta-Natureza-container">
                            <?php foreach ($selectOptions['contrato'] as $value => $label): ?>
                                <div class="opcao-box"
                                    data-resposta="<?= $value ?>"
                                    data-toggle-values='["Outros"]'>
                                    <?= $label ?>
                                </div>
                            <?php endforeach; ?>
                            <input type="hidden" name="contrato" required>
                            <div class="erro-validacao">Por favor selecione uma opção!</div>
                        </div>
                    </div>

                    <!-- Campo condicional -->
                    <div id="resposta-Natureza-container" class="pergunta-condicional" style="display: none;">
                        <div class="pergunta-container">
                            <div class="pergunta-texto">Informe a natureza específica</div>
                            <input type="text" name="resposta-contrato" class="form-control borda"
                                placeholder="Descreva a natureza da contratação">
                        </div>
                    </div>

                    <div class="botoes-navegacao">
                        <button type="button" class="btn btn-secondary anterior">◀ Anterior</button>
                        <button type="button" class="btn btn-primary proximo">Próximo ▶</button>
                    </div>
                </div>

                <!-- Etapa 3 - Itens e Importação -->
                <div class="step" data-step="3">
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

                    <h5 class="mt-4">Itens</h5>

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

                    <!-- Botões de navegação -->
                    <div class="botoes-navegacao mt-4">
                        <button type="button" class="btn btn-secondary anterior">◀ Anterior</button>
                        <button type="button" class="btn btn-primary proximo">Próximo ▶</button>
                    </div>
                </div>

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
        // Configuração avançada da máscara monetária
        const applyMasks = () => {
            $('.money-mask').mask('#.##0,00', {
                reverse: true,
                translation: {
                    '0': {
                        pattern: /\d/
                    },
                    ',': {
                        pattern: /\,/,
                        optional: false
                    }
                },
                onKeyPress: function(value, e, field, options) {
                    value = value.replace(/[^\d,]/g, '');
                    const parts = value.split(',');
                    if (parts.length > 1) {
                        parts[1] = parts[1].slice(0, 2);
                        value = parts.join(',');
                    }
                    $(field).val(value);
                }
            });
        };

        // Inicialização do DataTables
        const tabelaItens = $('#tabela-itens').DataTable({
            paging: true,
            pageLength: 10,
            lengthMenu: [
                [5, 10, 20, 50, -1],
                [5, 10, 20, 50, "Todos"]
            ],
            searching: false,
            ordering: true,
            responsive: true,
            columns: [{
                    title: "ID"
                },
                {
                    title: "Item"
                },
                {
                    title: "Unid."
                },
                {
                    title: "Qtd."
                },
                {
                    title: "Valor Unit",
                    render: function(data) {
                        return `<input type="text" class="form-control money-mask" 
                             value="${typeof data === 'number' ? data.toLocaleString('pt-BR', {minimumFractionDigits: 2}) : data}" 
                             required>`;
                    }
                },
                {
                    title: "Descrição"
                },
                {
                    title: "Obs."
                },
                {
                    title: "Ações",
                    orderable: false,
                    render: function() {
                        return '<button class="btn btn-danger btn-sm remover-linha"><i class="fas fa-trash"></i></button>';
                    }
                }
            ],
            createdRow: function(row) {
                $(row).find('.money-mask').mask('#.##0,00', {
                    reverse: true
                });
            }
        });

        // Adicionar nova linha
        $('#adicionar-linha').click(function() {
            tabelaItens.row.add([
                tabelaItens.rows().count() + 1,
                '<input type="text" class="form-control" required>',
                '<input type="text" class="form-control" value="UN" required>',
                '<input type="number" class="form-control qtd-inteiro" value="1" min="1" required>',
                '<input type="text" class="form-control money-mask" value="0,00" required>',
                '<input type="text" class="form-control">',
                '<input type="text" class="form-control">',
                '<button class="btn btn-danger btn-sm remover-linha"><i class="fas fa-trash"></i></button>'
            ]).draw();
            applyMasks();
            calcularTotal();
        });

        // Função de importação aprimorada
        function handleFile(file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                try {
                    let jsonData;
                    if (file.name.endsWith('.csv')) {
                        const rows = e.target.result.split('\n').filter(row => row.trim() !== '');
                        const headers = rows[0].split(';').map(h => h.trim().toLowerCase());
                        jsonData = rows.slice(1).map(row => {
                            const values = row.split(';');
                            return headers.reduce((obj, header, index) => {
                                obj[header] = values[index]?.trim() || '';
                                return obj;
                            }, {});
                        });
                    } else {
                        const data = new Uint8Array(e.target.result);
                        const workbook = XLSX.read(data, {
                            type: 'array'
                        });
                        const sheet = workbook.Sheets[workbook.SheetNames[0]];
                        jsonData = XLSX.utils.sheet_to_json(sheet, {
                            header: 1
                        });
                        const headers = jsonData[0].map(h => h.trim().toLowerCase());
                        jsonData = jsonData.slice(1).map(row => {
                            return headers.reduce((obj, header, index) => {
                                obj[header] = row[index] || '';
                                return obj;
                            }, {});
                        });
                    }

                    jsonData.forEach(row => {
                        const valor = parseFloat(
                            (row.valor || '0').replace(/\./g, '').replace(',', '.')
                        ).toFixed(2).replace('.', ',');
                        tabelaItens.row.add([
                            tabelaItens.rows().count() + 1,
                            `<input type="text" value="${row.item || ''}" class="form-control" required>`,
                            `<input type="text" value="${row.unidade || 'UN'}" class="form-control" required>`,
                            `<input type="number" value="${row.quantidade || 1}" class="form-control qtd-inteiro" required>`,
                            `<input type="text" value="${valor}" class="form-control money-mask" required>`,
                            `<input type="text" value="${row.descrição || row.descricao || ''}" class="form-control">`,
                            `<input type="text" value="${row.observação || row.observacao || ''}" class="form-control">`,
                            '<button class="btn btn-danger btn-sm remover-linha"><i class="fas fa-trash"></i></button>'
                        ]).draw();
                    });

                    applyMasks();
                    calcularTotal();
                } catch (error) {
                    console.error('Erro na importação:', error);
                    alert('Erro ao importar arquivo. Verifique o formato e tente novamente.');
                }
            };

            if (file.name.endsWith('.csv')) {
                reader.readAsText(file, 'ISO-8859-1');
            } else {
                reader.readAsArrayBuffer(file);
            }
        }

        // Eventos de drag and drop
        const dropArea = document.querySelector('.drag-drop-area');
        const fileInput = document.getElementById('file-input');
        dropArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropArea.classList.add('dragover');
        });
        dropArea.addEventListener('drop', (e) => {
            e.preventDefault();
            dropArea.classList.remove('dragover');
            if (e.dataTransfer.files.length > 0) {
                handleFile(e.dataTransfer.files[0]);
            }
        });
        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                handleFile(e.target.files[0]);
            }
        });

        // Cálculo do Total Geral
        function calcularTotal() {
            let total = 0;
            tabelaItens.rows().every(function() {
                const rowNode = this.node();
                const qtd = parseInt($(rowNode).find('.qtd-inteiro').val()) || 0;
                const valor = parseFloat(
                    $(rowNode).find('.money-mask').val()
                    .replace(/\./g, '')
                    .replace(',', '.')
                ) || 0;
                if (!isNaN(qtd) && !isNaN(valor)) {
                    total += qtd * valor;
                }
            });
            $('#total-geral').text(
                total.toLocaleString('pt-BR', {
                    style: 'currency',
                    currency: 'BRL',
                    minimumFractionDigits: 2
                })
            );
        }

        // Eventos
        $('#tabela-itens').on('input', '.qtd-inteiro, .money-mask', calcularTotal);
        $('#tabela-itens').on('click', '.remover-linha', function() {
            tabelaItens.row($(this).parents('tr')).remove().draw();
            calcularTotal();
        });

        // Inicialização
        applyMasks();
    });
</script>