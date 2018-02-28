<?php
class ReciboVentaController extends BaseController
{
	public function actionInsertar()
	{
		if($_POST)
		{
			try
			{
				DB::beginTransaction();

				$mensajeGlobal='';

				$nombreCompletoCliente='';
				$documentoCliente='';
				$direccionCliente='';

				if(Session::get('localAcceso')!='Oficina')
				{
					DB::rollback();

					return Redirect::to('reciboventa/insertar')->with('mensajeRedirectError', 'No se pudo realizar la venta. Para realizar ventas Ud. debe estar logueado en una oficina.');
				}

				$montoParaCaja=Input::get('txtTotal');

				$fechaActual=date('Y-m-d');
				
				$tCaja=TCaja::whereRaw('mid(created_at, 1, 10)=?', [$fechaActual])->get();

				if(count($tCaja)>0)
				{
					$tDetalleCaja=TCajaDetalle::whereRaw('codigoCaja=? and codigoPersonal=? and mid(created_at, 1, 10)=?', [$tCaja[0]->codigoCaja, substr(Session::get('usuario'), 0, 15), date('Y-m-d')])->get();
				}

				$cajaAbierta=(isset($tDetalleCaja) && count($tDetalleCaja)>0) ? 1 : 0;
				$cajaAbierta=($cajaAbierta && isset($tDetalleCaja) && $tDetalleCaja[0]->cerrado) ? 2 : $cajaAbierta;

				if(Input::get('cbxTipoRecibo')!='Factura')
				{
					$nombreCompletoCliente=Input::get('txtNombreClienteNatural').' '.Input::get('txtApellidoPaternoClienteNatural').' '.Input::get('txtApellidoMaternoClienteNatural');
					$documentoCliente=Input::get('txtDniClienteNatural');
					$direccionCliente=Input::get('txtDireccionClienteNatural');

					$nombreCompletoCliente=trim($nombreCompletoCliente, ' ')=='' ? '' : $nombreCompletoCliente;

					if(trim(Input::get('txtNombreClienteNatural'))!='' && trim(Input::get('txtApellidoPaternoClienteNatural'))!='' && trim(Input::get('txtApellidoMaternoClienteNatural'))!='' && trim(Input::get('txtDniClienteNatural'))!='')
					{
						if(TClienteNatural::whereRaw('dni=?', [$documentoCliente])->count()==0)
						{
							$tClienteNatural=new TClienteNatural;
							$tClienteNatural->codigoOficina=substr(Session::get('local'), 0, 15);
							$tClienteNatural->dni=$documentoCliente;
							$tClienteNatural->nombre=Input::get('txtNombreClienteNatural');
							$tClienteNatural->apellidoPaterno=Input::get('txtApellidoPaternoClienteNatural');
							$tClienteNatural->apellidoMaterno=Input::get('txtApellidoMaternoClienteNatural');
							$tClienteNatural->pais='';
							$tClienteNatural->departamento='';
							$tClienteNatural->provincia='';
							$tClienteNatural->distrito='';
							$tClienteNatural->direccion=$direccionCliente;
							$tClienteNatural->manzana='';
							$tClienteNatural->lote='';
							$tClienteNatural->numeroVivienda='';
							$tClienteNatural->numeroInterior='';
							$tClienteNatural->telefono='';
							$tClienteNatural->sexo=false;
							$tClienteNatural->correo='';
							$tClienteNatural->fechaNacimiento='1111/01/01';

							$tClienteNatural->save();
						}
					}
				}
				else
				{
					$nombreCompletoCliente=Input::get('txtRazonSocialLargaClienteJuridico');
					$documentoCliente=Input::get('txtRucClienteJuridico');
					$direccionCliente=Input::get('txtDireccionClienteJuridico');

					if(TClienteJuridico::whereRaw('ruc=?', [$documentoCliente])->count()==0)
					{
						$tClienteJuridico=new TClienteJuridico;
						$tClienteJuridico->codigoOficina=substr(Session::get('local'), 0, 15);
						$tClienteJuridico->ruc=$documentoCliente;
						$tClienteJuridico->razonSocialCorta=$nombreCompletoCliente;
						$tClienteJuridico->razonSocialLarga=$nombreCompletoCliente;
						$tClienteJuridico->residePais=true;
						$tClienteJuridico->fechaConstitucion='1111/11/11';
						$tClienteJuridico->pais='Perú';
						$tClienteJuridico->departamento='';
						$tClienteJuridico->provincia='';
						$tClienteJuridico->distrito='';
						$tClienteJuridico->direccion=$direccionCliente;
						$tClienteJuridico->manzana='';
						$tClienteJuridico->lote='';
						$tClienteJuridico->numeroVivienda='';
						$tClienteJuridico->numeroInterior='';
						$tClienteJuridico->telefono='';
						$tClienteJuridico->correo='';

						$tClienteJuridico->save();
					}
				}				

				if(Input::get('cbxTipoPago')=='Al Contado')
				{
					if($cajaAbierta==1)
					{
						$tDetalleCaja[0]->saldoFinal=($tDetalleCaja[0]->saldoFinal)+$montoParaCaja;
						$tDetalleCaja[0]->ingresos=($tDetalleCaja[0]->ingresos)+$montoParaCaja;

						$tDetalleCaja[0]->save();
					}
					else
					{
						DB::rollback();
						
						return Redirect::to('reciboventa/insertar');
					}
				}

				$tReciboVenta=TReciboVenta::whereRaw('numeroRecibo=? and numeroRecibo!=? and tipoRecibo=? and estado=?', [Input::get('txtNumeroRecibo'), '', Input::get('cbxTipoRecibo'), true])->get();

				if(count($tReciboVenta)>0)
				{
					$mensajeGlobal.='El número del comprobante ya fue registrado con anterioridad.<br>';
				}

				if($mensajeGlobal!='')
				{
					DB::rollback();

					$txtHtmlListaProductosDevueltos=htmlspecialchars(Input::get('txtHtmlListaProductos'));		

					return View::make('reciboventa/insertar', Input::all(), ['color' => 'red', 'mensajeGlobal' => $mensajeGlobal, 'txtHtmlListaProductosDevueltos' => $txtHtmlListaProductosDevueltos, 'cajaAbierta' => $cajaAbierta]);
				}

				$tReciboVenta=new TReciboVenta;

				$tReciboVenta->codigoOficina=substr(Session::get('local'), 0, 15);
				$tReciboVenta->codigoPersonal=substr(Session::get('usuario'), 0, 15);
				$tReciboVenta->nombreCompletoCliente=$nombreCompletoCliente;
				$tReciboVenta->documentoCliente=$documentoCliente;
				$tReciboVenta->direccionCliente=$direccionCliente;
				$tReciboVenta->descripcion=Input::get('txtDescripcion');
				$tReciboVenta->igv=Input::get('txtIgv');
				$tReciboVenta->flete=Input::get('txtFlete');
				$tReciboVenta->subTotal=Input::get('txtSubTotal');
				$tReciboVenta->total=Input::get('txtTotal');
				$tReciboVenta->tipoRecibo=Input::get('cbxTipoRecibo');
				$tReciboVenta->numeroRecibo=Input::get('txtNumeroRecibo');
				$tReciboVenta->comprobanteEmitido=Input::get('cbxTipoPago')=='Al Contado' ? true : false;
				$tReciboVenta->fechaComprobanteEmitido=date('Y-m-d');
				$tReciboVenta->tipoPago=Input::get('cbxTipoPago');
				$tReciboVenta->fechaPrimerPago=Input::get('txtFechaPrimerPago');
				$tReciboVenta->pagoPersonalizado=Input::get('txtPagoPersonalizado');
				$tReciboVenta->pagoAutomatico=Input::get('cbxPagoAutomatico');
				$tReciboVenta->estadoCredito=false;
				$tReciboVenta->letras=Input::get('txtLetras');
				$tReciboVenta->estadoEntrega=Input::get('cbxEstadoEntrega')=='Si' ? true : false;
				$tReciboVenta->nombreCompletoReceptor=Input::get('txtNombreCompletoReceptor');
				$tReciboVenta->documentoReceptor=Input::get('txtDocumentoReceptor');
				$tReciboVenta->direccionEnvioReceptor=Input::get('txtDireccionEnvioReceptor');
				$tReciboVenta->documentoTransportista=Input::get('txtDocumentoTransportista');
				$tReciboVenta->nombreCompletoTransportista=Input::get('txtNombreCompletoTransportista');
				$tReciboVenta->marcaPlacaAutoMovilTransportista=Input::get('txtMarcaPlacaAutoMovilTransportista');
				$tReciboVenta->licenciaConducirTransportista=Input::get('txtLicenciaConducirTransportista');
				$tReciboVenta->estado=true;
				$tReciboVenta->motivoAnulacion='';

				$tReciboVenta->save();

				$ultimoRegistroTReciboVenta=TReciboVenta::whereRaw('codigoReciboVenta=(select max(codigoReciboVenta) from TReciboVenta)')->get();

				if(Input::get('cbxTipoPago')=='Al Crédito')
				{
					$dia=substr(Input::get('txtFechaPrimerPago'), 8, 2);
					$mes=substr(Input::get('txtFechaPrimerPago'), 5, 2);
					$anio=substr(Input::get('txtFechaPrimerPago'), 0, 4);
					$diaSemana=date('w', mktime(0, 0, 0, $mes, $dia, $anio));

					if($diaSemana==0)
					{
						$mensajeGlobal.='La fecha del primer pago no puede ser un domingo<br>';
					}

					if($mensajeGlobal!='')
					{
						DB::rollback();

						$txtHtmlListaProductosDevueltos=htmlspecialchars(Input::get('txtHtmlListaProductos'));		

						return View::make('reciboventa/insertar', Input::all(), ['color' => 'red', 'mensajeGlobal' => $mensajeGlobal, 'txtHtmlListaProductosDevueltos' => $txtHtmlListaProductosDevueltos, 'cajaAbierta' => $cajaAbierta]);
					}

					$porPagar=number_format(Input::get('txtTotal')/Input::get('txtLetras'), 1, '.', '');
					$fechaPagar='';

					if(Input::get('txtPagoPersonalizado')==0)
					{
						$viernesRestarSemana=0;
						$finalSumarMes=0;

						for($i=0; $i<Input::get('txtLetras'); $i++)
						{
							if($i==0)
							{
								$fechaPagar=Input::get('txtFechaPrimerPago');
							}
							else
							{
								switch(Input::get('cbxPagoAutomatico'))
								{
									case 'Semanalmente los Lunes':
										$fechaTemporal=date('Y-m-d', strtotime(Input::get('txtFechaPrimerPago')." +$i week"));
										$dia=substr($fechaTemporal, 8, 2);
										$mes=substr($fechaTemporal, 5, 2);
										$anio=substr($fechaTemporal, 0, 4);
										$diaSemana=date('w', mktime(0, 0, 0, $mes, $dia, $anio));
										$fechaPagar=date('Y-m-d', mktime(0, 0, 0, $mes, $dia-$diaSemana+1, $anio));

										break;

									case 'Semanalmente los Viernes':
										$sumarSemanas=$i-$viernesRestarSemana;
										$fechaTemporal=date('Y-m-d', strtotime(Input::get('txtFechaPrimerPago')." +$sumarSemanas week"));
										$dia=substr($fechaTemporal, 8, 2);
										$mes=substr($fechaTemporal, 5, 2);
										$anio=substr($fechaTemporal, 0, 4);
										$diaSemana=date('w', mktime(0, 0, 0, $mes, $dia, $anio));

										if($viernesRestarSemana=0 && $diaSemana<5)
										{
											$viernesRestarSemana=1;
											$sumarSemanas=$i-$viernesRestarSemana;
											$fechaTemporal=date('Y-m-d', strtotime(Input::get('txtFechaPrimerPago')." +$sumarSemanas week"));
											$dia=substr($fechaTemporal, 8, 2);
											$mes=substr($fechaTemporal, 5, 2);
											$anio=substr($fechaTemporal, 0, 4);
											$diaSemana=date('w', mktime(0, 0, 0, $mes, $dia, $anio));
										}

										$fechaPagar=date('Y-m-d', mktime(0, 0, 0, $mes, $dia+(7-($diaSemana+2)), $anio));

										break;

									case 'Primer día Laboral del Mes':
										$fechaTemporal=date('Y-m-d', strtotime(Input::get('txtFechaPrimerPago')." +$i month"));
										$mes=substr($fechaTemporal, 5, 2);
										$anio=substr($fechaTemporal, 0, 4);
										$dia=date("d", mktime(0,0,0, $mes, 1, $anio));
										$diaSemana=date('w', mktime(0, 0, 0, $mes, $dia, $anio));

										$fechaPagar=date('Y-m-d', mktime(0,0,0, $mes, $dia, $anio));

										if($diaSemana==0)
										{
											$fechaPagar=date('Y-m-d', strtotime($fechaPagar." +1 day"));
										}

										break;
								}
							}

							if($i==(Input::get('txtLetras')-1))
							{
								$porPagarUltimaLetra=number_format((Input::get('txtTotal')-($porPagar*($i))), 1, '.', '');
								$porPagar=$porPagarUltimaLetra<=0 ? 0 : $porPagarUltimaLetra;
							}

							$tReciboVentaLetra=new TReciboVentaLetra;

							$tReciboVentaLetra->codigoReciboVenta=$ultimoRegistroTReciboVenta[0]->codigoReciboVenta;
							$tReciboVentaLetra->pagado=0;
							$tReciboVentaLetra->porPagar=$porPagar;
							$tReciboVentaLetra->diasMora=0;
							$tReciboVentaLetra->fechaPagar=$fechaPagar;
							$tReciboVentaLetra->estado=false;

							$tReciboVentaLetra->save();
						}
					}
					else
					{
						$fechaPagar=Input::get('txtFechaPrimerPago');
						$sumarDias=Input::get('txtPagoPersonalizado');

						$tReciboVentaLetra=new TReciboVentaLetra;

						$tReciboVentaLetra->codigoReciboVenta=$ultimoRegistroTReciboVenta[0]->codigoReciboVenta;
						$tReciboVentaLetra->pagado=0;
						$tReciboVentaLetra->porPagar=$porPagar;
						$tReciboVentaLetra->diasMora=0;
						$tReciboVentaLetra->fechaPagar=$fechaPagar;
						$tReciboVentaLetra->estado=false;

						$tReciboVentaLetra->save();

						for($i=0; $i<(Input::get('txtLetras')-1); $i++)
						{
							$fechaTemporal=date('Y-m-d', strtotime($fechaPagar." +$sumarDias day"));
							$dia=substr($fechaTemporal, 8, 2);
							$mes=substr($fechaTemporal, 5, 2);
							$anio=substr($fechaTemporal, 0, 4);
							$diaSemana=date('w', mktime(0, 0, 0, $mes, $dia, $anio));

							if($diaSemana==0)
							{
								$sumaTemporal=$sumarDias+1;
								$fechaTemporal=date('Y-m-d', strtotime($fechaPagar." +$sumaTemporal day"));
							}

							$fechaPagar=$fechaTemporal;

							if($i==(Input::get('txtLetras')-2))
							{
								$porPagarUltimaLetra=number_format((Input::get('txtTotal')-($porPagar*($i+1))), 1, '.', '');
								$porPagar=$porPagarUltimaLetra<=0 ? 0 : $porPagarUltimaLetra;
							}

							$tReciboVentaLetra=new TReciboVentaLetra;

							$tReciboVentaLetra->codigoReciboVenta=$ultimoRegistroTReciboVenta[0]->codigoReciboVenta;
							$tReciboVentaLetra->pagado=0;
							$tReciboVentaLetra->porPagar=$porPagar;
							$tReciboVentaLetra->diasMora=0;
							$tReciboVentaLetra->fechaPagar=$fechaPagar;
							$tReciboVentaLetra->estado=false;

							$tReciboVentaLetra->save();
						}
					}
				}

				$listaProductos=explode('__SEPARADORREGISTRO__', Input::get('txtListaProductos'));

				$expresionNumero="/^[0-9]+([\.]{1}[0-9]*)?$/";
				$expresionEntero="/^[0-9]+$/";
				$expresionDosDecimales="/^[0-9]+([\.]{1}[0-9]{1,2})?$/";

				foreach($listaProductos as $key => $value)
				{
					$camposProducto=explode('__SEPARADORCAMPO__', $value);

					if(!preg_match($expresionNumero, $camposProducto[13]) || !preg_match($expresionNumero, $camposProducto[14]) || !preg_match($expresionDosDecimales, $camposProducto[17]) || $camposProducto[17]<=0)
					{
						$mensajeGlobal.='Datos incorrectos en el producto número '.($key+1).' de la lista. Por favor corrija los datos<br>';
					}

					$tOficinaProducto=TOficinaProducto::find($camposProducto[0]);

					if($tOficinaProducto!=null)
					{
						if($tOficinaProducto->cantidad<$camposProducto[13])
						{
							$mensajeGlobal.='No hay stock suficiente para el producto '.($key+1).' de la lista. Por favor corrija los datos<br>';
						}

						if(!$tOficinaProducto->ventaMenorUnidad && !preg_match($expresionEntero, $camposProducto[13]))
						{
							$mensajeGlobal.='Sólo se permiten ventas por unidades enteras en el producto Nº '.($key+1).' de la lista<br>';
						}
					}

					if($mensajeGlobal!='')
					{
						DB::rollback();

						$txtHtmlListaProductosDevueltos=htmlspecialchars(Input::get('txtHtmlListaProductos'));

						return View::make('reciboventa/insertar', Input::all(), ['color' => 'red', 'mensajeGlobal' => $mensajeGlobal, 'txtHtmlListaProductosDevueltos' => $txtHtmlListaProductosDevueltos, 'cajaAbierta' => $cajaAbierta]);
					}

					$tReciboVentaDetalle=new TReciboVentaDetalle;
					$tReciboVentaDetalle->codigoReciboVenta=$ultimoRegistroTReciboVenta[0]->codigoReciboVenta;
					$tReciboVentaDetalle->codigoOficinaProducto=$camposProducto[0];
					$tReciboVentaDetalle->codigoBarrasProducto=$camposProducto[1];
					$tReciboVentaDetalle->primerNombreProducto=$camposProducto[2];
					$tReciboVentaDetalle->segundoNombreProducto=$camposProducto[3];
					$tReciboVentaDetalle->tercerNombreProducto=$camposProducto[4];
					$tReciboVentaDetalle->descripcionProducto=$camposProducto[6];
					$tReciboVentaDetalle->tipoProducto=$camposProducto[7];
					$tReciboVentaDetalle->categoriaProducto=$camposProducto[8];
					$tReciboVentaDetalle->presentacionProducto=$camposProducto[10];
					$tReciboVentaDetalle->unidadMedidaProducto=$camposProducto[11];
					$tReciboVentaDetalle->precioVentaTotalProducto=$camposProducto[17];
					$tReciboVentaDetalle->precioVentaUnitarioProducto=number_format(($camposProducto[17]/$camposProducto[13]), 2, '.', '');
					$tReciboVentaDetalle->cantidadProducto=$camposProducto[13];
					$tReciboVentaDetalle->cantidadBloqueProducto=$camposProducto[14];
					$tReciboVentaDetalle->unidadMedidaBloqueProducto=$camposProducto[16];

					$tReciboVentaDetalle->save();
				}

				DB::commit();
                                
                                // Proceso de creación de txt
                                $path = Config::get('ventas.txts_path') . 'algo.txt';
                                File::put($path, 'algodsa dsadsad a dsa dsa sa');
                                
				Session::flash('tipoPago', $ultimoRegistroTReciboVenta[0]->tipoPago);
				Session::flash('tipoRecibo', $ultimoRegistroTReciboVenta[0]->tipoRecibo);
				Session::flash('codigoReciboVenta', $ultimoRegistroTReciboVenta[0]->codigoReciboVenta);

				return Redirect::to('reciboventa/insertar')->with('mensajeRedirect', 'Operación realizada correctamente');
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

				$txtHtmlListaProductosDevueltos=htmlspecialchars(Input::get('txtHtmlListaProductos'));

				return View::make('reciboventa/insertar', Input::all(), ['color' => 'red', 'mensajeGlobal' => 'Ocurrió un error inesperado. Por favor contacto con el administrador del sistema.', 'txtHtmlListaProductosDevueltos' => $txtHtmlListaProductosDevueltos, 'cajaAbierta' => $cajaAbierta]);
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
			return View::make('reciboventa/insertar', ['color' => '#1497CC', 'mensajeGlobal' => 'Operación realizada correctamente', 'cajaAbierta' => $cajaAbierta]);
		}

		return View::make('reciboventa/insertar', ['cajaAbierta' => $cajaAbierta]);
	}

	public function actionVerEntreFechas($fechaInicial=null, $fechaFinal=null)
	{
		$listaTReciboVenta=TReciboVenta::whereRaw('codigoOficina=? and created_at between ? and ? order by created_at desc', [substr(Session::get('local'), 0, 15), $fechaInicial, $fechaFinal])->get();

		if(Session::has('mensajeRedirect'))
		{
			return View::make('reciboventa/verentrefechas', ['color' => '#1497CC', 'mensajeGlobal' => Session::get('mensajeRedirect'), 'listaTReciboVenta' => $listaTReciboVenta, 'fechaInicial' => $fechaInicial, 'fechaFinal' => $fechaFinal]);
		}

		if(Session::has('mensajeRedirectError'))
		{
			return View::make('reciboventa/verentrefechas', ['color' => 'red', 'mensajeGlobal' => Session::get('mensajeRedirectError'), 'listaTReciboVenta' => $listaTReciboVenta, 'fechaInicial' => $fechaInicial, 'fechaFinal' => $fechaFinal]);
		}

		return View::make('reciboventa/verentrefechas', ['listaTReciboVenta' => $listaTReciboVenta, 'fechaInicial' => $fechaInicial, 'fechaFinal' => $fechaFinal]);
	}

	public function actionAnular()
	{
		if(Input::has('txtCodigoReciboVenta'))
		{
			try
			{
				DB::beginTransaction();

				$tReciboVenta=TReciboVenta::find(Input::get('txtCodigoReciboVenta'));

				if($tReciboVenta->tipoPago=='Al Crédito')
				{
					if(TReciboVentaPago::whereRaw('codigoReciboVenta=?', [($tReciboVenta->codigoReciboVenta)])->count()>0)
					{
						DB::rollback();

						return Redirect::to('/reciboventa/verentrefechas/'.date('Y-m-d').'/'.date('Y-m-d', strtotime(date('Y-m-d').' +1 day')))->with('mensajeRedirectError', 'No se puede anular la venta porque ya se pagaron letras');;
					}
				}
				
				$tReciboVenta->estado=false;
				$tReciboVenta->motivoAnulacion=Input::get('txtMotivoAnulacion');

				$tReciboVenta->save();

				$montoParaCaja=0;

				$listaTReciboVentaDetalle=TReciboVentaDetalle::whereRaw('codigoReciboVenta=?', [Input::get('txtCodigoReciboVenta')])->get();

				foreach($listaTReciboVentaDetalle as $key => $value)
				{
					$montoParaCaja+=$value->precioVentaTotalProducto;

					$tOficinaProducto=TOficinaProducto::find($value->codigoOficinaProducto);

					if($tOficinaProducto!=null)
					{
						$cantidadAnterior=$tOficinaProducto->cantidad;

						$tOficinaProducto->cantidad=$cantidadAnterior+$value->cantidadProducto;

						$tOficinaProducto->save();
					}
				}

				if($tReciboVenta->tipoPago=='Al Contado')
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
						if(($tDetalleCaja[0]->saldoFinal)<$montoParaCaja)
						{
							DB::rollback();
							
							return Redirect::to('/reciboventa/verentrefechas/'.date('Y-m-d').'/'.date('Y-m-d', strtotime(date('Y-m-d').' +1 day')))->with('mensajeRedirectError', 'El dinero en caja no es suficiente');
						}

						$tDetalleCaja[0]->saldoFinal=($tDetalleCaja[0]->saldoFinal)-$montoParaCaja;
						$tDetalleCaja[0]->egresos=($tDetalleCaja[0]->egresos)+$montoParaCaja;

						$tDetalleCaja[0]->save();
					}
					else
					{
						DB::rollback();

						return Redirect::to('/reciboventa/verentrefechas/'.date('Y-m-d').'/'.date('Y-m-d', strtotime(date('Y-m-d').' +1 day')))->with('mensajeRedirectError', 'Se debe abrir caja antes de realizar operaciones monetarias');
					}
				}

				DB::commit();

				return Redirect::to('/reciboventa/verentrefechas/'.date('Y-m-d').'/'.date('Y-m-d', strtotime(date('Y-m-d').' +1 day')))->with('mensajeRedirect', 'Operación realizada correctamente');
			}
			catch(Exception $ex)
			{
				DB::rollback();

				return Redirect::to('/reciboventa/verentrefechas/'.date('Y-m-d').'/'.date('Y-m-d', strtotime(date('Y-m-d').' +1 day')))->with('mensajeRedirectError', 'Error inesperado, por favor contacte con el administrador del sistema');
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

		return View::make('reciboventa/anular', ['tReciboVenta' => $tReciboVenta, 'cajaAbierta' => $cajaAbierta]);
	}

	public function actionVerPorTipoPago($tipoPago='Al Crédito')
	{
		$listaTReciboVenta=TReciboVenta::whereRaw('tipoPago=? order by created_at desc', [$tipoPago])->get();

		if(Session::has('mensajeRedirect'))
		{
			return View::make('reciboventa/verportipopago', ['color' => '#1497CC', 'mensajeGlobal' => Session::get('mensajeRedirect'), 'listaTReciboVenta' => $listaTReciboVenta]);
		}

		if(Session::has('mensajeRedirectError'))
		{
			return View::make('reciboventa/verportipopago', ['color' => 'red', 'mensajeGlobal' => Session::get('mensajeRedirectError'), 'listaTReciboVenta' => $listaTReciboVenta]);
		}

		return View::make('reciboventa/verportipopago', ['listaTReciboVenta' => $listaTReciboVenta, 'tipoPago' => $tipoPago]);
	}

	public function actionEditar()
	{
		if(Input::has('txtCodigoReciboVenta'))
		{
			$mensajeGlobal='';

			$tReciboVenta=TReciboVenta::whereRaw('codigoReciboVenta!=? and numeroRecibo=? and numeroRecibo!=? and tipoRecibo=? and estado=?', [Input::get('txtCodigoReciboVenta'), Input::get('txtNumeroRecibo'), '', Input::get('cbxTipoRecibo'), true])->get();

			if(count($tReciboVenta)>0)
			{
				$mensajeGlobal.='El número del comprobante ya existe en otra venta.<br>';
			}

			if($mensajeGlobal!='')
			{
				return Redirect::to('/reciboventa/verentrefechas/'.date('Y-m-d').'/'.date('Y-m-d', strtotime(date('Y-m-d').' +1 day')))->with('mensajeRedirectError', $mensajeGlobal);
			}

			$tReciboVenta=TReciboVenta::find(Input::get('txtCodigoReciboVenta'));

			$tReciboVenta->tipoRecibo=Input::get('cbxTipoRecibo');
			$tReciboVenta->numeroRecibo=Input::get('txtNumeroRecibo');
			$tReciboVenta->comprobanteEmitido=Input::get('radioComprobanteEmitido')=='Si' ? true : false;
			$tReciboVenta->fechaComprobanteEmitido=Input::get('dateFechaComprobanteEmitido');
			$tReciboVenta->nombreCompletoCliente=Input::get('txtNombreCompletoCliente');
			$tReciboVenta->documentoCliente=Input::get('txtDocumentoCliente');
			$tReciboVenta->direccionCliente=Input::get('txtDireccionCliente');
			$tReciboVenta->nombreCompletoReceptor=Input::get('txtNombreCompletoReceptor');
			$tReciboVenta->documentoReceptor=Input::get('txtDocumentoReceptor');
			$tReciboVenta->direccionEnvioReceptor=Input::get('txtDireccionEnvioReceptor');
			$tReciboVenta->flete=Input::get('txtFlete');
			$tReciboVenta->documentoTransportista=Input::get('txtDocumentoTransportista');
			$tReciboVenta->nombreCompletoTransportista=Input::get('txtNombreCompletoTransportista');
			$tReciboVenta->marcaPlacaAutoMovilTransportista=Input::get('txtMarcaPlacaAutoMovilTransportista');
			$tReciboVenta->licenciaConducirTransportista=Input::get('txtLicenciaConducirTransportista');
			$tReciboVenta->descripcion=Input::get('txtDescripcion');

			$tReciboVenta->save();

			return Redirect::to('/reciboventa/verentrefechas/'.date('Y-m-d').'/'.date('Y-m-d', strtotime(date('Y-m-d').' +1 day')))->with('mensajeRedirect', 'Cambios guardados correctamente');
		}

		$tReciboVenta=TReciboVenta::find(Input::get('codigo'));

		return View::make('reciboventa/editar', ['tReciboVenta' => $tReciboVenta]);
	}
}
?>