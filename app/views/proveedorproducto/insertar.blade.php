@extends('layout.layout')

@section('contenidoCuerpo')
    <h2 class="textAlignRight bordeAbajo tituloCabecera">REGISTRAR PRODUCTOS DE UN PROVEEDOR</h2>
    <section class="contenidoTop">
        <form id="frmInsertarProveedorProducto" action="/APPSIVAK/public/proveedorproducto/insertar" method="post" class="formulario labelMediano">
            <div class="contenidoTop textAlignLeft">
                <h2 class="bordeAbajo">Datos del producto que ofrece el proveedor</h2>
                <input type="button" id="btnBuscarProveedor" value="Buscar Proveedor" style="width: 200px;" onclick="mostrarApartadoBuscar();">
                <hr>
                <label for="txtNombreProveedor">Nombre de Proveedor</label>
                <input type="text" id="txtNombreProveedor" name="txtNombreProveedor" size="50" placeholder="Obligatorio" readonly="readonly" value="{{{isset($txtNombreProveedor)?$txtNombreProveedor:''}}}">
                <input type="hidden" id="txtCodigoProveedor" name="txtCodigoProveedor" readonly="readonly" value="{{{isset($txtCodigoProveedor)?$txtCodigoProveedor:''}}}">
                <br>
                <label for="txtNombre">Nombre del Producto</label>
                <input type="text" id="txtNombre" name="txtNombre" size="50" placeholder="Obligatorio" value="{{{isset($txtNombre)?$txtNombre:''}}}">
                <br>
                <label for="txtDescripcion">Descripción</label>
                <textarea name="txtDescripcion" id="txtDescripcion" cols="50" rows="5">{{{isset($txtDescripcion)?$txtDescripcion:''}}}</textarea>
            </div>
            <div class="seccionBotones bordeArriba">
                <input type="button" value="Registrar" onclick="enviarFrmInsertarProveedorProducto();">
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
        function enviarFrmInsertarProveedorProducto()
        {
            var mensajeGlobal='';
            
            mensajeGlobal+=(!valVacio($('#txtNombreProveedor').val())?'Seleccione un Proveedor para asignar producto<br>':'');
            mensajeGlobal+=(!valVacio($('#txtNombre').val())?'Complete el campo Nombre de Producto<br>':'');

            if(mensajeGlobal!='')
            {
                animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
                return;
            }

            if(confirm('Realmente desea registrar el Producto para el Proveedor Seleccionado'))
            {        
                $('#frmInsertarProveedorProducto').submit();
                return;
            }
            alert('Operación Cancelada');                
        }
    </script>
@stop