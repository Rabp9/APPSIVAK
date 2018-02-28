@extends('layout.layout')

@section('contenidoCuerpo')
    <h2 class="textAlignRight bordeAbajo tituloCabecera">COMPROBANTES DE COMPRA</h2>
    <section class="anchoCompleto textAlignLeft backGroundColorGrisClaro">
        <div class="contenidoMiddle">
            <label class="contenidoMiddle">Ver compras entre:</label>
            <input type="date" id="txtFechaInicial" name="txtFechaInicial" class="contenidoMiddle text" value="{{{$fechaInicial}}}">
            <label class="contenidoMiddle">y</label>
            <input type="date" id="txtFechaFinal" name="txtFechaFinal" class="contenidoMiddle text" value="{{{$fechaFinal}}}">
            <input type="button" value="Cargar compras" class="button" onclick="enviarVerReciboCompraEntreFechas();">
        </div>
        <label class="contenidoMiddle">Buscar</label>
        <input type="text" class="contenidoMiddle text" size="50" onkeyup="filtrarHtml('tableReciboCompra', this.value, false, 200, event);">
        <label class="contenidoMiddle">Compra total: </label>
        S/.<div id="divCompraTotal" class="displayInlineBlock">0.00</div>
    </section>
    <section id="tableReciboCompra" class="labelGrande textAlignLeft anchoCompleto">
        @foreach($listaTReciboCompra as $item) 
            <div id="fila{{{$item->codigoReciboCompra}}}" class="elementoBuscar bordeAbajo listaDatos">
                <div class="fila"><label>Código de la compra: </label>{{{$item->codigoReciboCompra}}}</div>
                <div class="fila"><label>Proveedor: </label>{{{$item->tProveedor->nombre}}}</div>
                <div class="fila"><label>Almacén: </label>{{{$item->tAlmacen->descripcion}}}</div>
                <div class="fila"><label>Tipo de comprobante</label>{{{$item->tipoRecibo}}}</div>
                <div class="fila"><label>Número de comprobante</label>{{{$item->numeroRecibo}}}</div>
                <div class="fila" {{!($item->comprobanteEmitido) ? 'style="background-color: #FF8F00;"' : ''}}><label>Recepción del comprobante</label>{{{$item->comprobanteEmitido ? 'Comprobante recibido' : 'Falta recibir comprobante'}}}</div>
                @if($item->comprobanteEmitido)
                    <div class="fila"><label>Fecha de emisión del comprobante</label>{{{substr($item->fechaComprobanteEmitido, 0, 10)}}}</div>
                @endif
                @if($item->tipoRecibo=='Factura')
                    <div class="fila"><label>Igv</label>{{{$item->igv}}}</div>
                    <div class="fila"><label>Sub total</label>{{{$item->subTotal}}}</div>
                @endif
                <div class="fila"><label>Total</label>{{{$item->total}}}</div>
                <div class="fila"><label>Tipo de pago</label>{{{$item->tipoPago}}}</div>
                @if($item->tipoPago=='Al Crédito')
                    <div class="fila"><label>Fecha a pagar</label>{{{$item->fechaPagar}}}</div>
                @endif
                @if(!$item->estado)
                    <div class="fila" style="background-color: rgb(213, 114, 114);"><label>Estado de la compra: </label>{{{$item->estado ? 'Compra conforme' : 'Compra anulada'}}}</div>
                    <div class="fila"><label>Motivo de la anulación: </label>{{{$item->motivoAnulacion}}}</div>
                @endif
                <div class="fila"><label>Fecha de registro</label>{{{$item->created_at}}}</div>
                <div class="backGroundColorBlancoOscuro fondoRayasBlancas textAlignRight">

                <button id="botonProductosComprados{{{$item->codigoReciboCompra}}}" class="button" onclick="borrarElemento('filaDetalle'); agregarHtmlAlFinal('fila{{{$item->codigoReciboCompra}}}', '<div id=filaDetalle class=bordeArriba></div>'); paginaAjax('filaDetalle', {codigo : '{{{$item->codigoReciboCompra}}}'}, '/APPSIVAK/public/recibocompradetalle/verporcodigorecibocompra', 'POST', null, animacionScrollMovimientoY('botonProductosComprados{{{$item->codigoReciboCompra}}}', -170), false, true);">Ver productos comprados</button>
                @if($item->estado)
                    <script>
                        $('#divCompraTotal').text((parseFloat($('#divCompraTotal').text())+parseFloat('{{{$item->total}}}')).toFixed(2));
                    </script>
                    <button class="button" onclick="dialogoAjax('dialogo', 870, true, 'Confirmar cambio de la compra', 'top', {codigo : '{{{$item->codigoReciboCompra}}}'}, '/APPSIVAK/public/recibocompra/editar', 'POST', null, null, false, true);">Editar datos generales de la compra</button>
                    @if(strlen(strpos(Session::get('rol'), 'Administrador'))>0)
                        <button class="button" onclick="dialogoAjax('dialogo', 450, true, 'Confirmar anulación de la compra', 'top', {codigo : '{{{$item->codigoReciboCompra}}}'}, '/APPSIVAK/public/recibocompra/anular', 'POST', null, null, false, true);">Anular compra</button>
                    @endif
                @endif
                </div>
            </div>            
        @endforeach
    </section>
    
    <script>
        function enviarVerReciboCompraEntreFechas()
        {
            var mensajeGlobal='';
            
            mensajeGlobal=mensajeGlobal+(!valFechaYYYYMMDD($('#txtFechaInicial').val())?'Fecha inicial incorrecto<br>':'');
            mensajeGlobal=mensajeGlobal+(!valFechaYYYYMMDD($('#txtFechaFinal').val())?'Fecha final incorrecto<br>':'');

            if(mensajeGlobal!='')
            {
                animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
                return;
            }

            window.location.href='/APPSIVAK/public/recibocompra/verentrefechas/'+$('#txtFechaInicial').val()+'/'+$('#txtFechaFinal').val();
        }
    </script>
@stop