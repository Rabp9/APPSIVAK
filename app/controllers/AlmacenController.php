<?php
class AlmacenController extends BaseController
{
	public function actionInsertar()
	{
		if($_POST)
		{
			$validator=Validator::make
			(
				['descripcion' => Input::get('txtDescripcion')],
			    ['descripcion' => ['unique:TAlmacen']]
			);

			if($validator->fails())
			{
				return View::make('almacen/insertar', Input::all(), ['color' => 'red', 'mensajeGlobal' => 'Nombre de almacen existente']);
			}
			
			$tAlmacen=new TAlmacen;
			$tAlmacen->descripcion=Input::get('txtDescripcion');
			$tAlmacen->pais=Input::get('txtPais');
			$tAlmacen->departamento=Input::get('txtDepartamento');
			$tAlmacen->provincia=Input::get('txtProvincia');
			$tAlmacen->distrito=Input::get('txtDistrito');
			$tAlmacen->direccion=Input::get('txtDireccion');
			$tAlmacen->manzana=Input::get('txtManzana');
			$tAlmacen->lote=Input::get('txtLote');
			$tAlmacen->numeroVivienda=Input::get('txtNumeroVivienda');
			$tAlmacen->numeroInterior=Input::get('txtNumeroInterior');
			$tAlmacen->telefono=Input::get('txtTelefono');
			$tAlmacen->fechaCreacion=Input::get('txtFechaCreacion');
			$tAlmacen->estado=true;

			$tAlmacen->save();

			return View::make('almacen.insertar', ['color' => '#1497CC', 'mensajeGlobal' => 'Operación realizada correctamente']);
		}

		return View::make('almacen/insertar');
	}

	public function actionVer()
	{
		$listaTAlmacen=TAlmacen::all();

		if(Session::has('mensajeRedirect'))
		{
			return View::make('almacen/ver', ['color' => '#1497CC', 'mensajeGlobal' => Session::get('mensajeRedirect'), 'listaTAlmacen' => $listaTAlmacen]);
		}

		if(Session::has('mensajeRedirectError'))
		{
			return View::make('almacen/ver', ['color' => 'red', 'mensajeGlobal' => Session::get('mensajeRedirectError'), 'listaTAlmacen' => $listaTAlmacen]);
		}

		return View::make('almacen.ver', ['listaTAlmacen' => $listaTAlmacen]);
	}

	public function actionVerDetalle()
	{
		$tAlmacen=TAlmacen::find(Input::get('codigo'));

		return View::make('almacen/verdetalle', ['tAlmacen' => $tAlmacen]);
	}

	public function actionEditar()
	{
		if(Input::has('txtCodigoAlmacen'))
		{
			$valorRetorno=false;
			if(TAlmacen::whereRaw('codigoAlmacen!=? and descripcion=?', [Input::get('txtCodigoAlmacen'), Input::get('txtDescripcion')])->count()>0)
			{
				$valorRetorno=true;
			}
			if($valorRetorno)
			{
				$listaTAlmacen=TAlmacen::all();

				return View::make('almacen/ver', ['color' => 'red', 'mensajeGlobal' => 'Nombre de almacen existente', 'listaTAlmacen' => $listaTAlmacen]);
			}
			TAlmacen::where('codigoAlmacen', '=', Input::get('txtCodigoAlmacen'))->update(array
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

			$listaTAlmacen=TAlmacen::all();

			return View::make('almacen.ver', ['color' => '#1497CC', 'mensajeGlobal' => 'Operación realizada correctamente', 'listaTAlmacen' => $listaTAlmacen]);
		}
		else
		{
			$tAlmacen=TAlmacen::find(Input::get('codigo'));

			return View::make('almacen/editar', ['tAlmacen' => $tAlmacen]);
		}
	}

	public function actionBuscarAlmacen()
	{
		$listaTAlmacen=TAlmacen::all();

		return View::make('almacen/buscaralmacen', ['listaTAlmacen' => $listaTAlmacen]);
	}

	public function actionAdministrarPersonal($codigoAlmacen)
	{
		$tAlmacen=TAlmacen::find($codigoAlmacen);
		if($_POST)
		{
			if(Input::get('arrayAsignados')!='')
			{
				$arrayAsignados=explode(',', Input::get('arrayAsignados'));
				foreach ($arrayAsignados as $key => $value) 
				{
					if(TPersonalTAlmacen::whereRaw('codigoPersonal=? and codigoAlmacen=?', [$value, $codigoAlmacen])->count()==1)
					{
						continue;
					}
					$tPersonalTAlmacen=new TPersonalTAlmacen;
					$tPersonalTAlmacen->codigoPersonal=$value;
					$tPersonalTAlmacen->codigoAlmacen=$codigoAlmacen;
					$tPersonalTAlmacen->save();
				}
			}
			if(Input::get('arrayEliminados')!='')
			{
				$arrayEliminados=explode(',', Input::get('arrayEliminados'));
				foreach ($arrayEliminados as $key => $value) 
				{
					TPersonalTAlmacen::whereRaw('codigoPersonal=? and codigoAlmacen=?', [$value, $codigoAlmacen])->delete();
				}
			}
			
			return Redirect::to('almacen/ver')->with('mensajeRedirect', 'Operación realizada correctamente');
		}

		$listaTPersonalNoAsignado=TPersonal::whereRaw('codigoPersonal not in (select codigoPersonal from TPersonalTAlmacen where codigoAlmacen=?)', [$codigoAlmacen])->get();
		$listaTPersonalAsignado=TPersonal::whereRaw('codigoPersonal in (select codigoPersonal from TPersonalTAlmacen where codigoAlmacen=?)', [$codigoAlmacen])->get();
		
		return View::make('almacen/administrarpersonal', ['tAlmacen' => $tAlmacen, 'listaTPersonalNoAsignado' => $listaTPersonalNoAsignado, 'listaTPersonalAsignado' => $listaTPersonalAsignado]);
	}
}
?>