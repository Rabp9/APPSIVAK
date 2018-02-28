<?php
class TAlmacenProductoRetiro extends Eloquent
{
	protected $table='TAlmacenProductoRetiro';
	protected $primaryKey='codigoAlmacenProductoRetiro';

	public function tAlmacen()
	{
		return $this->belongsTo('TAlmacen', 'codigoAlmacen');
	}

	public function tAlmacenProducto()
	{
		return $this->belongsTo('TAlmacenProducto', 'codigoAlmacenProducto');
	}
}
?>