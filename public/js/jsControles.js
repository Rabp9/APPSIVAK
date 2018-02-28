function limpiarText(idContenedor, arrayIdExcepciones)
{
	var sizeArrayIdExcepciones=arrayIdExcepciones==null?0:arrayIdExcepciones.length;
	$("#"+idContenedor).find("input[type='text']").each(function(index, elemento)
	{
		var borrarContenido=true;
		for(var i=0; i<sizeArrayIdExcepciones; i++)
		{
			if(arrayIdExcepciones[i]==$(elemento).attr("id"))
			{
				borrarContenido=false;
				break;
			}
		}

		if(borrarContenido)
		{
			$(elemento).val("");
		}
	});
}

function limpiarTextArea(idContenedor, arrayIdExcepciones)
{
	var sizeArrayIdExcepciones=arrayIdExcepciones==null?0:arrayIdExcepciones.length;
	$("#"+idContenedor).find("textarea").each(function(index, elemento)
	{
		var borrarContenido=true;
		for(var i=0; i<sizeArrayIdExcepciones; i++)
		{
			if(arrayIdExcepciones[i]==$(elemento).attr("id"))
			{
				borrarContenido=false;
				break;
			}
		}

		if(borrarContenido)
		{
			$(elemento).val("");
		}
	});
}

function limpiarHidden(idContenedor, arrayIdExcepciones)
{
	var sizeArrayIdExcepciones=arrayIdExcepciones==null?0:arrayIdExcepciones.length;
	$("#"+idContenedor).find("input[type='hidden']").each(function(index, elemento)
	{
		var borrarContenido=true;
		for(var i=0; i<sizeArrayIdExcepciones; i++)
		{
			if(arrayIdExcepciones[i]==$(elemento).attr("id"))
			{
				borrarContenido=false;
				break;
			}
		}

		if(borrarContenido)
		{
			$(elemento).val("");
		}
	});
}

function trasladarHtml(idElementoEmisor, etiquetaTrasladar, idElementoReceptor)
{
	$("#"+idElementoEmisor).find(etiquetaTrasladar).each(function(index, elemento)
	{
		var elementoTemporal=$(elemento);
		$(elemento).remove();
		$("#"+idElementoReceptor).append($(elementoTemporal));
	});
}

function calcularSubTotalIgvTotal(idCampoSubTotal, idCampoIgv, idCampoTotal)
{
    var valorTxtTotal=parseFloat($("#"+idCampoTotal).val());
    valorTxtTotal=valorTxtTotal.toFixed(2);
    var valorTxtSubTotal=parseFloat(valorTxtTotal)/1.18;
    valorTxtSubTotal=valorTxtSubTotal.toFixed(2);
    var valorTxtIgv=parseFloat(valorTxtTotal-valorTxtSubTotal);
    valorTxtIgv=valorTxtIgv.toFixed(2);
    $("#"+idCampoSubTotal).val(valorTxtSubTotal);
    $("#"+idCampoIgv).val(valorTxtIgv);
    $("#"+idCampoTotal).val(valorTxtTotal);
}

function calcularIgv(montoMonetario)
{
	var montoMonetario=parseFloat(montoMonetario);
    montoMonetario=montoMonetario.toFixed(2);
    var valorSubTotal=parseFloat(montoMonetario)/1.18;
    valorSubTotal=valorSubTotal.toFixed(2);
    var valorIGV=parseFloat(montoMonetario-valorSubTotal);
    valorIGV=valorIGV.toFixed(2);
    
    return valorIGV;
}

function calcularSubTotal(montoMonetario)
{
	var montoMonetario=parseFloat(montoMonetario);
    montoMonetario=montoMonetario.toFixed(2);
    var valorSubTotal=parseFloat(montoMonetario)/1.18;
    valorSubTotal=valorSubTotal.toFixed(2);

    return valorSubTotal;
}