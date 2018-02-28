<form id="frmEditarClienteJuridicoRepresentante" action="/APPSIVAK/public/clientejuridicorepresentante/editar" method="post" class="formulario labelMediano textAlignCenter">
    <div class="contenidoTop textAlignLeft">
        <input type="hidden" id="txtCodigoClienteJuridicoRepresentante" name="txtCodigoClienteJuridicoRepresentante" value="{{{$tClienteJuridicoRepresentante->codigoClienteJuridicoRepresentante}}}">
        <input type="hidden" id="txtCodigoClienteJuridico" name="txtCodigoClienteJuridico" value="{{{$tClienteJuridicoRepresentante->codigoClienteJuridico}}}">
        <label for="txtDni">Dni</label>
        <input type="text" id="txtDni" name="txtDni" size="50" placeholder="Obligatorio" value="{{{$tClienteJuridicoRepresentante->dni}}}">
        <br>
        <label for="txtNombreCompleto">Nombre Completo</label>
        <input type="text" id="txtNombreCompleto" name="txtNombreCompleto" size="50" placeholder="Obligatorio" value="{{{$tClienteJuridicoRepresentante->nombreCompleto}}}">
        <br>
        <label for="txtCargo">Cargo</label>
        <input type="text" id="txtCargo" name="txtCargo" size="50" placeholder="Obligatorio" value="{{{$tClienteJuridicoRepresentante->cargo}}}">
        <br>
        <label for="txtCorreo">Correo</label>
        <input type="text" id="txtCorreo" name="txtCorreo" size="50" value="{{{$tClienteJuridicoRepresentante->correo}}}">
        <br>
        <label for="txtDomicilio">Domicilio</label>
        <input type="text" id="txtDomicilio" name="txtDomicilio" size="50" value="{{{$tClienteJuridicoRepresentante->domicilio}}}">
    </div>
    <div class="seccionBotones bordeArriba">
        <input type="button" value="Guardar cambios" onclick="enviarFrmEditarClienteJuridicoRepresentante();">
    </div>
</form>
<script>
    function enviarFrmEditarClienteJuridicoRepresentante()
    {
        var mensajeGlobal='';
        
        mensajeGlobal+=(!valDni($('#txtDni').val())?'Dni Incorrecto<br>':'');
        mensajeGlobal+=(!valVacio($('#txtNombreCompleto').val())?'Complete el campo Nombre<br>':'');
        mensajeGlobal+=(!valVacio($('#txtCargo').val())?'Complete el campo de Cargo<br>':'');

        if(mensajeGlobal!='')
        {
            animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
            return;
        }

        if(confirm('Realmente desea editar el Representante Jurídico'))
        {        
            $('#frmEditarClienteJuridicoRepresentante').submit();
            return;
        }
        alert('Operación Cancelada');
    }
</script>