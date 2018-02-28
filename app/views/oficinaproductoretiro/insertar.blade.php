@extends('layout.layout')

@section('contenidoCuerpo')
    <h2 class="textAlignRight bordeAbajo tituloCabecera">RETIRAR PRODUCTO DE OFICINA</h2>
    <section class="contenidoTop">
        <form id="frmInsertarOficinaProductoRetiro" action="/APPSIVAK/public/oficinaproductoretiro/insertar" method="post" class="formulario labelMediano">
            <div id="divContenedorFormulario" class="contenidoTop textAlignLeft">
                <h2 class="bordeAbajo">Datos para el retiro del producto</h2>
                <label for="txtDescripcionOficina">Descripción de Oficina</label>
                <input type="text" id="txtDescripcionOficina" name="txtDescripcionOficina" size="50" placeholder="Obligatorio" readonly="readonly" value="{{{isset($txtDescripcionOficina)?$txtDescripcionOficina:''}}}">
                <input type="button" id="btnBuscarOficina" value="Buscar Oficina" style="width: 200px;" onclick="onClickBtnBuscarOficina();">
                <input type="hidden" id="txtCodigoOficina" name="txtCodigoOficina" value="{{{isset($txtCodigoOficina)?$txtCodigoOficina:''}}}">
                <br>
                <label for="txtNombreCompletoProducto">Nombre del producto</label>
                <input type="text" id="txtNombreCompletoProducto" name="txtNombreCompletoProducto" size="50" readonly="readonly" value="{{{isset($txtNombreCompletoProducto)?$txtNombreCompletoProducto:''}}}">
                <input type="button" id="btnBuscarOficinaProducto" value="Buscar Producto" style="width: 200px;" onclick="onClickBtnBuscarOficinaProducto();">
                <input type="hidden" id="txtCodigoOficinaProducto" name="txtCodigoOficinaProducto" value="{{{isset($txtCodigoOficinaProducto)?$txtCodigoOficinaProducto:''}}}">
                <br>
                <label for="txtTipoProducto">Tipo producto</label>
                <input type="text" id="txtTipoProducto" name="txtTipoProducto" size="50" readonly="readonly" value="{{{isset($txtTipoProducto)?$txtTipoProducto:''}}}">
                <br>
                <label for="txtPresentacionProducto">Presentación producto</label>
                <input type="text" id="txtPresentacionProducto" name="txtPresentacionProducto" size="50" readonly="readonly" value="{{{isset($txtPresentacionProducto)?$txtPresentacionProducto:''}}}">
                <br>
                <label for="txtUnidadMedidaProducto">Unidad de medida del producto</label>
                <input type="text" id="txtUnidadMedidaProducto" name="txtUnidadMedidaProducto" size="50" readonly="readonly" value="{{{isset($txtUnidadMedidaProducto)?$txtUnidadMedidaProducto:''}}}">
                <br>
                <label for="txtCantidadProducto">Cantidad actual del producto</label>
                <input type="text" id="txtCantidadProducto" name="txtCantidadProducto" size="50" readonly="readonly" value="{{{isset($txtCantidadProducto)?$txtCantidadProducto:''}}}">
                <br>
                <label for="txtPrecioCompraUnitarioProducto">Precio compra unitario del producto</label>
                <input type="text" id="txtPrecioCompraUnitarioProducto" name="txtPrecioCompraUnitarioProducto" size="50" readonly="readonly" value="{{{isset($txtPrecioCompraUnitarioProducto)?$txtPrecioCompraUnitarioProducto:''}}}">
                <br>
                <label for="txtPrecioVentaUnitarioProducto">Precio venta unitario del producto</label>
                <input type="text" id="txtPrecioVentaUnitarioProducto" name="txtPrecioVentaUnitarioProducto" size="50" readonly="readonly" value="{{{isset($txtPrecioVentaUnitarioProducto)?$txtPrecioVentaUnitarioProducto:''}}}">
                <br>
                <label for="txtFechaVencimientoProducto">Fecha de vencimiento del producto</label>
                <input type="text" id="txtFechaVencimientoProducto" name="txtFechaVencimientoProducto" size="50" readonly="readonly" value="{{{isset($txtFechaVencimientoProducto)?$txtFechaVencimientoProducto:''}}}">
                <br>
                <label for="txtCantidadUnidad">Cantidad a retirar</label>
                <input type="text" id="txtCantidadUnidad" name="txtCantidadUnidad" placeholder="Obligatorio" value="{{{isset($txtCantidadUnidad)?$txtCantidadUnidad:''}}}">
                <br>
                <label for="txtDescripcion">Descripión del retiro</label>
                <textarea name="txtDescripcion" id="txtDescripcion" placeholder="Obligatorio" cols="46" rows="5">{{{isset($txtDescripcion)?$txtDescripcion:''}}}</textarea>
                <br>
                <label for="txtMontoPerdido">Monto perdido</label>
                <input type="text" id="txtMontoPerdido" name="txtMontoPerdido" placeholder="Obligatorio" value="{{{isset($txtMontoPerdido)?$txtMontoPerdido:'0.00'}}}">
            </div>
            <div class="seccionBotones bordeArriba">
                <input type="button" value="Retirar producto" onclick="enviarFrmInsertarOficinaProductoRetiro();">
            </div>
        </form>
    </section>
    <section id="apartadoBuscar" class="apartadoBuscar">
        <div id="divBuscarEnTablaOficina">
            <script>
                paginaAjax('divBuscarEnTablaOficina', null, '/APPSIVAK/public/oficina/buscaroficina', 'POST', null, null, false, true);
            </script>
        </div>
        <div id="divBuscarEnTablaOficinaProducto">
            <h2 class="textAlignCenter bordeAbajo">PRODUCTOS DE OFICINA</h2>
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
                            paginaAjax(idSeccion, {codigoOficina: $('#txtCodigoOficina').val(), nombreCompletoProducto: nombreCompletoProducto}, '/APPSIVAK/public/oficinaproducto/listabuscaroficinaproductoporcodigooficinanombre', 'POST', null, function()
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
    </section>
    <script>
        function seleccionarBuscarOficinaProductoPorCodigoOficina(codigoOficinaProducto)
        {
            $('#txtCodigoOficinaProducto').val($('#codigoOficinaProducto'+codigoOficinaProducto).text().trim());
            $('#txtNombreCompletoProducto').val($('#primerNombreOficinaProducto'+codigoOficinaProducto).text().trim()+' / '+$('#segundoNombreOficinaProducto'+codigoOficinaProducto).text().trim()+' / '+$('#tercerNombreOficinaProducto'+codigoOficinaProducto).text().trim());
            $('#txtTipoProducto').val($('#tipoOficinaProducto'+codigoOficinaProducto).text().trim());
            $('#txtPresentacionProducto').val($('#presentacionOficinaProducto'+codigoOficinaProducto).text().trim());
            $('#txtUnidadMedidaProducto').val($('#unidadMedidaOficinaProducto'+codigoOficinaProducto).text().trim());
            $('#txtCantidadProducto').val($('#cantidadOficinaProducto'+codigoOficinaProducto).text().trim());
            $('#txtPrecioCompraUnitarioProducto').val($('#precioCompraUnitarioOficinaProducto'+codigoOficinaProducto).text().trim());
            $('#txtPrecioVentaUnitarioProducto').val($('#precioVentaUnitarioOficinaProducto'+codigoOficinaProducto).text().trim());
            $('#txtFechaVencimientoProducto').val($('#fechaVencimientoOficinaProducto'+codigoOficinaProducto).text().trim());

            ocultarApartadoBuscar();

            animacionAlertaMensajeGeneral('El producto fue cargado en el formulario', '#1497CC');
        }

        function onChangeTxtCodigoOficina()
        {
            limpiarHidden('divContenedorFormulario', ['txtCodigoOficina']);
            limpiarText('divContenedorFormulario', ['txtDescripcionOficina']);
            limpiarTextArea('divContenedorFormulario', null);
        }

        function onClickBtnBuscarOficina()
        {            
            ocultarDivsBuscar();
            mostrarDivBuscar('divBuscarEnTablaOficina');
            mostrarApartadoBuscar();
        }

        function onClickBtnBuscarOficinaProducto()
        {
            $('#divListaBuscarOficinaProducto').html('');

            ocultarDivsBuscar();
            mostrarDivBuscar('divBuscarEnTablaOficinaProducto');
            mostrarApartadoBuscar();
        }

    	function ocultarDivsBuscar()
        {
            var css=
            {
                'display': 'none'
            };
            $('#divBuscarEnTablaOficina').css(css);
            $('#divBuscarEnTablaOficinaProducto').css(css);
        }

        function mostrarDivBuscar(idDivBuscar)
        {
            var css=
            {
                'display': 'inline-block'
            };
            $('#'+idDivBuscar).css(css);
        }

        function enviarFrmInsertarOficinaProductoRetiro()
        {
            var mensajeGlobal='';
            
            mensajeGlobal+=(!valVacio($('#txtCodigoOficina').val())?'Debe seleccionar Oficina<br>':'');
            mensajeGlobal+=(!valVacio($('#txtCodigoOficinaProducto').val())?'Debe seleccionar Producto<br>':'');

            if($('#txtVentaMenorUnidadProducto').val()=='No')
            {
                mensajeGlobal+=(!valEntero($('#txtCantidadUnidad').val())?'La cantidad a retirar debe ser un valor entero<br>':'');
            }
            
            if($('#txtVentaMenorUnidadProducto').val()=='Si')
            {
                mensajeGlobal+=(!valDecimal($('#txtCantidadUnidad').val())?'La cantidad a retirar debe ser un valor numérico<br>':'');
            }

            mensajeGlobal+=(!valVacio($('#txtDescripcion').val())?'La descripión del retiro es obligatorio<br>':'');
            mensajeGlobal+=(!valDosDecimales($('#txtMontoPerdido').val())?'El monto perdido debe ser en soles<br>':'');

            if(mensajeGlobal!='')
            {
                animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
                return;
            }

            if(confirm('Confirmar Registro'))
            {        
                $('#frmInsertarOficinaProductoRetiro').submit();
                return;
            }
            alert('Operación Cancelada');
        }
    </script>
@stop