<?php
class AlmacenProductoRetiroController extends BaseController
{
	public function actionInsertar()
	{
		if($_POST)
		{
			try
			{
				DB::beginTransaction();

				$mensajeGlobal='';

				$tAlmacenProducto=TAlmacenProducto::find(Input::get('txtCodigoAlmacenProducto'));

				if(($tAlmacenProducto->cantidad)<Input::get('txtCantidadUnidad'))
				{
					DB::rollback();

					$mensajeGlobal.='La cantidad que desea retirar supera a la cantidad actual disponible<br>';

					return View::make('almacenproductoretiro/insertar', Input::all(), ['color' => 'red', 'mensajeGlobal' => $mensajeGlobal]);
				}

				$tAlmacenProducto->cantidad=($tAlmacenProducto->cantidad)-Input::get('txtCantidadUnidad');

				$tAlmacenProducto->save();

				$tPresentacion=TPresentacion::find(Input::get('txtCodigoPresentacionProducto'));
				$tUnidadMedida=TUnidadMedida::find(Input::get('txtCodigoUnidadMedidaProducto'));

				$tAlmacenProductoRetiro=new TAlmacenProductoRetiro;

				$tAlmacenProductoRetiro->codigoAlmacenProducto=Input::get('txtCodigoAlmacenProducto');
				$tAlmacenProductoRetiro->codigoAlmacen=Input::get('txtCodigoAlmacen');
				$tAlmacenProductoRetiro->descripcionAlmacen=Input::get('txtDescripcionAlmacen');
				$tAlmacenProductoRetiro->presentacionProducto=$tPresentacion->nombre;
				$tAlmacenProductoRetiro->unidadMedidaProducto=$tUnidadMedida->nombre;
				$tAlmacenProductoRetiro->nombreCompletoProducto=Input::get('txtNombreCompletoProducto');
				$tAlmacenProductoRetiro->tipoProducto=Input::get('txtTipoProducto');
				$tAlmacenProductoRetiro->precioCompraUnitarioProducto=Input::get('txtPrecioCompraUnitarioProducto');
				$tAlmacenProductoRetiro->precioVentaUnitarioProducto=Input::get('txtPrecioVentaUnitarioProducto');
				$tAlmacenProductoRetiro->fechaVencimientoProducto=Input::get('txtFechaVencimientoProducto');
				$tAlmacenProductoRetiro->cantidadUnidad=Input::get('txtCantidadUnidad');
				$tAlmacenProductoRetiro->descripcion=Input::get('txtDescripcion');
				$tAlmacenProductoRetiro->montoPerdido=Input::get('txtMontoPerdido');

				$tAlmacenProductoRetiro->save();

				DB::commit();

				return Redirect::to('almacenproductoretiro/insertar')->with('mensajeRedirect', 'El retiro del producto fue realizado correctamente');
			}
			catch(Exception $ex)
			{
				DB::rollback();

				return View::make('almacenproductoretiro/insertar', Input::all(), ['color' => 'red', 'mensajeGlobal' => 'Error inserperado. Por favor contacte con el administrador del sistema']);
			}
		}

		if(Session::has('mensajeRedirect'))
		{
			return View::make('almacenproductoretiro/insertar', ['color' => '#1497CC', 'mensajeGlobal' => Session::get('mensajeRedirect')]);
		}

		if(Session::has('mensajeRedirectError'))
		{
			return View::make('almacenproductoretiro/insertar', ['color' => 'red', 'mensajeGlobal' => Session::get('mensajeRedirectError')]);
		}

		return View::make('almacenproductoretiro/insertar');
	}

	public function actionVerPorCodigoAlmacen()
	{
		$listaTAlmacenProductoRetiro=TAlmacenProductoRetiro::whereRaw('codigoAlmacen=? order by created_at desc', [explode(',', Session::get('local'))[0]])->get();
		
		return View::make('almacenproductoretiro/verporcodigoalmacen', ['listaTAlmacenProductoRetiro' => $listaTAlmacenProductoRetiro]);
	}
}
?>