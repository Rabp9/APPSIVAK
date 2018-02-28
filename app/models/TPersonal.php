<?php
class TPersonal extends Eloquent
{
	protected $table='TPersonal';
	protected $primaryKey='codigoPersonal';

	public function tCaja()
	{
		return $this->hasMany('TCaja', 'codigoPersonal');
	}

	public function tEgreso()
	{
		return $this->hasMany('TEgreso', 'codigoPersonal');
	}

	public function tPersonalTAlmacen()
	{
		return $this->hasMany('TPersonalTAlmacen', 'codigoPersonal');
	}

	public function tPersonalTOficina()
	{
		return $this->hasMany('TPersonalTOficina', 'codigoPersonal');
	}

	public function tUsuario()
	{
		return $this->hasOne('TUsuario', 'codigoPersonal');
	}
}
?>