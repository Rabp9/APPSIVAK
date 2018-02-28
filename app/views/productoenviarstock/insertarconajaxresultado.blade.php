@if(isset($mensajeGlobal) && $mensajeGlobal!='')
    <script>animacionAlertaMensajeGeneral('{{$mensajeGlobal}}', '{{$color}}');</script>
@endif
@if(isset($correcto) && $correcto)
	<script>
        @foreach($listaProductosAgregados as $value)
    		var productoExisteLista=false;

            $('#bodyTablaProductosAgregados').find('tr').each(function(index, elemento)
            {
                if(productoExisteLista)
                {
                    return false;
                }

                $(elemento).find('td').each(function(index2, elemento2)
                {
                    if(!productoExisteLista && $(elemento2).text()=='{{{$value[0]->codigoOficinaProducto}}}')
                    {
                        productoExisteLista=true;

                        animacionAlertaMensajeGeneral('Cantidad agregada +1 al producto en la lista', '#FF8F00');
                    }

                    if(productoExisteLista && index2==13)
                    {
                        $(elemento2).text(parseInt($(elemento2).text())+parseFloat('{{{$value[1]}}}'));
                        calcularCantidad('bloque', '{{{$value[0]->codigoOficinaProducto}}}');
                        calcularPrecioVentaSubTotalProducto('{{{$value[0]->codigoOficinaProducto}}}');

                        return false;
                    }
                });
            });

            if(!productoExisteLista)
            {
                var nuevoProducto=''+
                '<tr class="elementoBuscar">'+
                    '<td style="display: none;">'+'{{{$value[0]->codigoOficinaProducto}}}'+'</td>'+
                    '<td style="display: none;">'+'{{{$value[0]->codigoBarras}}}'+'</td>'+
                    '<td style="display: none;">'+'{{{$value[0]->primerNombre}}}'+'</td>'+
                    '<td style="display: none;">'+'{{{$value[0]->segundoNombre}}}'+'</td>'+
                    '<td style="display: none;">'+'{{{$value[0]->tercerNombre}}}'+'</td>'+
                    '<td>'+'{{{$value[0]->primerNombre}}}'+' / '+'{{{$value[0]->segundoNombre}}}'+' / '+'{{{$value[0]->tercerNombre}}}'+'</td>'+
                    '<td style="display: none;">'+'{{{$value[0]->descripcion}}}'+'</td>'+
                    '<td>'+'{{{$value[0]->tipo}}}'+'</td>'+
                    '<td>'+'{{{$value[0]->categoria}}}'+'</td>'+
                    '<td style="display: none;">'+'{{{$value[0]->categoria}}}'+'</td>'+
                    '<td>'+'{{{$value[0]->presentacion}}}'+'</td>'+
                    '<td>'+'{{{$value[0]->unidadMedida}}}'+'</td>'+
                    '<td id="precioUnitarioProducto'+'{{{$value[0]->codigoOficinaProducto}}}'+'">'+'{{{$value[0]->precioVentaUnitario}}}'+'</td>'+
                    '<td id="cantidadProducto'+'{{{$value[0]->codigoOficinaProducto}}}'+'" onkeyup=calcularCantidad("bloque",'+'{{{$value[0]->codigoOficinaProducto}}}'+');calcularPrecioVentaSubTotalProducto('+'{{{$value[0]->codigoOficinaProducto}}}'+');cargarListaProductos(); contenteditable=true class="colorCampoEditable textAlignCenter">{{{$value[1]}}}</td>'+
                    '<td id="cantidadBloqueProducto'+'{{{$value[0]->codigoOficinaProducto}}}'+'" onkeyup=calcularCantidad("unidad",'+'{{{$value[0]->codigoOficinaProducto}}}'+');calcularPrecioVentaSubTotalProducto('+'{{{$value[0]->codigoOficinaProducto}}}'+');cargarListaProductos(); contenteditable=true class="colorCampoEditable textAlignCenter"></td>'+
                    '<td id="unidadesBloqueProducto'+'{{{$value[0]->codigoOficinaProducto}}}'+'">'+'{{{$value[0]->unidadesBloque}}}'+'</td>'+
                    '<td>'+'{{{$value[0]->unidadMedidaBloque}}}'+'</td>'+
                    '<td id="precioVentaSubTotalProducto'+'{{{$value[0]->codigoOficinaProducto}}}'+'" onkeyup=cargarListaProductos();calcularSubTotalIgvTotalReciboVentaInsertar(); contenteditable=true class="colorCampoEditable textAlignCenter"></td>'+
                    '<td><input type="button" value="Eliminar" onclick="eliminarProductoLista(this);"></td>'+
                '</tr>';
                $('#bodyTablaProductosAgregados').prepend(nuevoProducto);

                if(parseFloat($('#unidadesBloqueProducto'+'{{{$value[0]->codigoOficinaProducto}}}').text())==0)
                {
                    $('#cantidadBloqueProducto'+'{{{$value[0]->codigoOficinaProducto}}}').attr('contenteditable', false);
                    $('#cantidadBloqueProducto'+'{{{$value[0]->codigoOficinaProducto}}}').removeClass('colorCampoEditable');
                }

                calcularCantidad('bloque', '{{{$value[0]->codigoOficinaProducto}}}');
                calcularPrecioVentaSubTotalProducto('{{{$value[0]->codigoOficinaProducto}}}');

                animacionAlertaMensajeGeneral('Producto(s) agregado a la lista', '#1497CC');
            }

            cargarListaProductos();
        @endforeach
		
		$('#dialogo').dialog('close');
	</script>
@endif