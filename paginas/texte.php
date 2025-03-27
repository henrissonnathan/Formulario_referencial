<!-- filepath: c:\xampp\htdocs\Formulario_referencial\paginas\gerar_arquivo.php -->
<?php
$pagina = "gerar_arquivo";
require "../header.php"; // Inclui o header
?>

<div class="container mt-4">
    <h2>Gerar Arquivo CSV/XLS/XLSX</h2>
    <form id="form-gerar-arquivo">
        <div class="mb-3">
            <label for="num-linhas" class="form-label">Número de Linhas</label>
            <input type="number" id="num-linhas" class="form-control" min="1" value="10" required>
        </div>
        <div id="campos-container">
            <h4>Configuração dos Campos</h4>
            <div class="campo-item mb-3">
                <label>Nome do Campo</label>
                <input type="text" class="form-control campo-nome" placeholder="Ex: Nome" required>
                <label>Tipo</label>
                <select class="form-control campo-tipo">
                    <option value="text">Texto</option>
                    <option value="number">Número</option>
                    <option value="real">Real</option>
                </select>
                <label>Mínimo de Caracteres</label>
                <input type="number" class="form-control campo-min" min="1" value="1" required>
                <label>Máximo de Caracteres</label>
                <input type="number" class="form-control campo-max" min="1" value="10" required>
                <button type="button" class="btn btn-danger btn-sm remover-campo mt-2">Remover Campo</button>
            </div>
        </div>
        <button type="button" id="adicionar-campo" class="btn btn-primary mb-3">Adicionar Campo</button>
        <div class="mb-3">
            <label for="formato" class="form-label">Formato do Arquivo</label>
            <select id="formato" class="form-control">
                <option value="csv">CSV</option>
                <option value="xls">XLS</option>
                <option value="xlsx">XLSX</option>
            </select>
        </div>
        <button type="button" id="gerar-arquivo" class="btn btn-success">Gerar Arquivo</button>
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Adicionar novo campo
        document.getElementById('adicionar-campo').addEventListener('click', function() {
            const container = document.getElementById('campos-container');
            const campoHTML = `
                <div class="campo-item mb-3">
                    <label>Nome do Campo</label>
                    <input type="text" class="form-control campo-nome" placeholder="Ex: Nome" required>
                    <label>Tipo</label>
                    <select class="form-control campo-tipo">
                        <option value="text">Texto</option>
                        <option value="number">Número</option>
                        <option value="real">Real</option>
                    </select>
                    <label>Mínimo de Caracteres</label>
                    <input type="number" class="form-control campo-min" min="1" value="1" required>
                    <label>Máximo de Caracteres</label>
                    <input type="number" class="form-control campo-max" min="1" value="10" required>
                    <button type="button" class="btn btn-danger btn-sm remover-campo mt-2">Remover Campo</button>
                </div>`;
            container.insertAdjacentHTML('beforeend', campoHTML);
        });

        // Remover campo
        document.getElementById('campos-container').addEventListener('click', function(e) {
            if (e.target.classList.contains('remover-campo')) {
                e.target.closest('.campo-item').remove();
            }
        });

        // Gerar arquivo
        document.getElementById('gerar-arquivo').addEventListener('click', function() {
            const numLinhas = parseInt(document.getElementById('num-linhas').value);
            const formato = document.getElementById('formato').value;
            const campos = Array.from(document.querySelectorAll('.campo-item')).map(campo => ({
                nome: campo.querySelector('.campo-nome').value,
                tipo: campo.querySelector('.campo-tipo').value,
                min: parseInt(campo.querySelector('.campo-min').value),
                max: parseInt(campo.querySelector('.campo-max').value)
            }));

            // Gerar dados
            const dados = [];
            for (let i = 0; i < numLinhas; i++) {
                const linha = {};
                campos.forEach(campo => {
                    if (campo.tipo === 'text') {
                        linha[campo.nome] = gerarTexto(campo.min, campo.max);
                    } else if (campo.tipo === 'number') {
                        linha[campo.nome] = gerarNumero(campo.min, campo.max);
                    } else if (campo.tipo === 'real') {
                        linha[campo.nome] = gerarReal(campo.min, campo.max);
                    }
                });
                dados.push(linha);
            }

            // Gerar arquivo
            if (formato === 'csv') {
                gerarCSV(dados);
            } else {
                gerarXLS(dados, formato);
            }
        });

        // Funções auxiliares
        function gerarTexto(min, max) {
            const tamanho = Math.floor(Math.random() * (max - min + 1)) + min;
            const caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            return Array.from({ length: tamanho }, () => caracteres.charAt(Math.floor(Math.random() * caracteres.length))).join('');
        }

        function gerarNumero(min, max) {
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }

        function gerarReal(min, max) {
            return (Math.random() * (max - min) + min).toFixed(2);
        }

        function gerarCSV(dados) {
            const csv = [Object.keys(dados[0]).join(',')].concat(dados.map(row => Object.values(row).join(','))).join('\n');
            const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = 'arquivo.csv';
            link.click();
        }

        function gerarXLS(dados, formato) {
            const ws = XLSX.utils.json_to_sheet(dados);
            const wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, 'Dados');
            XLSX.writeFile(wb, `arquivo.${formato}`);
        }
    });
</script>