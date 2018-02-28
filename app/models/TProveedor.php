<?php
class TProveedor extends Eloquent
{
	protected $table='TProveedor';
	protected $primaryKey='codigoProveedor';

	public function tProveedorProducto()
	{
		return $this->hasMany('TProveedorProducto', 'codigoProveedor');
	}

	public function tProveedorPuntoVenta()
	{
		return $this->hasMany('TProveedorPuntoVenta', 'codigoProveedor');
	}

	public function tReciboCompra()
	{
		return $this->hasMany('TReciboCompra', 'codigoProveedor');
	}
}
?>