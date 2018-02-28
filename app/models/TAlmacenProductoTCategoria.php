<?php
class TAlmacenProductoTCategoria extends Eloquent
{
	protected $table='TAlmacenProductoTCategoria';
	protected $primaryKey='codigoAlmacenProductoTCategoria';

	public function tAlmacenProducto()
	{
		return $this->belongsTo('TAlmacenProducto', 'codigoAlmacenProducto');
	}

	public function tCategoria()
	{
		return $this->belongsTo('TCategoria', 'codigoCategoria');
	}
}
?>