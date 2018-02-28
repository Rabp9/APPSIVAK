<form id="frmEditarProveedorProducto" action="/APPSIVAK/public/proveedorproducto/editar" method="post" class="formulario labelMediano textAlignCenter">
    <div class="contenidoTop textAlignLeft">
    	<input type="text" style="display: none;">
        <input type="hidden" id="txtCodigoProveedorProducto" name="txtCodigoProveedorProducto" value="{{{$tProveedorProducto->codigoProveedorProducto}}}">
        <input type="hidden" id="txtCodigoProveedor" name="txtCodigoProveedor" value="{{{$tProveedorProducto->codigoProveedor}}}">
        <label for="txtNombre">Nombre del Producto</label>
        <input type="text" id="txtNombre" name="txtNombre" size="50" placeholder="Obligatorio" value="{{{$tProveedorProducto->nombre}}}">
        <br>
        <label for="txtDescripcion">Descripción</label>
        <textarea name="txtDescripcion" id="txtDescripcion" cols="55" rows="5">{{{$tProveedorProducto->descripcion}}}</textarea>
    </div>
    <div class="seccionBotones bordeArriba">
        <input type="button" value="Guardar cambios" onclick="enviarFrmEditarProveedorProducto();">
    </div>
</form>
<script>
    function enviarFrmEditarProveedorProducto()
    {
        var mensajeGlobal='';

        mensajeGlobal+=(!valVacio($('#txtNombre').val())?'Complete el campo Nombre de Producto<br>':'');

        if(mensajeGlobal!='')
        {
            animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
            return;
        }

        if(confirm('Realmente desea editar el producto del proveedor'))
        {        
            $('#frmEditarProveedorProducto').submit();
            return;
        }
        alert('Operación Cancelada');
    }
</script>