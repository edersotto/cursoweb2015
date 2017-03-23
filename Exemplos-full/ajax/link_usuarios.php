<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    die("Acesso não permitido!");
}
?>

<!-- Importa CSS do bootstrap table -->
<link href="bootstrap-table/src/bootstrap-table.css">
<!-- importa javascript do bootstrap-table -->
<script src="bootstrap-table/src/bootstrap-table.js"></script>
<!-- importa arquivo js ta tela -->
<script src="js/funcoes_ger_usuarios.js"></script>

<div class="page-header text-center">
  <h2>Gerenciamento de Usuários <small>Usuários Cadastrados</small></h>
</div>

<div class="row">
    <div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2">

        <div id="custom-toolbar">
            <div class="form-inline" role="form">
                <!-- <a href="#myModal" role="button" class="btn btn-default" data-toggle="modal"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp;Cadastrar</a> -->
                <a role="button" id="btnCadUser" class="btn btn-default">
                    <i class="glyphicon glyphicon-plus-sign"></i>&nbsp;Cadastrar</a>

            </div>
        </div>

        <table id="tableUsuarios" class="table table-bordered table-hover table-striped" 
               data-toggle="table" data-url="ajax/json.php?fn=listaUsuarios"
               data-sort-name="login" data-sort-order="asc" data-cache="false"
               data-show-columns="true" data-search="true" data-show-Toggle="true"
               data-show-Refresh="true" data-pagination="true" 
               data-page-list="[5,10,20,50]" data-side-pagination="server"
               data-toolbar="#custom-toolbar">
            <thead>
                <tr>
                    <th data-field="login" data-sortable="true">Usuário</th>
                    <th data-field="nome" data-sortable="true">Nome Completo</th>
                    <th data-field="senha" data-sortable="true" data-visible="false">Senha</th>
                    <th data-field="operate" data-formatter="operateFormatter" 
                        data-events="operateEvents" class="text-center">OPÇÕES</th>
                </tr>
            </thead>

        </table>
    </div> 
</div>


<div id="modalCadUser" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" on>&times;</button>
                <h4 class="modal-title" id="titFormCadUser">Cadastro de Usuário</h4>
            </div>
            <div class="modal-body">
                <div id="box_alertas_cad_user" class="text-center"></div>
                <form class="form-horizontal" id="formCadUser" onsubmit="return false">
                    <input type="hidden" name="opcaduser" id="opcaduser">
                    <div class="form-group">
                        <label class="control-label col-md-4" for="login">Login</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="login" name="login" placeholder="Login do usuário" required maxlength="30"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="nome">Nome</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome Completo" required maxlength="50"/>
                        </div>
                    </div>

                    <div class="form-group" id="divSenha">
                        <label class="control-label col-md-4" for="senha">Senha</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required maxlength="8"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-1">
                            <button type="button" value="Submit" id="btnSalvaUser" class="btn btn-primary btn-lg pull-right">Cadastrar</button>
                        </div>
                    </div>
                </form>
            </div><!-- End of Modal body -->
        </div><!-- End of Modal content -->
    </div><!-- End of Modal dialog -->
</div><!-- End of Modal -->

<div id="modalAlterKey" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" on>&times;</button>
                <h4 class="modal-title" id="titFormCadUser">Alteração de Senha</h4>
            </div>
            <div class="modal-body">
                <div id="box_alertas_alt_senha" class="text-center"></div>
                <form class="form-horizontal" id="formAltSenha" onsubmit="return false">

                    <div class="form-group">
                        <label class="control-label col-md-4" for="loginUser">Login</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="loginUser" name="loginUser" placeholder="Login do usuário" required maxlength="30" readonly/>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-md-4" for="senhaUser">Senha</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" id="senhaUser" name="senhaUser" placeholder="Senha" required maxlength="8"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-1">
                            <button type="button" value="Submit" id="btnSalvaAltSenha" class="btn btn-primary btn-lg pull-right">Salvar</button>
                        </div>
                    </div>
                </form>
            </div><!-- End of Modal body -->
        </div><!-- End of Modal content -->
    </div><!-- End of Modal dialog -->
</div><!-- End of Modal -->

