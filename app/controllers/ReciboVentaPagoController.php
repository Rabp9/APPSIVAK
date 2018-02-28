<?php
class ReciboVentaPagoController extends BaseController
{
	public function actionInsertar()
	{
		if(Input::has('txtCodigoReciboVenta'))
		{
			try
			{
				DB::beginTransaction();

				$tReciboVenta=TReciboVenta::find(Input::get('txtCodigoReciboVenta'));

				$listaTReciboVentaLetra=TReciboVentaLetra::whereRaw('codigoReciboVenta=? and estado=?', [Input::get('txtCodigoReciboVenta'), false])->get();

				$porPagarTotal=0;

				foreach($listaTReciboVentaLetra as $key => $value)
				{
                    $porPagarTotal+=$value->porPagar;
				}

				if(number_format($porPagarTotal, 2, '.', '')<number_format(Input::get('txtMonto'), 2, '.', ''))
				{
					DB::rollback();

					return Redirect::to('reciboventa/verportipopago')->with('mensajeRedirectError', 'El monto que ingresó para el pago excede la deuda');
				}

				$montoTemporal=Input::get('txtMonto');

				$tReciboVentaPago=new TReciboVentaPago;

				$tReciboVentaPago->codigoReciboVenta=Input::get('txtCodigoReciboVenta');
				$tReciboVentaPago->monto=$montoTemporal;
				$tReciboVentaPago->descripcion=Input::get('txtDescripcion');

				$tReciboVentaPago->save();

				foreach($listaTReciboVentaLetra as $key => $value)
				{
					$diasRetrasados=(((strtotime(date('Y-m-d'))-strtotime($value->fechaPagar))/86400)<0 ? '0' : ((strtotime(date('Y-m-d'))-strtotime($value->fechaPagar))/86400));

                    $porPagar=$value->porPagar;

                    $porPagar=$porPagar-$montoTemporal;

                    $montoTemporal=$porPagar<0 ? abs($porPagar) : 0;

					$porPagar=$porPagar<0 ? 0 : $porPagar;

					if($montoTemporal>0)
					{
						$value->pagado=($value->pagado)+($value->porPagar);
					}
					else
					{
						$value->pagado=($value->pagado)+(($value->porPagar)-$porPagar);
					}

                    $value->porPagar=$porPagar;
                    $value->diasMora=$diasRetrasados;

                    if(number_format($porPagar, 2, '.', '')==0.00)
                    {
                    	$value->estado=true;
                    }

                    $value->save();

                    if($montoTemporal==0)
                    {
                    	break;
                    }
				}

				if(TReciboVentaLetra::whereRaw('codigoReciboVenta=? and estado=?', [Input::get('txtCodigoReciboVenta'), false])->count()==0)
				{

					$tReciboVenta->estadoCredito=true;

					$tReciboVenta->save();
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
					$tDetalleCaja[0]->saldoFinal=($tDetalleCaja[0]->saldoFinal)+$montoParaCaja;
					$tDetalleCaja[0]->ingresos=($tDetalleCaja[0]->ingresos)+$montoParaCaja;

					$tDetalleCaja[0]->save();
				}
				else
				{
					DB::rollback();

					return Redirect::to('reciboventa/verportipopago')->with('mensajeRedirectError', 'Caja no disponible');
				}

				$tReciboVentaPago=TReciboVentaPago::whereRaw('codigoReciboVentaPago=(select max(codigoReciboVentaPago) from TReciboVentaPago)')->get();

				DB::commit();

				Session::flash('codigoReciboVentaPago', $tReciboVentaPago[0]->codigoReciboVentaPago);

				return Redirect::to('reciboventa/verportipopago')->with('mensajeRedirect', 'Operación realizada correctamente');
			}
			catch(Exception $ex)
			{
				DB::rollback();

				return Redirect::to('reciboventa/verportipopago')->with('mensajeRedirectError', 'Ocurrió un error inesperado. Por favor contacte con el administrador del sistema');
			}
		}

		$tReciboVenta=TReciboVenta::find(Input::get('codigo'));

		$fechaActual=date('Y-m-d');
		
		$tCaja=TCaja::whereRaw('mid(created_at, 1, 10)=?', [$fechaActual])->get();

		if(count($tCaja)>0)
		{
			$tDetalleCaja=TCajaDetalle::whereRaw('codigoCaja=? and codigoPersonal=? and mid(created_at, 1, 10)=?', [$tCaja[0]->codigoCaja, substr(Session::get('usuario'), 0, 15), date('Y-m-d')])->get();
		}

		$cajaAbierta=(isset($tDetalleCaja) && count($tDetalleCaja)>0) ? 1 : 0;
		$cajaAbierta=($cajaAbierta && isset($tDetalleCaja) && $tDetalleCaja[0]->cerrado) ? 2 : $cajaAbierta;

		return View::make('reciboventapago.insertar', ['cajaAbierta' => $cajaAbierta, 'tReciboVenta' => $tReciboVenta]);
	}

	public function actionVerPorCodigoReciboVenta()
	{
		$listaTReciboVentaPago=TReciboVentaPago::whereRaw('codigoReciboVenta=?', [Input::get('codigo')])->get();

		return View::make('reciboventapago/verporcodigoreciboventa', ['listaTReciboVentaPago' => $listaTReciboVentaPago]);
	}
}
?>