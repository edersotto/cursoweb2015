//
function operateFormatter(value, row, index) {
    return [
        '<a class="edit ml10" href="javascript:void(0)" title="Alterar">',
        '<i class="glyphicon glyphicon-edit"></i>',
        '</a>&nbsp;',
        '<a class="remove ml10" href="javascript:void(0)" title="Excluir">',
        '<i class="glyphicon glyphicon-remove"></i>',
        '</a>'
    ].join('');
}

window.operateEvents = {
    'click .edit': function(e, value, row, index) {
        
        $('#modalCadCat').modal('show')
        // 2 = alteração
        $("#opcadcat").val(2);
        $("#nome").val(row.nome);
        $("#idcat").val(row.id);
        $("#btnSalvaCat").html("Alterar");
        $("#titFormCadCat").html("Alterar Categoria");
        
    },
    'click .remove': function(e, value, row, index) {
        bootbox.confirm("Tem certeza que deseja excluir a categoria <b>" + row.nome + "</b>?", function(result) {
            if (result) {
                $.post("ajax/json.php",
                        {
                            fn: 'excluiCat',
                            id: row.id

                        },
                function(data, status) {
                    var json = $.parseJSON(data);
                    alerta(json.success, json.msg, $("#box_alertas"));
                    if (json.success == true) {
                        // SE HOUVE SUCESSO
                        $('#tableCategorias').bootstrapTable('refresh');
                    }
                });
            }
        });

    }
};

$("#btnCadCat").click(function() {
    // 1 = novo cadastro
    $("#opcadcat").val(1);
    $('#modalCadCat').modal('show')
    
    $("#btnSalvaCat").html("Cadastrar");
    $("#titFormCadCat").html("Cadastrar Categoria");
    $('#formCadCat')[0].reset();
});

$("#btnSalvaCat").click(function() {

    var $myForm = $('#formCadCat');
    $('<input type="submit">').hide().appendTo($myForm).click().remove();
    // SE FORMULÁRIO NÃO ESTIVER OK
    if (!$myForm[0].checkValidity()) {
        // If the form is invalid, submit it. The form won't actually submit;
        // this will just cause the browser to display the native HTML5 error messages.
        $myForm.find(':submit').click()
    }
    // SE ESTIVER OK
    else {
        var fn="";
        if($("#opcadcat").val()==1) {
            fn = "cadCat";
        }
        else if($("#opcadcat").val()==2) {
            fn = "alteraCat";
        }
        
        $('#btnSalvaCat').button('loading');
        $.post("ajax/json.php",
                {
                    fn: fn,
                    id: $("#idcat").val(),
                    nome: $("#nomecat").val()

                },
        function(data, status) {
            $('#btnSalvaCat').button('reset');
            var json = $.parseJSON(data);

            if (json.success == true) {
                // SE HOUVE ERRO
                $('#modalCadCat').modal('hide')
                $('#formCadCat')[0].reset();
                $('#tableCategorias').bootstrapTable('refresh');
                alerta(json.success, json.msg, $("#box_alertas"));
            }
            else {
                alerta(json.success, json.msg, $("#box_alertas_cad_cat"));
            }

        });
    }

});


