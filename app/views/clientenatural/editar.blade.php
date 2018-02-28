<form id="frmEditarClienteNatural" action="/APPSIVAK/public/clientenatural/editar" method="post" class="formulario labelMediano textAlignCenter">
    <div class="contenidoTop textAlignLeft">
        <input type="hidden" id="txtCodigoClienteNatural" name="txtCodigoClienteNatural" value="{{{$tClienteNatural->codigoClienteNatural}}}">
        <label for="txtDni">Dni</label>
        <input type="text" id="txtDni" name="txtDni" size="50" placeholder="Obligatorio" value="{{{$tClienteNatural->dni}}}">
        <br>
        <label for="txtNombre">Nombre</label>
        <input type="text" id="txtNombre" name="txtNombre" size="50" placeholder="Obligatorio" value="{{{$tClienteNatural->nombre}}}">
        <br>
        <label for="txtApellidoPaterno">Apellido Paterno</label>
        <input type="text" id="txtApellidoPaterno" name="txtApellidoPaterno" size="50" placeholder="Obligatorio" value="{{{$tClienteNatural->apellidoPaterno}}}">
        <br>
        <label for="txtApellidoMaterno">Apellido Materno</label>
        <input type="text" id="txtApellidoMaterno" name="txtApellidoMaterno" size="50" placeholder="Obligatorio" value="{{{$tClienteNatural->apellidoMaterno}}}">
        <br>
        <label for="txtPais">País</label>
        <input type="text" id="txtPais" name="txtPais" size="50" value="{{{$tClienteNatural->pais}}}">
        <br>
        <label for="txtDepartamento">Departamento</label>
        <input type="text" id="txtDepartamento" name="txtDepartamento" size="50" value="{{{$tClienteNatural->departamento}}}">
        <br>
        <label for="txtProvincia">Provincia</label>
        <input type="text" id="txtProvincia" name="txtProvincia" size="50" value="{{{$tClienteNatural->provincia}}}">
        <br>
        <label for="txtDistrito">Distrito</label>
        <input type="text" id="txtDistrito" name="txtDistrito" size="50" value="{{{$tClienteNatural->distrito}}}">
        <br>
        <label for="txtDireccion">Direción</label>
        <input type="text" id="txtDireccion" name="txtDireccion" size="50" value="{{{$tClienteNatural->direccion}}}">
        <br>
        <label for="txtManzana">Manzana</label>
        <input type="text" id="txtManzana" name="txtManzana" size="50" value="{{{$tClienteNatural->manzana}}}">
        <br>
        <label for="txtLote">Lote</label>
        <input type="text" id="txtLote" name="txtLote" size="50" value="{{{$tClienteNatural->lote}}}">
        <br>
        <label for="txtNumeroVivienda">Nº Vivienda</label>
        <input type="text" id="txtNumeroVivienda" name="txtNumeroVivienda" size="50" value="{{{$tClienteNatural->numeroVivienda}}}">
        <br>
        <label for="txtNumeroInterior">Nº Interior</label>
        <input type="text" id="txtNumeroInterior" name="txtNumeroInterior" size="50" value="{{{$tClienteNatural->numeroInterior}}}">
        <br>
        <label for="txtTelefono">Teléfono</label>
        <input type="text" id="txtTelefono" name="txtTelefono" size="50" value="{{{$tClienteNatural->telefono}}}">
        <br>
        <label>Sexo</label>
        <div class="contenidoMiddle">
            <input type="radio" id="radioSexoMasculino" name="radioSexo" value="0" {{{$tClienteNatural->sexo=='0' ? 'checked="checked"' : ''}}}>
            <label class="noLabel" for="radioSexoMasculino">Masculino</label>
            <input type="radio" id="radioSexoFemenino" name="radioSexo" value="1" {{{$tClienteNatural->sexo=='1' ? 'checked="checked"' : ''}}}>
            <label class="noLabel" for="radioSexoFemenino">Femenino</label>
        </div>
        <br>
        <label for="txtCorreo">E-mail</label>
        <input type="text" id="txtCorreo" name="txtCorreo" size="50" value="{{{$tClienteNatural->correo}}}">
        <br>
        <label for="txtFechaNacimiento">Fecha de Nacimiento</label>
        <input type="date" id="txtFechaNacimiento" name="txtFechaNacimiento" value="{{{$tClienteNatural->fechaNacimiento}}}">
    </div>
    <div class="seccionBotones bordeArriba">
        <input type="button" value="Guardar cambios" onclick="enviarFrmEditarClienteNatural();">
    </div>
</form>
<script>
    function enviarFrmEditarClienteNatural()
    {
        var mensajeGlobal='';
        
        mensajeGlobal+=(!valDni($('#txtDni').val())?'Dni Incorrecto<br>':'');
        mensajeGlobal+=(!valVacio($('#txtNombre').val())?'Complete el campo de Nombre<br>':'');
        mensajeGlobal+=(!valVacio($('#txtApellidoPaterno').val())?'Complete el campo de Apellido Paterno<br>':'');
        mensajeGlobal+=(!valVacio($('#txtApellidoMaterno').val())?'Complete el campo de Apellido Materno<br>':'');
        mensajeGlobal+=(!valEmail($('#txtCorreo').val())?'E-mail Incorrecto<br>':'');
        mensajeGlobal+=(!valFechaYYYYMMDD($('#txtFechaNacimiento').val())?'Fecha de Nacimiento Incorrecto<br>':'');

        if(mensajeGlobal!='')
        {
            animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
            return;
        }

        if(confirm('Realmente desea editar el Cliente'))
        {        
            $('#frmEditarClienteNatural').submit();
            return;
        }
        alert('Operación Cancelada');
    }
</script>