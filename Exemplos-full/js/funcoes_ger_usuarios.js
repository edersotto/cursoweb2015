
function operateFormatter(value, row, index) {
    return [
        '<a class="edit ml10" href="javascript:void(0)" title="Alterar">',
        '<i class="glyphicon glyphicon-edit"></i>',
        '</a>&nbsp;',
        '<a class="alterKey ml10" href="javascript:void(0)" title="Alterar Senha">',
        '<i class="glyphicon glyphicon-lock"></i>',
        '</a>&nbsp;',
        '<a class="remove ml10" href="javascript:void(0)" title="Excluir">',
        '<i class="glyphicon glyphicon-remove"></i>',
        '</a>'
    ].join('');
}

window.operateEvents = {
    'click .edit': function(e, value, row, index) {
        $('#login').attr("readonly", "true");

        $('#modalCadUser').modal('show')
        // 2 = alteração
        $("#opcaduser").val(2);
        $("#nome").val(row.nome);
        $("#login").val(row.login);
        $("#btnSalvaUser").html("Alterar");
        $("#titFormCadUser").html("Alterar Usuário");
        $('#divSenha').hide();
        $('#senha').attr("disabled", "true");
    },
    'click .remove': function(e, value, row, index) {
        bootbox.confirm("Tem certeza que deseja excluir o usuário <b>" + row.nome + "</b>?", function(result) {
            if (result) {
                $.post("ajax/json.php",
                        {
                            fn: 'excluiUser',
                            user: row.login

                        },
                function(data, status) {
                    var json = $.parseJSON(data);
                    alerta(json.success, json.msg, $("#box_alertas"));
                    if (json.success == true) {
                        // SE HOUVE SUCESSO
                        $('#tableUsuarios').bootstrapTable('refresh');
                    }
                });
            }
        });

    },
    'click .alterKey': function(e, value, row, index) {
        $('#modalAlterKey').modal('show')
        $("#loginUser").val(row.login);
    }
};

$("#btnCadUser").click(function() {
    // 1 = novo cadastro
        $("#opcaduser").val(1);
    $("#login").removeAttr("readonly");
    $('#modalCadUser').modal('show')
    $('#divSenha').show();
    $('#senha').removeAttr("disabled");
    $("#btnSalvaUser").html("Cadastrar");
    $("#titFormCadUser").html("Cadastrar Usuário");
    $('#formCadUser')[0].reset();
});

$("#btnSalvaUser").click(function() {

    var $myForm = $('#formCadUser');
    $('<input type="submit">').hide().appendTo($myForm).click().remove();
    // SE FORMULÁRIO NÃO ESTIVER OK
    if (!$myForm[0].checkValidity()) {
        // If the form is invalid, submit it. The form won't actually submit;
        // this will just cause the browser to display the native HTML5 error messages.
        $myForm.find(':submit').click()
    }
    // SE ESTIVER OK
    else {
        if($("#opcaduser").val()==1) {
            fn = "cadUser";
        }
        else if($("#opcaduser").val()==2) {
            fn = "alteraUser";
        }
        $('#btnSalvaUser').button('loading');
        $.post("ajax/json.php",
                {
                    fn: fn,
                    user: $("#login").val(),
                    pass: $("#senha").val(),
                    nome: $("#nome").val()

                },
        function(data, status) {
            $('#btnSalvaUser').button('reset');
            var json = $.parseJSON(data);

            if (json.success == true) {
                // SE HOUVE ERRO
                $('#modalCadUser').modal('hide')
                $('#formCadUser')[0].reset();
                $('#tableUsuarios').bootstrapTable('refresh');
                alerta(json.success, json.msg, $("#box_alertas"));
            }
            else {
                alerta(json.success, json.msg, $("#box_alertas_cad_user"));
            }

        });
    }

});

$("#btnSalvaAltSenha").click(function() {
    var $myForm = $('#formAltSenha');
    $('<input type="submit">').hide().appendTo($myForm).click().remove();
    // SE FORMULÁRIO NÃO ESTIVER OK
    if (!$myForm[0].checkValidity()) {
        // If the form is invalid, submit it. The form won't actually submit;
        // this will just cause the browser to display the native HTML5 error messages.
        $myForm.find(':submit').click()
    }
    // SE ESTIVER OK
    else {
        $('#btnSalvaAltSenha').button('loading');
        $.post("ajax/json.php",
                {
                    fn: 'altSenhaUser',
                    user: $("#loginUser").val(),
                    pass: $("#senhaUser").val()
                },
        function(data, status) {
            $('#btnSalvaAltSenha').button('reset');
            var json = $.parseJSON(data);
            alerta(json.success, json.msg, $("#box_alertas"));
            if (json.success == true) {
                // SE HOUVE ERRO
                $('#modalAlterKey').modal('hide')
                $('#formAltSenha')[0].reset();
            }

        });
    }
});

