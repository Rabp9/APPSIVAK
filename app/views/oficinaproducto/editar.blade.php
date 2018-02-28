<form id="frmEditarOficinaProducto" action="/APPSIVAK/public/oficinaproducto/editar" method="post" class="formulario labelMediano textAlignCenter">
    <div class="contenidoTop textAlignLeft">
        <input type="text" style="display: none;">
        <input type="hidden" id="txtCodigoOficinaProducto" name="txtCodigoOficinaProducto" value="{{{$tOficinaProducto->codigoOficinaProducto}}}">
        <label for="txtDescripcion">Descripción</label>
        <textarea name="txtDescripcion" id="txtDescripcion" class="textarea" cols="55" rows="5">{{{$tOficinaProducto->descripcion}}}</textarea>
        <br>
        <label for="txtPrecioCompraUnitario">Precio de compra unitario</label>
        <input type="text" id="txtPrecioCompraUnitario" name="txtPrecioCompraUnitario" size="50" placeholder="Obligatorio" readonly="readonly" value="{{{$tOficinaProducto->precioCompraUnitario}}}">
        <br>
        <label for="txtPrecioVentaUnitario">Precio de venta unitario</label>
        <input type="text" id="txtPrecioVentaUnitario" name="txtPrecioVentaUnitario" size="50" placeholder="Obligatorio" value="{{{$tOficinaProducto->precioVentaUnitario}}}" onkeyup="onKeyUpCalcularPrecioVentaIGVNeto();">
        <br>
        <label for="txtPrecioVentaUnitarioProductoIgvAplicado">IGV aplicado al precio de venta</label>
        <input type="text" id="txtPrecioVentaUnitarioProductoIgvAplicado" name="txtPrecioVentaUnitarioProductoIgvAplicado" size="50" placeholder="Obligatorio" readonly="readonly" value="{{{isset($txtPrecioVentaUnitarioProductoIgvAplicado)?$txtPrecioVentaUnitarioProductoIgvAplicado:''}}}">
        <br>
        <label for="txtPrecioVentaUnitarioProductoNeto">Valor de venta neto</label>
        <input type="text" id="txtPrecioVentaUnitarioProductoNeto" name="txtPrecioVentaUnitarioProductoNeto" size="50" placeholder="Obligatorio" readonly="readonly" value="{{{isset($txtPrecioVentaUnitarioProductoNeto)?$txtPrecioVentaUnitarioProductoNeto:''}}}">
        <br>
        <label for="txtFechaVencimiento">Fecha de vencimiento</label>
        <input type="date" id="txtFechaVencimiento" name="txtFechaVencimiento" value="{{{$tOficinaProducto->fechaVencimiento}}}">
        <br>
    </div>
    <div class="seccionBotones bordeArriba">
        <input type="button" value="Guardar cambios" onclick="enviarFrmEditarOficinaProducto();">
    </div>
</form>
<script>
    function onKeyUpCalcularPrecioVentaIGVNeto()
    {
        if(valDosDecimales($('#txtPrecioVentaUnitario').val()))
        {
            $('#txtPrecioVentaUnitarioProductoIgvAplicado').val(calcularIgv($('#txtPrecioVentaUnitario').val()));
            $('#txtPrecioVentaUnitarioProductoNeto').val(calcularSubTotal($('#txtPrecioVentaUnitario').val()));
        }
        else
        {
            $('#txtPrecioVentaUnitarioProductoIgvAplicado').val('');
            $('#txtPrecioVentaUnitarioProductoNeto').val('');
        }
    }

    onKeyUpCalcularPrecioVentaIGVNeto();

    function enviarFrmEditarOficinaProducto()
    {
        var mensajeGlobal='';
        
        mensajeGlobal+=(!valDosDecimales($('#txtPrecioVentaUnitario').val())?'El precio de venta unitario debe ser en soles<br>':'');
        mensajeGlobal+=(!valFechaYYYYMMDD($('#txtFechaVencimiento').val())?'Fecha de vencimiento incorrecto<br>':'');

        if(mensajeGlobal!='')
        {
            animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
            return;
        }

        if(confirm('Realmente desea editar los datos del Producto'))
        {       
            $('#frmEditarOficinaProducto').submit();
            return;
        }
        alert('Operación Cancelada');
    }
</script>