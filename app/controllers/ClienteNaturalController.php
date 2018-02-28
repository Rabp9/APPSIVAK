<?php
class ClienteNaturalController extends BaseController
{
	public function actionInsertar()
	{
		if($_POST)
		{
			$validator=Validator::make
			(
				['dni' => Input::get('txtDni')],
			    ['dni' => ['unique:TClienteNatural']]
			);
			if($validator->fails())
			{
				return View::make('clientenatural.insertar', Input::all(), ['color' => 'red', 'mensajeGlobal' => 'Cliente Existente']);
			}
			$tClienteNatural=new TClienteNatural;
			$tClienteNatural->codigoOficina=Input::get('txtCodigoOficina');
			$tClienteNatural->dni=Input::get('txtDni');
			$tClienteNatural->nombre=Input::get('txtNombre');
			$tClienteNatural->apellidoPaterno=Input::get('txtApellidoPaterno');
			$tClienteNatural->apellidoMaterno=Input::get('txtApellidoMaterno');
			$tClienteNatural->pais=Input::get('txtPais');
			$tClienteNatural->departamento=Input::get('txtDepartamento');
			$tClienteNatural->provincia=Input::get('txtProvincia');
			$tClienteNatural->distrito=Input::get('txtDistrito');
			$tClienteNatural->direccion=Input::get('txtDireccion');
			$tClienteNatural->manzana=Input::get('txtManzana');
			$tClienteNatural->lote=Input::get('txtLote');
			$tClienteNatural->numeroVivienda=Input::get('txtNumeroVivienda');
			$tClienteNatural->numeroInterior=Input::get('txtNumeroInterior');
			$tClienteNatural->telefono=Input::get('txtTelefono');
			$tClienteNatural->sexo=Input::get('radioSexo');
			$tClienteNatural->correo=Input::get('txtCorreo');
			$tClienteNatural->fechaNacimiento=Input::get('txtFechaNacimiento');

			$tClienteNatural->save();

			return View::make('clientenatural.insertar', ['color' => '#1497CC', 'mensajeGlobal' => 'Operación realizada correctamente']);
		}
		return View::make('clientenatural.insertar');
	}

	public function actionVer()
	{
		$listaTClienteNatural=TClienteNatural::all();
		return View::make('clientenatural.ver', ['listaTClienteNatural' => $listaTClienteNatural]);
	}

	public function actionVerDetalle()
	{
		$tClienteNatural=TClienteNatural::find(Input::get('codigo'));
		return View::make('clientenatural.verdetalle', ['tClienteNatural' => $tClienteNatural]);
	}

	public function actionEditar()
	{
		if(Input::has('txtCodigoClienteNatural'))
		{
			$valorRetorno=false;
			if(TClienteNatural::whereRaw('codigoClienteNatural!=? and dni=?', [Input::get('txtCodigoClienteNatural'), Input::get('txtDni')])->count()>0)
			{
				$valorRetorno=true;
			}
			if($valorRetorno)
			{
				$listaTClienteNatural=TClienteNatural::all();
				return View::make('clientenatural.ver', ['color' => 'red', 'mensajeGlobal' => 'Cliente Natural Existente', 'listaTClienteNatural' => $listaTClienteNatural]);
			}
			TClienteNatural::where('codigoClienteNatural', '=', Input::get('txtCodigoClienteNatural'))->update(array
			(
				'dni' => Input::get('txtDni'),
				'nombre' => Input::get('txtNombre'),
				'apellidoPaterno' => Input::get('txtApellidoPaterno'),
				'apellidoMaterno' => Input::get('txtApellidoMaterno'),
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
				'sexo' => Input::get('radioSexo'),
				'correo' => Input::get('txtCorreo'),
				'fechaNacimiento' => Input::get('txtFechaNacimiento')
			));

			$listaTClienteNatural=TClienteNatural::all();

			return View::make('clientenatural.ver', ['color' => '#1497CC', 'mensajeGlobal' => 'Operación realizada correctamente', 'listaTClienteNatural' => $listaTClienteNatural]);
		}
		else
		{
			$tClienteNatural=TClienteNatural::find(Input::get('codigo'));
			return View::make('clientenatural.editar', ['tClienteNatural' => $tClienteNatural]);
		}
	}

	public function actionListaBuscarClienteNaturalPorDniNombreApellidoPaternoApellidoMaterno()
	{
		$palabras=explode(' ', Input::get('dniNombreApellidoPaternoApellidoMaterno'));
		$palabrasTratadas='';
		
		foreach($palabras as $value)
		{
			if($value!='')
			{
				$palabrasTratadas.=' '.$value;
			}
		}

		$palabrasTratadas=substr($palabrasTratadas, 1);
		$palabrasTratadas=explode(' ', $palabrasTratadas);

		$consultaSql='';
		$parametros=[];

		foreach($palabrasTratadas as $value)
		{
			$consultaSql.=' and replace(concat(nombre, apellidoPaterno, apellidoMaterno), " ", "") like ?';
			array_push($parametros, '%'.$value.'%');
		}

		$consultaSql='(('.substr($consultaSql, 5).') or dni=?)';
		array_push($parametros, Input::get('dniNombreApellidoPaternoApellidoMaterno'));

		$listaTClienteNatural=TClienteNatural::whereRaw($consultaSql.' order by nombre asc limit ?', [$parametros, 20])->get();
		
		return View::make('clientenatural/listabuscarclientenaturalpordninombreapellidopaternoapellidomaterno', ['listaTClienteNatural' => $listaTClienteNatural]);
	}
}
?>