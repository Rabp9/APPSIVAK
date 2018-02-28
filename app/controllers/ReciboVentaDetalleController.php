<?php
class ReciboVentaDetalleController extends BaseController
{
	public function actionVerPorCodigoReciboVenta()
	{
		$listaTReciboVentaDetalle=TReciboVentaDetalle::whereRaw('codigoReciboVenta=?', [Input::get('codigo')])->get();
		return View::make('reciboventadetalle.verporcodigoreciboventa', ['listaTReciboVentaDetalle' => $listaTReciboVentaDetalle]);
	}
}
?>