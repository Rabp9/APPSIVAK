<?php
class TClienteJuridicoRepresentante extends Eloquent
{
	protected $table='TClienteJuridicoRepresentante';
	protected $primaryKey='codigoClienteJuridicoRepresentante';

	public function tClienteJuridico()
	{
		return $this->belongsTo('TClienteJuridico', 'codigoClienteJuridico');
	}
}
?>