<?php
class ProductoEnviarStockController extends BaseController
{
	public function actionInsertar()
	{
		if($_POST)
		{
			try
			{
				DB::beginTransaction();

				$mensajeGlobal='';

				$tProductoEnviarStock=new TProductoEnviarStock;

				$tProductoEnviarStock->codigoAlmacen=Input::get('txtCodigoAlmacen');
				$tProductoEnviarStock->codigoOficina=Input::get('txtCodigoOficina');
				$tProductoEnviarStock->flete=Input::get('txtFlete');
				$tProductoEnviarStock->estado=true;
				$tProductoEnviarStock->motivoAnulacion='';

				$tProductoEnviarStock->save();

				$ultimoRegistroTProductoEnviarStock=TProductoEnviarStock::whereRaw('codigoProductoEnviarStock=(select max(codigoProductoEnviarStock) from TProductoEnviarStock)')->get();

				$listaProductos=explode('__SEPARADORREGISTRO__', Input::get('txtListaProductos'));

				$expresionNumero="/^[0-9]+([\.]{1}[0-9]*)?$/";
				$expresionEntero="/^[0-9]+$/";

				foreach($listaProductos as $key => $value)
				{
					$camposProducto=explode('__SEPARADORCAMPO__', $value);

					$tAlmacenProducto=TAlmacenProducto::find($camposProducto[0]);

					if($tAlmacenProducto->cantidad<$camposProducto[10])
					{
						DB::rollback();

						$mensajeGlobal.='Cantidad del producto número '.($key+1).' de la lista insuficiente<br>';
						$txtHtmlListaProductosDevueltos=htmlspecialchars(Input::get('txtHtmlListaProductos'));

						return View::make('productoenviarstock.insertar', Input::all(), ['color' => 'red', 'mensajeGlobal' => $mensajeGlobal, 'txtHtmlListaProductosDevueltos' => $txtHtmlListaProductosDevueltos]);
					}

					if($camposProducto[12]=='No' && !preg_match($expresionEntero, $camposProducto[10]))
					{
						$mensajeGlobal.='Cantidad del producto número '.($key+1).' Incorrecto. No se permite envío de este producto en decimales<br>';
						DB::rollback();
						$txtHtmlListaProductosDevueltos=htmlspecialchars(Input::get('txtHtmlListaProductos'));

						return View::make('productoenviarstock.insertar', Input::all(), ['color' => 'red', 'mensajeGlobal' => $mensajeGlobal, 'txtHtmlListaProductosDevueltos' => $txtHtmlListaProductosDevueltos]);
					}

					if(!preg_match($expresionNumero, $camposProducto[10]) || !preg_match($expresionNumero, $camposProducto[11]) || $camposProducto[10]<=0)
					{
						DB::rollback();

						$mensajeGlobal.='Datos incorrectos en el producto número '.($key+1).' de la lista. Por favor corrija los datos<br>';
						$txtHtmlListaProductosDevueltos=htmlspecialchars(Input::get('txtHtmlListaProductos'));

						return View::make('productoenviarstock.insertar', Input::all(), ['color' => 'red', 'mensajeGlobal' => $mensajeGlobal, 'txtHtmlListaProductosDevueltos' => $txtHtmlListaProductosDevueltos]);
					}

					$tProductoEnviarStockDetalle=new TProductoEnviarStockDetalle;
					
					$tProductoEnviarStockDetalle->codigoProductoEnviarStock=$ultimoRegistroTProductoEnviarStock[0]->codigoProductoEnviarStock;
					$tProductoEnviarStockDetalle->codigoAlmacenProducto=$camposProducto[0];
					$tProductoEnviarStockDetalle->codigoBarrasProducto=$camposProducto[1];
					$tProductoEnviarStockDetalle->primerNombreProducto=$camposProducto[2];
					$tProductoEnviarStockDetalle->segundoNombreProducto=$camposProducto[3];
					$tProductoEnviarStockDetalle->tercerNombreProducto=$camposProducto[4];
					$tProductoEnviarStockDetalle->descripcionProducto=$camposProducto[5];
					$tProductoEnviarStockDetalle->tipoProducto=$camposProducto[6];
					$tProductoEnviarStockDetalle->codigoPresentacionProducto=$camposProducto[7];
					$tProductoEnviarStockDetalle->codigoUnidadMedidaProducto=$camposProducto[8];
					$tProductoEnviarStockDetalle->cantidadProducto=$camposProducto[10];
					$tProductoEnviarStockDetalle->ventaMenorUnidadProducto=$camposProducto[12]=='Si' ? true : false;
					$tProductoEnviarStockDetalle->unidadesBloqueProducto=$camposProducto[15];
					$tProductoEnviarStockDetalle->precioCompraUnitarioProducto=$camposProducto[13];
					$tProductoEnviarStockDetalle->precioVentaUnitarioProducto=$camposProducto[14];
					$tProductoEnviarStockDetalle->unidadMedidaBloqueProducto=$camposProducto[16];
					$tProductoEnviarStockDetalle->fechaVencimientoProducto=$camposProducto[17];

					$tProductoEnviarStockDetalle->save();
				}

				DB::commit();

				return Redirect::to('productoenviarstock/insertar')->with('mensajeRedirect', 'Operación ralizada correctamente');
			}
			catch(Exception $ex)
			{
				DB::rollback();

				$txtHtmlListaProductosDevueltos=htmlspecialchars(Input::get('txtHtmlListaProductos'));

				return View::make('productoenviarstock/insertar', Input::all(), ['color' => 'red', 'mensajeGlobal' => $ex, 'txtHtmlListaProductosDevueltos' => $txtHtmlListaProductosDevueltos]);
			}
		}

		if(Session::has('mensajeRedirect'))
		{
			return View::make('productoenviarstock.insertar', ['color' => '#1497CC', 'mensajeGlobal' => Session::get('mensajeRedirect')]);
		}
		
		return View::make('productoenviarstock.insertar');
	}

