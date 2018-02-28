<?php
class TPresentacion extends Eloquent
{
	protected $table='TPresentacion';
	protected $primaryKey='codigoPresentacion';

	public function tAlmacenProducto()
	{
		return $this->hasMany('TAlmacenProducto', 'codigoPresentacion');
	}

	public function tProductoEnviarStockDetalle()
	{
		return $this->hasMany('TProductoEnviarStockDetalle', 'codigoPresentacion');
	}
}
?>