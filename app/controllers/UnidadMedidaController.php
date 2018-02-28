<?php
class UnidadMedidaController extends BaseController
{
	public function actionInsertar()
	{
		if($_POST)
		{
			$validator=Validator::make
			(
				['nombre' => Input::get('txtNombre')],
			    ['nombre' => ['unique:TUnidadMedida']]
			);

			if($validator->fails())
			{
				return View::make('unidadmedida.insertar', Input::all(), ['color' => 'red', 'mensajeGlobal' => 'Nombre de unidad de medida existente']);
			}

			$tUnidadMedida=new TUnidadMedida;

			$tUnidadMedida->nombre=Input::get('txtNombre');
			$tUnidadMedida->descripcion=Input::get('txtDescripcion');

			$tUnidadMedida->save();

			return View::make('unidadmedida.insertar', ['color' => '#1497CC', 'mensajeGlobal' => 'Operación realizada correctamente']);
		}

		return View::make('unidadmedida.insertar');
	}

	public function actionVer()
	{
		$listaTUnidadMedida=TUnidadMedida::all();
		return View::make('unidadmedida.ver', ['listaTUnidadMedida' => $listaTUnidadMedida]);
	}

	public function actionEditar()
	{
		if(Input::has('txtCodigoUnidadMedida'))
		{
			try
			{
				DB::beginTransaction();

				$registroExiste=false;

				if(TUnidadMedida::whereRaw('codigoUnidadMedida!=? and nombre=?', [Input::get('txtCodigoUnidadMedida'), Input::get('txtNombre')])->count()>0)
				{
					$registroExiste=true;
				}

				if($registroExiste)
				{
					$listaTUnidadMedida=TUnidadMedida::all();

					return View::make('unidadmedida.ver', ['color' => 'red', 'mensajeGlobal' => 'El nombre de la unidad de medida ingresada existe', 'listaTUnidadMedida' => $listaTUnidadMedida]);
				}

				$tUnidadMedida=TUnidadMedida::find(Input::get('txtCodigoUnidadMedida'));

				$tOficinaProducto=TOficinaProducto::whereRaw('unidadMedida=?', [$tUnidadMedida->nombre])->update(
				[
					'unidadMedida' => Input::get('txtNombre')
				]);

				$tUnidadMedida->nombre=Input::get('txtNombre');
				$tUnidadMedida->descripcion=Input::get('txtDescripcion');

				$tUnidadMedida->save();

				$listaTUnidadMedida=TUnidadMedida::all();

				DB::commit();

				return View::make('unidadmedida.ver', ['color' => '#1497CC', 'mensajeGlobal' => 'Operación realizada correctamente', 'listaTUnidadMedida' => $listaTUnidadMedida]);
			}
			catch(Exception $ex)
			{
				DB::rollback();

				$listaTUnidadMedida=TUnidadMedida::all();

				return View::make('unidadmedida.ver', Input::all(), ['color' => 'red', 'mensajeGlobal' => 'Ocurrió un error inesperado. Por favor contacte con el administrador del sistema', 'listaTUnidadMedida' => $listaTUnidadMedida]);
			}
		}
		else
		{
			$tUnidadMedida=TUnidadMedida::find(Input::get('codigo'));
			return View::make('unidadmedida.editar', ['tUnidadMedida' => $tUnidadMedida]);
		}
	}

	public function actionInsertarConAjax()
	{
		if(Input::has('txtNombre'))
		{
			$validator=Validator::make
			(
				['nombre' => Input::get('txtNombre')],
			    ['nombre' => ['unique:TUnidadMedida']]
			);

			if($validator->fails())
			{
				$listaTUnidadMedida=TUnidadMedida::all();

				return View::make('unidadmedida/verselect', ['color' => 'red', 'mensajeGlobal' => 'Nombre de unidad de medida existente', 'listaTUnidadMedida' => $listaTUnidadMedida]);
			}

			$tUnidadMedida=new TUnidadMedida;

			$tUnidadMedida->nombre=Input::get('txtNombre');
			$tUnidadMedida->descripcion=Input::get('txtDescripcion');

			$tUnidadMedida->save();

			$listaTUnidadMedida=TUnidadMedida::all();

			return View::make('unidadmedida/verselect', ['color' => '#1497CC', 'mensajeGlobal' => 'Unidad de medida agregada', 'listaTUnidadMedida' => $listaTUnidadMedida]);
		}

		return View::make('unidadmedida/insertarconajax');
	}
}
?>