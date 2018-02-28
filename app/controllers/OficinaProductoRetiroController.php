<?php
class OficinaProductoRetiroController extends BaseController
{
	public function actionInsertar()
	{
		if($_POST)
		{
			try
			{
				DB::beginTransaction();

				$mensajeGlobal='';

				$tOficinaProducto=TOficinaProducto::find(Input::get('txtCodigoOficinaProducto'));

				if(($tOficinaProducto->cantidad)<Input::get('txtCantidadUnidad'))
				{
					DB::rollback();

					$mensajeGlobal.='La cantidad que desea retirar supera a la cantidad actual disponible<br>';

					return View::make('oficinaproductoretiro/insertar', Input::all(), ['color' => 'red', 'mensajeGlobal' => $mensajeGlobal]);
				}

				$tOficinaProducto->cantidad=($tOficinaProducto->cantidad)-Input::get('txtCantidadUnidad');

				$tOficinaProducto->save();

				$tOficinaProductoRetiro=new TOficinaProductoRetiro;

				$tOficinaProductoRetiro->codigoOficinaProducto=Input::get('txtCodigoOficinaProducto');
				$tOficinaProductoRetiro->codigoOficina=Input::get('txtCodigoOficina');
				$tOficinaProductoRetiro->descripcionOficina=Input::get('txtDescripcionOficina');
				$tOficinaProductoRetiro->presentacionProducto=Input::get('txtPresentacionProducto');
				$tOficinaProductoRetiro->unidadMedidaProducto=Input::get('txtUnidadMedidaProducto');
				$tOficinaProductoRetiro->nombreCompletoProducto=Input::get('txtNombreCompletoProducto');
				$tOficinaProductoRetiro->tipoProducto=Input::get('txtTipoProducto');
				$tOficinaProductoRetiro->precioCompraUnitarioProducto=Input::get('txtPrecioCompraUnitarioProducto');
				$tOficinaProductoRetiro->precioVentaUnitarioProducto=Input::get('txtPrecioVentaUnitarioProducto');
				$tOficinaProductoRetiro->fechaVencimientoProducto=Input::get('txtFechaVencimientoProducto');
				$tOficinaProductoRetiro->cantidadUnidad=Input::get('txtCantidadUnidad');
				$tOficinaProductoRetiro->descripcion=Input::get('txtDescripcion');
				$tOficinaProductoRetiro->montoPerdido=Input::get('txtMontoPerdido');

				$tOficinaProductoRetiro->save();

				DB::commit();

				return Redirect::to('oficinaproductoretiro/insertar')->with('mensajeRedirect', 'El retiro del producto fue realizado correctamente');
			}
			catch(Exception $ex)
			{
				DB::rollback();

				return View::make('oficinaproductoretiro/insertar', Input::all(), ['color' => 'red', 'mensajeGlobal' => 'Error inserperado. Por favor contacte con el administrador del sistema']);
			}
		}

		if(Session::has('mensajeRedirect'))
		{
			return View::make('oficinaproductoretiro/insertar', ['color' => '#1497CC', 'mensajeGlobal' => Session::get('mensajeRedirect')]);
		}

		if(Session::has('mensajeRedirectError'))
		{
			return View::make('oficinaproductoretiro/insertar', ['color' => 'red', 'mensajeGlobal' => Session::get('mensajeRedirectError')]);
		}

		return View::make('oficinaproductoretiro/insertar');
	}

	public function actionVerPorCodigoOficina()
	{
		$listaTOficinaProductoRetiro=TOficinaProductoRetiro::whereRaw('codigoOficina=? order by created_at desc', [explode(',', Session::get('local'))[0]])->get();
		
		return View::make('oficinaproductoretiro/verporcodigooficina', ['listaTOficinaProductoRetiro' => $listaTOficinaProductoRetiro]);
	}
}
?>