<?php
class ReporteController extends BaseController
{
	public function actionIndex()
	{
		$ventas=
		[
			TReciboVenta::whereRaw('month(created_at)=? and year(created_at)=year(now()) and estado=?', ['1', true])->sum('total'),
			TReciboVenta::whereRaw('month(created_at)=? and year(created_at)=year(now()) and estado=?', ['2', true])->sum('total'),
			TReciboVenta::whereRaw('month(created_at)=? and year(created_at)=year(now()) and estado=?', ['3', true])->sum('total'),
			TReciboVenta::whereRaw('month(created_at)=? and year(created_at)=year(now()) and estado=?', ['4', true])->sum('total'),
			TReciboVenta::whereRaw('month(created_at)=? and year(created_at)=year(now()) and estado=?', ['5', true])->sum('total'),
			TReciboVenta::whereRaw('month(created_at)=? and year(created_at)=year(now()) and estado=?', ['6', true])->sum('total'),
			TReciboVenta::whereRaw('month(created_at)=? and year(created_at)=year(now()) and estado=?', ['7', true])->sum('total'),
			TReciboVenta::whereRaw('month(created_at)=? and year(created_at)=year(now()) and estado=?', ['8', true])->sum('total'),
			TReciboVenta::whereRaw('month(created_at)=? and year(created_at)=year(now()) and estado=?', ['9', true])->sum('total'),
			TReciboVenta::whereRaw('month(created_at)=? and year(created_at)=year(now()) and estado=?', ['10', true])->sum('total'),
			TReciboVenta::whereRaw('month(created_at)=? and year(created_at)=year(now()) and estado=?', ['11', true])->sum('total'),
			TReciboVenta::whereRaw('month(created_at)=? and year(created_at)=year(now()) and estado=?', ['12', true])->sum('total')
		];

		$ingresos=
		[
			TCajaDetalle::whereRaw('month(created_at)=? and year(created_at)=year(now())', ['1'])->sum('ingresos'),
			TCajaDetalle::whereRaw('month(created_at)=? and year(created_at)=year(now())', ['2'])->sum('ingresos'),
			TCajaDetalle::whereRaw('month(created_at)=? and year(created_at)=year(now())', ['3'])->sum('ingresos'),
			TCajaDetalle::whereRaw('month(created_at)=? and year(created_at)=year(now())', ['4'])->sum('ingresos'),
			TCajaDetalle::whereRaw('month(created_at)=? and year(created_at)=year(now())', ['5'])->sum('ingresos'),
			TCajaDetalle::whereRaw('month(created_at)=? and year(created_at)=year(now())', ['6'])->sum('ingresos'),
			TCajaDetalle::whereRaw('month(created_at)=? and year(created_at)=year(now())', ['7'])->sum('ingresos'),
			TCajaDetalle::whereRaw('month(created_at)=? and year(created_at)=year(now())', ['8'])->sum('ingresos'),
			TCajaDetalle::whereRaw('month(created_at)=? and year(created_at)=year(now())', ['9'])->sum('ingresos'),
			TCajaDetalle::whereRaw('month(created_at)=? and year(created_at)=year(now())', ['10'])->sum('ingresos'),
			TCajaDetalle::whereRaw('month(created_at)=? and year(created_at)=year(now())', ['11'])->sum('ingresos'),
			TCajaDetalle::whereRaw('month(created_at)=? and year(created_at)=year(now())', ['12'])->sum('ingresos')
		];

		$egresos=
		[
			TCajaDetalle::whereRaw('month(created_at)="1" and year(created_at)=year(now())')->sum('egresos'),
			TCajaDetalle::whereRaw('month(created_at)="2" and year(created_at)=year(now())')->sum('egresos'),
			TCajaDetalle::whereRaw('month(created_at)="3" and year(created_at)=year(now())')->sum('egresos'),
			TCajaDetalle::whereRaw('month(created_at)="4" and year(created_at)=year(now())')->sum('egresos'),
			TCajaDetalle::whereRaw('month(created_at)="5" and year(created_at)=year(now())')->sum('egresos'),
			TCajaDetalle::whereRaw('month(created_at)="6" and year(created_at)=year(now())')->sum('egresos'),
			TCajaDetalle::whereRaw('month(created_at)="7" and year(created_at)=year(now())')->sum('egresos'),
			TCajaDetalle::whereRaw('month(created_at)="8" and year(created_at)=year(now())')->sum('egresos'),
			TCajaDetalle::whereRaw('month(created_at)="9" and year(created_at)=year(now())')->sum('egresos'),
			TCajaDetalle::whereRaw('month(created_at)="10" and year(created_at)=year(now())')->sum('egresos'),
			TCajaDetalle::whereRaw('month(created_at)="11" and year(created_at)=year(now())')->sum('egresos'),
			TCajaDetalle::whereRaw('month(created_at)="12" and year(created_at)=year(now())')->sum('egresos')
		];

		return View::make('reporte/index', ['ventas' => $ventas, 'ingresos' => $ingresos, 'egresos' => $egresos]);
	}

	public function actionTicket($codigoReciboVenta)
	{
		$tReciboVenta=TReciboVenta::with('TOficina', 'TReciboVentaDetalle')->find($codigoReciboVenta);
		
		$html=''.
			'<!doctype html>'.
			'<html lang="es">'.
			'<head>'.
				'<meta charset="UTF-8">'.
				'<title>Document</title>'.
				'<style>'.
					'*'.
					'{'.
						'margin: 5px;'.
					'}'.
					'.bold'.
					'{'.
						'font-weight: bold;'.
					'}'.
					'.bordeDotted'.
					'{'.
						'padding: 2px;'.
					'}'.
					'.textAlignCenter'.
					'{'.
						'text-align: center;'.
					'}'.
					'.textAlignLeft'.
					'{'.
						'text-align: left'.
					'}'.
					'.textAlignRight'.
					'{'.
						'text-align: right'.
					'}'.
				'</style>'.
			'</head>'.
			'<body style="font-size: 12px; font-family: sans-serif;">'.
//				'<img id="imgLogo" src="img/logoCliente.png" height="54" style="border-right: 1px solid #999999;left: 0px;position: fixed;top: 0px;">'.
				'<div id="divTipoComprobante" style="font-size: 22px;left: 20px;position: fixed;top: 215px;">Ticket</div>'.
				'<div style="display: inline-block;font-size: 11px;left: 20px;position: fixed;top: 237px;">'.$codigoReciboVenta.'</div>'.
				'<div id="divFechaEmision" style="left: 20px;position: fixed;top: 204px;">Generado el: '.date('d-m-Y H:i:s').'</div>'.
//				'<div id="divSeparadorCabecera" style="background-color: #999999;left: 0px;height: 1px;position: fixed;top: 60px;width: 370px;"></div>'.
	            '<table cellpadding="0" cellspacing="0" style="left: 50px;position: fixed;top: 285px;width: 370px;">'.
	                '<tbody>'.
//                     '<tr>'.
//                          '<td class="bold" style="width: 90px;">'.('Local:').'</td>'.
//                          '<td>'.iconv('UTF-8', 'windows-1252', $tReciboVenta->tOficina->descripcion).'</td>'.
//                     '</tr>'.
//                        '<tr>'.
//                            '<td class="bold" style="width: 90px;">Tipo de pago:</td>'.
//                            '<td>'.iconv('UTF-8', 'windows-1252', $tReciboVenta->tipoPago).'</td>'.
//                        '</tr>'.
                        '<tr>'.
//                          '<td class="bold" style="width: 90px;">Fecha de venta:</td>'.
                            '<td>'.iconv('UTF-8', 'windows-1252', substr($tReciboVenta->fechaComprobanteEmitido, 0, 10)).'</td>'.
                        '</tr>'.
                        '<tr>'.
//                          '<td class="bold" style="width: 90px;">Fecha de venta:</td>'.
                            '<div id="divCliente" style="left: 105px;position: fixed;top: 330px;">'.iconv('UTF-8', 'windows-1252', $tReciboVenta->nombreCompletoCliente).'</div>'.
                        '</tr>'.						
						

	                '</tbody>'.
	            '</table>'.
	            '<table class="tabla" style="left: 10px;position: fixed;top: 395px;width: 345px;">'.
            		'<thead>'.
           			'<tr>'.
                            ('<th class="textAlignCenter" style="width: 0px;">&nbsp;</th>').
							('<th class="textAlignLeft" >'.iconv('UTF-8', 'windows-1252', 'Descripción').'</th>').
	                		('<th class="textAlignCenter" style="width: 60px;">&nbsp;</th>').
	                		('<th class="textAlignCenter" style="width: 70px;">&nbsp;</th>'). 
		                '</tr>'.
           		'</thead>'.
            		'<tbody>';
				        foreach($tReciboVenta->tReciboVentaDetalle as $value)
				        {
							$html.=''.
							'<tr>'.
	                			'<td class="bordeDotted textAlignLeft">'.($value->cantidadProducto).'</td>'.
								'<td class="" style="textAlignCenter">&nbsp;&nbsp;'.iconv('UTF-8', 'windows-1252', $value->primerNombreProducto.'  '.$value->segundoNombreProducto.'  '.$value->tercerNombreProducto).'</td>'.
	                			'<td class="bordeDotted textAlignRight ">'.($value->precioVentaUnitarioProducto).'</td>'.
	                			'<td class="bordeDotted textAlignLeft">&nbsp;'.number_format($value->precioVentaTotalProducto, 2, '.', '').'</td>'.
	                		'</tr>';
				        }
    					$html.=''.
						'<tr>'.
                			'<td colspan="2" class="bold"></td>'.
                			'<td class="bold textAlignLeft">Total</td>'.
                			'<td class="bold bordeDotted textAlignLeft">S/. '.$tReciboVenta->total.'</td>'.
                		'</tr>'.
                		'<tr>'.
                			'<td colspan="4">(Comprobante sin valor tributario)</td>'.
                		'</tr>'.
        			'</tbody>'.
            	'</table>'.
			'</body>'.
			'</html>';

		$headers=array('Content-Type' => 'application/pdf');

		return Response::make(PDF::load($html, 'A4', 'portrait')->download($codigoReciboVenta), 200, $headers);
	}

	public function actionRecibo($codigoReciboVenta)
	{
		$tReciboVenta=TReciboVenta::with('TReciboVentaDetalle')->find($codigoReciboVenta);
		
		$html=''.
			'<!doctype html>'.
			'<html lang="es">'.
			'<head>'.
				'<meta charset="UTF-8">'.
				'<title>Document</title>'.
				'<style>'.
					'.table td'.
					'{'.
						'border-bottom: 1px solid #999999;'.
						'margin: 0px;'.
						'padding: 4px;'.
					'}'.
					'.table th'.
					'{'.
						'border: 1px solid #000000;'.
						'padding: 7px;'.
					'}'.
					'.textAlignCenter'.
					'{'.
						'text-align: center;'.
					'}'.
					'.textAlignLeft'.
					'{'.
						'text-align: left'.
					'}'.
					'.textAlignRight'.
					'{'.
						'text-align: right'.
					'}'.
				'</style>'.
			'</head>'.
			'<body style="font-size: 12px;">'.
				'<img id="imgLogo" src="img/logoCliente.png" height="54" style="border-right: 1px solid #999999;left: 0px;position: fixed;top: 0px;">'.
				'<div id="divTipoComprobante" style="font-size: 22px;left: 200px;position: fixed;top: 10px;">Recibo</div>'.
				'<div id="divFechaEmision" style="left: 525px;position: fixed;top: 0px;">Generado el: '.date('d-m-Y H:i:s').'</div>'.
				'<div style="display: inline-block;font-size: 11px;left: 200px;position: fixed;top: 35px;">'.$codigoReciboVenta.'</div>'.
				'<div id="divSeparadorCabecera" style="background-color: #999999;left: 0px;height: 1px;position: fixed;top: 60px;"></div>'.
				'<div id="divCliente" style="left: 0px;position: fixed;top: 80px;"><div style="display: inline-block;width: 80px;"><b>'.iconv('UTF-8', 'windows-1252', 'Señor(es):').'</b></div>'.iconv('UTF-8', 'windows-1252', $tReciboVenta->nombreCompletoCliente).'</div>'.
				'<div id="divDireccion" style="left: 0px;position: fixed;top: 100px;"><div style="display: inline-block;width: 80px;"><b>'.iconv('UTF-8', 'windows-1252', 'Direccción:').'</b></div>'.iconv('UTF-8', 'windows-1252', $tReciboVenta->direccionCliente).'</div>'.
				'<div id="divDocumento" style="left: 500px;position: fixed;top: 80px;"><div style="display: inline-block;width: 90px;"><b>Documento:</b></div>'.($tReciboVenta->documentoCliente).'</div>'.
				'<div id="divFechaEmision" style="left: 500px;position: fixed;top: 100px;"><div style="display: inline-block;width: 90px;"><b>Fecha de venta:</b></div>'.(substr($tReciboVenta->fechaComprobanteEmitido, 0, 10)).'</div>'.
	            '<div id="divComprobanteDetalle" style="left: 0px;position: fixed;top: 135px;">'.
	            	'<table class="table" style="width: 100%;">'.
	            		'<thead>'.
	            			'<tr>'.
	            				'<th style="width: 60px;">Cantidad</th>'.
	            				'<th>'.iconv('UTF-8', 'windows-1252', 'Descripción').'</th>'.
	            				'<th style="width: 100px;">Precio U. en S/.</th>'.
	            				'<th style="width: 100px;">Precio T. en S/.</th>'.
	            			'</tr>'.
	            		'</thead>'.
	            		'<tbody>';
	                    foreach($tReciboVenta->tReciboVentaDetalle as $value)
	                    {
							$html.=''.
							'<tr>'.
	                			'<td class="textAlignCenter">'.($value->cantidadProducto).'</td>'.
	                			'<td>'.iconv('UTF-8', 'windows-1252', $value->primerNombreProducto.' / '.$value->segundoNombreProducto.' / '.$value->tercerNombreProducto).'</td>'.
	                			'<td class="textAlignCenter">'.($value->precioVentaUnitarioProducto).'</td>'.
	                			'<td class="textAlignCenter">'.number_format($value->precioVentaTotalProducto, 2, '.', '').'</td>'.
	                		'</tr>';
	                    }
						$html.=''.
							'<tr>'.
								'<td colspan="2" style="border: none;"></td>'.
								'<td class="textAlignCenter"><b>Total:</b></td>'.
	                			'<td class="textAlignCenter">'.($tReciboVenta->total).'</td>'.
	                		'</tr>'.
	        			'</tbody>'.
	            	'</table>'.
	            '</div>'.
			'</body>'.
			'</html>';

		$headers=array('Content-Type' => 'application/pdf');

		return Response::make(PDF::load($html, 'A4', 'portrait')->show('my_pdf'), 200, $headers);
	}

	public function actionNotaCredito($codigoReciboVenta)
	{
		$tReciboVenta=TReciboVenta::with('TReciboVentaDetalle')->find($codigoReciboVenta);
		
		$html=''.
			'<!doctype html>'.
			'<html lang="es">'.
			'<head>'.
				'<meta charset="UTF-8">'.
				'<title>Document</title>'.
				'<style>'.
					'.table td'.
					'{'.
						'border-bottom: 1px solid #999999;'.
						'margin: 0px;'.
						'padding: 4px;'.
					'}'.
					'.table th'.
					'{'.
						'border: 1px solid #000000;'.
						'padding: 7px;'.
					'}'.
					'.textAlignCenter'.
					'{'.
						'text-align: center;'.
					'}'.
					'.textAlignLeft'.
					'{'.
						'text-align: left'.
					'}'.
					'.textAlignRight'.
					'{'.
						'text-align: right'.
					'}'.
				'</style>'.
			'</head>'.
			'<body style="font-size: 12px;">'.
				'<img id="imgLogo" src="img/logoCliente.png" height="54" style="border-right: 1px solid #999999;left: 0px;position: fixed;top: 0px;">'.
				'<div id="divTipoComprobante" style="font-size: 22px;left: 200px;position: fixed;top: 10px;">'.iconv('UTF-8', 'windows-1252', 'Nota de crédito').'</div>'.
				'<div id="divFechaEmision" style="left: 525px;position: fixed;top: 0px;">Generado el: '.date('d-m-Y H:i:s').'</div>'.
				'<div style="display: inline-block;font-size: 11px;left: 200px;position: fixed;top: 35px;">'.$codigoReciboVenta.'</div>'.
				'<div id="divSeparadorCabecera" style="background-color: #999999;left: 0px;height: 1px;position: fixed;top: 60px;"></div>'.
				'<div id="divCliente" style="left: 0px;position: fixed;top: 80px;"><div style="display: inline-block;width: 80px;"><b>'.iconv('UTF-8', 'windows-1252', 'Señor (es):').'</b></div>'.iconv('UTF-8', 'windows-1252', $tReciboVenta->nombreCompletoCliente).'</div>'.
				'<div id="divDireccion" style="left: 0px;position: fixed;top: 100px;"><div style="display: inline-block;width: 80px;"><b>'.iconv('UTF-8', 'windows-1252', 'Direccción:').'</b></div>'.iconv('UTF-8', 'windows-1252', $tReciboVenta->direccionCliente).'</div>'.
				'<div id="divDocumento" style="left: 500px;position: fixed;top: 80px;"><div style="display: inline-block;width: 90px;"><b>Documento:</b></div>'.($tReciboVenta->documentoCliente).'</div>'.
				'<div id="divFechaEmision" style="left: 500px;position: fixed;top: 100px;"><div style="display: inline-block;width: 90px;"><b>Fecha de venta:</b></div>'.substr($tReciboVenta->fechaComprobanteEmitido, 0, 10).'</div>'.
	            '<div id="divComprobanteDetalle" style="left: 0px;position: fixed;top: 135px;">'.
	            	'<table class="table" style="width: 100%;">'.
	            		'<thead>'.
	            			'<tr>'.
	            				'<th style="width: 60px;">Cantidad</th>'.
	            				'<th>'.iconv('UTF-8', 'windows-1252', 'Descripción').'</th>'.
	            				'<th style="width: 100px;">Precio U. en S/.</th>'.
	            				'<th style="width: 100px;">Precio T. en S/.</th>'.
	            			'</tr>'.
	            		'</thead>'.
	            		'<tbody>';
	                    foreach($tReciboVenta->tReciboVentaDetalle as $value)
	                    {
							$html.=''.
							'<tr>'.
	                			'<td class="textAlignCenter">'.($value->cantidadProducto).'</td>'.
	                			'<td>'.iconv('UTF-8', 'windows-1252', $value->primerNombreProducto.' / '.$value->segundoNombreProducto.' / '.$value->tercerNombreProducto).'</td>'.
	                			'<td class="textAlignCenter">'.($value->precioVentaUnitarioProducto).'</td>'.
	                			'<td class="textAlignCenter">'.number_format($value->precioVentaTotalProducto, 2, '.', '').'</td>'.
	                		'</tr>';
	                    }
						$html.=''.
							'<tr>'.
								'<td colspan="2" style="border: none;"></td>'.
								'<td class="textAlignCenter"><b>Total:</b></td>'.
	                			'<td class="textAlignCenter">'.($tReciboVenta->total).'</td>'.
	                		'</tr>'.
	                		'<tr>'.
								'<td colspan="4" style="border: none;">(Comprobante sin valor tributario)</td>'.
	                		'</tr>'.
	        			'</tbody>'.
	            	'</table>'.
	            '</div>'.
			'</body>'.
			'</html>';

		$headers=array('Content-Type' => 'application/pdf');

		return Response::make(PDF::load($html, 'A4', 'portrait')->show('my_pdf'), 200, $headers);
	}

