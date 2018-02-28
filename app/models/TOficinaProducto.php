<?php
class TOficinaProducto extends Eloquent
{
	protected $table='TOficinaProducto';
	protected $primaryKey='codigoOficinaProducto';

	public function tOficina()
	{
		return $this->belongsTo('TOficina', 'codigoOficina');
	}
}
?>