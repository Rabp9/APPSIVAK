<?php
class EgresoController extends BaseController
{
	public function actionInsertar()
	{
		if($_POST)
		{
			try
			{
				DB::beginTransaction();

				$tEgreso=new TEgreso;

				$tEgreso->codigoOficina=(Session::get('localAcceso')=='Oficina') ? substr(Session::get('local'), 0, 15) : '';
				$tEgreso->codigoPersonal=substr(Session::get('usuario'), 0, 15);
				$tEgreso->descripcion=Input::get('txtDescripcion');
				$tEgreso->monto=Input::get('txtMonto');
				
				$tEgreso->save();

				$montoParaCaja=Input::get('txtMonto');

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

						return View::make('egreso/insertar', Input::all(), ['color' => 'red', 'mensajeGlobal' => 'El dinero en caja no es suficiente', 'cajaAbierta' => $cajaAbierta]);
					}

					$tDetalleCaja[0]->saldoFinal=($tDetalleCaja[0]->saldoFinal)-$montoParaCaja;
					$tDetalleCaja[0]->egresos=($tDetalleCaja[0]->egresos)+$montoParaCaja;

					$tDetalleCaja[0]->save();
				}
				else
				{
					DB::rollback();

					return Redirect::to('egreso/insertar')->with('mensajeRedirectError', 'No se puede realizar operaciones en caja');
				}

				DB::commit();

				return Redirect::to('egreso/insertar')->with('mensajeRedirect', 'Operación realizada correctamente');
			}
			catch(Exception $ex)
			{
				DB::rollback();

				$fechaActual=date('Y-m-d');

				$tCaja=TCaja::whereRaw('mid(created_at, 1, 10)=?', [$fechaActual])->get();

				if(count($tCaja)>0)
				{
					$tDetalleCaja=TCajaDetalle::whereRaw('codigoCaja=? and codigoPersonal=? and mid(created_at, 1, 10)=?', [$tCaja[0]->codigoCaja, substr(Session::get('usuario'), 0, 15), date('Y-m-d')])->get();
				}

				$cajaAbierta=(isset($tDetalleCaja) && count($tDetalleCaja)>0) ? 1 : 0;
				$cajaAbierta=($cajaAbierta && isset($tDetalleCaja) && $tDetalleCaja[0]->cerrado) ? 2 : $cajaAbierta;

				return View::make('egreso/insertar', Input::all(), ['color' => 'red', 'mensajeGlobal' => 'Error inserperado. Por favor contacte con el administrador del sistema', 'cajaAbierta' => $cajaAbierta]);
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

		if(Session::has('mensajeRedirect'))
		{
			return View::make('egreso/insertar', ['color' => '#1497CC', 'mensajeGlobal' => Session::get('mensajeRedirect'), 'cajaAbierta' => $cajaAbierta]);
		}

		if(Session::has('mensajeRedirectError'))
		{
			return View::make('egreso/insertar', ['color' => 'red', 'mensajeGlobal' => Session::get('mensajeRedirectError'), 'cajaAbierta' => $cajaAbierta]);
		}

		return View::make('egreso/insertar', ['cajaAbierta' => $cajaAbierta]);
	}

	public function actionVerEntreFechas($fechaInicial=null, $fechaFinal=null)
	{
		$listaTEgreso=TEgreso::with('TOficina', 'TAlmacen', 'TPersonal')->whereRaw('created_at between ? and ? order by created_at desc', [$fechaInicial, $fechaFinal])->get();

		if(Session::has('mensajeRedirect'))
		{
			return View::make('egreso/verentrefechas', ['color' => '#1497CC', 'mensajeGlobal' => Session::get('mensajeRedirect'), 'listaTEgreso' => $listaTEgreso, 'fechaInicial' => $fechaInicial, 'fechaFinal' => $fechaFinal]);
		}

		if(Session::has('mensajeRedirectError'))
		{
			return View::make('egreso/verentrefechas', ['color' => 'red', 'mensajeGlobal' => Session::get('mensajeRedirectError'), 'listaTEgreso' => $listaTEgreso, 'fechaInicial' => $fechaInicial, 'fechaFinal' => $fechaFinal]);
		}

		return View::make('egreso/verentrefechas', ['listaTEgreso' => $listaTEgreso, 'fechaInicial' => $fechaInicial, 'fechaFinal' => $fechaFinal]);
	}
}
?>