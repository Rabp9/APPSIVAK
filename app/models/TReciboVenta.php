<?php
class TReciboVenta extends Eloquent
{
	protected $table='TReciboVenta';
	protected $primaryKey='codigoReciboVenta';

	public function tOficina()
	{
		return $this->belongsTo('TOficina', 'codigoOficina');
	}

	public function tReciboVentaDetalle()
	{
		return $this->hasMany('TReciboVentaDetalle', 'codigoReciboVenta');
	}

	public function tReciboVentaLetra()
	{
		return $this->hasMany('TReciboVentaLetra', 'codigoReciboVenta');
	}

	public function tReciboVentaPago()
	{
		return $this->hasMany('TReciboVentaPago', 'codigoReciboVenta');
	}

	public function tUsuario()
	{
		return $this->belongsTo('TUsuario', 'codigoPersonal');
	}
}