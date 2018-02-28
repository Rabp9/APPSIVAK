<?php
class ReciboCompraController extends BaseController
{
	public function actionInsertar()
	{
		if($_POST)
		{
			try
			{
				DB::beginTransaction();

				$mensajeGlobal='';

				if(TReciboCompra::whereRaw('tipoRecibo=? and numeroRecibo=? and numeroRecibo!=? and codigoProveedor=? and estado=?', [Input::get('cbxTipoRecibo'), Input::get('txtNumeroRecibo'), '', Input::get('txtCodigoProveedor'), true])->count()>0)
				{
					$mensajeGlobal.='El número del comprobante ya fue registrado con anterioridad<br>';
				}

				if(Input::get('radioTipoPago')=='Al Crédito' && number_format(Input::get('txtTotal'), 2, '.', '')==0.00)
				{
					$mensajeGlobal.='El monto total en un crédito no puede ser 0.00<br>';
				}

				if($mensajeGlobal!='')
				{
					DB::rollback();

					$txtHtmlListaProductosDevueltos=htmlspecialchars(Input::get('txtHtmlListaProductos'));
					$listaTPresentacion=TPresentacion::all();
					$listaTUnidadMedida=TUnidadMedida::all();

					$fechaActual=date('Y-m-d');

					$tCaja=TCaja::whereRaw('mid(created_at, 1, 10)=?', [$fechaActual])->get();

					if(count($tCaja)>0)
					{
						$tDetalleCaja=TCajaDetalle::whereRaw('codigoCaja=? and codigoPersonal=? and mid(created_at, 1, 10)=?', [$tCaja[0]->codigoCaja, substr(Session::get('usuario'), 0, 15), date('Y-m-d')])->get();
					}

					$cajaAbierta=(isset($tDetalleCaja) && count($tDetalleCaja)>0) ? 1 : 0;
					$cajaAbierta=($cajaAbierta && isset($tDetalleCaja) && $tDetalleCaja[0]->cerrado) ? 2 : $cajaAbierta;
					
					return View::make('recibocompra.insertar', Input::all(), ['color' => 'red', 'mensajeGlobal' => $mensajeGlobal, 'cajaAbierta' => $cajaAbierta, 'txtHtmlListaProductosDevueltos' => $txtHtmlListaProductosDevueltos, 'listaTPresentacion' => $listaTPresentacion, 'listaTUnidadMedida' => $listaTUnidadMedida]);
				}

				if(Input::get('radioTipoPago')=='Al Contado')
				{
					$montoParaCaja=Input::get('txtTotal');

					$fechaActual=date('Y-m-d');

					$tCaja=TCaja::whereRaw('mid(created_at, 1, 10)=?', [$fechaActual])->get();

					if(count($tCaja)>0)
					{
						$tDetalleCaja=TCajaDetalle::whereRaw('codigoCaja=? and codigoPersonal=? and mid(created_at, 1, 10)=?', [$tCaja[0]->codigoCaja, substr(Session::get('usuario'), 0, 15), date('Y-m-d')])->get();
					}

					$cajaAbierta=(isset($tDetalleCaja) && count($tDetalleCaja)>0) ? 1 : 0;
					$cajaAbierta=($cajaAbierta && isset($tDetalleCaja) && $tDetalleCaja[0]->cerrado) ? 2 : $cajaAbierta;

					if($cajaAbierta==1)
					{
						if(($tDetalleCaja[0]->saldoFinal)<$montoParaCaja)
						{
							DB::rollback();

							$txtHtmlListaProductosDevueltos=htmlspecialchars(Input::get('txtHtmlListaProductos'));
							$listaTPresentacion=TPresentacion::all();
							$listaTUnidadMedida=TUnidadMedida::all();
							
							return View::make('recibocompra/insertar', Input::all(), ['color' => 'red', 'mensajeGlobal' => 'El dinero en caja no es suficiente', 'cajaAbierta' => $cajaAbierta, 'txtHtmlListaProductosDevueltos' => $txtHtmlListaProductosDevueltos, 'listaTPresentacion' => $listaTPresentacion, 'listaTUnidadMedida' => $listaTUnidadMedida]);
						}

						$tDetalleCaja[0]->saldoFinal=($tDetalleCaja[0]->saldoFinal)-$montoParaCaja;
						$tDetalleCaja[0]->egresos=($tDetalleCaja[0]->egresos)+$montoParaCaja;

						$tDetalleCaja[0]->save();
					}
					else
					{
						DB::rollback();

						return Redirect::to('recibocompra/insertar')->with('mensajeRedirectError', 'No se puede realizar operaciones en caja');
					}
				}

				$tReciboCompra=new TReciboCompra;

				$tReciboCompra->codigoProveedor=Input::get('txtCodigoProveedor');
				$tReciboCompra->codigoAlmacen=Input::get('txtCodigoAlmacen');
				$tReciboCompra->descripcion=Input::get('txtDescripcion');
				$tReciboCompra->igv=Input::get('txtIgv');
				$tReciboCompra->subTotal=Input::get('txtSubTotal');
				$tReciboCompra->total=Input::get('txtTotal');
				$tReciboCompra->tipoRecibo=Input::get('cbxTipoRecibo');
				$tReciboCompra->numeroRecibo=Input::get('txtNumeroRecibo');
				$tReciboCompra->comprobanteEmitido=true;
				$tReciboCompra->fechaComprobanteEmitido=Input::get('dateFechaComprobanteEmitido');
				$tReciboCompra->tipoPago=Input::get('radioTipoPago');
				$tReciboCompra->fechaPagar=Input::get('dateFechaPagar');
				$tReciboCompra->estado=true;

				$tReciboCompra->save();

				if(Input::get('checkBuscarOficina')=='Buscar Oficina')
				{
					$tProductoEnviarStock=new TProductoEnviarStock;

					$tProductoEnviarStock->codigoAlmacen=Input::get('txtCodigoAlmacen');
					$tProductoEnviarStock->codigoOficina=Input::get('txtCodigoOficina');
					$tProductoEnviarStock->flete=0;
					$tProductoEnviarStock->estado=true;

					$tProductoEnviarStock->save();

					$ultimoRegistroTProductoEnviarStock=TProductoEnviarStock::whereRaw('codigoProductoEnviarStock=(select max(codigoProductoEnviarStock) from TProductoEnviarStock)')->get();
				}

				$ultimoRegistroTReciboCompra=TReciboCompra::whereRaw('codigoReciboCompra=(select max(codigoReciboCompra) from TReciboCompra)')->get();

				$listaProductos=explode('__SEPARADORREGISTRO__', Input::get('txtListaProductos'));

				foreach($listaProductos as $key => $value)
				{
					$camposProducto=explode('__SEPARADORCAMPO__', $value);

					$datosComparacionProducto=Input::get('txtCodigoAlmacen').$camposProducto[6].$camposProducto[7].$camposProducto[0].$camposProducto[1].$camposProducto[2].$camposProducto[3].$camposProducto[5];					
					$datosComparacionProducto=str_replace(' ', '', $datosComparacionProducto);

					if(Input::get('cbxTipoRecibo')!='Ninguno' && $camposProducto[8]<=0)
					{
						$mensajeGlobal.='El precio de compra total de los productos de la lista no puede ser menor o igual a 0 para este comprobante<br>';
					}

					if($mensajeGlobal!='')
					{
						DB::rollback();

						$txtHtmlListaProductosDevueltos=htmlspecialchars(Input::get('txtHtmlListaProductos'));
						$listaTCategoria=TCategoria::whereRaw('codigoCategoriaPadre!=?', ['CATEGORI0000000'])->get();
						$listaTPresentacion=TPresentacion::all();
						$listaTUnidadMedida=TUnidadMedida::all();

						$fechaActual=date('Y-m-d');

						$tCaja=TCaja::whereRaw('mid(created_at, 1, 10)=?', [$fechaActual])->get();

						if(count($tCaja)>0)
						{
							$tDetalleCaja=TCajaDetalle::whereRaw('codigoCaja=? and codigoPersonal=? and mid(created_at, 1, 10)=?', [$tCaja[0]->codigoCaja, substr(Session::get('usuario'), 0, 15), date('Y-m-d')])->get();
						}

						$cajaAbierta=(isset($tDetalleCaja) && count($tDetalleCaja)>0) ? 1 : 0;
						$cajaAbierta=($cajaAbierta && isset($tDetalleCaja) && $tDetalleCaja[0]->cerrado) ? 2 : $cajaAbierta;
						
						return View::make('recibocompra/insertar', Input::all(), ['color' => 'red', 'mensajeGlobal' => $mensajeGlobal, 'cajaAbierta' =>$cajaAbierta, 'txtHtmlListaProductosDevueltos' => $txtHtmlListaProductosDevueltos, 'listaTCategoria' => $listaTCategoria, 'listaTPresentacion' => $listaTPresentacion, 'listaTUnidadMedida' => $listaTUnidadMedida]);
					}

					$existeProductoEnAlmacen=false;

					$tAlmacenProductoExistente=TAlmacenProducto::whereRaw('replace(concat(codigoAlmacen, codigoPresentacion, codigoUnidadMedida, codigoBarras, primerNombre, segundoNombre, tercerNombre, tipo), " ", "")=?', [$datosComparacionProducto])->get();

					if(count($tAlmacenProductoExistente)>0)
					{
						$existeProductoEnAlmacen=true;
					}

					if(!$existeProductoEnAlmacen)
					{
						if(TAlmacenProducto::whereRaw('codigoAlmacen=? and codigoBarras=? and codigoBarras!=?', [Input::get('txtCodigoAlmacen'), $camposProducto[0], ''])->count()>0)
						{
							$mensajeGlobal.='El código de barras de producto número '.($key+1).' de la lista, ya se encuentra asignado a otro producto<br>';
						}

						if($mensajeGlobal!='')
						{
							DB::rollback();

							$txtHtmlListaProductosDevueltos=htmlspecialchars(Input::get('txtHtmlListaProductos'));
							$listaTCategoria=TCategoria::whereRaw('codigoCategoriaPadre!=?', ['CATEGORI0000000'])->get();
							$listaTPresentacion=TPresentacion::all();
							$listaTUnidadMedida=TUnidadMedida::all();

							$fechaActual=date('Y-m-d');

							$tCaja=TCaja::whereRaw('mid(created_at, 1, 10)=?', [$fechaActual])->get();

							if(count($tCaja)>0)
							{
								$tDetalleCaja=TCajaDetalle::whereRaw('codigoCaja=? and codigoPersonal=? and mid(created_at, 1, 10)=?', [$tCaja[0]->codigoCaja, substr(Session::get('usuario'), 0, 15), date('Y-m-d')])->get();
							}

							$cajaAbierta=(isset($tDetalleCaja) && count($tDetalleCaja)>0) ? 1 : 0;
							$cajaAbierta=($cajaAbierta && isset($tDetalleCaja) && $tDetalleCaja[0]->cerrado) ? 2 : $cajaAbierta;
							
							return View::make('recibocompra/insertar', Input::all(), ['color' => 'red', 'mensajeGlobal' => $mensajeGlobal, 'cajaAbierta' =>$cajaAbierta, 'txtHtmlListaProductosDevueltos' => $txtHtmlListaProductosDevueltos, 'listaTCategoria' => $listaTCategoria, 'listaTPresentacion' => $listaTPresentacion, 'listaTUnidadMedida' => $listaTUnidadMedida]);
						}
					}

					$tReciboCompraDetalle=new TReciboCompraDetalle;

					$tReciboCompraDetalle->codigoReciboCompra=$ultimoRegistroTReciboCompra[0]->codigoReciboCompra;
					$tReciboCompraDetalle->codigoBarrasProducto=$camposProducto[0];
					$tReciboCompraDetalle->primerNombreProducto=$camposProducto[1];
					$tReciboCompraDetalle->segundoNombreProducto=$camposProducto[2];
					$tReciboCompraDetalle->tercerNombreProducto=$camposProducto[3];
					$tReciboCompraDetalle->descripcionProducto=$camposProducto[4];
					$tReciboCompraDetalle->tipoProducto=$camposProducto[5];
					$tReciboCompraDetalle->codigoPresentacionProducto=$camposProducto[6];
					$tReciboCompraDetalle->codigoUnidadMedidaProducto=$camposProducto[7];
					$tReciboCompraDetalle->precioCompraTotalProducto=$camposProducto[8];
					$tReciboCompraDetalle->precioCompraUnitarioProducto=$camposProducto[10]==0 ? number_format($camposProducto[8], 2, '.', '') : number_format(($camposProducto[8]/$camposProducto[10]), 2, '.', '');
					$tReciboCompraDetalle->precioVentaUnitarioProducto=$camposProducto[9];
					$tReciboCompraDetalle->cantidadProducto=$camposProducto[10];
					$tReciboCompraDetalle->ventaMenorUnidadProducto=$camposProducto[11]=='Si' ? true : false;
					$tReciboCompraDetalle->unidadesBloqueProducto=$camposProducto[12];
					$tReciboCompraDetalle->unidadMedidaBloqueProducto=$camposProducto[13];
					$tReciboCompraDetalle->fechaVencimientoProducto=$camposProducto[14];

					$tReciboCompraDetalle->save();

					if(Input::get('checkBuscarOficina')=='Buscar Oficina')
					{
						$codigoAlmacenProductoTemporal='';

						if($existeProductoEnAlmacen)
						{
							$codigoAlmacenProductoTemporal=$tAlmacenProductoExistente[0]->codigoAlmacenProducto;
						}
						else
						{
							$ultimoRegistroTAlmacenProducto=TAlmacenProducto::whereRaw('codigoAlmacenProducto=(select max(codigoAlmacenProducto) from TAlmacenProducto)')->get();

							$codigoAlmacenProductoTemporal=$ultimoRegistroTAlmacenProducto[0]->codigoAlmacenProducto;
						}

						$tProductoEnviarStockDetalle=new TProductoEnviarStockDetalle;
						
						$tProductoEnviarStockDetalle->codigoProductoEnviarStock=$ultimoRegistroTProductoEnviarStock[0]->codigoProductoEnviarStock;
						$tProductoEnviarStockDetalle->codigoAlmacenProducto=$codigoAlmacenProductoTemporal;
						$tProductoEnviarStockDetalle->codigoBarrasProducto=$camposProducto[0];
						$tProductoEnviarStockDetalle->primerNombreProducto=$camposProducto[1];
						$tProductoEnviarStockDetalle->segundoNombreProducto=$camposProducto[2];
						$tProductoEnviarStockDetalle->tercerNombreProducto=$camposProducto[3];
						$tProductoEnviarStockDetalle->descripcionProducto=$camposProducto[4];
						$tProductoEnviarStockDetalle->tipoProducto=$camposProducto[5];
						$tProductoEnviarStockDetalle->codigoPresentacionProducto=$camposProducto[6];
						$tProductoEnviarStockDetalle->codigoUnidadMedidaProducto=$camposProducto[7];
						$tProductoEnviarStockDetalle->cantidadProducto=$camposProducto[10];
						$tProductoEnviarStockDetalle->ventaMenorUnidadProducto=$camposProducto[11]=='Si' ? true : false;
						$tProductoEnviarStockDetalle->unidadesBloqueProducto=$camposProducto[12];
						$tProductoEnviarStockDetalle->precioCompraUnitarioProducto=$camposProducto[10]==0 ? number_format($camposProducto[8], 2, '.', '') : number_format(($camposProducto[8]/$camposProducto[10]), 2, '.', '');
						$tProductoEnviarStockDetalle->precioVentaUnitarioProducto=$camposProducto[9];
						$tProductoEnviarStockDetalle->unidadMedidaBloqueProducto=$camposProducto[13];
						$tProductoEnviarStockDetalle->fechaVencimientoProducto=$camposProducto[14];

						$tProductoEnviarStockDetalle->save();
					}
				}

				DB::commit();

				return Redirect::to('recibocompra/insertar')->with('mensajeRedirect', 'Operación realizada correctamente');
			}
			catch(Exception $ex)
			{
				DB::rollback();

				$txtHtmlListaProductosDevueltos=htmlspecialchars(Input::get('txtHtmlListaProductos'));
				$listaTPresentacion=TPresentacion::all();
				$listaTUnidadMedida=TUnidadMedida::all();

				$fechaActual=date('Y-m-d');

				$tCaja=TCaja::whereRaw('mid(created_at, 1, 10)=?', [$fechaActual])->get();

				if(count($tCaja)>0)
				{
					$tDetalleCaja=TCajaDetalle::whereRaw('codigoCaja=? and codigoPersonal=? and mid(created_at, 1, 10)=?', [$tCaja[0]->codigoCaja, substr(Session::get('usuario'), 0, 15), date('Y-m-d')])->get();
				}

				$cajaAbierta=(isset($tDetalleCaja) && count($tDetalleCaja)>0) ? 1 : 0;
				$cajaAbierta=($cajaAbierta && isset($tDetalleCaja) && $tDetalleCaja[0]->cerrado) ? 2 : $cajaAbierta;
				
				return View::make('recibocompra/insertar', Input::all(), ['color' => 'red', 'mensajeGlobal' => 'Error inserperado. Por favor contacte con el administrador del sistema', 'cajaAbierta' => $cajaAbierta, 'txtHtmlListaProductosDevueltos' => $txtHtmlListaProductosDevueltos, 'listaTPresentacion' => $listaTPresentacion, 'listaTUnidadMedida' => $listaTUnidadMedida]);
			}
		}

		$listaTPresentacion=TPresentacion::all();
		$listaTUnidadMedida=TUnidadMedida::all();

		$fechaActual=date('Y-m-d');

		$tCaja=TCaja::whereRaw('mid(created_at, 1, 10)=?', [$fechaActual])->get();

		if(count($tCaja)>0)
		{
			$tDetalleCaja=TCajaDetalle::whereRaw('codigoCaja=? and codigoPersonal=? and mid(created_at, 1, 10)=?', [$tCaja[0]->codigoCaja, substr(Session::get('usuario'), 0, 15), date('Y-m-d')])->get();
		}

		$cajaAbierta=(isset($tDetalleCaja) && count($tDetalleCaja)>0) ? 1 : 0;
		$cajaAbierta=($cajaAbierta && isset($tDetalleCaja) && $tDetalleCaja[0]->cerrado) ? 2 : $cajaAbierta;

		if(Session::has('mensajeRedirect'))
		{
			return View::make('recibocompra.insertar', ['color' => '#1497CC', 'mensajeGlobal' => Session::get('mensajeRedirect'), 'cajaAbierta' => $cajaAbierta, 'listaTPresentacion' => $listaTPresentacion, 'listaTUnidadMedida' => $listaTUnidadMedida]);
		}

		if(Session::has('mensajeRedirectError'))
		{
			return View::make('recibocompra.insertar', ['color' => 'red', 'mensajeGlobal' => Session::get('mensajeRedirectError'), 'cajaAbierta' => $cajaAbierta, 'listaTPresentacion' => $listaTPresentacion, 'listaTUnidadMedida' => $listaTUnidadMedida]);
		}

		return View::make('recibocompra.insertar', ['cajaAbierta' => $cajaAbierta, 'listaTPresentacion' => $listaTPresentacion, 'listaTUnidadMedida' => $listaTUnidadMedida]);
	}

