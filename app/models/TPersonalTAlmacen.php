<?php
class TPersonalTAlmacen extends Eloquent
{
	protected $table='TPersonalTAlmacen';
	protected $primaryKey='codigoPersonalTAlmacen';

	public function tAlmacen()
	{
		return $this->belongsTo('TAlmacen', 'codigoAlmacen');
	}

	public function tPersonal()
	{
		return $this->belongsTo('TPersonal', 'codigoPersonal');
	}
}
?>