<?php
class ProveedorProductoController extends BaseController
{
	public function actionInsertar()
	{
		if($_POST)
		{
			$validator=Validator::make
			(
				['nombre' => Input::get('txtNombre')],
			    ['nombre' => ['unique:TProveedorProducto,nombre,null,id,codigoProveedor,'.Input::get('txtCodigoProveedor')]]
			);
			if($validator->fails())
			{
				return View::make('proveedorproducto.insertar', Input::all(), ['color' => 'red', 'mensajeGlobal' => 'El producto ya fue registrado']);
			}
			$tProveedorProducto=new TProveedorProducto;
			$tProveedorProducto->codigoProveedor=Input::get('txtCodigoProveedor');
			$tProveedorProducto->nombre=Input::get('txtNombre');
			$tProveedorProducto->descripcion=Input::get('txtDescripcion');

			$tProveedorProducto->save();

			return View::make('proveedorproducto.insertar', ['color' => '#1497CC', 'mensajeGlobal' => 'Operación realizada correctamente']);
		}
		return View::make('proveedorproducto.insertar');
	}

	public function actionVerPorCodigoProveedor()
	{
		$listaTProveedorProducto=TProveedorProducto::whereRaw('codigoProveedor=?', [Input::get('codigo')])->get();
		return View::make('proveedorproducto.verporcodigoproveedor', ['listaTProveedorProducto' => $listaTProveedorProducto]);
	}

	public function actionEditar()
	{
		if(Input::has('txtCodigoProveedorProducto'))
		{
			$valorRetorno=false;
			if(TProveedorProducto::whereRaw('codigoProveedorProducto!=? and codigoProveedor=? and nombre=?', [Input::get('txtCodigoProveedorProducto'), Input::get('txtCodigoProveedor'), Input::get('txtNombre')])->count()>0)
			{
				$valorRetorno=true;
			}
			if($valorRetorno)
			{
				$listaTProveedor=TProveedor::all();
				return View::make('proveedor.ver', ['color' => 'red', 'mensajeGlobal' => 'Nombre de producto existente', 'listaTProveedor' => $listaTProveedor]);
			}
			TProveedorProducto::where('codigoProveedorProducto', '=', Input::get('txtCodigoProveedorProducto'))->update(array
			(
				'nombre' => Input::get('txtNombre'),
				'descripcion' => Input::get('txtDescripcion')
			));

			$listaTProveedor=TProveedor::all();

			return View::make('proveedor.ver', ['color' => '#1497CC', 'mensajeGlobal' => 'Operación realizada correctamente', 'listaTProveedor' => $listaTProveedor]);
		}
		else
		{
			$tProveedorProducto=TProveedorProducto::find(Input::get('codigo'));
			return View::make('proveedorproducto.editar', ['tProveedorProducto' => $tProveedorProducto]);
		}
	}
}
?>