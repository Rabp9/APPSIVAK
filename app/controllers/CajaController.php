<?php
class CajaController extends BaseController
{
	public function actionInsertar()
	{
		if($_POST)
		{
			$fechaActual=date('Y-m-d');

			$tCaja=TCaja::whereRaw('mid(created_at, 1, 10)=?', [$fechaActual])->get();

			if(count($tCaja)>0)
			{
				return Redirect::to('cajadetalle/insertar');
			}

			$tCaja=new TCaja;

			$tCaja->save();

			return Redirect::to('cajadetalle/insertar');
		}

		$fechaActual=date('Y-m-d');

		$tCaja=TCaja::whereRaw('mid(created_at, 1, 10)=?', [$fechaActual])->get();

		if(count($tCaja)==0)
		{
			return View::make('caja/insertar');
		}

		if(count($tCaja)>0)
		{
			return Redirect::to('cajadetalle/insertar');
		}
	}

	public function actionVer()
	{
		$listaTCaja=TCaja::orderBy('created_at', 'desc')->get();

		if(Session::has('mensajeRedirect'))
		{
			return View::make('caja/ver', ['color' => '#1497CC', 'mensajeGlobal' => 'Operación realizada correctamente', 'listaTCaja' => $listaTCaja]);
		}

		if(Session::has('mensajeRedirectError'))
		{
			return View::make('caja/ver', ['color' => 'red', 'mensajeGlobal' => Session::get('mensajeRedirectError'), 'listaTCaja' => $listaTCaja]);
		}

		return View::make('caja/ver', ['listaTCaja' => $listaTCaja]);
	}
}
?>