<?php
class ProductoTrasladoOficinaController extends BaseController
{
	public function actionInsertar()
	{
		if($_POST)
		{
			try
			{
				DB::beginTransaction();

				$mensajeGlobal='';

				$tProductoTrasladoOficina=new TProductoTrasladoOficina;

				$tProductoTrasladoOficina->codigoOficina=Input::get('txtCodigoOficina');
				$tProductoTrasladoOficina->codigoOficinaLlegada=Input::get('txtCodigoOficinaDos');
				$tProductoTrasladoOficina->flete=Input::get('txtFlete');
				$tProductoTrasladoOficina->estado=true;
				$tProductoTrasladoOficina->motivoAnulacion='';

				$tProductoTrasladoOficina->save();

				$ultimoRegistroTProductoTrasladoOficina=TProductoTrasladoOficina::whereRaw('codigoProductoTrasladoOficina=(select max(codigoProductoTrasladoOficina) from TProductoTrasladoOficina)')->get();

				$listaProductos=explode('__SEPARADORREGISTRO__', Input::get('txtListaProductos'));

				$expresionNumero="/^[0-9]+([\.]{1}[0-9]*)?$/";
				$expresionEntero="/^[0-9]+$/";

				foreach($listaProductos as $key => $value)
				{
					$camposProducto=explode('__SEPARADORCAMPO__', $value);

					$tOficinaProducto=TOficinaProducto::find($camposProducto[0]);

					if($tOficinaProducto->cantidad<$camposProducto[11])
					{
						DB::rollback();

						$mensajeGlobal.='Cantidad del producto número '.($key+1).' de la lista insuficiente<br>';
						$txtHtmlListaProductosDevueltos=htmlspecialchars(Input::get('txtHtmlListaProductos'));

						return View::make('productotrasladooficina/insertar', Input::all(), ['color' => 'red', 'mensajeGlobal' => $mensajeGlobal, 'txtHtmlListaProductosDevueltos' => $txtHtmlListaProductosDevueltos]);
					}

					if($camposProducto[13]=='No' && !preg_match($expresionEntero, $camposProducto[11]))
					{
						$mensajeGlobal.='Cantidad del producto número '.($key+1).' Incorrecto. No se permite envío de este producto en decimales<br>';
						DB::rollback();
						$txtHtmlListaProductosDevueltos=htmlspecialchars(Input::get('txtHtmlListaProductos'));

						return View::make('productotrasladooficina/insertar', Input::all(), ['color' => 'red', 'mensajeGlobal' => $mensajeGlobal, 'txtHtmlListaProductosDevueltos' => $txtHtmlListaProductosDevueltos]);
					}

					if(!preg_match($expresionNumero, $camposProducto[11]) || !preg_match($expresionNumero, $camposProducto[12]) || $camposProducto[11]<=0)
					{
						DB::rollback();

						$mensajeGlobal.='Datos incorrectos en el producto número '.($key+1).' de la lista. Por favor corrija los datos<br>';
						$txtHtmlListaProductosDevueltos=htmlspecialchars(Input::get('txtHtmlListaProductos'));

						return View::make('productotrasladooficina/insertar', Input::all(), ['color' => 'red', 'mensajeGlobal' => $mensajeGlobal, 'txtHtmlListaProductosDevueltos' => $txtHtmlListaProductosDevueltos]);
					}

					$tProductoTrasladoOficinaDetalle=new TProductoTrasladoOficinaDetalle;
					
					$tProductoTrasladoOficinaDetalle->codigoProductoTrasladoOficina=$ultimoRegistroTProductoTrasladoOficina[0]->codigoProductoTrasladoOficina;
					$tProductoTrasladoOficinaDetalle->codigoOficinaProducto=$camposProducto[0];
					$tProductoTrasladoOficinaDetalle->codigoBarrasProducto=$camposProducto[1];
					$tProductoTrasladoOficinaDetalle->primerNombreProducto=$camposProducto[2];
					$tProductoTrasladoOficinaDetalle->segundoNombreProducto=$camposProducto[3];
					$tProductoTrasladoOficinaDetalle->tercerNombreProducto=$camposProducto[4];
					$tProductoTrasladoOficinaDetalle->descripcionProducto=$camposProducto[5];
					$tProductoTrasladoOficinaDetalle->tipoProducto=$camposProducto[6];
					$tProductoTrasladoOficinaDetalle->presentacionProducto=$camposProducto[7];
					$tProductoTrasladoOficinaDetalle->unidadMedidaProducto=$camposProducto[8];
					$tProductoTrasladoOficinaDetalle->categoriaProducto=$camposProducto[9];
					$tProductoTrasladoOficinaDetalle->cantidadProducto=$camposProducto[11];
					$tProductoTrasladoOficinaDetalle->ventaMenorUnidadProducto=$camposProducto[13]=='Si' ? true : false;
					$tProductoTrasladoOficinaDetalle->unidadesBloqueProducto=$camposProducto[16];
					$tProductoTrasladoOficinaDetalle->precioCompraUnitarioProducto=$camposProducto[14];
					$tProductoTrasladoOficinaDetalle->precioVentaUnitarioProducto=$camposProducto[15];
					$tProductoTrasladoOficinaDetalle->unidadMedidaBloqueProducto=$camposProducto[17];
					$tProductoTrasladoOficinaDetalle->fechaVencimientoProducto=$camposProducto[18];

					$tProductoTrasladoOficinaDetalle->save();
				}

				DB::commit();

				return Redirect::to('productotrasladooficina/insertar')->with('mensajeRedirect', 'Operación ralizada correctamente');
			}
			catch(Exception $ex)
			{
				DB::rollback();

				$txtHtmlListaProductosDevueltos=htmlspecialchars(Input::get('txtHtmlListaProductos'));

				return View::make('productotrasladooficina/insertar', Input::all(), ['color' => 'red', 'mensajeGlobal' => $ex, 'txtHtmlListaProductosDevueltos' => $txtHtmlListaProductosDevueltos]);
			}
		}

		if(Session::has('mensajeRedirect'))
		{
			return View::make('productotrasladooficina/insertar', ['color' => '#1497CC', 'mensajeGlobal' => Session::get('mensajeRedirect')]);
		}
		
		return View::make('productotrasladooficina/insertar');
	}

