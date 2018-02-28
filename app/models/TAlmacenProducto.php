<?php
class TAlmacenProducto extends Eloquent
{
	protected $table='TAlmacenProducto';
	protected $primaryKey='codigoAlmacenProducto';

	public function tAlmacen()
	{
		return $this->belongsTo('TAlmacen', 'codigoAlmacen');
	}

	public function tAlmacenProductoCategoria()
	{
		return $this->hasMany('TAlmacenProductoCategoria', 'codigoAlmacenProducto');
	}

	public function tPresentacion()
	{
		return $this->belongsTo('TPresentacion', 'codigoPresentacion');
	}

	public function tUnidadMedida()
	{
		return $this->belongsTo('TUnidadMedida', 'codigoUnidadMedida');
	}
}
?>