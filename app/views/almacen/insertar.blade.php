@extends('layout.layout')

@section('contenidoCuerpo')
    <h2 class="textAlignRight bordeAbajo tituloCabecera">REGISTRAR ALMACÉN</h2>
    <section class="contenidoTop">
        <form id="frmInsertarAlmacen" action="/APPSIVAK/public/almacen/insertar" method="post" class="formulario labelMediano">
            <div class="contenidoTop textAlignLeft">
                <h2 class="bordeAbajo">Datos del almacén</h2>
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
                <label for="txtDireccion">Direción</label>
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
                <label for="txtFechaCreacion">Fecha de Constitución</label>
                <input type="date" id="txtFechaCreacion" name="txtFechaCreacion" style="width: 175px;" value="{{{isset($txtFechaCreacion)?$txtFechaCreacion:'1111-11-11'}}}">
            </div>
            <div class="seccionBotones bordeArriba">
                <input type="button" value="Registrar" onclick="enviarFrmInsertarAlmacen();">
            </div>
        </form>
    </section>
    <script>
        function enviarFrmInsertarAlmacen()
        {
            var mensajeGlobal='';
                            
            mensajeGlobal+=(!valVacio($('#txtDescripcion').val())?'Complete el campo de Descripción<br>':'');
            mensajeGlobal+=(!valVacio($('#txtPais').val())?'Complete el campo de País<br>':'');
            mensajeGlobal+=(!valVacio($('#txtDepartamento').val())?'Complete el campo de Departamento<br>':'');
            mensajeGlobal+=(!valVacio($('#txtProvincia').val())?'Complete el campo de Provincia<br>':'');
            mensajeGlobal+=(!valVacio($('#txtDistrito').val())?'Complete el campo de Distrito<br>':'');
            mensajeGlobal+=(!valVacio($('#txtDireccion').val())?'Complete el campo de Direción<br>':'');
            mensajeGlobal+=(!valFechaYYYYMMDD($('#txtFechaCreacion').val())?'Fecha de Registro Incorrecto<br>':'');

            if($('#txtDescripcion').val().indexOf(',')!=-1)
            {
                mensajeGlobal+='No se permiten comas (,) en el campo Descripción<br>';
            }

            if(mensajeGlobal!='')
            {
                animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
                return;
            }

            if(confirm('Realmente desea registrar el Almacén'))
            {        
                $('#frmInsertarAlmacen').submit();
                return;
            }
            alert('Operación Cancelada');                
        }
    </script>
@stop