<?php
class PersonalController extends BaseController
{
	public function actionInsertar()
	{
		if($_POST)
		{
			$validator=Validator::make
			(
				['dni' => Input::get('txtDni')],
			    ['dni' => ['unique:TPersonal']]
			);
			if($validator->fails())
			{
				return View::make('personal.insertar', Input::all(), ['color' => 'red', 'mensajeGlobal' => 'El personal ya existe']);
			}
			$tPersonal=new TPersonal;
			$tPersonal->dni=Input::get('txtDni');
			$tPersonal->nombre=Input::get('txtNombre');
			$tPersonal->apellidoPaterno=Input::get('txtApellidoPaterno');
			$tPersonal->apellidoMaterno=Input::get('txtApellidoMaterno');
			$tPersonal->seguridadSocial=Input::get('txtSeguridadSocial');
			$tPersonal->pais=Input::get('txtPais');
			$tPersonal->departamento=Input::get('txtDepartamento');
			$tPersonal->provincia=Input::get('txtProvincia');
			$tPersonal->distrito=Input::get('txtDistrito');
			$tPersonal->direccion=Input::get('txtDireccion');
			$tPersonal->manzana=Input::get('txtManzana');
			$tPersonal->lote=Input::get('txtLote');
			$tPersonal->numeroVivienda=Input::get('txtNumeroVivienda');
			$tPersonal->numeroInterior=Input::get('txtNumeroInterior');
			$tPersonal->telefono=Input::get('txtTelefono');
			$tPersonal->estadoCivil=Input::get('radioEstadoCivil');
			$tPersonal->sexo=Input::get('radioSexo');
			$tPersonal->fechaNacimiento=Input::get('txtFechaNacimiento');
			$tPersonal->correo=Input::get('txtCorreo');
			$tPersonal->grupoSanguineo=Input::get('txtGrupoSanguineo');
			$tPersonal->tipoEmpleado=Input::get('cbxTipoEmpleado');
			$tPersonal->cargo=Input::get('txtCargo');

			$tPersonal->save();

			return View::make('personal.insertar', ['color' => '#1497CC', 'mensajeGlobal' => 'Operación realizada correctamente']);
		}
		return View::make('personal.insertar');
	}

	public function actionVer()
	{
		$listaTPersonal=TPersonal::all();
		return View::make('personal.ver', ['listaTPersonal' => $listaTPersonal]);
	}

	public function actionVerDetalle()
	{
		$tPersonal=TPersonal::find(Input::get('codigo'));
		return View::make('personal.verdetalle', ['tPersonal' => $tPersonal]);
	}

	public function actionEditar()
	{
		if(Input::has('txtCodigoPersonal'))
		{
			$registroExiste=false;
			if(TPersonal::whereRaw('codigoPersonal!=? and dni=?', [Input::get('txtCodigoPersonal'), Input::get('txtDni')])->count()>0)
			{
				$registroExiste=true;
			}
			if($registroExiste)
			{
				$listaTPersonal=TPersonal::all();
				return View::make('personal.ver', ['color' => 'red', 'mensajeGlobal' => 'El personal ya existente', 'listaTPersonal' => $listaTPersonal]);
			}
			TPersonal::where('codigoPersonal', '=', Input::get('txtCodigoPersonal'))->update(array
			(
				'dni' => Input::get('txtDni'),
				'nombre' => Input::get('txtNombre'),
				'apellidoPaterno' => Input::get('txtApellidoPaterno'),
				'apellidoMaterno' => Input::get('txtApellidoMaterno'),
				'seguridadSocial' => Input::get('txtSeguridadSocial'),
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
				'estadoCivil' => Input::get('radioEstadoCivil'),
				'sexo' => Input::get('radioSexo'),
				'fechaNacimiento' => Input::get('txtFechaNacimiento'),
				'correo' => Input::get('txtCorreo'),
				'grupoSanguineo' => Input::get('txtGrupoSanguineo'),
				'tipoEmpleado' => Input::get('cbxTipoEmpleado'),
				'cargo' => Input::get('txtCargo')
			));

			$listaTPersonal=TPersonal::all();

			return View::make('personal.ver', ['color' => '#1497CC', 'mensajeGlobal' => 'Operación realizada correctamente', 'listaTPersonal' => $listaTPersonal]);
		}
		else
		{
			$tPersonal=TPersonal::find(Input::get('codigo'));
			return View::make('personal.editar', ['tPersonal' => $tPersonal]);
		}
	}

	public function actionBuscarPersonal()
	{
		$listaTPersonal=TPersonal::all();
		return View::make('personal.buscarpersonal', ['listaTPersonal' => $listaTPersonal]);
	}
}
?>