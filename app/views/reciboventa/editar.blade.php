<form id="frmEditarReciboVenta" action="/APPSIVAK/public/reciboventa/editar" method="post" class="formulario labelMediano textAlignCenter">
    <div class="contenidoTop textAlignLeft">
        <input type="hidden" id="txtCodigoReciboVenta" name="txtCodigoReciboVenta" value="{{{$tReciboVenta->codigoReciboVenta}}}">
        <input type="hidden" id="txtTipoPago" name="txtTipoPago" value="{{{$tReciboVenta->tipoPago}}}">
        <h2>Datos para el comprobante</h2>
        <label for="cbxTipoRecibo">Tipo de comprobante</label>
        <select name="cbxTipoRecibo" id="cbxTipoRecibo" onchange="onChangeCbxTipoRecibo();">
            <option value="Ticket" {{{$tReciboVenta->tipoRecibo=='Ticket'?"selected":''}}}>Ticket</option>
            <option value="Recibo" {{{$tReciboVenta->tipoRecibo=='Recibo'?"selected":''}}}>Recibo</option>
            <option value="Boleta" {{{$tReciboVenta->tipoRecibo=='Boleta'?"selected":''}}}>Boleta</option>
            <option value="Factura" {{{$tReciboVenta->tipoRecibo=='Factura'?"selected":''}}}>Factura</option>
        </select>
        <div id="divDatosAdicionalesComprobante" style="display: none;">
            <label for="txtNumeroRecibo">Número de comprobante</label>
            <input type="text" id="txtNumeroRecibo" class="text" name="txtNumeroRecibo" size="50" autocomplete="off" placeholder="Obligatorio para venta al contado" value="{{{$tReciboVenta->numeroRecibo}}}">
            <br>
            <label class="contenidoMiddle">Comprobante emitido</label>
            <div class="contenidoMiddle">
                <input type="radio" id="radioComprobanteEmitidoSi" name="radioComprobanteEmitido" value="Si" {{{($tReciboVenta->comprobanteEmitido) ? "checked='checked'" : ''}}}>
                <label class="noLabel" for="radioComprobanteEmitidoSi">Si</label>
                <br>
                <input type="radio" id="radioComprobanteEmitidoNo" name="radioComprobanteEmitido" value="No" {{{!($tReciboVenta->comprobanteEmitido) ? "checked='checked'" : ''}}}>
                <label class="noLabel" for="radioComprobanteEmitidoNo">No</label>
            </div>
            <br>
            <label for="dateFechaComprobanteEmitido">Fecha de emisión del comprobante</label>
            <input type="date" id="dateFechaComprobanteEmitido" name="dateFechaComprobanteEmitido" value="{{{substr($tReciboVenta->fechaComprobanteEmitido, 0, 10)}}}">
            <br>
        </div>
        <br>
        <label for="txtDocumentoCliente">Documento del cliente</label>
        <input type="text" id="txtDocumentoCliente" name="txtDocumentoCliente" size="50" value="{{{$tReciboVenta->documentoCliente}}}">
        <br>
        <label for="txtNombreCompletoCliente">Nombre completo del cliente</label>
        <input type="text" id="txtNombreCompletoCliente" name="txtNombreCompletoCliente" size="50" value="{{{$tReciboVenta->nombreCompletoCliente}}}">
        <br>
        <label for="txtDireccionCliente">Dirección del cliente</label>
        <input type="text" id="txtDireccionCliente" name="txtDireccionCliente" size="50" value="{{{$tReciboVenta->direccionCliente}}}">
        <h2>Datos para la guía de remisión</h2>
        <label for="txtDocumentoReceptor">Documento del receptor</label>
        <input type="text" id="txtDocumentoReceptor" name="txtDocumentoReceptor" size="50" value="{{{$tReciboVenta->documentoReceptor}}}">
        <br>
        <label for="txtNombreCompletoReceptor">Nombre completo del receptor</label>
        <input type="text" id="txtNombreCompletoReceptor" name="txtNombreCompletoReceptor" size="50" value="{{{$tReciboVenta->nombreCompletoReceptor}}}">
        <br>
        <label for="txtDireccionEnvioReceptor">Dirección del receptor</label>
        <input type="text" id="txtDireccionEnvioReceptor" name="txtDireccionEnvioReceptor" size="50" value="{{{$tReciboVenta->direccionEnvioReceptor}}}">
        <br>
        <label for="txtFlete">Flete</label>
        <input type="text" id="txtFlete" name="txtFlete" size="50" value="{{{$tReciboVenta->flete}}}">
        <br>
        <label for="txtDocumentoTransportista">Dni o Ruc del transportista</label>
        <input type="text" id="txtDocumentoTransportista" name="txtDocumentoTransportista" size="50" class="textDocumento" placeholder="00000000[00]" value="{{{$tReciboVenta->documentoTransportista}}}">
        <br>
        <label for="txtNombreCompletoTransportista">Nombre/razón-social del transportista</label>
        <input type="text" id="txtNombreCompletoTransportista" name="txtNombreCompletoTransportista" size="50" class="textDocumento" value="{{{$tReciboVenta->nombreCompletoTransportista}}}">
        <br>
        <label for="txtMarcaPlacaAutoMovilTransportista">Marca y/o placa automovil del transportista</label>
        <input type="text" id="txtMarcaPlacaAutoMovilTransportista" name="txtMarcaPlacaAutoMovilTransportista" size="50" class="textDocumento" value="{{{$tReciboVenta->marcaPlacaAutoMovilTransportista}}}">
        <br>
        <label for="txtLicenciaConducirTransportista">Licencia de conducir del transportista</label>
        <input type="text" id="txtLicenciaConducirTransportista" name="txtLicenciaConducirTransportista" size="50" class="textDocumento" value="{{{$tReciboVenta->licenciaConducirTransportista}}}">
        <h2>Datos generales</h2>
        <label for="txtDescripcion">Descripción de la venta</label>
        <textarea name="txtDescripcion" id="txtDescripcion" cols="55" rows="5">{{{$tReciboVenta->descripcion}}}</textarea>
    </div>
    <div class="seccionBotones bordeArriba">
        <input type="button" value="Guardar cambios" onclick="enviarFrmEditarReciboVenta();">
    </div>
