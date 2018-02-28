<?php
class TUsuario extends Eloquent
{
	protected $table='TUsuario';
	protected $primaryKey='codigoPersonal';

	public function tPersonal()
	{
		return $this->belongsTo('TPersonal', 'codigoPersonal');
	}

	public function tReciboVenta()
	{
		return $this->hasMany('TReciboVenta', 'codigoPersonal');
	}
}
?>