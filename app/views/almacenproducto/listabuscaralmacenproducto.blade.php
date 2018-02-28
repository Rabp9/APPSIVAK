@foreach($listaTAlmacenProducto as $key => $item)
    <div class="elementoBuscar contenedorEnumerado contenidoTop textAlignLeft bordeArriba bordeAbajo" style="width: 400px;">
        <span class="contenedorEnumeradoNumeracion"><b>{{{($key+1)}}}</b></span>
        <div id="codigoAlmacenProducto{{{$item->codigoAlmacenProducto}}}" style="display: none;">
            {{{$item->codigoAlmacenProducto}}}
        </div>
        <div id="codigoBarrasAlmacenProducto{{{$item->codigoAlmacenProducto}}}" class="filtroCodigoBarras" style="display: none;">
            {{{$item->codigoBarras}}}
        </div>
        <label><b>Primer nombre</b></label>
        <div id="primerNombreAlmacenProducto{{{$item->codigoAlmacenProducto}}}" class="displayInlineBlock backGroundColorAzulClaro">
            {{{$item->primerNombre}}}
        </div>
        <br>
        <label><b>Segundo nombre</b></label>
        <div id="segundoNombreAlmacenProducto{{{$item->codigoAlmacenProducto}}}" class="displayInlineBlock">
            {{{$item->segundoNombre}}}
        </div>
        <br>
<!--    <label><b>Tercer nombre</b></label>
        <div id="tercerNombreAlmacenProducto{{{$item->codigoAlmacenProducto}}}" class="displayInlineBlock">
            {{{$item->tercerNombre}}}
        </div>
        <br>	-->
        <label><b>Descripción</b></label>
        <div id="descripcionAlmacenProducto{{{$item->codigoAlmacenProducto}}}" class="displayInlineBlock">
            {{{$item->descripcion}}}
        </div>
        <br>
<!--    <label><b>Tipo</b></label>
        <div id="tipoAlmacenProducto{{{$item->codigoAlmacenProducto}}}" class="displayInlineBlock">
            {{{$item->tipo}}}
        </div>
        <div id="codigoPresentacionAlmacenProducto{{{$item->codigoAlmacenProducto}}}" style="display: none;">
            {{{$item->codigoPresentacion}}}
        </div>
        <div id="codigoUnidadMedidaAlmacenProducto{{{$item->codigoAlmacenProducto}}}" style="display: none;">
            {{{$item->codigoUnidadMedida}}}
        </div>
        <br>	-->
        <label><b>Presentación</b></label>
        <div id="nombrePresentacionAlmacenProducto{{{$item->codigoAlmacenProducto}}}" class="displayInlineBlock">
            {{{$item->tPresentacion->nombre}}}
        </div>
        <br>
        <label><b>Unidad de medida</b></label>
        <div id="nombreUnidadMedidaAlmacenProducto{{{$item->codigoAlmacenProducto}}}" class="displayInlineBlock">
            {{{$item->tUnidadMedida->nombre}}}
        </div>
        <br>
        <label><b>Cantidad</b></label>
        <div id="cantidadAlmacenProducto{{{$item->codigoAlmacenProducto}}}" class="displayInlineBlock {{{$item->cantidad>0 ? 'backGroundColorAzulClaro' : 'backGroundColorRojoClaro'}}}" style="min-width: 30px;">
            {{{$item->cantidad}}}
        </div>
        <br>
        <label><b>Ventas menor a unidad</b></label>
        <div id="ventaMenorUnidadAlmacenProducto{{{$item->codigoAlmacenProducto}}}" class="displayInlineBlock">
            {{{$item->ventaMenorUnidad==false?'No':'Si'}}}
        </div>
        <br>
<!--    <label><b>Precio de compra unitario</b></label>
        <div id="precioCompraUnitarioAlmacenProducto{{{$item->codigoAlmacenProducto}}}" class="displayInlineBlock">
            {{{$item->precioCompraUnitario}}}
        </div>
        <br>	-->
        <label><b>Precio de venta unitario</b></label>
        <div id="precioVentaUnitarioAlmacenProducto{{{$item->codigoAlmacenProducto}}}" class="displayInlineBlock backGroundColorVerdeClaro">
            {{{$item->precioVentaUnitario}}}
        </div>
        <br>
        <label><b>Unidades por bloque</b></label>
        <div id="unidadesBloqueAlmacenProducto{{{$item->codigoAlmacenProducto}}}" class="displayInlineBlock">
            {{{$item->unidadesBloque}}}
        </div>
        <br>
<!--   <label><b>Unidad Medida Bloque Producto</b></label>
        <div id="unidadMedidaBloqueAlmacenProducto{{{$item->codigoAlmacenProducto}}}" class="displayInlineBlock">
            {{{$item->unidadMedidaBloque}}}
        </div>
        <br>
        <label><b>Fecha de vencimiento</b></label>
        <div id="fechaVencimientoAlmacenProducto{{{$item->codigoAlmacenProducto}}}" class="displayInlineBlock">
            {{{$item->fechaVencimiento}}}
        </div>
        <br>	-->
        <div class="textAlignRight">
            <button id="btnSeleccionarAlmacenProducto{{{$item->codigoAlmacenProducto}}}" class="btnSeleccionarAlmacenProducto button">Seleccionar producto</button>
        </div>
    </div>
@endforeach