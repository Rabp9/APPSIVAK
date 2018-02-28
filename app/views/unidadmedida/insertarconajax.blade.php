<form id="frmInsertarUnidadMedida" action="/APPSIVAK/public/unidadmedida/insertarconajax" method="post" class="formulario labelMediano textAlignCenter">
    <div class="contenidoTop textAlignLeft">
        <input type="text" style="display: none;">
        <label for="txtNombre">Nombre</label>
        <br>
        <input type="text" id="txtNombre" name="txtNombre" placeholder="Obligatorio">
        <br>
        <label for="txtDescripcion">Descripción</label>
        <br>
        <textarea name="txtDescripcion" id="txtDescripcion" cols="38" rows="5"></textarea>
    </div>
    <div class="seccionBotones bordeArriba">
        <input type="button" value="Registrar" onclick="enviarFrmInsertarUnidadMedida();">
    </div>
</form>
<script>
    function enviarFrmInsertarUnidadMedida()
    {
        var mensajeGlobal='';
        
        mensajeGlobal+=(!valVacio($('#txtNombre').val())?'Complete el campo Nombre<br>':'');

        if(mensajeGlobal!='')
        {
            animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
            return;
        }

        if(confirm('Realmente desea registrar la Unidad de medida'))
        {        
            paginaAjax('divUnidadMedidaProducto', {txtNombre : $('#txtNombre').val(), txtDescripcion : $('#txtDescripcion').val()}, '/APPSIVAK/public/unidadmedida/insertarconajax', 'POST', $('#dialogo').dialog('close'), null, false, true);
            return;
        }
        alert('Operación Cancelada');
    }
</script>