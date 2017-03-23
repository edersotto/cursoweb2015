<?php

session_start();
// recupera parametro fn
if (isset($_POST['fn'])) {
    $fn = filter_input(INPUT_POST, 'fn');
} elseif (isset($_GET['fn'])) {
    $fn = filter_input(INPUT_GET, 'fn');
}


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
    } else {
        echo json_encode(array("success" => false, "msg" => "Não logado"));
    }
}
if ($fn == "listaUsuarios") {

    if (!isset($_SESSION['usuario'])) {
        die("Acesso não permitido!");
    }
    $sort = filter_input(INPUT_GET, 'sort');
    $order = filter_input(INPUT_GET, 'order');
    $offset = filter_input(INPUT_GET, 'offset');
    $limit = filter_input(INPUT_GET, 'limit');
    $search = filter_input(INPUT_GET, 'search');

    require_once("conexao.php");
    // executa consulta no banco
    $res0 = $mysqli->query(""
            . "select count(*) "
            . "from usuario "
            . "where nome like('%$search%') "
            . " or login like('%$search%') "
            . "");
    // pega a linha do resultado
    $row = $res0->fetch_row();
    // pega o total existente na linha do resultado
    $qtd = $row[0];

    // executa consulta no banco
    $res = $mysqli->query(""
            . "select nome, login, senha "
            . "from usuario "
            . "where nome like('%$search%') "
            . " or login like('%$search%') "
            . "order by $sort $order limit $offset, $limit");
    // criaum array para armazenar o resultado
    $dados = array();
    // percorrer os usuarios encontrados
    while ($obj = $res->fetch_object()) {
        // alimenta o array com o proximo objeto
        $dados[] = $obj;
    }
    // converte os objetos do arraay em json e imprime
    echo ('{"total": ' . $qtd . ', "rows":' . json_encode($dados) . '}');
    //echo(json_encode($dados));
}
if ($fn == "cadUser") {
    if (!isset($_SESSION['usuario'])) {
        die("Acesso não permitido!");
    }
    $user = filter_input(INPUT_POST, 'user');
    $pass = filter_input(INPUT_POST, 'pass');
    $nome = filter_input(INPUT_POST, 'nome');
    require_once("conexao.php");
    $result = $mysqli->query("insert into usuario(login,senha,nome) values('$user',password('$pass'),'$nome') ");
    if ($result) {
        echo json_encode(array("success" => true, "msg" => "Usuário inserido com sucesso"));
    } elseif (strpos($mysqli->error, 'PRIMARY')) {
        echo json_encode(array("success" => false, "msg" => "Erro ao inserir usuário. Já existe um usuário com o login informado."));
    } else {
        echo json_encode(array("success" => false, "msg" => "Erro ao inserir usuário: " . $mysqli->error));
    }
}
if ($fn == "altSenhaUser") {
    if (!isset($_SESSION['usuario'])) {
        die("Acesso não permitido!");
    }
    $user = filter_input(INPUT_POST, 'user');
    $pass = filter_input(INPUT_POST, 'pass');
    require_once("conexao.php");
    $result = $mysqli->query("update usuario set senha=password('$pass') where login='$user'");
    if ($result) {
        echo json_encode(array("success" => true, "msg" => "Senha alterada com sucesso"));
    } else {
        echo json_encode(array("success" => false, "msg" => "Erro ao alterar senha do usuário"));
    }
}
if ($fn == "excluiUser") {
    if (!isset($_SESSION['usuario'])) {
        die("Acesso não permitido!");
    }
    $user = filter_input(INPUT_POST, 'user');
    require_once("conexao.php");
    $result = $mysqli->query("delete from usuario where login='$user'");
    if ($result) {
        echo json_encode(array("success" => true, "msg" => "Usuário excluído com sucesso"));
    } else {
        echo json_encode(array("success" => false, "msg" => "Erro ao excluir o usuário"));
    }
}
if ($fn == "alteraUser") {
    if (!isset($_SESSION['usuario'])) {
        die("Acesso não permitido!");
    }
    $user = filter_input(INPUT_POST, 'user');
    $nome = filter_input(INPUT_POST, 'nome');
    require_once("conexao.php");
    $result = $mysqli->query("update usuario set nome='$nome' where login='$user'");
    if ($result) {
        echo json_encode(array("success" => true, "msg" => "Usuário alterado com sucesso"));
    } else {
        echo json_encode(array("success" => false, "msg" => "Erro ao alterar usuário"));
    }
}
if ($fn == "listaCategorias") {
    if (!isset($_SESSION['usuario'])) {
        die("Acesso não permitido!");
    }
    $sort = filter_input(INPUT_GET, 'sort');
    $order = filter_input(INPUT_GET, 'order');
    $offset = filter_input(INPUT_GET, 'offset');
    $limit = filter_input(INPUT_GET, 'limit');
    $search = filter_input(INPUT_GET, 'search');

    require_once("conexao.php");
    // executa consulta no banco
    $res0 = $mysqli->query(""
            . "select count(*) "
            . "from categoria "
            . "where nome like('%$search%') "
            . "");
    // pega a linha do resultado
    $row = $res0->fetch_row();
    // pega o total existente na linha do resultado
    $qtd = $row[0];

    // executa consulta no banco
    $res = $mysqli->query(""
            . "select id, nome "
            . "from categoria "
            . "where nome like('%$search%') "
            . "order by $sort $order limit $offset, $limit");
    // criaum array para armazenar o resultado
    $dados = array();
    // percorrer os usuarios encontrados
    while ($obj = $res->fetch_object()) {
        // alimenta o array com o proximo objeto
        $dados[] = $obj;
    }
    // converte os objetos do arraay em json e imprime
    echo ('{"total": ' . $qtd . ', "rows":' . json_encode($dados) . '}');
    //echo(json_encode($dados));
}



