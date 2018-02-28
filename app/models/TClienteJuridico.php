<?php
class TClienteJuridico extends Eloquent
{
	protected $table='TClienteJuridico';
	protected $primaryKey='codigoClienteJuridico';

	public function tClienteJuridicoRepresentante()
	{
		return $this->hasMany('TClienteJuridicoRepresentante', 'codigoClienteJuridico');
	}

	public function tOficina()
	{
		return $this->belongsTo('TOficina', 'codigoOficina');
	}
}
?>