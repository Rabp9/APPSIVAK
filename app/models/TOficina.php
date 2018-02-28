<?php
class TOficina extends Eloquent
{
	protected $table='TOficina';
	protected $primaryKey='codigoOficina';

	public function tClienteJuridico()
	{
		return $this->belongsTo('TClienteJuridico', 'codigoClienteJuridico');
	}

	public function tClienteNatural()
	{
		return $this->hasMany('TClienteNatural', 'codigoOficina');
	}

	public function tOficinaProducto()
	{
		return $this->hasMany('TOficinaProducto', 'codigoOficina');
	}

	public function tPersonalTOficina()
	{
		return $this->hasMany('TPersonalTOficina', 'codigoOficina');
	}

	public function tReciboVenta()
	{
		return $this->hasMany('TReciboVenta', 'codigoOficina');
	}
}
?>