	public function actionReciboVentaPago($codigoReciboVentaPago)
	{
		$tReciboVentaPago=TReciboVentaPago::with('TReciboVenta')->find($codigoReciboVentaPago);
		$listaTReciboVentaPago=TReciboVentaPago::whereRaw('codigoReciboVenta=? order by codigoReciboVentaPago asc', [$tReciboVentaPago->tReciboVenta->codigoReciboVenta])->get();

		$pagosRealizados=0;

		foreach ($listaTReciboVentaPago as $key => $value)
		{
			$pagosRealizados+=$value->monto;

			if(($value->codigoReciboVentaPago)==$codigoReciboVentaPago)
			{
				break;
			}
		}

		$montoPorPagar=($tReciboVentaPago->tReciboVenta->total)-$pagosRealizados;
		
		$html=''.
			'<!doctype html>'.
			'<html lang="es">'.
			'<head>'.
				'<meta charset="UTF-8">'.
				'<title>Document</title>'.
				'<style>'.
					'.table td'.
					'{'.
						'border-bottom: 1px solid #999999;'.
						'margin: 0px;'.
						'padding: 4px;'.
					'}'.
					'.table th'.
					'{'.
						'border: 1px solid #000000;'.
						'padding: 7px;'.
					'}'.
					'.textAlignCenter'.
					'{'.
						'text-align: center;'.
					'}'.
					'.textAlignLeft'.
					'{'.
						'text-align: left'.
					'}'.
					'.textAlignRight'.
					'{'.
						'text-align: right'.
					'}'.
				'</style>'.
			'</head>'.
			'<body style="font-size: 12px;">'.
				'<img id="imgLogo" src="img/logoCliente.png" height="54" style="border-right: 1px solid #999999;left: 0px;position: fixed;top: 0px;">'.
				'<div id="divTipoComprobante" style="font-size: 22px;left: 200px;position: fixed;top: 10px;">Recibo de pago</div>'.
				'<div id="divFechaEmision" style="left: 525px;position: fixed;top: 0px;">Generado el: '.date('d-m-Y H:i:s').'</div>'.
				'<div style="display: inline-block;font-size: 11px;left: 200px;position: fixed;top: 35px;">'.$codigoReciboVentaPago.'</div>'.
				'<div id="divSeparadorCabecera" style="background-color: #999999;left: 0px;height: 1px;position: fixed;top: 60px;"></div>'.
				'<div id="divCliente" style="left: 0px;position: fixed;top: 80px;"><div style="display: inline-block;width: 80px;"><b>'.iconv('UTF-8', 'windows-1252', 'Señor(es):').'</b></div>'.iconv('UTF-8', 'windows-1252', $tReciboVentaPago->tReciboVenta->nombreCompletoCliente).'</div>'.
				'<div id="divDireccion" style="left: 0px;position: fixed;top: 100px;"><div style="display: inline-block;width: 80px;"><b>'.iconv('UTF-8', 'windows-1252', 'Direccción:').'</b></div>'.iconv('UTF-8', 'windows-1252', $tReciboVentaPago->tReciboVenta->direccionCliente).'</div>'.
				'<div id="divDocumento" style="left: 500px;position: fixed;top: 80px;"><div style="display: inline-block;width: 90px;"><b>Documento:</b></div>'.($tReciboVentaPago->tReciboVenta->documentoCliente).'</div>'.
				'<div id="divFechaEmision" style="left: 500px;position: fixed;top: 100px;"><div style="display: inline-block;width: 90px;"><b>Fecha del pago:</b></div>'.($tReciboVentaPago->created_at).'</div>'.
	            '<div id="divComprobanteDetalle" style="left: 0px;position: fixed;top: 120px;">'.
	            	'<h2>'.iconv('UTF-8', 'windows-1252', 'Detalle de la venta que se está pagando').'</h2>'.
	            	'<table class="table" style="width: 100%;">'.
	            		'<thead>'.
	            			'<tr>'.
	            				'<th style="width: 60px;">Cantidad</th>'.
	            				'<th>'.iconv('UTF-8', 'windows-1252', 'Descripción').'</th>'.
	            				'<th style="width: 100px;">Precio U. en S/.</th>'.
	            				'<th style="width: 100px;">Precio T. en S/.</th>'.
	            			'</tr>'.
	            		'</thead>'.
	            		'<tbody>';
	                    foreach($tReciboVentaPago->tReciboVenta->tReciboVentaDetalle as $value)
	                    {
							$html.=''.
							'<tr>'.
	                			'<td class="textAlignCenter">'.($value->cantidadProducto).'</td>'.
	                			'<td>'.iconv('UTF-8', 'windows-1252', $value->primerNombreProducto.' / '.$value->segundoNombreProducto.' / '.$value->tercerNombreProducto).'</td>'.
	                			'<td class="textAlignCenter">'.($value->precioVentaUnitarioProducto).'</td>'.
	                			'<td class="textAlignCenter">'.number_format($value->precioVentaTotalProducto, 2, '.', '').'</td>'.
	                		'</tr>';
	                    }
						$html.=''.
							'<tr>'.
								'<td colspan="2" style="border: none;"></td>'.
								'<td class="textAlignCenter"><b>Total:</b></td>'.
	                			'<td class="textAlignCenter">'.($tReciboVentaPago->tReciboVenta->total).'</td>'.
	                		'</tr>'.
	        			'</tbody>'.
	            	'</table>'.
	            	'<h2>'.iconv('UTF-8', 'windows-1252', 'Detalle del pago que se está realizando').'</h2>'.
	            	'<table class="table" style="width: 100%">'.
	            		'<tbody>'.
							'<tr>'.
								'<td>'.iconv('UTF-8', 'windows-1252', 'Pago de crédito').' - (<b>'.iconv('UTF-8', 'windows-1252', 'Código de la venta:').' </b>'.($tReciboVentaPago->tReciboVenta->codigoReciboVenta).' : '.iconv('UTF-8', 'windows-1252', $tReciboVentaPago->descripcion).')</td>'.
	                			'<td class="textAlignCenter" style="width: 107px;">'.($tReciboVentaPago->monto).'</td>'.
	                		'</tr>'.
	                		'<tr>'.
								'<td class="textAlignRight" style="border: none;"><b>Total:</b></td>'.
	                			'<td class="textAlignCenter" style="width: 107px;">'.($tReciboVentaPago->monto).'</td>'.
	                		'</tr>'.
	                		'<tr>'.
								'<td class="textAlignRight" style="border: none;"><b>Al momento fue pagado:</b></td>'.
	                			'<td class="textAlignCenter" style="width: 107px;">'.number_format($pagosRealizados, '2', '.', '').'</td>'.
	                		'</tr>'.
	                		'<tr>'.
								'<td class="textAlignRight" style="border: none;"><b>Falta pagar:</b></td>'.
	                			'<td class="textAlignCenter" style="width: 107px;">'.number_format($montoPorPagar, '2', '.', '').'</td>'.
	                		'</tr>'.
	        			'</tbody>'.
	            	'</table>'.
	            '</div>'.
			'</body>'.
			'</html>';

		$headers=array('Content-Type' => 'application/pdf');

		return Response::make(PDF::load($html, 'A4', 'portrait')->show('my_pdf'), 200, $headers);
	}

	public function actionBoleta($codigoReciboVenta)
	{
		$tReciboVenta=TReciboVenta::with('TReciboVentaDetalle')->find($codigoReciboVenta);
		
		$html=''.
			'<!doctype html>'.
			'<html lang="es">'.
			'<head>'.
				'<meta charset="UTF-8">'.
				'<title>Document</title>'.
				'<style>'.
					'*'.
					'{'.
						'margin: 3px;'.
						'padding: 0px;'.
					'}'.
					'.textAlignCenter'.
					'{'.
						'text-align: center;'.
					'}'.
					'.textAlignLeft'.
					'{'.
						'text-align: left'.
					'}'.
					'.textAlignRight'.
					'{'.
						'text-align: right'.
					'}'.
				'</style>'.
			'</head>'.
			'<body style="font-size: 12px;">'.
				'<div style="display: inline-block;font-size: 11px;left: 640px;position: fixed;top: 2px;">'.$codigoReciboVenta.'</div>'.
				'<div id="divCliente" style="left: 140px;position: fixed;top: 170px;">'.iconv('UTF-8', 'windows-1252', $tReciboVenta->nombreCompletoCliente).'</div>'.
	            '<div id="divDireccion" style="left: 140px;position: fixed;top: 190px;">'.iconv('UTF-8', 'windows-1252', $tReciboVenta->direccionCliente).'</div>'.
				'<div id="divDocumento" style="left: 140px;position: fixed;top: 210px;">'.($tReciboVenta->documentoCliente).'</div>'.
	            '<div id="divFechaEmision" style="left: 635px;position: fixed;top: 205px;">'.substr($tReciboVenta->fechaComprobanteEmitido, 0, 10).'</div>'.
	            '<div id="divComprobanteDetalle" style="left: 50px;position: fixed;top: 255px;">'.
	            	'<table>'.
	            		'<tbody>';
	                    foreach($tReciboVenta->tReciboVentaDetalle as $value)
	                    {
							$html.=''.
							'<tr>'.
	                			'<td class="textAlignCenter" style="width: 52px;">'.($value->cantidadProducto).'</td>'.
	                			'<td class="textAlignCenter" style="width: 52px;">'.iconv('UTF-8', 'windows-1252', $value->unidadMedidaProducto).'</td>'.
	                			'<td class="" style="width: 430px;">'.iconv('UTF-8', 'windows-1252', $value->primerNombreProducto.' / '.$value->segundoNombreProducto.' / '.$value->tercerNombreProducto).'</td>'.
	                			'<td class="textAlignCenter" style="width: 70px;">'.($value->precioVentaUnitarioProducto).'</td>'.
	                			'<td class="textAlignCenter" style="width: 70px;">'.number_format($value->precioVentaTotalProducto, 2, '.', '').'</td>'.
	                		'</tr>';
	                    }
						$html.=''.
	        			'</tbody>'.
	            	'</table>'.
	            '</div>';
	            if($tReciboVenta->tipoPago=='Al Contado')
	            {
	            	$html.=''.
	            	'<div id="divFechaCancelacion" style="left: 300px;position: fixed;top: 515px;">'.date('d-m-Y').'</div>';
	            }
	            $html.=''.
            	'<div id="divTotal" style="left: 680px;position: fixed;top: 510px;">'.($tReciboVenta->total).'</div>'.
			'</body>'.
			'</html>';

		$headers=array('Content-Type' => 'application/pdf');

		return Response::make(PDF::load($html, 'A4', 'portrait')->download($codigoReciboVenta), 200, $headers);
	}

	public function actionFactura($codigoReciboVenta)
	{
		$tReciboVenta=TReciboVenta::with('TReciboVentaDetalle')->find($codigoReciboVenta);

		require('NumeroLetra.php');

		$convertirNumeroLetra=new EnLetras();
		
		$html=''.
			'<!doctype html>'.
			'<html lang="es">'.
			'<head>'.
				'<meta charset="UTF-8">'.
				'<title>Document</title>'.
				'<style>'.
					'*'.
					'{'.
						'margin: 3px;'.
						'padding: 2px;'.
					'}'.
					'.textAlignCenter'.
					'{'.
						'text-align: center;'.
					'}'.
					'.textAlignLeft'.
					'{'.
						'text-align: left'.
					'}'.
					'.textAlignRight'.
					'{'.
						'text-align: right'.
					'}'.
				'</style>'.
			'</head>'.
			'<body style="font-size: 13px;">'.
				'<div style="display: inline-block;font-size: 11px;left: 620px;position: fixed;top: 2px;">'.$codigoReciboVenta.'</div>'.
	            '<div id="divCliente" style="left: 110px;position: fixed;top: 175px;">'.iconv('UTF-8', 'windows-1252', $tReciboVenta->nombreCompletoCliente).'</div>'.
	            '<div id="divDireccion" style="left: 110px;position: fixed;top: 222px;">'.iconv('UTF-8', 'windows-1252', $tReciboVenta->direccionCliente).'</div>'.
				'<div id="divDocumento" style="left: 110px;position: fixed;top: 197px;">'.($tReciboVenta->documentoCliente).'</div>'.
	            '<div id="divFechaEmision" style="left: 635px;position: fixed;top: 220px;">'.substr($tReciboVenta->fechaComprobanteEmitido, 0, 10).'</div>'.
	            '<div id="divComprobanteDetalle" style="left: 50px;position: fixed;top: 260px;">'.
	            	'<table>'.
	            		'<tbody>';
	                    foreach($tReciboVenta->tReciboVentaDetalle as $value)
	                    {
							$html.=''.
							'<tr>'.
	                			'<td class="textAlignLeft" style="width: 60px;">'.($value->cantidadProducto).'</td>'.
//	                			'<td class="textAlignCenter" style="width: 60px;">'.iconv('UTF-8', 'windows-1252', $value->unidadMedidaProducto).'</td>'.
	                			'<td class="" style="width: 460px;">'.iconv('UTF-8', 'windows-1252', $value->primerNombreProducto.' / '.$value->segundoNombreProducto.' / '.$value->tercerNombreProducto).'</td>'.
	                			'<td class="textAlignCenter" style="width: 70px;">'.($value->precioVentaUnitarioProducto).'</td>'.
	                			'<td class="textAlignCenter" style="width: 70px;">'.number_format($value->precioVentaTotalProducto, 2, '.', '').'</td>'.
	                		'</tr>';
	                    }
						$html.=''.
	        			'</tbody>'.
	            	'</table>'.
	            '</div>'.
	            '<div id="divTotalLetras" style="left: 100px;position: fixed;top: 485px;">'.iconv('UTF-8', 'windows-1252', $convertirNumeroLetra->ValorEnLetras(($tReciboVenta->total),"")).'</div>';
	            if($tReciboVenta->tipoPago=='Al Contado')
	            {
	            	$html.=''.
	            	'<div id="divFechaCancelacion" style="left: 350px;position: fixed;top: 510px;">Huaraz, '.date('d-m-Y').'</div>';
	            }
	            $html.=''.
	            '<div id="divSubTotal" style="left: 680px;position: fixed;top: 475px;">'.($tReciboVenta->subTotal).'</div>'.
	            '<div id="divIgv" style="left: 680px;position: fixed;top: 500px;">'.($tReciboVenta->igv).'</div>'.
            	'<div id="divTotal" style="left: 680px;position: fixed;top: 525px;">'.($tReciboVenta->total).'</div>'.
			'</body>'.
			'</html>';

		$headers=array('Content-Type' => 'application/pdf');

		return Response::make(PDF::load($html, 'A4', 'portrait')->show($codigoReciboVenta), 200, $headers);
	}

