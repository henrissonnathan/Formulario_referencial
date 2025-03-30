<?php
// Arquivo: enviar-email.php

// Configurações
$para = 'seu-email@exemplo.com'; // ALTERE PARA SEU EMAIL
$assunto = 'Termo de Referência - ' . date('d/m/Y H:i');

// Gerar conteúdo CSV
$csvContent = "DADOS PRINCIPAIS\n";

// Processar dados do formulário
foreach($_POST as $key => $value) {
    if($key !== 'tableData') {
        $csvContent .= strtoupper($key) . ";" . htmlspecialchars($value) . "\n";
    }
}

// Processar dados da tabela
$csvContent .= "\nITENS\n";
$csvContent .= "Item;Unidade;Quantidade;Valor Unitário;Descrição;Observação\n";

if(isset($_POST['tableData'])) {
    $tableData = json_decode($_POST['tableData'], true);
    
    foreach($tableData as $item) {
        $csvContent .= implode(';', [
            $item['item'],
            $item['unidade'],
            $item['quantidade'],
            str_replace(['.', ','], ['', '.'], $item['valor_unitario']),
            $item['descricao'],
            $item['obs']
        ]) . "\n";
    }
}

// Criar boundary único
$boundary = md5(time());

// Headers básicos
$headers = "From: sistema@seusite.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: multipart/mixed; boundary=\"" . $boundary . "\"\r\n";

// Corpo da mensagem
$body = "--$boundary\r\n";
$body .= "Content-Type: text/plain; charset=\"utf-8\"\r\n";
$body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
$body .= "Segue em anexo o Termo de Referência gerado.\r\n\r\n";

// Anexar arquivo CSV
$body .= "--$boundary\r\n";
$body .= "Content-Type: text/csv; name=\"termo-referencia.csv\"\r\n";
$body .= "Content-Disposition: attachment; filename=\"termo-referencia.csv\"\r\n";
$body .= "Content-Transfer-Encoding: base64\r\n\r\n";
$body .= chunk_split(base64_encode($csvContent)) . "\r\n";
$body .= "--$boundary--";

// Enviar email
if(mail($para, $assunto, $body, $headers)) {
    echo "Email enviado com sucesso para $para!";
} else {
    http_response_code(500);
    echo "Falha ao enviar email. Verifique:";
    echo "<ul>";
    echo "<li>Configuração do servidor SMTP</li>";
    echo "<li>Se o email não caiu na pasta de spam</li>";
    echo "<li>Logs do servidor</li>";
    echo "</ul>";
}