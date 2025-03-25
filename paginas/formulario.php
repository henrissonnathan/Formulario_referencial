
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
            <label for="pca">Digite o nome da pca:</label>
            <select  name="pca" id="pca"  class="form-control  borda "  required data-parsley-required-message="Por favor, preencha a previsão da PCA">
                <option value="">Selecione uma opção</option>
                <?php foreach ($selectOptions['pca'] as $value => $label): ?>
                    <option value="<?=$value ?>"><?=$label?></option>
                <?php endforeach; ?>
            </select>
            <div id="resposta-container" style="display: none; margin-top: 10px;">
    <label for="resposta">Detalhe sua resposta:</label>
    <input type="text" name="resposta" id="resposta" class="form-control borda" 
           placeholder="Explique...">
</div>
            <br>
            <!-- orçamento(valor) -->
            <label for="orcamento">oreçamento do projeto:</label>
            <input type="text" name="orcamento" id="orcamento" class="form-control borda money-mask" value="0,00" placeholder="coloque um valor" required data-parsley-required-message="Por favor, preencha a Dotação orçamentária">
                <!-- Natureza da contratação-->
                <label for="contrato">Digite o nome da contrato:</label>
            <select  name="contrato" id="contrato"  class="form-control  borda "  required data-parsley-required-message="Por favor, prencha a natureza do contrato">
                <option value="">Selecione uma opção</option>
                <?php foreach ($selectOptions['contrato'] as $value => $label): ?>
                    <option value="<?=$value ?>"><?=$label?></option>
                <?php endforeach; ?>
            </select>
            
<br>
<h5 calss="mt-4">Itens</h5>
                <!-- tabela-->
<table id="tabela-itens" class="table table-bordered">
<thead class="table-dark">
    <tr>
        <th>ID</th>
        <th>Item</th>
        <th>Unid.</th>
        <th>Qtd.</th>
        <th>Valor Unit</th>
        <th>Descrição</th>
        <th>Obs.</th>
        <th>Açoes</th>
        
    </tr>
</thead>
<tbody>
    <!--Linha inicial -->
<tr>
    <td>1</td>
    <td><input type="text" name="item[]" class="form-control" required></td>
                    <td><input type="text" name="unid[]" class="form-control" value="UN"></td>
                    <td><input type="number" name="qtd[]" class="form-control qtd-inteiro" min="1" value="1" required></td>
                    <td><input type="text" name="valor_unitario[]" class="form-control money-mask" required></td>
                    <td><input type="text" name="descricao[]" class="form-control"></td>
                    <td><input type="text" name="obs[]" class="form-control"></td> 
                </tr>
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
<div class="card mt-3">
    <div class="card-body">
        <h5>Total Geral</h5>
        <input type="text" id="total-geral" calss="form-control bg-light" value="0,00">
    </div>
</div>





<label for="pca">Digite o nome da ISSN:</label>
            <input type="text" name="ISSN" id="ISSN" maxlength="9"  class="form-control  borda " placeholder="Selecione uma opisão" required data-parsley-required-message="Por favor, preencha a previsão no PCA">
            <br>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-check"></i> Salvar Dados
            </button>
    </div>
    </form>
