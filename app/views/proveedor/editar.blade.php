<form id="frmEditarProveedor" action="/APPSIVAK/public/proveedor/editar" method="post" class="formulario labelMediano textAlignCenter">
    <div class="contenidoTop textAlignLeft">
        <input type="hidden" id="txtCodigoProveedor" name="txtCodigoProveedor" value="{{{$tProveedor->codigoProveedor}}}">
        <label for="txtDocumentoIdentidad">Documento de Identidad</label>
        <input type="text" id="txtDocumentoIdentidad" name="txtDocumentoIdentidad" size="50" placeholder="Obligatorio" value="{{{$tProveedor->documentoIdentidad}}}">
        <br>
        <label for="txtNombre">Nombre</label>
        <input type="text" id="txtNombre" name="txtNombre" size="50" placeholder="Obligatorio" value="{{{$tProveedor->nombre}}}">
    </div>
    <div class="seccionBotones bordeArriba">
        <input type="button" value="Guardar cambios" onclick="enviarFrmEditarProveedor();">
    </div>
</form>
<script>
    function enviarFrmEditarProveedor()
    {
        var mensajeGlobal='';
            
        mensajeGlobal+=(!valVacio($('#txtDocumentoIdentidad').val())?'Complete el campo Documento de Identidad<br>':'');
        mensajeGlobal+=((!valRuc($('#txtDocumentoIdentidad').val()) && !valDni($('#txtDocumentoIdentidad').val()))?'Documento de identidad incorrecto. Ingrese DNI o RUC<br>':'');
        mensajeGlobal+=(!valVacio($('#txtNombre').val())?'Complete el campo Nombre<br>':'');

        if(mensajeGlobal!='')
        {
            animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
            return;
        }

        if(confirm('Realmente desea editar el Proveedor'))
        {       
            $('#frmEditarProveedor').submit();
            return;
        }
        alert('Operación Cancelada');
    }
</script>