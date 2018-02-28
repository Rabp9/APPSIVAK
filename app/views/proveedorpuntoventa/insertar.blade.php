@extends('layout.layout')

@section('contenidoCuerpo')
    <h2 class="textAlignRight bordeAbajo tituloCabecera">REGISTRAR PUNTO DE VENTA DE PROVEEDOR</h2>
    <section class="contenidoTop">
        <form id="frmInsertarProveedorPuntoVenta" action="/APPSIVAK/public/proveedorpuntoventa/insertar" method="post" class="formulario labelPequenio">
            <div class="contenidoTop textAlignLeft">
                <h2 class="bordeAbajo">Datos del punto de venta del proveedor</h2>
                <input type="button" id="btnBuscarProveedor" value="Buscar Proveedor" style="width: 200px;" onclick="mostrarApartadoBuscar();">
                <hr>
                <label for="txtNombreProveedor">Nombre de Proveedor</label>
                <input type="text" id="txtNombreProveedor" name="txtNombreProveedor" size="50" placeholder="Obligatorio" readonly="readonly" value="{{{isset($txtNombreProveedor)?$txtNombreProveedor:''}}}">
                <input type="hidden" id="txtCodigoProveedor" name="txtCodigoProveedor" readonly="readonly" value="{{{isset($txtCodigoProveedor)?$txtCodigoProveedor:''}}}">
                <br>
                <label for="txtDescripcion">Descripción</label>
                <input type="text" id="txtDescripcion" name="txtDescripcion" size="50" placeholder="Obligatorio" value="{{{isset($txtDescripcion)?$txtDescripcion:''}}}">
                <br>
                <label for="txtPais">País</label>
                <input type="text" id="txtPais" name="txtPais" size="50" placeholder="Obligatorio" value="{{{isset($txtPais)?$txtPais:''}}}">
                <br>
                <label for="txtDepartamento">Departamento</label>
                <input type="text" id="txtDepartamento" name="txtDepartamento" size="50" placeholder="Obligatorio" value="{{{isset($txtDepartamento)?$txtDepartamento:''}}}">
                <br>
                <label for="txtProvincia">Provincia</label>
                <input type="text" id="txtProvincia" name="txtProvincia" size="50" placeholder="Obligatorio" value="{{{isset($txtProvincia)?$txtProvincia:''}}}">
                <br>
                <label for="txtDistrito">Distrito</label>
                <input type="text" id="txtDistrito" name="txtDistrito" size="50" placeholder="Obligatorio" value="{{{isset($txtDistrito)?$txtDistrito:''}}}">
                <br>
                <label for="txtDireccion">Dirección</label>
                <input type="text" id="txtDireccion" name="txtDireccion" size="50" placeholder="Obligatorio" value="{{{isset($txtDireccion)?$txtDireccion:''}}}">
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
                <label for="txtCorreo">Correo</label>
                <input type="text" id="txtCorreo" name="txtCorreo" size="50" value="{{{isset($txtCorreo)?$txtCorreo:''}}}">
                <br>
                <label for="txtPaginaWeb">Página Web</label>
                <input type="text" id="txtPaginaWeb" name="txtPaginaWeb" size="50" value="{{{isset($txtPaginaWeb)?$txtPaginaWeb:''}}}">
            </div>
            <div class="seccionBotones bordeArriba">
                <input type="button" value="Registrar" onclick="enviarFrmInsertarProveedorPuntoVenta();">
            </div>
        </form>
    </section>
    <section id="apartadoBuscar" class="apartadoBuscar">
        <div id="divBuscarEnTablaProveedor">
            <script>
                paginaAjax('divBuscarEnTablaProveedor', null, '/APPSIVAK/public/proveedor/buscarproveedor', 'POST', null, null, false, true);
            </script>
        </div>
    </section>
    <script>
        function enviarFrmInsertarProveedorPuntoVenta()
        {
            var mensajeGlobal='';
            
            mensajeGlobal+=(!valVacio($('#txtNombreProveedor').val())?'Seleccione un Proveedor para crear Sucursal<br>':'');
            mensajeGlobal+=(!valVacio($('#txtDescripcion').val())?'Complete el campo de Descripción<br>':'');
            mensajeGlobal+=(!valVacio($('#txtPais').val())?'Complete el campo de País<br>':'');
            mensajeGlobal+=(!valVacio($('#txtDepartamento').val())?'Complete el campo de Departamento<br>':'');
            mensajeGlobal+=(!valVacio($('#txtProvincia').val())?'Complete el campo de Provincia<br>':'');
            mensajeGlobal+=(!valVacio($('#txtDistrito').val())?'Complete el campo de Distrito<br>':'');
            mensajeGlobal+=(!valVacio($('#txtDireccion').val())?'Complete el campo de Direción<br>':'');
            mensajeGlobal+=(!valEmail($('#txtCorreo').val())?'Correo incorrecto<br>':'');

            if(mensajeGlobal!='')
            {
                animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
                return;
            }

            if(confirm('Realmente desea registrar el Punto de Venta para el Proveedor Seleccionado'))
            {        
                $('#frmInsertarProveedorPuntoVenta').submit();
                return;
            }
            alert('Operación Cancelada');                
        }
    </script>
@stop