	public function actionInsertarConAjax()
	{
		if(Input::has('codigoAlmacen'))
		{
			try
			{
				DB::beginTransaction();

				$mensajeGlobal='';

				$tProductoEnviarStock=new TProductoEnviarStock;

				$tProductoEnviarStock->codigoAlmacen=Input::get('codigoAlmacen');
				$tProductoEnviarStock->codigoOficina=explode(',', Session::get('local'))[0];
				$tProductoEnviarStock->flete=Input::get('flete');
				$tProductoEnviarStock->estado=true;
				$tProductoEnviarStock->motivoAnulacion='';

				$tProductoEnviarStock->save();

				$ultimoRegistroTProductoEnviarStock=TProductoEnviarStock::whereRaw('codigoProductoEnviarStock=(select max(codigoProductoEnviarStock) from TProductoEnviarStock)')->get();

				$listaProductos=explode('__SEPARADORREGISTRO__', Input::get('listaProductos'));

				$expresionNumero="/^[0-9]+([\.]{1}[0-9]*)?$/";
				$expresionEntero="/^[0-9]+$/";

				$listaProductosAgregados=[];

				foreach($listaProductos as $key => $value)
				{
					$camposProducto=explode('__SEPARADORCAMPO__', $value);

					$tAlmacenProducto=TAlmacenProducto::find($camposProducto[0]);

					if($tAlmacenProducto->cantidad<$camposProducto[10])
					{
						DB::rollback();

						$mensajeGlobal.='Cantidad del producto número '.($key+1).' de la lista insuficiente<br>';

						return View::make('productoenviarstock/insertarconajaxresultado', ['color' => 'red', 'mensajeGlobal' => $mensajeGlobal, 'correcto' => false]);
					}

					if($camposProducto[12]=='No' && !preg_match($expresionEntero, $camposProducto[10]))
					{
						DB::rollback();
						
						$mensajeGlobal.='Cantidad del producto número '.($key+1).' Incorrecto. No se permite envío de este producto en decimales<br>';

						return View::make('productoenviarstock/insertarconajaxresultado', ['color' => 'red', 'mensajeGlobal' => $mensajeGlobal, 'correcto' => false]);
					}

					if(!preg_match($expresionNumero, $camposProducto[10]) || !preg_match($expresionNumero, $camposProducto[11]) || $camposProducto[10]<=0)
					{
						DB::rollback();

						$mensajeGlobal.='Datos incorrectos en el producto número '.($key+1).' de la lista. Por favor corrija los datos<br>';

						return View::make('productoenviarstock/insertarconajaxresultado', ['color' => 'red', 'mensajeGlobal' => $mensajeGlobal, 'correcto' => false]);
					}

					$tProductoEnviarStockDetalle=new TProductoEnviarStockDetalle;
					
					$tProductoEnviarStockDetalle->codigoProductoEnviarStock=$ultimoRegistroTProductoEnviarStock[0]->codigoProductoEnviarStock;
					$tProductoEnviarStockDetalle->codigoAlmacenProducto=$camposProducto[0];
					$tProductoEnviarStockDetalle->codigoBarrasProducto=$camposProducto[1];
					$tProductoEnviarStockDetalle->primerNombreProducto=$camposProducto[2];
					$tProductoEnviarStockDetalle->segundoNombreProducto=$camposProducto[3];
					$tProductoEnviarStockDetalle->tercerNombreProducto=$camposProducto[4];
					$tProductoEnviarStockDetalle->descripcionProducto=$camposProducto[5];
					$tProductoEnviarStockDetalle->tipoProducto=$camposProducto[6];
					$tProductoEnviarStockDetalle->codigoPresentacionProducto=$camposProducto[7];
					$tProductoEnviarStockDetalle->codigoUnidadMedidaProducto=$camposProducto[8];
					$tProductoEnviarStockDetalle->cantidadProducto=$camposProducto[10];
					$tProductoEnviarStockDetalle->ventaMenorUnidadProducto=$camposProducto[12]=='Si' ? true : false;
					$tProductoEnviarStockDetalle->unidadesBloqueProducto=$camposProducto[15];
					$tProductoEnviarStockDetalle->precioCompraUnitarioProducto=$camposProducto[13];
					$tProductoEnviarStockDetalle->precioVentaUnitarioProducto=$camposProducto[14];
					$tProductoEnviarStockDetalle->unidadMedidaBloqueProducto=$camposProducto[16];
					$tProductoEnviarStockDetalle->fechaVencimientoProducto=$camposProducto[17];

					$tProductoEnviarStockDetalle->save();

					array_push($listaProductosAgregados, [TOficinaProducto::whereRaw('replace(concat(codigoOficina, presentacion, unidadMedida, codigoBarras, primerNombre, segundoNombre, tercerNombre, tipo), " ", "")=?', [str_replace(' ', '', explode(',', Session::get('local'))[0].TPresentacion::find($camposProducto[7])->nombre.TUnidadMedida::find($camposProducto[8])->nombre.$camposProducto[1].$camposProducto[2].$camposProducto[3].$camposProducto[4].$camposProducto[6])])->get()[0], $camposProducto[10]]);
				}

				DB::commit();

				return View::make('productoenviarstock/insertarconajaxresultado', ['correcto' => true, 'color' => '#1497CC', 'mensajeGlobal' => 'Producto(s) agregados a la lista de venta', 'listaProductosAgregados' => $listaProductosAgregados]);
			}
			catch(Exception $ex)
			{
				DB::rollback();

				return View::make('productoenviarstock/insertarconajaxresultado', ['color' => 'red', 'mensajeGlobal' => $ex, 'correcto' => false]);
			}
		}
		
		return View::make('productoenviarstock/insertarconajax');
	}

