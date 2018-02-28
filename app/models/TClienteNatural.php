<?php
class TClienteNatural extends Eloquent
{
	protected $table='TClienteNatural';
	protected $primaryKey='codigoClienteNatural';

	public function tOficina()
	{
		return $this->belongsTo('TOficina', 'codigoOficina');
	}
}
?>