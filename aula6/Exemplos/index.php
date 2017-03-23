<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximun-scale=1, user-scalable=no">
        <title>Bootstrap 101 Template</title>

        <!-- Bootstrap -->
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/estilo.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>





        <div class="banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-sm-4 col-xs-12">
                        <div class="glyphicon glyphicon-camera icone-banner"></div>
                    </div>
                    <div class="col-md-10 col-sm-8 col-xs-12">
                        <h1>Twitter Bootstrap</h1>
                        <p>A Responsive Framework CSS3 and HTML5</p>
                    </div>    
                </div>    
            </div>    
        </div>

        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#" id="link_home">Home <span class="sr-only">(current)</span></a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Categorias <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu" id="dropcategorias">
                                
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Exemplos <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a data-url="exemplos_import/3-container.html" href="#">3-container</a></li>
                                <li><a data-url="exemplos_import/4-grid.html" href="#">4-grid</a></li>
                                <li><a data-url="exemplos_import/5-grid-layout.html" href="#">5-grid-layout</a></li>
                                <li><a data-url="exemplos_import/6-componentes.html" href="#">6-componentes</a></li>
                                <li><a data-url="exemplos_import/7-navbar-grid-texto.html" href="#">7-navbar-grid-texto</a></li>
                                <li><a data-url="exemplos_import/8-navbar-vertical.html" href="#">8-navbar-vertical</a></li>
                                <li><a data-url="exemplos_import/9-grid-layout-navbar.html" href="#">9-grid-layout-navbar</a></li>
                                
                            </ul>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#" data-url="ajax/link_sobre.php">Sobre a Empresa</a></li>
                        <li><a href="#" data-url="ajax/link_fale.php">Fale Conosco</a></li>
                     
                        <li class="dropdown" id="menu_administrador">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Administrador <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#" data-url="ajax/link_usuarios.php">Gerenciar Usuários</a></li>
                                <li><a href="#" data-url="ajax/link_categorias.php">Gerenciar Categorias</a></li>
                                <li><a href="#" data-url="ajax/link_produtos.php">Gerenciar Produtos</a></li>
                                <li><a href="#" id="logout">Efetuar Logout</a></li>
                            </ul>
                        </li>


                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

        <div id="box_alertas" class="col-md-8 col-md-offset-2 text-center"></div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12" id="conteudo">
                    <!-- Div do conteúdo principal -->

                    <!-- fim da Div do conteúdo principal -->
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 well text-center text-muted">
                    <!-- Div do rodapé -->
                    Copyright &copy; 2015. All Rights Reserved. 
                    <a href="#" data-toggle="modal" data-target="#modalAdmin" class="visible-xs-inline visible-sm-inline"><span class="glyphicon glyphicon-lock"></span></a>
                </div>
            </div>
        </div>    

        <div id="modalAdmin" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" on>&times;</button>
                        <h4 class="modal-title" id="titForm">
                            <span class="glyphicon glyphicon-lock"></span>
                            Faça seu Login de Administrador
                        </h4>
                    </div>
                    <div class="modal-body">
                        <div id="box_alertas_login" class="text-center"></div>
                        <form class="form-horizontal" id="formlogin" onsubmit="return false;">

                            <div class="form-group">
                                <label class="control-label col-md-4" for="user">Usuário:</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="user" name="user" placeholder="Usuário" required autofocus/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4" for="pass">Senha:</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" id="pass" name="pass" placeholder="Senha" required/>
                                </div>
                            </div>



                            <div class="form-group">
                                <div class="col-md-2 col-md-offset-6">

                                    <button type="button" value="Submit" id="btnLogin" class="btn btn-primary btn-lg pull-right">ENTRAR</button>

                                </div>
                            </div>
                        </form>
                    </div><!-- End of Modal body -->
                </div><!-- End of Modal content -->
            </div><!-- End of Modal dialog -->
        </div><!-- End of Modal -->


        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="js/jquery-2.1.3.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.js"></script>
        <!-- importa o holder das imagens -->
        <script src="holder/holder.js"></script>
        <!-- importa o arquivo funcoes do JQuery -->
        <script src="js/funcoes.js"></script>
        <!-- importa arquivo alerta -->
        <script src="js/alerta.js"></script>
        <!-- hotkeys -->
        <script src="js/jquery.hotkeys.js"></script>
        <!-- funções administrador -->
        <script src="js/funcoes_admin.js"></script>
        <!-- bootbox -->
        <script src="js/bootbox.min.js"></script>
    </body>
</html>