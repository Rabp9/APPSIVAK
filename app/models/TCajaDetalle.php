<?php
class TCajaDetalle extends Eloquent
{
	protected $table='TCajaDetalle';
	protected $primaryKey='codigoCajaDetalle';

	public function tCaja()
	{
		return $this->belongsTo('TCaja', 'codigoCaja');
	}

	public function tPersonal()
	{
		return $this->belongsTo('TPersonal', 'codigoPersonal');
	}
}
?>