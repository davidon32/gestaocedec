<?php
require("plugins/PHPMailer/class.phpmailer.php");
require("plugins/PHPMailer/class.smtp.php");
/**
 *  Envio de email
 */
class EnviaEmail {

    /**
     * Envio de email individual 
     * @param destinatario
     * @param assunto
     * @param mensagem
     **/
    function emailIndividual($destinatario, $assunto, $mensagem, $headers = null, $remetente = null) {

    // Inicia a classe PHPMailer
    $mail = new PHPMailer();
    
    // Define os dados do servidor e tipo de conexão
    // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->IsSMTP(); // Define que a mensagem será SMTP
    $mail->Host = "localhost"; // Endereço do servidor SMTP
    //$mail->SMTPAuth = true; // Usa autenticação SMTP? (opcional)
    //$mail->Username = 'seumail@dominio.net'; // Usuário do servidor SMTP
    //$mail->Password = 'senha'; // Senha do servidor SMTP
    
    // Define o remetente
    // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->From = "defesacivil@defesacivil.mg.gov.br"; // Seu e-mail
    $mail->FromName = "SGECEDEC - Sistema de Gestão Estratégica da CEDEC"; // Seu nome
    
        foreach ($destinatario as $value) {
                
            $mail->AddAddress($value);
        }
    
    
    
    //$mail->AddCC('ciclano@site.net', 'Ciclano'); // Copia
    //$mail->AddBCC('fulano@dominio.com.br', 'Fulano da Silva'); // Cópia Oculta
    
    // Define os dados técnicos da Mensagem
    // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->IsHTML(false); // Define que o e-mail será enviado como HTML
    //$mail->CharSet = 'iso-8859-1'; // Charset da mensagem (opcional)
    
    // Define a mensagem (Texto e Assunto)
    // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    $mail->Subject  = $assunto; // Assunto da mensagem
    $mail->Body = $mensagem;
    
    
    //$mail->AltBody = "Este é o corpo da mensagem de teste, em Texto Plano! \r\n :)";
    
    // Define os anexos (opcional)
    // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
    //$mail->AddAttachment("c:/temp/documento.pdf", "novo_nome.pdf");  // Insere um anexo
    
    // Envia o e-mail
    $enviado = $mail->Send();
    
    // Limpa os destinatários e os anexos
    $mail->ClearAllRecipients();
    $mail->ClearAttachments();
    
        // Exibe uma mensagem de resultado
        if ($enviado) {
                
            echo "E-mail enviado com sucesso!";
            
        } else {
                
            echo "Não foi possível enviar o e-mail.<br /><br />";
            echo "<b>Informações do erro:</b> <br />" . $mail->ErrorInfo;
            
        }
    }
}
// $_email = new Email();
// $_enviado = $_email -> EmailMassa("teste");
//var_dump($_enviado);
?>