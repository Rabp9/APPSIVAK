@extends('layout.layout')

@section('contenidoCuerpo')
    <h2 class="textAlignRight bordeAbajo tituloCabecera">REGISTRAR PERSONAL</h2>
    <section class="contenidoTop">
        <form id="frmInsertarPersonal" action="/APPSIVAK/public/personal/insertar" method="post" class="formulario labelMediano">
            <div class="contenidoTop textAlignLeft">
                <h2 class="bordeAbajo">Datos del personal</h2>
                <label for="txtDni">Dni</label>
                <input type="text" id="txtDni" name="txtDni" size="50" placeholder="Obligatorio" value="{{{isset($txtDni)?$txtDni:''}}}">
                <br>
                <label for="txtNombre">Nombre</label>
                <input type="text" id="txtNombre" name="txtNombre" size="50" placeholder="Obligatorio" value="{{{isset($txtNombre)?$txtNombre:''}}}">
                <br>
                <label for="txtApellidoPaterno">Apellido Paterno</label>
                <input type="text" id="txtApellidoPaterno" name="txtApellidoPaterno" size="50" placeholder="Obligatorio" value="{{{isset($txtApellidoPaterno)?$txtApellidoPaterno:''}}}">
                <br>
                <label for="txtApellidoMaterno">Apellido Materno</label>
                <input type="text" id="txtApellidoMaterno" name="txtApellidoMaterno" size="50" placeholder="Obligatorio" value="{{{isset($txtApellidoMaterno)?$txtApellidoMaterno:''}}}">
                <br>
                <label for="txtSeguridadSocial">Seguridad Social</label>
                <input type="text" id="txtSeguridadSocial" name="txtSeguridadSocial" size="50" value="{{{isset($txtSeguridadSocial)?$txtSeguridadSocial:''}}}">
                <br>
                <label for="txtPais">País</label>
                <input type="text" id="txtPais" name="txtPais" size="50" value="{{{isset($txtPais)?$txtPais:''}}}">
                <br>
                <label for="txtDepartamento">Departamento</label>
                <input type="text" id="txtDepartamento" name="txtDepartamento" size="50" value="{{{isset($txtDepartamento)?$txtDepartamento:''}}}">
                <br>
                <label for="txtProvincia">Provincia</label>
                <input type="text" id="txtProvincia" name="txtProvincia" size="50" value="{{{isset($txtProvincia)?$txtProvincia:''}}}">
                <br>
                <label for="txtDistrito">Distrito</label>
                <input type="text" id="txtDistrito" name="txtDistrito" size="50" value="{{{isset($txtDistrito)?$txtDistrito:''}}}">
                <br>
                <label for="txtDireccion">Direción</label>
                <input type="text" id="txtDireccion" name="txtDireccion" size="50" value="{{{isset($txtDireccion)?$txtDireccion:''}}}">
                <br>
                <label for="txtManzana">Manzana</label>
                <input type="text" id="txtManzana" name="txtManzana" size="50" value="{{{isset($txtManzana)?$txtManzana:''}}}">
                <br>
                <label for="txtLote">Lote</label>
                <input type="text" id="txtLote" name="txtLote" size="50" value="{{{isset($txtLote)?$txtLote:''}}}">
                <br>
                <label for="txtNumeroVivienda">Nº Vivienda</label>
                <input type="text" id="txtNumeroVivienda" name="txtNumeroVivienda" size="50" value="{{{isset($txtNumeroVivienda)?$txtNumeroVivienda:''}}}">
                <br>
                <label for="txtNumeroInterior">Nº Interior</label>
                <input type="text" id="txtNumeroInterior" name="txtNumeroInterior" size="50" value="{{{isset($txtNumeroInterior)?$txtNumeroInterior:''}}}">
                <br>
                <label for="txtTelefono">Teléfono</label>
                <input type="text" id="txtTelefono" name="txtTelefono" size="50" value="{{{isset($txtTelefono)?$txtTelefono:''}}}">
                <br>
                <label>Estado Civil</label>
                <div class="contenidoMiddle">
                    <input type="radio" id="radioEstadoCivilSoltero" name="radioEstadoCivil" value="S" {{{isset($radioEstadoCivil) && $radioEstadoCivil=='S'?"checked='checked'":''}}} {{{!isset($radioEstadoCivil)?"checked='checked'":''}}}>
                    <label class="noLabel" for="radioEstadoCivilSoltero">Soltero</label>
                    <input type="radio" id="radioEstadoCivilCasado" name="radioEstadoCivil" value="C" {{{isset($radioEstadoCivil) && $radioEstadoCivil=='C'?"checked='checked'":''}}}>
                    <label class="noLabel" for="radioEstadoCivilCasado">Casado</label>
                </div>
                <br>
                <label>Sexo</label>
                <div class="contenidoMiddle">
                    <input type="radio" id="radioSexoMasculino" name="radioSexo" value="0" {{{isset($radioSexo) && $radioSexo=='0'?"checked='checked'":''}}} {{{!isset($radioSexo)?"checked='checked'":''}}}>
                    <label class="noLabel" for="radioSexoMasculino">Masculino</label>
                    <input type="radio" id="radioSexoFemenino" name="radioSexo" value="1" {{{isset($radioSexo) && $radioSexo=='1'?"checked='checked'":''}}}>
                    <label class="noLabel" for="radioSexoFemenino">Femenino</label>
                </div>
                <br>
                <label for="txtCorreo">E-mail</label>
                <input type="text" id="txtCorreo" name="txtCorreo" size="50" value="{{{isset($txtCorreo)?$txtCorreo:''}}}">
                <br>
                <label for="txtFechaNacimiento">Fecha de Nacimiento</label>
                <input type="date" id="txtFechaNacimiento" name="txtFechaNacimiento" style="width: 175px;" value="{{{isset($txtFechaNacimiento)?$txtFechaNacimiento:''}}}">
                <br>
                <label for="txtGrupoSanguineo">Grupo Sanguíneo</label>
                <input type="text" id="txtGrupoSanguineo" name="txtGrupoSanguineo" size="50" value="{{{isset($txtGrupoSanguineo)?$txtGrupoSanguineo:''}}}">
                <br>
                <label for="cbxTipoEmpleado">Empleado</label>
                <select name="cbxTipoEmpleado" id="cbxTipoEmpleado" style="width: 184px;">
                    <option value="Contratado" {{{isset($cbxTipoEmpleado) && $cbxTipoEmpleado=='Contratado'?"selected":''}}}>Contratado</option>
                    <option value="Nombrado" {{{isset($cbxTipoEmpleado) && $cbxTipoEmpleado=='Nombrado'?"selected":''}}}>Nombrado</option>
                </select>
                <br>
                <label for="txtCargo">Cargo en la Empresa</label>
                <input type="text" id="txtCargo" name="txtCargo" size="50" value="{{{isset($txtCargo)?$txtCargo:''}}}">
            </div>
            <div class="seccionBotones bordeArriba">
                <input type="button" value="Registrar" onclick="enviarFrmInsertarPersonal();">
            </div>
        </form>
    </section>
    <script>
        function enviarFrmInsertarPersonal()
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

            if(confirm('Realmente desea registrar el Personal'))
            {        
                $('#frmInsertarPersonal').submit();
                return;
            }
            alert('Operación Cancelada');
        }
    </script>
@stop