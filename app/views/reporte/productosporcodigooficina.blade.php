<form id="frmProductosPorOficina" class="formulario labelMediano textAlignCenter">
    <div class="contenidoTop textAlignLeft">
        <label for="txtDescripcionOficina">Descripción de Oficina</label>
        <input type="text" id="txtDescripcionOficina" name="txtDescripcionOficina" size="40" placeholder="Obligatorio" readonly="readonly">
        <input type="button" id="btnBuscarOficina" value="Buscar Oficina" style="width: 200px;" onclick="ocultarDivsBuscar(); mostrarDivBuscar('divBuscarEnTablaOficina'); mostrarApartadoBuscar();">
        <input type="hidden" id="txtCodigoOficina" name="txtCodigoOficina" readonly="readonly">
    </div>
    <div class="seccionBotones bordeArriba">
        <input type="button" value="Ver reporte" onclick="enviarFrmProductosPorOficina();">
    </div>
</form>
<script>
    function enviarFrmProductosPorOficina()
    {
        var mensajeGlobal='';

        mensajeGlobal+=(!valVacio($('#txtCodigoOficina').val())?'Debe seleccionar Oficina<br>':'');

        if(mensajeGlobal!='')
        {
            animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
            return;
        }

        $('#dialogo').dialog('close');

        window.open('/APPSIVAK/public/reporte/productosporcodigooficina/'+$('#txtCodigoOficina').val(), '_blank');
    }
</script>