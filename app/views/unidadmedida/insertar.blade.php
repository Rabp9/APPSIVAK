@extends('layout.layout')

@section('contenidoCuerpo')
    <h2 class="textAlignRight bordeAbajo tituloCabecera">REGISTRAR UNIDAD DE MEDIDA PARA PRODUCTO</h2>
    <section class="contenidoTop">
        <form id="frmInsertarUnidadMedida" action="/APPSIVAK/public/unidadmedida/insertar" method="post" class="formulario labelPequenio">
            <div class="contenidoTop textAlignLeft">
                <input type="text" style="display: none;">
                <h2 class="bordeAbajo">Datos de la unidad de medida</h2>
                <label for="txtNombre">Nombre</label>
                <input type="text" id="txtNombre" name="txtNombre" placeholder="Obligatorio" value="{{{isset($txtNombre)?$txtNombre:''}}}">
                <br>
                <label for="txtDescripcion">Descripción</label>
                <textarea name="txtDescripcion" id="txtDescripcion" cols="38" rows="5">{{{isset($txtDescripcion)?$txtDescripcion:''}}}</textarea>
            </div>
            <div class="seccionBotones bordeArriba">
                <input type="button" value="Registrar" onclick="enviarFrmInsertarUnidadMedida();">
            </div>
        </form>
    </section>
    <script>
        function enviarFrmInsertarUnidadMedida()
        {
            var mensajeGlobal='';
            
            mensajeGlobal+=(!valVacio($("#txtNombre").val())?"Complete el campo Nombre<br>":'');

            if(mensajeGlobal!='')
            {
                animacionAlertaMensajeGeneral(mensajeGlobal, "red");
                return;
            }

            if(confirm("Realmente desea registrar la Unidad de Medida"))
            {        
                $("#frmInsertarUnidadMedida").submit();
                return;
            }
            alert("Operación Cancelada");
        }
    </script>
@stop