	public function actionGuiaRemisionVenta($codigoReciboVenta)
	{
		$tReciboVenta=TReciboVenta::with('TReciboVentaDetalle')->find($codigoReciboVenta);
		
		$html=''.
			'<!doctype html>'.
			'<html lang="es">'.
			'<head>'.
				'<meta charset="UTF-8">'.
				'<title>Document</title>'.
				'<style>'.
					'.table td'.
					'{'.
						'border-bottom: 1px solid #999999;'.
						'margin: 0px;'.
						'padding: 4px;'.
					'}'.
					'.table th'.
					'{'.
						'border: 1px solid #000000;'.
						'padding: 7px;'.
					'}'.
					'.textAlignCenter'.
					'{'.
						'text-align: center;'.
					'}'.
					'.textAlignLeft'.
					'{'.
						'text-align: left'.
					'}'.
					'.textAlignRight'.
					'{'.
						'text-align: right'.
					'}'.
				'</style>'.
			'</head>'.
			'<body style="font-size: 12px;">'.
				'<img id="imgLogo" src="img/logoCliente.png" height="54" style="border-right: 1px solid #999999;left: 0px;position: fixed;top: 0px;">'.
				'<div id="divTipoComprobante" style="font-size: 22px;left: 200px;position: fixed;top: 10px;">'.iconv('UTF-8', 'windows-1252', 'Guía de remisión para venta').'</div>'.
				'<div id="divFechaEmision" style="left: 525px;position: fixed;top: 0px;">Generado el: '.date('d-m-Y H:i:s').'</div>'.
				'<div style="display: inline-block;font-size: 11px;left: 200px;position: fixed;top: 35px;">'.$codigoReciboVenta.'</div>'.
				'<div id="divSeparadorCabecera" style="background-color: #999999;left: 0px;height: 1px;position: fixed;top: 60px;"></div>'.
				'<div id="divCliente" style="left: 0px;position: fixed;top: 80px;"><div style="display: inline-block;width: 110px;"><b>'.iconv('UTF-8', 'windows-1252', 'Señor(es):').'</b></div>'.iconv('UTF-8', 'windows-1252', $tReciboVenta->nombreCompletoReceptor).'</div>'.
				'<div id="divDocumento" style="left: 0px;position: fixed;top: 100px;"><div style="display: inline-block;width: 110px;"><b>Documento:</b></div>'.($tReciboVenta->documentoReceptor).'</div>'.
				'<div id="divDireccionEnvio" style="left: 0px;position: fixed;top: 120px;"><div style="display: inline-block;width: 110px;"><b>'.iconv('UTF-8', 'windows-1252', 'Dirección de envío:').'</b></div>'.iconv('UTF-8', 'windows-1252', $tReciboVenta->direccionEnvioReceptor).'</div>'.
				'<div id="divFlete" style="left: 0px;position: fixed;top: 140px;"><div style="display: inline-block;width: 110px;"><b>Flete:</b></div>'.('S/. '.($tReciboVenta->flete)).'</div>'.
				'<div id="divFechaEmisionGuiaRemisionVenta" style="left: 400px;position: fixed;top: 80px;"><div style="display: inline-block;width: 145px;"><b>'.iconv('UTF-8', 'windows-1252', 'Fecha de envío:').'</b></div>'.date('d-m-Y H:i:s').'</div>'.
				'<div id="divLocalPartida" style="left: 400px;position: fixed;top: 100px;"><div style="display: inline-block;width: 145px;"><b>Oficina/Tienda de partida:</b></div>'.iconv('UTF-8', 'windows-1252', explode(',', Session::get('local'))[1]).'</div>'.

	            '<div id="divComprobanteDetalle" style="left: 0px;position: fixed;top: 180px;">'.
	            	'<table class="table" style="width: 100%">'.
	            		'<thead>'.
	            			'<tr>'.
	            				'<th class="textAlignCenter" style="width: 50px;">Cantidad</th>'.
	            				'<th class="textAlignCenter">'.iconv('UTF-8', 'windows-1252', 'Descripción').'</th>'.
	            				'<th class="textAlignCenter" style="width: 100px;">Unidad de medida</th>'.
	            			'</tr>'.
	            		'</thead>'.
	            		'<tbody>';
	                    foreach($tReciboVenta->tReciboVentaDetalle as $value)
	                    {
							$html.=''.
							'<tr>'.
	                			'<td class="textAlignCenter">'.($value->cantidadProducto).'</td>'.
	                			'<td>'.iconv('UTF-8', 'windows-1252', $value->primerNombreProducto.' / '.$value->segundoNombreProducto.' / '.$value->tercerNombreProducto).'</td>'.
								'<td class="textAlignCenter">'.iconv('UTF-8', 'windows-1252', $value->unidadMedidaProducto).'</td>'.
	                		'</tr>';
	                    }
						$html.=''.
	        			'</tbody>'.
	            	'</table>'.
	            '</div>'.

	            '<table style="left: 0px;position: fixed;top: 950px;width: 100%">'.
            		'<thead>'.
            			'<tr>'.
            				'<th style="width: 25%;">Documento del transportista</th>'.
            				'<th style="width: 25%;">Nombre del transportista</th>'.
            				'<th style="width: 25%;">Licencia de conducir del transportista</th>'.
            				'<th style="width: 25%;">'.iconv('UTF-8', 'windows-1252', 'Marca y/o placa del vehículo').'</th>'.
            			'</tr>'.
            		'</thead>'.
            		'<tbody>'.
						'<tr>'.
                			'<td class="textAlignCenter">'.iconv('UTF-8', 'windows-1252', $tReciboVenta->documentoTransportista).'</td>'.
                			'<td class="textAlignCenter">'.iconv('UTF-8', 'windows-1252', $tReciboVenta->nombreCompletoTransportista).'</td>'.
							'<td class="textAlignCenter">'.iconv('UTF-8', 'windows-1252', $tReciboVenta->licenciaConducirTransportista).'</td>'.
							'<td class="textAlignCenter">'.iconv('UTF-8', 'windows-1252', $tReciboVenta->marcaPlacaAutoMovilTransportista).'</td>'.
                		'</tr>'.
        			'</tbody>'.
            	'</table>'.
			'</body>'.
			'</html>';

		$headers=array('Content-Type' => 'application/pdf');

		return Response::make(PDF::load($html, 'A4', 'portrait')->show('my_pdf'), 200, $headers);
	}

	public function actionGuiaRemisionEnvioProductoAlmacenOficina($codigoProductoEnviarStock)
	{
		$tProductoEnviarStock=TProductoEnviarStock::with('TOficina', 'TAlmacen', 'TProductoEnviarStockDetalle')->find($codigoProductoEnviarStock);
		
		$html=''.
			'<!doctype html>'.
			'<html lang="es">'.
			'<head>'.
				'<meta charset="UTF-8">'.
				'<title>Document</title>'.
				'<style>'.
					'.table td'.
					'{'.
						'border-bottom: 1px solid #999999;'.
						'margin: 0px;'.
						'padding: 4px;'.
					'}'.
					'.table th'.
					'{'.
						'border: 1px solid #000000;'.
						'padding: 7px;'.
					'}'.
					'.textAlignCenter'.
					'{'.
						'text-align: center;'.
					'}'.
					'.textAlignLeft'.
					'{'.
						'text-align: left'.
					'}'.
					'.textAlignRight'.
					'{'.
						'text-align: right'.
					'}'.
				'</style>'.
			'</head>'.
			'<body style="font-size: 12px;">'.
				'<img id="imgLogo" src="img/logoCliente.png" height="54" style="border-right: 1px solid #999999;left: 0px;position: fixed;top: 0px;">'.
				'<div id="divTipoComprobante" style="font-size: 22px;left: 200px;position: fixed;top: 10px;">'.iconv('UTF-8', 'windows-1252', 'Guía de remisión para traslado').'</div>'.
				'<div id="divFechaEmision" style="left: 525px;position: fixed;top: 0px;">Generado el: '.date('d-m-Y H:i:s').'</div>'.
				'<div style="display: inline-block;font-size: 11px;left: 200px;position: fixed;top: 35px;">'.$codigoProductoEnviarStock.'</div>'.
				'<div id="divSeparadorCabecera" style="background-color: #999999;left: 0px;height: 1px;position: fixed;top: 60px;"></div>'.
				'<div id="divCliente" style="left: 0px;position: fixed;top: 80px;"><div style="display: inline-block;width: 110px;"><b>'.iconv('UTF-8', 'windows-1252', 'Almacén de partida:').'</b></div>'.iconv('UTF-8', 'windows-1252', $tProductoEnviarStock->tAlmacen->descripcion).'</div>'.
				'<div id="divDocumento" style="left: 0px;position: fixed;top: 100px;"><div style="display: inline-block;width: 110px;"><b>Oficina de llegada:</b></div>'.iconv('UTF-8', 'windows-1252', $tProductoEnviarStock->tOficina->descripcion).'</div>'.
				'<div id="divFechaEmisionGuiaRemision" style="left: 500px;position: fixed;top: 80px;"><div style="display: inline-block;width: 90px;"><b>'.iconv('UTF-8', 'windows-1252', 'Fecha de envío:').'</b></div>'.date('d-m-Y H:i:s').'</div>'.
				'<div id="divFleteGuiaRemision" style="left: 500px;position: fixed;top: 100px;"><div style="display: inline-block;width: 90px;"><b>Flete:</b></div>'.('S/. '.$tProductoEnviarStock->flete).'</div>'.
	            '<div id="divComprobanteDetalle" style="left: 0px;position: fixed;top: 140px;">'.
	            	'<table class="table" style="width: 100%;">'.
	            		'<thead>'.
	            			'<tr>'.
	                			'<th class="textAlignCenter" style="width: 50px;"><b>Cantidad</b></th>'.
	                			'<th class="textAlignCenter"><b>'.iconv('UTF-8', 'windows-1252', 'Descripción').'</b></th>'.
	                			'<th class="textAlignCenter" style="width: 100px;"><b>Unidad de medida</b></th>'.
	                		'</tr>'.
	            		'</thead>'.
	            		'<tbody>';
	                    foreach($tProductoEnviarStock->tProductoEnviarStockDetalle as $value)
	                    {
							$html.=''.
							'<tr>'.
	                			'<td class=" textAlignCenter">'.($value->cantidadProducto).'</td>'.
	                			'<td>'.iconv('UTF-8', 'windows-1252', $value->primerNombreProducto.' / '.$value->segundoNombreProducto.' / '.$value->tercerNombreProducto).'</td>'.
	                			'<td class=" textAlignCenter">'.iconv('UTF-8', 'windows-1252', $value->tUnidadMedida->nombre).'</td>'.
	                		'</tr>';
	                    }
						$html.=''.
	        			'</tbody>'.
	            	'</table>'.
	            '</div>'.
			'</body>'.
			'</html>';

		$headers=array('Content-Type' => 'application/pdf');

		return Response::make(PDF::load($html, 'A4', 'portrait')->show('my_pdf'), 200, $headers);
	}

	public function actionGuiaRemisionTrasladoProductoOficina($codigoProductoTrasladoOficina)
	{
		$tProductoTrasladoOficina=TProductoTrasladoOficina::with('TOficina', 'tOficinaLlegada', 'TProductoTrasladoOficinaDetalle')->find($codigoProductoTrasladoOficina);
		
		$html=''.
			'<!doctype html>'.
			'<html lang="es">'.
			'<head>'.
				'<meta charset="UTF-8">'.
				'<title>Document</title>'.
				'<style>'.
					'.table td'.
					'{'.
						'border-bottom: 1px solid #999999;'.
						'margin: 0px;'.
						'padding: 4px;'.
					'}'.
					'.table th'.
					'{'.
						'border: 1px solid #000000;'.
						'padding: 7px;'.
					'}'.
					'.textAlignCenter'.
					'{'.
						'text-align: center;'.
					'}'.
					'.textAlignLeft'.
					'{'.
						'text-align: left'.
					'}'.
					'.textAlignRight'.
					'{'.
						'text-align: right'.
					'}'.
				'</style>'.
			'</head>'.
			'<body style="font-size: 12px;">'.
				'<img id="imgLogo" src="img/logoCliente.png" height="54" style="border-right: 1px solid #999999;left: 0px;position: fixed;top: 0px;">'.
				'<div id="divTipoComprobante" style="font-size: 22px;left: 200px;position: fixed;top: 10px;">'.iconv('UTF-8', 'windows-1252', 'Guía de remisión para traslado').'</div>'.
				'<div id="divFechaEmision" style="left: 525px;position: fixed;top: 0px;">Generado el: '.date('d-m-Y H:i:s').'</div>'.
				'<div style="display: inline-block;font-size: 11px;left: 200px;position: fixed;top: 35px;">'.$codigoProductoTrasladoOficina.'</div>'.
				'<div id="divSeparadorCabecera" style="background-color: #999999;left: 0px;height: 1px;position: fixed;top: 60px;"></div>'.
				'<div id="divCliente" style="left: 0px;position: fixed;top: 80px;"><div style="display: inline-block;width: 110px;"><b>Oficina de partida:</b></div>'.iconv('UTF-8', 'windows-1252', $tProductoTrasladoOficina->tOficina->descripcion).'</div>'.
				'<div id="divDocumento" style="left: 0px;position: fixed;top: 100px;"><div style="display: inline-block;width: 110px;"><b>Oficina de llegada:</b></div>'.iconv('UTF-8', 'windows-1252', $tProductoTrasladoOficina->tOficinaLlegada->descripcion).'</div>'.
				'<div id="divFechaEmisionGuiaRemision" style="left: 500px;position: fixed;top: 80px;"><div style="display: inline-block;width: 90px;"><b>'.iconv('UTF-8', 'windows-1252', 'Fecha de envío:').'</b></div>'.date('d-m-Y H:i:s').'</div>'.
				'<div id="divFleteGuiaRemision" style="left: 500px;position: fixed;top: 100px;"><div style="display: inline-block;width: 90px;"><b>Flete:</b></div>'.('S/. '.$tProductoTrasladoOficina->flete).'</div>'.
	            '<div id="divComprobanteDetalle" style="left: 0px;position: fixed;top: 140px;">'.
	            	'<table class="table" style="width: 100%;">'.
	            		'<thead>'.
	            			'<tr>'.
	                			'<th class="textAlignCenter" style="width: 50px;"><b>Cantidad</b></th>'.
	                			'<th class="textAlignCenter"><b>'.iconv('UTF-8', 'windows-1252', 'Descripción').'</b></th>'.
	                			'<th class="textAlignCenter" style="width: 100px;"><b>Unidad de medida</b></th>'.
	                		'</tr>'.
	            		'</thead>'.
	            		'<tbody>';
	                    foreach($tProductoTrasladoOficina->tProductoTrasladoOficinaDetalle as $value)
	                    {
							$html.=''.
							'<tr>'.
	                			'<td class=" textAlignCenter">'.($value->cantidadProducto).'</td>'.
	                			'<td>'.iconv('UTF-8', 'windows-1252', $value->primerNombreProducto.' / '.$value->segundoNombreProducto.' / '.$value->tercerNombreProducto).'</td>'.
	                			'<td class=" textAlignCenter">'.iconv('UTF-8', 'windows-1252', $value->unidadMedidaProducto).'</td>'.
	                		'</tr>';
	                    }
						$html.=''.
	        			'</tbody>'.
	            	'</table>'.
	            '</div>'.
			'</body>'.
			'</html>';

		$headers=array('Content-Type' => 'application/pdf');

		return Response::make(PDF::load($html, 'A4', 'portrait')->show('my_pdf'), 200, $headers);
	}

	public function actionProforma()
	{
		$nombreCompletoCliente=Input::get('cbxTipoRecibo')!='Factura' ? Input::get('txtNombreClienteNatural').' '.Input::get('txtApellidoPaternoClienteNatural').' '.Input::get('txtApellidoMaternoClienteNatural') : Input::get('txtRazonSocialLargaClienteJuridico');
		$documentoCliente=Input::get('cbxTipoRecibo')!='Factura' ? Input::get('txtDniClienteNatural') : Input::get('txtRucClienteJuridico');
		$direccionCliente=Input::get('cbxTipoRecibo')!='Factura' ? Input::get('txtDireccionClienteNatural') : Input::get('txtDireccionClienteJuridico');
		$descripcion=trim(Input::get('txtDescripcion'))!='' ? Input::get('txtDescripcion') : '...';

		$tOficina=TOficina::find(explode(',', Session::get('local'))[0]);

		$html=''.
			'<!doctype html>'.
			'<html lang="es">'.
			'<head>'.
				'<meta charset="UTF-8">'.
				'<title>Document</title>'.
				'<style>'.
					'.table td'.
					'{'.
						'border-bottom: 1px solid #999999;'.
						'margin: 0px;'.
						'padding: 4px;'.
					'}'.
					'.table th'.
					'{'.
						'border: 1px solid #000000;'.
						'padding: 7px;'.
					'}'.
					'.textAlignCenter'.
					'{'.
						'text-align: center;'.
					'}'.
					'.textAlignLeft'.
					'{'.
						'text-align: left'.
					'}'.
					'.textAlignRight'.
					'{'.
						'text-align: right'.
					'}'.
				'</style>'.
			'</head>'.
			'<body style="font-size: 12px;">'.
				'<img id="imgLogo" src="img/logoCliente.png" height="54" style="border-right: 1px solid #999999;left: 0px;position: fixed;top: 0px;">'.
				'<div id="divTipoComprobante" style="font-size: 22px;left: 300px;position: fixed;top: 10px;">COTIZACIÓN</div>'.
				'<div id="divFechaEmision" style="left: 525px;position: fixed;top: 0px;">Generado el: '.date('d-m-Y H:i:s').'</div>'.
				'<div id="divSeparadorCabecera" style="background-color: #999999;left: 0px;height: 1px;position: fixed;top: 60px;"></div>'.
				'<div id="divCliente" style="left: 0px;position: fixed;top: 80px;"><div style="display: inline-block;width: 80px;"><b>'.iconv('UTF-8', 'windows-1252', 'Señor (es):').'</b></div>'.iconv('UTF-8', 'windows-1252', $nombreCompletoCliente).'</div>'.
				'<div id="divDireccion" style="left: 0px;position: fixed;top: 100px;"><div style="display: inline-block;width: 80px;"><b>'.iconv('UTF-8', 'windows-1252', 'Dirección:').'</b></div>'.iconv('UTF-8', 'windows-1252', $direccionCliente).'</div>'.
				'<div id="divPresente" style="left: 0px;position: fixed;top: 130px;"><b>Presente.-</b></div>'.
				'<div id="divPresenteDescripcion" style="left: 0px;position: fixed;top: 150px;">'.
					'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.
					iconv('UTF-8', 'windows-1252', 'Reciba un cordial saludo de parte nuestra y a su vez revise la propuesta que le presentamos lo cual Ud. solicitó para la cotización de los siguientes productos y/o servicios:').
				'</div>'.
	            '<div id="divComprobanteDetalle" style="left: 0px;position: fixed;top: 200px;">'.
	            	'<table class="table" style="width: 100%;">'.
	            		'<thead>'.
	            			'<tr>'.
	            				'<th style="width: 60px;">Cantidad</th>'.
	            				'<th>'.iconv('UTF-8', 'windows-1252', 'Descripción').'</th>'.
	            				'<th style="width: 100px;">Precio U. en S/.</th>'.
	            				'<th style="width: 100px;">Precio T. en S/.</th>'.
	            			'</tr>'.
	            		'</thead>'.
	            		'<tbody>';
	                    $listaProductos=explode('__SEPARADORREGISTRO__', Input::get('txtListaProductos'));

						foreach($listaProductos as $key => $value)
	                    {
	                    	$camposProducto=explode('__SEPARADORCAMPO__', $value);

							$html.=''.
							'<tr>'.
								'<td class="textAlignCenter">'.$camposProducto[13].'</td>'.
	                			'<td>'.iconv('UTF-8', 'windows-1252', $camposProducto[2].' / '.$camposProducto[3].' / '.$camposProducto[4]).'</td>'.
	                			'<td class="textAlignCenter">'.number_format(($camposProducto[17]/$camposProducto[13]), 2, '.', '').'</td>'.
	                			'<td class="textAlignCenter">'.$camposProducto[17].'</td>'.
	                		'</tr>';
	                    }
						$html.=''.
							'<tr>'.
								'<td colspan="2" style="border: none;"></td>'.
								'<td class="textAlignCenter"><b>Total:</b></td>'.
	                			'<td class="textAlignCenter">'.Input::get('txtTotal').'</td>'.
	                		'</tr>'.
	                		'<tr>'.
								'<td colspan="4" style="border: none;"></td>'.
	                		'</tr>'.
	                		'<tr>'.
	                			'<td colspan="4" style="border: none;"><b>El precio incluye IGV</b></td>'.
	                		'</tr>'.
	                		'<tr>'.
								'<td colspan="4" style="border: none;"></td>'.
	                		'</tr>'.
	                		'<tr>'.
	                			'<td colspan="4" style="border: none;"><b>'.iconv('UTF-8', 'windows-1252', 'Descripción adicional:').'</b></td>'.
	                		'</tr>'.
	                		'<tr>'.
	                			'<td colspan="4" style="border: none;">'.iconv('UTF-8', 'windows-1252', $descripcion).'</td>'.
	                		'</tr>'.
	        			'</tbody>'.
	            	'</table>'.
	            '</div>'.
	            '<div id="divSeparadorPie" style="background-color: #999999;left: 0px;height: 2px;position: fixed;top: 1000px;"></div>'.
				'<div id="divDatosContacto" class="textAlignCenter" style="left: 0px;font-size: 16px;position: fixed;top: 1020px;">'.iconv('UTF-8', 'windows-1252', $tOficina->direccion.' | '.$tOficina->distrito.'-'.$tOficina->departamento.' | Telf./Cel.:  '.$tOficina->telefono).'</div>'.
			'</body>'.
			'</html>';

		$headers=array('Content-Type' => 'application/pdf');

		return Response::make(PDF::load($html, 'A4', 'portrait')->show('my_pdf'), 200, $headers);
	}

