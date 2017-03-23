<div class="row">
    <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-xs-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-title">
                    Fale Conosco
                </div>    
            </div>

            <div class="panel-body">
                <form class="form-horizontal" id="formFale" onsubmit="return false;">
                    <div class="form-group">
                        <label class="control-label col-md-4" for="nome">
                            Nome:
                        </label> 
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="nome" name="nome" required>
                        </div> 
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-md-4" for="email">
                            E-Mail:
                        </label> 
                        <div class="col-md-6">
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div> 
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-md-4" for="mensagem">
                            Mensagem:
                        </label> 
                        <div class="col-md-6">
                            <textarea rows="5" class="form-control" id="mensagem" name="mensagem" required></textarea>
                        </div> 
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-1">
                            <input id="btnEnviaEmail"  data-loading-text="Carregando..." type="button" value="Enviar" class="btn btn-primary btn-lg pull-right">
                        </div>   
                    </div>
                </form>    
            </div>    
        </div>    
    </div>
</div>    

<script src="js/funcoes_fale.js"></script>
