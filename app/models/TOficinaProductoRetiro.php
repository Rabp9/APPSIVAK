<?php
class TOficinaProductoRetiro extends Eloquent
{
	protected $table='TOficinaProductoRetiro';
	protected $primaryKey='codigoOficinaProductoRetiro';

	public function tOficina()
	{
		return $this->belongsTo('TOficina', 'codigoOficina');
	}

	public function tOficinaProducto()
	{
		return $this->belongsTo('TOficinaProducto', 'codigoOficinaProducto');
	}
}
?>