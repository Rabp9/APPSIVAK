<?php
class CajaDetalleController extends BaseController
{
	public function actionInsertar()
	{
		if($_POST)
		{
			$fechaActual=date('Y-m-d');

			$tCaja=TCaja::whereRaw('mid(created_at, 1, 10)=?', [$fechaActual])->get();

			if(TCajaDetalle::whereRaw('codigoCaja=? and codigoPersonal=?', [$tCaja[0]->codigoCaja, Input::get('txtCodigoPersonal')])->count()>0)
			{
				return View::make('cajadetalle/insertar', Input::all(), ['color' => 'red', 'mensajeGlobal' => 'Ya fue asignado una caja a este usuario']);
			}

			$tCajaDetalle=new TCajaDetalle;

			$tCajaDetalle->codigoCaja=$tCaja[0]->codigoCaja;
			$tCajaDetalle->codigoPersonal=Input::get('txtCodigoPersonal');
			$tCajaDetalle->saldoInicial=Input::get('txtSaldoInicial');
			$tCajaDetalle->saldoFinal=Input::get('txtSaldoInicial');
			$tCajaDetalle->descripcion='';
			$tCajaDetalle->cerrado=false;

			$tCajaDetalle->save();

			return View::make('cajadetalle/insertar', ['color' => '#1497CC', 'mensajeGlobal' => 'Operación realizada correctamente']);
		}

		return View::make('cajadetalle/insertar');
	}

	public function actionVerPorCodigoCaja()
	{
		$listaTCajaDetalle=TCajaDetalle::whereRaw('codigoCaja=?', [Input::get('codigo')])->get();

		return View::make('cajadetalle/verporcodigocaja', ['listaTCajaDetalle' => $listaTCajaDetalle]);
	}

	public function actionIncrementarSaldoInicial()
	{
		if(Input::get('txtCodigoCajaDetalle'))
		{
			try
			{
				DB::beginTransaction();

				$tCajaDetalle=TCajaDetalle::find(Input::get('txtCodigoCajaDetalle'));
				
				$tCajaDetalle->saldoInicial=($tCajaDetalle->saldoInicial)+Input::get('txtMontoIncrementoSaldoInicial');
				$tCajaDetalle->saldoFinal=($tCajaDetalle->saldoFinal)+Input::get('txtMontoIncrementoSaldoInicial');

				$tCajaDetalle->save();

				$fechaActual=date('Y-m-d');
				
				$tCaja=TCaja::whereRaw('mid(created_at, 1, 10)=?', [$fechaActual])->get();

				if(count($tCaja)>0)
				{
					$tDetalleCaja=TCajaDetalle::whereRaw('codigoCaja=? and codigoPersonal=? and mid(created_at, 1, 10)=?', [$tCaja[0]->codigoCaja, substr(Session::get('usuario'), 0, 15), date('Y-m-d')])->get();
				}

				$cajaAbierta=(isset($tDetalleCaja) && count($tDetalleCaja)>0) ? 1 : 0;
				$cajaAbierta=($cajaAbierta && isset($tDetalleCaja) && $tDetalleCaja[0]->cerrado) ? 2 : $cajaAbierta;

				if($cajaAbierta!=1)
				{
					DB::rollback();
					
					return Redirect::to('caja/ver')->with('mensajeRedirectError', 'Caja no disponible');
				}

				DB::commit();

				return Redirect::to('/caja/ver/')->with('mensajeRedirect', 'Incremento del saldo inicial realizado correctamente');
			}
			catch(Exception $ex)
			{
				DB::rollback();

				return Redirect::to('/caja/ver')->with('mensajeRedirectError', 'Ocurrió un error inesperado. Por favor contacte con el administrador del sistema');
			}
		}

		$fechaActual=date('Y-m-d');
		
		$tCaja=TCaja::whereRaw('mid(created_at, 1, 10)=?', [$fechaActual])->get();

		if(count($tCaja)>0)
		{
			$tDetalleCaja=TCajaDetalle::whereRaw('codigoCaja=? and codigoPersonal=? and mid(created_at, 1, 10)=?', [$tCaja[0]->codigoCaja, substr(Session::get('usuario'), 0, 15), date('Y-m-d')])->get();
		}

		$cajaAbierta=(isset($tDetalleCaja) && count($tDetalleCaja)>0) ? 1 : 0;
		$cajaAbierta=($cajaAbierta && isset($tDetalleCaja) && $tDetalleCaja[0]->cerrado) ? 2 : $cajaAbierta;

		$tCajaDetalle=TCajaDetalle::find(Input::get('codigo'));

		return View::make('cajadetalle/incrementarsaldoinicial', ['tCajaDetalle' => $tCajaDetalle, 'cajaAbierta' => $cajaAbierta]);
	}

	public function actionCerrar()
	{
		if(Input::get('txtCodigoCajaDetalle'))
		{
			try
			{
				DB::beginTransaction();

				TCajaDetalle::where('codigoCajaDetalle', '=', Input::get('txtCodigoCajaDetalle'))->update(array
				(
					'descripcion' => Input::get('txtDescripcion'),
					'cerrado' => true
				));

				DB::commit();

				return Redirect::to('/caja/ver/')->with('mensajeRedirect', 'Operación realizada correctamente');
			}
			catch(Exception $ex)
			{
				DB::rollback();

				return Redirect::to('/caja/ver')->with('mensajeRedirectError', 'Ocurrió un error inesperado. Por favor contacte con el administrador del sistema');
			}
		}

		$tCajaDetalle=TCajaDetalle::find(Input::get('codigo'));

		return View::make('cajadetalle/cerrar', ['tCajaDetalle' => $tCajaDetalle]);
	}

	public function actionReabrir($codigoCajaDetalle)
	{
		try
		{
			DB::beginTransaction();

			TCajaDetalle::where('codigoCajaDetalle', '=', $codigoCajaDetalle)->update(array
			(
				'cerrado' => false
			));

			DB::commit();

			return Redirect::to('/caja/ver/')->with('mensajeRedirect', 'Caja reabierta correctamente');
		}
		catch(Exception $ex)
		{
			DB::rollback();

			return Redirect::to('/caja/ver')->with('mensajeRedirectError', 'Ocurrió un error inesperado. Por favor contacte con el administrador del sistema');
		}
	}
}
?>