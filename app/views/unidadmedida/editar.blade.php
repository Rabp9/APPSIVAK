<form id="frmEditarUnidadMedida" action="/APPSIVAK/public/unidadmedida/editar" method="post" class="formulario labelMediano textAlignCenter">
    <div class="contenidoTop textAlignLeft">
        <input type="text" style="display: none;">
        <input type="hidden" id="txtCodigoUnidadMedida" name="txtCodigoUnidadMedida" value="{{{$tUnidadMedida->codigoUnidadMedida}}}">
        <label for="txtNombre">Nombre</label>
        <br>
        <input type="text" id="txtNombre" name="txtNombre" placeholder="Obligatorio" value="{{{$tUnidadMedida->nombre}}}">
        <br>
        <label for="txtDescripcion">Descripción</label>
        <br>
        <textarea name="txtDescripcion" id="txtDescripcion" cols="38" rows="5">{{{$tUnidadMedida->descripcion}}}</textarea>
    </div>
    <div class="seccionBotones bordeArriba">
        <input type="button" value="Guardar cambios" onclick="enviarFrmEditarUnidadMedida();">
    </div>
</form>
<script>
    function enviarFrmEditarUnidadMedida()
    {
        var mensajeGlobal='';

        mensajeGlobal+=(!valVacio($('#txtNombre').val())?'Complete el campo Nombre<br>':'');

        if(mensajeGlobal!='')
        {
            animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
            return;
        }

        if(confirm('Realmente desea editar la Unidad de Medida'))
        {       
            $('#frmEditarUnidadMedida').submit();
            return;
        }
        alert('Operación Cancelada');
    }
</script>