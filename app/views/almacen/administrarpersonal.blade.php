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
    <h2 class="textAlignRight bordeAbajo tituloCabecera">ALMACÉN: ADMINISTRAR PERSONAL</h2>
    <section class="contenidoTop contenedorGeneralDragAndDrop">
        <div class="formulario" style="user-select: none;">
            <section id="seccionAlmacen" class="contenidoTop" style="box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.7)">
                <div class="tituloFormulario">
                    Almacén: {{{$tAlmacen->descripcion}}}
                </div>
                <div style="min-height: 40px;">
                    <label class="contenidoMiddle">Buscar: </label>
                    <input type="text" class="contenidoMiddle text" onkeyup="filtrarHtml('personalAsignado', this.value, false, 200, event);" style="width: 390px;">
                </div>
                <div id="personalAsignado" class="cajon1 cajonDragAndDrop">
                    @foreach($listaTPersonalAsignado as $item) 
                        @if($item->dni=='XXXXXXXX' && explode(',', Session::get('usuario'))[1]!='Yanapasoft')
                            <?php continue; ?>
                        @endif
                        <div id="{{{$item->codigoPersonal}}}" class="divDragAndDrop2 elementoBuscar dragbox">
                            {{{$item->nombre}}} {{{$item->apellidoPaterno}}} {{{$item->apellidoMaterno}}}
                            <br> 
                            {{{$item->dni}}}
                        </div>
                    @endforeach
                </div>
            </section>
            <section id="seccionPersonal" class="contenidoTop" style="box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.7)">
                <div class="tituloFormulario">
                    Personal
                </div>
                <div style="min-height: 40px;">
                    <label class="contenidoMiddle">Buscar: </label>
                    <input type="text" class="contenidoMiddle text" onkeyup="filtrarHtml('personal', this.value, false, 200, event);" style="width: 390px;">
                </div>
                <div id="personal" class="cajon2 cajonDragAndDrop">
                    @foreach($listaTPersonalNoAsignado as $item) 
                        @if($item->dni=='XXXXXXXX' && explode(',', Session::get('usuario'))[1]!='Yanapasoft')
                            <?php continue; ?>
                        @endif
                        <div id="{{{$item->codigoPersonal}}}" class="divDragAndDrop1 elementoBuscar dragbox">
                            {{{$item->nombre}}} {{{$item->apellidoPaterno}}} {{{$item->apellidoMaterno}}}
                            <br> 
                            {{{$item->dni}}}
                        </div>
                    @endforeach
                </div>
            </section>
            <form id="frmAsignarPersonalAlmacen" action="/APPSIVAK/public/almacen/administrarpersonal/{{{$tAlmacen->codigoAlmacen}}}" method="post">
                <input type="hidden" id="arrayAsignados" name="arrayAsignados">
                <input type="hidden" id="arrayEliminados" name="arrayEliminados">
                <div class="seccionBotones bordeArriba">
                    <input type="button" value="Guardar Cambios" onclick="enviarFrmAsignarPersonalAlmacen();">
                </div>
            </form>
        </div>
    </section>
    <script>
    function enviarFrmAsignarPersonalAlmacen()
    {
        if(confirm('Realmente desea guardar los cambios realizados'))
        {        
            $('#frmAsignarPersonalAlmacen').submit();
            return;
        }
        alert('Operación Cancelada');
    }
    </script>
@stop