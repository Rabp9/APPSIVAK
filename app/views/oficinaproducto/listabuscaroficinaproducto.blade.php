@foreach($listaTOficinaProducto as $key => $item)
    <div class="contenidoTop contenedorEnumerado textAlignLeft bordeArriba bordeAbajo" style="width: 400px;">
        <br>
		<span class="contenedorEnumeradoNumeracion"><b>{{{($key+1)}}}</b></span>
        <div id="codigoOficinaProducto{{{$item->codigoOficinaProducto}}}" style="display: none;">
            {{{$item->codigoOficinaProducto}}}
        </div>
        <div id="codigoBarrasOficinaProducto{{{$item->codigoOficinaProducto}}}" class="filtroCodigoBarras" style="display: none;">
            {{{$item->codigoBarras}}}
        </div>
        <label><b>PRODUCTO</b></label>
        <div id="primerNombreOficinaProducto{{{$item->codigoOficinaProducto}}}" class="displayInlineBlock ">
            <strong>{{{$item->primerNombre}}}</strong>
        </div>
        <br>
 <!--       <label><b>Segundo nombre</b></label>
        <div id="segundoNombreOficinaProducto{{{$item->codigoOficinaProducto}}}" class="displayInlineBlock">
            {{{$item->segundoNombre}}}
        </div>
		<br>
		<label><b>Tercer nombre</b></label>
        <div id="tercerNombreOficinaProducto{{{$item->codigoOficinaProducto}}}" class="displayInlineBlock">
            {{{$item->tercerNombre}}}
        </div> 
        <br>
        <label><b>Descripción</b></label>
        <div id="descripcionOficinaProducto{{{$item->codigoOficinaProducto}}}" class="displayInlineBlock">
            {{{$item->descripcion}}}
        </div>
		<br>
	<label><b>Tipo</b></label>
        <div id="tipoOficinaProducto{{{$item->codigoOficinaProducto}}}" class="displayInlineBlock">
            {{{$item->tipo}}}
        </div>
        <br>	
        <label><b>Categoría</b></label>
        <div id="categoriaOficinaProducto{{{$item->codigoOficinaProducto}}}" class="displayInlineBlock">
            {{{$item->categoria}}}
        </div> 
        <br>	-->
        <label><b>PRESENTACION</b></label>
        <div id="presentacionOficinaProducto{{{$item->codigoOficinaProducto}}}" class="displayInlineBlock">
            {{{$item->presentacion}}}
        </div>
        <br>
        <label><b>UNIDAD DE MEDIDA</b></label>
        <div id="unidadMedidaOficinaProducto{{{$item->codigoOficinaProducto}}}" class="displayInlineBlock">
            {{{$item->unidadMedida}}}
        </div>
        <br>
        <label><b>CANTIDAD</b></label>
        <div id="cantidadOficinaProducto{{{$item->codigoOficinaProducto}}}" class="displayInlineBlock {{{$item->cantidad>0 ? 'backGroundColorAzulClaro' : 'backGroundColorRojoClaro'}}}" style="min-width: 35px;">
            <strong>{{{$item->cantidad}}}</strong>
        </div>
        <br>
        <label><b>VENTA MENOR A UNIDAD</b></label>
        <div id="ventaMenorUnidadOficinaProducto{{{$item->codigoOficinaProducto}}}" class="displayInlineBlock">
            {{{$item->ventaMenorUnidad==false?'NO':'SI'}}}
        </div>
		<br>
<!--	<label><b>Precio de compra unitario</b></label>
        <div id="precioCompraUnitarioOficinaProducto{{{$item->codigoOficinaProducto}}}" class="displayInlineBlock">
            {{{$item->precioCompraUnitario}}}
        </div>  
        <br>	-->
        <label class="displayInlineBlock backGroundColorGrisMasClaro"><b>PRECIO UNITARIO</b></label>
        <div id="precioVentaUnitarioOficinaProducto{{{$item->codigoOficinaProducto}}}" class="displayInlineBlock backGroundColorVerdeBajo">
            <strong>{{{$item->precioVentaUnitario}}}</strong>
        </div>
		<br>
		<label><b>UNIDAD X BLOQUE</b></label>
        <div id="unidadesBloqueOficinaProducto{{{$item->codigoOficinaProducto}}}" class="displayInlineBlock">
            {{{$item->unidadesBloque}}}
        </div>
        <br>
<!--    <label><b>Unidad Medida Bloque</b></label>
        <div id="unidadMedidaBloqueOficinaProducto{{{$item->codigoOficinaProducto}}}" class="displayInlineBlock">
            {{{$item->unidadMedidaBloque}}}
        </div> 
        <br>
        <label><b>Fecha de vencimiento</b></label>
        <div id="fechaVencimientoOficinaProducto{{{$item->codigoOficinaProducto}}}" class="displayInlineBlock">
            {{{$item->fechaVencimiento}}}
        </div>
        <br>  -->
        <div class="textAlignRight">
            <button id="btnSeleccionarOficinaProducto{{{$item->codigoOficinaProducto}}}" class="btnSeleccionarOficinaProducto button">Agregar a la lista</button>
        </div>
    </div>
@endforeach