</form>
<script>
    function onChangeCbxTipoRecibo()
    {
        if($('#cbxTipoRecibo').val()=='Boleta' || $('#cbxTipoRecibo').val()=='Factura')
        {
            $('#divDatosAdicionalesComprobante').show();
        }
        else
        {
            $('#divDatosAdicionalesComprobante').hide();
            $('#txtNumeroRecibo').val('');
            $('#dateFechaComprobanteEmitido').val('1111-11-11');
        }
    }

    onChangeCbxTipoRecibo();

    function enviarFrmEditarReciboVenta()
    {
        var mensajeGlobal='';

        mensajeGlobal+=(!valFechaYYYYMMDD($('#dateFechaComprobanteEmitido').val())?'Fecha de emisión del comprobante incorrecto<br>':'');

        if($('#txtDocumentoReceptor').val().trim()!='' || $('#txtNombreCompletoReceptor').val().trim()!='' || $('#txtDireccionEnvioReceptor').val().trim()!='')
        {
            mensajeGlobal+=!(valDni($('#txtDocumentoReceptor').val()) || valRuc($('#txtDocumentoReceptor').val()))?'Documento del receptor incorrecto<br>':'';
            mensajeGlobal+=!valVacio($('#txtNombreCompletoReceptor').val())?'Debe completar el campo Nombre completo del receptor<br>':'';
            mensajeGlobal+=!valVacio($('#txtDireccionEnvioReceptor').val())?'Debe completar el campo Dirección del receptor<br>':'';
        }

        if($('#txtDocumentoTransportista').val().trim()!='')
        {
            mensajeGlobal+=!(valDni($('#txtDocumentoTransportista').val()) || valRuc($('#txtDocumentoTransportista').val()))?'Campo Dni o Ruc del transportista incorrecto<br>':'';
        }

        mensajeGlobal+=!valDosDecimales($('#txtFlete').val())?'El flete debe ser en soles<br>':'';

        if($('#txtTipoPago').val()=='Al Crédito')
        {
            if($('#cbxTipoRecibo').val()=='Factura')
            {
                mensajeGlobal+=!valRuc($('#txtDocumentoCliente').val())?'Documento del cliente incorrecto<br>':'';
            }
            if($('#cbxTipoRecibo').val()=='Boleta')
            {
                mensajeGlobal+=!valDni($('#txtDocumentoCliente').val())?'Documento del cliente incorrecto<br>':'';
            }

            mensajeGlobal+=!valVacio($('#txtNombreCompletoCliente').val())?'Debe completar el campo Nombre completo del cliente<br>':'';
            mensajeGlobal+=!valVacio($('#txtDireccionCliente').val())?'Debe completar el campo Dirección del cliente<br>':'';
        }
        else
        {
            if($('#cbxTipoRecibo').val()=='Factura')
            {
                mensajeGlobal+=!valRuc($('#txtDocumentoCliente').val())?'Documento del cliente incorrecto<br>':'';
                mensajeGlobal+=!valVacio($('#txtNombreCompletoCliente').val())?'Debe completar el campo Nombre completo del cliente<br>':'';
            }
            else
            {
                if($('#txtDocumentoCliente').val().trim()!='')
                {
                    mensajeGlobal+=!valDni($('#txtDocumentoCliente').val())?'Documento del cliente incorrecto<br>':'';
                }
            }
        }

        if(($('#cbxTipoRecibo').val()=='Boleta' || $('#cbxTipoRecibo').val()=='Factura') && $('#txtTipoPago').val()=='Al Contado')
        {
            mensajeGlobal+=!valVacio($('#txtNumeroRecibo').val())?'Debe completar el campo Número de comprobante<br>':'';
        }

        if(mensajeGlobal!='')
        {
            animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
            return;
        }

        $('#frmEditarReciboVenta').submit();
    }
</script>