<section class="anchoCompleto">
    <table class="table buscarEnTablaAlmacenProducto textoPequenio">
        <thead>
            <th>CÓDIGO DE BARRAS</th>
            <th>PRIMER NOMBRE</th>
            <th>SEGUNDO NOMBRE</th>
            <th>TERCER NOMBRE</th>
            <th>DESCRIPCIÓN</th>
            <th>TIPO</th>
            <th>VENTAS MENOR A SU UND.</th>
            <th>UNIDADES POR BLOQUE</th>
            <th>UNIDAD MEDIDA BLOQUE</th>
            <th>PRECIO COMPRA UNITARIO</th>
            <th>PRECIO VENTA UNITARIO</th>
            <th>FECHA DE VENCIMIENTO</th>
            <th style="display: none;"></th>
            <th style="display: none;"></th>
            <th style="display: none;"></th>
            <th></th>
        </thead>
        <tbody>
            @foreach($listaTAlmacenProducto as $item) 
                <tr class="elementoBuscar">
                    <td id="codigoBarrasAlmacenProductoAgrupado{{{$item->codigoAlmacenProducto}}}">{{{$item->codigoBarras}}}</td>
                    <td id="primerNombreAlmacenProductoAgrupado{{{$item->codigoAlmacenProducto}}}">{{{$item->primerNombre}}}</td>
                    <td id="segundoNombreAlmacenProductoAgrupado{{{$item->codigoAlmacenProducto}}}">{{{$item->segundoNombre}}}</td>
                    <td id="tercerNombreAlmacenProductoAgrupado{{{$item->codigoAlmacenProducto}}}">{{{$item->tercerNombre}}}</td>
                    <td id="descripcionAlmacenProductoAgrupado{{{$item->codigoAlmacenProducto}}}">{{{$item->descripcion}}}</td>
                    <td id="tipoAlmacenProductoAgrupado{{{$item->codigoAlmacenProducto}}}">{{{$item->tipo}}}</td>
                    <td id="ventaMenorUnidadAlmacenProductoAgrupado{{{$item->codigoAlmacenProducto}}}">{{{$item->ventaMenorUnidad?'Si':'No'}}}</td>
                    <td id="unidadesBloqueAlmacenProductoAgrupado{{{$item->codigoAlmacenProducto}}}">{{{$item->unidadesBloque}}}</td>
                    <td id="unidadMedidaBloqueAlmacenProductoAgrupado{{{$item->codigoAlmacenProducto}}}">{{{$item->unidadMedidaBloque}}}</td>
                    <td id="precioCompraUnitarioAlmacenProductoAgrupado{{{$item->codigoAlmacenProducto}}}">{{{$item->precioCompraUnitario}}}</td>
                    <td id="precioVentaUnitarioAlmacenProductoAgrupado{{{$item->codigoAlmacenProducto}}}">{{{$item->precioVentaUnitario}}}</td>
                    <td id="fechaVencimientoAlmacenProductoAgrupado{{{$item->codigoAlmacenProducto}}}">{{{$item->fechaVencimiento}}}</td>
                    <td id="codigoAlmacenAlmacenProductoAgrupado{{{$item->codigoAlmacenProducto}}}" style="display: none;">{{{$item->codigoAlmacenProducto}}}</td>
                    <td id="codigoPresentacionAlmacenProductoAgrupado{{{$item->codigoAlmacenProducto}}}" style="display: none;">{{{$item->codigoPresentacion}}}</td>
                    <td id="codigoUnidadMedidaAlmacenProductoAgrupado{{{$item->codigoAlmacenProducto}}}" style="display: none;">{{{$item->codigoUnidadMedida}}}</td>
                    <td><button id="btnSeleccionarAlmacenProductoAgrupado{{{$item->codigoAlmacenProducto}}}" class="btnSeleccionarAlmacenProductoAgrupado">Seleccionar</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>