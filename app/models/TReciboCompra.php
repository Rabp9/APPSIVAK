<?php
class TReciboCompra extends Eloquent
{
	protected $table='TReciboCompra';
	protected $primaryKey='codigoReciboCompra';

	public function tAlmacen()
	{
		return $this->belongsTo('TAlmacen', 'codigoAlmacen');
	}

	public function tProveedor()
	{
		return $this->belongsTo('TProveedor', 'codigoProveedor');
	}

	public function tReciboCompraDetalle()
	{
		return $this->hasMany('TReciboCompraDetalle', 'codigoReciboCompra');
	}

	public function tReciboCompraPago()
	{
		return $this->hasMany('TReciboCompraPago', 'codigoReciboCompra');
	}
}