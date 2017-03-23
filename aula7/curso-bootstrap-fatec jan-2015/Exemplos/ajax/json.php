<?php
session_start();
// recupera parametro fn
$fn = filter_input(INPUT_POST, 'fn');

// verifica se fn é do fale conosco
if ($fn == "fale") {
    // recupera informações do form
    $nome = trim(filter_input(INPUT_POST, 'nome'));
    $email = trim(filter_input(INPUT_POST, 'email'));
    $mensagem = trim(filter_input(INPUT_POST, 'mensagem'));

    require_once("../phpmailer/mailer.php");

    // ENDEREÇO QUE RECEBERÁ AS MENSAGENS DO SITE
    $destino = "eder@sotto.com.br";
    // NOME DO REMETENTE QUE IRÁ JUNTAMENTE AS MENSAGENS
    $nome_remetente = "Site Bootstrap";
    // ASSUNTO DO EMAIL
    $assunto = "Contato - Site";
    // TEXTO DA           MENSAGEM
    $texto = "Olá, você recebeu uma mensagem do Site Bootstrap.<br><br>" .
            "Nome: $nome <br>" .
            "E-Mail: $email <br> " .
            "Mensagem: $mensagem <br> ";
    global $erro;
    // faz o envio do email e verifica se obteve sucesso
    if (smtpmailer($destino, $nome_remetente, $assunto, $texto)) {
        echo (json_encode(array("success" => true,
            "msg" => "Mensagem enviada com sucesso!")));
    }
    // caso não consiga enviar o email
    else {
        echo (json_encode(array("success" => false,
            "msg" => $erro)));
    }
}
if ($fn == "login") {
    $user = filter_input(INPUT_POST, 'user');
    $pass = filter_input(INPUT_POST, 'pass');

    require_once("conexao.php");

    $stmt = $mysqli->query("select nome from usuario where login='" . $user . "' and senha=password('" . $pass . "')");

    if ($stmt->num_rows > 0) {
        $row = $stmt->fetch_row();
        $nome = $row[0];
        $_SESSION['usuario'] = $user;
        $_SESSION['nome'] = $nome;
        echo json_encode(array("success" => true, "msg" => "Login efeuado com sucesso!"));
    } else {
        echo json_encode(array("success" => false, "msg" => "Erro ao efetuar o login!"));
    }
}
if ($fn == "logout") {
    
    session_destroy();
    echo json_encode(array("success" => true, "msg" => "Logout efeuado com sucesso!"));      
}
if ($fn == "verificaLogado") {
  
    if (isset($_SESSION['usuario'])) {
        echo json_encode(array("success" => true, "msg" => "Logado"));      
    }
    else {
        echo json_encode(array("success" => false, "msg" => "Não logado"));      
    }    
}
?>
    

