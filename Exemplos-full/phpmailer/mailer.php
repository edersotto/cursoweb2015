<?php
    // importa o arquivo do phpmailer
    require_once("class.phpmailer.php");
    
    function smtpmailer($destino, $nome_remetente, $assunto, $mensagem ) {
        global $erro;
        $mail = new PHPMailer();
        $mail->IsSMTP(); // ativa smtp
        $mail->SMTPAuth = true; // ativa autent SMTP
        $mail->SMTPSecure = "ssl"; // ssl ou tls define autenticação como ssl
        $mail->Host = "smtp.gmail.com"; // nome do servidor smtp        
        $mail->Port = 465; // porta do smtp
        $mail->Username = "email@gmail.com"; // usuário de acesso smtp
        $mail->Password = "senha"; // senha
        $mail->IsHTML(true); // define que mensagens serão html
        $mail->SetFrom($mail->Username, $nome_remetente); // define remetente
        $mail->Subject = $assunto; //define assunto
        $mail->Body = $mensagem; // define mensagem
        $mail->AddAddress($destino); // define destinatario
        if ($mail->Send()) {
            return true;
        }
        else{
            $erro = $mail->ErrorInfo;
            return false;
        }
    }
    