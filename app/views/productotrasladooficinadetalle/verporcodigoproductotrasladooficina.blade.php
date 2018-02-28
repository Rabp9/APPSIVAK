<h3 style="text-decoration: underline;">Productos Enviados</h3>
<section class="anchoCompleto textAlignLeft backGroundColorGrisClaro">
    <button class="button" onclick="borrarElemento('filaDetalle')">Ocultar Detalles</button>
</section>
<section>
    <table class="table textoPequenio buscarEnTablaProductoEnviarStockDetalle">
        <thead>
            <th>CÓDIGO DE BARRAS</th>
            <th>PRIMER NOMBRE</th>
            <th>SEGUNDO NOMBRE</th>
            <th>TERCER NOMBRE</th>
            <th>DESCRIPCIÓN</th>
            <th>TIPO PRODUCTO</th>
            <th>PRESENTACIÓN</th>
            <th>UNIDAD DE MEDIDA</th>
            <th>P. C. UNITARIO</th>
            <th>P. V. UNITARIO</th>
            <th>CANTIDAD ENVIADA</th>
            <th>VENTAS EN DECIMALES</th>
            <th>UNIDADES POR BLOQUE</th>
            <th>FECHA DE VENCIMIENTO</th>
        </thead>
        <tbody id="bodyTablaProductosAgregados">
            @foreach($listaTProductoTrasladoOficinaDetalle as $item) 
                <tr>
                    <td>{{{$item->codigoBarrasProducto}}}</td>
                    <td>{{{$item->primerNombreProducto}}}</td>
                    <td>{{{$item->segundoNombreProducto}}}</td>
                    <td>{{{$item->tercerNombreProducto}}}</td>
                    <td>{{{$item->descripcionProducto}}}</td>
                    <td>{{{$item->tipoProducto}}}</td>
                    <td>{{{$item->presentacion}}}</td>
                    <td>{{{$item->unidadMedida}}}</td>
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