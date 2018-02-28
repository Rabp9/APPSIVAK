<?php
class AlmacenProductoController extends BaseController
{
	public function actionVerTodoAgrupado()
	{
		$listaTAlmacenProducto=TAlmacenProducto::groupBy('codigoBarras', 'primerNombre', 'segundoNombre', 'tercerNombre', 'tipo', 'codigoPresentacion', 'codigoUnidadMedida')->get();

		if(Session::has('mensajeRedirect'))
		{
			return View::make('almacenproducto/vertodoagrupado', ['color' => '#1497CC', 'mensajeGlobal' => Session::get('mensajeRedirect'), 'listaTAlmacenProducto' => $listaTAlmacenProducto]);
		}

		if(Session::has('mensajeRedirectError'))
		{
			return View::make('almacenproducto/vertodoagrupado', ['color' => 'red', 'mensajeGlobal' => Session::get('mensajeRedirectError'), 'listaTAlmacenProducto' => $listaTAlmacenProducto]);
		}

		return View::make('almacenproducto/vertodoagrupado', ['listaTAlmacenProducto' => $listaTAlmacenProducto]);
	}

	public function actionListaBuscarAlmacenProductoAgrupadoPorNombre()
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

		$listaTAlmacenProducto=TAlmacenProducto::whereRaw('estado=?'.$consultaSql.' group by codigoBarras, primerNombre, segundoNombre, tercerNombre, tipo, codigoPresentacion, codigoUnidadMedida order by primerNombre asc limit ?', [true, $parametros, 20])->get();
		
