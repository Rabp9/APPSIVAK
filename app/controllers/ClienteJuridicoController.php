<?php
class ClienteJuridicoController extends BaseController
{
	public function actionInsertar()
	{
		if($_POST)
		{
			$validator=Validator::make
			(
				['ruc' => Input::get('txtRuc')],
			    ['ruc' => ['unique:TClienteJuridico']]
			);
			if($validator->fails())
			{
				return View::make('clientejuridico.insertar', Input::all(), ['color' => 'red', 'mensajeGlobal' => 'Cliente Existente']);
			}
			$tClienteJuridico=new TClienteJuridico;
			$tClienteJuridico->codigoOficina=Input::get('txtCodigoOficina');
			$tClienteJuridico->ruc=Input::get('txtRuc');
			$tClienteJuridico->razonSocialCorta=Input::get('txtRazonSocialCorta');
			$tClienteJuridico->razonSocialLarga=Input::get('txtRazonSocialLarga');
			$tClienteJuridico->residePais=Input::get('radioResidePais');
			$tClienteJuridico->fechaConstitucion=Input::get('txtFechaConstitucion');
			$tClienteJuridico->pais=Input::get('txtPais');
			$tClienteJuridico->departamento=Input::get('txtDepartamento');
			$tClienteJuridico->provincia=Input::get('txtProvincia');
			$tClienteJuridico->distrito=Input::get('txtDistrito');
			$tClienteJuridico->direccion=Input::get('txtDireccion');
			$tClienteJuridico->manzana=Input::get('txtManzana');
			$tClienteJuridico->lote=Input::get('txtLote');
			$tClienteJuridico->numeroVivienda=Input::get('txtNumeroVivienda');
			$tClienteJuridico->numeroInterior=Input::get('txtNumeroInterior');
			$tClienteJuridico->telefono=Input::get('txtTelefono');
			$tClienteJuridico->correo=Input::get('txtCorreo');

			$tClienteJuridico->save();

			return View::make('clientejuridico.insertar', ['color' => '#1497CC', 'mensajeGlobal' => 'Operación realizada correctamente']);
		}
		return View::make('clientejuridico.insertar');
	}

	public function actionVer()
	{
		$listaTClienteJuridico=TClienteJuridico::all();
		return View::make('clientejuridico.ver', ['listaTClienteJuridico' => $listaTClienteJuridico]);
	}

	public function actionVerDetalle()
	{
		$tClienteJuridico=TClienteJuridico::find(Input::get('codigo'));
		return View::make('clientejuridico.verdetalle', ['tClienteJuridico' => $tClienteJuridico]);
	}

	public function actionEditar()
	{
		if(Input::has('txtCodigoClienteJuridico'))
		{
			$valorRetorno=false;
			if(TClienteJuridico::whereRaw('codigoClienteJuridico!=? and ruc=?', [Input::get('txtCodigoClienteJuridico'), Input::get('txtRuc')])->count()>0)
			{
				$valorRetorno=true;
			}
			if($valorRetorno)
			{
				$listaTClienteJuridico=TClienteJuridico::all();
				return View::make('clientejuridico.ver', ['color' => 'red', 'mensajeGlobal' => 'Cliente Jurídico Existente', 'listaTClienteJuridico' => $listaTClienteJuridico]);
			}
			TClienteJuridico::where('codigoClienteJuridico', '=', Input::get('txtCodigoClienteJuridico'))->update(array
			(
				'ruc' => Input::get('txtRuc'),
				'razonSocialCorta' => Input::get('txtRazonSocialCorta'),
				'razonSocialLarga' => Input::get('txtRazonSocialLarga'),
				'residePais' => Input::get('radioResidePais'),
				'fechaConstitucion' => Input::get('txtFechaConstitucion'),
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
				'correo' => Input::get('txtCorreo')
			));

			$listaTClienteJuridico=TClienteJuridico::all();

			return View::make('clientejuridico.ver', ['color' => '#1497CC', 'mensajeGlobal' => 'Operación realizada correctamente', 'listaTClienteJuridico' => $listaTClienteJuridico]);
		}
		else
		{
			$tClienteJuridico=TClienteJuridico::find(Input::get('codigo'));
			return View::make('clientejuridico.editar', ['tClienteJuridico' => $tClienteJuridico]);
		}
	}

	public function actionListaBuscarClienteJuridicoPorRucRazonSocialLarga()
	{
		$palabras=explode(' ', Input::get('rucRazonSocialLarga'));
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
			$consultaSql.=' and replace(razonSocialLarga, " ", "") like ?';
			array_push($parametros, '%'.$value.'%');
		}

		$consultaSql='(('.substr($consultaSql, 5).') or ruc=?)';
		array_push($parametros, Input::get('rucRazonSocialLarga'));

		$listaTClienteJuridico=TClienteJuridico::whereRaw($consultaSql.' order by razonSocialLarga asc limit ?', [$parametros, 20])->get();
		
		return View::make('clientejuridico/listabuscarclientejuridicoporrucrazonsociallarga', ['listaTClienteJuridico' => $listaTClienteJuridico]);
	}
}
?>