	public function actionVerEntreFechas($fechaInicial=null, $fechaFinal=null)
	{
		$listaTProductoTrasladoOficina=TProductoTrasladoOficina::with('tOficina', 'tOficinaLlegada')->whereRaw('created_at between ? and ? order by created_at desc', [$fechaInicial, $fechaFinal])->get();

		if(Session::has('mensajeRedirect'))
		{
			return View::make('productotrasladooficina/verentrefechas', ['color' => '#1497CC', 'mensajeGlobal' => Session::get('mensajeRedirect'), 'listaTProductoTrasladoOficina' => $listaTProductoTrasladoOficina, 'fechaInicial' => $fechaInicial, 'fechaFinal' => $fechaFinal]);
		}

		if(Session::has('mensajeRedirectError'))
		{
			return View::make('productotrasladooficina/verentrefechas', ['color' => 'red', 'mensajeGlobal' => Session::get('mensajeRedirectError'), 'listaTProductoTrasladoOficina' => $listaTProductoTrasladoOficina, 'fechaInicial' => $fechaInicial, 'fechaFinal' => $fechaFinal]);
		}

		return View::make('productotrasladooficina/verentrefechas', ['listaTProductoTrasladoOficina' => $listaTProductoTrasladoOficina, 'fechaInicial' => $fechaInicial, 'fechaFinal' => $fechaFinal]);
	}

