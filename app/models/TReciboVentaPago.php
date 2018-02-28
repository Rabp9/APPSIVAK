<?php
class TReciboVentaPago extends Eloquent
{
	protected $table='TReciboVentaPago';
	protected $primaryKey='codigoReciboVentaPago';

	public function tReciboVenta()
	{
		return $this->belongsTo('TReciboVenta', 'codigoReciboVenta');
	}
}