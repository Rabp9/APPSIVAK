<?php
class TEgreso extends Eloquent
{
	protected $table='TEgreso';
	protected $primaryKey='codigoEgreso';

	public function tPersonal()
	{
		return $this->belongsTo('TPersonal', 'codigoPersonal');
	}

	public function tAlmacen()
	{
		return $this->belongsTo('TAlmacen', 'codigoAlmacen');
	}

	public function tOficina()
	{
		return $this->belongsTo('TOficina', 'codigoOficina');
	}
}
?>