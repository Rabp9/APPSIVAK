<?php
class ProductoTrasladoOficinaDetalleController extends BaseController
{
	public function actionVerPorCodigoProductoTrasladoOficina()
	{
		$listaTProductoTrasladoOficinaDetalle=TProductoTrasladoOficinaDetalle::whereRaw('codigoProductoTrasladoOficina=?', [Input::get('codigo')])->get();
		return View::make('productotrasladooficinadetalle/verporcodigoproductotrasladooficina', ['listaTProductoTrasladoOficinaDetalle' => $listaTProductoTrasladoOficinaDetalle]);
	}
}
?>