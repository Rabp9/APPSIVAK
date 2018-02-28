<?php
class PresentacionController extends BaseController
{
	public function actionInsertar()
	{
		if($_POST)
		{
			$validator=Validator::make
			(
				['nombre' => Input::get('txtNombre')],
			    ['nombre' => ['unique:TPresentacion']]
			);

			if($validator->fails())
			{
				return View::make('presentacion.insertar', Input::all(), ['color' => 'red', 'mensajeGlobal' => 'Nombre de presentación existente']);
			}

			$tPresentacion=new TPresentacion;

			$tPresentacion->nombre=Input::get('txtNombre');
			$tPresentacion->descripcion=Input::get('txtDescripcion');

			$tPresentacion->save();

			return View::make('presentacion.insertar', ['color' => '#1497CC', 'mensajeGlobal' => 'Operación realizada correctamente']);
		}

		return View::make('presentacion.insertar');
	}

	public function actionVer()
	{
		$listaTPresentacion=TPresentacion::all();

		return View::make('presentacion.ver', ['listaTPresentacion' => $listaTPresentacion]);
	}

	public function actionEditar()
	{
		if(Input::has('txtCodigoPresentacion'))
		{
			try
			{
				DB::beginTransaction();

				$registroExiste=false;

				if(TPresentacion::whereRaw('codigoPresentacion!=? and nombre=?', [Input::get('txtCodigoPresentacion'), Input::get('txtNombre')])->count()>0)
				{
					$registroExiste=true;
				}

				if($registroExiste)
				{
					$listaTPresentacion=TPresentacion::all();

					return View::make('presentacion.ver', ['color' => 'red', 'mensajeGlobal' => 'El nombre de la presentación ingresada existente', 'listaTPresentacion' => $listaTPresentacion]);
				}

				$tPresentacion=TPresentacion::find(Input::get('txtCodigoPresentacion'));

				$tOficinaProducto=TOficinaProducto::whereRaw('presentacion=?', [$tPresentacion->nombre])->update(
				[
					'presentacion' => Input::get('txtNombre')
				]);

				$tPresentacion->nombre=Input::get('txtNombre');
				$tPresentacion->descripcion=Input::get('txtDescripcion');

				$tPresentacion->save();

				$listaTPresentacion=TPresentacion::all();

				DB::commit();

				return View::make('presentacion.ver', ['color' => '#1497CC', 'mensajeGlobal' => 'Operación realizada correctamente', 'listaTPresentacion' => $listaTPresentacion]);
			}
			catch(Exception $ex)
			{
				DB::rollback();

				$listaTPresentacion=TPresentacion::all();

				return View::make('presentacion.ver', Input::all(), ['color' => 'red', 'mensajeGlobal' => 'Ocurrió un error inesperado. Por favor contacte con el administrador del sistema', 'listaTPresentacion' => $listaTPresentacion]);
			}
		}
		else
		{
			$tPresentacion=TPresentacion::find(Input::get('codigo'));

			return View::make('presentacion.editar', ['tPresentacion' => $tPresentacion]);
		}
	}

	public function actionInsertarConAjax()
	{
		if(Input::has('txtNombre'))
		{
			$validator=Validator::make
			(
				['nombre' => Input::get('txtNombre')],
			    ['nombre' => ['unique:TPresentacion']]
			);

			if($validator->fails())
			{
				$listaTPresentacion=TPresentacion::all();

				return View::make('presentacion/verselect', ['color' => 'red', 'mensajeGlobal' => 'Nombre de presentación existente', 'listaTPresentacion' => $listaTPresentacion]);
			}

			$tPresentacion=new TPresentacion;

			$tPresentacion->nombre=Input::get('txtNombre');
			$tPresentacion->descripcion=Input::get('txtDescripcion');

			$tPresentacion->save();

			$listaTPresentacion=TPresentacion::all();

			return View::make('presentacion/verselect', ['color' => '#1497CC', 'mensajeGlobal' => 'Presentación agregada', 'listaTPresentacion' => $listaTPresentacion]);
		}

		return View::make('presentacion/insertarconajax');
	}
}
?>