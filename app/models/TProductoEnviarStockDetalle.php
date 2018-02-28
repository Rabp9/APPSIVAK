<?php
class TProductoEnviarStockDetalle extends Eloquent
{
	protected $table='TProductoEnviarStockDetalle';
	protected $primaryKey='codigoProductoEnviarStockDetalle';

	public function tAlmacenProducto()
	{
		return $this->belongsTo('TAlmacenProducto', 'codigoAlmacenProducto');
	}

	public function tPresentacion()
	{
		return $this->belongsTo('TPresentacion', 'codigoPresentacionProducto');
	}

	public function tProductoEnviarStock()
	{
		return $this->belongsTo('TProductoEnviarStock', 'codigoProductoEnviarStock');
	}

	public function tUnidadMedida()
	{
		return $this->belongsTo('TUnidadMedida', 'codigoUnidadMedidaProducto');
	}
}
?>