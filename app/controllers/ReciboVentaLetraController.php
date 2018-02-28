<?php
class ReciboVentaLetraController extends BaseController
{
	public function actionVerPorCodigoReciboVenta()
	{
		$listaTReciboVentaLetra=TReciboVentaLetra::whereRaw('codigoReciboVenta=?', [Input::get('codigo')])->get();
		$tReciboVenta=TReciboVenta::find($listaTReciboVentaLetra[0]->codigoReciboVenta);
		return View::make('reciboventaletra.verporcodigoreciboventa', ['listaTReciboVentaLetra' => $listaTReciboVentaLetra, 'tReciboVenta' => $tReciboVenta]);
	}

	public function actionPagarLetra()
	{
		if(Input::get('txtCodigoReciboVentaLetra'))
		{
			try
			{
				DB::beginTransaction();

				$tReciboVentaLetra=TReciboVentaLetra::find(Input::get('txtCodigoReciboVentaLetra'));

				if($tReciboVentaLetra->estado)
				{
					DB::rollback();
					
					return Redirect::to('reciboventa/verportipopago')->with('mensajeRedirectError', 'Alguien más acaba de pagar esta letra');
				}

				$diasRetrasados=((strtotime(date('Y-m-d'))-strtotime($tReciboVentaLetra->fechaPagar))/86400)<0 ? '0' : ((strtotime(date('Y-m-d'))-strtotime($tReciboVentaLetra->fechaPagar))/86400);

				$tReciboVenta=TReciboVenta::find($tReciboVentaLetra->codigoReciboVenta);

				$montoParaCaja=$tReciboVentaLetra->porPagar;

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
					
					return Redirect::to('reciboventa/verportipopago')->with('mensajeRedirectError', 'Caja no disponible');
				}

				$tReciboVentaLetra->pagado=$tReciboVentaLetra->pagado+$montoParaCaja;
				$tReciboVentaLetra->porPagar=0;
				$tReciboVentaLetra->diasMora=$diasRetrasados;
				$tReciboVentaLetra->estado=true;

				$tReciboVentaLetra->save();

				$tReciboVentaPago=new TReciboVentaPago;

				$tReciboVentaPago->codigoReciboVenta=$tReciboVenta->codigoReciboVenta;
				$tReciboVentaPago->monto=$montoParaCaja;
				$tReciboVentaPago->descripcion=Input::get('txtDescripcionReciboVentaPago');

				$tReciboVentaPago->save();

				if(TReciboVentaLetra::whereRaw('codigoReciboVenta=? and estado=?', [$tReciboVentaLetra->codigoReciboVenta, false])->count()==0)
				{
					$tReciboVenta=TReciboVenta::find($tReciboVentaLetra->codigoReciboVenta);

					$tReciboVenta->estadoCredito=true;

					$tReciboVenta->save();
				}

				$tReciboVentaPago=TReciboVentaPago::whereRaw('codigoReciboVentaPago=(select max(codigoReciboVentaPago) from TReciboVentaPago)')->get();

				DB::commit();

				Session::flash('codigoReciboVentaPago', $tReciboVentaPago[0]->codigoReciboVentaPago);

				return Redirect::to('reciboventa/verportipopago')->with('mensajeRedirect', 'Operación realizada correctamente');
			}
			catch(Exception $ex)
			{
				DB::rollback();

				return Redirect::to('reciboventa/verportipopago')->with('mensajeRedirectError', 'Ocurrió un error inesperado. Por favor contacto con el administrador del sistema');
			}
		}

		$tReciboVentaLetra=TReciboVentaLetra::find(Input::get('codigo'));
		
		$fechaActual=date('Y-m-d');
		
		$tCaja=TCaja::whereRaw('mid(created_at, 1, 10)=?', [$fechaActual])->get();

		if(count($tCaja)>0)
		{
			$tDetalleCaja=TCajaDetalle::whereRaw('codigoCaja=? and codigoPersonal=? and mid(created_at, 1, 10)=?', [$tCaja[0]->codigoCaja, substr(Session::get('usuario'), 0, 15), date('Y-m-d')])->get();
		}

		$cajaAbierta=(isset($tDetalleCaja) && count($tDetalleCaja)>0) ? 1 : 0;
		$cajaAbierta=($cajaAbierta && isset($tDetalleCaja) && $tDetalleCaja[0]->cerrado) ? 2 : $cajaAbierta;

		return View::make('reciboventaletra.pagarletra', ['tReciboVentaLetra' => $tReciboVentaLetra, 'cajaAbierta' => $cajaAbierta]);
	}
}
?>