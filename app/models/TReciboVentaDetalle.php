<?php
class TReciboVentaDetalle extends Eloquent
{
	protected $table='TReciboVentaDetalle';
	protected $primaryKey='codigoReciboVentaDetalle';

	public function tReciboVenta()
	{
		return $this->belongsTo('TReciboVenta', 'codigoReciboVenta');
	}
}