<?php
class TCaja extends Eloquent
{
	protected $table='TCaja';
	protected $primaryKey='codigoCaja';

	public function tCajaDetalle()
	{
		return $this->hasMany('TCajaDetalle', 'codigoCaja');
	}

	public function tAlmacen()
	{
		return $this->belongsTo('TAlmacen', 'codigoAlmacen');
	}

	public function tOficina()
	{
		return $this->belongsTo('TOficina', 'codigoOficina');
	}
}
?>