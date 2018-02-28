<?php
class UsuarioController extends BaseController
{
	public function actionLogin()
	{
		if($_POST)
		{
			$mensajeGlobal='';

			$tUsuario=TUsuario::whereRaw('nombreUsuario=?', [Input::get('txtNombreUsuario')])->get();

			if(count($tUsuario)>0 && Crypt::decrypt($tUsuario[0]->contrasenia)==Input::get('txtContrasenia'))
			{
				if(Input::get('txtRadioOficinaAlmacen')=='Oficina')
				{
					if(TPersonalTOficina::whereRaw('codigoOficina=? and codigoPersonal=?', [Input::get('cbxOficina'), $tUsuario[0]->codigoPersonal])->count()>0)
					{
						$local=TOficina::find(Input::get('cbxOficina'));
						$local=$local->codigoOficina.','.$local->descripcion;
					}
					else
					{
						$mensajeGlobal.='Ud. no tiene autorización para acceder a esta oficina';
					}
				}

				if(Input::get('txtRadioOficinaAlmacen')=='Almacén')
				{
					if(TPersonalTAlmacen::whereRaw('codigoAlmacen=? and codigoPersonal=?', [Input::get('cbxAlmacen'), $tUsuario[0]->codigoPersonal])->count()>0)
					{
						$local=TAlmacen::find(Input::get('cbxAlmacen'));
						$local=$local->codigoAlmacen.','.$local->descripcion;
					}
					else
					{
						$mensajeGlobal.='Ud. no tiene autorización para acceder a este almacén<br>';
					}
				}

				if($tUsuario[0]->rol=='')
				{
					$mensajeGlobal.='Ud. no tiene ningún rol para acceder al sistema<br>';
				}
			}
			else
			{
				$mensajeGlobal.='Usuario o contraseña incorrecto<br>';				
			}

			if($mensajeGlobal!='')
			{
				$listaTOficina=TOficina::all();
				$listaTAlmacen=TAlmacen::all();
				
				return View::make('usuario.login', ['color' => 'red', 'mensajeGlobal' => $mensajeGlobal, 'listaTOficina' => $listaTOficina, 'listaTAlmacen' => $listaTAlmacen]);
			}

			Session::put('usuario', $tUsuario[0]->codigoPersonal.','.Input::get('txtNombreUsuario'));
			Session::put('rol', $tUsuario[0]->rol);
			Session::put('local', $local);
			Session::put('localAcceso', Input::get('txtRadioOficinaAlmacen'));

			return Redirect::to('otros/alerta');
		}

		if(Session::has('usuario'))
		{
			return Redirect::to('otros/alerta');
		}

		$listaTOficina=TOficina::all();
		$listaTAlmacen=TAlmacen::all();

		return View::make('usuario.login', ['listaTOficina' => $listaTOficina, 'listaTAlmacen' => $listaTAlmacen]);
	}

	public function actionCerrarSesion()
	{
		Session::forget('usuario');
		Session::forget('rol');
		Session::forget('local');
		Session::forget('localAcceso');

		return Redirect::to('usuario/login');
	}

	public function actionInsertar()
	{
		if($_POST)
		{
			$mensajeGlobal='';
			$validator=Validator::make
			(
				[
					'codigoPersonal' => Input::get('txtCodigoPersonal'),
					'nombreUsuario' => Input::get('txtNombreUsuario')
				],
			    [
			    	'codigoPersonal' => ['unique:TUsuario'],
			    	'nombreUsuario' => ['unique:TUsuario']
			    ]
			);
			if($validator->fails())
			{
				if($validator->messages()->first('codigoPersonal')!='')
				{
					$mensajeGlobal=$mensajeGlobal.'Ya fue asignado un usuario a este personal';
				}
						
				if($validator->messages()->first('nombreUsuario')!='')
				{
					$mensajeGlobal=$mensajeGlobal!=''?$mensajeGlobal.'<br>':$mensajeGlobal.'';
					$mensajeGlobal=$mensajeGlobal.' Nombre de usuario ocupado';
				}
				return View::make('usuario.insertar', Input::all(), ['color' => 'red', 'mensajeGlobal' => $mensajeGlobal]);
			}
			$tUsuario=new TUsuario;
			$tUsuario->codigoPersonal=Input::get('txtCodigoPersonal');
			$tUsuario->nombreUsuario=Input::get('txtNombreUsuario');
			$tUsuario->contrasenia=Crypt::encrypt(Input::get('txtContrasenia'));

			$tUsuario->save();

			return View::make('usuario.insertar', ['color' => '#1497CC', 'mensajeGlobal' => 'Operación realizada correctamente']);
		}
		return View::make('usuario.insertar');
	}

