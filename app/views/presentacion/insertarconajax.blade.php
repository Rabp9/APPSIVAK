<form id="frmInsertarPresentacion" action="/APPSIVAK/public/presentacion/insertarconajax" method="post" class="formulario labelMediano textAlignCenter">
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
        <input type="button" value="Registrar" onclick="enviarFrmInsertarPresentacion();">
    </div>
</form>
<script>
    function enviarFrmInsertarPresentacion()
    {
        var mensajeGlobal='';
        
        mensajeGlobal+=(!valVacio($('#txtNombre').val())?'Complete el campo Nombre<br>':'');

        if(mensajeGlobal!='')
        {
            animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
            return;
        }

        if(confirm('Realmente desea registrar la Presentación'))
        {        
            paginaAjax('divPresentacionProducto', {txtNombre : $('#txtNombre').val(), txtDescripcion : $('#txtDescripcion').val()}, '/APPSIVAK/public/presentacion/insertarconajax', 'POST', $('#dialogo').dialog('close'), null, false, true);
            return;
        }
        alert('Operación Cancelada');
    }
</script>