<?php
class ReciboCompraPagoController extends BaseController
{
	public function actionInsertar()
	{
		if(Input::has('txtCodigoReciboCompra'))
		{
			try
			{
				DB::beginTransaction();

				$tReciboCompra=TReciboCompra::find(Input::get('txtCodigoReciboCompra'));

				$tReciboCompraPago=DB::table('TReciboCompraPago')
					->select(DB::raw('sum(monto) as sumaPagos'))
					->where('codigoReciboCompra', '=', Input::get('txtCodigoReciboCompra'))
					->get();

				$porPagar=($tReciboCompra->total)-(($tReciboCompraPago==null) ? 0 : $tReciboCompraPago[0]->sumaPagos);

				if(number_format($porPagar, 2, '.', '')<number_format(Input::get('txtMonto'), 2, '.', ''))
				{
					DB::rollback();

					return Redirect::to('recibocompra/verportipopago')->with('mensajeRedirectError', 'El monto que ingresó para el pago excede la deuda');
				}

				$tReciboCompraPago=new TReciboCompraPago;

				$tReciboCompraPago->codigoReciboCompra=Input::get('txtCodigoReciboCompra');
				$tReciboCompraPago->monto=Input::get('txtMonto');
				$tReciboCompraPago->descripcion=Input::get('txtDescripcion');

				$tReciboCompraPago->save();

				$tReciboCompraPago=DB::table('TReciboCompraPago')
					->select(DB::raw('sum(monto) as sumaPagos'))
					->where('codigoReciboCompra', '=', Input::get('txtCodigoReciboCompra'))
					->get();
				
				$porPagar=($tReciboCompra->total)-(($tReciboCompraPago==null) ? 0 : $tReciboCompraPago[0]->sumaPagos);

				if(number_format($porPagar, 2, '.', '')==0.00)
				{
					$tReciboCompra->estadoCredito=true;

					$tReciboCompra->save();
				}

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
						
						return Redirect::to('recibocompra/verportipopago')->with('mensajeRedirectError', 'El dinero en caja no es suficiente');
					}

					$tDetalleCaja[0]->saldoFinal=($tDetalleCaja[0]->saldoFinal)-$montoParaCaja;
					$tDetalleCaja[0]->egresos=($tDetalleCaja[0]->egresos)+$montoParaCaja;

					$tDetalleCaja[0]->save();
				}
				else
				{
					DB::rollback();

					return Redirect::to('recibocompra/verportipopago')->with('mensajeRedirectError', 'Caja no disponible');
				}

				DB::commit();

				return Redirect::to('recibocompra/verportipopago')->with('mensajeRedirect', 'Operación realizada correctamente');
			}
			catch(Exception $ex)
			{
				DB::rollback();

				return Redirect::to('recibocompra/verportipopago')->with('mensajeRedirectError', 'Ocurrió un error inesperado. Por favor contacte con el administrador del sistema');
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

		return View::make('recibocomprapago/insertar', ['cajaAbierta' => $cajaAbierta, 'tReciboCompra' => $tReciboCompra]);
	}

	public function actionVerPorCodigoReciboCompra()
	{
		$listaTReciboCompraPago=TReciboCompraPago::whereRaw('codigoReciboCompra=?', [Input::get('codigo')])->get();
		$tReciboCompra=TReciboCompra::find(Input::get('codigo'));

		return View::make('recibocomprapago/verporcodigorecibocompra', ['listaTReciboCompraPago' => $listaTReciboCompraPago, 'tReciboCompra' => $tReciboCompra]);
	}
}
?>