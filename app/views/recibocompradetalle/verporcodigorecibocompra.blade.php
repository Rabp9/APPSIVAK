<h3 style="text-decoration: underline;">Productos del Comprobante</h3>
<section class="anchoCompleto textAlignLeft backGroundColorGrisClaro">
    <button class="button" onclick="borrarElemento('filaDetalle')">Ocultar Detalles</button>
</section>
<section>
    <table class="table textoPequenio buscarEnTablaReciboCompraDetalle">
        <thead>
            <th>CÓDIGO DE BARRAS</th>
            <th>PRIMER NOMBRE</th>
            <th>SEGUNDO NOMBRE</th>
            <th>TERCER NOMBRE</th>
            <th>DESCRIPCIÓN</th>
            <th>TIPO PRODUCTO</th>
            <th>PRESENTACIÓN</th>
            <th>UNIDAD DE MEDIDA</th>
            <th>PRECIO DE COMPRA</th>
            <th>P. C. UNITARIO</th>
            <th>P. V. UNITARIO</th>
            <th>CANTIDAD</th>
            <th>VENTAS EN DECIMALES</th>
            <th>UNIDADES POR BLOQUE</th>
            <th>FECHA DE VENCIMIENTO</th>
        </thead>
        <tbody id="bodyTablaProductosAgregados">
            @foreach($listaTReciboCompraDetalle as $item) 
                <tr>
                    <td>{{{$item->codigoBarrasProducto}}}</td>
                    <td>{{{$item->primerNombreProducto}}}</td>
                    <td>{{{$item->segundoNombreProducto}}}</td>
                    <td>{{{$item->tercerNombreProducto}}}</td>
                    <td>{{{$item->descripcionProducto}}}</td>
                    <td>{{{$item->tipoProducto}}}</td>
                    <td>{{{$item->tPresentacion->nombre}}}</td>
                    <td>{{{$item->tUnidadMedida->nombre}}}</td>
                    <td>{{{$item->precioCompraTotalProducto}}}</td>
                    <td>{{{$item->precioCompraUnitarioProducto}}}</td>
                    <td>{{{$item->precioVentaUnitarioProducto}}}</td>
                    <td>{{{$item->cantidadProducto}}}</td>
                    <td>{{{$item->ventaMenorUnidadProducto ? 'Si' : 'No'}}}</td>
                    <td>{{{$item->unidadesBloqueProducto}}}</td>
                    <td>{{{$item->fechaVencimientoProducto}}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <hr>
</section>