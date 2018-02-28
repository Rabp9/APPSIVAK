<?php
class OficinaProductoController extends BaseController
{
	public function actionListaBuscarOficinaProductoPorCodigoOficinaNombre()
	{
		$palabras=explode(' ', Input::get('nombreCompletoProducto'));
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
			$consultaSql.=' and replace(concat(primerNombre, segundoNombre, tercerNombre), " ", "") like ?';
			array_push($parametros, '%'.$value.'%');
		}

		$consultaSql=' and (('.substr($consultaSql, 5).') or codigoBarras=?)';
		array_push($parametros, Input::get('nombreCompletoProducto'));

		$listaTOficinaProducto=TOficinaProducto::whereRaw('codigoOficina=? and estado=?'.$consultaSql.' order by primerNombre asc limit ?', [Input::get('codigoOficina'), true, $parametros, 20])->get();
		
		return View::make('oficinaproducto/listabuscaroficinaproducto', ['listaTOficinaProducto' => $listaTOficinaProducto]);
	}

	public function actionListaBuscarOficinaProductoPorCodigoBarras()
	{
		$listaTOficinaProducto=TOficinaProducto::whereRaw('codigoOficina=? and estado=? and codigoBarras=?', [Input::get('codigoOficina'), true, Input::get('codigoBarras')])->get();
		
		return View::make('oficinaproducto/listabuscaroficinaproducto', ['listaTOficinaProducto' => $listaTOficinaProducto]);
	}

	public function actionVerPorCodigoOficina()
	{
		$listaTOficinaProducto=TOficinaProducto::whereRaw('codigoOficina=?', [explode(',', Session::get('local'))[0]])->get();
		
		return View::make('oficinaproducto/verporcodigooficina', ['listaTOficinaProducto' => $listaTOficinaProducto]);
	}

	public function actionEditar()
	{
		if(Input::has('txtCodigoOficinaProducto'))
		{
			$tOficinaProducto=TOficinaProducto::find(Input::get('txtCodigoOficinaProducto'));

			$tOficinaProducto->descripcion=Input::get('txtDescripcion');
			$tOficinaProducto->precioVentaUnitario=Input::get('txtPrecioVentaUnitario');
			$tOficinaProducto->fechaVencimiento=Input::get('txtFechaVencimiento');

			$tOficinaProducto->save();

			$listaTOficinaProducto=TOficinaProducto::whereRaw('codigoOficina=?', [explode(',', Session::get('local'))[0]])->get();

			return View::make('oficinaproducto/verporcodigooficina', ['color' => '#1497CC', 'mensajeGlobal' => 'Datos actualizados correctamente', 'listaTOficinaProducto' => $listaTOficinaProducto]);
		}

		$tOficinaProducto=TOficinaProducto::find(Input::get('codigo'));
		$listaTPresentacion=TPresentacion::all();
		$listaTUnidadMedida=TUnidadMedida::all();

		return View::make('oficinaproducto/editar', ['tOficinaProducto' => $tOficinaProducto, 'listaTPresentacion' => $listaTPresentacion, 'listaTUnidadMedida' => $listaTUnidadMedida]);
	}
}
?>