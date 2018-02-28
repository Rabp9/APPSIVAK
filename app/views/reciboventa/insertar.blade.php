@extends('layout.layout')

@section('contenidoCuerpo')
    <h2 class="textAlignCenter bordeAbajo tituloCabecera">REALIZAR VENTA</h2>
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
         @if(Session::get('localAcceso')!='Oficina')
            <div class="alertaMensajeError">
                Ud. debe estar logueado en una oficina para realizar ventas
            </div>
        @endif
        @if(Session::get('localAcceso')=='Oficina')
            <section class="contenidoTop">
                <div style="background-color: #EC6B4B;box-shadow: -1px 1px 2px rgba(0, 0, 0, 0.7);display: inline-table;height: 80px;position: fixed;right: 2px;top: 170px;width: 80px;">
                    <a href="/APPSIVAK/public/reciboventa/insertar" target="_blank" style="color: white; display: table-cell; text-decoration: none;vertical-align: middle;">Realizar otra venta simultánea</a>
                </div>
                <form id="frmInsertarReciboVenta" action="/APPSIVAK/public/reciboventa/insertar" method="post" class="labelMediano textAlignCenter">
                    <div class="contenidoTop textAlignLeft">
                        <hr>
                        <h2 class="bordeAbajo">Datos generales de la venta</h2>
                        <label for="cbxTipoRecibo">Tipo de comprobante</label>
                        <select name="cbxTipoRecibo" id="cbxTipoRecibo" class="select" style="width: 550px;" onchange="onChangeCbxTipoRecibo();">
                            <option value="Ticket" {{{isset($cbxTipoRecibo) && $cbxTipoRecibo=='Ticket'?"selected":''}}}>Ticket</option>
                            <option value="Recibo" {{{isset($cbxTipoRecibo) && $cbxTipoRecibo=='Recibo'?"selected":''}}}>Recibo</option>
                            <option value="Boleta" {{{isset($cbxTipoRecibo) && $cbxTipoRecibo=='Boleta'?"selected":''}}}>Boleta</option>
                            <option value="Factura" {{{isset($cbxTipoRecibo) && $cbxTipoRecibo=='Factura'?"selected":''}}}>Factura</option>
                        </select>
                        <br>
                        <div id="divNumeroComprobante" style="display: none;">
                            <label for="txtNumeroRecibo">Número de comprobante</label>
                            <input type="text" id="txtNumeroRecibo" class="text" name="txtNumeroRecibo" autocomplete="off" placeholder="Obligatorio para venta al contado" size="30" value="{{{isset($txtNumeroRecibo)?$txtNumeroRecibo:''}}}">
                            <br>
                        </div>
                        <label for="cbxTipoPago">Tipo de pago</label>
                        <select name="cbxTipoPago" id="cbxTipoPago" class="select" style="width: 550px;" onchange="onChangeCbxTipoPago();">
                            <option value="Al Contado" {{{isset($cbxTipoPago) && $cbxTipoPago=='Al Contado'?"selected":''}}}>Al Contado</option>
                            <option value="Al Crédito" {{{isset($cbxTipoPago) && $cbxTipoPago=='Al Crédito'?"selected":''}}}>Al Crédito</option>
                        </select>
                        <br>
                        <div id="divContenedorAlCredito" style="display: none;">
                            <div class="displayInlineBlock">
                                <label for="txtFechaPrimerPago">Fecha del primer pago</label>
                                <input type="date" id="txtFechaPrimerPago" name="txtFechaPrimerPago" class="text" style="width: 200px;" value="{{{isset($txtFechaPrimerPago)?$txtFechaPrimerPago:date('Y-m-d')}}}">
                            </div>
                            <br>
                            <div id="radioModoPago" class="estiloCheckCircular">
                                <input type="hidden" id="txtRadioModoPago" name="txtRadioModoPago" value="{{{isset($txtRadioModoPago)?$txtRadioModoPago:'Pago personalizado'}}}">
                                <label>Modo de pago</label>
                                <div id="checkPagoPersonalizado" value="Pago personalizado" seleccionado="true" onclick="onClickEstiloCheckCircular(this); onClickRadioModoPago();"><b>Pago personalizado</b></div>
                                <div id="checkPagoAutomatico" value="Pago automático" onclick="onClickEstiloCheckCircular(this); onClickRadioModoPago();"><b>Pago automático</b></div>
                            </div>
                            <br>
                            <div class="displayInlineBlock">
                                <label for="txtLetras">Nº de letras</label>
                                <input type="text" id="txtLetras" name="txtLetras" class="textDocumento textAlignCenter" size="5" placeholder="Obligatorio" value="{{{isset($txtLetras)?$txtLetras:'0'}}}">
                            </div>
                            <br>
                            <div class="displayInlineBlock">
                                <div id="divPagoPersonalizado" class="displayInlineBlock">
                                    <label for="txtPagoPersonalizado">Intervalo de días para el pago</label>
                                    <input type="text" id="txtPagoPersonalizado" name="txtPagoPersonalizado" class="textDocumento textAlignCenter" size="5" placeholder="Obligatorio" value="{{{isset($txtPagoPersonalizado)?$txtPagoPersonalizado:'0'}}}">
                                </div>
                                <div id="divPagoAutomatico" style="display: none;">
                                    <label for="cbxPagoAutomatico">Fechas de pago fijos</label>
                                    <select name="cbxPagoAutomatico" id="cbxPagoAutomatico" class="select" style="width: 550px;">
                                        <option value="Semanalmente los Lunes" {{{isset($cbxPagoAutomatico) && $cbxPagoAutomatico=='Semanalmente los Lunes'?"selected":''}}}>Semanalmente los Lunes</option>
                                        <option value="Semanalmente los Viernes" {{{isset($cbxPagoAutomatico) && $cbxPagoAutomatico=='Semanalmente los Viernes'?"selected":''}}}>Semanalmente los Viernes</option>
                                        <option value="Primer día Laboral del Mes" {{{isset($cbxPagoAutomatico) && $cbxPagoAutomatico=='Primer día Laboral del Mes'?"selected":''}}}>Primer día Laboral del Mes</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <br>
                        <!--SECCIÓN OCULTADA INICIO-->
                        <div class="displayInlineBlock" style="display: none;width: 380px;">
                            <label for="cbxEstadoEntrega">Producto entregado</label>
                            <select name="cbxEstadoEntrega" id="cbxEstadoEntrega" class="select">
                                <option value="Si" {{{isset($cbxEstadoEntrega) && $cbxEstadoEntrega=='Si'?"selected":''}}}>Si</option>
                                <option value="No" {{{isset($cbxEstadoEntrega) && $cbxEstadoEntrega=='No'?"selected":''}}}>No</option>
                            </select>
                        </div>
                        <!--SECCIÓN OCULTADA FIN-->
                        <div id="radioGuiaRemision" class="estiloCheckCircular">
                            <input type="hidden" id="txtRadioGuiaRemision" name="txtRadioGuiaRemision" value="{{{isset($txtRadioGuiaRemision)?$txtRadioGuiaRemision:'No'}}}">
                            <label>Emitir guía de remisión</label>
                            <div id="checkSi" value="Si" onclick="onClickEstiloCheckCircular(this); onClickRadioGuiaRemision();"><b>Si</b></div>
                            <div id="checkNo" value="No" seleccionado="true" onclick="onClickEstiloCheckCircular(this); onClickRadioGuiaRemision();"><b>No</b></div>
                        </div>
                        <hr>
                        <h2 class="bordeAbajo">Datos del cliente</h2>
                        <div id="divContenedorClienteNatural" class="contenidoTop">
                            <input type="button" id="btnBuscarClienteNatural" value="Buscar Cliente Natural" class="button" style="width: 200px;" onclick="ocultarDivsBuscar(); mostrarDivBuscar('divBuscarEnTablaClienteNatural'); mostrarApartadoBuscar();">
                            <br>
                            <label for="txtDniClienteNatural">Dni</label>
                            <input type="text" id="txtDniClienteNatural" name="txtDniClienteNatural" size="70" class="textDocumento" placeholder="00000000" value="{{{isset($txtDniClienteNatural)?$txtDniClienteNatural:''}}}">
                            <br>
                            <div class="displayInlineBlock">
                                <label for="txtNombreClienteNatural">Nombre completo</label>
                                <input type="text" id="txtNombreClienteNatural" name="txtNombreClienteNatural" size="17" class="textDocumento contenidoMiddle" placeholder="Nombre" value="{{{isset($txtNombreClienteNatural)?$txtNombreClienteNatural:''}}}">,
                                <input type="text" id="txtApellidoPaternoClienteNatural" name="txtApellidoPaternoClienteNatural" size="17" class="textDocumento contenidoMiddle" placeholder="Apellido paterno" value="{{{isset($txtApellidoPaternoClienteNatural)?$txtApellidoPaternoClienteNatural:''}}}">,
                                <input type="text" id="txtApellidoMaternoClienteNatural" name="txtApellidoMaternoClienteNatural" size="17" class="textDocumento contenidoMiddle" placeholder="Apellido materno" value="{{{isset($txtApellidoMaternoClienteNatural)?$txtApellidoMaternoClienteNatural:''}}}">
                            </div>
                            <br>
                            <div class="displayInlineBlock">
                            <label for="txtDireccionClienteNatural">Dirección</label>
                                <input type="text" id="txtDireccionClienteNatural" name="txtDireccionClienteNatural" size="70" class="textDocumento" placeholder="Av./Jr. Dirección" value="{{{isset($txtDireccionClienteNatural)?$txtDireccionClienteNatural:''}}}">
                            </div>
                        </div>
                        <div id="divContenedorClienteJuridico" class="contenidoTop" style="display: none;">
                            <input type="button" id="btnBuscarClienteJuridico" value="Buscar Cliente Juridico" class="button" style="width: 200px;" onclick="ocultarDivsBuscar(); mostrarDivBuscar('divBuscarEnTablaClienteJuridico'); mostrarApartadoBuscar();">
                            <br>
                            <label for="txtRucClienteJuridico">Ruc</label>
                            <input type="text" id="txtRucClienteJuridico" name="txtRucClienteJuridico" size="70" class="textDocumento" placeholder="00000000000" value="{{{isset($txtRucClienteJuridico)?$txtRucClienteJuridico:''}}}">
                            <br>
                            <div class="displayInlineBlock">
                                <label for="txtRazonSocialLargaClienteJuridico">Razón social</label>
                                <input type="text" id="txtRazonSocialLargaClienteJuridico" name="txtRazonSocialLargaClienteJuridico" size="70" class="textDocumento" size="60" value="{{{isset($txtRazonSocialLargaClienteJuridico)?$txtRazonSocialLargaClienteJuridico:''}}}">
                            </div>
                            <br>
                            <div class="displayInlineBlock">
                               <label for="txtDireccionClienteJuridico">Dirección</label>
                                <input type="text" id="txtDireccionClienteJuridico" name="txtDireccionClienteJuridico" size="70" placeholder="Av./Jr. Dirección" class="textDocumento" value="{{{isset($txtDireccionClienteJuridico)?$txtDireccionClienteJuridico:''}}}">
                            </div>
                        </div>
                        <hr>
                        <div id="divContenedorGuiaRemision" class="contenidoTop" style="display: none;">
                            <h2 class="bordeAbajo">Datos de la guía de remisión</h2>
                            <label for="txtDocumentoReceptor">Dni o Ruc del receptor</label>
                            <input type="text" id="txtDocumentoReceptor" name="txtDocumentoReceptor" size="70" class="textDocumento" placeholder="00000000[00]" value="{{{isset($txtDocumentoReceptor)?$txtDocumentoReceptor:''}}}">
                            <br>
                            <label for="txtNombreCompletoReceptor">Nombre/razón-social del receptor</label>
                            <input type="text" id="txtNombreCompletoReceptor" name="txtNombreCompletoReceptor" size="70" class="textDocumento" value="{{{isset($txtNombreCompletoReceptor)?$txtNombreCompletoReceptor:''}}}">
                            <br>
                            <label for="txtDireccionEnvioReceptor">Dirección de llegada</label>
                            <input type="text" id="txtDireccionEnvioReceptor" name="txtDireccionEnvioReceptor" size="70" placeholder="Av./Jr. Dirección" class="textDocumento" value="{{{isset($txtDireccionEnvioReceptor)?$txtDireccionEnvioReceptor:''}}}">
                            <br>
                            <label for="txtFlete">Flete</label>
                            <input type="text" id="txtFlete" name="txtFlete" size="70" class="textDocumento" value="{{{isset($txtFlete)?$txtFlete:'0.00'}}}">
                            <br>
                            <label for="txtDocumentoTransportista">Dni o Ruc del transportista</label>
                            <input type="text" id="txtDocumentoTransportista" name="txtDocumentoTransportista" size="70" class="textDocumento" placeholder="00000000[00]" value="{{{isset($txtDocumentoTransportista)?$txtDocumentoTransportista:''}}}">
                            <br>
                            <label for="txtNombreCompletoTransportista">Nombre/razón-social del transportista</label>
                            <input type="text" id="txtNombreCompletoTransportista" name="txtNombreCompletoTransportista" size="70" class="textDocumento" value="{{{isset($txtNombreCompletoTransportista)?$txtNombreCompletoTransportista:''}}}">
                            <br>
                            <label for="txtMarcaPlacaAutoMovilTransportista">Marca y/o placa automovil del transportista</label>
                            <input type="text" id="txtMarcaPlacaAutoMovilTransportista" name="txtMarcaPlacaAutoMovilTransportista" size="70" class="textDocumento" value="{{{isset($txtMarcaPlacaAutoMovilTransportista)?$txtMarcaPlacaAutoMovilTransportista:''}}}">
                            <br>
                            <label for="txtLicenciaConducirTransportista">Licencia de conducir del transportista</label>
                            <input type="text" id="txtLicenciaConducirTransportista" name="txtLicenciaConducirTransportista" size="70" class="textDocumento" value="{{{isset($txtLicenciaConducirTransportista)?$txtLicenciaConducirTransportista:''}}}">
                        </div>
                    </div>
                    <hr>
                    <h2 class="bordeAbajo">Lista de productos</h2>
                    <input type="hidden" id="txtDescripcion" name="txtDescripcion" value="{{{isset($txtDescripcion)?$txtDescripcion:''}}}">
                    <input type="hidden" id="txtListaProductos" name="txtListaProductos" value="{{{isset($txtListaProductos)?$txtListaProductos:''}}}">
                    <input type="hidden" id="txtHtmlListaProductos" name="txtHtmlListaProductos" value="{{{isset($txtHtmlListaProductosDevueltos)?$txtHtmlListaProductosDevueltos:''}}}">
                    <input type="hidden" id="txtSubTotal" name="txtSubTotal" class="text" value="{{{isset($txtSubTotal)?$txtSubTotal:'0.00'}}}">
                    <input type="hidden" id="txtIgv" name="txtIgv" class="text" value="{{{isset($txtIgv)?$txtIgv:'0.00'}}}">
                    <input type="hidden" id="txtTotal" name="txtTotal" class="text" value="{{{isset($txtTotal)?$txtTotal:'0.00'}}}">
                    <input type="button" id="btnBuscarOficinaProductoPorCodigoOficina" value="Buscar Producto" class="button" style="width: 200px;" onclick="ocultarDivsBuscar(); mostrarDivBuscar('divBuscarEnTablaOficinaProducto'); mostrarApartadoBuscar();">
                    <label class="noLabel" for="txtCodigoBarras">o agregarlo por código de barras</label>
                    <input type="text" id="txtCodigoBarras" name="txtCodigoBarras" size="50" onkeyup="onKeyUpTxtCodigoBarras();" class="text" autofocus autocomplete="off">
                </form>
                <div class="textAlignRight bordeAbajo bordeArriba">
                    <b style="cursor: pointer;text-decoration: underline;" onclick="dialogoAjax('dialogo', 1000, false, 'Productos de almacén', 'top', null, '/APPSIVAK/public/productoenviarstock/insertarconajax', 'POST', null, null, false, true);">Buscar producto en almacén</b>
                </div>
                <div id="divAcordionProductoExtra" class="textAlignCenter">
                    <h3>Agregar a la lista de venta producto o servicio no disponible en stock</h3>
                    <div class="labelGrande textAlignCenter">
                        <label for="txtNombreCompletoProductoServicio">Nombre completo del producto o servicio</label>
                        <input type="text" id="txtNombreCompletoProductoServicio" name="txtNombreCompletoProductoServicio" class="text" size="50" placeholder="Obligatorio">
                        <br>
                        <label for="txtTipoProductoServicio">Tipo del producto o servicio</label>
                        <input type="text" id="txtTipoProductoServicio" name="txtTipoProductoServicio" class="text" size="50" placeholder="Genérico/Comercial" value="">
                        <br>
                        <label for="txtPresentacionProductoServicio">Presentación del producto o servicio</label>
                        <input type="text" id="txtPresentacionProductoServicio" name="txtPresentacionProductoServicio" class="text" size="50" placeholder="Botella, Caja, Tableta u Otros" value="">
                        <br>
                        <label for="txtUnidadMedidaProductoServicio">Unidad de medida del producto o servicio</label>
                        <input type="text" id="txtUnidadMedidaProductoServicio" name="txtUnidadMedidaProductoServicio" class="text" size="50" placeholder="Obligatorio" value="UND">
                        <br>
                        <label for="txtPrecioVentaUnitarioProductoServicio">Precio de venta unitario del producto o servicio</label>
                        <input type="text" id="txtPrecioVentaUnitarioProductoServicio" name="txtPrecioVentaUnitarioProductoServicio" class="text" size="50" placeholder="Obligatorio">
                        <div class="textAlignRight bordeArriba">
                            <input type="button" class="button" value="Agregar producto o servicio a la lista de venta" onclick="agregarProductoServicioListaVenta();">
                        </div>
                    </div>
                </div>
            </section>
            <hr>
            <section>
                <table class="textoMediano table">
                    <thead class="textAlignCenter">
                        <th style='display: none;'>CÓDIGO DEL PRODUCTO</th>
                        <th style='display: none;'>CÓDIGO DE BARRAS</th>
                        <th style='display: none;'>PRIMER NOMBRE</th>
                        <th style='display: none;'>SEGUNDO NOMBRE</th>
                        <th style='display: none;'>TERCER NOMBRE</th>
                        <th style="background-color: #92D2F5;">NOMBRE DEL PRODUCTO</th>
                        <th style='display: none;'>DESCRIPCIÓN</th>
						<th>&nbsp;</th>							
                        <th>&nbsp;</th>    					
                        <th style='display: none;'>CATEGORÍA</th>
                        <th class="textAlignLeft">PRESENTACIÓN</th>
                        <th style="background-color: #92D2F5;">UNIDAD DE MEDIDA</th>
                        <th>PRECIO UNITARIO</th>
                        <th style="background-color: #92D2F5;">CANTIDAD</th>
						<th>CANTIDAD BLOQUE</th>
                        <th style="background-color: #92D2F5;">UNIDADES POR BLOQUE</th>   
						<th>UNIDAD MEDIDA BLOQUE</th>
                        <th style="background-color: #92D2F5;">SUBTOTAL</th>
                        <th></th>
                    </thead>
                    <tbody id="bodyTablaProductosAgregados">

                    </tbody>
                </table>
                <div class="textAlignRight">
                    <div id="divCalculoSegunComprobante" class="contenidoMiddle" style="display: none;">
                        <label for="txtSubTotalTemporal">SUB TOTAL</label>
                        <input type="text" id="txtSubTotalTemporal" name="txtSubTotalTemporal" class="text" readonly=true value="{{{isset($txtSubTotal)?$txtSubTotal:'0.00'}}}" style="background-color: #EEEEEE;">
                        <label for="txtIgvTemporal">IGV</label>
                        <input type="text" id="txtIgvTemporal" name="txtIgvTemporal" class="text" readonly=true value="{{{isset($txtIgv)?$txtIgv:'0.00'}}}" style="background-color: #EEEEEE;">
                    </div>
                    <label for="txtTotalTemporal">TOTAL</label>
                    <input type="text" id="txtTotalTemporal" name="txtTotalTemporal" class="text" readonly=true value="{{{isset($txtTotal)?$txtTotal:'0.00'}}}" style="background-color: #EEEEEE;">
                </div>
                <hr>
                <label for="txtDescripcionTemporal">Descripción Adicional de la Venta</label>
                <br>
                <textarea name="txtDescripcionTemporal" id="txtDescripcionTemporal" class="textarea" cols="70" rows="5">{{{isset($txtDescripcion)?$txtDescripcion:''}}}</textarea>
            </section>
            <hr>
            <div class="textAlignRight">
                <input type="reset" class="button" value="Limpiar todo el formulario de venta" onclick="limpiarFormularioVenta();" style="height: 40px;">
                <input type="button" class="button" value="Imprimir proforma" onclick="generarProforma();" style="height: 40px;">
                <input type="button" class="button" value="Realizar Venta" onclick="enviarFrmInsertarReciboVenta();" style="height: 40px;width: 420px;">
            </div>
            <section id="apartadoBuscar" class="apartadoBuscar">
                <div id="divBuscarEnTablaOficinaProducto">
                    <h2 class="textAlignCenter bordeAbajo">PRODUCTOS DE TIENDA</h2>
                    <section class="anchoCompleto textAlignLeft backGroundColorGrisClaro">
                        <label class="contenidoMiddle">Buscar</label>
                        <input type="text" class="contenidoMiddle text" size="50" onkeypress="actionListaBuscarOficinaProductoPorCodigoOficinaNombre('divListaBuscarOficinaProducto', this.value, event);">
                        <input type="button" class="contenidoMiddle button" value="Ocultar Búsqueda" onclick="ocultarApartadoBuscar();">
                    </section>
                    <section id="divListaBuscarOficinaProducto" class="anchoCompleto labelPequenio textoMediano">
                        
                    </section>
                    <script>
                        var lanzarEventoListaBuscarOficinaProductoPorCodigoOficinaNombre;

                        function actionListaBuscarOficinaProductoPorCodigoOficinaNombre(idSeccion, nombreCompletoProducto, event)
                        {
                            var code=(event.keyCode ? event.keyCode : event.which);

                            if(code==13)
                            {
                                clearTimeout(lanzarEventoListaBuscarOficinaProductoPorCodigoOficinaNombre);

                                lanzarEventoListaBuscarOficinaProductoPorCodigoOficinaNombre=setTimeout(function()
                                {
                                    paginaAjax(idSeccion, {codigoOficina: '{{{explode(",", Session::get("local"))[0]}}}', nombreCompletoProducto: nombreCompletoProducto}, '/APPSIVAK/public/oficinaproducto/listabuscaroficinaproductoporcodigooficinanombre', 'POST', null, function()
                                    {
                                        $('.btnSeleccionarOficinaProducto').on('click', function()
                                        {
                                            var codigoOficinaProducto=this.id.substring(29);
                                            
                                            seleccionarBuscarOficinaProductoPorCodigoOficina(codigoOficinaProducto);
                                        });
                                    }, false, true);
                                }, 500);
                            }
                        }
                    </script>
                </div>
                <div id="divBuscarEnTablaClienteNatural">
                    <h2 class="textAlignCenter bordeAbajo">CLIENTES NATURALES</h2>
                    <section class="anchoCompleto textAlignLeft backGroundColorGrisClaro">
                        <label class="contenidoMiddle">Buscar</label>
                        <input type="text" class="contenidoMiddle text" size="50" onkeypress="actionListaBuscarClienteNaturalPorDniNombreApellidoPaternoApellidoMaterno('divListaBuscarClienteNatural', this.value, event);">
                        <input type="button" class="contenidoMiddle button" value="Ocultar Búsqueda" onclick="ocultarApartadoBuscar();">
                    </section>
                    <section id="divListaBuscarClienteNatural" class="anchoCompleto labelPequenio textoMediano">
                        
                    </section>
                    <script>
                        var lanzarEventoListaBuscarClienteNaturalPorDniNombreApellidoPaternoApellidoMaterno;

                        function actionListaBuscarClienteNaturalPorDniNombreApellidoPaternoApellidoMaterno(idSeccion, dniNombreApellidoPaternoApellidoMaterno, event)
                        {
                            var code=(event.keyCode ? event.keyCode : event.which);

                            if(code==13)
                            {
                                clearTimeout(lanzarEventoListaBuscarClienteNaturalPorDniNombreApellidoPaternoApellidoMaterno);

                                lanzarEventoListaBuscarClienteNaturalPorDniNombreApellidoPaternoApellidoMaterno=setTimeout(function()
                                {
                                    paginaAjax(idSeccion, {dniNombreApellidoPaternoApellidoMaterno: dniNombreApellidoPaternoApellidoMaterno}, '/APPSIVAK/public/clientenatural/listabuscarclientenaturalpordninombreapellidopaternoapellidomaterno', 'POST', null, function()
                                    {
                                        $('.btnSeleccionarClienteNatural').on('click', function()
                                        {
                                            var codigoClienteNatural=this.id.substring(28);
                                            
                                            accionSeleccionarClienteNatural(codigoClienteNatural);
                                        });
                                    }, false, true);
                                }, 500);
                            }
                        }
                    </script>
                </div>
                <div id="divBuscarEnTablaClienteJuridico">
                    <h2 class="textAlignCenter bordeAbajo">CLIENTES JURÍDICOS</h2>
                    <section class="anchoCompleto textAlignLeft backGroundColorGrisClaro">
                        <label class="contenidoMiddle">Buscar</label>
                        <input type="text" class="contenidoMiddle text" size="50" onkeypress="actionListaBuscarClienteJuridicoPorRucRazonSocialLarga('divListaBuscarClienteJuridico', this.value, event);">
                        <input type="button" class="contenidoMiddle button" value="Ocultar Búsqueda" onclick="ocultarApartadoBuscar();">
                    </section>
                    <section id="divListaBuscarClienteJuridico" class="anchoCompleto labelPequenio textoMediano">
                        
                    </section>
                    <script>
                        var lanzarEventoListaBuscarClienteJuridicoPorRucRazonSocialLarga;

                        function actionListaBuscarClienteJuridicoPorRucRazonSocialLarga(idSeccion, rucRazonSocialLarga, event)
                        {
                            var code=(event.keyCode ? event.keyCode : event.which);

                            if(code==13)
                            {
                                clearTimeout(lanzarEventoListaBuscarClienteJuridicoPorRucRazonSocialLarga);

                                lanzarEventoListaBuscarClienteJuridicoPorRucRazonSocialLarga=setTimeout(function()
                                {
                                    paginaAjax(idSeccion, {rucRazonSocialLarga: rucRazonSocialLarga}, '/APPSIVAK/public/clientejuridico/listabuscarclientejuridicoporrucrazonsociallarga', 'POST', null, function()
                                    {
                                        $('.btnSeleccionarClienteJuridico').on('click', function()
                                        {
                                            var codigoClienteJuridico=this.id.substring(29);
        
                                            accionSeleccionarClienteJuridico(codigoClienteJuridico);
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
                    if('{{{Session::has("tipoRecibo")}}}')
                    {
                        if('{{{Session::get("tipoPago")}}}'!='Al Contado')
                        {
                            window.open('/APPSIVAK/public/reporte/notacredito/{{{Session::get("codigoReciboVenta")}}}', '_blank');
                        }
                        else
                        {
                            switch('{{{Session::get("tipoRecibo")}}}')
                            {
                                case 'Ticket':
                                    window.open('/APPSIVAK/public/reporte/ticket/{{{Session::get("codigoReciboVenta")}}}', '_blank');
                                    break;
                                case 'Recibo':
                                    window.open('/APPSIVAK/public/reporte/recibo/{{{Session::get("codigoReciboVenta")}}}', '_blank');
                                    break;
                                case 'Boleta':
                                    window.open('/APPSIVAK/public/reporte/boleta/{{{Session::get("codigoReciboVenta")}}}', '_blank');
                                    break;
                                case 'Factura':
                                    window.open('/APPSIVAK/public/reporte/factura/{{{Session::get("codigoReciboVenta")}}}', '_blank');
                                    break;
                            }
                        }
                    }

                    inicializarEstiloCheckCircular('radioModoPago', '120px', '25px', '25px', '10px', 'radio');
                    inicializarEstiloCheckCircular('radioGuiaRemision', '35px', '35px', '35px', '10px', 'radio');

                    $('#divAcordionProductoExtra').accordion(
                    {
                        collapsible: true,
                        active: false,
                        heightStyle: "content"
                    });                

                    if($('#txtListaProductos').val()!='')
                    {
                        $('#txtRadioModoPago').val('{{{isset($txtRadioModoPago) ? $txtRadioModoPago : "Pago personalizado"}}}');
                        onClickEstiloCheckCircular($('#radioModoPago > #'+($('#txtRadioModoPago').val()=='Pago personalizado'?'checkPagoPersonalizado':'checkPagoAutomatico')));
                        
                        $('#txtRadioGuiaRemision').val('{{{isset($txtRadioGuiaRemision) ? $txtRadioGuiaRemision : "No"}}}');
                        onClickEstiloCheckCircular($('#radioGuiaRemision > #'+($('#txtRadioGuiaRemision').val()=='No' ? 'checkNo' : 'checkSi')));

                        onChangeCbxTipoRecibo();
                        onChangeCbxTipoPago();
                        onClickRadioModoPago();
                        onClickRadioGuiaRemision();

                        $("#bodyTablaProductosAgregados").html($('#txtHtmlListaProductos').val());
                    }
                });

                function accionSeleccionarClienteNatural(codigoClienteNatural)
                {
                    $('#txtNombreClienteNatural').val($('#nombreClienteNatural'+codigoClienteNatural).text());
                    $('#txtApellidoPaternoClienteNatural').val($('#apellidoPaternoClienteNatural'+codigoClienteNatural).text());
                    $('#txtApellidoMaternoClienteNatural').val($('#apellidoMaternoClienteNatural'+codigoClienteNatural).text());
                    $('#txtDniClienteNatural').val($('#dniClienteNatural'+codigoClienteNatural).text());
                    $('#txtDireccionClienteNatural').val($('#direccionClienteNatural'+codigoClienteNatural).text());

                    ocultarApartadoBuscar();
                }

                function accionSeleccionarClienteJuridico(codigoClienteJuridico)
                {
                    $('#txtRazonSocialLargaClienteJuridico').val($('#razonSocialLargaClienteJuridico'+codigoClienteJuridico).text());
                    $('#txtRucClienteJuridico').val($('#rucClienteJuridico'+codigoClienteJuridico).text());
                    $('#txtDireccionClienteJuridico').val($('#direccionClienteJuridico'+codigoClienteJuridico).text());

                    if($('#txtRadioGuiaRemision').val()=='Si')
                    {
                        $('#txtNombreCompletoReceptor').val($('#razonSocialLargaClienteJuridico'+codigoClienteJuridico).text());
                        $('#txtDocumentoReceptor').val($('#rucClienteJuridico'+codigoClienteJuridico).text());
                        $('#txtDireccionEnvioReceptor').val($('#direccionClienteJuridico'+codigoClienteJuridico).text());
                    }

                    ocultarApartadoBuscar();
                }

                function cargarListaProductos()
                {
                    $('#txtListaProductos').val('');

                    $('#bodyTablaProductosAgregados').find('tr').each(function(index, elemento)
                    {
                        $(elemento).find('td').each(function(index2, elemento2)
                        {
                            if(index2==18)
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

                function onChangeCbxTipoRecibo()
                {
                    $('#divContenedorClienteJuridico').css({'display' : 'none'});
                    $('#divContenedorClienteNatural').css({'display' : 'none'});

                    if($('#cbxTipoRecibo').val()=='Boleta' || $('#cbxTipoRecibo').val()=='Factura')
                    {
                        $('#divNumeroComprobante').show();
                    }
                    else
                    {
                        $('#divNumeroComprobante').hide();
                        $('#txtNumeroRecibo').val('');
                    }

                    if($('#cbxTipoRecibo').val()=='Factura')
                    {
                        $('#divContenedorClienteJuridico').css({'display' : 'inline-block'});
                        $('#divCalculoSegunComprobante').css({'display' : 'inline-block'});
                    }
                    else
                    {
                        $('#divContenedorClienteNatural').css({'display' : 'inline-block'});
                        $('#divCalculoSegunComprobante').css({'display' : 'none'});
                    }
                }

                function onChangeCbxTipoPago()
                {
                    if($('#cbxTipoPago').val()=='Al Crédito')
                    {
                        $('#divContenedorAlCredito').css({'display' : 'inline-block'});
                    }
                    else
                    {
                        $('#divContenedorAlCredito').css({'display' : 'none'});
                    }
                }

                function onClickRadioModoPago()
                {
                    $('#divPagoPersonalizado').css({'display' : 'none'});
                    $('#divPagoAutomatico').css({'display' : 'none'});

                    if($('#txtRadioModoPago').val()=='Pago personalizado')
                    {
                        $('#divPagoPersonalizado').css({'display' : 'inline-block'});
                    }
                    if($('#txtRadioModoPago').val()=='Pago automático')
                    {
                        $('#divPagoAutomatico').css({'display' : 'inline-block'});
                        $('#txtPagoPersonalizado').val('0');
                    }
                }

                function onClickRadioGuiaRemision()
                {
                    if($('#txtRadioGuiaRemision').val()=='Si')
                    {
                        $('#divContenedorGuiaRemision').css({'display' : 'inline-block'});
                    }
                    if($('#txtRadioGuiaRemision').val()=='No')
                    {
                        $('#divContenedorGuiaRemision').css({'display' : 'none'});
                    }
                }

                function eliminarProductoLista(nietoElementoEliminar)
                {
                    var elementoEliminar=$(nietoElementoEliminar).parent().parent();

                    $(elementoEliminar).remove();

                    calcularSubTotalIgvTotalReciboVentaInsertar();

                    cargarListaProductos();
                }

                function calcularCantidad(tipoCantidad, codigoOficinaProducto)
                {
                    var cantidad;
                    if(tipoCantidad=='bloque')
                    {
                        if($('#cantidadProducto'+codigoOficinaProducto).text().trim()=='')
                        {
                            $('#cantidadBloqueProducto'+codigoOficinaProducto).text('0');
                            return;
                        }
                        cantidad=parseFloat($('#cantidadProducto'+codigoOficinaProducto).text())/parseFloat($('#unidadesBloqueProducto'+codigoOficinaProducto).text());
                        cantidad=parseFloat($('#unidadesBloqueProducto'+codigoOficinaProducto).text())==0?0:cantidad;
                        $('#cantidadBloqueProducto'+codigoOficinaProducto).text(cantidad);
                    }

                    if(tipoCantidad=='unidad')
                    {
                        if(parseFloat($('#unidadesBloqueProducto'+codigoOficinaProducto).text())!=0)
                        {
                            if($('#cantidadBloqueProducto'+codigoOficinaProducto).text().trim()=='')
                            {
                                $('#cantidadProducto'+codigoOficinaProducto).text('0');
                                return;
                            }
                            cantidad=parseFloat($('#cantidadBloqueProducto'+codigoOficinaProducto).text())*parseFloat($('#unidadesBloqueProducto'+codigoOficinaProducto).text());
                            $('#cantidadProducto'+codigoOficinaProducto).text(cantidad);
                        }
                    }
                }

                function calcularPrecioVentaSubTotalProducto(codigoOficinaProducto)
                {
                    if($('#cantidadProducto'+codigoOficinaProducto).text().trim()=='')
                    {
                        $('#precioVentaSubTotalProducto'+codigoOficinaProducto).text(0);
                    }
                    else
                    {
                        var precioVentaSubTotalProducto=parseFloat($('#cantidadProducto'+codigoOficinaProducto).text())*parseFloat($('#precioUnitarioProducto'+codigoOficinaProducto).text());

                        $('#precioVentaSubTotalProducto'+codigoOficinaProducto).text(precioVentaSubTotalProducto.toFixed(2));
                    }

                    calcularSubTotalIgvTotalReciboVentaInsertar();
                }

                function calcularSubTotalIgvTotalReciboVentaInsertar()
                {
                    var subTotalProductoTemporal=0;

                    $('#bodyTablaProductosAgregados').find('tr').each(function(index, elemento)
                    {
                        $(elemento).find('td').each(function(index2, elemento2)
                        {
                            if(index2=='17')
                            {
                                subTotalProductoTemporal+=parseFloat($(elemento2).text());
                            }
                        });
                    });

                    var valorTxtTotal=subTotalProductoTemporal;
                    valorTxtTotal=valorTxtTotal.toFixed(2);
                    $('#txtTotalTemporal').val(valorTxtTotal);
                    $('#txtTotal').val(valorTxtTotal);

                    calcularSubTotalIgvTotal('txtSubTotalTemporal', 'txtIgvTemporal', 'txtTotalTemporal');
                    calcularSubTotalIgvTotal('txtSubTotal', 'txtIgv', 'txtTotal');
                }

                function seleccionarBuscarOficinaProductoPorCodigoOficina(codigoOficinaProducto)
                {
                    var productoExisteLista=false;

                    $('#bodyTablaProductosAgregados').find('tr').each(function(index, elemento)
                    {
                        if(productoExisteLista)
                        {
                            return false;
                        }

                        $(elemento).find('td').each(function(index2, elemento2)
                        {
                            if(!productoExisteLista && $(elemento2).text()==codigoOficinaProducto)
                            {
                                productoExisteLista=true;

                                animacionAlertaMensajeGeneral('Cantidad agregada +1 al producto en la lista', '#FF8F00');
                            }

                            if(productoExisteLista && index2==13)
                            {
                                $(elemento2).text(parseInt($(elemento2).text())+1);
                                calcularCantidad('bloque', codigoOficinaProducto);
                                calcularPrecioVentaSubTotalProducto(codigoOficinaProducto);

                                return false;
                            }
                        });
                    });

                    if(!productoExisteLista)
                    {
                        var nuevoProducto=''+
                        '<tr class="elementoBuscar textAlignCenter">'+
                            '<td style="display: none;">'+codigoOficinaProducto+'</td>'+
                            '<td style="display: none;">'+$('#codigoBarrasOficinaProducto'+codigoOficinaProducto).text().trim()+'</td>'+
                            '<td style="display: none;">'+$('#primerNombreOficinaProducto'+codigoOficinaProducto).text().trim()+'</td>'+
                            '<td style="display: none;">'+$('#segundoNombreOficinaProducto'+codigoOficinaProducto).text().trim()+'</td>'+
                            '<td style="display: none;">'+$('#tercerNombreOficinaProducto'+codigoOficinaProducto).text().trim()+'</td>'+
                            '<td class="textAlignLeft"> <strong>'+$('#primerNombreOficinaProducto'+codigoOficinaProducto).text().trim()+'  '+$('#segundoNombreOficinaProducto'+codigoOficinaProducto).text().trim()+'  '+$('#tercerNombreOficinaProducto'+codigoOficinaProducto).text().trim()+'</strong></td>'+
                            '<td style="display: none;">'+$('#descripcionOficinaProducto'+codigoOficinaProducto).text().trim()+'</td>'+
							'<td>'+$('#tipoOficinaProducto'+codigoOficinaProducto).text().trim()+'</td>'+  	
							'<td>'+$('#categoriaOficinaProducto'+codigoOficinaProducto).text().trim()+'</td>'+ 
                            '<td style="display: none;">'+$('#categoriaOficinaProducto'+codigoOficinaProducto).text().trim()+'</td>'+
                            '<td>'+$('#presentacionOficinaProducto'+codigoOficinaProducto).text().trim()+'</td>'+
                            '<td>'+$('#unidadMedidaOficinaProducto'+codigoOficinaProducto).text().trim()+'</td>'+
                            '<td id="precioUnitarioProducto'+codigoOficinaProducto+'"><strong>'+$('#precioVentaUnitarioOficinaProducto'+codigoOficinaProducto).text().trim()+'</strong></td>'+
                            '<td id="cantidadProducto'+codigoOficinaProducto+'" onkeyup=calcularCantidad("bloque",'+codigoOficinaProducto+');calcularPrecioVentaSubTotalProducto('+codigoOficinaProducto+');cargarListaProductos(); contenteditable=true class="colorCampoEditable textAlignCenter">1</td>'+
                            '<td id="cantidadBloqueProducto'+codigoOficinaProducto+'" onkeyup=calcularCantidad("unidad",'+codigoOficinaProducto+');calcularPrecioVentaSubTotalProducto('+codigoOficinaProducto+');cargarListaProductos(); contenteditable=true class="colorCampoEditable textAlignCenter"></td>'+
                            '<td id="unidadesBloqueProducto'+codigoOficinaProducto+'">'+$('#unidadesBloqueOficinaProducto'+codigoOficinaProducto).text().trim()+'</td>'+
                            '<td>'+$('#unidadMedidaBloqueOficinaProducto'+codigoOficinaProducto).text().trim()+'</td>'+
                            '<td id="precioVentaSubTotalProducto'+codigoOficinaProducto+'" onkeyup=cargarListaProductos();calcularSubTotalIgvTotalReciboVentaInsertar(); contenteditable=true class="colorCampoEditable textAlignCenter"></td>'+
                            '<td><input type="button" value="Eliminar" onclick="eliminarProductoLista(this);"></td>'+
                        '</tr>';
                        $('#bodyTablaProductosAgregados').prepend(nuevoProducto);

                        if(parseFloat($('#unidadesBloqueOficinaProducto'+codigoOficinaProducto).text())==0)
                        {
                            $('#cantidadBloqueProducto'+codigoOficinaProducto).attr('contenteditable', false);
                            $('#cantidadBloqueProducto'+codigoOficinaProducto).removeClass('colorCampoEditable');
                        }

                        calcularCantidad('bloque', codigoOficinaProducto);
                        calcularPrecioVentaSubTotalProducto(codigoOficinaProducto);

                        animacionAlertaMensajeGeneral('Producto agregado a la lista', '#1497CC');
                    }

                    cargarListaProductos();
                }

                function calcularCodigoProductoServicio(codigoOficinaProducto, codigoItem)
                {
                    $('#bodyTablaProductosAgregados').find('tr').each(function(index, elemento)
                    {
                        $(elemento).find('td').each(function(index2, elemento2)
                        {
                            if($(elemento2).text().trim()==(codigoOficinaProducto.substring(0, 15-(codigoItem.valor.toString().length))+codigoItem.valor.toString()))
                            {
                                codigoItem.valor++;

                                calcularCodigoProductoServicio(codigoOficinaProducto, codigoItem);
                            }

                            return false;
                        });
                    });
                }

                function agregarProductoServicioListaVenta()
                {
                    var mensajeGlobal='';

                    mensajeGlobal+=!valVacio($('#txtNombreCompletoProductoServicio').val())?'Complete el campo Nombre completo del producto o servicio<br>':'';
                    mensajeGlobal+=!valVacio($('#txtUnidadMedidaProductoServicio').val())?'Complete el campo Unidad de medida del producto o servicio<br>':'';
                    mensajeGlobal+=!valDosDecimales($('#txtPrecioVentaUnitarioProductoServicio').val())?'El precio de venta unitario del producto o servicio debe ser en soles<br>':'';

                    if(mensajeGlobal!='')
                    {
                        animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
                        return;
                    }

                    var codigoOficinaProducto='900000000000000';
                    var codigoItem={};
                    codigoItem.valor=1;

                    calcularCodigoProductoServicio(codigoOficinaProducto, codigoItem);

                    codigoOficinaProducto=codigoOficinaProducto.substring(0, 15-(codigoItem.valor.toString().length))+codigoItem.valor.toString();

                    var nuevoProducto=''+
                    '<tr class="elementoBuscar textAlignCenter">'+
                        '<td style="display: none;">'+codigoOficinaProducto+'</td>'+
                        '<td style="display: none;"></td>'+
                        '<td style="display: none;">'+$('#txtNombreCompletoProductoServicio').val().trim()+'</td>'+
                        '<td style="display: none;"></td>'+
                        '<td style="display: none;"></td>'+
                        '<td>'+$('#txtNombreCompletoProductoServicio').val().trim().replace('<', '&lt;').replace('>', '&gt;')+'</td>'+
                        '<td style="display: none;"></td>'+
						'<td>'+$('#txtTipoProductoServicio').val().trim().replace('<', '&lt;').replace('>', '&gt;')+'</td>'+		
						'<td></td>'+
                        '<td style="display: none;"></td>'+
                        '<td>'+$('#txtPresentacionProductoServicio').val().trim().replace('<', '&lt;').replace('>', '&gt;')+'</td>'+
                        '<td>'+$('#txtUnidadMedidaProductoServicio').val().trim().replace('<', '&lt;').replace('>', '&gt;')+'</td>'+
                        '<td id="precioUnitarioProducto'+codigoOficinaProducto+'">'+$('#txtPrecioVentaUnitarioProductoServicio').val().trim()+'</td>'+
                        '<td id="cantidadProducto'+codigoOficinaProducto+'" onkeyup=calcularPrecioVentaSubTotalProducto('+codigoOficinaProducto+');cargarListaProductos(); contenteditable=true class="colorCampoEditable textAlignCenter">1</td>'+
                        '<td>0</td>'+
                        '<td>0</td>'+
                        '<td></td>'+
                        '<td id="precioVentaSubTotalProducto'+codigoOficinaProducto+'" onkeyup=cargarListaProductos();calcularSubTotalIgvTotalReciboVentaInsertar(); contenteditable=true class="colorCampoEditable textAlignCenter"></td>'+
                        '<td><input type="button" value="Eliminar" onclick="eliminarProductoLista(this);"></td>'+
                    '</tr>';
                    $('#bodyTablaProductosAgregados').prepend(nuevoProducto);

                    $('#cantidadBloqueProducto'+codigoOficinaProducto).attr('contenteditable', false);
                    $('#cantidadBloqueProducto'+codigoOficinaProducto).removeClass('colorCampoEditable');

                    calcularPrecioVentaSubTotalProducto(codigoOficinaProducto);

                    animacionAlertaMensajeGeneral('Producto o servicio agregado a la lista', '#1497CC');

                    cargarListaProductos();

                    limpiarText('divAcordionProductoExtra', []);

                    $('#txtTipoProductoServicio').val('');
                    $('#txtPresentacionProductoServicio').val('')
                    $('#txtUnidadMedidaProductoServicio').val('UND')
                }

                var lanzarEventoOnKeyUpTxtCodigoBarras;

                function onKeyUpTxtCodigoBarras()
                {
                    clearTimeout(lanzarEventoOnKeyUpTxtCodigoBarras);

                    lanzarEventoOnKeyUpTxtCodigoBarras=setTimeout(function()
                    {
                        paginaAjax('divListaBuscarOficinaProducto', {codigoOficina: '{{{explode(",", Session::get("local"))[0]}}}', codigoBarras: $('#txtCodigoBarras').val()}, '/APPSIVAK/public/oficinaproducto/listabuscaroficinaproductoporcodigobarras', 'POST', 
                        function()
                        {
                            $('#txtCodigoBarras').attr('readonly', 'readonly');
                        }, 
                        function()
                        {
                            $('#txtCodigoBarras').removeAttr('readonly');

                            var agregado=false;

                            $('#divListaBuscarOficinaProducto').find('div').each(function(index, elemento)
                            {
                                if(agregado)
                                {
                                    return false;
                                }

                                $(elemento).find('.filtroCodigoBarras').each(function(index2, elemento2)
                                {
                                    if($(elemento2).text().trim().toUpperCase()==$('#txtCodigoBarras').val().trim().toUpperCase() && $('#txtCodigoBarras').val().trim()!='')
                                    {
                                        $('#txtCodigoBarras').val('');
                                        var idElemento=$(elemento2).attr('id');
                                        var codigoOficinaProducto=idElemento.substring(27);
                                        seleccionarBuscarOficinaProductoPorCodigoOficina(codigoOficinaProducto);
                                        agregado=true;
                                    }
                                });
                            });
                        }, false, true);
                    }, 200);
                }

                function ocultarDivsBuscar()
                {
                    var css=
                    {
                        'display': 'none'
                    };
                    $('#divBuscarEnTablaOficinaProducto').css(css);
                    $('#divBuscarEnTablaClienteNatural').css(css);
                    $('#divBuscarEnTablaClienteJuridico').css(css);
                    /*Inicio comentario*/
                    /*Perteneciente a la petición ajax trasladar productos de Almacén para venta*/
                    $('#divBuscarEnTablaAlmacen').css(css);
                    $('#divBuscarEnTablaAlmacenProducto').css(css);
                    /*Fin comentario*/
                }

                function mostrarDivBuscar(idDivBuscar)
                {
                    var css=
                    {
                        'display': 'inline-block'
                    };
                    $('#'+idDivBuscar).css(css);
                }

                function limpiarFormularioVenta()
                {
                    if(confirm('Está seguro de limpiar todos los datos cargados en la venta?'))
                    {
                        window.location.href='/APPSIVAK/public/reciboventa/insertar';
                        return;
                    }
                    alert('Operación Cancelada');
                }

                function generarProforma()
                {
                    $('#txtDescripcion').val($('#txtDescripcionTemporal').val());
                    
                    var mensajeGlobal='';

                    if($('#txtListaProductos').val().trim()=='')
                    {
                        mensajeGlobal=mensajeGlobal+'Debe agregar productos a la lista para generar la proforma<br>';
                    }

                    if($('#cbxTipoRecibo').val()=='Factura')
                    {
                        mensajeGlobal+=!valVacio($('#txtRazonSocialLargaClienteJuridico').val())?'Debe completar el campo Razón social<br>':'';
                        mensajeGlobal+=!valRuc($('#txtRucClienteJuridico').val())?'Ruc incorrecto<br>':'';
                    }
                    else
                    {
                        if($('#txtNombreClienteNatural').val().trim()!='' || $('#txtApellidoPaternoClienteNatural').val().trim()!='' || $('#txtApellidoMaternoClienteNatural').val().trim()!='')
                        {
                            mensajeGlobal+=!valVacio($('#txtNombreClienteNatural').val())?'Debe completar el campo Nombre del cliente<br>':'';
                            mensajeGlobal+=!valVacio($('#txtApellidoPaternoClienteNatural').val())?'Debe completar el campo Apellido paterno del cliente<br>':'';
                            mensajeGlobal+=!valVacio($('#txtApellidoMaternoClienteNatural').val())?'Debe completar el campo Apellido materno del cliente<br>':'';
                        }

                        if($('#txtDniClienteNatural').val().trim()!='')
                        {
                            mensajeGlobal+=!valDni($('#txtDniClienteNatural').val())?'Campo Dni del cliente incorrecto<br>':'';
                        }
                    }

                    mensajeGlobal+=!valDosDecimales($('#txtSubTotal').val())?'Corrija los datos de la lista de productos<br>':'';
                    mensajeGlobal+=!valDosDecimales($('#txtIgv').val())?'Corrija los datos de la lista de productos<br>':'';
                    mensajeGlobal+=!valDosDecimales($('#txtTotal').val())?'Corrija los datos de la lista de productos<br>':'';

                    if(mensajeGlobal!='')
                    {
                        animacionAlertaMensajeGeneral(mensajeGlobal, 'red');

                        return;
                    }

                    if(confirm('Realmente desea emitir proforma?'))
                    {
                        $('#frmInsertarReciboVenta').attr('action', '/APPSIVAK/public/reporte/proforma');
                        $('#frmInsertarReciboVenta').attr('target', '_blank');
                        $('#frmInsertarReciboVenta').submit();
                        $('#frmInsertarReciboVenta').attr('action', '/APPSIVAK/public/reciboventa/insertar');
                        $('#frmInsertarReciboVenta').removeAttr('target');

                        return;
                    }

                    alert('Operación Cancelada');
                }

                function enviarFrmInsertarReciboVenta()
                {
                    $('#txtDescripcion').val($('#txtDescripcionTemporal').val());

                    var mensajeGlobal='';

                    if($('#cbxTipoRecibo').val()=='Factura')
                    {
                        mensajeGlobal+=!valVacio($('#txtRazonSocialLargaClienteJuridico').val())?'Debe completar el campo Razón social<br>':'';
                        mensajeGlobal+=!valRuc($('#txtRucClienteJuridico').val())?'Ruc incorrecto<br>':'';
                    }
                    else
                    {
                        if($('#txtNombreClienteNatural').val().trim()!='' || $('#txtApellidoPaternoClienteNatural').val().trim()!='' || $('#txtApellidoMaternoClienteNatural').val().trim()!='')
                        {
                            mensajeGlobal+=!valVacio($('#txtNombreClienteNatural').val())?'Debe completar el campo Nombre del cliente<br>':'';
                            mensajeGlobal+=!valVacio($('#txtApellidoPaternoClienteNatural').val())?'Debe completar el campo Apellido paterno del cliente<br>':'';
                            mensajeGlobal+=!valVacio($('#txtApellidoMaternoClienteNatural').val())?'Debe completar el campo Apellido materno del cliente<br>':'';
                        }

                        if($('#txtDniClienteNatural').val().trim()!='')
                        {
                            mensajeGlobal+=!valDni($('#txtDniClienteNatural').val())?'Campo Dni del cliente incorrecto<br>':'';
                        }
                    }

                    if($('#cbxTipoPago').val()=='Al Crédito')
                    {
                        mensajeGlobal+=!valFechaYYYYMMDD($('#txtFechaPrimerPago').val())?'Fecha de primer pago no válido<br>':'';

                        if($('#txtRadioModoPago').val()=='Pago personalizado')
                        {
                            mensajeGlobal+=!valEntero($('#txtPagoPersonalizado').val())?'Campo Intervalo de días para el pago incorrecto (El valor debe ser un número entero)<br>':'';

                            if(valEntero($('#txtPagoPersonalizado').val()) && $('#txtPagoPersonalizado').val()<=0)
                            {
                                mensajeGlobal+='El intervalo de días para el pago personalizado debe ser mayor a 0<br>';
                            }
                        }

                        mensajeGlobal+=!valEntero($('#txtLetras').val())?'El número de letras debe ser un valor entero<br>':'';

                        if(valEntero($('#txtLetras').val()) && $('#txtLetras').val()<=0)
                        {
                            mensajeGlobal+='El número de letras debe ser mayor a 0<br>';
                        }

                        if($('#cbxTipoRecibo').val()=='Factura')
                        {
                            mensajeGlobal+=!valVacio($('#txtDireccionClienteJuridico').val())?'Debe completar el campo Dirección del cliente<br>':'';
                        }
                        else
                        {
                            mensajeGlobal+=!valVacio($('#txtNombreClienteNatural').val())?'Debe completar el campo Nombre del cliente<br>':'';
                            mensajeGlobal+=!valVacio($('#txtApellidoPaternoClienteNatural').val())?'Debe completar el campo Apellido paterno del cliente<br>':'';
                            mensajeGlobal+=!valVacio($('#txtApellidoMaternoClienteNatural').val())?'Debe completar el campo Apellido materno del cliente<br>':'';
                            mensajeGlobal+=!valDni($('#txtDniClienteNatural').val())?'Campo Dni del cliente incorrecto<br>':'';
                            mensajeGlobal+=!valVacio($('#txtDireccionClienteNatural').val())?'Debe completar el campo Dirección del cliente<br>':'';
                        }
                    }

                    if(($('#cbxTipoRecibo').val()=='Boleta' || $('#cbxTipoRecibo').val()=='Factura') && $('#cbxTipoPago').val()=='Al Contado')
                    {
                        mensajeGlobal+=!valVacio($('#txtNumeroRecibo').val())?'Debe completar el campo Número de comprobante<br>':'';
                    }

                    if($('#txtRadioGuiaRemision').val()=='Si')
                    {
                        mensajeGlobal+=!valVacio($('#txtNombreCompletoReceptor').val())?'Debe completar el campo Nombre o razón social del receptor<br>':'';
                        mensajeGlobal+=!(valDni($('#txtDocumentoReceptor').val()) || valRuc($('#txtDocumentoReceptor').val()))?'Campo Dni o Ruc del receptor incorrecto<br>':'';
                        mensajeGlobal+=!valVacio($('#txtDireccionEnvioReceptor').val())?'Debe completar el campo Dirección de llegada<br>':'';
                        mensajeGlobal+=!valDosDecimales($('#txtFlete').val())?'El flete debe ser en soles<br>':'';
                        mensajeGlobal+=!(valDni($('#txtDocumentoTransportista').val()) || valRuc($('#txtDocumentoTransportista').val()))?'Campo Dni o Ruc del transportista incorrecto<br>':'';
                    }
                    else
                    {
                        $('#txtNombreCompletoReceptor').val('');
                        $('#txtDocumentoReceptor').val('');
                        $('#txtDireccionEnvioReceptor').val('');
                        $('#txtFlete').val('0.00');
                    }

                    if($('#txtListaProductos').val().trim()=='')
                    {
                        mensajeGlobal=mensajeGlobal+'Debe agregar productos a la lista para la venta<br>';
                    }

                    mensajeGlobal+=!valDosDecimales($('#txtSubTotal').val())?'Corrija los datos de la lista de productos<br>':'';
                    mensajeGlobal+=!valDosDecimales($('#txtIgv').val())?'Corrija los datos de la lista de productos<br>':'';
                    mensajeGlobal+=!valDosDecimales($('#txtTotal').val())?'Corrija los datos de la lista de productos<br>':'';

                    if(mensajeGlobal!='')
                    {
                        animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
                        return;
                    }

                    $('#txtHtmlListaProductos').val($('#bodyTablaProductosAgregados').html());

                    if(confirm('Confirmar Venta'))
                    {        
                        $('#frmInsertarReciboVenta').submit();
                        return;
                    }
                    alert('Operación Cancelada');
                }
            </script>
        @endif
    @endif
@stop