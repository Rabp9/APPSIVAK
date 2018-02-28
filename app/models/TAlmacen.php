<?php
class TAlmacen extends Eloquent
{
	protected $table='TAlmacen';
	protected $primaryKey='codigoAlmacen';

	public function tAlmacenProducto()
	{
		return $this->hasMany('TAlmacenProducto', 'codigoAlmacen');
	}

	public function tPersonalTAlmacen()
	{
		return $this->hasMany('TPersonalTAlmacen', 'codigoAlmacen');
	}

	public function tReciboCompra()
	{
		return $this->hasMany('TReciboCompra', 'codigoAlmacen');
	}
}
?>