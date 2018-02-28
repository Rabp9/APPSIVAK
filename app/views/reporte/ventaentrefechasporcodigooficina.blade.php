<form id="frmVentaEntreFechasPorCodigoOficina" class="formulario labelPequenio textAlignCenter">
    <div class="contenidoTop textAlignLeft">
        <label for="txtDescripcionOficina">Descripción de Oficina</label>
        <input type="text" id="txtDescripcionOficina" name="txtDescripcionOficina" size="40" placeholder="Obligatorio" readonly="readonly">
        <input type="button" id="btnBuscarOficina" value="Buscar Oficina" style="width: 200px;" onclick="ocultarDivsBuscar(); mostrarDivBuscar('divBuscarEnTablaOficina'); mostrarApartadoBuscar();">
        <input type="hidden" id="txtCodigoOficina" name="txtCodigoOficina" readonly="readonly">
        <br>
        <label for="txtFechaInicial">Fecha inicio</label>
        <input type="date" id="txtFechaInicial" name="txtFechaInicial">
        <br>
        <label for="txtFechaFinal">Fecha fin</label>
        <input type="date" id="txtFechaFinal" name="txtFechaFinal">
    </div>
    <div class="seccionBotones bordeArriba">
        <input type="button" value="Ver reporte" onclick="enviarFrmVentaEntreFechasPorCodigoOficina();">
    </div>
</form>
<script>
    function enviarFrmVentaEntreFechasPorCodigoOficina()
    {
        var mensajeGlobal='';

        mensajeGlobal+=(!valVacio($('#txtCodigoOficina').val())?'Debe seleccionar Oficina<br>':'');
        mensajeGlobal+=(!valFechaYYYYMMDD($("#txtFechaInicial").val())?"Fecha inicial incorrecto<br>":'');
        mensajeGlobal+=(!valFechaYYYYMMDD($("#txtFechaFinal").val())?"Fecha final incorrecto<br>":'');

        if(mensajeGlobal!='')
        {
            animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
            return;
        }

        $('#dialogo').dialog('close');

        window.open('/APPSIVAK/public/reporte/ventaentrefechasporcodigooficina/'+$('#txtCodigoOficina').val()+'/'+$('#txtFechaInicial').val()+'/'+$('#txtFechaFinal').val(), '_blank');
    }
</script>