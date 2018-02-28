@extends('layout.layout')

@section('contenidoCuerpo')
    <h2 class="textAlignRight bordeAbajo tituloCabecera">PRODUCTOS ENVIADOS DE ALMACÉN A OFICINA/TIENDA</h2>
    <section class="anchoCompleto textAlignLeft backGroundColorGrisClaro">
        <div class="contenidoMiddle">
            <label class="contenidoMiddle">Ver envío entre:</label>
            <input type="date" id="txtFechaInicial" name="txtFechaInicial" class="contenidoMiddle text" value="{{{$fechaInicial}}}">
            <label class="contenidoMiddle">y</label>
            <input type="date" id="txtFechaFinal" name="txtFechaFinal" class="contenidoMiddle text" value="{{{$fechaFinal}}}">
            <input type="button" value="Cargar compras" class="button" onclick="enviarVerProductoEnviarStockEntreFechas();">
        </div>
        <label class="contenidoMiddle">Buscar</label>
        <input type="text" class="contenidoMiddle text" size="50" onkeyup="filtrarHtml('tableProductoEnviarStock', this.value, false, 200, event);">
    </section>
    <section id="tableProductoEnviarStock" class="labelGrande textAlignLeft anchoCompleto">
        @foreach($listaTProductoEnviarStock as $item) 
            <div id="fila{{{$item->codigoProductoEnviarStock}}}" class="elementoBuscar bordeAbajo listaDatos">
                <div class="fila"><label>Código de envío: </label>{{{$item->codigoProductoEnviarStock}}}</div>
                <div class="fila"><label>Almacén partida: </label>{{{$item->tAlmacen->descripcion}}}</div>
                <div class="fila"><label>Oficina llegada: </label>{{{$item->tOficina->descripcion}}}</div>
                @if(!$item->estado)
                    <div class="fila" style="background-color: rgb(213, 114, 114);"><label>Estado del envío: </label>{{{$item->estado ? 'Envío conforme' : 'Envío anulado'}}}</div>
                    <div class="fila"><label>Motivo de la anulación: </label>{{{$item->motivoAnulacion}}}</div>
                @endif
                <div class="fila"><label>Fecha del envío: </label>{{{$item->created_at}}}</div>
                <div class="backGroundColorBlancoOscuro fondoRayasBlancas textAlignRight">
                    <button id="botonProductosEnviados{{{$item->codigoProductoEnviarStock}}}" class="button" onclick="borrarElemento('filaDetalle'); agregarHtmlAlFinal('fila{{{$item->codigoProductoEnviarStock}}}', '<div id=filaDetalle class=bordeArriba></div>'); paginaAjax('filaDetalle', {codigo : '{{{$item->codigoProductoEnviarStock}}}'}, '/APPSIVAK/public/productoenviarstockdetalle/verporcodigoproductoenviarstock', 'POST', null, animacionScrollMovimientoY('botonProductosEnviados{{{$item->codigoProductoEnviarStock}}}', -170), false, true);">Ver productos enviados</button>
                    @if($item->estado)
                        <button class="button" onclick="window.open('/APPSIVAK/public/reporte/guiaremisionenvioproductoalmacenoficina/{{{$item->codigoProductoEnviarStock}}}', '_blank');">Imprimir guía de remisión</button>
                        @if(strlen(strpos(Session::get('rol'), 'Administrador'))>0)
                            <button class="button" onclick="dialogoAjax('dialogo', 450, true, 'Confirmar anulación del envío', 'top', {codigo : '{{{$item->codigoProductoEnviarStock}}}'}, '/APPSIVAK/public/productoenviarstock/anular', 'POST', null, null, false, true);">Anular envío</button>
                        @endif
                    @endif
                </div>
            </div>
        @endforeach
    </section>
    
    <script>
        function enviarVerProductoEnviarStockEntreFechas()
        {
            var mensajeGlobal='';
            
            mensajeGlobal=mensajeGlobal+(!valFechaYYYYMMDD($('#txtFechaInicial').val())?'Fecha inicial incorrecto<br>':'');
            mensajeGlobal=mensajeGlobal+(!valFechaYYYYMMDD($('#txtFechaFinal').val())?'Fecha final incorrecto<br>':'');

            if(mensajeGlobal!='')
            {
                animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
                return;
            }

            window.location.href='/APPSIVAK/public/productoenviarstock/verentrefechas/'+$('#txtFechaInicial').val()+'/'+$('#txtFechaFinal').val();
        }
    </script>
@stop