<?php
// salvar/enviar-email.php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

// Configurações SMTP (exemplo para Gmail)
$smtp_host = 'smtp.gmail.com';
$smtp_usuario = 'codigotexte@gmail.com';
$smtp_senha = 'wnxu gpkc kvxn lukt'; // Use senha de aplicativo
$smtp_porta = 587;
$smtp_remetente = 'codigotexte@gmail.com';
$nome_remetente = 'Sistema de Termos';

date_default_timezone_set('America/Sao_Paulo');

// Dados do formulário
$para = 'hrnrisson@gmail.com';
$assunto = 'Termo de Referência - ' . date('d/m/Y H:i');

// Gerar conteúdo CSV
$csvContent = "DADOS PRINCIPAIS\n";
$camposReservados = ['item', 'unid', 'qtd', 'valor_unitario', 'descricao', 'obs'];
// Processar dados do formulário
foreach ($_POST as $key => $value) {
    if ($key === 'tableData' || in_array(strtolower($key), $camposReservados)) {
        continue;
    }
    
    if (is_array($value)) {
        $value = implode(', ', $value);
    }
    
    $csvContent .= strtoupper($key) . ";" . htmlspecialchars($value) . "\n";
}

// Processar dados da tabela
$csvContent .= "\nITENS\n";
$csvContent .= "Item;Unidade;Quantidade;Valor Unitário;Descrição;Observação\n";

if (isset($_POST['tableData'])) {
    $tableData = json_decode($_POST['tableData'], true);
    
    foreach ($tableData as $item) {
        // Converter valor unitário para formato numérico seguro
        $valorUnitario = str_replace(['.', ','], ['', '.'], $item['valor_unitario'] ?? '0.00');
    
        $csvContent .= implode(';', [
            $item['item'] ?? '',
            $item['unid'] ?? 'UN',
            $item['quantidade'] ?? 0,
            $valorUnitario,
            $item['descricao'] ?? '',
            $item['obs'] ?? ''
        ]) . "\n";
    }
}

try {
    $mail = new PHPMailer(true);
    
    // Configuração SMTP
    $mail->isSMTP();
    $mail->Host = $smtp_host;
    $mail->SMTPAuth = true;
    $mail->Username = $smtp_usuario;
    $mail->Password = $smtp_senha;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = $smtp_porta;
    $mail->CharSet = 'UTF-8';

    // Remetente/Destinatário
    $mail->setFrom($smtp_remetente, $nome_remetente);
    $mail->addAddress($para);

    // Anexar CSV
    $mail->addStringAttachment($csvContent, 'termo-referencia.csv', 'base64', 'text/csv');

    // Conteúdo do email
    $mail->isHTML(false);
    $mail->Subject = $assunto;
    $mail->Body = "Segue em anexo o Termo de Referência gerado.\n\n";

    $mail->send();
    echo "Email enviado com sucesso para $para!";
    
} catch (Exception $e) {
    http_response_code(500);
    echo "Erro ao enviar email: {$mail->ErrorInfo}\n";
    echo "Verifique:\n";
    echo "- Configurações SMTP\n";
    echo "- Senha de aplicativo (se usar Gmail)\n";
    echo "- Firewall/antivírus";
}