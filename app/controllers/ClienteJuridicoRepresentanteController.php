<?php
class ClienteJuridicoRepresentanteController extends BaseController
{
	public function actionInsertar()
	{
		if($_POST)
		{
			$validator=Validator::make
			(
				['dni' => Input::get('txtDni')],
			    ['dni' => ['unique:TClienteJuridicoRepresentante,dni,null,id,codigoClienteJuridico,'.Input::get('txtCodigoClienteJuridico')]]
			);
			if($validator->fails())
			{
				return View::make('clientejuridicorepresentante.insertar', Input::all(), ['color' => 'red', 'mensajeGlobal' => 'Representante Existente Para el Cliente Jurídico Seleccionado']);
			}
			$tClienteJuridicoRepresentante=new TClienteJuridicoRepresentante;
			$tClienteJuridicoRepresentante->codigoClienteJuridico=Input::get('txtCodigoClienteJuridico');
			$tClienteJuridicoRepresentante->dni=Input::get('txtDni');
			$tClienteJuridicoRepresentante->nombreCompleto=Input::get('txtNombreCompleto');
			$tClienteJuridicoRepresentante->cargo=Input::get('txtCargo');
			$tClienteJuridicoRepresentante->correo=Input::get('txtCorreo');
			$tClienteJuridicoRepresentante->domicilio=Input::get('txtDomicilio');

			$tClienteJuridicoRepresentante->save();

			return View::make('clientejuridicorepresentante.insertar', ['color' => '#1497CC', 'mensajeGlobal' => 'Operación realizada correctamente']);
		}
		return View::make('clientejuridicorepresentante.insertar');
	}

	public function actionVer()
	{
		$listaTClienteJuridicoRepresentante=TClienteJuridicoRepresentante::all();
		return View::make('clientejuridicorepresentante.ver', ['listaTClienteJuridicoRepresentante' => $listaTClienteJuridicoRepresentante]);
	}

	public function actionVerPorCodigoClienteJuridico()
	{
		$listaTClienteJuridicoRepresentante=TClienteJuridicoRepresentante::whereRaw('codigoClienteJuridico=?', [Input::get('codigo')])->get();
		return View::make('clientejuridicorepresentante.verporcodigoclientejuridico', ['listaTClienteJuridicoRepresentante' => $listaTClienteJuridicoRepresentante]);
	}

	public function actionEditar()
	{
		if(Input::has('txtCodigoClienteJuridicoRepresentante'))
		{
			$valorRetorno=false;
			if(TClienteJuridicoRepresentante::whereRaw('codigoClienteJuridicoRepresentante!=? and codigoClienteJuridico=? and dni=?', [Input::get('txtCodigoClienteJuridicoRepresentante'), Input::get('txtCodigoClienteJuridico'), Input::get('txtDni')])->count()>0)
			{
				$valorRetorno=true;
			}
			if($valorRetorno)
			{
				$listaTClienteJuridico=TClienteJuridico::all();
				return View::make('clientejuridico.ver', ['color' => 'red', 'mensajeGlobal' => 'Representante Jurídico Existente en el Cliente Jurídico Seleccionado', 'listaTClienteJuridico' => $listaTClienteJuridico]);
			}
			TClienteJuridicoRepresentante::where('codigoClienteJuridicoRepresentante', '=', Input::get('txtCodigoClienteJuridicoRepresentante'))->update(array
			(
				'dni' => Input::get('txtDni'),
				'nombreCompleto' => Input::get('txtNombreCompleto'),
				'cargo' => Input::get('txtCargo'),
				'correo' => Input::get('txtCorreo'),
				'domicilio' => Input::get('txtDomicilio')
			));

			$listaTClienteJuridico=TClienteJuridico::all();

			return View::make('clientejuridico.ver', ['color' => '#1497CC', 'mensajeGlobal' => 'Operación realizada correctamente', 'listaTClienteJuridico' => $listaTClienteJuridico]);
		}
		else
		{
			$tClienteJuridicoRepresentante=TClienteJuridicoRepresentante::find(Input::get('codigo'));
			return View::make('clientejuridicorepresentante.editar', ['tClienteJuridicoRepresentante' => $tClienteJuridicoRepresentante]);
		}
	}
}
?>