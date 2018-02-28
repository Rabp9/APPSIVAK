function insertarHtmlDespuesDe(idElementoReferencia, html)
{
	$("#"+idElementoReferencia).after(html);
}

function agregarHtmlAlFinal(idContenedor, html)
{
	$("#"+idContenedor).append(html);
}

function borrarElemento(idElemento)
{
	$("#"+idElemento).remove();
}

function cerrarDivVerDetalla()
{
	$('#divVerDetalle').css({'display' : 'none'});
}

function thisDosDecimales(elemento)
{
	$(elemento).text(parseFloat($(elemento).text()).toFixed(2));
}