@extends('layout.layout')

@section('contenidoCuerpo')
    <h2 class="textAlignRight bordeAbajo tituloCabecera">COMPRAS REALIZADAS AL CRÉDITO</h2>
    <section class="anchoCompleto textAlignLeft backGroundColorGrisClaro">
        <label class="contenidoMiddle">Buscar</label>
        <input type="text" class="contenidoMiddle text" size="50" onkeyup="filtrarHtml('tableReciboCompra', this.value, false, 200, event);">
        <label class="contenidoMiddle">Compra total: </label>
        S/.<div id="divVentaTotal" class="displayInlineBlock">0.00</div> (Estimación de créditos pagados al 100%)
    </section>
    <section id="tableReciboCompra" class="labelGrande textAlignLeft anchoCompleto">
        @foreach($listaTReciboCompra as $item)
            <div id="fila{{{$item->codigoReciboCompra}}}" class="elementoBuscar bordeAbajo listaDatos">
                <div class="fila"><label>Código de la compra: </label>{{{$item->codigoReciboCompra}}}</div>
                <div class="fila"><label>Proveedor: </label>{{{$item->tProveedor->nombre}}}</div>
                <div class="fila"><label>Almacén: </label>{{{$item->tAlmacen->descripcion}}}</div>
                <div class="fila"><label>Descripción de la compra: </label>{{{$item->descripcion}}}</div>
                <div class="fila"><label>Tipo de comprobante: </label>{{{$item->tipoRecibo}}}</div>
                <div class="fila"><label>Número de comprobante: </label>{{{$item->numeroRecibo}}}</div>
                <div class="fila" {{!($item->comprobanteEmitido) ? 'style="background-color: #FF8F00;"' : ''}}><label>Recepción del comprobante</label>{{{$item->comprobanteEmitido ? 'Comprobante recibido' : 'Falta recibir comprobante'}}}</div>
                @if($item->comprobanteEmitido)
                    <div class="fila"><label>Fecha de emisión del comprobante</label>{{{substr($item->fechaComprobanteEmitido, 0, 10)}}}</div>
                @endif
                @if($item->tipoRecibo=='Factura')
	                <div class="fila"><label>Igv: </label>{{{$item->igv}}}</div>
	                <div class="fila"><label>Sub total: </label>{{{$item->subTotal}}}</div>
	            @endif
                <div class="fila"><label>Total: </label>{{{$item->total}}}</div>
                <div class="fila"><label>Tipo de pago: </label>{{{$item->tipoPago}}}</div>
                @if($item->tipoPago=='Al Crédito')
	                <div class="fila"><label>Fecha a pagar: </label>{{{$item->fechaPagar}}}</div>
                    @if($item->estado)
	                   <div class="fila" {{$item->estadoCredito ? 'style="background-color: #1497CC;"' : 'style="background-color: #FF8F00;"'}}><label>Estado del crédito: </label>{{{$item->estadoCredito ? 'Pagos Finalizados' : 'Falta concluir pagos'}}}</div>
                    @endif
	            @endif
                <div class="fila" {{{(!$item->estado) ? 'style="background-color: rgb(213, 114, 114);"' : ''}}}><label>Estado de la compra: </label>{{{($item->estado) ? 'Compra conforme' : 'Compra anulada'}}}</div>
                @if(!$item->estado)
                    <div class="fila"><label>Motivo de la anulación: </label>{{{$item->motivoAnulacion}}}</div>
                @endif
                <div class="fila"><label>Fecha de registro: </label>{{{$item->created_at}}}</div>
                <div class="backGroundColorBlancoOscuro fondoRayasBlancas textAlignRight">
                    <button id="botonProductosComprados{{{$item->codigoReciboCompra}}}" class="button" onclick="borrarElemento('filaDetalle'); agregarHtmlAlFinal('fila{{{$item->codigoReciboCompra}}}', '<div id=filaDetalle class=bordeArriba></div>'); paginaAjax('filaDetalle', {codigo : '{{{$item->codigoReciboCompra}}}'}, '/APPSIVAK/public/recibocompradetalle/verporcodigorecibocompra', 'POST', null, animacionScrollMovimientoY('botonProductosComprados{{{$item->codigoReciboCompra}}}', -170), false, true);">Ver productos comprados</button>
                    @if(!($item->estadoCredito) && ($item->estado))
                        <button class="button" onclick="dialogoAjax('dialogo', 450, true, 'Pagar crédito', 'top', {codigo : '{{{$item->codigoReciboCompra}}}'}, '/APPSIVAK/public/recibocomprapago/insertar', 'POST', null, null, false, true);">Pagar monto variable</button>
                    @endif
                    <button id="botonPagos{{{$item->codigoReciboCompra}}}" class="button" onclick="borrarElemento('filaDetalle'); agregarHtmlAlFinal('fila{{{$item->codigoReciboCompra}}}', '<div id=filaDetalle class=bordeArriba></div>'); paginaAjax('filaDetalle', {codigo : '{{{$item->codigoReciboCompra}}}'}, '/APPSIVAK/public/recibocomprapago/verporcodigorecibocompra', 'POST', null, animacionScrollMovimientoY('botonPagos{{{$item->codigoReciboCompra}}}', -170), false, true);">Ver pagos</button>
                    @if($item->estado)
                        <script>
                            $('#divVentaTotal').text((parseFloat($('#divVentaTotal').text())+parseFloat('{{{$item->total}}}')).toFixed(2));
                        </script>
                    @endif
                </div>
            </div>            
        @endforeach
    </section>
    
@stop