		return View::make('almacenproducto/listabuscaralmacenproductoagrupadopornombre', ['listaTAlmacenProducto' => $listaTAlmacenProducto]);
	}

	public function actionListaBuscarAlmacenProductoPorCodigoAlmacenNombre()
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

		$listaTAlmacenProducto=TAlmacenProducto::whereRaw('codigoAlmacen=? and estado=?'.$consultaSql.' order by primerNombre asc limit ?', [Input::get('codigoAlmacen'), true, $parametros, 20])->get();
		
		return View::make('almacenproducto/listabuscaralmacenproducto', ['listaTAlmacenProducto' => $listaTAlmacenProducto]);
	}

	public function actionListaBuscarAlmacenProductoPorCodigoBarras()
	{
		$listaTAlmacenProducto=TAlmacenProducto::whereRaw('codigoAlmacen=? and estado=? and codigoBarras=?', [Input::get('codigoAlmacen'), true, Input::get('codigoBarras')])->get();
		
		return View::make('almacenproducto/listabuscaralmacenproducto', ['listaTAlmacenProducto' => $listaTAlmacenProducto]);
	}

	public function actionVerPorCodigoAlmacen()
	{
		$listaTAlmacenProducto=TAlmacenProducto::whereRaw('codigoAlmacen=?', [explode(',', Session::get('local'))[0]])->get();
		
		return View::make('almacenproducto/verporcodigoalmacen', ['listaTAlmacenProducto' => $listaTAlmacenProducto]);
	}

	public function actionEditarTodosLocales()
	{
		if(Input::has('txtEditarProducto'))
		{
			try
			{
				DB::beginTransaction();

				$mensajeGlobal='';

				$datosComparacionProductoAnteriorAlmacen=Input::get('txtCodigoPresentacionHidden').Input::get('txtCodigoUnidadMedidaHidden').Input::get('txtCodigoBarrasHidden').Input::get('txtPrimerNombreHidden').Input::get('txtSegundoNombreHidden').Input::get('txtTercerNombreHidden').Input::get('txtTipoHidden');
				$datosComparacionProductoAnteriorAlmacen=str_replace(' ', '', $datosComparacionProductoAnteriorAlmacen);

				$datosComparacionProductoNuevo=Input::get('cbxCodigoPresentacion').Input::get('cbxCodigoUnidadMedida').Input::get('txtCodigoBarras').Input::get('txtPrimerNombre').Input::get('txtSegundoNombre').Input::get('txtTercerNombre').Input::get('cbxTipo');
				$datosComparacionProductoNuevo=str_replace(' ', '', $datosComparacionProductoNuevo);

				if(TAlmacenProducto::whereRaw('replace(concat(codigoPresentacion, codigoUnidadMedida, codigoBarras, primerNombre, segundoNombre, tercerNombre, tipo), " ", "")=? and replace(concat(codigoPresentacion, codigoUnidadMedida, codigoBarras, primerNombre, segundoNombre, tercerNombre, tipo), " ", "")!=?', [$datosComparacionProductoNuevo, $datosComparacionProductoAnteriorAlmacen])->count()>0)
				{
					$mensajeGlobal.='Los datos del producto se está repitiendo en los registros. Por favor corrija los datos<br>';
				}

				if(TAlmacenProducto::whereRaw('replace(concat(codigoPresentacion, codigoUnidadMedida, codigoBarras, primerNombre, segundoNombre, tercerNombre, tipo), " ", "")!=? and codigoBarras=? and codigoBarras!=?', [$datosComparacionProductoAnteriorAlmacen, Input::get('txtCodigoBarras'), ''])->count()>0)
				{
					$mensajeGlobal.='El código de barras, ya se encuentra asignado a otro producto<br>';
				}

				if($mensajeGlobal!='')
				{
					return Redirect::to('almacenproducto/vertodoagrupado')->with('mensajeRedirectError', $mensajeGlobal);
				}

				$tAlmacenProducto=TAlmacenProducto::whereRaw('replace(concat(codigoPresentacion, codigoUnidadMedida, codigoBarras, primerNombre, segundoNombre, tercerNombre, tipo), " ", "")=?', [$datosComparacionProductoAnteriorAlmacen])
					->update(
					[
						'codigoBarras' => Input::get('txtCodigoBarras'),
						'primerNombre' => Input::get('txtPrimerNombre'),
						'segundoNombre' => Input::get('txtSegundoNombre'),
						'tercerNombre' => Input::get('txtTercerNombre'),
						'codigoPresentacion' => Input::get('cbxCodigoPresentacion'),
						'codigoUnidadMedida' => Input::get('cbxCodigoUnidadMedida'),
						'tipo' => Input::get('cbxTipo'),
						'ventaMenorUnidad' => Input::get('radioVentaMenorUnidadProducto')=='Si' ? true : false,
						'unidadesBloque' => Input::get('txtUnidadesBloque'),
						'unidadMedidaBloque' => Input::get('txtUnidadMedidaBloque'),
						'estado' => (Input::get('cbxEstado')=='Habilitado') ? true : false
					]);

				$datosComparacionProductoAnteriorOficina=Input::get('txtNombrePresentacionHidden').Input::get('txtNombreUnidadMedidaHidden').Input::get('txtCodigoBarrasHidden').Input::get('txtPrimerNombreHidden').Input::get('txtSegundoNombreHidden').Input::get('txtTercerNombreHidden').Input::get('txtTipoHidden');
				$datosComparacionProductoAnteriorOficina=str_replace(' ', '', $datosComparacionProductoAnteriorOficina);

				$tPresentacion=TPresentacion::find(Input::get('cbxCodigoPresentacion'));
				$tUnidadMedida=TUnidadMedida::find(Input::get('cbxCodigoUnidadMedida'));

				TOficinaProducto::whereRaw('replace(concat(presentacion, unidadMedida, codigoBarras, primerNombre, segundoNombre, tercerNombre, tipo), " ", "")=?', [$datosComparacionProductoAnteriorOficina])
					->update(
					[
						'codigoBarras' => Input::get('txtCodigoBarras'),
						'primerNombre' => Input::get('txtPrimerNombre'),
						'segundoNombre' => Input::get('txtSegundoNombre'),
						'tercerNombre' => Input::get('txtTercerNombre'),
						'presentacion' => $tPresentacion->nombre,
						'unidadMedida' => $tUnidadMedida->nombre,
						'tipo' => Input::get('cbxTipo'),
						'ventaMenorUnidad' => Input::get('radioVentaMenorUnidadProducto')=='Si' ? true : false,
						'unidadesBloque' => Input::get('txtUnidadesBloque'),
						'unidadMedidaBloque' => Input::get('txtUnidadMedidaBloque'),
						'estado' => (Input::get('cbxEstado')=='Habilitado') ? true : false
					]);

				$listaTAlmacenProducto=TAlmacenProducto::groupBy('codigoBarras', 'primerNombre', 'segundoNombre', 'tercerNombre', 'tipo', 'codigoPresentacion', 'codigoUnidadMedida')->get();

				DB::commit();

				return View::make('almacenproducto/vertodoagrupado', ['color' => '#1497CC', 'mensajeGlobal' => 'Datos actualizados correctamente', 'listaTAlmacenProducto' => $listaTAlmacenProducto]);
			}
			catch(Exception $ex)
			{
				DB::rollback();

				return Redirect::to('almacenproducto/vertodoagrupado')->with('mensajeRedirectError', 'Ocurrió un error inesperado. Por favor contacte con el administrador del sistema');
			}
		}

		$listaTPresentacion=TPresentacion::all();
		$listaTUnidadMedida=TUnidadMedida::all();

		return View::make('almacenproducto/editartodoslocales', Input::all(), ['listaTPresentacion' => $listaTPresentacion, 'listaTUnidadMedida' => $listaTUnidadMedida]);
	}

	public function actionEditar()
	{
		if(Input::has('txtCodigoAlmacenProducto'))
		{
			$tAlmacenProducto=TAlmacenProducto::find(Input::get('txtCodigoAlmacenProducto'));

			$tAlmacenProducto->descripcion=Input::get('txtDescripcion');
			$tAlmacenProducto->precioVentaUnitario=Input::get('txtPrecioVentaUnitario');
			$tAlmacenProducto->fechaVencimiento=Input::get('txtFechaVencimiento');

			$tAlmacenProducto->save();

			$listaTAlmacenProducto=TAlmacenProducto::whereRaw('codigoAlmacen=?', [explode(',', Session::get('local'))[0]])->get();

			return View::make('almacenproducto/verporcodigoalmacen', ['color' => '#1497CC', 'mensajeGlobal' => 'Datos actualizados correctamente', 'listaTAlmacenProducto' => $listaTAlmacenProducto]);
		}

		$tAlmacenProducto=TAlmacenProducto::find(Input::get('codigo'));
		$listaTPresentacion=TPresentacion::all();
		$listaTUnidadMedida=TUnidadMedida::all();

		return View::make('almacenproducto/editar', ['tAlmacenProducto' => $tAlmacenProducto, 'listaTPresentacion' => $listaTPresentacion, 'listaTUnidadMedida' => $listaTUnidadMedida]);
	}

	public function actionAdministrarCategoria($codigoAlmacenProducto)
	{
		$tAlmacenProducto=TAlmacenProducto::find($codigoAlmacenProducto);
		$datosComparacionProducto=$tAlmacenProducto->codigoPresentacion.$tAlmacenProducto->codigoUnidadMedida.$tAlmacenProducto->codigoBarras.$tAlmacenProducto->primerNombre.$tAlmacenProducto->segundoNombre.$tAlmacenProducto->tercerNombre.$tAlmacenProducto->tipo;
		$listaTAlmacenProducto=TAlmacenProducto::whereRaw('concat(codigoPresentacion, codigoUnidadMedida, codigoBarras, primerNombre, segundoNombre, tercerNombre, tipo)=?', [$datosComparacionProducto])->get();

		if($_POST)
		{
			if(Input::get('arrayAsignados')!='')
			{
				$arrayAsignados=explode(',', Input::get('arrayAsignados'));

				foreach ($arrayAsignados as $key => $value) 
				{
					foreach($listaTAlmacenProducto as $index => $item)
					{
						if(TAlmacenProductoTCategoria::whereRaw('codigoCategoria=? and codigoAlmacenProducto=?', [$value, $item->codigoAlmacenProducto])->count()==1)
						{
							continue;
						}

						$tAlmacenProductoTCategoria=new TAlmacenProductoTCategoria;
						$tAlmacenProductoTCategoria->codigoAlmacenProducto=$item->codigoAlmacenProducto;
						$tAlmacenProductoTCategoria->codigoCategoria=$value;
						$tAlmacenProductoTCategoria->save();
					}
				}
			}

			if(Input::get('arrayEliminados')!='')
			{
				$arrayEliminados=explode(',', Input::get('arrayEliminados'));
				foreach ($arrayEliminados as $key => $value) 
				{
					foreach($listaTAlmacenProducto as $index => $item)
					{
						TAlmacenProductoTCategoria::whereRaw('codigoCategoria=? and codigoAlmacenProducto=?', [$value, $item->codigoAlmacenProducto])->delete();
					}
				}
			}
			
			return Redirect::to('almacenproducto/vertodoagrupado')->with('mensajeRedirect', 'Operación realizada correctamente');
		}
		
		$listaTCategoriaHijoNoAsignado=TCategoria::whereRaw('codigoCategoria not in (select codigoCategoria from TAlmacenProductoTCategoria where codigoAlmacenProducto=?) and codigoCategoriaPadre!=?', [$codigoAlmacenProducto, 'CATEGORI0000000'])->get();
		$listaTCategoriaHijoAsignado=TCategoria::whereRaw('codigoCategoria in (select codigoCategoria from TAlmacenProductoTCategoria where codigoAlmacenProducto=?) and codigoCategoriaPadre!=?', [$codigoAlmacenProducto, 'CATEGORI0000000'])->get();
		
		return View::make('almacenproducto/administrarcategoria', ['tAlmacenProducto' => $tAlmacenProducto, 'listaTCategoriaHijoNoAsignado' => $listaTCategoriaHijoNoAsignado, 'listaTCategoriaHijoAsignado' => $listaTCategoriaHijoAsignado]);
	}

	public function actionSincronizarCategorias()
	{
		try
		{
			DB::beginTransaction();

			$listaTCategoriaHijo=TCategoria::whereRaw('codigoCategoriaPadre!=?', ['CATEGORI0000000'])->get();

			$arrayCategoria=[];

			foreach($listaTCategoriaHijo as $key => $value)
			{
				$arrayCategoria[$value->codigoCategoria]=$value->nombre;
			}

			$listaTAlmacenProducto=TAlmacenProducto::groupBy('codigoBarras', 'primerNombre', 'segundoNombre', 'tercerNombre', 'tipo', 'codigoPresentacion', 'codigoUnidadMedida')->get();

			foreach($listaTAlmacenProducto as $key => $value)
			{
				$listaCategoriaAsignada=TAlmacenProductoTCategoria::whereRaw('codigoAlmacenProducto=?', [$value->codigoAlmacenProducto])->get();

				$categoriaAsignada='';

				foreach($listaCategoriaAsignada as $key2 => $item)
				{
					$categoriaAsignada=$categoriaAsignada.$arrayCategoria[$item->codigoCategoria].',';
				}

				if($categoriaAsignada!='')
				{
					$categoriaAsignada=substr($categoriaAsignada, 0, (strlen($categoriaAsignada)-1));
				}

				$datosComparacionProducto=($value->tPresentacion->nombre).($value->tUnidadMedida->nombre).($value->primerNombre).($value->segundoNombre).($value->tercerNombre).($value->tipo);
				$datosComparacionProducto=str_replace(' ', '', $datosComparacionProducto);

				TOficinaProducto::whereRaw('replace(concat(presentacion, unidadMedida, primerNombre, segundoNombre, tercerNombre, tipo), " ", "")=?', [$datosComparacionProducto])
					->update(
					[
						'categoria' => $categoriaAsignada
					]);
			}

			DB::commit();

			return Redirect::to('almacenproducto/vertodoagrupado')->with('mensajeRedirect', 'Sincronización de cateogrías correcta');
		}
		catch(Exception $ex)
		{
			DB::rollback();

			return Redirect::to('almacenproducto/vertodoagrupado')->with('mensajeRedirectError', 'Ocurrió un error inesperado. Por favor contacte con el administrador del sistema');
		}
	}
}
?>