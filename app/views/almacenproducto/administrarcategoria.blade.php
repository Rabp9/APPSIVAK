@extends('layout.layout')

@section('contenidoCuerpo')
    <script type="text/javascript" >
        $(function(){
            $('.cajonDragAndDrop').sortable({
                connectWith: '.cajonDragAndDrop',
                opacity: 0.4,
                stop: function(event, ui){
                    $("#arrayAsignados").val("");
                    $(".cajon1").find(".divDragAndDrop1").each(function(index, elemento)
                    {
                        $("#arrayAsignados").val($("#arrayAsignados").val()+elemento.id+",");
                    });
                    var valorInputAsignados=$("#arrayAsignados").val();
                    $("#arrayAsignados").val(valorInputAsignados.substring(0, valorInputAsignados.length-1));

                    $("#arrayEliminados").val("");
                    $(".cajon2").find(".divDragAndDrop2").each(function(index, elemento)
                    {
                        $("#arrayEliminados").val($("#arrayEliminados").val()+elemento.id+",");
                    });
                    var valorInputAsignados=$("#arrayEliminados").val();
                    $("#arrayEliminados").val(valorInputAsignados.substring(0, valorInputAsignados.length-1));
                }
            })
            .disableSelection();
        });
    </script>
    <h2 class="textAlignRight bordeAbajo tituloCabecera">PRODUCTOS DE ALMACÉN: ADMINISTRAR CATEGORÍA</h2>
    <section class="contenidoTop contenedorGeneralDragAndDrop">
        <div class="formulario" style="user-select: none;">
            <section id="seccionAlmacenProducto" class="contenidoTop" style="box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.7)">
                <div class="tituloFormulario" style="position: relative;">
                    <div id="divDetalleAlmacenProducto" class="textoMediano textAlignLeft" style="background-color: white;box-shadow: 0px 0px 2px black;color: black;display: none;line-height: 17px;position: absolute;top: 100%;width: 100%;">
                        <div class="contenidoMiddle">
                            <b>Primer Nombre</b>
                            <br>
                            {{{$tAlmacenProducto->primerNombre}}}
                            <br>
                            <b>Segundo Nombre</b>
                            <br>
                            {{{$tAlmacenProducto->segundoNombre}}}
                            <br>
                            <b>Tercer Nombre</b>
                            <br>
                            {{{$tAlmacenProducto->tercerNombre}}}
                            <br>
                            <b>Tipo</b>
                            <br>
                            {{{$tAlmacenProducto->tipo}}}
                        </div>
                    </div>
                    Código del Producto: {{{$tAlmacenProducto->codigoAlmacenProducto}}} <b style="cursor: pointer;text-decoration: underline;" onmouseover="mostrarDivDetalleAlmacenProducto();" onmouseout="ocultarDivDetalleAlmacenProducto()">Ver Detalle</b>
                </div>
                <div style="min-height: 40px;">
                    <label class="contenidoMiddle">Buscar: </label>
                    <input type="text" class="contenidoMiddle text" onkeyup="filtrarHtml('categoriaHijoAsignado', this.value, false, 200, event);" style="width: 390px;">
                </div>
                <div id="categoriaHijoAsignado" class="cajon1 cajonDragAndDrop">
                    @foreach($listaTCategoriaHijoAsignado as $item) 
                        <div id="{{{$item->codigoCategoria}}}" class="divDragAndDrop2 elementoBuscar dragbox">
                            <br>
                            {{{$item->nombre}}}
                            <br><br>
                        </div>
                    @endforeach
                </div>
            </section>
            <section id="seccionCategoriaHijo" class="contenidoTop" style="box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.7)">
                <div class="tituloFormulario">
                    Categoría
                </div>
                <div style="min-height: 40px;">
                    <label class="contenidoMiddle">Buscar: </label>
                    <input type="text" class="contenidoMiddle text" onkeyup="filtrarHtml('categoriaHijo', this.value, false, 200, event);" style="width: 390px;">
                </div>
                <div id="categoriaHijo" class="cajon2 cajonDragAndDrop">
                    @foreach($listaTCategoriaHijoNoAsignado as $item) 
                        <div id="{{{$item->codigoCategoria}}}" class="divDragAndDrop1 elementoBuscar dragbox">
                            <br>
                            {{{$item->nombre}}}
                            <br><br>
                        </div>
                    @endforeach
                </div>
            </section>
            <form id="frmAsignarCategoriaAlmacenProducto" action="/APPSIVAK/public/almacenproducto/administrarcategoria/{{{$tAlmacenProducto->codigoAlmacenProducto}}}" method="post">
                <input type="hidden" id="arrayAsignados" name="arrayAsignados">
                <input type="hidden" id="arrayEliminados" name="arrayEliminados">
                <div class="seccionBotones bordeArriba">
                    <input type="button" value="Guardar Cambios" onclick="enviarFrmAsignarCategoriaAlmacenProducto();">
                </div>
            </form>
        </div>
    </section>
    <script>
    function mostrarDivDetalleAlmacenProducto()
    {
        $('#divDetalleAlmacenProducto').show();
    }

    function ocultarDivDetalleAlmacenProducto()
    {
        $('#divDetalleAlmacenProducto').hide();
    }

    function enviarFrmAsignarCategoriaAlmacenProducto()
    {
        if(confirm('Realmente desea guardar los cambios realizados'))
        {        
            $('#frmAsignarCategoriaAlmacenProducto').submit();
            return;
        }
        alert('Operación Cancelada');
    }
    </script>
@stop