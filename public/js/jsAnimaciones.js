function animacionAlertaMensajeGeneral(texto, color)
{
	$(".alertaMensajeGlobal").css({"height" : "auto"});

	$(".alertaMensajeGlobal").css({"background-color" : color});
	$(".alertaMensajeGlobal").html(texto);
	$(".alertaMensajeGlobal").stop(true).animate({"opacity" : "0"}, 500);
	$(".alertaMensajeGlobal").animate({"opacity" : "1"}, 500);
	$(".alertaMensajeGlobal").animate({"opacity" : "0"}, 500);
	$(".alertaMensajeGlobal").animate({"opacity" : "1"}, 500);
	$(".alertaMensajeGlobal").animate({"opacity" : "0"}, 500);
	$(".alertaMensajeGlobal").animate({"opacity" : "1"}, 500);
	$(".alertaMensajeGlobal").animate({"opacity" : "0"}, 10000);
	$(".alertaMensajeGlobal").animate({"height" : "0px"}, 0);
}

function animacionScrollMovimientoY(idElementoReferencia, topDiferencia)
{
	$("body").animate({scrollTop: $("#"+idElementoReferencia).offset().top+topDiferencia}, 500);
}

function mostrarApartadoBuscar()
{
    $('.apartadoBuscar').animate({'height': '100%'}, 500);
}

function ocultarApartadoBuscar()
{
    $(".apartadoBuscar").animate({"height": "0px"}, 500);
}