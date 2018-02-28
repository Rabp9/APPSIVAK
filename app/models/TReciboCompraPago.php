<?php
class TReciboCompraPago extends Eloquent
{
	protected $table='TReciboCompraPago';
	protected $primaryKey='codigoReciboCompraPago';

	public function tReciboCompra()
	{
		return $this->belongsTo('TReciboCompra', 'codigoReciboCompra');
	}
}