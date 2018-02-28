@extends('layout.layout')

@section('contenidoCuerpo')
    <h2 class="textAlignRight bordeAbajo tituloCabecera">REGISTRAR PROVEEDOR</h2>
    <section class="contenidoTop">
        <form id="frmInsertarProveedor" action="/APPSIVAK/public/proveedor/insertar" method="post" class="formulario labelMediano">
            <div class="contenidoTop textAlignLeft">
                <h2 class="bordeAbajo">Datos del proveedor</h2>
                <label for="txtDocumentoIdentidad">Documento de Identidad</label>
                <input type="text" id="txtDocumentoIdentidad" name="txtDocumentoIdentidad" size="50" placeholder="Obligatorio" value="{{{isset($txtDocumentoIdentidad)?$txtDocumentoIdentidad:''}}}">
                <br>
                <label for="txtNombre">Nombre</label>
                <input type="text" id="txtNombre" name="txtNombre" size="50" placeholder="Obligatorio" value="{{{isset($txtNombre)?$txtNombre:''}}}">
            </div>
            <div class="seccionBotones bordeArriba">
                <input type="button" value="Registrar" onclick="enviarFrmInsertarProveedor();">
            </div>
        </form>
    </section>
    <script>
        function enviarFrmInsertarProveedor()
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

            if(confirm('Realmente desea registrar el Proveedor'))
            {        
                $('#frmInsertarProveedor').submit();
                return;
            }
            alert('Operación Cancelada');
        }
    </script>
@stop