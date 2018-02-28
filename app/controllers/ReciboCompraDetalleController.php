<?php
class ReciboCompraDetalleController extends BaseController
{
	public function actionVerPorCodigoReciboCompra()
	{
		$listaTReciboCompraDetalle=TReciboCompraDetalle::whereRaw('codigoReciboCompra=?', [Input::get('codigo')])->get();
		return View::make('recibocompradetalle.verporcodigorecibocompra', ['listaTReciboCompraDetalle' => $listaTReciboCompraDetalle]);
	}
}
?>