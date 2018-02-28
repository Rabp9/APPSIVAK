@extends('layout.layout')

@section('contenidoCuerpo')
    <h2 class="textAlignRight bordeAbajo tituloCabecera">PRODUCTOS TRASLADADOS ENTRE OFICINA/TIENDA</h2>
    <section class="anchoCompleto textAlignLeft backGroundColorGrisClaro">
        <div class="contenidoMiddle">
            <label class="contenidoMiddle">Ver traslados entre:</label>
            <input type="date" id="txtFechaInicial" name="txtFechaInicial" class="contenidoMiddle text" value="{{{$fechaInicial}}}">
            <label class="contenidoMiddle">y</label>
            <input type="date" id="txtFechaFinal" name="txtFechaFinal" class="contenidoMiddle text" value="{{{$fechaFinal}}}">
            <input type="button" value="Cargar compras" class="button" onclick="enviarVerProductoTrasladoOficinaEntreFechas();">
        </div>
        <label class="contenidoMiddle">Buscar</label>
        <input type="text" class="contenidoMiddle text" size="50" onkeyup="filtrarHtml('tableProductoTrasladoOficina', this.value, false, 200, event);">
    </section>
    <section id="tableProductoTrasladoOficina" class="labelGrande textAlignLeft anchoCompleto">
        @foreach($listaTProductoTrasladoOficina as $item) 
            <div id="fila{{{$item->codigoProductoTrasladoOficina}}}" class="elementoBuscar bordeAbajo listaDatos">
                <div class="fila"><label>Código de envío: </label>{{{$item->codigoProductoTrasladoOficina}}}</div>
                <div class="fila"><label>Oficina de partida: </label>{{{$item->tOficina->descripcion}}}</div>
                <div class="fila"><label>Oficina de llegada: </label>{{{$item->tOficinaLlegada->descripcion}}}</div>
                @if(!$item->estado)
                    <div class="fila" style="background-color: rgb(213, 114, 114);"><label>Estado del traslado: </label>{{{$item->estado ? 'Envío conforme' : 'Envío anulado'}}}</div>
                    <div class="fila"><label>Motivo de la anulación: </label>{{{$item->motivoAnulacion}}}</div>
                @endif
                <div class="fila"><label>Fecha del envío: </label>{{{$item->created_at}}}</div>
                <div class="backGroundColorBlancoOscuro fondoRayasBlancas textAlignRight">
                    <button id="botonProductosEnviados{{{$item->codigoProductoTrasladoOficina}}}" class="button" onclick="borrarElemento('filaDetalle'); agregarHtmlAlFinal('fila{{{$item->codigoProductoTrasladoOficina}}}', '<div id=filaDetalle class=bordeArriba></div>'); paginaAjax('filaDetalle', {codigo : '{{{$item->codigoProductoTrasladoOficina}}}'}, '/APPSIVAK/public/productotrasladooficinadetalle/verporcodigoproductotrasladooficina', 'POST', null, animacionScrollMovimientoY('botonProductosEnviados{{{$item->codigoProductoTrasladoOficina}}}', -170), false, true);">Ver productos trasladados</button>
                    @if($item->estado)
                        <button class="button" onclick="window.open('/APPSIVAK/public/reporte/guiaremisiontrasladoproductooficina/{{{$item->codigoProductoTrasladoOficina}}}', '_blank');">Imprimir guía de remisión</button>
                        @if(strlen(strpos(Session::get('rol'), 'Administrador'))>0)
                            <button class="button" onclick="dialogoAjax('dialogo', 450, true, 'Confirmar anulación del traslado', 'top', {codigo : '{{{$item->codigoProductoTrasladoOficina}}}'}, '/APPSIVAK/public/productotrasladooficina/anular', 'POST', null, null, false, true);">Anular traslado</button>
                        @endif
                    @endif
                </div>
            </div>
        @endforeach
    </section>
    
    <script>
        function enviarVerProductoTrasladoOficinaEntreFechas()
        {
            var mensajeGlobal='';
            
            mensajeGlobal=mensajeGlobal+(!valFechaYYYYMMDD($('#txtFechaInicial').val())?'Fecha inicial incorrecto<br>':'');
            mensajeGlobal=mensajeGlobal+(!valFechaYYYYMMDD($('#txtFechaFinal').val())?'Fecha final incorrecto<br>':'');

            if(mensajeGlobal!='')
            {
                animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
                return;
            }

            window.location.href='/APPSIVAK/public/productotrasladooficina/verentrefechas/'+$('#txtFechaInicial').val()+'/'+$('#txtFechaFinal').val();
        }
    </script>
@stop