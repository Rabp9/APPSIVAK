<?php
class TReciboCompraDetalle extends Eloquent
{
	protected $table='TReciboCompraDetalle';
	protected $primaryKey='codigoReciboCompraDetalle';

	public function tReciboCompra()
	{
		return $this->belongsTo('TReciboCompra', 'codigoReciboCompra');
	}

	public function tPresentacion()
	{
		return $this->belongsTo('TPresentacion', 'codigoPresentacionProducto');
	}

	public function tUnidadMedida()
	{
		return $this->belongsTo('TUnidadMedida', 'codigoUnidadMedidaProducto');
	}
}