	public function actionVerEntreFechas($fechaInicial=null, $fechaFinal=null)
	{
		$listaTProductoEnviarStock=TProductoEnviarStock::with('tOficina', 'tAlmacen')->whereRaw('created_at between ? and ? order by created_at desc', [$fechaInicial, $fechaFinal])->get();

		if(Session::has('mensajeRedirect'))
		{
			return View::make('productoenviarstock/verentrefechas', ['color' => '#1497CC', 'mensajeGlobal' => Session::get('mensajeRedirect'), 'listaTProductoEnviarStock' => $listaTProductoEnviarStock, 'fechaInicial' => $fechaInicial, 'fechaFinal' => $fechaFinal]);
		}

		if(Session::has('mensajeRedirectError'))
		{
			return View::make('productoenviarstock/verentrefechas', ['color' => 'red', 'mensajeGlobal' => Session::get('mensajeRedirectError'), 'listaTProductoEnviarStock' => $listaTProductoEnviarStock, 'fechaInicial' => $fechaInicial, 'fechaFinal' => $fechaFinal]);
		}

		return View::make('productoenviarstock/verentrefechas', ['listaTProductoEnviarStock' => $listaTProductoEnviarStock, 'fechaInicial' => $fechaInicial, 'fechaFinal' => $fechaFinal]);
	}