</div>
</div>
<script>
 document.getElementById('orcamento').addEventListener('input', function(e) {
    // Remove tudo exceto dígitos
    let digitos = this.value.replace(/\D/g, '');
    
    // Garante no mínimo 3 dígitos (para centavos)
    digitos = digitos.padStart(3, '0');
    
    // Separa parte inteira e centavos
    const parteInteira = digitos.slice(0, -2).replace(/^0+/, ''); // Remove zeros à esquerda
    const centavos = digitos.slice(-2);
    
    // Formata (evita "0" extra: "001.25" → "1.25")
    this.value = `${parteInteira || '0'}.${centavos}`; // Se parteInteira for vazia, usa '0'
    
    // Posiciona o cursor no final
    this.setSelectionRange(this.value.length, this.value.length);
});
document.getElementById('pca').addEventListener('change', function() {
    const respostaContainer = document.getElementById('resposta-container');
    
    // Mostra o campo apenas se selecionar "Sim"
    if (this.value === 'sim') {
        respostaContainer.style.display = 'block';
    } else {
        respostaContainer.style.display = 'none';
        document.getElementById('resposta').value = ''; // Limpa o campo
    }
});
$(document).ready(function() {
    let contadorLinhas = 1;
    
    // Máscaras iniciais
    $('.money-mask').mask('000.000.000.000.000,00', {reverse: true});
    
    // Adicionar nova linha
    $('#adicionar-linha').click(function() {
        contadorLinhas++;
        const novaLinha = `
<tr>
    <td>${contadorLinhas}</td>
    <td><input type="text" name="item[]" class="form-control" required></td>
    <td><input type="text" name="unid[]" class="form-control" value="UN"></td>5
    <td><input type="number" name="qtd[]" class="form-control qtd-inteiro" min="1" value="1" required></td>
    <td><input type="text" name="valor_unitario[]" class="form-control money-mask" required></td>
    <td><input type="text" name="descricao[]" class="form-control"></td>
    <td><input type="text" name="obs[]" class="form-control"></td>
    <td><button type="button" class="btn btn-danger btn-sm remover-linha"><i class="fas fa-trash"></i></button></td>
</tr>`;
        $('#tabela-itens tbody').append(novaLinha);
        
        // Aplica máscaras aos novos campos
        $('.money-mask').mask('000.000.000.000.000,00', {reverse: true});
        
    });

    // Remover última linha (botão abaixo da tabela)
    $('#remover-linha').click(function() {
        if ($('#tabela-itens tbody tr').length > 1) {
            $('#tabela-itens tbody tr:last').remove();
            contadorLinhas--;
        } else {
            alert('Pelo menos um item deve ser mantido!');
        }
    });

    // Remover linha específica (botão na linha)
    $(document).on('click', '.remover-linha', function() {
        if ($('#tabela-itens tbody tr').length > 1) {
            $(this).closest('tr').remove();
            // Atualiza IDs
            $('#tabela-itens tbody tr').each(function(index) {
                $(this).find('td:first').text(index + 1);
            });
            contadorLinhas = $('#tabela-itens tbody tr').length;
        }
    });

    // Máscara para quantidade (igual ao orçamento)
    $(document).on('input', '.qtd-mask', function(e) {
        let digitos = this.value.replace(/\D/g, '');
        digitos = digitos.padStart(3, '0');
        const parteInteira = digitos.slice(0, -2).replace(/^0+/, '');
        const centavos = digitos.slice(-2);
        this.value = `${parteInteira || '0'}.${centavos}`;
        $(this).focus().val(this.value);
    });
});
// Validação para aceitar apenas inteiros
$(document).on('input', '.qtd-inteiro', function() {
    this.value = this.value.replace(/[^0-9]/g, '');
    if (this.value < 1) this.value = 1;
});
// Função para calcular o total geral
function calcularTotal() {
    let total = 0;
    
    $('#tabela-itens tbody tr').each(function() {
        const qtd = parseInt($(this).find('.qtd-inteiro').val()) || 0;
        const valorUnit = parseFloat(
            $(this).find('.money-mask').val().replace(/\./g, '').replace(',', '.')
        ) || 0;
        
        total += qtd * valorUnit;
    });
    
    // Formata para exibição (2 decimais, separador decimal)
    $('#total-geral').val(total.toLocaleString('pt-BR', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }));
}

// Atualiza o total quando:
// 1. Qualquer campo de quantidade ou valor é alterado
$(document).on('input', '.qtd-inteiro, .money-mask', function() {
    calcularTotal();
});

// 2. Quando uma linha é adicionada/removida
$(document).on('click', '#adicionar-linha, .remover-linha', function() {
    setTimeout(calcularTotal, 100); // Pequeno delay para garantir atualização
});

// Calcula o total inicial ao carregar a página
$(document).ready(function() {
    calcularTotal();
});
</script>
