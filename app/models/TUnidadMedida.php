<?php
class TUnidadMedida extends Eloquent
{
	protected $table='TUnidadMedida';
	protected $primaryKey='codigoUnidadMedida';

	public function tAlmacenProducto()
	{
		return $this->hasMany('TAlmacenProducto', 'codigoUnidadMedida');
	}

	public function tProductoEnviarStockDetalle()
	{
		return $this->hasMany('TProductoEnviarStockDetalle', 'codigoUnidadMedida');
	}
}
?>