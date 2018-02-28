<?php
class TCategoria extends Eloquent
{
	protected $table='TCategoria';
	protected $primaryKey='codigoCategoria';

	public function tAlmacenProductoCategoria()
	{
		return $this->hasMany('TAlmacenProductoCategoria', 'codigoCategoria');
	}
}
?>