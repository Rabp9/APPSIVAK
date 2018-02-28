<form id="frmEditarPresentacion" action="/APPSIVAK/public/presentacion/editar" method="post" class="formulario labelMediano textAlignCenter">
    <div class="contenidoTop textAlignLeft">
        <input type="text" style="display: none;">
        <input type="hidden" id="txtCodigoPresentacion" name="txtCodigoPresentacion" value="{{{$tPresentacion->codigoPresentacion}}}">
        <label for="txtNombre">Nombre</label>
        <br>
        <input type="text" id="txtNombre" name="txtNombre" placeholder="Obligatorio" value="{{{$tPresentacion->nombre}}}">
        <br>
        <label for="txtDescripcion">Descripción</label>
        <br>
        <textarea name="txtDescripcion" id="txtDescripcion" cols="38" rows="5">{{{$tPresentacion->descripcion}}}</textarea>
    </div>
    <div class="seccionBotones bordeArriba">
        <input type="button" value="Guardar cambios" onclick="enviarFrmEditarPresentacion();">
    </div>
</form>
<script>
    function enviarFrmEditarPresentacion()
    {
        var mensajeGlobal='';

        mensajeGlobal+=(!valVacio($('#txtNombre').val())?'Complete el campo Nombre<br>':'');

        if(mensajeGlobal!='')
        {
            animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
            return;
        }

        if(confirm('Realmente desea editar la Presentación'))
        {       
            $('#frmEditarPresentacion').submit();
            return;
        }
        alert('Operación Cancelada');
    }
</script>