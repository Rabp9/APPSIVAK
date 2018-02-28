@extends('layout.layout')

@section('contenidoCuerpo')
    <h2 class="textAlignCenter bordeAbajo tituloCabecera">REGISTRAR PRODUCTO EN ALMACÉN</h2>
    @if($cajaAbierta==0)
        <div class="alertaMensajeError">
            Debe abrir caja para este usuario antes de proseguir con las operaciones de entrada y salida monetaria.
        </div>
    @endif
    @if($cajaAbierta==2)
        <div class="alertaMensajeError">
            La caja del día de hoy para este usuario ya fue cerrado.
        </div>
    @endif
    @if($cajaAbierta==1)
        <section class="contenidoTop">
            <section class="formulario labelGrande">
                <form id="frmInsertarReciboCompra" action="/APPSIVAK/public/recibocompra/insertar" method="post">
                    <div class="contenidoTop textAlignLeft">
                        <h2>Datos Generales</h2>
                        <hr>
                        <label for="txtNombreProveedor">Nombre de Proveedor</label>
                        <input type="text" id="txtNombreProveedor" name="txtNombreProveedor" size="50" placeholder="Obligatorio" readonly="readonly" value="{{{isset($txtNombreProveedor)?$txtNombreProveedor:''}}}">
                        <input type="button" id="btnBuscarProveedor" value="Buscar Proveedor" style="width: 200px;" onclick="ocultarDivsBuscar(); mostrarDivBuscar('divBuscarEnTablaProveedor'); mostrarApartadoBuscar();">
                        <input type="hidden" id="txtCodigoProveedor" name="txtCodigoProveedor" readonly="readonly" value="{{{isset($txtCodigoProveedor)?$txtCodigoProveedor:''}}}">
                        <br>
                        <label for="txtDescripcionAlmacen">Descripción de Almacén</label>
                        <input type="text" id="txtDescripcionAlmacen" name="txtDescripcionAlmacen" size="50" placeholder="Obligatorio" readonly="readonly" value="{{{isset($txtDescripcionAlmacen)?$txtDescripcionAlmacen:''}}}">
                        <input type="button" id="btnBuscarAlmacen" value="Buscar Almacén" style="width: 200px;" onclick="ocultarDivsBuscar(); mostrarDivBuscar('divBuscarEnTablaAlmacen'); mostrarApartadoBuscar();">
                        <input type="hidden" id="txtCodigoAlmacen" name="txtCodigoAlmacen" readonly="readonly" value="{{{isset($txtCodigoAlmacen)?$txtCodigoAlmacen:''}}}">
                        <hr>
                        <label for="cbxTipoRecibo">Tipo de Comprobante</label>
                        <select name="cbxTipoRecibo" id="cbxTipoRecibo" onchange="cambioCbxTipoRecibo();">
                            <option value="Ninguno" {{{isset($cbxTipoRecibo) && $cbxTipoRecibo=='Ninguno'?"selected":''}}}>Ninguno</option>
                            <option value="Recibo" {{{isset($cbxTipoRecibo) && $cbxTipoRecibo=='Recibo'?"selected":''}}}>Recibo</option>
                            <option value="Boleta" {{{isset($cbxTipoRecibo) && $cbxTipoRecibo=='Boleta'?"selected":''}}}>Boleta</option>
                            <option value="Factura" {{{isset($cbxTipoRecibo) && $cbxTipoRecibo=='Factura'?"selected":''}}}>Factura</option>
                        </select>
                        <br>
                        <div id="divDatosAdicionalesRecibo" style="display: none;">
                            <label for="txtNumeroRecibo">Número de Comprobante</label>
                            <input type="text" id="txtNumeroRecibo" name="txtNumeroRecibo" autocomplete="off" placeholder="Obligatorio" value="{{{isset($txtNumeroRecibo)?$txtNumeroRecibo:''}}}">
                            <br>
                            <label for="dateFechaComprobanteEmitido">Fecha de emisión del comprobante</label>
                            <input type="date" id="dateFechaComprobanteEmitido" name="dateFechaComprobanteEmitido" value="{{{isset($dateFechaComprobanteEmitido) ? $dateFechaComprobanteEmitido : '1111-11-11'}}}">
                            (Si no dispone de este dato, marque la fecha "11-11-1111")
                            <br>
                        </div>
                        <label class="contenidoMiddle">Tipo de Pago</label>
                        <div class="contenidoMiddle">
                            <input type="radio" id="radioContado" name="radioTipoPago" onchange="cambioRadioTipoPago();" value="Al Contado" {{{isset($radioTipoPago) && $radioTipoPago=='Al Contado'?"checked='checked'":''}}} {{{!isset($radioTipoPago)?"checked='checked'":''}}}>
                            <label class="noLabel" for="radioContado">Al Contado</label>
                            <br>
                            <input type="radio" id="radioCredito" name="radioTipoPago" onchange="cambioRadioTipoPago();" value="Al Crédito" {{{isset($radioTipoPago) && $radioTipoPago=='Al Crédito'?"checked='checked'":''}}}>
                            <label class="noLabel" for="radioCredito">Al Crédito</label>
                        </div>
                        <br>
                        <div id="divAlCredito" style="display: none;">
                            <label for="dateFechaPagar">Fecha a pagar</label>
                            <input type="date" id="dateFechaPagar" name="dateFechaPagar" value="{{{isset($dateFechaPagar) ? $dateFechaPagar : ''}}}">
                        </div>
                        <label for="checkBuscarOficina"><b>Enviar productos de este registro directamente a stock</b></label>
                        <input type="checkbox" id="checkBuscarOficina" name="checkBuscarOficina" value="Buscar Oficina" {{{(isset($checkBuscarOficina) && $checkBuscarOficina=='Buscar Oficina') ? 'checked=true' : ''}}} onchange="cambioCheckBuscarOficina();">
                        <div id="divEnviarDirectoStock" style="display: none;">
                            <label for="txtDescripcionOficina">Nombre de Oficina</label>
                            <input type="text" id="txtDescripcionOficina" name="txtDescripcionOficina" size="50" placeholder="Obligatorio" readonly="readonly" value="{{{isset($txtDescripcionOficina)?$txtDescripcionOficina:''}}}">
                            <input type="button" id="btnBuscarOficina" value="Buscar Oficina" style="width: 200px;" onclick="ocultarDivsBuscar(); mostrarDivBuscar('divBuscarEnTablaOficina'); mostrarApartadoBuscar();">
                            <input type="hidden" id="txtCodigoOficina" name="txtCodigoOficina" readonly="readonly" value="{{{isset($txtCodigoOficina)?$txtCodigoOficina:''}}}">
                        </div>
                    </div>
                    <br>
                    <input type="hidden" id="txtDescripcion" name="txtDescripcion" value="{{{isset($txtDescripcion)?$txtDescripcion:''}}}">
                    <input type="hidden" id="txtListaProductos" name="txtListaProductos" value="{{{isset($txtListaProductos)?$txtListaProductos:''}}}">
                    <input type="hidden" id="txtHtmlListaProductos" name="txtHtmlListaProductos" value="{{{isset($txtHtmlListaProductosDevueltos)?$txtHtmlListaProductosDevueltos:''}}}">
                    <input type="hidden" id="txtSubTotal" name="txtSubTotal" class="text" value="{{{isset($txtSubTotal)?$txtSubTotal:'0.00'}}}">
                    <input type="hidden" id="txtIgv" name="txtIgv" class="text" value="{{{isset($txtIgv)?$txtIgv:'0.00'}}}">
                    <input type="hidden" id="txtTotal" name="txtTotal" class="text" value="{{{isset($txtTotal)?$txtTotal:'0.00'}}}">
                </form>
                <hr>
                <div class="textAlignLeft" style="margin: 4px;">
                    <section id="seccionFormularioProductos">
                        <h2 id="tituloDatosProductos">Datos de los Productos</h2>
                        <hr>
                        <label for="checkBuscarProductoExistente"><b>Buscar Producto Existente</b></label>
                        <input type="checkbox" id="checkBuscarProductoExistente" name="checkBuscarProductoExistente" value="Buscar Producto Existente" onchange="cambioCheckBuscarProductoExistente();">
                        <input type="button" id="btnBuscarAlmacenProducto" class="button" style="display: none;width: 200px;" value="Buscar Producto" onclick="ocultarDivsBuscar(); mostrarDivBuscar('divBuscarEnTablaAlmacenProducto'); mostrarApartadoBuscar();" style="display: none;" disabled>
                        <br>
                        <label for="txtCodigoBarrasProducto">Código de Barras</label>
                        <input type="text" id="txtCodigoBarrasProducto" name="txtCodigoBarrasProducto" size="50" value="{{{isset($txtCodigoBarrasProducto)?$txtCodigoBarrasProducto:''}}}">
                        <br>
                        <label for="txtPrimerNombreProducto">Primer Nombre del Producto</label>
                        <input type="text" id="txtPrimerNombreProducto" name="txtPrimerNombreProducto" size="50" placeholder="Obligatorio" value="{{{isset($txtPrimerNombreProducto)?$txtPrimerNombreProducto:''}}}">
                        <br>
                        <label for="txtSegundoNombreProducto">Segundo Nombre del Producto</label>
                        <input type="text" id="txtSegundoNombreProducto" name="txtSegundoNombreProducto" size="50" value="{{{isset($txtSegundoNombreProducto)?$txtSegundoNombreProducto:''}}}">
                        <br>
                        <label for="txtTercerNombreProducto">Tercer Nombre del Producto</label>
                        <input type="text" id="txtTercerNombreProducto" name="txtTercerNombreProducto" size="50" value="{{{isset($txtTercerNombreProducto)?$txtTercerNombreProducto:''}}}">
                        <br>
                        <label for="txtDescripcionProducto">Descripción del Producto</label>
                        <textarea name="txtDescripcionProducto" id="txtDescripcionProducto" cols="50" rows="5">{{{isset($txtDescripcionProducto)?$txtDescripcionProducto:''}}}</textarea>
                        <br>
                        <label for="txtFechaVencimientoProducto">Fecha de Vencimiento</label>
                        <input type="date" id="txtFechaVencimientoProducto" name="txtFechaVencimientoProducto" value="{{{isset($txtFechaVencimientoProducto)?$txtFechaVencimientoProducto:'1111-11-11'}}}">
                        (Si el producto no vence, marque la fecha "11-11-1111")
                        <br>
                        <div id="divAlertaCambioDatos" style="background-color: #FF8F00;color:white;display: none;width: 100%;">
                            <div class="contenidoMiddle">
                                Si modifica uno de los 3 campos siguientes se recomienda deshabilitar la opción<br>
                                "Buscar Producto Existente" para editar los campos necesarios en caso de que se<br>
                                cree un nuevo producto.
                            </div>
                        </div>
                        <label for="cbxTipoProducto">Tipo de Producto</label>
                        <select name="cbxTipoProducto" id="cbxTipoProducto">
                            <option value="Genérico" {{{isset($cbxTipoProducto) && $cbxTipoProducto=='Genérico'?"selected":''}}}>Genérico</option>
                            <option value="Comercial" {{{isset($cbxTipoProducto) && $cbxTipoProducto=='Comercial'?"selected":''}}}>Comercial</option>
                        </select>
                        <div id="divPresentacionProducto">
                            <label for="cbxCodigoPresentacionProducto">Presentación del Producto</label>
                            <select name="cbxCodigoPresentacionProducto" id="cbxCodigoPresentacionProducto" class="contenidoMiddle" style="min-width: 391px;">
                                @foreach($listaTPresentacion as $item) 
                                    <option value="{{{$item->codigoPresentacion}}}">{{{$item->nombre}}}</option>
                                @endforeach
                            </select>
                            <button class="button contenidoMiddle" style="width: 250px;" onclick="dialogoAjax('dialogo', 450, true, 'Registrar presentación', 'top', null, '/APPSIVAK/public/presentacion/insertarconajax', 'POST', null, null, false, true);">Añadir presentación</button>
                        </div>
                        <div id="divUnidadMedidaProducto">
                            <label for="cbxCodigoUnidadMedidaProducto">Unidad de Medida</label>
                            <select name="cbxCodigoUnidadMedidaProducto" id="cbxCodigoUnidadMedidaProducto" class="contenidoMiddle" style="min-width: 391px;">
                                @foreach($listaTUnidadMedida as $item) 
                                    <option value="{{{$item->codigoUnidadMedida}}}">{{{$item->nombre}}}</option>
                                @endforeach
                            </select>
                            <button class="button contenidoMiddle" style="width: 250px;" onclick="dialogoAjax('dialogo', 450, true, 'Registrar unidad de medida', 'top', null, '/APPSIVAK/public/unidadmedida/insertarconajax', 'POST', null, null, false, true);">Añadir unidad de medida</button>
                        </div>
                        <label for="txtCantidadProducto">Cantidad del Producto</label>
                        <input type="text" id="txtCantidadProducto" name="txtCantidadProducto" size="50" placeholder="Obligatorio" value="{{{isset($txtCantidadProducto)?$txtCantidadProducto:''}}}" onkeyup="onKeyUpCalcularPrecioCompraUnitario();">
                        <br>
                        <label for="txtPrecioCompraTotalProducto">Precio de Compra Total del Producto</label>
                        <input type="text" id="txtPrecioCompraTotalProducto" name="txtPrecioCompraTotalProducto" size="50" placeholder="Obligatorio" value="{{{isset($txtPrecioCompraTotalProducto)?$txtPrecioCompraTotalProducto:''}}}" onkeyup="onKeyUpCalcularPrecioCompraUnitario();">
                        <label id="labelCheckEditarPrecioCompraTotal" for="checkEditarPrecioCompraTotal" class="noLabel" style="display: none;"><b>&#60; Editar</b></label>
                        <input type="checkbox" id="checkEditarPrecioCompraTotal" name="checkEditarPrecioCompraTotal" class="contenidoMiddle" value="Editar precio de compra total" style="display: none;" onchange="cambioCheckEditarPrecioCompraTotal();">
                        <br>
                        <label for="txtPrecioCompraUnitarioProducto">Precio de Compra Unitario del Producto</label>
                        <input type="text" id="txtPrecioCompraUnitarioProducto" name="txtPrecioCompraUnitarioProducto" size="50" placeholder="Obligatorio" readonly="readonly" value="{{{isset($txtPrecioCompraUnitarioProducto)?$txtPrecioCompraUnitarioProducto:''}}}">
                        <input type="hidden" id="txtPrecioCompraUnitarioProductoOculto" name="txtPrecioCompraUnitarioProductoOculto" size="50" placeholder="Obligatorio" readonly="readonly" value="{{{isset($txtPrecioCompraUnitarioProductoOculto)?$txtPrecioCompraUnitarioProductoOculto:''}}}">
                        <br>
                        <div id="divRegistroExistenteHide">                        
                            <label for="txtPrecioVentaUnitarioProducto">Precio de Venta Unitario del Producto</label>
                            <input type="text" id="txtPrecioVentaUnitarioProducto" name="txtPrecioVentaUnitarioProducto" size="50" placeholder="Obligatorio" value="{{{isset($txtPrecioVentaUnitarioProducto)?$txtPrecioVentaUnitarioProducto:''}}}" onkeyup="onKeyUpCalcularPrecioVentaIGVNeto();">
                            <br>
                            <label for="txtPrecioVentaUnitarioProductoIgvAplicado">IGV aplicado al precio de venta</label>
                            <input type="text" id="txtPrecioVentaUnitarioProductoIgvAplicado" name="txtPrecioVentaUnitarioProductoIgvAplicado" size="50" placeholder="Obligatorio" readonly="readonly" value="{{{isset($txtPrecioVentaUnitarioProductoIgvAplicado)?$txtPrecioVentaUnitarioProductoIgvAplicado:''}}}">
                            <br>
                            <label for="txtPrecioVentaUnitarioProductoNeto">Valor de venta neto</label>
                            <input type="text" id="txtPrecioVentaUnitarioProductoNeto" name="txtPrecioVentaUnitarioProductoNeto" size="50" placeholder="Obligatorio" readonly="readonly" value="{{{isset($txtPrecioVentaUnitarioProductoNeto)?$txtPrecioVentaUnitarioProductoNeto:''}}}">
                            <br>
                            <label for="txtUnidadesBloqueProducto">Unidades por Bloque</label>
                            <input type="text" id="txtUnidadesBloqueProducto" name="txtUnidadesBloqueProducto" size="50" placeholder="Obligatorio" value="{{{isset($txtUnidadesBloqueProducto)?$txtUnidadesBloqueProducto:'10'}}}">
                            <br>
                            <label for="txtUnidadMedidaBloqueProducto">Unidad de medida del bloque</label>
                            <input type="text" id="txtUnidadMedidaBloqueProducto" name="txtUnidadMedidaBloqueProducto" size="50" value="{{{isset($txtUnidadMedidaBloqueProducto)?$txtUnidadMedidaBloqueProducto:'Decena'}}}">
                            <br>
                            <label class="contenidoMiddle">Permitir Ventas Menor a su Unidad</label>
                            <div class="contenidoMiddle">
                                <input type="radio" id="radioSi" name="radioVentaMenorUnidadProducto" value="Si" {{{isset($radioVentaMenorUnidadProducto) && $radioVentaMenorUnidadProducto=='Si'?"checked='checked'":''}}}>
                                <label class="noLabel" for="radioSi">Si</label>
                                <br>
                                <input type="radio" id="radioNo" name="radioVentaMenorUnidadProducto" value="No" {{{isset($radioVentaMenorUnidadProducto) && $radioVentaMenorUnidadProducto=='No'?"checked='checked'":''}}} {{{!isset($radioVentaMenorUnidadProducto)?"checked='checked'":''}}}>
                                <label class="noLabel" for="radioNo">No</label>
                            </div>
                        </div>
                    </section>                
                </div>
                <div class="seccionBotones bordeArriba">
                    <input type="button" value="Agregar Producto a la Lista" onclick="agregarProductoListaRegistro();">
                </div>
            </section>
        </section>
        <hr>
        <section>
            <div class="bordeAbajo textAlignLeft">
                <label class="contenidoMiddle noLabel">Buscar: </label>
                <input type="text" class="contenidoMiddle text" size="50" onkeyup="filtrarHtml('tableProductoAgregado', this.value, false, 200, event);">            
            </div>
            <table id="tableProductoAgregado" class="textoMediano table">
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
                    <th>P. V. UNITARIO</th>
                    <th>CANTIDAD</th>
                    <th>VENTAS EN DECIMALES</th>
                    <th>UNIDADES POR BLOQUE</th>
                    <th>UNIDAD MEDIDA BLOQUE</th>
                    <th>FECHA DE VENCIMIENTO</th>
                    <th class="widthEditarTable"></th>
                </thead>
                <tbody id="bodyTablaProductosAgregados">

                </tbody>
            </table>
            <div class="textAlignRight">
                <div id="divCalculoSegunComprobante" class="contenidoMiddle" style="display: none;">
                    <label for="txtSubTotalTemporal">Sub Total</label>
                    <input type="text" id="txtSubTotalTemporal" name="txtSubTotalTemporal" class="text" readonly=true value="{{{isset($txtSubTotal)?$txtSubTotal:'0.00'}}}" style="background-color: #EEEEEE;">
                    <label for="txtIgvTemporal">Igv</label>
                    <input type="text" id="txtIgvTemporal" name="txtIgvTemporal" class="text" readonly=true value="{{{isset($txtIgv)?$txtIgv:'0.00'}}}" style="background-color: #EEEEEE;">
                </div>
                <label for="txtTotalTemporal">Total</label>
                <input type="text" id="txtTotalTemporal" name="txtTotalTemporal" class="text" readonly=true value="{{{isset($txtTotal)?$txtTotal:'0.00'}}}" style="background-color: #EEEEEE;">
            </div>
            <hr>
            <label for="txtDescripcionTemporal">Descripción Adicional del Registro</label>
            <br>
            <textarea name="txtDescripcionTemporal" id="txtDescripcionTemporal" class="textarea" cols="70" rows="5">{{{isset($txtDescripcion)?$txtDescripcion:''}}}</textarea>
        </section>
        <hr>
        <div class="textAlignRight">
            <input type="button" class="button" value="Registrar Datos" onclick="enviarFrmInsertarReciboCompra();" style="height: 40px;width: 420px;">
        </div>
        <section id="apartadoBuscar" class="apartadoBuscar">
            <div id="divBuscarEnTablaProveedor">
                <script>
                    paginaAjax('divBuscarEnTablaProveedor', null, '/APPSIVAK/public/proveedor/buscarproveedor', 'POST', null, null, false, true);
                </script>
            </div>
            <div id="divBuscarEnTablaAlmacen">
                <script>
                    paginaAjax('divBuscarEnTablaAlmacen', null, '/APPSIVAK/public/almacen/buscaralmacen', 'POST', null, null, false, true);
                </script>
            </div>
            <div id="divBuscarEnTablaOficina">
                <script>
                    paginaAjax('divBuscarEnTablaOficina', null, '/APPSIVAK/public/oficina/buscaroficina', 'POST', null, null, false, true);
                </script>
            </div>
            <div id="divBuscarEnTablaAlmacenProducto">
                <h2 class="textAlignCenter bordeAbajo">PRODUCTOS DE ALMACÉN</h2>
                <section class="anchoCompleto textAlignLeft backGroundColorGrisClaro">
                    <label class="contenidoMiddle">Buscar</label>
                    <input type="text" class="contenidoMiddle text" size="50" onkeypress="actionListaBuscarAlmacenProductoAgrupado('divListaBuscarAlmacenProductoAgrupado', this.value, event);">
                    <input type="button" class="contenidoMiddle button" value="Ocultar Búsqueda" onclick="ocultarApartadoBuscar();">
                </section>
                <section id="divListaBuscarAlmacenProductoAgrupado" class="anchoCompleto labelPequenio textoMediano">
                    
                </section>
                <script>
                    var lanzarEventoListaBuscarAlmacenProductoAgrupadoPorNombre;

                    function actionListaBuscarAlmacenProductoAgrupado(idSeccion, nombreCompletoProducto, event)
                    {
                        var code=(event.keyCode ? event.keyCode : event.which);

                        if(code==13)
                        {
                            clearTimeout(lanzarEventoListaBuscarAlmacenProductoAgrupadoPorNombre);

                            lanzarEventoListaBuscarAlmacenProductoAgrupadoPorNombre=setTimeout(function()
                            {
                                paginaAjax(idSeccion, {nombreCompletoProducto: nombreCompletoProducto}, '/APPSIVAK/public/almacenproducto/listabuscaralmacenproductoagrupadopornombre', 'POST', null, function()
                                {
                                    $('.btnSeleccionarAlmacenProductoAgrupado').on('click', function()
                                    {
                                        var codigoAlmacenProducto=this.id.substring(37);
                                        
                                        seleccionarBuscarAlmacenProducto(codigoAlmacenProducto);
                                    });
                                }, false, true);
                            }, 500);
                        }
                    }
                </script>
            </div>
        </section>        
        <script>
            $(document).on('ready', function()
            {
                if($('#txtListaProductos').val()!='')
                {
                    cambioCbxTipoRecibo();
                    cambioRadioTipoPago();
                    cambioCheckBuscarOficina();

                    $('#bodyTablaProductosAgregados').html($('#txtHtmlListaProductos').val());
                }
            });

            function onKeyUpCalcularPrecioCompraUnitario()
            {
                if($('input[name="checkBuscarProductoExistente"]:checked').val()=='Buscar Producto Existente' && $('input[name="checkEditarPrecioCompraTotal"]:checked').val()!='Editar precio de compra total')
                {
                    if(valDosDecimales($('#txtCantidadProducto').val()) && valDosDecimales($('#txtPrecioCompraUnitarioProducto').val()) && $('#txtCantidadProducto').val()!=0)
                    {
                        var precioCompraTotalProducto=$('#txtPrecioCompraUnitarioProducto').val()*$('#txtCantidadProducto').val();
                        precioCompraTotalProducto=precioCompraTotalProducto.toFixed(2);

                        $('#txtPrecioCompraTotalProducto').val(precioCompraTotalProducto);
                    }
                    else
                    {
                        if(valDosDecimales($('#txtCantidadProducto').val()) && valDosDecimales($('#txtPrecioCompraUnitarioProducto').val()) && $('#txtCantidadProducto').val()==0)
                        {
                            $('#txtPrecioCompraTotalProducto').val($('#txtPrecioCompraUnitarioProducto').val());
                        }
                        else
                        {
                            $('#txtPrecioCompraTotalProducto').val('');
                        }
                    }
                }
                else
                {
                    if(valDosDecimales($('#txtCantidadProducto').val()) && valDosDecimales($('#txtPrecioCompraTotalProducto').val()) && $('#txtCantidadProducto').val()!=0)
                    {
                        var precioCompraUnitarioProducto=$('#txtPrecioCompraTotalProducto').val()/$('#txtCantidadProducto').val();
                        precioCompraUnitarioProducto=precioCompraUnitarioProducto.toFixed(2);

                        $('#txtPrecioCompraUnitarioProducto').val(precioCompraUnitarioProducto);
                    }
                    else
                    {
                        if(valDosDecimales($('#txtCantidadProducto').val()) && valDosDecimales($('#txtPrecioCompraTotalProducto').val()) && $('#txtCantidadProducto').val()==0)
                        {
                            $('#txtPrecioCompraUnitarioProducto').val($('#txtPrecioCompraTotalProducto').val());
                        }
                        else
                        {
                            $('#txtPrecioCompraUnitarioProducto').val('');
                        }
                    }
                }
            }

            function onKeyUpCalcularPrecioVentaIGVNeto()
            {
                if(valDosDecimales($('#txtPrecioVentaUnitarioProducto').val()))
                {
                    $('#txtPrecioVentaUnitarioProductoIgvAplicado').val(calcularIgv($('#txtPrecioVentaUnitarioProducto').val()));
                    $('#txtPrecioVentaUnitarioProductoNeto').val(calcularSubTotal($('#txtPrecioVentaUnitarioProducto').val()));
                }
                else
                {
                    $('#txtPrecioVentaUnitarioProductoIgvAplicado').val('');
                    $('#txtPrecioVentaUnitarioProductoNeto').val('');
                }
            }

            function cambioCheckBuscarOficina()
            {
                if($('input[name="checkBuscarOficina"]:checked').val()=='Buscar Oficina')
                {
                    $('#divEnviarDirectoStock').show();
                }
                else
                {
                    $('#divEnviarDirectoStock').hide();
                }
            }

            function cambioCheckBuscarProductoExistente()
            {
                if($('input[name="checkBuscarProductoExistente"]:checked').val()=='Buscar Producto Existente')
                {
                    $('#btnBuscarAlmacenProducto').attr('disabled', false);
                    $('#txtCodigoBarrasProducto').attr('readonly', 'readonly');
                    $('#txtPrimerNombreProducto').attr('readonly', 'readonly');
                    $('#txtSegundoNombreProducto').attr('readonly', 'readonly');
                    $('#txtTercerNombreProducto').attr('readonly', 'readonly');
                    $('#txtDescripcionProducto').attr('readonly', 'readonly');
                    $('#txtPrecioCompraTotalProducto').attr('readonly', 'readonly');
                    $('#divRegistroExistenteHide').hide();
                    $('#divAlertaCambioDatos').show();
                    $('#btnBuscarAlmacenProducto').show();
                    $('#labelCheckEditarPrecioCompraTotal').show();
                    $('#checkEditarPrecioCompraTotal').show();
                    $("#checkEditarPrecioCompraTotal").prop("checked", "");
                    
                    limpiarText('seccionFormularioProductos', ['txtUnidadesBloqueProducto', 'txtUnidadMedidaBloqueProducto']);
                    limpiarTextArea('seccionFormularioProductos', null);
                    limpiarHidden('seccionFormularioProductos', null);

                    $('#btnBuscarAlmacenProducto').click();
                }
                else
                {
                    $('#btnBuscarAlmacenProducto').attr('disabled', true);
                    $('#txtCodigoBarrasProducto').attr('readonly', false);
                    $('#txtPrimerNombreProducto').attr('readonly', false);
                    $('#txtSegundoNombreProducto').attr('readonly', false);
                    $('#txtTercerNombreProducto').attr('readonly', false);
                    $('#txtDescripcionProducto').attr('readonly', false);
                    $('#txtPrecioCompraTotalProducto').attr('readonly', false);
                    $('#divRegistroExistenteHide').show();
                    $('#divAlertaCambioDatos').hide();
                    $('#btnBuscarAlmacenProducto').hide();
                    $('#labelCheckEditarPrecioCompraTotal').hide();
                    $('#checkEditarPrecioCompraTotal').hide();

                    onKeyUpCalcularPrecioVentaIGVNeto();
                    onKeyUpCalcularPrecioCompraUnitario();
                }
            }

            function cambioCheckEditarPrecioCompraTotal()
            {
                if($('input[name="checkEditarPrecioCompraTotal"]:checked').val()=='Editar precio de compra total')
                {
                    $('#txtPrecioCompraTotalProducto').attr('readonly', false);
                }
                else
                {
                    $('#txtPrecioCompraUnitarioProducto').val($('#txtPrecioCompraUnitarioProductoOculto').val());
                    $('#txtPrecioCompraTotalProducto').attr('readonly', 'readonly');
                    onKeyUpCalcularPrecioCompraUnitario();
                }
            }

            function cambioCbxTipoRecibo()
            {
                if($('#cbxTipoRecibo').val()=='Ninguno')
                {
                    $('#divDatosAdicionalesRecibo').hide();
                    $('#txtNumeroRecibo').val('');
                    $('#dateFechaComprobanteEmitido').val('1111-11-11');
                }

                if($('#cbxTipoRecibo').val()!='Ninguno')
                {
                    $('#divDatosAdicionalesRecibo').show();
                }

                if($('#cbxTipoRecibo').val()=='Factura')
                {
                    $('#divCalculoSegunComprobante').show();
                }
                else
                {
                    $('#divCalculoSegunComprobante').hide();
                }
            }

            function cambioRadioTipoPago()
            {
                if($('input[name="radioTipoPago"]:checked').val()=='Al Crédito')
                {
                    $('#divAlCredito').show();
                }
                if($('input[name="radioTipoPago"]:checked').val()=='Al Contado')
                {
                    $('#dateFechaPagar').val('');
                    $('#divAlCredito').hide();                    
                }
            }

            function ocultarDivsBuscar()
            {
                var css=
                {
                    'display': 'none'
                };
                $('#divBuscarEnTablaProveedor').css(css);
                $('#divBuscarEnTablaAlmacen').css(css);
                $('#divBuscarEnTablaOficina').css(css);
                $('#divBuscarEnTablaAlmacenProducto').css(css);
            }

            function mostrarDivBuscar(idDivBuscar)
            {
                var css=
                {
                    'display': 'inline-block'
                };
                $('#'+idDivBuscar).css(css);
            }

            function cargarListaProductos()
            {
                $('#txtListaProductos').val('');

                $('#bodyTablaProductosAgregados').find('tr').each(function(index, elemento)
                {
                    $(elemento).find('td').each(function(index2, elemento2)
                    {
                        if(index2==15)
                        {
                            var valorTratadoTxtListaProductos=$('#txtListaProductos').val().substring(0, $('#txtListaProductos').val().length-18);
                            $('#txtListaProductos').val(valorTratadoTxtListaProductos);
                            return false;
                        }
                        $('#txtListaProductos').val($('#txtListaProductos').val()+$(elemento2).text()+'__SEPARADORCAMPO__');
                    });

                    $('#txtListaProductos').val($('#txtListaProductos').val()+'__SEPARADORREGISTRO__');
                });

                var valorTratadoTxtListaProductos=$('#txtListaProductos').val().substring(0, $('#txtListaProductos').val().length-21);
                $('#txtListaProductos').val(valorTratadoTxtListaProductos);
            }

            function agregarProductoListaRegistro()
            {   
                var mensajeGlobal='';
                
                mensajeGlobal+=(!valVacio($('#txtPrimerNombreProducto').val())?'Complete el primer nombre del producto<br>':'');
                mensajeGlobal+=(!valDosDecimales($('#txtPrecioCompraTotalProducto').val())?'El precio de compra total del producto debe ser en soles<br>':'');
                mensajeGlobal+=(!valDosDecimales($('#txtPrecioVentaUnitarioProducto').val())?'El precio de venta unitario del producto debe ser en soles<br>':'');
                if($('#cbxTipoRecibo').val()!='Ninguno' && $('#txtPrecioCompraTotalProducto').val()<=0)
                {
                    mensajeGlobal+='El precio de compra total del producto no puede ser menor o igual a 0';
                }
                mensajeGlobal+=(!valEntero($('#txtUnidadesBloqueProducto').val())?'Las unidades por bloque debe ser un valor Entero<br>':'');
                if($('input[name="radioVentaMenorUnidadProducto"]:checked').val()=='Si')
                {
                    mensajeGlobal+=(!valDecimal($('#txtCantidadProducto').val())?'La cantidad del producto debe ser un valor Entero o Decimal<br>':'');
                }
                if($('input[name="radioVentaMenorUnidadProducto"]:checked').val()=='No')
                {
                    mensajeGlobal+=(!valEntero($('#txtCantidadProducto').val())?'La cantidad del producto debe ser un valor Entero<br>':'');
                }
                mensajeGlobal+=(!valFechaYYYYMMDD($('#txtFechaVencimientoProducto').val())?'Fecha de vencimiento del producto incorrecto<br>':'');

                var datosComparacionProducto=$('#txtCodigoBarrasProducto').val()+$('#txtPrimerNombreProducto').val()+$('#txtSegundoNombreProducto').val()+$('#txtTercerNombreProducto').val()+$('#cbxTipoProducto').val()+$('#cbxCodigoPresentacionProducto').val()+$('#cbxCodigoUnidadMedidaProducto').val();
                datosComparacionProducto=datosComparacionProducto.split(' ').join('');

                var datosComparacionProductoTabla;

                $('#bodyTablaProductosAgregados').find('tr').each(function(index, elemento)
                {
                    datosComparacionProductoTabla='';
                    $(elemento).find('td').each(function(index2, elemento2)
                    {
                        switch(index2)
                        {
                            case 0:
                                datosComparacionProductoTabla=datosComparacionProductoTabla+$(elemento2).text();
                                break;
                            case 1:
                                datosComparacionProductoTabla=datosComparacionProductoTabla+$(elemento2).text();
                                break;
                            case 2:
                                datosComparacionProductoTabla=datosComparacionProductoTabla+$(elemento2).text();
                                break;
                            case 3:
                                datosComparacionProductoTabla=datosComparacionProductoTabla+$(elemento2).text();
                                break;
                            case 5:
                                datosComparacionProductoTabla=datosComparacionProductoTabla+$(elemento2).text();
                                break;
                            case 6:
                                datosComparacionProductoTabla=datosComparacionProductoTabla+$(elemento2).text();
                                break;
                            case 7:
                                datosComparacionProductoTabla=datosComparacionProductoTabla+$(elemento2).text();
                                break;
                        }

                        if(index2>7)
                        {
                            datosComparacionProductoTabla=datosComparacionProductoTabla.split(' ').join('');
                            if(datosComparacionProducto==datosComparacionProductoTabla)
                            {
                                mensajeGlobal+='El producto ya se encuentra en la lista<br>';
                            }
                            return false;
                        }
                    });
                });

                if(mensajeGlobal!='')
                {
                    animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
                    return;
                }

                var nuevoProducto=''+
                '<tr class="elementoBuscar">'+
                    '<td>'+$('#txtCodigoBarrasProducto').val().replace('<', '&lt;').replace('>', '&gt;')+'</td>'+
                    '<td>'+$('#txtPrimerNombreProducto').val().replace('<', '&lt;').replace('>', '&gt;')+'</td>'+
                    '<td>'+$('#txtSegundoNombreProducto').val().replace('<', '&lt;').replace('>', '&gt;')+'</td>'+
                    '<td>'+$('#txtTercerNombreProducto').val().replace('<', '&lt;').replace('>', '&gt;')+'</td>'+
                    '<td>'+$('#txtDescripcionProducto').val().replace('<', '&lt;').replace('>', '&gt;')+'</td>'+
                    '<td>'+$('#cbxTipoProducto').val()+'</td>'+
                    '<td>'+$('#cbxCodigoPresentacionProducto').val()+'</td>'+
                    '<td>'+$('#cbxCodigoUnidadMedidaProducto').val()+'</td>'+
                    '<td>'+$('#txtPrecioCompraTotalProducto').val()+'</td>'+
                    '<td>'+$('#txtPrecioVentaUnitarioProducto').val()+'</td>'+
                    '<td>'+$('#txtCantidadProducto').val()+'</td>'+
                    '<td>'+$('input[name="radioVentaMenorUnidadProducto"]:checked').val()+'</td>'+
                    '<td>'+$('#txtUnidadesBloqueProducto').val()+'</td>'+
                    '<td>'+$('#txtUnidadMedidaBloqueProducto').val().replace('<', '&lt;').replace('>', '&gt;')+'</td>'+
                    '<td>'+$('#txtFechaVencimientoProducto').val()+'</td>'+
                    '<td><input type="button" value="Eliminar" onclick="eliminarProductoLista(this);"></td>'+
                '</tr>';
                $('#bodyTablaProductosAgregados').prepend(nuevoProducto);

                var valorTxtTotal=parseFloat($('#txtTotalTemporal').val())+parseFloat($('#txtPrecioCompraTotalProducto').val());
                valorTxtTotal=valorTxtTotal.toFixed(2);
                $('#txtTotalTemporal').val(valorTxtTotal);
                $('#txtTotal').val(valorTxtTotal);

                calcularSubTotalIgvTotal('txtSubTotalTemporal', 'txtIgvTemporal', 'txtTotalTemporal');
                calcularSubTotalIgvTotal('txtSubTotal', 'txtIgv', 'txtTotal');

                limpiarText('seccionFormularioProductos', ['txtUnidadesBloqueProducto', 'txtUnidadMedidaBloqueProducto']);
                limpiarTextArea('seccionFormularioProductos', null);
                limpiarHidden('seccionFormularioProductos', null);
                animacionAlertaMensajeGeneral('Producto agregado a la lista, para su registro. Agregue más productos.', '#1497CC');
                animacionScrollMovimientoY('tituloDatosProductos', -177);

                $('#txtUnidadesBloqueProducto').val('10');
                $('#txtUnidadMedidaBloqueProducto').val('Decena');
                $('input[name="radioVentaMenorUnidadProducto"][value="No"]').prop('checked', true);

                cargarListaProductos();

                if($('input[name="checkBuscarProductoExistente"]:checked').val()=='Buscar Producto Existente' && $('input[name="checkEditarPrecioCompraTotal"]:checked').val()=='Editar precio de compra total')
                {
                    $('input[name="checkEditarPrecioCompraTotal"]:checked').prop('checked', false);
                    
                    cambioCheckEditarPrecioCompraTotal();
                }
            }

            function seleccionarBuscarAlmacenProducto(codigoAlmacenProducto)
            {
                $('#txtCodigoBarrasProducto').val($('#codigoBarrasAlmacenProductoAgrupado'+codigoAlmacenProducto).text());
                $('#cbxCodigoPresentacionProducto option[value="'+$('#codigoPresentacionAlmacenProductoAgrupado'+codigoAlmacenProducto).text()+'"]').attr('selected', true);
                $('#cbxCodigoUnidadMedidaProducto option[value="'+$('#codigoUnidadMedidaAlmacenProductoAgrupado'+codigoAlmacenProducto).text()+'"]').attr('selected', true);
                $('#txtPrimerNombreProducto').val($('#primerNombreAlmacenProductoAgrupado'+codigoAlmacenProducto).text());
                $('#txtSegundoNombreProducto').val($('#segundoNombreAlmacenProductoAgrupado'+codigoAlmacenProducto).text());
                $('#txtTercerNombreProducto').val($('#tercerNombreAlmacenProductoAgrupado'+codigoAlmacenProducto).text());
                $('#txtDescripcionProducto').val($('#descripcionAlmacenProductoAgrupado'+codigoAlmacenProducto).text());
                $('#cbxTipoProducto option[value="'+$('#tipoAlmacenProductoAgrupado'+codigoAlmacenProducto).text()+'"]').attr('selected', true);
                $('#txtUnidadesBloqueProducto').val($('#unidadesBloqueAlmacenProductoAgrupado'+codigoAlmacenProducto).text());
                $('#txtUnidadMedidaBloqueProducto').val($('#unidadMedidaBloqueAlmacenProductoAgrupado'+codigoAlmacenProducto).text());
                $('#txtPrecioCompraUnitarioProducto').val($('#precioCompraUnitarioAlmacenProductoAgrupado'+codigoAlmacenProducto).text());
                $('#txtPrecioCompraUnitarioProductoOculto').val($('#precioCompraUnitarioAlmacenProductoAgrupado'+codigoAlmacenProducto).text());
                $('#txtPrecioVentaUnitarioProducto').val($('#precioVentaUnitarioAlmacenProductoAgrupado'+codigoAlmacenProducto).text());

                if($('#fechaVencimientoAlmacenProductoAgrupado'+codigoAlmacenProducto).text()=='1111-11-11')
                {
                    $('#txtFechaVencimientoProducto').val($('#fechaVencimientoAlmacenProductoAgrupado'+codigoAlmacenProducto).text())
                }
                else
                {
                    $('#txtFechaVencimientoProducto').val('');
                }
                
                if($('#ventaMenorUnidadAlmacenProductoAgrupado'+codigoAlmacenProducto).text()=='Si')
                {
                    $('input[name="radioVentaMenorUnidadProducto"][value="Si"]').prop('checked', true);
                }
                if($('#ventaMenorUnidadAlmacenProductoAgrupado'+codigoAlmacenProducto).text()=='No')
                {
                    $('input[name="radioVentaMenorUnidadProducto"][value="No"]').prop('checked', true);
                }

                onKeyUpCalcularPrecioCompraUnitario();

                ocultarApartadoBuscar();
            }

            function eliminarProductoLista(nietoElementoEliminar)
            {
                var precioRemovido;
                var elementoEliminar=$(nietoElementoEliminar).parent().parent();

                $(elementoEliminar).find('td').each(function(index, elemento)
                {
                    if(index==8)
                    {
                        precioRemovido=parseFloat($(elemento).text());
                        return false;
                    }
                });

                var valorTxtTotal=parseFloat($('#txtTotalTemporal').val())-precioRemovido;
                valorTxtTotal=valorTxtTotal.toFixed(2);
                $('#txtTotalTemporal').val(valorTxtTotal);
                $('#txtTotal').val(valorTxtTotal);

                calcularSubTotalIgvTotal('txtSubTotalTemporal', 'txtIgvTemporal', 'txtTotalTemporal');
                calcularSubTotalIgvTotal('txtSubTotal', 'txtIgv', 'txtTotal');

                $(elementoEliminar).remove();

                cargarListaProductos();
            }

            function enviarFrmInsertarReciboCompra()
            {
                $('#txtDescripcion').val($('#txtDescripcionTemporal').val());

                var mensajeGlobal='';
                
                mensajeGlobal+=(!valVacio($('#txtNombreProveedor').val())?'Debe seleccionar proveedor<br>':'');
                mensajeGlobal+=(!valVacio($('#txtDescripcionAlmacen').val())?'Debe seleccionar almacén<br>':'');

                if($('#cbxTipoRecibo').val()!='Ninguno')
                {
                    mensajeGlobal+=(!valVacio($('#txtNumeroRecibo').val())?'Debe ingresar el número de comprobante<br>':'');
                }

                mensajeGlobal+=(!valFechaYYYYMMDD($('#dateFechaComprobanteEmitido').val())?'Fecha de emisión del comprobante incorrecto<br>':'');

                if($('input[name="radioTipoPago"]:checked').val()=='Al Crédito')
                {
                    mensajeGlobal+=(!valFechaYYYYMMDD($('#dateFechaPagar').val())?'Fecha de primer pago incorrecto<br>':'');
                }

                if($('input[name="checkBuscarOficina"]:checked').val()=='Buscar Oficina')
                {
                    mensajeGlobal+=(!valVacio($('#txtDescripcionOficina').val())?'Debe seleccionar una oficina a donde enviar los productos<br>':'');
                }

                var cantidadFilasAgregadas=0;

                if($('#txtListaProductos').val().trim()!='')
                {
                    cantidadFilasAgregadas++;
                }

                if(cantidadFilasAgregadas==0)
                {
                    mensajeGlobal+='Debe agregar productos a la lista para su registro<br>';
                }

                if(mensajeGlobal!='')
                {
                    animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
                    return;
                }

                $('#txtHtmlListaProductos').val($('#bodyTablaProductosAgregados').html());

                if(confirm('Confirmar Registro'))
                {        
                    $('#frmInsertarReciboCompra').submit();
                    return;
                }
                alert('Operación Cancelada');
            }
        </script>
    @endif
@stop