	public function actionProductosAgotadosPorAgotarseStock()
	{
		set_time_limit(0);
		ini_set('memory_limit', '500M');

		$listaTOficinaProductoStockReducido=TOficinaProducto::with('TOficina')->whereRaw('cantidad<=? and estado=? order by primerNombre asc', [10, true])->get();
		
		$data=[];

		array_push($data, array('PRODUCTOS AGOTADOS Y POR AGOTARSE EN STOCK'));
        array_push($data, array('REPORTE GENERADO EL', date('m-d-Y')));
        array_push($data, array(''));
        array_push($data, array('OFICINA/TIENDA', 'CÓDIGO DE BARRAS', 'NOMBRE', 'TIPO', 'PRESENTACIÓN', 'UNIDAD DE MEDIDA', 'CANTIDAD', 'FECHA DE VENCIMIENTO'));

        foreach($listaTOficinaProductoStockReducido as $key => $value)
        {
        	array_push($data, array($value->tOficina->descripcion, $value->codigoBarras, $value->primerNombre.' / '.$value->segundoNombre.' / '.$value->tercerNombre, $value->tipo, $value->presentacion, $value->unidadMedida, number_format($value->cantidad, 3, '.', ''), $value->fechaVencimiento));
        }

		Excel::create('PRODUCTOS AGOTADOS Y POR AGOTARSE EN STOCK', function($excel) use($data)
		{
		    $excel->sheet('Sheetname', function($sheet) use($data)
		    {
		    	$sheet->mergeCells('A1:K1');
		    	$sheet->setAutoSize(true);
		    	$sheet->setHeight(1, 50);

		    	$sheet->cells('A1', function($cells)
		    	{
		    		$cells->setAlignment('center');
		    		$cells->setValignment('center');
		    		$cells->setBackground('#1497CC');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontSize(13);
				});

				$sheet->cells('A2:K2', function($cells)
		    	{
		    		$cells->setBackground('#000000');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontWeight('bold');
				});

				$sheet->cells('A4:K4', function($cells)
		    	{
		    		$cells->setBackground('#C0504D');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontWeight('bold');
				});

		        $sheet->fromArray($data,
		        	null,
		        	'A1',
		        	false,
		        	false
		        );
		    });

		})->export('xlsx');
	}

	public function actionProductosAgotadosPorAgotarseAlmacen()
	{
		set_time_limit(0);
		ini_set('memory_limit', '500M');

		$listaTOficinaProductoAlmacenReducido=TAlmacenProducto::with('TAlmacen', 'TPresentacion', 'TUnidadMedida')->whereRaw('cantidad<=? and estado=? order by primerNombre asc', [10, true])->get();
		
		$data=[];

		array_push($data, array('PRODUCTOS AGOTADOS Y POR AGOTARSE EN ALMACÉN'));
        array_push($data, array('REPORTE GENERADO EL', date('m-d-Y')));
        array_push($data, array(''));
        array_push($data, array('ALMACÉN', 'CÓDIGO DE BARRAS', 'NOMBRE', 'TIPO', 'PRESENTACIÓN', 'UNIDAD DE MEDIDA', 'CANTIDAD', 'FECHA DE VENCIMIENTO'));

        foreach($listaTOficinaProductoAlmacenReducido as $key => $value)
        {
        	array_push($data, array($value->tAlmacen->descripcion, $value->codigoBarras, $value->primerNombre.' / '.$value->segundoNombre.' / '.$value->tercerNombre, $value->tipo, $value->tPresentacion->nombre, $value->tUnidadMedida->nombre, number_format($value->cantidad, 3, '.', ''), $value->fechaVencimiento));
        }

		Excel::create('PRODUCTOS AGOTADOS Y POR AGOTARSE EN ALMACÉN', function($excel) use($data)
		{
		    $excel->sheet('Sheetname', function($sheet) use($data)
		    {
		    	$sheet->mergeCells('A1:K1');
		    	$sheet->setAutoSize(true);
		    	$sheet->setHeight(1, 50);

		    	$sheet->cells('A1', function($cells)
		    	{
		    		$cells->setAlignment('center');
		    		$cells->setValignment('center');
		    		$cells->setBackground('#1497CC');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontSize(13);
				});

				$sheet->cells('A2:K2', function($cells)
		    	{
		    		$cells->setBackground('#000000');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontWeight('bold');
				});

				$sheet->cells('A4:K4', function($cells)
		    	{
		    		$cells->setBackground('#C0504D');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontWeight('bold');
				});

		        $sheet->fromArray($data,
		        	null,
		        	'A1',
		        	false,
		        	false
		        );
		    });

		})->export('xlsx');
	}

	public function actionProductosPorVencerseStock()
	{
		set_time_limit(0);
		ini_set('memory_limit', '500M');

		$listaTOficinaProductoPorVencerse=TOficinaProducto::with('TOficina')->whereRaw('estado=? and fechaVencimiento between ? and ? and fechaVencimiento!=? order by primerNombre asc', [true, '2000-01-01', date('Y-m-d', strtotime(date('Y-m-d')." +10 day")), '1111-11-11'])->get();
		
		$data=[];

		array_push($data, array('PRODUCTOS POR VENCERSE EN STOCK'));
        array_push($data, array('REPORTE GENERADO EL', date('m-d-Y')));
        array_push($data, array(''));
        array_push($data, array('OFICINA/TIENDA', 'CÓDIGO DE BARRAS', 'NOMBRE', 'TIPO', 'PRESENTACIÓN', 'UNIDAD DE MEDIDA', 'CANTIDAD', 'FECHA DE VENCIMIENTO'));

        foreach($listaTOficinaProductoPorVencerse as $key => $value)
        {
        	array_push($data, array($value->tOficina->descripcion, $value->codigoBarras, $value->primerNombre.' / '.$value->segundoNombre.' / '.$value->tercerNombre, $value->tipo, $value->presentacion, $value->unidadMedida, number_format($value->cantidad, 3, '.', ''), $value->fechaVencimiento));
        }

		Excel::create('PRODUCTOS POR VENCERSE EN STOCK', function($excel) use($data)
		{
		    $excel->sheet('Sheetname', function($sheet) use($data)
		    {
		    	$sheet->mergeCells('A1:K1');
		    	$sheet->setAutoSize(true);
		    	$sheet->setHeight(1, 50);

		    	$sheet->cells('A1', function($cells)
		    	{
		    		$cells->setAlignment('center');
		    		$cells->setValignment('center');
		    		$cells->setBackground('#1497CC');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontSize(13);
				});

				$sheet->cells('A2:K2', function($cells)
		    	{
		    		$cells->setBackground('#000000');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontWeight('bold');
				});

				$sheet->cells('A4:K4', function($cells)
		    	{
		    		$cells->setBackground('#C0504D');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontWeight('bold');
				});

		        $sheet->fromArray($data,
		        	null,
		        	'A1',
		        	false,
		        	false
		        );
		    });

		})->export('xlsx');
	}

	public function actionProductosPorVencerseAlmacen()
	{
		set_time_limit(0);
		ini_set('memory_limit', '500M');

		$listaTAlmacenProductoPorVencerse=TAlmacenProducto::with('TAlmacen', 'TPresentacion', 'TUnidadMedida')->whereRaw('estado=? and fechaVencimiento between ? and ? and fechaVencimiento!=? order by primerNombre asc', [true, '2000-01-01', date('Y-m-d', strtotime(date('Y-m-d')." +10 day")), '1111-11-11'])->get();
		
		$data=[];

		array_push($data, array('PRODUCTOS POR VENCERSE EN ALMACÉN'));
        array_push($data, array('REPORTE GENERADO EL', date('m-d-Y')));
        array_push($data, array(''));
        array_push($data, array('ALMACÉN', 'CÓDIGO DE BARRAS', 'NOMBRE', 'TIPO', 'PRESENTACIÓN', 'UNIDAD DE MEDIDA', 'CANTIDAD', 'FECHA DE VENCIMIENTO'));

        foreach($listaTAlmacenProductoPorVencerse as $key => $value)
        {
        	array_push($data, array($value->tAlmacen->descripcion, $value->codigoBarras, $value->primerNombre.' / '.$value->segundoNombre.' / '.$value->tercerNombre, $value->tipo, $value->tPresentacion->nombre, $value->tUnidadMedida->nombre, number_format($value->cantidad, 3, '.', ''), $value->fechaVencimiento));
        }

		Excel::create('PRODUCTOS POR VENCERSE EN ALMACÉN', function($excel) use($data)
		{
		    $excel->sheet('Sheetname', function($sheet) use($data)
		    {
		    	$sheet->mergeCells('A1:K1');
		    	$sheet->setAutoSize(true);
		    	$sheet->setHeight(1, 50);

		    	$sheet->cells('A1', function($cells)
		    	{
		    		$cells->setAlignment('center');
		    		$cells->setValignment('center');
		    		$cells->setBackground('#1497CC');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontSize(13);
				});

				$sheet->cells('A2:K2', function($cells)
		    	{
		    		$cells->setBackground('#000000');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontWeight('bold');
				});

				$sheet->cells('A4:K4', function($cells)
		    	{
		    		$cells->setBackground('#C0504D');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontWeight('bold');
				});

		        $sheet->fromArray($data,
		        	null,
		        	'A1',
		        	false,
		        	false
		        );
		    });

		})->export('xlsx');
	}

	public function actionComprasPorPagar()
	{
		set_time_limit(0);
		ini_set('memory_limit', '500M');

		Excel::create('COMPRAS POR PAGAR_'.date('Y-m-d'), function($excel)
		{
			$excel->sheet('Sheetname', function($sheet)
		    {
		    	$sheet->mergeCells('A1:O1');
		    	$sheet->setAutoSize(true);
		    	$sheet->setHeight(1, 25);

		    	$sheet->cells('A1', function($cells)
		    	{
		    		$cells->setAlignment('center');
		    		$cells->setValignment('center');
		    		$cells->setBackground('#1497CC');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontSize(13);
				});

				$sheet->cells('A2:O2', function($cells)
		    	{
		    		$cells->setBackground('#000000');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontWeight('bold');
				});

				$sheet->cells('A4:O4', function($cells)
		    	{
		    		$cells->setBackground('#C0504D');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontWeight('bold');
				});

		        $listaTReciboCompraPorPagar=TReciboCompra::with('TAlmacen', 'TProveedor')->whereRaw('tipoPago=? and estadoCredito=? and estado=?', ['Al Crédito', false, true])->get();
		
				$data=[];

				array_push($data, array('COMPRAS POR PAGAR'));
		        array_push($data, array('REPORTE GENERADO EL', date('m-d-Y')));
		        array_push($data, array(''));
		        array_push($data, array('DOCUMENTO DEL PROVEEDOR', 'PROVEEDOR', 'COMPROBANTE', 'Nº DE COMPROBANTE', 'ALMACÉN', 'MONTO TOTAL DE COMPRA', 'FECHA A PAGAR', 'FECHA DE COMPRA'));

		        $totalPorPagar=0;
		        $lineaActual=4;

		        foreach($listaTReciboCompraPorPagar as $key => $value)
		        {
		        	array_push($data, array($value->tProveedor->documentoIdentidad, $value->tProveedor->nombre, $value->tipoRecibo, $value->numeroRecibo, $value->tAlmacen->descripcion, $value->total, $value->fechaPagar, (string)$value->created_at));
		        	$lineaActual++;

		        	$sheet->cells('A'.$lineaActual.':O'.$lineaActual, function($cells)
			    	{
			    		$cells->setBackground('#E9EAED');
					});

		        	array_push($data, array('', 'DETALLE DE PAGOS'));
		        	$lineaActual++;

		        	$sheet->cells('A'.$lineaActual.':O'.$lineaActual, function($cells)
			    	{
			    		$cells->setFontWeight('bold');
					});

		        	array_push($data, array('', 'DESCRIPCIÓN', 'FECHA', 'MONTO'));
		        	$lineaActual++;

		        	$sheet->cells('A'.$lineaActual.':O'.$lineaActual, function($cells)
			    	{
			    		$cells->setFontWeight('bold');
					});

					$pagado=0;

		        	foreach($value->tReciboCompraPago as $index => $item)
		        	{
		        		array_push($data, array('', $item->descripcion, (string)$item->created_at, $item->monto));
		        		$lineaActual++;

		        		$pagado+=$item->monto;
		        	}

		        	array_push($data, array('', '', '', 'Falta pagar: '.number_format(($value->total)-($pagado), 2, '.', '')));
		        	$lineaActual++;

		        	$totalPorPagar+=($value->total)-($pagado);

		        	$sheet->cells('A'.$lineaActual.':O'.$lineaActual, function($cells)
			    	{
			    		$cells->setFontWeight('bold');
					});
		        }

		        array_push($data, array(''));
		        array_push($data, array('EN TOTAL FALTA PAGAR', number_format($totalPorPagar, 2, '.', '')));

		        $sheet->fromArray($data,
		        	null,
		        	'A1',
		        	false,
		        	false
		        );
		    });
		})->export('xlsx');
	}

	public function actionVentasPorCobrarPagos()
	{
		set_time_limit(0);
		ini_set('memory_limit', '500M');

		Excel::create('VENTAS POR COBRAR (PAGOS EN GENERAL)_'.date('Y-m-d'), function($excel)
		{
			$excel->sheet('Sheetname', function($sheet)
		    {
		    	$sheet->mergeCells('A1:O1');
		    	$sheet->setAutoSize(true);
		    	$sheet->setHeight(1, 25);

		    	$sheet->cells('A1', function($cells)
		    	{
		    		$cells->setAlignment('center');
		    		$cells->setValignment('center');
		    		$cells->setBackground('#1497CC');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontSize(13);
				});

				$sheet->cells('A2:O2', function($cells)
		    	{
		    		$cells->setBackground('#000000');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontWeight('bold');
				});

				$sheet->cells('A4:O4', function($cells)
		    	{
		    		$cells->setBackground('#C0504D');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontWeight('bold');
				});

		        $listaTReciboVentaPorCobrar=TReciboVenta::with('TOficina')->whereRaw('tipoPago=? and estadoCredito=? and estado=?', ['Al Crédito', false, true])->get();
		
				$data=[];

				array_push($data, array('VENTAS POR COBRAR (PAGOS EN GENERAL)'));
		        array_push($data, array('REPORTE GENERADO EL', date('m-d-Y')));
		        array_push($data, array(''));
		        array_push($data, array('DOCUMENTO DEL CLIENTE', 'CLIENTE', 'DIRECCIÓN DEL CLIENTE', 'OFICINA/TIENDA', 'COMPROBANTE', 'Nº DE COMPROBANTE', 'MONTO TOTAL DE LA VENTA', 'FECHA DE VENTA'));

		        $totalPorCobrar=0;
		        $lineaActual=4;

		        foreach($listaTReciboVentaPorCobrar as $key => $value)
		        {
		        	array_push($data, array($value->documentoCliente, $value->nombreCompletoCliente, $value->direccionCliente, $value->tOficina->descripcion, $value->tipoRecibo, $value->numeroRecibo, $value->total, (string)$value->created_at));
		        	$lineaActual++;

		        	$sheet->cells('A'.$lineaActual.':O'.$lineaActual, function($cells)
			    	{
			    		$cells->setBackground('#E9EAED');
					});

		        	array_push($data, array('', 'DETALLE DE PAGOS'));
		        	$lineaActual++;

		        	$sheet->cells('A'.$lineaActual.':O'.$lineaActual, function($cells)
			    	{
			    		$cells->setFontWeight('bold');
					});

		        	array_push($data, array('', 'DESCRIPCIÓN', 'FECHA', 'MONTO'));
		        	$lineaActual++;

		        	$sheet->cells('A'.$lineaActual.':O'.$lineaActual, function($cells)
			    	{
			    		$cells->setFontWeight('bold');
					});

					$cobrado=0;

		        	foreach($value->tReciboVentaPago as $index => $item)
		        	{
		        		array_push($data, array('', $item->descripcion, (string)$item->created_at, $item->monto));
		        		$lineaActual++;

		        		$cobrado+=$item->monto;
		        	}

		        	array_push($data, array('', '', '', 'Falta cobrar: '.number_format(($value->total)-($cobrado), 2, '.', '')));
		        	$lineaActual++;

		        	$totalPorCobrar+=($value->total)-($cobrado);

		        	$sheet->cells('A'.$lineaActual.':O'.$lineaActual, function($cells)
			    	{
			    		$cells->setFontWeight('bold');
					});
		        }

		        array_push($data, array(''));
		        array_push($data, array('EN TOTAL FALTA COBRAR', number_format($totalPorCobrar, 2, '.', '')));

		        $sheet->fromArray($data,
		        	null,
		        	'A1',
		        	false,
		        	false
		        );
		    });
		})->export('xlsx');
	}

