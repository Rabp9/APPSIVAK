<?php
class TProductoTrasladoOficina extends Eloquent
{
	protected $table='TProductoTrasladoOficina';
	protected $primaryKey='codigoProductoTrasladoOficina';

	public function tOficina()
	{
		return $this->belongsTo('TOficina', 'codigoOficina');
	}

	public function tOficinaLlegada()
	{
		return $this->belongsTo('TOficina', 'codigoOficinaLlegada');
	}

	public function tProductoTrasladoOficinaDetalle()
	{
		return $this->hasMany('TProductoTrasladoOficinaDetalle', 'codigoProductoTrasladoOficina');
	}
}
?>