	public function actionVerEntreFechas($fechaInicial=null, $fechaFinal=null)
	{
		$listaTReciboCompra=TReciboCompra::whereRaw('created_at between ? and ?  order by created_at desc', [$fechaInicial, $fechaFinal])->get();

		if(Session::has('mensajeRedirect'))
		{
			return View::make('recibocompra.verentrefechas', ['color' => '#1497CC', 'mensajeGlobal' => Session::get('mensajeRedirect'), 'listaTReciboCompra' => $listaTReciboCompra, 'fechaInicial' => $fechaInicial, 'fechaFinal' => $fechaFinal]);
		}

		if(Session::has('mensajeRedirectError'))
		{
			return View::make('recibocompra.verentrefechas', ['color' => 'red', 'mensajeGlobal' => Session::get('mensajeRedirectError'), 'listaTReciboCompra' => $listaTReciboCompra, 'fechaInicial' => $fechaInicial, 'fechaFinal' => $fechaFinal]);
		}

		return View::make('recibocompra.verentrefechas', ['listaTReciboCompra' => $listaTReciboCompra, 'fechaInicial' => $fechaInicial, 'fechaFinal' => $fechaFinal]);
	}

	public function actionAnular()
	{
		if(Input::has('txtCodigoReciboCompra'))
		{
			try
			{
				DB::beginTransaction();

				$tReciboCompra=TReciboCompra::find(Input::get('txtCodigoReciboCompra'));

				if($tReciboCompra->tipoPago=='Al Crédito')
				{
					if(TReciboCompraPago::whereRaw('codigoReciboCompra=?', [($tReciboCompra->codigoReciboCompra)])->count()>0)
					{
						DB::rollback();

						return Redirect::to('/recibocompra/verentrefechas/'.date('Y-m-d').'/'.date('Y-m-d', strtotime(date('Y-m-d').' +1 day')))->with('mensajeRedirectError', 'No se puede anular la compra porque ya se pagaron letras');
					}
				}
				
				$tReciboCompra->estado=false;
				$tReciboCompra->motivoAnulacion=Input::get('txtMotivoAnulacion');

				$tReciboCompra->save();

				$montoParaCaja=0;

				$listaTReciboCompraDetalle=TReciboCompraDetalle::whereRaw('codigoReciboCompra=?', [Input::get('txtCodigoReciboCompra')])->get();

				foreach($listaTReciboCompraDetalle as $key => $value)
				{
					$montoParaCaja+=$value->precioCompraTotalProducto;

					$tAlmacenProducto=TAlmacenProducto::whereRaw('codigoAlmacen=? and codigoPresentacion=? and codigoUnidadMedida=? and codigoBarras=? and primerNombre=? and segundoNombre=? and tercerNombre=? and tipo=?', [$tReciboCompra->codigoAlmacen, $value->codigoPresentacionProducto, $value->codigoUnidadMedidaProducto, $value->codigoBarrasProducto, $value->primerNombreProducto, $value->segundoNombreProducto, $value->tercerNombreProducto, $value->tipoProducto])->get();

					if(count($tAlmacenProducto)>0)
					{
						$cantidadAnterior=$tAlmacenProducto[0]->cantidad;

						if(($cantidadAnterior-($value->cantidadProducto))<0)
						{
							DB::rollback();

							return Redirect::to('/recibocompra/verentrefechas/'.date('Y-m-d').'/'.date('Y-m-d', strtotime(date('Y-m-d').' +1 day')))->with('mensajeRedirectError', 'No se puede anular la compra porque ya no existe la cantidad necesaria de productos en almacén');
						}

						$tAlmacenProducto[0]->cantidad=$cantidadAnterior-($value->cantidadProducto);

						$tAlmacenProducto[0]->save();
					}
					else
					{
						DB::rollback();

						return Redirect::to('/recibocompra/verentrefechas/'.date('Y-m-d').'/'.date('Y-m-d', strtotime(date('Y-m-d').' +1 day')))->with('mensajeRedirectError', 'No se puede anular la compra porque no se encontró productos del comprobante en el almacén');
					}
				}

				if($tReciboCompra->tipoPago=='Al Contado')
				{
					$fechaActual=date('Y-m-d');

					$tCaja=TCaja::whereRaw('mid(created_at, 1, 10)=?', [$fechaActual])->get();

					if(count($tCaja)>0)
					{
						$tDetalleCaja=TCajaDetalle::whereRaw('codigoCaja=? and codigoPersonal=? and mid(created_at, 1, 10)=?', [$tCaja[0]->codigoCaja, substr(Session::get('usuario'), 0, 15), date('Y-m-d')])->get();
					}

					$cajaAbierta=(isset($tDetalleCaja) && count($tDetalleCaja)>0) ? 1 : 0;
					$cajaAbierta=($cajaAbierta && isset($tDetalleCaja) && $tDetalleCaja[0]->cerrado) ? 2 : $cajaAbierta;

					if($cajaAbierta==1)
					{
						$tDetalleCaja[0]->saldoFinal=($tDetalleCaja[0]->saldoFinal)+$montoParaCaja;
						$tDetalleCaja[0]->ingresos=($tDetalleCaja[0]->ingresos)+$montoParaCaja;

						$tDetalleCaja[0]->save();
					}
					else
					{
						DB::rollback();

						return Redirect::to('/recibocompra/verentrefechas/'.date('Y-m-d').'/'.date('Y-m-d', strtotime(date('Y-m-d').' +1 day')))->with('mensajeRedirectError', 'Se debe abrir caja antes de realizar operaciones monetarias');
					}
				}

				DB::commit();

				return Redirect::to('/recibocompra/verentrefechas/'.date('Y-m-d').'/'.date('Y-m-d', strtotime(date('Y-m-d').' +1 day')))->with('mensajeRedirect', 'Operación realizada correctamente');
			}
			catch(Exception $ex)
			{
				DB::rollback();

				return Redirect::to('/recibocompra/verentrefechas/'.date('Y-m-d').'/'.date('Y-m-d', strtotime(date('Y-m-d').' +1 day')))->with('mensajeRedirectError', 'Error inesperado, por favor contacte con el administrador del sistema');
			}
		}

		$tReciboCompra=TReciboCompra::find(Input::get('codigo'));
		
		$fechaActual=date('Y-m-d');
		
		$tCaja=TCaja::whereRaw('mid(created_at, 1, 10)=?', [$fechaActual])->get();

		if(count($tCaja)>0)
		{
			$tDetalleCaja=TCajaDetalle::whereRaw('codigoCaja=? and codigoPersonal=? and mid(created_at, 1, 10)=?', [$tCaja[0]->codigoCaja, substr(Session::get('usuario'), 0, 15), date('Y-m-d')])->get();
		}

		$cajaAbierta=(isset($tDetalleCaja) && count($tDetalleCaja)>0) ? 1 : 0;
		$cajaAbierta=($cajaAbierta && isset($tDetalleCaja) && $tDetalleCaja[0]->cerrado) ? 2 : $cajaAbierta;

		return View::make('recibocompra.anular', ['tReciboCompra' => $tReciboCompra, 'cajaAbierta' => $cajaAbierta]);
	}