if ($fn == "cadCat") {
    if (!isset($_SESSION['usuario'])) {
        die("Acesso não permitido!");
    }
    $nome = filter_input(INPUT_POST, 'nome');
    require_once("conexao.php");
    $result = $mysqli->query("insert into categoria(nome) values('$nome') ");
    if ($result) {
        echo json_encode(array("success" => true, "msg" => "Categoria inserida com sucesso"));
    } else {
        echo json_encode(array("success" => false, "msg" => "Erro ao inserir categoria: " . $mysqli->error));
    }
}
if ($fn == "excluiCat") {
    if (!isset($_SESSION['usuario'])) {
        die("Acesso não permitido!");
    }
    $id = filter_input(INPUT_POST, 'id');
    require_once("conexao.php");
    $result = $mysqli->query("delete from categoria where id='$id'");
    if ($result) {
        echo json_encode(array("success" => true, "msg" => "Categoria excluída com sucesso"));
    }
    else {
        echo json_encode(array("success" => false, "msg" => "Erro ao excluir categoria. Verifique se possui produto vinculado."));
    }
}
if ($fn == "alteraCat") {
    if (!isset($_SESSION['usuario'])) {
        die("Acesso não permitido!");
    }
    $id = filter_input(INPUT_POST, 'id');
    $nome = filter_input(INPUT_POST, 'nome');
    require_once("conexao.php");
    $result = $mysqli->query("update categoria set nome='$nome' where id='$id'");
    if ($result) {
        echo json_encode(array("success" => true, "msg" => "Categoria alterada com sucesso"));
    } else {
        echo json_encode(array("success" => false, "msg" => "Erro ao alterar categoria"));
    }
}
if ($fn == "categoriasSelect") {
    if (!isset($_SESSION['usuario'])) {
        die("Acesso não permitido!");
    }
    
    require_once("conexao.php");
    // executa consulta no banco
    
    $res = $mysqli->query(""
            . "select id value, nome text "
            . "from categoria "   );
    // criaum array para armazenar o resultado
    $dados = array();
    // percorrer os usuarios encontrados
    
    $obj = new stdClass();
    $obj->value="";
    $obj->text="Selecione";
    $dados[] = $obj;
    
    while ($obj = $res->fetch_object()) {
        // alimenta o array com o proximo objeto
        $dados[] = $obj;
    }
    // converte os objetos do arraay em json e imprime
    
    echo(json_encode($dados));    
}
if ($fn == "cadProd") {
    if (!isset($_SESSION['usuario'])) {
        die("Acesso não permitido!");
    }
    $id = filter_input(INPUT_POST, 'idprod');
    $nome = filter_input(INPUT_POST, 'nomeprod');
    $valor = filter_input(INPUT_POST, 'valorprod');
    $descricao = filter_input(INPUT_POST, 'descprod');
    $texto = filter_input(INPUT_POST, 'textoprod');
    $categoria = filter_input(INPUT_POST, 'catprod');
    $imagem = isset($_FILES["imgprod"]) ? $_FILES["imgprod"] : FALSE;
    $data='null';
    if (file_exists($imagem["tmp_name"])) {
        $tmpName = $_FILES['imgprod']['tmp_name'];
        $fp = fopen($tmpName, 'r');
        $data = fread($fp, filesize($tmpName));
        $data = addslashes($data);
        $data = "'".$data."'";
        fclose($fp);
    }
    require_once("conexao.php");
    $result = $mysqli->query("insert into produto(nome, valor, descricao, texto, imagem, id_categoria)
         values('$nome','$valor','$descricao','$texto',$data,'$categoria') ");
    if ($result) {
        echo json_encode(array("success" => true, "msg" => "Produto inserido com sucesso"));
    } else {
        echo json_encode(array("success" => false, "msg" => "Erro ao inserir produto: " . $mysqli->error));
    }    
}

if ($fn == "listaProdutos") {
    if (!isset($_SESSION['usuario'])) {
        die("Acesso não permitido!");
    }
    $sort = filter_input(INPUT_GET, 'sort');
    $order = filter_input(INPUT_GET, 'order');
    $offset = filter_input(INPUT_GET, 'offset');
    $limit = filter_input(INPUT_GET, 'limit');
    $search = filter_input(INPUT_GET, 'search');

    require_once("conexao.php");
    // executa consulta no banco
    $res0 = $mysqli->query(""
            . "select count(*) "
            . "from produto "
            . "where nome like('%$search%') "
            . "");
    // pega a linha do resultado
    $row = $res0->fetch_row();
    // pega o total existente na linha do resultado
    $qtd = $row[0];

    // executa consulta no banco
    $res = $mysqli->query(""
            . "select p.id, p.nome, p.valor, p.descricao, c.nome categoria, p.imagem, p.id_categoria, p.valor val, p.texto  "
            . "from produto p "
            . "inner join categoria c "
            . "on c.id=p.id_categoria "
            . "where p.nome like('%$search%') "
            . "order by $sort $order limit $offset, $limit");
    // criaum array para armazenar o resultado
    $dados = array();
    // percorrer os usuarios encontrados
    while ($obj = $res->fetch_object()) {
        // alimenta o array com o proximo objeto
        $obj->valor = "R$ ".number_format($obj->valor, 2, ",", ".");
        $obj->imagem = base64_encode($obj->imagem);
        $dados[] = $obj;
    }
    // converte os objetos do arraay em json e imprime
    echo ('{"total": ' . $qtd . ', "rows":' . json_encode($dados) . '}');
    //echo(json_encode($dados));
}

if ($fn == "excluiProd") {
    if (!isset($_SESSION['usuario'])) {
        die("Acesso não permitido!");
    }
    $id = filter_input(INPUT_POST, 'id');
    require_once("conexao.php");
    $result = $mysqli->query("delete from produto where id='$id'");
    if ($result) {
        echo json_encode(array("success" => true, "msg" => "Produto excluído com sucesso"));
    }
    else {
        echo json_encode(array("success" => false, "msg" => "Erro ao excluir produto."));
    }
}

if ($fn == "alteraProd") {
    if (!isset($_SESSION['usuario'])) {
        die("Acesso não permitido!");
    }
    $id = filter_input(INPUT_POST, 'idprod');
    $nome = filter_input(INPUT_POST, 'nomeprod');
    $valor = filter_input(INPUT_POST, 'valorprod');
    $descricao = filter_input(INPUT_POST, 'descprod');
    $texto = filter_input(INPUT_POST, 'textoprod');
    $categoria = filter_input(INPUT_POST, 'catprod');
    $imagem = isset($_FILES["imgprod"]) ? $_FILES["imgprod"] : FALSE;
    
    $wimg="";
    if (file_exists($imagem["tmp_name"])) {
        $tmpName = $_FILES['imgprod']['tmp_name'];
        $fp = fopen($tmpName, 'r');
        $data = fread($fp, filesize($tmpName));
        $data = addslashes($data);
        $data = "'".$data."'";
        fclose($fp);
        $wimg=",imagem=$data ";
    }
    require_once("conexao.php");
    $result = $mysqli->query("update produto set nome='$nome', valor='$valor', descricao='$descricao', texto='$texto', id_categoria='$categoria' $wimg where id='$id'");
    if ($result) {
        echo json_encode(array("success" => true, "msg" => "Produto alterado com sucesso"));
    } else {
        echo json_encode(array("success" => false, "msg" => "Erro ao alterar produto"));
    }
}

if ($fn == "categoriasDrop") {
    if (!isset($_SESSION['usuario'])) {
        die("Acesso não permitido!");
    }
    
    require_once("conexao.php");
    // executa consulta no banco
    $res = $mysqli->query(""
            . "select id, nome "
            . "from categoria c "
            . "where exists (select p.id from produto p where p.id_categoria=c.id)");
    // criaum array para armazenar o resultado
    $dados = array();
    // percorrer os usuarios encontrados
    while ($obj = $res->fetch_object()) {
        // alimenta o array com o proximo objeto
        $dados[] = $obj;
    }
    // converte os objetos do arraay em json e imprime
    echo(json_encode($dados));
}

if ($fn == "produtos") {
    if (!isset($_SESSION['usuario'])) {
        die("Acesso não permitido!");
    }
    require_once("conexao.php");
    $idcategoria = filter_input(INPUT_POST, 'idcategoria');
    
    // se estiver na tela principal
    if($idcategoria=="") {
        $limit=" limit 16 ";
        $where="";
    }
    // se estiver filtrando por categoria
    else {
        $limit="";
        $where=" where c.id=$idcategoria";
    }
    
    // executa consulta no banco
    $res = $mysqli->query(""
            . "select p.id, p.nome, p.valor, p.descricao, c.nome categoria, p.imagem, p.id_categoria, p.valor val, p.texto  "
            . "from produto p "
            . "inner join categoria c "
            . "on c.id=p.id_categoria "
            . " $where "
            . "order by rand() $limit");
    // criaum array para armazenar o resultado
    $dados = array();
    // percorrer os usuarios encontrados
    while ($obj = $res->fetch_object()) {
        // alimenta o array com o proximo objeto
        $obj->valor = "R$ ".number_format($obj->valor, 2, ",", ".");
        $obj->imagem = base64_encode($obj->imagem);
        $dados[] = $obj;
    }
    // converte os objetos do arraay em json e imprime

    echo(json_encode($dados));
}

?>
    

