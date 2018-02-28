<form id="frmCompraEntreFechas" class="formulario labelPequenio textAlignCenter">
    <div class="contenidoTop textAlignLeft">
        <label for="txtFechaInicial">Fecha inicio</label>
        <input type="date" id="txtFechaInicial" name="txtFechaInicial">
        <br>
        <label for="txtFechaFinal">Fecha fin</label>
        <input type="date" id="txtFechaFinal" name="txtFechaFinal">
    </div>
    <div class="seccionBotones bordeArriba">
        <input type="button" value="Ver reporte" onclick="enviarFrmCompraEntreFechas();">
    </div>
</form>
<script>
    function enviarFrmCompraEntreFechas()
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

        window.open('/APPSIVAK/public/reporte/compraentrefechas/'+$('#txtFechaInicial').val()+'/'+$('#txtFechaFinal').val(), '_blank');
    }
</script>