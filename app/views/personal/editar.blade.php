<form id="frmEditarPersonal" action="/APPSIVAK/public/personal/editar" method="post" class="formulario labelMediano textAlignCenter">
    <div class="contenidoTop textAlignLeft">
        <input type="hidden" id="txtCodigoPersonal" name="txtCodigoPersonal" value="{{{$tPersonal->codigoPersonal}}}">
        <label for="txtDni">Dni</label>
        <input type="text" id="txtDni" name="txtDni" size="50" placeholder="Obligatorio" value="{{{$tPersonal->dni}}}">
        <br>
        <label for="txtNombre">Nombre</label>
        <input type="text" id="txtNombre" name="txtNombre" size="50" placeholder="Obligatorio" value="{{{$tPersonal->nombre}}}">
        <br>
        <label for="txtApellidoPaterno">Apellido Paterno</label>
        <input type="text" id="txtApellidoPaterno" name="txtApellidoPaterno" size="50" placeholder="Obligatorio" value="{{{$tPersonal->apellidoPaterno}}}">
        <br>
        <label for="txtApellidoMaterno">Apellido Materno</label>
        <input type="text" id="txtApellidoMaterno" name="txtApellidoMaterno" size="50" placeholder="Obligatorio" value="{{{$tPersonal->apellidoMaterno}}}">
        <br>
        <label for="txtSeguridadSocial">Seguridad Social</label>
        <input type="text" id="txtSeguridadSocial" name="txtSeguridadSocial" size="50" value="{{{$tPersonal->seguridadSocial}}}">
        <br>
        <label for="txtPais">País</label>
        <input type="text" id="txtPais" name="txtPais" size="50" value="{{{$tPersonal->pais}}}">
        <br>
        <label for="txtDepartamento">Departamento</label>
        <input type="text" id="txtDepartamento" name="txtDepartamento" size="50" value="{{{$tPersonal->departamento}}}">
        <br>
        <label for="txtProvincia">Provincia</label>
        <input type="text" id="txtProvincia" name="txtProvincia" size="50" value="{{{$tPersonal->provincia}}}">
        <br>
        <label for="txtDistrito">Distrito</label>
        <input type="text" id="txtDistrito" name="txtDistrito" size="50" value="{{{$tPersonal->distrito}}}">
        <br>
        <label for="txtDireccion">Direción</label>
        <input type="text" id="txtDireccion" name="txtDireccion" size="50" value="{{{$tPersonal->direccion}}}">
        <br>
        <label for="txtManzana">Manzana</label>
        <input type="text" id="txtManzana" name="txtManzana" size="50" value="{{{$tPersonal->manzana}}}">
        <br>
        <label for="txtLote">Lote</label>
        <input type="text" id="txtLote" name="txtLote" size="50" value="{{{$tPersonal->lote}}}">
        <br>
        <label for="txtNumeroVivienda">Nº Vivienda</label>
        <input type="text" id="txtNumeroVivienda" name="txtNumeroVivienda" size="50" value="{{{$tPersonal->numeroVivienda}}}">
        <br>
        <label for="txtNumeroInterior">Nº Interior</label>
        <input type="text" id="txtNumeroInterior" name="txtNumeroInterior" size="50" value="{{{$tPersonal->numeroInterior}}}">
        <br>
        <label for="txtTelefono">Teléfono</label>
        <input type="text" id="txtTelefono" name="txtTelefono" size="50" value="{{{$tPersonal->telefono}}}">
        <br>
        <label>Estado Civil</label>
        <div class="contenidoMiddle">
            <input type="radio" id="radioEstadoCivilSoltero" name="radioEstadoCivil" value="S" {{{$tPersonal->estadoCivil=='S' ? 'checked="checked"' : ''}}}>
            <label class="noLabel" for="radioEstadoCivilSoltero">Soltero</label>
            <input type="radio" id="radioEstadoCivilCasado" name="radioEstadoCivil" value="C" {{{$tPersonal->estadoCivil=='C' ? 'checked="checked"' : ''}}}>
            <label class="noLabel" for="radioEstadoCivilCasado">Casado</label>
        </div>
        <br>
        <label>Sexo</label>
        <div class="contenidoMiddle">
            <input type="radio" id="radioSexoMasculino" name="radioSexo" value="0" {{{$tPersonal->sexo=='0' ? 'checked="checked"' : ''}}}>
            <label class="noLabel" for="radioSexoMasculino">Masculino</label>
            <input type="radio" id="radioSexoFemenino" name="radioSexo" value="1" {{{$tPersonal->sexo=='1' ? 'checked="checked"' : ''}}}>
            <label class="noLabel" for="radioSexoFemenino">Femenino</label>
        </div>
        <br>
        <label for="txtFechaNacimiento">Fecha de Nacimiento</label>
        <input type="date" id="txtFechaNacimiento" name="txtFechaNacimiento" value="{{{$tPersonal->fechaNacimiento}}}">
        <br>
        <label for="txtCorreo">E-mail</label>
        <input type="text" id="txtCorreo" name="txtCorreo" size="50" value="{{{$tPersonal->correo}}}">
        <br>
        <label for="txtGrupoSanguineo">Grupo Sanguíneo</label>
        <input type="text" id="txtGrupoSanguineo" name="txtGrupoSanguineo" size="50" value="{{{$tPersonal->grupoSanguineo}}}">
        <br>
        <label for="cbxTipoEmpleado">Empleado</label>
        <select name="cbxTipoEmpleado" id="cbxTipoEmpleado" style="width: 191px;">
            <option value="Contratado" {{{$tPersonal->tipoEmpleado=='Contratado' ? 'selected' : ''}}}>Contratado</option>
            <option value="Nombrado" {{{$tPersonal->tipoEmpleado=='Nombrado' ? 'selected' : ''}}}>Nombrado</option>
        </select>
        <br>
        <label for="txtCargo">Cargo en la Empresa</label>
        <input type="text" id="txtCargo" name="txtCargo" size="50" value="{{{$tPersonal->cargo}}}">
    </div>
    <div class="seccionBotones bordeArriba">
        <input type="button" value="Guardar cambios" onclick="enviarFrmEditarPersonal();">
    </div>
</form>
<script>
    function enviarFrmEditarPersonal()
    {
        var mensajeGlobal='';
                        
        mensajeGlobal+=(!valDni($('#txtDni').val())?'Dni Incorrecto<br>':'');
        mensajeGlobal+=(!valVacio($('#txtNombre').val())?'Complete el campo Nombre<br>':'');
        mensajeGlobal+=(!valVacio($('#txtApellidoPaterno').val())?'Complete el campo Apellido Paterno<br>':'');
        mensajeGlobal+=(!valVacio($('#txtApellidoMaterno').val())?'Complete el campo Apellido Materno<br>':'');
        mensajeGlobal+=(!valEmail($('#txtCorreo').val())?'Email Incorrecto<br>':'');
        mensajeGlobal+=(!valFechaYYYYMMDD($('#txtFechaNacimiento').val())?'Fecha de nacimiento incorrecto<br>':'');

        if(mensajeGlobal!='')
        {
            animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
            return;
        }

        if(confirm('Realmente desea editar el Personal'))
        {        
            $('#frmEditarPersonal').submit();
            return;
        }
        alert('Operación Cancelada');
    }
</script>