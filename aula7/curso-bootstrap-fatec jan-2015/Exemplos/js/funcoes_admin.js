$(document).ready(function() {

    // VERIFICA SE JÁ ESTÁ LOGADO COMO ADM. SE ESTIVER, CARREGA MENU AMD E BLOQUEIA NOVO LOGIN
    $.post("ajax/json.php",
            {
                fn: 'verificaLogado'
            },
    function(data, status) {
        var json = $.parseJSON(data);
        if (json.success == true) {
            // SE JÁ ESTÁ LOGADO
            $('#menu_administrador').show();            
        }
    });


    // FAZ O LOGOUT
    $("#logout").click(function() {
        $.post("ajax/json.php",
                {
                    fn: 'logout'
                },
        function(data, status) {
            var json = $.parseJSON(data);
            $("#menu_administrador").hide();
            alerta(json.success, json.msg, $("#box_alertas"));
            $("#link_home").trigger("click");
        });
    });

    // ABRE A MODAL SE CLICAR TECLAS DE ATALHO
    $(document).bind('keydown', "Ctrl+m", function assets() {
        $('#modalAdmin').modal('show');
    });

    // BOTÃO DE LOGIN DO FORMULARIO
    $("#btnLogin").click(function() {
        $('#btnLogin').button('loading');
        var $myForm = $('#formlogin');
        $('<input type="submit">').hide().appendTo($myForm).click().remove();
        // SE FORMULÁRIO NÃO ESTIVER OK
        if (!$myForm[0].checkValidity()) {
            // SE ENCONTROU ERRO
            $myForm.find(':submit').click()
        }
        // SE ESTIVER OK
        else {
            $.post("ajax/json.php",
                    {
                        fn: 'login',
                        user: $("#user").val(),
                        pass: $("#pass").val()

                    },
            function(data, status) {
                $('#btnLogin').button('reset');
                var json = $.parseJSON(data);
                if (json.success == false) {
                    // SE HOUVE ERRO
                    alerta(json.success, json.msg, $("#box_alertas_login"));
                }
                else {
                    // SE LOGIN FOI EFETUADO COM SUCESSO
                    $('#modalAdmin').modal('hide');
                    $('#menu_administrador').show();

                    //carrega_menu_adm();
                }
                $('#formlogin')[0].reset();
            });

        }
    });


});