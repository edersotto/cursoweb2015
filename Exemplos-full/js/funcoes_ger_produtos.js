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

        $('#modalCadProd').modal('show')
        // 2 = alteração
        $("#opcadprod").val(2);
        $("#nomeprod").val(row.nome);
        $("#valorprod").val(row.val);
        $("#descprod").val(row.descricao);
        $("#textoprod").val(row.texto);
        $("#idprod").val(row.id);
        getJSON2Select("ajax/json.php?fn=categoriasSelect", "#catprod", row.id_categoria, null);

        $("#btnSalvaProd").html("Alterar");
        $("#titFormCadProd").html("Alterar Produto");

    },
    'click .remove': function(e, value, row, index) {
        bootbox.confirm("Tem certeza que deseja excluir o produto <b>" + row.nome + "</b>?", function(result) {
            if (result) {
                $.post("ajax/json.php",
                        {
                            fn: 'excluiProd',
                            id: row.id

                        },
                function(data, status) {
                    var json = $.parseJSON(data);
                    alerta(json.success, json.msg, $("#box_alertas"));
                    if (json.success == true) {
                        // SE HOUVE SUCESSO
                        $('#tableProdutos').bootstrapTable('refresh');
                    }
                });
            }
        });

    }
};

function imgFormatter(value, row) {
    if (value!='')
        return  "<img src='data:image/jpeg;base64," + value + "'>";
    else
        return "";
}


$("#btnCadProd").click(function() {
    getJSON2Select("ajax/json.php?fn=categoriasSelect", "#catprod", null, null);
    // 1 = novo cadastro
    $("#opcadprod").val(1);
    $('#modalCadProd').modal('show')

    $("#btnSalvaProd").html("Cadastrar");
    $("#titFormCadProd").html("Cadastrar Produto");
    $('#formCadProd')[0].reset();
});



$('#formCadProd').on('submit', (function(e) {
    $('#btnSalvaProd').button('loading');
    e.preventDefault();
    //var formData = new FormData(this);

    var fn = "";
    if ($("#opcadprod").val() == 1) {
        fn = "cadProd";
    }
    else if ($("#opcadprod").val() == 2) {
        fn = "alteraProd";
    }
    $('#fn').val(fn);

    var data = new FormData(this);

    $.ajax({
        type: 'POST',
        url: $(this).attr('action'),
        data: data,
        cache: false,
        //contentType: false,
        //processData: false,
        success: function(data) {
            var json = $.parseJSON(data);
            // SE HOUVE ERRO
            $('#modalCadProd').modal('hide')
            $('#formCadProd')[0].reset();
            $('#tableProdutos').bootstrapTable('refresh');
            alerta(json.success, json.msg, $("#box_alertas"));
            $('#btnSalvaProd').button('reset');
        },
        error: function(data) {
            alerta(json.success, json.msg, $("#box_alertas_cad_prod"));
            $('#btnSalvaProd').button('reset');
        }

    });
}));