	public function actionVer()
	{
		$listaTUsuario=TUsuario::all();

		return View::make('usuario.ver', ['listaTUsuario' => $listaTUsuario]);
	}

	public function actionEditar()
	{
		if(Input::has('txtCodigoPersonal'))
		{
			$registroExiste=false;
			$mensajeGlobal='';
			if(TUsuario::whereRaw('codigoPersonal!=? and nombreUsuario=?', [Input::get('txtCodigoPersonal'), Input::get('txtNombreUsuario')])->count()>0)
			{
				$registroExiste=true;
				$mensajeGlobal=$mensajeGlobal.'Nombre de Usuario Ocupado';
			}
			$tUsuario=TUsuario::find(Input::get('txtCodigoPersonal'));
			$contrasenia=Crypt::decrypt($tUsuario->contrasenia);
			if($contrasenia!=Input::get('txtContraseniaAnterior') && explode(',', Session::get('usuario'))[1]!='Yanapasoft')
			{
				$registroExiste=true;
				$mensajeGlobal=$mensajeGlobal!=''?$mensajeGlobal.'<br>':$mensajeGlobal.'';
				$mensajeGlobal=$mensajeGlobal.' Contraseña Incorrecta';
			}
			if($registroExiste)
			{
				$listaTUsuario=TUsuario::all();
				return View::make('usuario/ver', ['color' => 'red', 'mensajeGlobal' => $mensajeGlobal, 'listaTUsuario' => $listaTUsuario]);
			}
			TUsuario::where('codigoPersonal', '=', Input::get('txtCodigoPersonal'))->update(array
			(
				'nombreUsuario' => Input::get('txtNombreUsuario'),
				'contrasenia' => Crypt::encrypt(Input::get('txtContrasenia'))
			));

			$listaTUsuario=TUsuario::all();

			return View::make('usuario/ver', ['color' => '#1497CC', 'mensajeGlobal' => 'Operación realizada correctamente', 'listaTUsuario' => $listaTUsuario]);
		}
		else
		{
			$tUsuario=TUsuario::find(Input::get('codigo'));
			return View::make('usuario/editar', ['tUsuario' => $tUsuario]);
		}
	}

	public function actionGestionarRoles()
	{
		if(Input::has('txtCodigoPersonal'))
		{
			$tUsuario=TUsuario::find(Input::get('txtCodigoPersonal'));

			$tUsuario->rol=Input::get('txtCheckBoxRol');

			$tUsuario->save();

			$listaTUsuario=TUsuario::all();

			return View::make('usuario/ver', ['color' => '#1497CC', 'mensajeGlobal' => 'Roles asignados correctamente', 'listaTUsuario' => $listaTUsuario]);
		}

		$tUsuario=TUsuario::find(Input::get('codigo'));

		return View::make('usuario/gestionarroles', ['tUsuario' => $tUsuario]);
	}

	public function actionEnviarContraseniaCorreo($codigoPersonal)
	{
		$tPersonal=TPersonal::find($codigoPersonal);
		$tUsuario=TUsuario::find($codigoPersonal);
		$listaTUsuario=TUsuario::all();

		if($tPersonal->correo=='')
		{
			return View::make('usuario/ver', ['color' => 'red', 'mensajeGlobal' => 'Correo no registrado en este usuario', 'listaTUsuario' => $listaTUsuario]);
		}

		mail($tPersonal->correo, "Contraseña de SIVAK-VENTAS", "Su contraseña de SIVAK-VENTAS es: ".Crypt::decrypt($tUsuario->contrasenia));

		return View::make('usuario/ver', ['color' => '#1497CC', 'mensajeGlobal' => 'Contraseña enviada al correo '.$tPersonal->correo.' para el personal '.$tPersonal->nombre.' '.$tPersonal->apellidoPaterno.' '.$tPersonal->apellidoMaterno, 'listaTUsuario' => $listaTUsuario]);
	}
}
?>