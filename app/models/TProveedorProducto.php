<?php
class TProveedorProducto extends Eloquent
{
	protected $table='TProveedorProducto';
	protected $primaryKey='codigoProveedorProducto';

	public function tProveedor()
	{
		return $this->belongsTo('TProveedor', 'codigoProveedor');
	}
}
?>