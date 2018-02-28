<?php
class TProductoTrasladoOficinaDetalle extends Eloquent
{
	protected $table='TProductoTrasladoOficinaDetalle';
	protected $primaryKey='codigoProductoTrasladoOficinaDetalle';

	public function tOficinaProducto()
	{
		return $this->belongsTo('TOficinaProducto', 'codigoOficinaProducto');
	}

	public function tProductoTrasladoOficina()
	{
		return $this->belongsTo('TProductoTrasladoOficina', 'codigoProductoTrasladoOficina');
	}
}
?>