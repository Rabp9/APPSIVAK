<form id="frmProductosPorAlmacen" class="formulario labelMediano textAlignCenter">
    <div class="contenidoTop textAlignLeft">
        <label for="txtDescripcionAlmacen">Descripción de Almacén</label>
        <input type="text" id="txtDescripcionAlmacen" name="txtDescripcionAlmacen" size="40" placeholder="Obligatorio" readonly="readonly">
        <input type="button" id="btnBuscarAlmacen" value="Buscar Almacén" style="width: 200px;" onclick="ocultarDivsBuscar(); mostrarDivBuscar('divBuscarEnTablaAlmacen'); mostrarApartadoBuscar();">
        <input type="hidden" id="txtCodigoAlmacen" name="txtCodigoAlmacen" readonly="readonly">
    </div>
    <div class="seccionBotones bordeArriba">
        <input type="button" value="Ver reporte" onclick="enviarFrmProductosPorAlmacen();">
    </div>
</form>
<script>
    function enviarFrmProductosPorAlmacen()
    {
        var mensajeGlobal='';

        mensajeGlobal+=(!valVacio($('#txtCodigoAlmacen').val())?'Debe seleccionar Almacén<br>':'');

        if(mensajeGlobal!='')
        {
            animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
            return;
        }

        $('#dialogo').dialog('close');

        window.open('/APPSIVAK/public/reporte/productosporcodigoalmacen/'+$('#txtCodigoAlmacen').val(), '_blank');
    }
</script>