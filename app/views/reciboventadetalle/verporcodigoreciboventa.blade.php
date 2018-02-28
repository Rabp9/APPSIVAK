<h3 style="text-decoration: underline;">Productos vendidos</h3>
<section class="anchoCompleto textAlignLeft backGroundColorGrisClaro">
    <button class="button" onclick="borrarElemento('filaDetalle')">Ocultar Detalles</button>
</section>
<section>
    <table class="table buscarEnTablaReciboVentaDetalle textoPequenio">
        <thead>
            <th>CÓDIGO DE BARRAS</th>
            <th>NOMBRE</th>
            <th>DESCRIPCIÓN</th>
            <th>TIPO</th>
            <th>CATEGORÍA</th>
            <th>PRESENTACIÓN</th>
            <th>UNIDAD MED.</th>
            <th>PRECIO V. TOTAL</th>
            <th>PRECIO V. UNITARIO</th>
            <th>CANTIDAD UNITARIA</th>
            <th>CANTIDAD BLOQUE</th>
            <th>UNIDAD MED. BLOQUE</th>
        </thead>
        <tbody>
            @foreach($listaTReciboVentaDetalle as $item) 
                <tr>
                    <td>{{{$item->codigoBarrasProducto}}}</td>
                    <td>{{{$item->primerNombreProducto.' / '.$item->segundoNombreProducto.' / '.$item->tercerNombreProducto}}}</td>
                    <td>{{{$item->descripcionProducto}}}</td>
                    <td>{{{$item->tipoProducto}}}</td>
                    <td>{{{$item->categoriaProducto}}}</td>
                    <td>{{{$item->presentacionProducto}}}</td>
                    <td>{{{$item->unidadMedidaProducto}}}</td>
                    <td>{{{$item->precioVentaTotalProducto}}}</td>
                    <td>{{{$item->precioVentaUnitarioProducto}}}</td>
                    <td>{{{$item->cantidadProducto}}}</td>
                    <td>{{{$item->cantidadBloqueProducto}}}</td>
                    <td>{{{$item->unidadMedidaBloqueProducto}}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <hr>
</section>