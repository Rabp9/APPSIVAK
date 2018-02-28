@extends('layout.layout')

@section('contenidoCuerpo')
    <h2 class="textAlignRight bordeAbajo tituloCabecera">REGISTRAR CLIENTE JURÍDICO</h2>
    <section class="contenidoTop">
        <form id="frmInsertarClienteJuridico" action="/APPSIVAK/public/clientejuridico/insertar" method="post" class="formulario labelMediano">
            <div class="contenidoTop textAlignLeft">
                <h2 class="bordeAbajo">Datos del cliente jurídico</h2>
                <input type="button" id="btnBuscarOficina" value="Buscar Oficina" style="width: 200px;" onclick="mostrarApartadoBuscar();">
                <hr>
                <label for="txtDescripcionOficina">Descripción de Oficina</label>
                <input type="text" id="txtDescripcionOficina" name="txtDescripcionOficina" size="50" placeholder="Obligatorio" readonly="readonly" value="{{{isset($txtDescripcionOficina)?$txtDescripcionOficina:''}}}">
                <input type="hidden" id="txtCodigoOficina" name="txtCodigoOficina" readonly="readonly" value="{{{isset($txtCodigoOficina)?$txtCodigoOficina:''}}}">
                <br>
                <label for="txtRuc">Ruc</label>
                <input type="text" id="txtRuc" name="txtRuc" size="50" placeholder="Obligatorio" value="{{{isset($txtRuc)?$txtRuc:''}}}">
                <br>
                <label for="txtRazonSocialCorta">Razón Social Corta</label>
                <input type="text" id="txtRazonSocialCorta" name="txtRazonSocialCorta" size="50" placeholder="Obligatorio" value="{{{isset($txtRazonSocialCorta)?$txtRazonSocialCorta:''}}}">
                <br>
                <label for="txtRazonSocialLarga">Razón Social Larga</label>
                <input type="text" id="txtRazonSocialLarga" name="txtRazonSocialLarga" size="50" placeholder="Obligatorio" value="{{{isset($txtRazonSocialLarga)?$txtRazonSocialLarga:''}}}">
                <br>
                <label>Reside en el País</label>
                <div class="contenidoMiddle">
                    <input type="radio" id="radioSi" name="radioResidePais" value="1" {{{isset($radioResidePais) && $radioResidePais=='1'?"checked='checked'":''}}} {{{!isset($radioResidePais)?"checked='checked'":''}}}>
                    <label class="noLabel" for="radioSi">Si</label>
                    <input type="radio" id="radioNo" name="radioResidePais" value="0" {{{isset($radioResidePais) && $radioResidePais=='0'?"checked='checked'":''}}}>
                    <label class="noLabel" for="radioNo">No</label>
                </div>
                <br>
                <label for="txtFechaConstitucion">Fecha de Constitución</label>
                <input type="date" id="txtFechaConstitucion" name="txtFechaConstitucion" style="width: 173px;" value="{{{isset($txtFechaConstitucion)?$txtFechaConstitucion:'1111-11-11'}}}">
                <br>
                <label for="txtPais">País</label>
                <input type="text" id="txtPais" name="txtPais" size="50" placeholder="Obligatorio" value="{{{isset($txtPais)?$txtPais:''}}}">
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
                <label for="txtCorreo">E-mail</label>
                <input type="text" id="txtCorreo" name="txtCorreo" size="50" value="{{{isset($txtCorreo)?$txtCorreo:''}}}">
            </div>
            <div class="seccionBotones bordeArriba">
                <input type="button" value="Registrar" onclick="enviarFrmInsertarClienteJuridico();">
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
        function enviarFrmInsertarClienteJuridico()
        {
            var mensajeGlobal='';
            
            mensajeGlobal+=(!valVacio($('#txtDescripcionOficina').val())?'Seleccione Oficina<br>':'');
            mensajeGlobal+=(!valRuc($('#txtRuc').val())?'Ruc Incorrecto<br>':'');
            mensajeGlobal+=(!valVacio($('#txtRazonSocialCorta').val())?'Complete el campo de Razón Social Corta<br>':'');
            mensajeGlobal+=(!valVacio($('#txtRazonSocialLarga').val())?'Complete el campo de Razón Social Larga<br>':'');
            mensajeGlobal+=(!valFechaYYYYMMDD($('#txtFechaConstitucion').val())?'Fecha de Constitución Incorrecto<br>':'');
            mensajeGlobal+=(!valVacio($('#txtPais').val())?'Complete el campo de País<br>':'');

            if(mensajeGlobal!='')
            {
                animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
                return;
            }

            if(confirm('Realmente desea registrar el Cliente'))
            {        
                $('#frmInsertarClienteJuridico').submit();
                return;
            }
            alert('Operación Cancelada');                
        }
    </script>
@stop