	public function actionVentasPorCobrarLetras()
	{
		set_time_limit(0);
		ini_set('memory_limit', '500M');

		Excel::create('VENTAS POR COBRAR (PAGOS POR LETRAS)_'.date('Y-m-d'), function($excel)
		{
			$excel->sheet('Sheetname', function($sheet)
		    {
		    	$sheet->mergeCells('A1:O1');
		    	$sheet->setAutoSize(true);
		    	$sheet->setHeight(1, 25);

		    	$sheet->cells('A1', function($cells)
		    	{
		    		$cells->setAlignment('center');
		    		$cells->setValignment('center');
		    		$cells->setBackground('#1497CC');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontSize(13);
				});

				$sheet->cells('A2:O2', function($cells)
		    	{
		    		$cells->setBackground('#000000');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontWeight('bold');
				});

				$sheet->cells('A4:O4', function($cells)
		    	{
		    		$cells->setBackground('#C0504D');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontWeight('bold');
				});

		        $listaTReciboVentaPorCobrar=TReciboVenta::with('TOficina')->whereRaw('tipoPago=? and estadoCredito=? and estado=?', ['Al Crédito', false, true])->get();
		
				$data=[];

				array_push($data, array('VENTAS POR COBRAR (PAGOS POR LETRAS)'));
		        array_push($data, array('REPORTE GENERADO EL', date('m-d-Y')));
		        array_push($data, array(''));
		        array_push($data, array('DOCUMENTO DEL CLIENTE', 'CLIENTE', 'DIRECCIÓN DEL CLIENTE', 'OFICINA/TIENDA', 'COMPROBANTE', 'Nº DE COMPROBANTE', 'MONTO TOTAL DE LA VENTA', 'FECHA DE VENTA'));

		        $totalPorCobrar=0;
		        $lineaActual=4;

		        foreach($listaTReciboVentaPorCobrar as $key => $value)
		        {
		        	array_push($data, array($value->documentoCliente, $value->nombreCompletoCliente, $value->direccionCliente, $value->tOficina->descripcion, $value->tipoRecibo, $value->numeroRecibo, $value->total, (string)$value->created_at));
		        	$lineaActual++;

		        	$sheet->cells('A'.$lineaActual.':O'.$lineaActual, function($cells)
			    	{
			    		$cells->setBackground('#E9EAED');
					});

		        	array_push($data, array('', 'DETALLE DE PAGOS'));
		        	$lineaActual++;

		        	$sheet->cells('A'.$lineaActual.':O'.$lineaActual, function($cells)
			    	{
			    		$cells->setFontWeight('bold');
					});

		        	array_push($data, array('', 'DÍAS ATRASADOS', 'POR PAGAR', 'PAGADO', 'FECHA A PAGAR', 'ESTADO'));
		        	$lineaActual++;

		        	$sheet->cells('A'.$lineaActual.':O'.$lineaActual, function($cells)
			    	{
			    		$cells->setFontWeight('bold');
					});

					$porPagarLetra=0;

		        	foreach($value->tReciboVentaLetra as $index => $item)
		        	{
		        		$diasRetrasados=($item->diasMora); 

		                if($item->estado==0)
		                {
	                        $diasRetrasados=((strtotime(date('Y-m-d'))-strtotime($item->fechaPagar))/86400) < 0 ? '0' : ((strtotime(date('Y-m-d'))-strtotime($item->fechaPagar))/86400);
	                        $porPagarLetra+=($item->porPagar);
		                }

		        		array_push($data, array('', (string)$diasRetrasados, $item->porPagar, $item->pagado, $item->fechaPagar, ($item->estado==0 ? 'Por pagar' : 'Pagado...')));
		        		$lineaActual++;
		        	}

		        	array_push($data, array('', '', 'Falta cobrar: '.number_format($porPagarLetra, 2, '.', '')));
		        	$lineaActual++;

		        	$totalPorCobrar+=$porPagarLetra;

		        	$sheet->cells('A'.$lineaActual.':O'.$lineaActual, function($cells)
			    	{
			    		$cells->setFontWeight('bold');
					});
		        }

		        array_push($data, array(''));
		        array_push($data, array('EN TOTAL FALTA COBRAR', number_format($totalPorCobrar, 2, '.', '')));

		        $sheet->fromArray($data,
		        	null,
		        	'A1',
		        	false,
		        	false
		        );
		    });
		})->export('xlsx');
	}

	public function actionProductosPorCodigoOficina($codigoOficina=null)
	{
		set_time_limit(0);
		ini_set('memory_limit', '500M');

		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		{
			return View::make('reporte/productosporcodigooficina');
		}

		$tOficina=TOficina::find($codigoOficina);
		$listaTOficinaProducto=TOficinaProducto::whereRaw('codigoOficina=? and estado=? order by primerNombre asc', [$codigoOficina, true])->get();
		
		$data=[];

		array_push($data, array('PRODUCTOS DE LA OFICINA: '.$tOficina->descripcion));
        array_push($data, array('REPORTE GENERADO EL', date('m-d-Y')));
        array_push($data, array(''));
        array_push($data, array('CÓDIGO DE BARRAS', 'NOMBRE', 'TIPO', 'PRESENTACIÓN', 'UNIDAD DE MEDIDA', 'CANTIDAD', 'PRECIO DE C. U.', 'PRECIO DE V. U.', 'FECHA DE VENCIMIENTO'));

        foreach($listaTOficinaProducto as $key => $value)
        {
        	array_push($data, array($value->codigoBarras, $value->primerNombre.' / '.$value->segundoNombre.' / '.$value->tercerNombre, $value->tipo, $value->presentacion, $value->unidadMedida, number_format($value->cantidad, 3, '.', ''), $value->precioCompraUnitario, $value->precioVentaUnitario, $value->fechaVencimiento));
        }

		Excel::create('PRODUCTOS POR OFICINA_'.date('Y-m-d'), function($excel) use($data)
		{
		    $excel->sheet('Sheetname', function($sheet) use($data)
		    {
		    	$sheet->mergeCells('A1:K1');
		    	$sheet->setAutoSize(true);
		    	$sheet->setHeight(1, 50);

		    	$sheet->cells('A1', function($cells)
		    	{
		    		$cells->setAlignment('center');
		    		$cells->setValignment('center');
		    		$cells->setBackground('#1497CC');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontSize(13);
				});

				$sheet->cells('A2:K2', function($cells)
		    	{
		    		$cells->setBackground('#000000');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontWeight('bold');
				});

				$sheet->cells('A4:K4', function($cells)
		    	{
		    		$cells->setBackground('#C0504D');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontWeight('bold');
				});

		        $sheet->fromArray($data,
		        	null,
		        	'A1',
		        	false,
		        	false
		        );
		    });

		})->export('xlsx');
	}

	public function actionProductosPorCodigoAlmacen($codigoAlmacen=null)
	{
		set_time_limit(0);
		ini_set('memory_limit', '500M');

		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		{
			return View::make('reporte/productosporcodigoalmacen');
		}

		$tAlmacen=TAlmacen::find($codigoAlmacen);
		$listaTAlmacenProducto=TAlmacenProducto::with('TPresentacion', 'TUnidadMedida')->whereRaw('codigoAlmacen=? and estado=? order by primerNombre asc', [$codigoAlmacen, true])->get();

		$data=[];

		array_push($data, array('PRODUCTOS DEL ALMACÉN: '.$tAlmacen->descripcion));
        array_push($data, array('REPORTE GENERADO EL', date('m-d-Y')));
        array_push($data, array(''));
        array_push($data, array('CÓDIGO DE BARRAS', 'NOMBRE', 'TIPO', 'PRESENTACIÓN', 'UNIDAD DE MEDIDA', 'CANTIDAD', 'PRECIO DE C. U.', 'PRECIO DE V. U.', 'FECHA DE VENCIMIENTO'));

        foreach($listaTAlmacenProducto as $key => $value)
        {
        	array_push($data, array($value->codigoBarras, $value->primerNombre.' / '.$value->segundoNombre.' / '.$value->tercerNombre, $value->tipo, $value->tPresentacion->nombre, $value->tUnidadMedida->nombre, number_format($value->cantidad, 3, '.', ''), $value->precioCompraUnitario, $value->precioVentaUnitario, $value->fechaVencimiento));
        }

		Excel::create('PRODUCTOS POR ALMACÉN_'.date('Y-m-d'), function($excel) use($data)
		{
		    $excel->sheet('Sheetname', function($sheet) use($data)
		    {
		    	$sheet->mergeCells('A1:K1');
		    	$sheet->setAutoSize(true);
		    	$sheet->setHeight(1, 50);

		    	$sheet->cells('A1', function($cells)
		    	{
		    		$cells->setAlignment('center');
		    		$cells->setValignment('center');
		    		$cells->setBackground('#1497CC');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontSize(13);
				});

				$sheet->cells('A2:K2', function($cells)
		    	{
		    		$cells->setBackground('#000000');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontWeight('bold');
				});

				$sheet->cells('A4:K4', function($cells)
		    	{
		    		$cells->setBackground('#C0504D');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontWeight('bold');
				});

		        $sheet->fromArray($data,
		        	null,
		        	'A1',
		        	false,
		        	false
		        );
		    });

		})->export('xlsx');
	}

	public function actionCompraEntreFechas($fechaInicial=null, $fechaFinal=null)
	{
		set_time_limit(0);
		ini_set('memory_limit', '500M');

		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		{
			return View::make('reporte/compraentrefechas');
		}

		Excel::create('COMPRAS REALIZADAS ENTRE DOS FECHAS_'.$fechaInicial.'_'.$fechaFinal, function($excel) use($fechaInicial, $fechaFinal)
		{
			$excel->sheet('Sheetname', function($sheet) use($fechaInicial, $fechaFinal)
		    {
		    	$sheet->mergeCells('A1:O1');
		    	$sheet->setAutoSize(true);
		    	$sheet->setHeight(1, 25);

		    	$sheet->cells('A1', function($cells)
		    	{
		    		$cells->setAlignment('center');
		    		$cells->setValignment('center');
		    		$cells->setBackground('#1497CC');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontSize(13);
				});

				$sheet->cells('A2:O4', function($cells)
		    	{
		    		$cells->setBackground('#000000');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontWeight('bold');
				});

				$sheet->cells('A6:O6', function($cells)
		    	{
		    		$cells->setBackground('#C0504D');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontWeight('bold');
				});

		        $listaTReciboCompra=TReciboCompra::with('TAlmacen', 'TProveedor', 'TReciboCompraDetalle')->whereRaw('created_at between ? and ?', [$fechaInicial, $fechaFinal])->get();
		
				$data=[];

				array_push($data, array('COMPRAS REALIZADAS ENTRE DOS FECHAS'));
		        array_push($data, array('REPORTE GENERADO EL', date('m-d-Y')));
		        array_push($data, array('FECHA INICIAL', $fechaInicial));
		        array_push($data, array('FECHA FINAL', $fechaFinal));
		        array_push($data, array(''));
		        array_push($data, array('ALMACÉN', 'DOCUMENTO PROVEEDOR', 'PROVEEDOR', 'TIPO DE PAGO', 'COMPROBANTE', 'Nº DE COMPROBANTE', 'FECHA EMISIÓN DE COMPROBANTE', 'ESTADO', 'FECHA DE LA COMPRA'));

		        $totalGeneral=0;
		        $totalContado=0;
		        $totalCredito=0;
		        $lineaActual=6;

		        foreach($listaTReciboCompra as $key => $value)
		        {
		        	if($value->estado)
		            {
		            	$totalGeneral+=($value->total);
		            }

		            if($value->estado && $value->tipoPago=='Al Contado')
		            {
		            	$totalContado+=($value->total);
		            }

		            if($value->estado && $value->tipoPago=='Al Crédito')
		            {
		            	$totalCredito+=($value->total);
		            }

		        	array_push($data, array($value->tAlmacen->descripcion, $value->tProveedor->documentoIdentidad, $value->tProveedor->nombre, $value->tipoPago, $value->tipoRecibo, $value->numeroRecibo, substr($value->fechaComprobanteEmitido, 0, 10), $value->estado ? 'Venta conforme' : 'Venta anulada', (string)$value->created_at));
		        	$lineaActual++;

		        	$sheet->cells('A'.$lineaActual.':O'.$lineaActual, function($cells)
			    	{
			    		$cells->setBackground('#E9EAED');
					});

		        	array_push($data, array('', 'CÓDIGO DE BARRAS', 'NOMBRE', 'PRESENTACIÓN', 'UNIDAD', 'CANTIDAD', 'PRECIO UNITARIO', 'PRECIO TOTAL', 'FECHA DE COMPRA'));
		        	$lineaActual++;

		        	$sheet->cells('A'.$lineaActual.':O'.$lineaActual, function($cells)
			    	{
			    		$cells->setFontWeight('bold');
					});

		        	foreach($value->tReciboCompraDetalle as $index => $item)
		        	{
		        		array_push($data, array('', $item->codigoBarrasProducto, $item->primerNombreProducto.' / '.$item->segundoNombreProducto.' / '.$item->tercerNombreProducto, TPresentacion::find($item->codigoPresentacionProducto)->nombre, TUnidadMedida::find($item->codigoUnidadMedidaProducto)->nombre, $item->cantidadProducto, $item->precioCompraUnitarioProducto, $item->precioCompraTotalProducto, (string)$item->created_at));
		        		$lineaActual++;
		        	}

		        	array_push($data, array('', '', '', '', '', '', 'Sub total: ', $value->subTotal));
		        	$lineaActual++;

		        	$sheet->cells('G'.$lineaActual.':H'.($lineaActual+2), function($cells)
			    	{
			    		$cells->setFontWeight('bold');
					});

		        	array_push($data, array('', '', '', '', '', '', 'Igv: ', $value->igv));
		        	$lineaActual++;

		        	array_push($data, array('', '', '', '', '', '', 'Total: ', $value->total));
		        	$lineaActual++;
		        }

		        array_push($data, array(''));
		        array_push($data, array('TOTAL (CONFORMES "ESTIMACIÓN")', number_format($totalGeneral, 2, '.', '')));
		        array_push($data, array('TOTAL (CONFORMES AL CRÉDITO "ESTIMACIÓN")', number_format($totalCredito, 2, '.', '')));
		        array_push($data, array('TOTAL (CONFORMES AL CONTADO)', number_format($totalContado, 2, '.', '')));

		        $sheet->fromArray($data,
		        	null,
		        	'A1',
		        	false,
		        	false
		        );
		    });
		})->export('xlsx');
	}

	public function actionCompraEntreFechasPorCodigoAlmacen($codigoAlmacen=null, $fechaInicial=null, $fechaFinal=null)
	{
		set_time_limit(0);
		ini_set('memory_limit', '500M');

		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		{
			return View::make('reporte/compraentrefechasporcodigoalmacen');
		}

		$tAlmacen=TAlmacen::find($codigoAlmacen);

		Excel::create('COMPRAS REALIZADAS ENTRE DOS FECHAS POR ALMACÉN_'.$tAlmacen->descripcion.'_'.$fechaInicial.'_'.$fechaFinal, function($excel) use($codigoAlmacen, $fechaInicial, $fechaFinal)
		{
			$excel->sheet('Sheetname', function($sheet) use($codigoAlmacen, $fechaInicial, $fechaFinal)
		    {
		    	$sheet->mergeCells('A1:O1');
		    	$sheet->setAutoSize(true);
		    	$sheet->setHeight(1, 25);

		    	$sheet->cells('A1', function($cells)
		    	{
		    		$cells->setAlignment('center');
		    		$cells->setValignment('center');
		    		$cells->setBackground('#1497CC');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontSize(13);
				});

				$sheet->cells('A2:O4', function($cells)
		    	{
		    		$cells->setBackground('#000000');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontWeight('bold');
				});

				$sheet->cells('A6:O6', function($cells)
		    	{
		    		$cells->setBackground('#C0504D');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontWeight('bold');
				});

		        $listaTReciboCompra=TReciboCompra::with('TAlmacen', 'TProveedor', 'TReciboCompraDetalle')->whereRaw('codigoAlmacen=? and created_at between ? and ?', [$codigoAlmacen, $fechaInicial, $fechaFinal])->get();
		
				$data=[];

				array_push($data, array('COMPRAS REALIZADAS ENTRE DOS FECHAS POR ALMACÉN'));
		        array_push($data, array('REPORTE GENERADO EL', date('m-d-Y')));
		        array_push($data, array('FECHA INICIAL', $fechaInicial));
		        array_push($data, array('FECHA FINAL', $fechaFinal));
		        array_push($data, array(''));
		        array_push($data, array('ALMACÉN', 'DOCUMENTO PROVEEDOR', 'PROVEEDOR', 'TIPO DE PAGO', 'COMPROBANTE', 'Nº DE COMPROBANTE', 'FECHA EMISIÓN DE COMPROBANTE', 'ESTADO', 'FECHA DE LA COMPRA'));

		        $totalGeneral=0;
		        $totalContado=0;
		        $totalCredito=0;
		        $lineaActual=6;

		        foreach($listaTReciboCompra as $key => $value)
		        {
		        	if($value->estado)
		            {
		            	$totalGeneral+=($value->total);
		            }

		            if($value->estado && $value->tipoPago=='Al Contado')
		            {
		            	$totalContado+=($value->total);
		            }

		            if($value->estado && $value->tipoPago=='Al Crédito')
		            {
		            	$totalCredito+=($value->total);
		            }

		        	array_push($data, array($value->tAlmacen->descripcion, $value->tProveedor->documentoIdentidad, $value->tProveedor->nombre, $value->tipoPago, $value->tipoRecibo, $value->numeroRecibo, $value->fechaComprobanteEmitido, $value->estado ? 'Venta conforme' : 'Venta anulada', (string)$value->created_at));
		        	$lineaActual++;

		        	$sheet->cells('A'.$lineaActual.':O'.$lineaActual, function($cells)
			    	{
			    		$cells->setBackground('#E9EAED');
					});

		        	array_push($data, array('', 'CÓDIGO DE BARRAS', 'NOMBRE', 'PRESENTACIÓN', 'UNIDAD', 'CANTIDAD', 'PRECIO UNITARIO', 'PRECIO TOTAL', 'FECHA DE COMPRA'));
		        	$lineaActual++;

		        	$sheet->cells('A'.$lineaActual.':O'.$lineaActual, function($cells)
			    	{
			    		$cells->setFontWeight('bold');
					});

		        	foreach($value->tReciboCompraDetalle as $index => $item)
		        	{
		        		array_push($data, array('', $item->codigoBarrasProducto, $item->primerNombreProducto.' / '.$item->segundoNombreProducto.' / '.$item->tercerNombreProducto, TPresentacion::find($item->codigoPresentacionProducto)->nombre, TUnidadMedida::find($item->codigoUnidadMedidaProducto)->nombre, $item->cantidadProducto, $item->precioCompraUnitarioProducto, $item->precioCompraTotalProducto, (string)$item->created_at));
		        		$lineaActual++;
		        	}

		        	array_push($data, array('', '', '', '', '', '', 'Sub total: ', $value->subTotal));
		        	$lineaActual++;

		        	$sheet->cells('G'.$lineaActual.':H'.($lineaActual+2), function($cells)
			    	{
			    		$cells->setFontWeight('bold');
					});

		        	array_push($data, array('', '', '', '', '', '', 'Igv: ', $value->igv));
		        	$lineaActual++;

		        	array_push($data, array('', '', '', '', '', '', 'Total: ', $value->total));
		        	$lineaActual++;
		        }

		        array_push($data, array(''));
		        array_push($data, array('TOTAL (CONFORMES "ESTIMACIÓN")', number_format($totalGeneral, 2, '.', '')));
		        array_push($data, array('TOTAL (CONFORMES AL CRÉDITO "ESTIMACIÓN")', number_format($totalCredito, 2, '.', '')));
		        array_push($data, array('TOTAL (CONFORMES AL CONTADO)', number_format($totalContado, 2, '.', '')));

		        $sheet->fromArray($data,
		        	null,
		        	'A1',
		        	false,
		        	false
		        );
		    });
		})->export('xlsx');
	}

