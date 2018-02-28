<?php
class ProductoEnviarStockDetalleController extends BaseController
{
	public function actionVerPorCodigoProductoEnviarStock()
	{
		$listaTProductoEnviarStockDetalle=TProductoEnviarStockDetalle::whereRaw('codigoProductoEnviarStock=?', [Input::get('codigo')])->get();
		return View::make('productoenviarstockdetalle/verporcodigoproductoenviarstock', ['listaTProductoEnviarStockDetalle' => $listaTProductoEnviarStockDetalle]);
	}
}
?>