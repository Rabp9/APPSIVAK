<?php
class TProductoEnviarStock extends Eloquent
{
	protected $table='TProductoEnviarStock';
	protected $primaryKey='codigoProductoEnviarStock';

	public function tAlmacen()
	{
		return $this->belongsTo('TAlmacen', 'codigoAlmacen');
	}

	public function tOficina()
	{
		return $this->belongsTo('TOficina', 'codigoOficina');
	}

	public function tProductoEnviarStockDetalle()
	{
		return $this->hasMany('TProductoEnviarStockDetalle', 'codigoProductoEnviarStock');
	}
}
?>