	public function actionCompraPorReciboEmitidoEntreFechas($fechaInicial=null, $fechaFinal=null, $tipoRecibo=null)
	{
		set_time_limit(0);
		ini_set('memory_limit', '500M');

		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		{
			return View::make('reporte/compraporreciboemitidoentrefechas');
		}

		Excel::create('COMPRAS POR RECIBO ENTRE FECHAS-'.strtoupper($tipoRecibo).'_'.$fechaInicial.'_'.$fechaFinal, function($excel) use($fechaInicial, $fechaFinal, $tipoRecibo)
		{
			$excel->sheet('Sheetname', function($sheet) use($fechaInicial, $fechaFinal, $tipoRecibo)
		    {
		    	$sheet->mergeCells('A1:O1');
		    	$sheet->setAutoSize(true);
		    	$sheet->setHeight(1, 25);

		    	$sheet->cells('A1', function($cells)
		    	{
		    		$cells->setAlignment('center');
		    		$cells->setValignment('center');
		    		$cells->setBackground('#1497CC');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontSize(13);
				});

				$sheet->cells('A2:O4', function($cells)
		    	{
		    		$cells->setBackground('#000000');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontWeight('bold');
				});

				$sheet->cells('A6:O6', function($cells)
		    	{
		    		$cells->setBackground('#C0504D');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontWeight('bold');
				});

		        $listaTReciboCompra=TReciboCompra::with('TAlmacen', 'TProveedor', 'TReciboCompraDetalle')->whereRaw('fechaComprobanteEmitido between ? and ? and tipoRecibo=? and comprobanteEmitido=?', [$fechaInicial, $fechaFinal, $tipoRecibo, true])->get();
		
				$data=[];

				array_push($data, array('COMPRAS POR RECIBO ENTRE FECHAS-'.strtoupper($tipoRecibo)));
		        array_push($data, array('REPORTE GENERADO EL', date('m-d-Y')));
		        array_push($data, array('FECHA INICIAL', $fechaInicial));
		        array_push($data, array('FECHA FINAL', $fechaFinal));
		        array_push($data, array(''));
		        array_push($data, array('ALMACÉN', 'DOCUMENTO PROVEEDOR', 'PROVEEDOR', 'TIPO DE PAGO', 'COMPROBANTE', 'Nº DE COMPROBANTE', 'FECHA EMISIÓN DE COMPROBANTE', 'ESTADO', 'FECHA DE LA COMPRA'));

		        $totalGeneral=0;
		        $totalContado=0;
		        $totalCredito=0;
		        $lineaActual=6;

		        foreach($listaTReciboCompra as $key => $value)
		        {
		        	if($value->estado)
		            {
		            	$totalGeneral+=($value->total);
		            }

		            if($value->estado && $value->tipoPago=='Al Contado')
		            {
		            	$totalContado+=($value->total);
		            }

		            if($value->estado && $value->tipoPago=='Al Crédito')
		            {
		            	$totalCredito+=($value->total);
		            }

		        	array_push($data, array($value->tAlmacen->descripcion, $value->tProveedor->documentoIdentidad, $value->tProveedor->nombre, $value->tipoPago, $value->tipoRecibo, $value->numeroRecibo, substr($value->fechaComprobanteEmitido, 0, 10), $value->estado ? 'Venta conforme' : 'Venta anulada', (string)$value->created_at));
		        	$lineaActual++;

		        	$sheet->cells('A'.$lineaActual.':O'.$lineaActual, function($cells)
			    	{
			    		$cells->setBackground('#E9EAED');
					});

		        	array_push($data, array('', 'CÓDIGO DE BARRAS', 'NOMBRE', 'PRESENTACIÓN', 'UNIDAD', 'CANTIDAD', 'PRECIO UNITARIO', 'PRECIO TOTAL', 'FECHA DE COMPRA'));
		        	$lineaActual++;

		        	$sheet->cells('A'.$lineaActual.':O'.$lineaActual, function($cells)
			    	{
			    		$cells->setFontWeight('bold');
					});

		        	foreach($value->tReciboCompraDetalle as $index => $item)
		        	{
		        		array_push($data, array('', $item->codigoBarrasProducto, $item->primerNombreProducto.' / '.$item->segundoNombreProducto.' / '.$item->tercerNombreProducto, TPresentacion::find($item->codigoPresentacionProducto)->nombre, TUnidadMedida::find($item->codigoUnidadMedidaProducto)->nombre, $item->cantidadProducto, $item->precioCompraUnitarioProducto, $item->precioCompraTotalProducto, (string)$item->created_at));
		        		$lineaActual++;
		        	}

		        	array_push($data, array('', '', '', '', '', '', 'Sub total: ', $value->subTotal));
		        	$lineaActual++;

		        	$sheet->cells('G'.$lineaActual.':H'.($lineaActual+2), function($cells)
			    	{
			    		$cells->setFontWeight('bold');
					});

		        	array_push($data, array('', '', '', '', '', '', 'Igv: ', $value->igv));
		        	$lineaActual++;

		        	array_push($data, array('', '', '', '', '', '', 'Total: ', $value->total));
		        	$lineaActual++;
		        }

		        array_push($data, array(''));
		        array_push($data, array('TOTAL (CONFORMES "ESTIMACIÓN")', number_format($totalGeneral, 2, '.', '')));
		        array_push($data, array('TOTAL (CONFORMES AL CRÉDITO "ESTIMACIÓN")', number_format($totalCredito, 2, '.', '')));
		        array_push($data, array('TOTAL (CONFORMES AL CONTADO)', number_format($totalContado, 2, '.', '')));

		        $sheet->fromArray($data,
		        	null,
		        	'A1',
		        	false,
		        	false
		        );
		    });
		})->export('xlsx');
	}

	public function actionCompraPorReciboEmitidoEntreFechasPorCodigoAlmacen($codigoAlmacen=null, $fechaInicial=null, $fechaFinal=null, $tipoRecibo=null)
	{
		set_time_limit(0);
		ini_set('memory_limit', '500M');

		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		{
			return View::make('reporte/compraporreciboemitidoentrefechasporcodigoalmacen');
		}

		$tAlmacen=TAlmacen::find($codigoAlmacen);

		Excel::create('COMPRAS POR RECIBO ENTRE FECHAS Y ALMACÉN_'.$tAlmacen->descripcion.'-'.strtoupper($tipoRecibo).'_'.$fechaInicial.'_'.$fechaFinal, function($excel) use($codigoAlmacen, $fechaInicial, $fechaFinal, $tipoRecibo)
		{
			$excel->sheet('Sheetname', function($sheet) use($codigoAlmacen, $fechaInicial, $fechaFinal, $tipoRecibo)
		    {
		    	$sheet->mergeCells('A1:O1');
		    	$sheet->setAutoSize(true);
		    	$sheet->setHeight(1, 25);

		    	$sheet->cells('A1', function($cells)
		    	{
		    		$cells->setAlignment('center');
		    		$cells->setValignment('center');
		    		$cells->setBackground('#1497CC');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontSize(13);
				});

				$sheet->cells('A2:O4', function($cells)
		    	{
		    		$cells->setBackground('#000000');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontWeight('bold');
				});

				$sheet->cells('A6:O6', function($cells)
		    	{
		    		$cells->setBackground('#C0504D');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontWeight('bold');
				});

		        $listaTReciboCompra=TReciboCompra::with('TAlmacen', 'TProveedor', 'TReciboCompraDetalle')->whereRaw('codigoAlmacen=? and fechaComprobanteEmitido between ? and ? and tipoRecibo=? and comprobanteEmitido=?', [$codigoAlmacen, $fechaInicial, $fechaFinal, $tipoRecibo, true])->get();
		
				$data=[];

				array_push($data, array('COMPRAS POR RECIBO ENTRE FECHAS Y ALMACÉN'.'-'.strtoupper($tipoRecibo)));
		        array_push($data, array('REPORTE GENERADO EL', date('m-d-Y')));
		        array_push($data, array('FECHA INICIAL', $fechaInicial));
		        array_push($data, array('FECHA FINAL', $fechaFinal));
		        array_push($data, array(''));
		        array_push($data, array('ALMACÉN', 'DOCUMENTO PROVEEDOR', 'PROVEEDOR', 'TIPO DE PAGO', 'COMPROBANTE', 'Nº DE COMPROBANTE', 'FECHA EMISIÓN DE COMPROBANTE', 'ESTADO', 'FECHA DE LA COMPRA'));

		        $totalGeneral=0;
		        $totalContado=0;
		        $totalCredito=0;
		        $lineaActual=6;

		        foreach($listaTReciboCompra as $key => $value)
		        {
		        	if($value->estado)
		            {
		            	$totalGeneral+=($value->total);
		            }

		            if($value->estado && $value->tipoPago=='Al Contado')
		            {
		            	$totalContado+=($value->total);
		            }

		            if($value->estado && $value->tipoPago=='Al Crédito')
		            {
		            	$totalCredito+=($value->total);
		            }

		        	array_push($data, array($value->tAlmacen->descripcion, $value->tProveedor->documentoIdentidad, $value->tProveedor->nombre, $value->tipoPago, $value->tipoRecibo, $value->numeroRecibo, substr($value->fechaComprobanteEmitido, 0, 10), $value->estado ? 'Venta conforme' : 'Venta anulada', (string)$value->created_at));
		        	$lineaActual++;

		        	$sheet->cells('A'.$lineaActual.':O'.$lineaActual, function($cells)
			    	{
			    		$cells->setBackground('#E9EAED');
					});

		        	array_push($data, array('', 'CÓDIGO DE BARRAS', 'NOMBRE', 'PRESENTACIÓN', 'UNIDAD', 'CANTIDAD', 'PRECIO UNITARIO', 'PRECIO TOTAL', 'FECHA DE COMPRA'));
		        	$lineaActual++;

		        	$sheet->cells('A'.$lineaActual.':O'.$lineaActual, function($cells)
			    	{
			    		$cells->setFontWeight('bold');
					});

		        	foreach($value->tReciboCompraDetalle as $index => $item)
		        	{
		        		array_push($data, array('', $item->codigoBarrasProducto, $item->primerNombreProducto.' / '.$item->segundoNombreProducto.' / '.$item->tercerNombreProducto, TPresentacion::find($item->codigoPresentacionProducto)->nombre, TUnidadMedida::find($item->codigoUnidadMedidaProducto)->nombre, $item->cantidadProducto, $item->precioCompraUnitarioProducto, $item->precioCompraTotalProducto, (string)$item->created_at));
		        		$lineaActual++;
		        	}

		        	array_push($data, array('', '', '', '', '', '', 'Sub total: ', $value->subTotal));
		        	$lineaActual++;

		        	$sheet->cells('G'.$lineaActual.':H'.($lineaActual+2), function($cells)
			    	{
			    		$cells->setFontWeight('bold');
					});

		        	array_push($data, array('', '', '', '', '', '', 'Igv: ', $value->igv));
		        	$lineaActual++;

		        	array_push($data, array('', '', '', '', '', '', 'Total: ', $value->total));
		        	$lineaActual++;
		        }

		        array_push($data, array(''));
		        array_push($data, array('TOTAL (CONFORMES "ESTIMACIÓN")', number_format($totalGeneral, 2, '.', '')));
		        array_push($data, array('TOTAL (CONFORMES AL CRÉDITO "ESTIMACIÓN")', number_format($totalCredito, 2, '.', '')));
		        array_push($data, array('TOTAL (CONFORMES AL CONTADO)', number_format($totalContado, 2, '.', '')));

		        $sheet->fromArray($data,
		        	null,
		        	'A1',
		        	false,
		        	false
		        );
		    });
		})->export('xlsx');
	}

	public function actionVentaEntreFechas($fechaInicial=null, $fechaFinal=null)
	{
		set_time_limit(0);
		ini_set('memory_limit', '500M');

		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		{
			return View::make('reporte/ventaentrefechas');
		}

		Excel::create('VENTAS REALIZADAS ENTRE DOS FECHAS_'.$fechaInicial.'_'.$fechaFinal, function($excel) use($fechaInicial, $fechaFinal)
		{
			$excel->sheet('Sheetname', function($sheet) use($fechaInicial, $fechaFinal)
		    {
		    	$sheet->mergeCells('A1:O1');
		    	$sheet->setAutoSize(true);
		    	$sheet->setHeight(1, 25);

		    	$sheet->cells('A1', function($cells)
		    	{
		    		$cells->setAlignment('center');
		    		$cells->setValignment('center');
		    		$cells->setBackground('#1497CC');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontSize(13);
				});

				$sheet->cells('A2:O4', function($cells)
		    	{
		    		$cells->setBackground('#000000');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontWeight('bold');
				});

				$sheet->cells('A6:O6', function($cells)
		    	{
		    		$cells->setBackground('#C0504D');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontWeight('bold');
				});

		        $listaTReciboVenta=TReciboVenta::with('TOficina', 'TUsuario', 'TReciboVentaDetalle')->whereRaw('created_at between ? and ?', [$fechaInicial, $fechaFinal])->get();
		
				$data=[];

				array_push($data, array('VENTAS REALIZADAS ENTRE DOS FECHAS'));
		        array_push($data, array('REPORTE GENERADO EL', date('m-d-Y')));
		        array_push($data, array('FECHA INICIAL', $fechaInicial));
		        array_push($data, array('FECHA FINAL', $fechaFinal));
		        array_push($data, array(''));
		        array_push($data, array('OFICINA/TIENDA', 'USUARIO', 'DOCUMENTO CLIENTE', 'CLIENTE', 'DIRECCIÓN', 'TIPO DE PAGO', 'COMPROBANTE', 'Nº DE COMPROBANTE', 'ESTADO', 'FECHA DE LA VENTA'));

		        $totalGeneral=0;
		        $totalContado=0;
		        $totalCredito=0;
		        $lineaActual=6;

		        foreach($listaTReciboVenta as $key => $value)
		        {
		        	if($value->estado)
		            {
		            	$totalGeneral+=($value->total);
		            }

		            if($value->estado && $value->tipoPago=='Al Contado')
		            {
		            	$totalContado+=($value->total);
		            }

		            if($value->estado && $value->tipoPago=='Al Crédito')
		            {
		            	$totalCredito+=($value->total);
		            }

		        	array_push($data, array($value->tOficina->descripcion, $value->tUsuario->nombreUsuario, $value->documentoCliente, $value->nombreCompletoCliente, $value->direccionCliente, $value->tipoPago, $value->tipoRecibo, $value->numeroRecibo, $value->estado ? 'Venta conforme' : 'Venta anulada', (string)$value->created_at));
		        	$lineaActual++;

		        	$sheet->cells('A'.$lineaActual.':O'.$lineaActual, function($cells)
			    	{
			    		$cells->setBackground('#E9EAED');
					});

		        	array_push($data, array('', 'CÓDIGO DE BARRAS', 'NOMBRE', 'PRESENTACIÓN', 'UNIDAD', 'CANTIDAD', 'PRECIO UNITARIO', 'PRECIO TOTAL', 'FECHA DE VENTA'));
		        	$lineaActual++;

		        	$sheet->cells('A'.$lineaActual.':O'.$lineaActual, function($cells)
			    	{
			    		$cells->setFontWeight('bold');
					});

		        	foreach($value->tReciboVentaDetalle as $index => $item)
		        	{
		        		array_push($data, array('', $item->codigoBarrasProducto, $item->primerNombreProducto.' / '.$item->segundoNombreProducto.' / '.$item->tercerNombreProducto, $item->presentacionProducto, $item->unidadMedidaProducto, $item->cantidadProducto, $item->precioVentaUnitarioProducto, $item->precioVentaTotalProducto, (string)$item->created_at));
		        		$lineaActual++;
		        	}

		        	array_push($data, array('', '', '', '', '', '', 'Sub total: ', $value->subTotal));
		        	$lineaActual++;
		        	
		        	$sheet->cells('G'.$lineaActual.':H'.($lineaActual+2), function($cells)
			    	{
			    		$cells->setFontWeight('bold');
					});

		        	array_push($data, array('', '', '', '', '', '', 'Igv: ', $value->igv));
		        	$lineaActual++;

		        	array_push($data, array('', '', '', '', '', '', 'Total: ', $value->total));
		        	$lineaActual++;
		        }

		        array_push($data, array(''));
		        array_push($data, array('TOTAL (CONFORMES "ESTIMACIÓN")', number_format($totalGeneral, 2, '.', '')));
		        array_push($data, array('TOTAL (CONFORMES AL CRÉDITO "ESTIMACIÓN")', number_format($totalCredito, 2, '.', '')));
		        array_push($data, array('TOTAL (CONFORMES AL CONTADO)', number_format($totalContado, 2, '.', '')));

		        $sheet->fromArray($data,
		        	null,
		        	'A1',
		        	false,
		        	false
		        );
		    });
		})->export('xlsx');
	}

