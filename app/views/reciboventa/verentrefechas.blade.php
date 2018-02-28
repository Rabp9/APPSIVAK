@extends('layout.layout')

@section('contenidoCuerpo')
    <h2 class="textAlignRight bordeAbajo tituloCabecera">VENTAS REALIZADAS</h2>
    <section class="anchoCompleto textAlignLeft backGroundColorGrisClaro">
        <div class="contenidoMiddle">
			<label class="contenidoMiddle">Ver ventas entre:</label>
        	<input type="date" id="txtFechaInicial" name="txtFechaInicial" class="contenidoMiddle text" value="{{{$fechaInicial}}}">
        	<label class="contenidoMiddle">y</label>
        	<input type="date" id="txtFechaFinal" name="txtFechaFinal" class="contenidoMiddle text" value="{{{$fechaFinal}}}">
        	<input type="button" value="Cargar ventas" class="button" onclick="enviarVerReciboVentaEntreFechas();">
        </div>
        <label class="contenidoMiddle">Buscar</label>
        <input type="text" class="contenidoMiddle text" size="50" onkeyup="filtrarHtml('tableReciboVenta', this.value, false, 200, event);">
        <label class="contenidoMiddle">Venta total: </label>
        S/.<div id="divVentaTotal" class="displayInlineBlock">0.00</div>
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
	            @endif
                <div class="fila"><label>Estado de la entrega: </label>{{{$item->estadoEntrega ? 'Producto entregado' : 'Por entregar'}}}</div>
                @if(trim($item->nombreCompletoReceptor)!='')
                    <div class="fila"><label>Nombre del receptor: </label>{{{$item->nombreCompletoReceptor}}}</div>
                    <div class="fila"><label>Documento del receptor: </label>{{{$item->documentoReceptor}}}</div>
                    <div class="fila"><label>Dirección del receptor: </label>{{{$item->direccionEnvioReceptor}}}</div>
                    <div class="fila"><label>Flete: </label>{{{$item->flete}}}</div>
                @endif
                @if(!$item->estado)
                    <div class="fila" style="background-color: rgb(213, 114, 114);"><label>Estado de la venta: </label>{{{$item->estado ? 'Venta conforme' : 'Venta anulada'}}}</div>
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
                @if(($item->tipoPago=='Al Contado' && $item->estado) || ($item->tipoPago=='Al Crédito' && $item->estadoCredito && $item->estado))
                    @if($item->tipoRecibo=='Ticket')
                        <button class="button" onclick="window.open('/APPSIVAK/public/reporte/ticket/{{{$item->codigoReciboVenta}}}', '_blank');">Imprimir ticket</button>
                    @endif
                    @if($item->tipoRecibo=='Recibo')
                        <button class="button" onclick="window.open('/APPSIVAK/public/reporte/recibo/{{{$item->codigoReciboVenta}}}', '_blank');">Imprimir recibo</button>
                    @endif
                    @if($item->tipoRecibo=='Boleta')
                        <button class="button" onclick="window.open('/APPSIVAK/public/reporte/boleta/{{{$item->codigoReciboVenta}}}', '_blank');">Imprimir boleta</button>
                    @endif
                    @if($item->tipoRecibo=='Factura')
                        <button class="button" onclick="window.open('/APPSIVAK/public/reporte/factura/{{{$item->codigoReciboVenta}}}', '_blank');">Imprimir factura</button>
                    @endif
                @endif
                <button id="botonProductosVendidos{{{$item->codigoReciboVenta}}}" class="button" onclick="borrarElemento('filaDetalle'); agregarHtmlAlFinal('fila{{{$item->codigoReciboVenta}}}', '<div id=filaDetalle class=bordeArriba></div>'); paginaAjax('filaDetalle', {codigo : '{{{$item->codigoReciboVenta}}}'}, '/APPSIVAK/public/reciboventadetalle/verporcodigoreciboventa', 'POST', null, animacionScrollMovimientoY('botonProductosVendidos{{{$item->codigoReciboVenta}}}', -170), false, true);">Ver productos vendidos</button>
                @if($item->estado)
                    <script>
                        $('#divVentaTotal').text((parseFloat($('#divVentaTotal').text())+parseFloat('{{{$item->total}}}')).toFixed(2));
                    </script>
                    <button class="button" onclick="dialogoAjax('dialogo', 800, true, 'Confirmar cambio de la venta', 'top', {codigo : '{{{$item->codigoReciboVenta}}}'}, '/APPSIVAK/public/reciboventa/editar', 'POST', null, null, false, true);">Editar datos generales de la venta</button>
                    @if(strlen(strpos(Session::get('rol'), 'Administrador'))>0)
                        <button class="button" onclick="dialogoAjax('dialogo', 450, true, 'Confirmar anulación de la venta', 'top', {codigo : '{{{$item->codigoReciboVenta}}}'}, '/APPSIVAK/public/reciboventa/anular', 'POST', null, null, false, true);">Anular venta</button>
                    @endif
                @endif
                </div>
            </div>            
        @endforeach
    </section>
    
    <script>
        function enviarVerReciboVentaEntreFechas()
        {
            var mensajeGlobal='';
            
            mensajeGlobal=mensajeGlobal+(!valFechaYYYYMMDD($('#txtFechaInicial').val())?'Fecha inicial incorrecto<br>':'');
            mensajeGlobal=mensajeGlobal+(!valFechaYYYYMMDD($('#txtFechaFinal').val())?'Fecha final incorrecto<br>':'');

            if(mensajeGlobal!='')
            {
                animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
                return;
            }

            window.location.href='/APPSIVAK/public/reciboventa/verentrefechas/'+$('#txtFechaInicial').val()+'/'+$('#txtFechaFinal').val();
        }
    </script>
@stop