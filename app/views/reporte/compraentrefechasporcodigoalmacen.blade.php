<form id="frmCompraEntreFechasPorCodigoAlmacen" class="formulario labelPequenio textAlignCenter">
    <div class="contenidoTop textAlignLeft">
        <label for="txtDescripcionAlmacen">Descripción de Almacén</label>
        <input type="text" id="txtDescripcionAlmacen" name="txtDescripcionAlmacen" size="40" placeholder="Obligatorio" readonly="readonly">
        <input type="button" id="btnBuscarAlmacen" value="Buscar Almacén" style="width: 200px;" onclick="ocultarDivsBuscar(); mostrarDivBuscar('divBuscarEnTablaAlmacen'); mostrarApartadoBuscar();">
        <input type="hidden" id="txtCodigoAlmacen" name="txtCodigoAlmacen" readonly="readonly">
        <br>
        <label for="txtFechaInicial">Fecha inicio</label>
        <input type="date" id="txtFechaInicial" name="txtFechaInicial">
        <br>
        <label for="txtFechaFinal">Fecha fin</label>
        <input type="date" id="txtFechaFinal" name="txtFechaFinal">
    </div>
    <div class="seccionBotones bordeArriba">
        <input type="button" value="Ver reporte" onclick="enviarFrmCompraEntreFechasPorCodigoAlmacen();">
    </div>
</form>
<script>
    function enviarFrmCompraEntreFechasPorCodigoAlmacen()
    {
        var mensajeGlobal='';

        mensajeGlobal+=(!valVacio($('#txtCodigoAlmacen').val())?'Debe seleccionar Almacén<br>':'');
        mensajeGlobal+=(!valFechaYYYYMMDD($("#txtFechaInicial").val())?"Fecha inicial incorrecto<br>":'');
        mensajeGlobal+=(!valFechaYYYYMMDD($("#txtFechaFinal").val())?"Fecha final incorrecto<br>":'');

        if(mensajeGlobal!='')
        {
            animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
            return;
        }

        $('#dialogo').dialog('close');

        window.open('/APPSIVAK/public/reporte/compraentrefechasporcodigoalmacen/'+$('#txtCodigoAlmacen').val()+'/'+$('#txtFechaInicial').val()+'/'+$('#txtFechaFinal').val(), '_blank');
    }
</script>