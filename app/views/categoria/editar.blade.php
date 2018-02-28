<form id="frmEditarCategoria" action="/APPSIVAK/public/categoria/editar" method="post" class="formulario labelMediano textAlignCenter">
    <div class="contenidoTop textAlignLeft">
        <input type="text" style="display: none;">
        <input type="hidden" id="txtCodigoCategoria" name="txtCodigoCategoria" value="{{{$tCategoria->codigoCategoria}}}">
        <label for="txtNombre">Nombre</label>
        <br>
        <input type="text" id="txtNombre" name="txtNombre" placeholder="Obligatorio" value="{{{$tCategoria->nombre}}}">
        <br>
        <label for="txtDescripcion">Descripción</label>
        <br>
        <textarea name="txtDescripcion" id="txtDescripcion" cols="38" rows="5">{{{$tCategoria->descripcion}}}</textarea>
    </div>
    <div class="seccionBotones bordeArriba">
        <input type="button" value="Guardar cambios" onclick="enviarFrmEditarCategoria();">
    </div>
</form>
<script>
    function enviarFrmEditarCategoria()
    {
        var mensajeGlobal='';
            
        mensajeGlobal+=(!valVacio($('#txtNombre').val())?'Complete el campo Nombre<br>':'');

        if($('#txtNombre').val().indexOf(',')!=-1)
        {
            mensajeGlobal+='No se permiten comas (,) en el nombre<br>';
        }

        if(mensajeGlobal!='')
        {
            animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
            return;
        }

        if(confirm('Realmente desea editar los Datos'))
        {       
            $('#frmEditarCategoria').submit();
            return;
        }
        alert('Operación Cancelada');
    }
</script>