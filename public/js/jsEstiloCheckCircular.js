function inicializarEstiloCheckCircular(divId, width, height, borderRadius, tamanioLetra, tipo)
{
	var css=
	{
		'border-radius' : borderRadius,
		'height' : height,
		'width' : width
	};

	$('#'+divId+' > div').css(css);
	$('#'+divId+' > div > b').css({'font-size' : tamanioLetra});
	$('#'+divId).attr('tipo', tipo);

	var valoresCheck='';

	$('#'+divId).find('div').each(function(index, elemento)
	{
		$(elemento).append('<img src="/APPSIVAK/public/img/check/check.png">');

		if($(elemento).attr('seleccionado')=='true')
		{
			$('#'+elemento.id).css({'background-color' : '#1497CC'});
			$('#'+elemento.id+' > img').css({'display' : 'inline-block'});

			valoresCheck+=$('#'+elemento.id).attr('value')+',';
		}
	});

	valoresCheck=valoresCheck.substring(0, valoresCheck.length-1);

	$('#'+divId+' > input[type=hidden]').val(valoresCheck);
}

function onClickEstiloCheckCircular(divEstiloCheckCircular)
{
	if($('#'+$(divEstiloCheckCircular).parent().attr('id')).attr('tipo')=='radio')
	{
		$('#'+$(divEstiloCheckCircular).parent().attr('id')).find('div').each(function(index, elemento)
		{
			$('#'+elemento.id).css({'background-color' : '#D4360E'});
			$('#'+elemento.id+' > img').css({'display' : 'none'});
		});
	}

	if($('#'+$(divEstiloCheckCircular).attr('id')).css('background-color')=='rgb(212, 54, 14)')
	{
		$('#'+$(divEstiloCheckCircular).attr('id')).css({'background-color' : '#1497CC'});
		$('#'+$(divEstiloCheckCircular).attr('id')+' > img').css({'display' : 'inline-block'});
	}
	else
	{
		$('#'+$(divEstiloCheckCircular).attr('id')).css({'background-color' : '#D4360E'});
		$('#'+$(divEstiloCheckCircular).attr('id')+' > img').css({'display' : 'none'});
	}

	var valoresCheck='';

	$('#'+$(divEstiloCheckCircular).parent().attr('id')).find('div').each(function(index, elemento)
	{
		if($('#'+elemento.id).css('background-color')!='rgb(212, 54, 14)')
		{
			valoresCheck+=$('#'+elemento.id).attr('value')+',';
		}
	});

	valoresCheck=valoresCheck.substring(0, valoresCheck.length-1);

	$('#'+$(divEstiloCheckCircular).parent().attr('id')+' > input[type=hidden]').val(valoresCheck);
}