	public function actionVentaEntreFechasPorCodigoOficina($codigoOficina=null, $fechaInicial=null, $fechaFinal=null)
	{
		set_time_limit(0);
		ini_set('memory_limit', '500M');

		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		{
			return View::make('reporte/ventaentrefechasporcodigooficina');
		}

		$tOficina=TOficina::find($codigoOficina);

		Excel::create('VENTAS REALIZADAS ENTRE DOS FECHAS POR OFICINA_'.$tOficina->descripcion.'_'.$fechaInicial.'_'.$fechaFinal, function($excel) use($codigoOficina, $fechaInicial, $fechaFinal)
		{
			$excel->sheet('Sheetname', function($sheet) use($codigoOficina, $fechaInicial, $fechaFinal)
		    {
		    	$sheet->mergeCells('A1:O1');
		    	$sheet->setAutoSize(true);
		    	$sheet->setHeight(1, 25);

		    	$sheet->cells('A1', function($cells)
		    	{
		    		$cells->setAlignment('center');
		    		$cells->setValignment('center');
		    		$cells->setBackground('#1497CC');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontSize(13);
				});

				$sheet->cells('A2:O4', function($cells)
		    	{
		    		$cells->setBackground('#000000');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontWeight('bold');
				});

				$sheet->cells('A6:O6', function($cells)
		    	{
		    		$cells->setBackground('#C0504D');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontWeight('bold');
				});

		        $listaTReciboVenta=TReciboVenta::with('TOficina', 'TUsuario', 'TReciboVentaDetalle')->whereRaw('codigoOficina=? and created_at between ? and ?', [$codigoOficina, $fechaInicial, $fechaFinal])->get();
		
				$data=[];

				array_push($data, array('VENTAS REALIZADAS ENTRE DOS FECHAS POR OFICINA'));
		        array_push($data, array('REPORTE GENERADO EL', date('m-d-Y')));
		        array_push($data, array('FECHA INICIAL', $fechaInicial));
		        array_push($data, array('FECHA FINAL', $fechaFinal));
		        array_push($data, array(''));
		        array_push($data, array('OFICINA/TIENDA', 'USUARIO', 'DOCUMENTO CLIENTE', 'CLIENTE', 'DIRECCIÓN', 'TIPO DE PAGO', 'COMPROBANTE', 'Nº DE COMPROBANTE', 'ESTADO', 'FECHA DE LA VENTA'));

		        $totalGeneral=0;
		        $totalContado=0;
		        $totalCredito=0;
		        $lineaActual=6;

		        foreach($listaTReciboVenta as $key => $value)
		        {
		        	if($value->estado)
		            {
		            	$totalGeneral+=($value->total);
		            }

		            if($value->estado && $value->tipoPago=='Al Contado')
		            {
		            	$totalContado+=($value->total);
		            }

		            if($value->estado && $value->tipoPago=='Al Crédito')
		            {
		            	$totalCredito+=($value->total);
		            }

		        	array_push($data, array($value->tOficina->descripcion, $value->tUsuario->nombreUsuario, $value->documentoCliente, $value->nombreCompletoCliente, $value->direccionCliente, $value->tipoPago, $value->tipoRecibo, $value->numeroRecibo, $value->estado ? 'Venta conforme' : 'Venta anulada', (string)$value->created_at));
		        	$lineaActual++;

		        	$sheet->cells('A'.$lineaActual.':O'.$lineaActual, function($cells)
			    	{
			    		$cells->setBackground('#E9EAED');
					});

		        	array_push($data, array('', 'CÓDIGO DE BARRAS', 'NOMBRE', 'PRESENTACIÓN', 'UNIDAD', 'CANTIDAD', 'PRECIO UNITARIO', 'PRECIO TOTAL', 'FECHA DE VENTA'));
		        	$lineaActual++;

		        	$sheet->cells('A'.$lineaActual.':O'.$lineaActual, function($cells)
			    	{
			    		$cells->setFontWeight('bold');
					});

		        	foreach($value->tReciboVentaDetalle as $index => $item)
		        	{
		        		array_push($data, array('', $item->codigoBarrasProducto, $item->primerNombreProducto.' / '.$item->segundoNombreProducto.' / '.$item->tercerNombreProducto, $item->presentacionProducto, $item->unidadMedidaProducto, $item->cantidadProducto, $item->precioVentaUnitarioProducto, $item->precioVentaTotalProducto, (string)$item->created_at));
		        		$lineaActual++;
		        	}

		        	array_push($data, array('', '', '', '', '', '', 'Sub total: ', $value->subTotal));
		        	$lineaActual++;
		        	
		        	$sheet->cells('G'.$lineaActual.':H'.($lineaActual+2), function($cells)
			    	{
			    		$cells->setFontWeight('bold');
					});

		        	array_push($data, array('', '', '', '', '', '', 'Igv: ', $value->igv));
		        	$lineaActual++;

		        	array_push($data, array('', '', '', '', '', '', 'Total: ', $value->total));
		        	$lineaActual++;
		        }

		        array_push($data, array(''));
		        array_push($data, array('TOTAL (CONFORMES "ESTIMACIÓN")', number_format($totalGeneral, 2, '.', '')));
		        array_push($data, array('TOTAL (CONFORMES AL CRÉDITO "ESTIMACIÓN")', number_format($totalCredito, 2, '.', '')));
		        array_push($data, array('TOTAL (CONFORMES AL CONTADO)', number_format($totalContado, 2, '.', '')));

		        $sheet->fromArray($data,
		        	null,
		        	'A1',
		        	false,
		        	false
		        );
		    });
		})->export('xlsx');
	}

	public function actionVentaEntreFechasPorTipoRecibo($fechaInicial=null, $fechaFinal=null, $tipoRecibo=null)
	{
		set_time_limit(0);
		ini_set('memory_limit', '500M');

		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		{
			return View::make('reporte/ventaentrefechasportiporecibo');
		}

		Excel::create('COMPROBANTES EMITIDOS ENTRE DOS FECHAS-'.strtoupper($tipoRecibo).'_'.$fechaInicial.'_'.$fechaFinal, function($excel) use($fechaInicial, $fechaFinal, $tipoRecibo)
		{
			$excel->sheet('Sheetname', function($sheet) use($fechaInicial, $fechaFinal, $tipoRecibo)
		    {
		    	$sheet->mergeCells('A1:O1');
		    	$sheet->setAutoSize(true);
		    	$sheet->setHeight(1, 25);

		    	$sheet->cells('A1', function($cells)
		    	{
		    		$cells->setAlignment('center');
		    		$cells->setValignment('center');
		    		$cells->setBackground('#1497CC');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontSize(13);
				});

				$sheet->cells('A2:O4', function($cells)
		    	{
		    		$cells->setBackground('#000000');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontWeight('bold');
				});

				$sheet->cells('A6:O6', function($cells)
		    	{
		    		$cells->setBackground('#C0504D');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontWeight('bold');
				});

		        $listaTReciboVenta=TReciboVenta::with('TOficina', 'TUsuario', 'TReciboVentaDetalle')->whereRaw('tipoRecibo=? and fechaComprobanteEmitido between ? and ? and comprobanteEmitido=?', [$tipoRecibo, $fechaInicial, $fechaFinal, true])->get();
		
				$data=[];

				array_push($data, array('COMPROBANTES EMITIDOS ENTRE DOS FECHAS-'.strtoupper($tipoRecibo)));
		        array_push($data, array('REPORTE GENERADO EL', date('m-d-Y')));
		        array_push($data, array('FECHA INICIAL', $fechaInicial));
		        array_push($data, array('FECHA FINAL', $fechaFinal));
		        array_push($data, array(''));
		        array_push($data, array('OFICINA/TIENDA', 'USUARIO', 'DOCUMENTO CLIENTE', 'CLIENTE', 'DIRECCIÓN', 'TIPO DE PAGO', 'COMPROBANTE', 'Nº DE COMPROBANTE', 'ESTADO', 'FECHA DE LA VENTA'));

		        $totalGeneral=0;
		        $totalContado=0;
		        $totalCredito=0;
		        $lineaActual=6;

		        foreach($listaTReciboVenta as $key => $value)
		        {
		        	if($value->estado)
		            {
		            	$totalGeneral+=($value->total);
		            }

		            if($value->estado && $value->tipoPago=='Al Contado')
		            {
		            	$totalContado+=($value->total);
		            }

		            if($value->estado && $value->tipoPago=='Al Crédito')
		            {
		            	$totalCredito+=($value->total);
		            }

		        	array_push($data, array($value->tOficina->descripcion, $value->tUsuario->nombreUsuario, $value->documentoCliente, $value->nombreCompletoCliente, $value->direccionCliente, $value->tipoPago, $value->tipoRecibo, $value->numeroRecibo, $value->estado ? 'Venta conforme' : 'Venta anulada', (string)$value->created_at));
		        	$lineaActual++;

		        	$sheet->cells('A'.$lineaActual.':O'.$lineaActual, function($cells)
			    	{
			    		$cells->setBackground('#E9EAED');
					});

		        	array_push($data, array('', 'CÓDIGO DE BARRAS', 'NOMBRE', 'PRESENTACIÓN', 'UNIDAD', 'CANTIDAD', 'PRECIO UNITARIO', 'PRECIO TOTAL', 'FECHA DE VENTA'));
		        	$lineaActual++;

		        	$sheet->cells('A'.$lineaActual.':O'.$lineaActual, function($cells)
			    	{
			    		$cells->setFontWeight('bold');
					});

		        	foreach($value->tReciboVentaDetalle as $index => $item)
		        	{
		        		array_push($data, array('', $item->codigoBarrasProducto, $item->primerNombreProducto.' / '.$item->segundoNombreProducto.' / '.$item->tercerNombreProducto, $item->presentacionProducto, $item->unidadMedidaProducto, $item->cantidadProducto, $item->precioVentaUnitarioProducto, $item->precioVentaTotalProducto, (string)$item->created_at));
		        		$lineaActual++;
		        	}

		        	array_push($data, array('', '', '', '', '', '', 'Sub total: ', $value->subTotal));
		        	$lineaActual++;
		        	
		        	$sheet->cells('G'.$lineaActual.':H'.($lineaActual+2), function($cells)
			    	{
			    		$cells->setFontWeight('bold');
					});

		        	array_push($data, array('', '', '', '', '', '', 'Igv: ', $value->igv));
		        	$lineaActual++;

		        	array_push($data, array('', '', '', '', '', '', 'Total: ', $value->total));
		        	$lineaActual++;
		        }

		        array_push($data, array(''));
		        array_push($data, array('TOTAL (CONFORMES "ESTIMACIÓN")', number_format($totalGeneral, 2, '.', '')));
		        array_push($data, array('TOTAL (CONFORMES AL CRÉDITO "ESTIMACIÓN")', number_format($totalCredito, 2, '.', '')));
		        array_push($data, array('TOTAL (CONFORMES AL CONTADO)', number_format($totalContado, 2, '.', '')));

		        $sheet->fromArray($data,
		        	null,
		        	'A1',
		        	false,
		        	false
		        );
		    });
		})->export('xlsx');
	}

	public function actionVentaEntreFechasPorCodigoOficinaTipoRecibo($codigoOficina=null, $fechaInicial=null, $fechaFinal=null, $tipoRecibo=null)
	{
		set_time_limit(0);
		ini_set('memory_limit', '500M');

		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		{
			return View::make('reporte/ventaentrefechasporcodigooficinatiporecibo');
		}

		$tOficina=TOficina::find($codigoOficina);

		Excel::create('COMPROBANTES EMITIDOS ENTRE DOS FECHAS POR OFICINA_'.$tOficina->descripcion.'-'.strtoupper($tipoRecibo).'_'.$fechaInicial.'_'.$fechaFinal, function($excel) use($codigoOficina, $fechaInicial, $fechaFinal, $tipoRecibo)
		{
			$excel->sheet('Sheetname', function($sheet) use($codigoOficina, $fechaInicial, $fechaFinal, $tipoRecibo)
		    {
		    	$sheet->mergeCells('A1:O1');
		    	$sheet->setAutoSize(true);
		    	$sheet->setHeight(1, 25);

		    	$sheet->cells('A1', function($cells)
		    	{
		    		$cells->setAlignment('center');
		    		$cells->setValignment('center');
		    		$cells->setBackground('#1497CC');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontSize(13);
				});

				$sheet->cells('A2:O4', function($cells)
		    	{
		    		$cells->setBackground('#000000');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontWeight('bold');
				});

				$sheet->cells('A6:O6', function($cells)
		    	{
		    		$cells->setBackground('#C0504D');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontWeight('bold');
				});

		        $listaTReciboVenta=TReciboVenta::with('TOficina', 'TUsuario', 'TReciboVentaDetalle')->whereRaw('codigoOficina=? and tipoRecibo=? and fechaComprobanteEmitido between ? and ? and comprobanteEmitido=?', [$codigoOficina, $tipoRecibo, $fechaInicial, $fechaFinal, true])->get();
		
				$data=[];

				array_push($data, array('COMPROBANTES EMITIDOS ENTRE DOS FECHAS POR OFICINA-'.strtoupper($tipoRecibo)));
		        array_push($data, array('REPORTE GENERADO EL', date('m-d-Y')));
		        array_push($data, array('FECHA INICIAL', $fechaInicial));
		        array_push($data, array('FECHA FINAL', $fechaFinal));
		        array_push($data, array(''));
		        array_push($data, array('OFICINA/TIENDA', 'USUARIO', 'DOCUMENTO CLIENTE', 'CLIENTE', 'DIRECCIÓN', 'TIPO DE PAGO', 'COMPROBANTE', 'Nº DE COMPROBANTE', 'ESTADO', 'FECHA DE LA VENTA'));

		        $totalGeneral=0;
		        $totalContado=0;
		        $totalCredito=0;
		        $lineaActual=6;

		        foreach($listaTReciboVenta as $key => $value)
		        {
		        	if($value->estado)
		            {
		            	$totalGeneral+=($value->total);
		            }

		            if($value->estado && $value->tipoPago=='Al Contado')
		            {
		            	$totalContado+=($value->total);
		            }

		            if($value->estado && $value->tipoPago=='Al Crédito')
		            {
		            	$totalCredito+=($value->total);
		            }

		        	array_push($data, array($value->tOficina->descripcion, $value->tUsuario->nombreUsuario, $value->documentoCliente, $value->nombreCompletoCliente, $value->direccionCliente, $value->tipoPago, $value->tipoRecibo, $value->numeroRecibo, $value->estado ? 'Venta conforme' : 'Venta anulada', (string)$value->created_at));
		        	$lineaActual++;

		        	$sheet->cells('A'.$lineaActual.':O'.$lineaActual, function($cells)
			    	{
			    		$cells->setBackground('#E9EAED');
					});

		        	array_push($data, array('', 'CÓDIGO DE BARRAS', 'NOMBRE', 'PRESENTACIÓN', 'UNIDAD', 'CANTIDAD', 'PRECIO UNITARIO', 'PRECIO TOTAL', 'FECHA DE VENTA'));
		        	$lineaActual++;

		        	$sheet->cells('A'.$lineaActual.':O'.$lineaActual, function($cells)
			    	{
			    		$cells->setFontWeight('bold');
					});

		        	foreach($value->tReciboVentaDetalle as $index => $item)
		        	{
		        		array_push($data, array('', $item->codigoBarrasProducto, $item->primerNombreProducto.' / '.$item->segundoNombreProducto.' / '.$item->tercerNombreProducto, $item->presentacionProducto, $item->unidadMedidaProducto, $item->cantidadProducto, $item->precioVentaUnitarioProducto, $item->precioVentaTotalProducto, (string)$item->created_at));
		        		$lineaActual++;
		        	}

		        	array_push($data, array('', '', '', '', '', '', 'Sub total: ', $value->subTotal));
		        	$lineaActual++;
		        	
		        	$sheet->cells('G'.$lineaActual.':H'.($lineaActual+2), function($cells)
			    	{
			    		$cells->setFontWeight('bold');
					});

		        	array_push($data, array('', '', '', '', '', '', 'Igv: ', $value->igv));
		        	$lineaActual++;

		        	array_push($data, array('', '', '', '', '', '', 'Total: ', $value->total));
		        	$lineaActual++;
		        }

		        array_push($data, array(''));
		        array_push($data, array('TOTAL (CONFORMES "ESTIMACIÓN")', number_format($totalGeneral, 2, '.', '')));
		        array_push($data, array('TOTAL (CONFORMES AL CRÉDITO "ESTIMACIÓN")', number_format($totalCredito, 2, '.', '')));
		        array_push($data, array('TOTAL (CONFORMES AL CONTADO)', number_format($totalContado, 2, '.', '')));

		        $sheet->fromArray($data,
		        	null,
		        	'A1',
		        	false,
		        	false
		        );
		    });
		})->export('xlsx');
	}

