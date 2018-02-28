<?php
class OtrosController extends BaseController
{
	public function actionAlerta()
	{
		$listaTOficinaProductoStockReducido=TOficinaProducto::with('TOficina')->whereRaw('cantidad<=? and estado=?', [10, true])->get();
		$listaTAlmacenProductoStockReducido=TAlmacenProducto::with('TAlmacen', 'TPresentacion', 'TUnidadMedida')->whereRaw('cantidad<=? and estado=?', [10, true])->get();
		$listaTOficinaProductoPorVencerse=TOficinaProducto::with('TOficina')->whereRaw('estado=? and fechaVencimiento between ? and ? and fechaVencimiento!=?', [true, '2000-01-01', date('Y-m-d', strtotime(date('Y-m-d')." +10 day")), '1111-11-11'])->get();
		$listaTReciboVentaPorCobrar=TReciboVenta::with('TOficina')->whereRaw('tipoPago=? and estadoCredito=? and estado=?', ['Al Crédito', false, true])->get();
		$listaTReciboCompraPorPagar=TReciboCompra::with('TAlmacen', 'TProveedor')->whereRaw('tipoPago=? and estadoCredito=? and estado=?', ['Al Crédito', false, true])->orderBy('fechaPagar', 'asc')->get();

		if(Session::has('mensajeRedirect'))
		{
			return View::make('otros/alerta', ['color' => '#1497CC', 'mensajeGlobal' => Session::get('mensajeRedirect'), 'listaTOficinaProductoStockReducido' => $listaTOficinaProductoStockReducido, 'listaTOficinaProductoPorVencerse' => $listaTOficinaProductoPorVencerse, 'listaTReciboVentaPorCobrar' => $listaTReciboVentaPorCobrar, 'listaTReciboCompraPorPagar' => $listaTReciboCompraPorPagar, 'listaTAlmacenProductoStockReducido' => $listaTAlmacenProductoStockReducido]);
		}

		if(Session::has('mensajeRedirectError'))
		{
			return View::make('otros/alerta', ['color' => 'red', 'mensajeGlobal' => Session::get('mensajeRedirectError'), 'listaTOficinaProductoStockReducido' => $listaTOficinaProductoStockReducido, 'listaTOficinaProductoPorVencerse' => $listaTOficinaProductoPorVencerse, 'listaTReciboVentaPorCobrar' => $listaTReciboVentaPorCobrar, 'listaTReciboCompraPorPagar' => $listaTReciboCompraPorPagar, 'listaTAlmacenProductoStockReducido' => $listaTAlmacenProductoStockReducido]);
		}

		return View::make('otros/alerta', ['listaTOficinaProductoStockReducido' => $listaTOficinaProductoStockReducido, 'listaTOficinaProductoPorVencerse' => $listaTOficinaProductoPorVencerse, 'listaTReciboVentaPorCobrar' => $listaTReciboVentaPorCobrar, 'listaTReciboCompraPorPagar' => $listaTReciboCompraPorPagar, 'listaTAlmacenProductoStockReducido' => $listaTAlmacenProductoStockReducido]);
	}

	public function actionBackup()
	{
		$filename='DBAPPSIVAK_'.date("Y-m-d H:i:s").'.sql';

		mail("johncg24@gmail.com", "Backup generado de DBAPPSIVAK", "Backup generado de DBAPPSIVAK por: ".Session::get('usuario'));

		header("Pragma: no-cache");
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
		header("Content-Transfer-Encoding: binary");
		header("Content-type: application/force-download");
		header("Content-Disposition: attachment; filename=$filename");

		system("mysqldump --password=12345678 --user=root  DBAPPSIVAK");
	}
}
?>