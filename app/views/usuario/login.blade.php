<!doctype html>
<html lang="sp">
<head>
	<meta charset="UTF-8">
	<title>ACEROS PERUANOS</title>
	<link rel="stylesheet" href="/APPSIVAK/public/css/cssFormulario.css">
	<link rel="stylesheet" href="/APPSIVAK/public/css/cssContenido.css">
	<link rel="stylesheet" href="/APPSIVAK/public/css/cssComponentes.css">

	<script src="/APPSIVAK/public/js/prefixfree.min.js"></script>
    <script src="/APPSIVAK/public/js/jquery-2.0.3.min.js"></script>
	<script src="/APPSIVAK/public/js/jsAnimaciones.js"></script>
	<script src="/APPSIVAK/public/js/jsEstiloCheckCircular.js"></script>
</head>
<body style="margin-top:150px;" class="textAlignCenter">
	<div class="alertaMensajeGlobal"></div>
    @if(isset($mensajeGlobal) && $mensajeGlobal!='')
        <script>animacionAlertaMensajeGeneral('{{$mensajeGlobal}}', '{{$color}}');</script>
    @endif
	<section class="contenidoTop">			
		<form id="frmLogin" action="/APPSIVAK/public/" method="post" class="formulario">
			<div class="tituloFormulario">CORPORACIÓN ACEROS PERUANOS SAC</div>
			<div class="contenidoTop">
				<img src="/APPSIVAK/public/img/logoaceros.png" class="contenidoMiddle" height="54">
				<input type="text" id="txtNombreUsuario" name="txtNombreUsuario" placeholder="Usuario">
				<input type="password" id="txtContrasenia" name="txtContrasenia" placeholder="Contraseña">
				<hr>
				<div class="textAlignRight">
					<div id="radioOficinaAlmacen" class="estiloCheckCircular">
						<input type="hidden" id="txtRadioOficinaAlmacen" name="txtRadioOficinaAlmacen">
						<label>Seleccione local</label>
						<div id="checkOficina" value="Oficina" seleccionado="true" onclick="onClickEstiloCheckCircular(this); onClickRadioOficinaAlmacen();"><b>Oficina</b></div>
						<div id="checkAlmacen" value="Almacén" onclick="onClickEstiloCheckCircular(this); onClickRadioOficinaAlmacen();"><b>Almacén</b></div>
					</div>
					<select name="cbxOficina" id="cbxOficina">
						<option value="">--Seleccione Oficina--</option>
						@foreach($listaTOficina as $item)
							<option value="{{{$item->codigoOficina}}}">{{{$item->descripcion}}}</option>
						@endforeach
					</select>
					<select name="cbxAlmacen" id="cbxAlmacen" style="display: none;">
						<option value="">--Seleccione Almacén--</option>
						@foreach($listaTAlmacen as $item)
							<option value="{{{$item->codigoAlmacen}}}">{{{$item->descripcion}}}</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="seccionBotones bordeArriba">
				<input type="button" value="Acceder" onclick="enviarFrmLogin();">
			</div>
		</form>
	</section>
</body>
<script>
	$(document).on('ready', function()
	{
		inicializarEstiloCheckCircular('radioOficinaAlmacen', '40px', '40px', '40px', '10px', 'radio');
	});

	function onClickRadioOficinaAlmacen()
	{
		$('#cbxOficina').css({'display' : 'none'});
		$('#cbxAlmacen').css({'display' : 'none'});

		if($('#txtRadioOficinaAlmacen').val()=='Oficina')
		{
			$('#cbxOficina').css({'display' : 'inline-block'});
		}

		if($('#txtRadioOficinaAlmacen').val()=='Almacén')
		{
			$('#cbxAlmacen').css({'display' : 'inline-block'});
		}
	}

    function enviarFrmLogin()
    {
        var mensajeGlobal='';

        if($('#txtRadioOficinaAlmacen').val()=='Oficina' && $('#cbxOficina').val()=='')
        {
        	mensajeGlobal+='Seleccione Oficina';
        }

        if($('#txtRadioOficinaAlmacen').val()=='Almacén' && $('#cbxAlmacen').val()=='')
        {
        	mensajeGlobal+='Seleccione Almacén';
        }

        if(mensajeGlobal!='')
        {
            animacionAlertaMensajeGeneral(mensajeGlobal, '#FF8F00');
            return;
        }

		$('#frmLogin').submit();
    }
</script>
</html>