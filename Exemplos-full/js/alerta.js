function alerta(sucesso, html, destino) {

    if (sucesso) {
        tipoalerta = "alert-success";
    }
    else {
        tipoalerta = "alert-danger";
    }

    destino.html("<div class='alert " + tipoalerta + " alert-dismissible' role='alert'>"
            + "<button type = 'button' class='close' data-dismiss='alert'> <span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>"
            + html
            + "</div>");


}
