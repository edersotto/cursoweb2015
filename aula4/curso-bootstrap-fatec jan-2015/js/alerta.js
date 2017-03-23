function alerta(sucesso, html, destino) {
    if (sucesso) {
        alerta = "alert-success";
    }
    else {
        alerta = "alert-danger";
    }
    destino.html("<div class='alert "+alerta+" alert-dismissible' role='alert'>"
            + "<button type = 'button' class='close' data-dismiss='alert'> <span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>"
            + html
            + "</div>");
}
