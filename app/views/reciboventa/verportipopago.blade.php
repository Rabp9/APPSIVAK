@extends('layout.layout')

@section('contenidoCuerpo')
    <h2 class="textAlignRight bordeAbajo tituloCabecera">VENTAS REALIZADAS AL CRÉDITO</h2>
    <section class="anchoCompleto textAlignLeft backGroundColorGrisClaro">
        <label class="contenidoMiddle">Buscar</label>
        <input type="text" class="contenidoMiddle text" size="50" onkeyup="filtrarHtml('tableReciboVenta', this.value, false, 200, event);">
        <label class="contenidoMiddle">Venta total: </label>
        S/.<div id="divVentaTotal" class="displayInlineBlock">0.00</div> (Estimación de créditos pagados al 100%)
    </section>
    <section id="tableReciboVenta" class="labelGrande textAlignLeft anchoCompleto">
        @foreach($listaTReciboVenta as $item)
            <div id="fila{{{$item->codigoReciboVenta}}}" class="elementoBuscar bordeAbajo listaDatos">
                <div class="fila"><label>Código de la venta: </label>{{{$item->codigoReciboVenta}}}</div>
                <div class="fila"><label>Nombre del cliente: </label>{{{$item->nombreCompletoCliente}}}</div>
                <div class="fila"><label>Documento del cliente: </label>{{{$item->documentoCliente}}}</div>
                <div class="fila"><label>Dirección del cliente: </label>{{{$item->direccionCliente}}}</div>
                <div class="fila"><label>Descripción de la venta: </label>{{{$item->descripcion}}}</div>
                <div class="fila"><label>Tipo de comprobante: </label>{{{$item->tipoRecibo}}}</div>
                <div class="fila"><label>Número de comprobante: </label>{{{$item->numeroRecibo}}}</div>
                @if($item->tipoRecibo=='Factura')
	                <div class="fila"><label>Igv: </label>{{{$item->igv}}}</div>
	                <div class="fila"><label>Sub total: </label>{{{$item->subTotal}}}</div>
	            @endif
                <div class="fila"><label>Total: </label>{{{$item->total}}}</div>
                <div class="fila"><label>Tipo de pago: </label>{{{$item->tipoPago}}}</div>
                @if($item->tipoPago=='Al Crédito')
	                <div class="fila"><label>Fecha de primer pago: </label>{{{$item->fechaPrimerPago}}}</div>
	                @if($item->pagoPersonalizado!='0')
		                <div class="fila"><label>Intervalo de días del pago: </label>{{{$item->pagoPersonalizado}}}</div>
		            @else
		            	<div class="fila"><label>Pago a realizar: </label>{{{$item->pagoAutomatico}}}</div>
		            @endif
                    <div class="fila" {{$item->estadoCredito ? 'style="background-color: #1497CC;"' : 'style="background-color: #FF8F00;"'}}><label>Estado del crédito: </label>{{{$item->estadoCredito ? 'Pagos Finalizados' : 'Falta concluir pagos'}}}</div>
	            @endif
                <div class="fila"><label>Estado de la entrega: </label>{{{$item->estadoEntrega ? 'Producto entregado' : 'Por entregar'}}}</div>
                @if(trim($item->nombreCompletoReceptor)!='')
                    <div class="fila"><label>Nombre del receptor: </label>{{{$item->nombreCompletoReceptor}}}</div>
                    <div class="fila"><label>Documento del receptor: </label>{{{$item->documentoReceptor}}}</div>
                    <div class="fila"><label>Dirección del receptor: </label>{{{$item->direccionEnvioReceptor}}}</div>
                    <div class="fila"><label>Flete: </label>{{{$item->flete}}}</div>
                @endif
                <div class="fila" {{!($item->estado) ? 'style="background-color: rgb(213, 114, 114);"' : ''}}><label>Estado de la venta: </label>{{{($item->estado) ? 'Venta conforme' : 'Venta anulada'}}}</div>
                @if(!($item->estado))
                    <div class="fila"><label>Motivo de la anulación: </label>{{{$item->motivoAnulacion}}}</div>
                @endif
                <div class="fila"><label>Fecha de registro: </label>{{{$item->created_at}}}</div>
                <div class="backGroundColorBlancoOscuro fondoRayasBlancas textAlignRight">
                    @if($item->estado)
                        @if($item->tipoPago=='Al Crédito')
                            <button class="button" onclick="window.open('/APPSIVAK/public/reporte/notacredito/{{{$item->codigoReciboVenta}}}', '_blank');">Imprimir nota de crédito</button>
                        @endif
                        <button class="button" onclick="window.open('/APPSIVAK/public/reporte/guiaremisionventa/{{{$item->codigoReciboVenta}}}', '_blank');">Imprimir guía de remisión</button>
                    @endif
                    @if($item->estado && $item->estadoCredito)
                        @if($item->tipoRecibo=='Boleta')
                            <button class="button" onclick="window.open('/APPSIVAK/public/reporte/boleta/{{{$item->codigoReciboVenta}}}', '_blank');">Imprimir boleta</button>
                        @endif
                        @if($item->tipoRecibo=='Factura')
                            <button class="button" onclick="window.open('/APPSIVAK/public/reporte/factura/{{{$item->codigoReciboVenta}}}', '_blank');">Imprimir factura</button>
                        @endif
                    @endif
                    <button id="botonProductosVendidos{{{$item->codigoReciboVenta}}}" class="button" onclick="borrarElemento('filaDetalle'); agregarHtmlAlFinal('fila{{{$item->codigoReciboVenta}}}', '<div id=filaDetalle class=bordeArriba></div>'); paginaAjax('filaDetalle', {codigo : '{{{$item->codigoReciboVenta}}}'}, '/APPSIVAK/public/reciboventadetalle/verporcodigoreciboventa', 'POST', null, animacionScrollMovimientoY('botonProductosVendidos{{{$item->codigoReciboVenta}}}', -170), false, true);">Ver productos vendidos</button>
                    @if(!($item->estadoCredito) && ($item->estado))
                        <button class="button" onclick="dialogoAjax('dialogo', 450, true, 'Pagar crédito', 'top', {codigo : '{{{$item->codigoReciboVenta}}}'}, '/APPSIVAK/public/reciboventapago/insertar', 'POST', null, null, false, true);">Pagar monto variable</button>
                    @endif
                    @if($item->estado)
                        <button id="botonPagosRealizados{{{$item->codigoReciboVenta}}}" class="button" onclick="borrarElemento('filaDetalle'); agregarHtmlAlFinal('fila{{{$item->codigoReciboVenta}}}', '<div id=filaDetalle class=bordeArriba></div>'); paginaAjax('filaDetalle', {codigo : '{{{$item->codigoReciboVenta}}}'}, '/APPSIVAK/public/reciboventapago/verporcodigoreciboventa', 'POST', null, animacionScrollMovimientoY('botonPagosRealizados{{{$item->codigoReciboVenta}}}', -170), false, true);">Ver pagos realizados</button>
                        <button id="botonVerPagarLetras{{{$item->codigoReciboVenta}}}" class="button" onclick="borrarElemento('filaDetalle'); agregarHtmlAlFinal('fila{{{$item->codigoReciboVenta}}}', '<div id=filaDetalle class=bordeArriba></div>'); paginaAjax('filaDetalle', {codigo : '{{{$item->codigoReciboVenta}}}'}, '/APPSIVAK/public/reciboventaletra/verporcodigoreciboventa', 'POST', null, animacionScrollMovimientoY('botonVerPagarLetras{{{$item->codigoReciboVenta}}}', -170), false, true);">Ver y pagar letras</button>
                        <script>
                            $('#divVentaTotal').text((parseFloat($('#divVentaTotal').text())+parseFloat('{{{$item->total}}}')).toFixed(2));
                        </script>
                    @endif
                </div>
            </div>            
        @endforeach
    </section>
    
    <script>
        $(document).on('ready', function()
        {
            if('{{{Session::has("codigoReciboVentaPago")}}}')
            {
                window.open('/APPSIVAK/public/reporte/reciboventapago/{{{Session::get("codigoReciboVentaPago")}}}', '_blank');
            }
        });
    </script>
@stop