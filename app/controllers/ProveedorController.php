<?php
class ProveedorController extends BaseController
{
	public function actionInsertar()
	{
		if($_POST)
		{
			$mensajeGlobal='';

			$validator=Validator::make
			(
				[
					'documentoIdentidad' => Input::get('txtDocumentoIdentidad'),
					'nombre' => Input::get('txtNombre')
				],
			    [
			    	'documentoIdentidad' => ['unique:TProveedor'],
			    	'nombre' => ['unique:TProveedor']
			    ]
			);
			if($validator->fails())
			{
				if($validator->messages()->first('documentoIdentidad')!='')
				{
					$mensajeGlobal=$mensajeGlobal.'Documento de identidad asignado con anterioridad';
				}
						
				if($validator->messages()->first('nombre')!='')
				{
					$mensajeGlobal=$mensajeGlobal!=''?$mensajeGlobal.'<br>':$mensajeGlobal.'';
					$mensajeGlobal=$mensajeGlobal.' Nombre de proveedor asignado con anterioridad';
				}
				return View::make('proveedor.insertar', Input::all(), ['color' => 'red', 'mensajeGlobal' => $mensajeGlobal]);
			}
			$tProveedor=new TProveedor;
			$tProveedor->documentoIdentidad=Input::get('txtDocumentoIdentidad');
			$tProveedor->nombre=Input::get('txtNombre');

			$tProveedor->save();

			return View::make('proveedor.insertar', ['color' => '#1497CC', 'mensajeGlobal' => 'Operación realizada correctamente']);
		}
		return View::make('proveedor.insertar');
	}

	public function actionVer()
	{
		$listaTProveedor=TProveedor::all();

		return View::make('proveedor.ver', ['listaTProveedor' => $listaTProveedor]);
	}

	public function actionEditar()
	{
		if(Input::has('txtCodigoProveedor'))
		{
			$registroExiste=false;
			$mensajeGlobal='';
			if(TProveedor::whereRaw('codigoProveedor!=? and documentoIdentidad=?', [Input::get('txtCodigoProveedor'), Input::get('txtDocumentoIdentidad')])->count()>0)
			{
				$registroExiste=true;
				$mensajeGlobal=$mensajeGlobal.'Documento de Identidad Existente';
			}
			if(TProveedor::whereRaw('codigoProveedor!=? and nombre=?', [Input::get('txtCodigoProveedor'), Input::get('txtNombre')])->count()>0)
			{
				$registroExiste=true;
				$mensajeGlobal=$mensajeGlobal!=''?$mensajeGlobal.'<br>':$mensajeGlobal.'';
				$mensajeGlobal=$mensajeGlobal.'Nombre de Proveedor Existente';
			}
			if($registroExiste)
			{
				$listaTProveedor=TProveedor::all();
				return View::make('proveedor.ver', ['color' => 'red', 'mensajeGlobal' => $mensajeGlobal, 'listaTProveedor' => $listaTProveedor]);
			}
			TProveedor::where('codigoProveedor', '=', Input::get('txtCodigoProveedor'))->update(array
			(
				'documentoIdentidad' => Input::get('txtDocumentoIdentidad'),
				'nombre' => Input::get('txtNombre')
			));

			$listaTProveedor=TProveedor::all();

			return View::make('proveedor.ver', ['color' => '#1497CC', 'mensajeGlobal' => 'Operación realizada correctamente', 'listaTProveedor' => $listaTProveedor]);
		}
		else
		{
			$tProveedor=TProveedor::find(Input::get('codigo'));
			return View::make('proveedor.editar', ['tProveedor' => $tProveedor]);
		}
	}

	public function actionBuscarProveedor()
	{
		$listaTProveedor=TProveedor::all();
		
		return View::make('proveedor.buscarproveedor', ['listaTProveedor' => $listaTProveedor]);
	}
}
?>