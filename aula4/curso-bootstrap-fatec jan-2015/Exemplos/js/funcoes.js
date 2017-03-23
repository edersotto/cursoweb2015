$(document).ready(function() {
    $("#link_sobre, #link_home, #link_fale").click(function(){
       
       //var link = $(this).attr("id"); 
       //alert("clicou no link "+$(this).attr("id")); 
       
        // DESMARCAR O ACTIVE DE TODAS AS LI'S
        $("li").each(function(index) {
            $(this).removeClass("active");
        });
       
        $.ajax({
            url: "ajax/"+$(this).attr("id")+".php",
            success: function(htmlretorno) {
                $("#conteudo").html(htmlretorno);
            }
        });
       
        // MARCA O LINK CLICADO COMO ATIVO
        $(this).parent().addClass("active");
       
    // fecha o listener   
    });
    // aciona o click do link home
    $("#link_home").trigger("click");
// fecha o ready    
});
        