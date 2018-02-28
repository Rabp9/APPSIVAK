<?php
class TProveedorPuntoVenta extends Eloquent
{
	protected $table='TProveedorPuntoVenta';
	protected $primaryKey='codigoProveedorPuntoVenta';

	public function tProveedor()
	{
		return $this->belongsTo('TProveedor', 'codigoProveedor');
	}
}
?>