	public function actionEnvioProductosAlmacenOficinaEntreFechas($fechaInicial=null, $fechaFinal=null)
	{
		set_time_limit(0);
		ini_set('memory_limit', '500M');

		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		{
			return View::make('reporte/envioproductosalmacenoficinaentrefechas');
		}

		Excel::create('PRODUCTOS ENVIADOS DE ALMACÉN A OFICINA ENTRE DOS FECHAS_'.$fechaInicial.'_'.$fechaFinal, function($excel) use($fechaInicial, $fechaFinal)
		{
			$excel->sheet('Sheetname', function($sheet) use($fechaInicial, $fechaFinal)
		    {
		    	$sheet->mergeCells('A1:O1');
		    	$sheet->setAutoSize(true);
		    	$sheet->setHeight(1, 25);

		    	$sheet->cells('A1', function($cells)
		    	{
		    		$cells->setAlignment('center');
		    		$cells->setValignment('center');
		    		$cells->setBackground('#1497CC');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontSize(13);
				});

				$sheet->cells('A2:O4', function($cells)
		    	{
		    		$cells->setBackground('#000000');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontWeight('bold');
				});

				$sheet->cells('A6:O6', function($cells)
		    	{
		    		$cells->setBackground('#C0504D');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontWeight('bold');
				});

		        $listaTProductoEnviarStock=TProductoEnviarStock::with('TOficina', 'TAlmacen', 'TProductoEnviarStockDetalle')->whereRaw('created_at between ? and ?', [$fechaInicial, $fechaFinal])->get();
		
				$data=[];

				array_push($data, array('PRODUCTOS ENVIADOS DE ALMACÉN A OFICINA ENTRE DOS FECHAS'));
		        array_push($data, array('REPORTE GENERADO EL', date('m-d-Y')));
		        array_push($data, array('FECHA INICIAL', $fechaInicial));
		        array_push($data, array('FECHA FINAL', $fechaFinal));
		        array_push($data, array(''));
		        array_push($data, array('ALMACÉN DE PARTIDA', 'OFICINA/TIENDA DE LLEGADA', 'FLETE', 'ESTADO', 'FECHA DE ENVÍO'));

		        $lineaActual=6;

		        foreach($listaTProductoEnviarStock as $key => $value)
		        {
		        	array_push($data, array($value->tAlmacen->descripcion, $value->tOficina->descripcion, $value->flete, $value->estado ? 'Envío conforme' : 'Envío anulada', (string)$value->created_at));
		        	$lineaActual++;

		        	$sheet->cells('A'.$lineaActual.':O'.$lineaActual, function($cells)
			    	{
			    		$cells->setBackground('#E9EAED');
					});

		        	array_push($data, array('', 'CÓDIGO DE BARRAS', 'NOMBRE', 'PRESENTACIÓN', 'UNIDAD', 'CANTIDAD ENVIADA', 'PRECIO DE COMPRA UNITARIO', 'PRECIO DE VENTA UNITARIO'));
		        	$lineaActual++;

		        	$sheet->cells('A'.$lineaActual.':O'.$lineaActual, function($cells)
			    	{
			    		$cells->setFontWeight('bold');
					});

		        	foreach($value->tProductoEnviarStockDetalle as $index => $item)
		        	{
		        		array_push($data, array('', $item->codigoBarrasProducto, $item->primerNombreProducto.' / '.$item->segundoNombreProducto.' / '.$item->tercerNombreProducto, TPresentacion::find($item->codigoPresentacionProducto)->nombre, TUnidadMedida::find($item->codigoUnidadMedidaProducto)->nombre, $item->cantidadProducto, $item->precioCompraUnitarioProducto, $item->precioVentaUnitarioProducto));
		        		$lineaActual++;
		        	}
		        }

		        $sheet->fromArray($data,
		        	null,
		        	'A1',
		        	false,
		        	false
		        );
		    });
		})->export('xlsx');
	}

	public function actionProductoTrasladoOficinaEntreFechas($fechaInicial=null, $fechaFinal=null)
	{
		set_time_limit(0);
		ini_set('memory_limit', '500M');

		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		{
			return View::make('reporte/productotrasladooficinaentrefechas');
		}

		Excel::create('PRODUCTOS TRASLADADOS ENTRE OFICINAS/TIENDAS ENTRE DOS FECHAS_'.$fechaInicial.'_'.$fechaFinal, function($excel) use($fechaInicial, $fechaFinal)
		{
			$excel->sheet('Sheetname', function($sheet) use($fechaInicial, $fechaFinal)
		    {
		    	$sheet->mergeCells('A1:O1');
		    	$sheet->setAutoSize(true);
		    	$sheet->setHeight(1, 25);

		    	$sheet->cells('A1', function($cells)
		    	{
		    		$cells->setAlignment('center');
		    		$cells->setValignment('center');
		    		$cells->setBackground('#1497CC');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontSize(13);
				});

				$sheet->cells('A2:O4', function($cells)
		    	{
		    		$cells->setBackground('#000000');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontWeight('bold');
				});

				$sheet->cells('A6:O6', function($cells)
		    	{
		    		$cells->setBackground('#C0504D');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontWeight('bold');
				});

		        $listaTProductoTrasladoOficina=TProductoTrasladoOficina::with('TOficina', 'tOficinaLlegada', 'TProductoTrasladoOficinaDetalle')->whereRaw('created_at between ? and ?', [$fechaInicial, $fechaFinal])->get();
		
				$data=[];

				array_push($data, array('PRODUCTOS TRASLADADOS ENTRE OFICINAS/TIENDAS ENTRE DOS FECHAS'));
		        array_push($data, array('REPORTE GENERADO EL', date('m-d-Y')));
		        array_push($data, array('FECHA INICIAL', $fechaInicial));
		        array_push($data, array('FECHA FINAL', $fechaFinal));
		        array_push($data, array(''));
		        array_push($data, array('OFICINA/TIENDA DE PARTIDA', 'OFICINA/TIENDA DE LLEGADA', 'FLETE', 'ESTADO', 'FECHA DE TRASLADO'));

		        $lineaActual=6;

		        foreach($listaTProductoTrasladoOficina as $key => $value)
		        {
		        	array_push($data, array($value->tOficina->descripcion, $value->tOficinaLlegada->descripcion, $value->flete, $value->estado ? 'Traslado conforme' : 'Traslado anulada', (string)$value->created_at));
		        	$lineaActual++;

		        	$sheet->cells('A'.$lineaActual.':O'.$lineaActual, function($cells)
			    	{
			    		$cells->setBackground('#E9EAED');
					});

		        	array_push($data, array('', 'CÓDIGO DE BARRAS', 'NOMBRE', 'PRESENTACIÓN', 'UNIDAD', 'CANTIDAD ENVIADA', 'PRECIO DE COMPRA UNITARIO', 'PRECIO DE VENTA UNITARIO'));
		        	$lineaActual++;

		        	$sheet->cells('A'.$lineaActual.':O'.$lineaActual, function($cells)
			    	{
			    		$cells->setFontWeight('bold');
					});

		        	foreach($value->tProductoTrasladoOficinaDetalle as $index => $item)
		        	{
		        		array_push($data, array('', $item->codigoBarrasProducto, $item->primerNombreProducto.' / '.$item->segundoNombreProducto.' / '.$item->tercerNombreProducto, $item->presentacionProducto, $item->unidadMedidaProducto, $item->cantidadProducto, $item->precioCompraUnitarioProducto, $item->precioVentaUnitarioProducto));
		        		$lineaActual++;
		        	}
		        }

		        $sheet->fromArray($data,
		        	null,
		        	'A1',
		        	false,
		        	false
		        );
		    });
		})->export('xlsx');
	}

	public function actionProductosRetiradosOficina()
	{
		set_time_limit(0);
		ini_set('memory_limit', '500M');

		$listaTOficinaProductoRetiro=TOficinaProductoRetiro::orderBy('created_at', 'desc')->get();
		
		$data=[];

		array_push($data, array('PRODUCTOS RETIRADOS DE OFICINA'));
        array_push($data, array('REPORTE GENERADO EL', date('m-d-Y')));
        array_push($data, array(''));
        array_push($data, array('OFICINA/TIENDA', 'NOMBRE', 'TIPO', 'PRESENTACIÓN', 'UNIDAD DE MEDIDA', 'PRECIO DE COMPRA U.', 'PRECIO DE VENTA U.', 'FECHA DE VENCIMIENTO', 'CANTIDAD RETIRADA', 'DESCRIPCIÓN DEL RETIRO', 'MONTO PERDIDO', 'FECHA DEL RETIRO'));

        foreach($listaTOficinaProductoRetiro as $key => $value)
        {
        	array_push($data, array($value->descripcionOficina, $value->nombreCompletoProducto, $value->tipo, $value->presentacionProducto, $value->unidadMedidaProducto, $value->precioCompraUnitarioProducto, $value->precioVentaUnitarioProducto, $value->fechaVencimiento, $value->cantidadUnidad, $value->descripcion, $value->montoPerdido, (string)$value->created_at));
        }

		Excel::create('PRODUCTOS RETIRADOS DE OFICINA', function($excel) use($data)
		{
		    $excel->sheet('Sheetname', function($sheet) use($data)
		    {
		    	$sheet->mergeCells('A1:O1');
		    	$sheet->setAutoSize(true);
		    	$sheet->setHeight(1, 50);

		    	$sheet->cells('A1', function($cells)
		    	{
		    		$cells->setAlignment('center');
		    		$cells->setValignment('center');
		    		$cells->setBackground('#1497CC');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontSize(13);
				});

				$sheet->cells('A2:O2', function($cells)
		    	{
		    		$cells->setBackground('#000000');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontWeight('bold');
				});

				$sheet->cells('A4:O4', function($cells)
		    	{
		    		$cells->setBackground('#C0504D');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontWeight('bold');
				});

		        $sheet->fromArray($data,
		        	null,
		        	'A1',
		        	false,
		        	false
		        );
		    });

		})->export('xlsx');
	}

	public function actionProductosRetiradosAlmacen()
	{
		set_time_limit(0);
		ini_set('memory_limit', '500M');

		$listaTAlmacenProductoRetiro=TAlmacenProductoRetiro::orderBy('created_at', 'desc')->get();
		
		$data=[];

		array_push($data, array('PRODUCTOS RETIRADOS DE ALMACÉN'));
        array_push($data, array('REPORTE GENERADO EL', date('m-d-Y')));
        array_push($data, array(''));
        array_push($data, array('ALMACÉN', 'NOMBRE', 'TIPO', 'PRESENTACIÓN', 'UNIDAD DE MEDIDA', 'PRECIO DE COMPRA U.', 'PRECIO DE VENTA U.', 'FECHA DE VENCIMIENTO', 'CANTIDAD RETIRADA', 'DESCRIPCIÓN DEL RETIRO', 'MONTO PERDIDO', 'FECHA DEL RETIRO'));

        foreach($listaTAlmacenProductoRetiro as $key => $value)
        {
        	array_push($data, array($value->descripcionAlmacen, $value->nombreCompletoProducto, $value->tipo, $value->presentacionProducto, $value->unidadMedidaProducto, $value->precioCompraUnitarioProducto, $value->precioVentaUnitarioProducto, $value->fechaVencimiento, $value->cantidadUnidad, $value->descripcion, $value->montoPerdido, (string)$value->created_at));
        }

		Excel::create('PRODUCTOS RETIRADOS DE ALMACÉN', function($excel) use($data)
		{
		    $excel->sheet('Sheetname', function($sheet) use($data)
		    {
		    	$sheet->mergeCells('A1:O1');
		    	$sheet->setAutoSize(true);
		    	$sheet->setHeight(1, 50);

		    	$sheet->cells('A1', function($cells)
		    	{
		    		$cells->setAlignment('center');
		    		$cells->setValignment('center');
		    		$cells->setBackground('#1497CC');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontSize(13);
				});

				$sheet->cells('A2:O2', function($cells)
		    	{
		    		$cells->setBackground('#000000');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontWeight('bold');
				});

				$sheet->cells('A4:O4', function($cells)
		    	{
		    		$cells->setBackground('#C0504D');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontWeight('bold');
				});

		        $sheet->fromArray($data,
		        	null,
		        	'A1',
		        	false,
		        	false
		        );
		    });

		})->export('xlsx');
	}

	public function actionGastoEntreFechas($fechaInicial=null, $fechaFinal=null)
	{
		set_time_limit(0);
		ini_set('memory_limit', '500M');

		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		{
			return View::make('reporte/gastoentrefechas');
		}

		Excel::create('GASTOS REALIZADOS ENTRE DOS FECHAS_'.$fechaInicial.'_'.$fechaFinal, function($excel) use($fechaInicial, $fechaFinal)
		{
			$excel->sheet('Sheetname', function($sheet) use($fechaInicial, $fechaFinal)
		    {
		    	$sheet->mergeCells('A1:O1');
		    	$sheet->setAutoSize(true);
		    	$sheet->setHeight(1, 25);

		    	$sheet->cells('A1', function($cells)
		    	{
		    		$cells->setAlignment('center');
		    		$cells->setValignment('center');
		    		$cells->setBackground('#1497CC');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontSize(13);
				});

				$sheet->cells('A2:O4', function($cells)
		    	{
		    		$cells->setBackground('#000000');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontWeight('bold');
				});

				$sheet->cells('A6:O6', function($cells)
		    	{
		    		$cells->setBackground('#C0504D');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontWeight('bold');
				});
		
				$listaTEgreso=TEgreso::with('TOficina', 'TPersonal')->whereRaw('created_at between ? and ?', [$fechaInicial, $fechaFinal])->get();
		
				$data=[];

				array_push($data, array('GASTOS REALIZADOS ENTRE DOS FECHAS'));
		        array_push($data, array('REPORTE GENERADO EL', date('m-d-Y')));
		        array_push($data, array('FECHA INICIAL', $fechaInicial));
		        array_push($data, array('FECHA FINAL', $fechaFinal));
		        array_push($data, array(''));
		        array_push($data, array('OFICINA/TIENDA', 'PERSONAL QUE RELIZÓ EL EGRESO', 'DESCRIPCIÓN DEL EGRESO', 'MONTO', 'FECHA DE EGRESO'));

		        $totalGeneral=0;

		        foreach($listaTEgreso as $key => $value)
		        {
		        	$totalGeneral+=($value->monto);

		        	array_push($data, array($value->tOficina->descripcion, $value->tPersonal->nombre.' '.$value->tPersonal->apellidoPaterno.' '.$value->tPersonal->apellidoMaterno, $value->descripcion, number_format($value->monto, 2, '.', ''), (string)$value->created_at));
		        }

		        array_push($data, array(''));
		        array_push($data, array('TOTAL', number_format($totalGeneral, 2, '.', '')));

		        $sheet->fromArray($data,
		        	null,
		        	'A1',
		        	false,
		        	false
		        );
		    });
		})->export('xlsx');
	}

	public function actionCajaEntreFechas($fechaInicial=null, $fechaFinal=null)
	{
		set_time_limit(0);
		ini_set('memory_limit', '500M');

		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		{
			return View::make('reporte/cajaentrefechas');
		}

		Excel::create('CAJA ENTRE DOS FECHAS_'.$fechaInicial.'_'.$fechaFinal, function($excel) use($fechaInicial, $fechaFinal)
		{
			$excel->sheet('Sheetname', function($sheet) use($fechaInicial, $fechaFinal)
		    {
		    	$sheet->mergeCells('A1:O1');
		    	$sheet->setAutoSize(true);
		    	$sheet->setHeight(1, 25);

		    	$sheet->cells('A1', function($cells)
		    	{
		    		$cells->setAlignment('center');
		    		$cells->setValignment('center');
		    		$cells->setBackground('#1497CC');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontSize(13);
				});

				$sheet->cells('A2:O4', function($cells)
		    	{
		    		$cells->setBackground('#000000');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontWeight('bold');
				});

				$sheet->cells('A6:O6', function($cells)
		    	{
		    		$cells->setBackground('#C0504D');
		    		$cells->setFontColor('#ffffff');
		    		$cells->setFontWeight('bold');
				});

		        $listaTCaja=TCaja::with('TCajaDetalle')->whereRaw('created_at between ? and ?', [$fechaInicial, $fechaFinal])->get();
		
				$data=[];

				array_push($data, array('CAJA ENTRE DOS FECHAS'));
		        array_push($data, array('REPORTE GENERADO EL', date('m-d-Y')));
		        array_push($data, array('FECHA INICIAL', $fechaInicial));
		        array_push($data, array('FECHA FINAL', $fechaFinal));
		        array_push($data, array(''));
		        array_push($data, array('CAJA DEL DÍA'));

		        $ingresosTotales=0;
		        $egresosTotales=0;
		        $lineaActual=6;

		        foreach($listaTCaja as $key => $value)
		        {
		        	$saldoInicialTotalDia=0;
		        	$egresosTotalDia=0;
		        	$ingresosTotalDia=0;
		        	$saldoFinalTotalDia=0;

		        	array_push($data, array((string)$value->created_at));
		        	$lineaActual++;

		        	$sheet->cells('A'.$lineaActual.':O'.$lineaActual, function($cells)
			    	{
			    		$cells->setBackground('#E9EAED');
					});

		        	array_push($data, array('', 'PERSONAL', 'SALDO INICIAL', 'EGRESO', 'INGRESO', 'SALDO FINAL', 'DESCRIPCIÓN DEL CIERRE DE CAJA', 'CAJA CERRADA', 'FECHA DE APERTURA'));
		        	$lineaActual++;

		        	$sheet->cells('A'.$lineaActual.':O'.$lineaActual, function($cells)
			    	{
			    		$cells->setFontWeight('bold');
					});

		        	foreach($value->tCajaDetalle as $index => $item)
		        	{
		        		array_push($data, array('', $item->tPersonal->nombre.' '.$item->tPersonal->apellidoPaterno.' '.$item->tPersonal->apellidoMaterno, $item->saldoInicial, $item->egresos, $item->ingresos, $item->saldoFinal, $item->descripcion, $item->cerrado ? 'Si' : 'No', (string)$item->created_at));
		        		$lineaActual++;

		        		$saldoInicialTotalDia+=$item->saldoInicial;
			        	$egresosTotalDia+=$item->egresos;
			        	$ingresosTotalDia+=$item->ingresos;
			        	$saldoFinalTotalDia+=$item->saldoFinal;
		        	}

		        	array_push($data, array('', '', number_format($saldoInicialTotalDia, 2, '.', ''), number_format($egresosTotalDia, 2, '.', ''), number_format($ingresosTotalDia, 2, '.', ''), number_format($saldoFinalTotalDia, 2, '.', '')));
		        	$lineaActual++;

		        	$sheet->cells('A'.$lineaActual.':O'.$lineaActual, function($cells)
			    	{
			    		$cells->setFontWeight('bold');
					});

					$egresosTotales+=number_format($egresosTotalDia, 2, '.', '');
					$ingresosTotales+=number_format($ingresosTotalDia, 2, '.', '');
		        }

		        array_push($data, array(''));
		        array_push($data, array('EGRESOS TOTALES', number_format($egresosTotales, 2, '.', '')));
		        array_push($data, array('INGRESOS TOTALES', number_format($ingresosTotales, 2, '.', '')));

		        $sheet->fromArray($data,
		        	null,
		        	'A1',
		        	false,
		        	false
		        );
		    });
		})->export('xlsx');
	}
}
?>