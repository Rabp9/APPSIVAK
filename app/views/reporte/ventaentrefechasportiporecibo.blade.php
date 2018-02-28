<form id="frmVentaEntreFechas" class="formulario labelPequenio textAlignCenter">
    <div class="contenidoTop textAlignLeft">
        <label for="cbxTipoRecibo">Tipo de comprobante</label>
        <select name="cbxTipoRecibo" id="cbxTipoRecibo" class="select">
            <option value="Ticket">Ticket</option>
            <option value="Recibo">Recibo</option>
            <option value="Boleta">Boleta</option>
            <option value="Factura">Factura</option>
        </select>
        <br>
        <label for="txtFechaInicial">Fecha inicio</label>
        <input type="date" id="txtFechaInicial" name="txtFechaInicial">
        <br>
        <label for="txtFechaFinal">Fecha fin</label>
        <input type="date" id="txtFechaFinal" name="txtFechaFinal">
    </div>
    <div class="seccionBotones bordeArriba">
        <input type="button" value="Ver reporte" onclick="enviarFrmVentaEntreFechas();">
    </div>
</form>
<script>
    function enviarFrmVentaEntreFechas()
    {
        var mensajeGlobal='';

        mensajeGlobal+=(!valFechaYYYYMMDD($("#txtFechaInicial").val())?"Fecha inicial incorrecto<br>":'');
        mensajeGlobal+=(!valFechaYYYYMMDD($("#txtFechaFinal").val())?"Fecha final incorrecto<br>":'');

        if(mensajeGlobal!='')
        {
            animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
            return;
        }

        $('#dialogo').dialog('close');

        window.open('/APPSIVAK/public/reporte/ventaentrefechasportiporecibo/'+$('#txtFechaInicial').val()+'/'+$('#txtFechaFinal').val()+'/'+$('#cbxTipoRecibo').val(), '_blank');
    }
</script>