	public function actionVerPorTipoPago($tipoPago='Al Crédito')
	{
		$listaTReciboCompra=TReciboCompra::whereRaw('tipoPago=? order by created_at desc', [$tipoPago])->get();

		if(Session::has('mensajeRedirect'))
		{
			return View::make('recibocompra.verportipopago', ['color' => '#1497CC', 'mensajeGlobal' => Session::get('mensajeRedirect'), 'listaTReciboCompra' => $listaTReciboCompra]);
		}

		if(Session::has('mensajeRedirectError'))
		{
			return View::make('recibocompra.verportipopago', ['color' => 'red', 'mensajeGlobal' => Session::get('mensajeRedirectError'), 'listaTReciboCompra' => $listaTReciboCompra]);
		}

		return View::make('recibocompra.verportipopago', ['listaTReciboCompra' => $listaTReciboCompra, 'tipoPago' => $tipoPago]);
	}

	public function actionEditar()
	{
		if(Input::has('txtCodigoReciboCompra'))
		{
			$mensajeGlobal='';

			$tReciboCompra=TReciboCompra::whereRaw('codigoReciboCompra!=? and numeroRecibo=? and numeroRecibo!=? and tipoRecibo=? and estado=?', [Input::get('txtCodigoReciboCompra'), Input::get('txtNumeroRecibo'), '', Input::get('cbxTipoRecibo'), true])->get();

			if(count($tReciboCompra)>0)
			{
				$mensajeGlobal.='El número del comprobante ya existe en otra compra.<br>';
			}

			if($mensajeGlobal!='')
			{
				return Redirect::to('/recibocompra/verentrefechas/'.date('Y-m-d').'/'.date('Y-m-d', strtotime(date('Y-m-d').' +1 day')))->with('mensajeRedirectError', $mensajeGlobal);
			}

			$tReciboCompra=TReciboCompra::find(Input::get('txtCodigoReciboCompra'));

			$tReciboCompra->descripcion=Input::get('txtDescripcion');
			$tReciboCompra->tipoRecibo=Input::get('cbxTipoRecibo');
			$tReciboCompra->numeroRecibo=Input::get('txtNumeroRecibo');
			$tReciboCompra->comprobanteEmitido=true;
			$tReciboCompra->fechaComprobanteEmitido=Input::get('dateFechaComprobanteEmitido');

			$tReciboCompra->save();

			return Redirect::to('/recibocompra/verentrefechas/'.date('Y-m-d').'/'.date('Y-m-d', strtotime(date('Y-m-d').' +1 day')))->with('mensajeRedirect', 'Cambios guardados correctamente');
		}

		$tReciboCompra=TReciboCompra::find(Input::get('codigo'));

		return View::make('recibocompra/editar', ['tReciboCompra' => $tReciboCompra]);
	}
}
?>