	public function actionAnular()
	{
		if(Input::has('txtCodigoProductoEnviarStock'))
		{
			try
			{
				DB::beginTransaction();

				$tProductoEnviarStock=TProductoEnviarStock::find(Input::get('txtCodigoProductoEnviarStock'));
				
				$tProductoEnviarStock->estado=false;
				$tProductoEnviarStock->motivoAnulacion=Input::get('txtMotivoAnulacion');

				$tProductoEnviarStock->save();

				$listaTProductoEnviarStockDetalle=TProductoEnviarStockDetalle::whereRaw('codigoProductoEnviarStock=?', [Input::get('txtCodigoProductoEnviarStock')])->get();

				foreach($listaTProductoEnviarStockDetalle as $key => $value)
				{
					$tOficinaProducto=TOficinaProducto::whereRaw('codigoOficina=? and presentacion=? and unidadMedida=? and codigoBarras=? and primerNombre=? and segundoNombre=? and tercerNombre=? and tipo=?', [$tProductoEnviarStock->codigoOficina, $value->tPresentacion->nombre, $value->tUnidadMedida->nombre, $value->codigoBarrasProducto, $value->primerNombreProducto, $value->segundoNombreProducto, $value->tercerNombreProducto, $value->tipoProducto])->get();

					if(count($tOficinaProducto)>0)
					{
						$cantidadAnterior=$tOficinaProducto[0]->cantidad;

						if(($cantidadAnterior-($value->cantidadProducto))<0)
						{
							DB::rollback();

							return Redirect::to('/productoenviarstock/verentrefechas/'.date('Y-m-d').'/'.date('Y-m-d', strtotime(date('Y-m-d').' +1 day')))->with('mensajeRedirectError', 'No se puede anular el envío porque ya no existe la cantidad necesaria de productos en la oficina');
						}

						$tOficinaProducto[0]->cantidad=$cantidadAnterior-($value->cantidadProducto);

						$tOficinaProducto[0]->save();
					}
					else
					{
						DB::rollback();

						return Redirect::to('/productoenviarstock/verentrefechas/'.date('Y-m-d').'/'.date('Y-m-d', strtotime(date('Y-m-d').' +1 day')))->with('mensajeRedirectError', 'No se puede anular el envío porque no se encontró productos de dicho envío en la oficina');
					}

					$tAlmacenProducto=TAlmacenProducto::whereRaw('codigoAlmacen=? and codigoPresentacion=? and codigoUnidadMedida=? and codigoBarras=? and primerNombre=? and segundoNombre=? and tercerNombre=? and tipo=?', [$tProductoEnviarStock->codigoAlmacen, $value->codigoPresentacionProducto, $value->codigoUnidadMedidaProducto, $value->codigoBarrasProducto, $value->primerNombreProducto, $value->segundoNombreProducto, $value->tercerNombreProducto, $value->tipoProducto])->get();

					$cantidadAnterior=$tAlmacenProducto[0]->cantidad;

					$tAlmacenProducto[0]->cantidad=$cantidadAnterior+($value->cantidadProducto);

					$tAlmacenProducto[0]->save();
				}

				DB::commit();

				return Redirect::to('/productoenviarstock/verentrefechas/'.date('Y-m-d').'/'.date('Y-m-d', strtotime(date('Y-m-d').' +1 day')))->with('mensajeRedirect', 'Operación realizada correctamente');
			}
			catch(Exception $ex)
			{
				DB::rollback();

				return Redirect::to('/productoenviarstock/verentrefechas/'.date('Y-m-d').'/'.date('Y-m-d', strtotime(date('Y-m-d').' +1 day')))->with('mensajeRedirectError', 'Error inesperado, por favor contacte con el administrador del sistema');
			}
		}

		$tProductoEnviarStock=TProductoEnviarStock::find(Input::get('codigo'));

		return View::make('productoenviarstock/anular', ['tProductoEnviarStock' => $tProductoEnviarStock]);
	}
}
?>