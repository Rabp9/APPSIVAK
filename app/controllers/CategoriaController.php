<?php
class CategoriaController extends BaseController
{
	public function actionInsertar()
	{
		if($_POST)
		{
			$validator=Validator::make
			(
				['nombre' => Input::get('txtNombre')],
			    ['nombre' => ['unique:TCategoria']]
			);
			if($validator->fails())
			{
				return View::make('categoria.insertar', Input::all(), ['color' => 'red', 'mensajeGlobal' => 'Nombre de categoría existente']);
			}
			$tCategoria=new TCategoria;
			$tCategoria->nombre=Input::get('txtNombre');
			$tCategoria->descripcion=Input::get('txtDescripcion');
			$tCategoria->codigoCategoriaPadre=Input::get('txtCodigoCategoria_Padre');

			$tCategoria->save();
			return View::make('categoria.insertar', ['color' => '#1497CC', 'mensajeGlobal' => 'Operación realizada correctamente']);
		}
		return View::make('categoria.insertar');
	}

	public function actionVerCategoriaPadre()
	{
		$listaTCategoria=TCategoria::whereRaw('codigoCategoriaPadre=?', ['CATEGORI0000000'])->get();
		return View::make('categoria.vercategoriapadre', ['listaTCategoria' => $listaTCategoria]);
	}

	public function actionVerPorCodigoCategoriaPadre()
	{
		$listaTCategoria=TCategoria::whereRaw('codigoCategoriaPadre=?', [Input::get('codigo')])->get();
		return View::make('categoria.verporcodigocategoriapadre', ['listaTCategoria' => $listaTCategoria]);
	}

	public function actionEditar()
	{
		if(Input::has('txtCodigoCategoria'))
		{
			$registroExiste=false;
			if(TCategoria::whereRaw('codigoCategoria!=? and nombre=?', [Input::get('txtCodigoCategoria'), Input::get('txtNombre')])->count()>0)
			{
				$registroExiste=true;
			}
			if($registroExiste)
			{
				$listaTCategoria=TCategoria::whereRaw('codigoCategoriaPadre=?', ['CATEGORI0000000'])->get();
				return View::make('categoria.vercategoriapadre', ['color' => 'red', 'mensajeGlobal' => 'El nombre de la categoria ingresada existente', 'listaTCategoria' => $listaTCategoria]);
			}
			TCategoria::where('codigoCategoria', '=', Input::get('txtCodigoCategoria'))->update(array
			(
				'nombre' => Input::get('txtNombre'),
				'descripcion' => Input::get('txtDescripcion')
			));

			$listaTCategoria=TCategoria::whereRaw('codigoCategoriaPadre=?', ['CATEGORI0000000'])->get();

			return View::make('categoria.vercategoriapadre', ['color' => '#1497CC', 'mensajeGlobal' => 'Operación realizada correctamente', 'listaTCategoria' => $listaTCategoria]);
		}
		else
		{
			$tCategoria=TCategoria::find(Input::get('codigo'));
			return View::make('categoria.editar', ['tCategoria' => $tCategoria]);
		}
	}

	public function actionBuscarCategoriaPorCodigoCategoriaPadre()
	{
		$listaTCategoria=TCategoria::whereRaw('codigoCategoriaPadre=?', [Input::get('codigo')])->get();
		return View::make('categoria.buscarcategoriaporcodigocategoriapadre', ['listaTCategoria' => $listaTCategoria]);
	}
}
?>