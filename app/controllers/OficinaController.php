<?php
class OficinaController extends BaseController
{
	public function actionInsertar()
	{
		if($_POST)
		{
			$validator=Validator::make
			(
				['descripcion' => Input::get('txtDescripcion')],
			    ['descripcion' => ['unique:TOficina']]
			);

			if($validator->fails())
			{
				return View::make('oficina/insertar', Input::all(), ['color' => 'red', 'mensajeGlobal' => 'Nombre de oficina existente']);
			}
			
			$tOficina=new TOficina;
			$tOficina->descripcion=Input::get('txtDescripcion');
			$tOficina->pais=Input::get('txtPais');
			$tOficina->departamento=Input::get('txtDepartamento');
			$tOficina->provincia=Input::get('txtProvincia');
			$tOficina->distrito=Input::get('txtDistrito');
			$tOficina->direccion=Input::get('txtDireccion');
			$tOficina->manzana=Input::get('txtManzana');
			$tOficina->lote=Input::get('txtLote');
			$tOficina->numeroVivienda=Input::get('txtNumeroVivienda');
			$tOficina->numeroInterior=Input::get('txtNumeroInterior');
			$tOficina->telefono=Input::get('txtTelefono');
			$tOficina->fechaCreacion=Input::get('txtFechaCreacion');
			$tOficina->estado=true;

			$tOficina->save();
			
			return View::make('oficina.insertar', ['color' => '#1497CC', 'mensajeGlobal' => 'Operación realizada correctamente']);
		}

		return View::make('oficina/insertar');
	}

	public function actionVer()
	{
		$listaTOficina=TOficina::all();

		if(Session::has('mensajeRedirect'))
		{
			return View::make('oficina/ver', ['color' => '#1497CC', 'mensajeGlobal' => Session::get('mensajeRedirect'), 'listaTOficina' => $listaTOficina]);
		}

		if(Session::has('mensajeRedirectError'))
		{
			return View::make('oficina/ver', ['color' => 'red', 'mensajeGlobal' => Session::get('mensajeRedirectError'), 'listaTOficina' => $listaTOficina]);
		}

		return View::make('oficina.ver', ['listaTOficina' => $listaTOficina]);
	}

	public function actionVerDetalle()
	{
		$tOficina=TOficina::find(Input::get('codigo'));

		return View::make('oficina/verdetalle', ['tOficina' => $tOficina]);
	}

	public function actionVerPorCodigoOficina()
	{
		$tOficina=TOficina::find(Input::get('codigo'));
		
		return View::make('oficina/verporcodigooficina', ['tOficina' => $tOficina]);
	}

	public function actionEditar()
	{
		if(Input::has('txtCodigoOficina'))
		{
			$registroExiste=false;
			if(TOficina::whereRaw('codigoOficina!=? and descripcion=?', [Input::get('txtCodigoOficina'), Input::get('txtDescripcion')])->count()>0)
			{
				$registroExiste=true;
			}
			if($registroExiste)
			{
				$listaTOficina=TOficina::all();

				return View::make('oficina/ver', ['color' => 'red', 'mensajeGlobal' => 'El nombre de la oficina ingresada existente', 'listaTOficina' => $listaTOficina]);
			}
			TOficina::where('codigoOficina', '=', Input::get('txtCodigoOficina'))->update(array
			(
				'descripcion' => Input::get('txtDescripcion'),
				'pais' => Input::get('txtPais'),
				'departamento' => Input::get('txtDepartamento'),
				'provincia' => Input::get('txtProvincia'),
				'distrito' => Input::get('txtDistrito'),
				'direccion' => Input::get('txtDireccion'),
				'manzana' => Input::get('txtManzana'),
				'lote' => Input::get('txtLote'),
				'numeroVivienda' => Input::get('txtNumeroVivienda'),
				'numeroInterior' => Input::get('txtNumeroInterior'),
				'telefono' => Input::get('txtTelefono'),
				'fechaCreacion' => Input::get('txtFechaCreacion'),
				'estado' => Input::get('cbxEstado')
			));

			$listaTOficina=TOficina::all();

			return View::make('oficina/ver', ['color' => '#1497CC', 'mensajeGlobal' => 'Operación realizada correctamente', 'listaTOficina' => $listaTOficina]);
		}
		else
		{
			$tOficina=TOficina::find(Input::get('codigo'));

			return View::make('oficina/editar', ['tOficina' => $tOficina]);
		}
	}

	public function actionBuscarOficina()
	{
		$listaTOficina=TOficina::all();

		return View::make('oficina/buscaroficina', ['listaTOficina' => $listaTOficina]);
	}

	public function actionBuscarOficinaDos()
	{
		$listaTOficina=TOficina::all();

		return View::make('oficina/buscaroficinados', ['listaTOficina' => $listaTOficina]);
	}

	public function actionAdministrarPersonal($codigoOficina)
	{
		$tOficina=TOficina::find($codigoOficina);
		if($_POST)
		{
			if(Input::get('arrayAsignados')!='')
			{
				$arrayAsignados=explode(',', Input::get('arrayAsignados'));
				foreach ($arrayAsignados as $key => $value) 
				{
					if(TPersonalTOficina::whereRaw('codigoPersonal=? and codigoOficina=?', [$value, $codigoOficina])->count()==1)
					{
						continue;
					}
					$tPersonalTOficina=new TPersonalTOficina;
					$tPersonalTOficina->codigoPersonal=$value;
					$tPersonalTOficina->codigoOficina=$codigoOficina;
					$tPersonalTOficina->save();
				}
			}
			if(Input::get('arrayEliminados')!='')
			{
				$arrayEliminados=explode(',', Input::get('arrayEliminados'));
				foreach ($arrayEliminados as $key => $value) 
				{
					TPersonalTOficina::whereRaw('codigoPersonal=? and codigoOficina=?', [$value, $codigoOficina])->delete();
				}
			}

			return Redirect::to('oficina/ver')->with('mensajeRedirect', 'Operación realizada correctamente');
		}
		$listaTPersonalNoAsignado=TPersonal::whereRaw('codigoPersonal not in (select codigoPersonal from TPersonalTOficina where codigoOficina=?)', [$codigoOficina])->get();
		$listaTPersonalAsignado=TPersonal::whereRaw('codigoPersonal in (select codigoPersonal from TPersonalTOficina where codigoOficina=?)', [$codigoOficina])->get();
		
		return View::make('oficina/administrarpersonal', ['tOficina' => $tOficina, 'listaTPersonalNoAsignado' => $listaTPersonalNoAsignado, 'listaTPersonalAsignado' => $listaTPersonalAsignado]);
	}
}
?>