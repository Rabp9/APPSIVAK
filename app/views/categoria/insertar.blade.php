@extends('layout.layout')

@section('contenidoCuerpo')
    <h2 class="textAlignRight bordeAbajo tituloCabecera">REGISTRAR CATEGORÍA</h2>
    <section class="contenidoTop">
        <form id="frmInsertarCategoria" action="/APPSIVAK/public/categoria/insertar" method="post" class="formulario labelMediano">
            <div class="contenidoTop textAlignLeft">
                <h2 class="bordeAbajo">Datos de la categoría</h2>
                <input type="button" id="btnBuscarCategoria_Padre" value="Buscar Categoría Padre" style="width: 200px;" onclick="mostrarApartadoBuscar();">
                <hr>
                <label for="txtNombreCategoria_Padre">Nombre Categoría Padre</label>
                <input type="text" id="txtNombreCategoria_Padre" name="txtNombreCategoria_Padre" size="50" placeholder="Obligatorio" readonly="readonly" value="{{{isset($txtNombreCategoria_Padre)?$txtNombreCategoria_Padre:''}}}">
                <input type="button" value="Como Raiz" style="width: 200px;" onclick="$('#txtNombreCategoria_Padre').val('Categoría Raiz');$('#txtCodigoCategoria_Padre').val('CATEGORI0000000');">
                <input type="hidden" id="txtCodigoCategoria_Padre" name="txtCodigoCategoria_Padre" readonly="readonly" value="{{{isset($txtCodigoCategoria_Padre)?$txtCodigoCategoria_Padre:''}}}">
                <br>
                <label for="txtNombre">Nombre</label>
                <input type="text" id="txtNombre" name="txtNombre" size="50" placeholder="Obligatorio" value="{{{isset($txtNombre)?$txtNombre:''}}}">
                <br>
                <label for="txtDescripcion">Descripción</label>
                <textarea name="txtDescripcion" id="txtDescripcion" cols="50" rows="5">{{{isset($txtDescripcion)?$txtDescripcion:''}}}</textarea>
            </div>
            <div class="seccionBotones bordeArriba">
                <input type="button" value="Registrar" onclick="enviarFrmInsertarCategoria();">
            </div>
        </form>
    </section>
    <section id="apartadoBuscar" class="apartadoBuscar">
        <div id="divBuscarEnTablaCategoria_Padre">
            <script>
                paginaAjax('divBuscarEnTablaCategoria_Padre', {codigo : 'CATEGORI0000000'}, '/APPSIVAK/public/categoria/buscarcategoriaporcodigocategoriapadre', 'POST', null, null, false, true);
            </script>
        </div>
    </section>
    <script>
        function enviarFrmInsertarCategoria()
        {
            var mensajeGlobal='';
            
            mensajeGlobal+=(!valVacio($('#txtNombreCategoria_Padre').val())?'Debe seleccionar Una Categoria Padre<br>':'');
            mensajeGlobal+=(!valVacio($('#txtNombre').val())?'Complete el campo Nombre<br>':'');

            if($('#txtNombreCategoria_Padre').val().indexOf(',')!=-1 || $('#txtNombre').val().indexOf(',')!=-1)
            {
                mensajeGlobal+='No se permiten comas (,) en el nombre<br>';
            }

            if(mensajeGlobal!='')
            {
                animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
                return;
            }

            if(confirm('Realmente desea registrar la Categoría'))
            {        
                $('#frmInsertarCategoria').submit();
                return;
            }
            alert('Operación Cancelada');                
        }
    </script>
@stop