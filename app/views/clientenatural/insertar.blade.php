@extends('layout.layout')

@section('contenidoCuerpo')
    <h2 class="textAlignRight bordeAbajo tituloCabecera">REGISTRAR CLIENTE NATURAL</h2>
    <section class="contenidoTop">
        <form id="frmInsertarClienteNatural" action="/APPSIVAK/public/clientenatural/insertar" method="post" class="formulario labelMediano">
            <div class="contenidoTop textAlignLeft">
                <h2 class="bordeAbajo">Datos del cliente natural</h2>
                <input type="button" id="btnBuscarOficina" value="Buscar Oficina" style="width: 200px;" onclick="mostrarApartadoBuscar();">
                <hr>
                <label for="txtDescripcionOficina">Descripción de Oficina</label>
                <input type="text" id="txtDescripcionOficina" name="txtDescripcionOficina" size="50" placeholder="Obligatorio" readonly="readonly" value="{{{isset($txtDescripcionOficina)?$txtDescripcionOficina:''}}}">
                <input type="hidden" id="txtCodigoOficina" name="txtCodigoOficina" readonly="readonly" value="{{{isset($txtCodigoOficina)?$txtCodigoOficina:''}}}">
                <br>
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
            </div>
            <div class="seccionBotones bordeArriba">
                <input type="button" value="Registrar" onclick="enviarFrmInsertarClienteNatural();">
            </div>
        </form>
    </section>
    <section id="apartadoBuscar" class="apartadoBuscar">
        <div id="divBuscarEnTablaOficina">
            <script>
                paginaAjax('divBuscarEnTablaOficina', null, '/APPSIVAK/public/oficina/buscaroficina', 'POST', null, null, false, true);
            </script>
        </div>
    </section>
    <script>
        function enviarFrmInsertarClienteNatural()
        {
            var mensajeGlobal='';
            
            mensajeGlobal+=(!valVacio($('#txtDescripcionOficina').val())?'Seleccione Oficina<br>':'');
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

            if(confirm('Realmente desea registrar el Cliente'))
            {        
                $('#frmInsertarClienteNatural').submit();
                return;
            }
            alert('Operación Cancelada');                
        }
    </script>
@stop