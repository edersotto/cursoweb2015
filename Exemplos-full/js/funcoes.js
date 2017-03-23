
var idcategoria = 0

function getJSON2Select(url, JInput, valSelected, callback) {
    $.getJSON(url, function(data) {
        $(JInput + " option").remove();
        $.each(data, function(index, item) {
            var add = "";
            for (var key in item) {
                //keys.push(key);
                if ((key != "text") && ((key != "value"))) {
                    add += 'data-' + key + '="' + item[key] + '" ';

                }
            }
            if (item.value == valSelected) {
                $(JInput).append('<option ' + add + ' selected="selected" value="' + item.value + '">' + item.text + '</option>')
            }
            else {
                $(JInput).append('<option ' + add + ' value="' + item.value + '">' + item.text + '</option>')
            }
            if (callback != null) {
                eval(callback)();
            }
        });
        return true;
    });
}

// MONTA A HOME
function produtos_home(fn, idcategoria) {
// monta a tela de produtos
    $.post("ajax/json.php",
            {
                fn: fn,
                idcategoria: idcategoria
            },
            function(data, status) {
                var json = $.parseJSON(data);
                $("#conteudo").html('<div class="row" id="home_prod">');
                $(json).each(function() {
                    $("#home_prod").append('<div class="col-xs-12 col-sm-4 col-md-3">' +
                            '<a href="#" class="thumbnail margem-superior-grid">' +
                            '<img cass="img-thumbnail" src="data:image/jpeg;base64,' + this.imagem + '">' +
                            '<div class="caption text-center">' +
                            '<h3>' + this.nome + '</h3>' +
                            '<p>' + this.descricao + '</p>' +
                            '</div>' +
                            '</a>' +
                            '</div>');

                });
                $("#home_prod").append('</div>');
            }
    );
}


$(document).ready(function() {

    $("a").click(function() {
        //$("#link_sobre, #link_home, #link_fale").click(function(){

        //var link = $(this).attr("id"); 
        //alert("clicou no link "+$(this).attr("id")); 
        if ($(this).attr("data-url") != null) {
            // DESMARCAR O ACTIVE DE TODAS AS LI'S
            $("li").each(function(index) {
                $(this).removeClass("active");
            });

            $.ajax({
                url: $(this).attr("data-url"),
                success: function(htmlretorno) {
                    $("#conteudo").html(htmlretorno);
                }
            });

            // MARCA O LINK CLICADO COMO ATIVO
            $(this).parent().addClass("active");
            // MARCA O LINK PAI (CASO SEJA DROPDOWN)
            $(this).parent().parent().parent().addClass("active");
        }
        // fecha o listener   
    });
    
    
    // aciona o click do link home
    produtos_home('produtos', null);

    // carrega o dropdown das categorias
    // apenas categorias que possuem produtos
    $.post("ajax/json.php",
            {
                fn: 'categoriasDrop',
            },
            function(data, status) {
                var json = $.parseJSON(data);
                $(json).each(function() {
                    $("#dropcategorias").append("<li><a class='categorias' data-idcat='" + this.id + "' href='#'>" + this.nome + "</a></li>");
                });

                $("a.categorias").click(function() {
                    idcategoria = $(this).attr("data-idcat");
                    produtos_home('produtos', idcategoria);

                });
            }
    );

    $("#link_home").click(function() {
        produtos_home('produtos', null);
    });

// fecha o ready    
});
        