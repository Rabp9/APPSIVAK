<form id="frmEditarReciboCompra" action="/APPSIVAK/public/recibocompra/editar" method="post" class="formulario labelMediano textAlignCenter">
    <div class="contenidoTop textAlignLeft">
        <input type="hidden" id="txtCodigoReciboCompra" name="txtCodigoReciboCompra" value="{{{$tReciboCompra->codigoReciboCompra}}}">
        <input type="hidden" id="txtTipoPago" name="txtTipoPago" value="{{{$tReciboCompra->tipoPago}}}">
        <h2>Datos para el comprobante</h2>
        <label for="cbxTipoRecibo">Tipo de comprobante</label>
        <select name="cbxTipoRecibo" id="cbxTipoRecibo" onchange="cambioCbxTipoRecibo();">
            <option value="Ninguno" {{{$tReciboCompra->tipoRecibo=='Ninguno'?"selected":''}}}>Ninguno</option>
            <option value="Recibo" {{{$tReciboCompra->tipoRecibo=='Recibo'?"selected":''}}}>Recibo</option>
            <option value="Boleta" {{{$tReciboCompra->tipoRecibo=='Boleta'?"selected":''}}}>Boleta</option>
            <option value="Factura" {{{$tReciboCompra->tipoRecibo=='Factura'?"selected":''}}}>Factura</option>
        </select>
        <br>
        <div id="divDatosAdicionalesRecibo" {{$tReciboCompra->tipoRecibo=='Ninguno' ? 'style="display: none;"' : ''}}>
            <label for="txtNumeroRecibo">Número de Comprobante</label>
            <input type="text" id="txtNumeroRecibo" name="txtNumeroRecibo" placeholder="Obligatorio" value="{{{$tReciboCompra->numeroRecibo}}}">
            <br>
            <label for="dateFechaComprobanteEmitido">Fecha de emisión del comprobante</label>
            <input type="date" id="dateFechaComprobanteEmitido" name="dateFechaComprobanteEmitido" value="{{{substr($tReciboCompra->fechaComprobanteEmitido, 0, 10)}}}">
            (Si no dispone de este dato, marque la fecha "11-11-1111")
            <br>
        </div>
        <h2>Datos generales</h2>
        <label for="txtDescripcion">Descripción de la compra</label>
        <textarea name="txtDescripcion" id="txtDescripcion" cols="55" rows="5">{{{$tReciboCompra->descripcion}}}</textarea>
    </div>
    <div class="seccionBotones bordeArriba">
        <input type="button" value="Guardar cambios" onclick="enviarFrmEditarReciboCompra();">
    </div>
</form>
<script>
    function cambioCbxTipoRecibo()
    {
        if($('#cbxTipoRecibo').val()=='Ninguno')
        {
            $('#divDatosAdicionalesRecibo').hide();
            $('#txtNumeroRecibo').val('');
            $('#dateFechaComprobanteEmitido').val('1111-11-11');
        }

        if($('#cbxTipoRecibo').val()!='Ninguno')
        {
            $('#divDatosAdicionalesRecibo').show();
        }
    }

    function enviarFrmEditarReciboCompra()
    {
        var mensajeGlobal='';

        mensajeGlobal+=(!valFechaYYYYMMDD($('#dateFechaComprobanteEmitido').val())?'Fecha de emisión del comprobante incorrecto<br>':'');

        if($('#cbxTipoRecibo').val()!='Ninguno')
        {
            mensajeGlobal+=(!valVacio($('#txtNumeroRecibo').val())?'Debe ingresar el número de comprobante<br>':'');
        }

        if(mensajeGlobal!='')
        {
            animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
            return;
        }

        $('#frmEditarReciboCompra').submit();
    }
</script>