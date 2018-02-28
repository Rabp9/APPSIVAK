<?php
class TReciboVentaLetra extends Eloquent
{
	protected $table='TReciboVentaLetra';
	protected $primaryKey='codigoReciboVentaLetra';

	public function tReciboVenta()
	{
		return $this->belongsTo('TReciboVenta', 'codigoReciboVenta');
	}
}