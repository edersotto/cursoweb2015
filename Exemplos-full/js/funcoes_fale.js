$(document).ready(function() {
    $("#btnEnviaEmail").click(function() {


        

        // armazena referencia do form na variavel
        var $myForm = $("#formFale");
        // adiciona e remove o botao submit
        $("<input type='submit'>").hide().appendTo($myForm).click().remove();
        // verifica se a validação não está ok
        if ($myForm[0].checkValidity() == false) {
            $myForm.find(":submit").click();
        }
        // se o formulário foi preenchido corretamente
        else {
            $('#btnEnviaEmail').button('loading');
            $.post("ajax/json.php",
                    {
                        fn: 'fale',
                        nome: $("#nome").val(),
                        email: $("#email").val(),
                        mensagem: $("#mensagem").val()
                    },
            function(data, status) {
                $('#btnEnviaEmail').button('reset');

                var json = $.parseJSON(data);

                alerta(json.success, json.msg, $("#box_alertas"));

                $('#formFale')[0].reset();
            });
        }
    });
});