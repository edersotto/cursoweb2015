$(document).ready(function() {
    $("#btnEnviaEmail").click(function() {
        var $myForm = $('#formfale');
        $('<input type="submit">').hide().appendTo($myForm).click().remove();
        // SE FORMULÁRIO NÃO ESTIVER OK
        if (!$myForm[0].checkValidity()) {
            // SE ENCONTROU ERRO
            $myForm.find(':submit').click()
        }
        // SE ESTIVER OK
        else {
            $.post("ajax/json/fale.php",
                    {
                        fn: 'fale',
                        nome: $("#nome").val(),
                        email: $("#email").val(),
                        mensagem: $("#mensagem").val()
                    },
            function(data, status) {
                var json = $.parseJSON(data);
                alerta(json.success, json.msg, $("#box_alertas"));
                $('#formfale')[0].reset();
            });

        }
    });
});