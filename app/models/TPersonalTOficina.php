<?php
class TPersonalTOficina extends Eloquent
{
	protected $table='TPersonalTOficina';
	protected $primaryKey='codigoPersonalTOficina';	

	public function tOficina()
	{
		return $this->belongsTo('TOficina', 'codigoOficina');
	}

	public function tPersonal()
	{
		return $this->belongsTo('TPersonal', 'codigoPersonal');
	}
}
?>