	public function actionAnular()
	{
		if(Input::has('txtCodigoProductoTrasladoOficina'))
		{
			try
			{
				DB::beginTransaction();

				$tProductoTrasladoOficina=TProductoTrasladoOficina::find(Input::get('txtCodigoProductoTrasladoOficina'));
				
				$tProductoTrasladoOficina->estado=false;
				$tProductoTrasladoOficina->motivoAnulacion=Input::get('txtMotivoAnulacion');

				$tProductoTrasladoOficina->save();

				$listaTProductoTrasladoOficinaDetalle=TProductoTrasladoOficinaDetalle::whereRaw('codigoProductoTrasladoOficina=?', [Input::get('txtCodigoProductoTrasladoOficina')])->get();

				foreach($listaTProductoTrasladoOficinaDetalle as $key => $value)
				{
					$tOficinaProducto=TOficinaProducto::whereRaw('codigoOficina=? and presentacion=? and unidadMedida=? and codigoBarras=? and primerNombre=? and segundoNombre=? and tercerNombre=? and tipo=?', [$tProductoTrasladoOficina->codigoOficinaLlegada, $value->presentacionProducto, $value->unidadMedidaProducto, $value->codigoBarrasProducto, $value->primerNombreProducto, $value->segundoNombreProducto, $value->tercerNombreProducto, $value->tipoProducto])->get();

					if(count($tOficinaProducto)>0)
					{
						$cantidadAnterior=$tOficinaProducto[0]->cantidad;

						if(($cantidadAnterior-($value->cantidadProducto))<0)
						{
							DB::rollback();

							return Redirect::to('/productotrasladooficina/verentrefechas/'.date('Y-m-d').'/'.date('Y-m-d', strtotime(date('Y-m-d').' +1 day')))->with('mensajeRedirectError', 'No se puede anular el traslado porque ya no existe la cantidad necesaria de productos en la oficina');
						}

						$tOficinaProducto[0]->cantidad=$cantidadAnterior-($value->cantidadProducto);

						$tOficinaProducto[0]->save();
					}
					else
					{
						DB::rollback();

						return Redirect::to('/productotrasladooficina/verentrefechas/'.date('Y-m-d').'/'.date('Y-m-d', strtotime(date('Y-m-d').' +1 day')))->with('mensajeRedirectError', 'No se puede anular el traslado porque no se encontró productos de dicho traslado en la oficina');
					}

					$tOficinaProducto=TOficinaProducto::whereRaw('codigoOficina=? and presentacion=? and unidadMedida=? and codigoBarras=? and primerNombre=? and segundoNombre=? and tercerNombre=? and tipo=?', [$tProductoTrasladoOficina->codigoOficina, $value->presentacionProducto, $value->unidadMedidaProducto, $value->codigoBarrasProducto, $value->primerNombreProducto, $value->segundoNombreProducto, $value->tercerNombreProducto, $value->tipoProducto])->get();

					$cantidadAnterior=$tOficinaProducto[0]->cantidad;

					$tOficinaProducto[0]->cantidad=$cantidadAnterior+($value->cantidadProducto);

					$tOficinaProducto[0]->save();
				}

				DB::commit();

				return Redirect::to('/productotrasladooficina/verentrefechas/'.date('Y-m-d').'/'.date('Y-m-d', strtotime(date('Y-m-d').' +1 day')))->with('mensajeRedirect', 'Operación realizada correctamente');
			}
			catch(Exception $ex)
			{
				DB::rollback();

				return Redirect::to('/productotrasladooficina/verentrefechas/'.date('Y-m-d').'/'.date('Y-m-d', strtotime(date('Y-m-d').' +1 day')))->with('mensajeRedirectError', 'Error inesperado, por favor contacte con el administrador del sistema');
			}
		}

		$tProductoTrasladoOficina=TProductoTrasladoOficina::find(Input::get('codigo'));

		return View::make('productotrasladooficina/anular', ['tProductoTrasladoOficina' => $tProductoTrasladoOficina]);
	}
}
?>