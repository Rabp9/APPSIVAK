<?php
class ProveedorPuntoVentaController extends BaseController
{
	public function actionInsertar()
	{
		if($_POST)
		{
			$validator=Validator::make
			(
				['descripcion' => Input::get('txtDescripcion')],
			    ['descripcion' => ['unique:TProveedorPuntoVenta,descripcion,null,id,codigoProveedor,'.Input::get('txtCodigoProveedor')]]
			);
			if($validator->fails())
			{
				return View::make('proveedorpuntoventa.insertar', Input::all(), ['color' => 'red', 'mensajeGlobal' => 'Nombre de sucursal existente']);
			}
			$tProveedorPuntoVenta=new TProveedorPuntoVenta;
			$tProveedorPuntoVenta->codigoProveedor=Input::get('txtCodigoProveedor');
			$tProveedorPuntoVenta->descripcion=Input::get('txtDescripcion');
			$tProveedorPuntoVenta->pais=Input::get('txtPais');
			$tProveedorPuntoVenta->departamento=Input::get('txtDepartamento');
			$tProveedorPuntoVenta->provincia=Input::get('txtProvincia');
			$tProveedorPuntoVenta->distrito=Input::get('txtDistrito');
			$tProveedorPuntoVenta->direccion=Input::get('txtDireccion');
			$tProveedorPuntoVenta->manzana=Input::get('txtManzana');
			$tProveedorPuntoVenta->lote=Input::get('txtLote');
			$tProveedorPuntoVenta->numeroVivienda=Input::get('txtNumeroVivienda');
			$tProveedorPuntoVenta->numeroInterior=Input::get('txtNumeroInterior');
			$tProveedorPuntoVenta->telefono=Input::get('txtTelefono');
			$tProveedorPuntoVenta->correo=Input::get('txtCorreo');
			$tProveedorPuntoVenta->paginaWeb=Input::get('txtPaginaWeb');
			$tProveedorPuntoVenta->estado=true;

			$tProveedorPuntoVenta->save();

			return View::make('proveedorpuntoventa.insertar', ['color' => '#1497CC', 'mensajeGlobal' => 'Operación realizada correctamente']);
		}
		return View::make('proveedorpuntoventa.insertar');
	}

	public function actionVerPorCodigoProveedor()
	{
		$listaTProveedorPuntoVenta=TProveedorPuntoVenta::whereRaw('codigoProveedor=?', [Input::get('codigo')])->get();
		return View::make('proveedorpuntoventa.verporcodigoproveedor', ['listaTProveedorPuntoVenta' => $listaTProveedorPuntoVenta]);
	}

	public function actionVerDetalle()
	{
		$tProveedorPuntoVenta=TProveedorPuntoVenta::find(Input::get('codigo'));
		return View::make('proveedorpuntoventa.verdetalle', ['tProveedorPuntoVenta' => $tProveedorPuntoVenta]);
	}

	public function actionEditar()
	{
		if(Input::has('txtCodigoProveedorPuntoVenta'))
		{
			$valorRetorno=false;
			if(TProveedorPuntoVenta::whereRaw('codigoProveedorPuntoVenta!=? and codigoProveedor=? and descripcion=?', [Input::get('txtCodigoProveedorPuntoVenta'), Input::get('txtCodigoProveedor'), Input::get('txtDescripcion')])->count()>0)
			{
				$valorRetorno=true;
			}
			if($valorRetorno)
			{
				$listaTProveedor=TProveedor::all();
				return View::make('proveedor.ver', ['color' => 'red', 'mensajeGlobal' => 'Nombre de sucursal existente', 'listaTProveedor' => $listaTProveedor]);
			}
			TProveedorPuntoVenta::where('codigoProveedorPuntoVenta', '=', Input::get('txtCodigoProveedorPuntoVenta'))->update(array
			(
				'descripcion' => Input::get('txtDescripcion'),
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
				'correo' => Input::get('txtCorreo'),
				'paginaWeb' => Input::get('txtPaginaWeb'),
				'estado' => Input::get('cbxEstado')
			));

			$listaTProveedor=TProveedor::all();

			return View::make('proveedor.ver', ['color' => '#1497CC', 'mensajeGlobal' => 'Operación realizada correctamente', 'listaTProveedor' => $listaTProveedor]);
		}
		else
		{
			$tProveedorPuntoVenta=TProveedorPuntoVenta::find(Input::get('codigo'));
			return View::make('proveedorpuntoventa.editar', ['tProveedorPuntoVenta' => $tProveedorPuntoVenta]);
		}
	}
}
?>