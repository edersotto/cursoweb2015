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
<script src="js/funcoes_ger_produtos.js"></script>

<div class="page-header text-center">
    <h2>Gerenciamento de Produtos <small>Produtos Cadastrados</small></h2>
</div>


<div class="row">
    <div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2">

        <div id="custom-toolbar">
            <div class="form-inline" role="form">
                <!-- <a href="#myModal" role="button" class="btn btn-default" data-toggle="modal"><i class="glyphicon glyphicon-plus-sign"></i>&nbsp;Cadastrar</a> -->
                <a role="button" id="btnCadProd" class="btn btn-default">
                    <i class="glyphicon glyphicon-plus-sign"></i>&nbsp;Cadastrar</a>

            </div>
        </div>

        <table id="tableProdutos" class="table table-bordered table-hover table-striped" 
               data-toggle="table" data-url="ajax/json.php?fn=listaProdutos"
               data-sort-name="nome" data-sort-order="asc" data-cache="false"
               data-show-columns="true" data-search="true" data-show-Toggle="true"
               data-show-Refresh="true" data-pagination="true" 
               data-page-list="[5,10,20,50]" data-side-pagination="server"
               data-toolbar="#custom-toolbar">
            <thead>
                <tr>
                    <th data-field="id" data-sortable="true">ID</th>
                    <th data-field="nome" data-sortable="true">Nome</th>
                    <th data-field="descricao" data-sortable="true">Descrição</th>
                    <th data-field="valor" data-sortable="true">Valor</th>
                    <th data-field="categoria" data-sortable="true">Categoria</th>
                    <th data-field="imagem" data-formatter="imgFormatter" data-align="center">Imagem</th>

                    <th data-field="operate" data-formatter="operateFormatter" 
                        data-events="operateEvents" class="text-center">OPÇÕES</th>
                </tr>
            </thead>

        </table>
    </div> 
</div>


<div id="modalCadProd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" on>&times;</button>
                <h4 class="modal-title" id="titFormCadProd">Cadastro de Produto</h4>
            </div>
            <div class="modal-body">
                <div id="box_alertas_cad_prod" class="text-center"></div>
                <form class="form-horizontal" id="formCadProd" action="ajax/json.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="opcadprod" id="opcadprod">
                    <input type="hidden" name="fn" id="fn" value="cadProd">
                    <div class="form-group">
                        <label class="control-label col-md-4" for="idprod">ID</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="idprod" name="idprod" placeholder="ID" required maxlength="30" readonly/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="nomeprod">Nome</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="nomeprod" name="nomeprod" placeholder="Nome do Produto" required maxlength="50"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-4" for="valorprod">Valor</label>
                        <div class="col-md-6">
                            <input type="number" step="any" class="form-control" id="valorprod" name="valorprod" placeholder="Valor do Produto" required maxlength="50"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-4" for="descprod">Descrição</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="descprod" name="descprod" placeholder="Descrição do Produto" required maxlength="50"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-4" for="textoprod">Texto</label>
                        <div class="col-md-6">
                            <textarea class="form-control" id="textoprod" name="textoprod" placeholder="Texto do Produto" required/>
                            </textarea>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-4" for="catprod">Categoria</label>
                        <div class="col-md-6">
                            <select name="catprod" id="catprod" class="form-control" required>
                                <option value="">Carregando...</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-4" for="imgprod">Imagem</label>
                        <div class="col-md-6">
                            <input type="file" class="form-control" id="imgprod" name="imgprod" placeholder="Imagem do Produto"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-1">
                            <button type="submit" value="Submit" id="btnSalvaProd" class="btn btn-primary btn-lg pull-right">Cadastrar</button>
                        </div>
                    </div>
                </form>
            </div><!-- End of Modal body -->
        </div><!-- End of Modal content -->
    </div><!-- End of Modal dialog -->
</div><!-- End of Modal -->

