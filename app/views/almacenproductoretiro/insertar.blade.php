@extends('layout.layout')

@section('contenidoCuerpo')
    <h2 class="textAlignRight bordeAbajo tituloCabecera">RETIRAR PRODUCTO DE ALMACÉN</h2>
    <section class="contenidoTop">
        <form id="frmInsertarAlmacenProductoRetiro" action="/APPSIVAK/public/almacenproductoretiro/insertar" method="post" class="formulario labelMediano">
            <div id="divContenedorFormulario" class="contenidoTop textAlignLeft">
                <h2 class="bordeAbajo">Datos para el retiro del producto</h2>
                <label for="txtDescripcionAlmacen">Descripción de Almacén</label>
                <input type="text" id="txtDescripcionAlmacen" name="txtDescripcionAlmacen" size="50" placeholder="Obligatorio" readonly="readonly" value="{{{isset($txtDescripcionAlmacen)?$txtDescripcionAlmacen:''}}}">
                <input type="button" id="btnBuscarAlmacen" value="Buscar Almacén" style="width: 200px;" onclick="onClickBtnBuscarAlmacen();">
                <input type="hidden" id="txtCodigoAlmacen" name="txtCodigoAlmacen" value="{{{isset($txtCodigoAlmacen)?$txtCodigoAlmacen:''}}}">
                <br>
                <label for="txtNombreCompletoProducto">Nombre del producto</label>
                <input type="text" id="txtNombreCompletoProducto" name="txtNombreCompletoProducto" size="50" readonly="readonly" value="{{{isset($txtNombreCompletoProducto)?$txtNombreCompletoProducto:''}}}">
                <input type="button" id="btnBuscarAlmacenProducto" value="Buscar Producto" style="width: 200px;" onclick="onClickBtnBuscarAlmacenProducto();">
                <input type="hidden" id="txtCodigoAlmacenProducto" name="txtCodigoAlmacenProducto" value="{{{isset($txtCodigoAlmacenProducto)?$txtCodigoAlmacenProducto:''}}}">
                <br>
                <label for="txtTipoProducto">Tipo producto</label>
                <input type="text" id="txtTipoProducto" name="txtTipoProducto" size="50" readonly="readonly" value="{{{isset($txtTipoProducto)?$txtTipoProducto:''}}}">
                <input type="text" id="txtCodigoPresentacionProducto" name="txtCodigoPresentacionProducto" size="50" readonly="readonly" style="display: none;" value="{{{isset($txtCodigoPresentacionProducto)?$txtCodigoPresentacionProducto:''}}}">
                <input type="text" id="txtCodigoUnidadMedidaProducto" name="txtCodigoUnidadMedidaProducto" size="50" readonly="readonly" style="display: none;" value="{{{isset($txtCodigoUnidadMedidaProducto)?$txtCodigoUnidadMedidaProducto:''}}}">
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
                <input type="text" id="txtMontoPerdido" name="txtMontoPerdido" placeholder="Obligatorio" value="{{{isset($txtMontoPerdido)?$txtMontoPerdido:''}}}">
            </div>
            <div class="seccionBotones bordeArriba">
                <input type="button" value="Retirar producto" onclick="enviarFrmInsertarAlmacenProductoRetiro();">
            </div>
        </form>
    </section>
    <section id="apartadoBuscar" class="apartadoBuscar">
        <div id="divBuscarEnTablaAlmacen">
            <script>
                paginaAjax('divBuscarEnTablaAlmacen', null, '/APPSIVAK/public/almacen/buscaralmacen', 'POST', null, null, false, true);
            </script>
        </div>
        <div id="divBuscarEnTablaAlmacenProducto">
            <h2 class="textAlignCenter bordeAbajo">PRODUCTOS DE ALMACÉN</h2>
            <section class="anchoCompleto textAlignLeft backGroundColorGrisClaro">
                <label class="contenidoMiddle">Buscar</label>
                <input type="text" class="contenidoMiddle text" size="50" onkeypress="actionListaBuscarAlmacenProductoPorCodigoAlmacenNombre('divListaBuscarAlmacenProducto', this.value, event);">
                <input type="button" class="contenidoMiddle button" value="Ocultar Búsqueda" onclick="ocultarApartadoBuscar();">
            </section>
            <section id="divListaBuscarAlmacenProducto" class="anchoCompleto buscarAlmacenProducto labelPequenio textoMediano">
                
            </section>
            <script>
                var lanzarEventoListaBuscarAlmacenProductoPorCodigoAlmacenNombre;

                function actionListaBuscarAlmacenProductoPorCodigoAlmacenNombre(idSeccion, nombreCompletoProducto, event)
                {
                    var code=(event.keyCode ? event.keyCode : event.which);

                    if(code==13)
                    {
                        clearTimeout(lanzarEventoListaBuscarAlmacenProductoPorCodigoAlmacenNombre);

                        lanzarEventoListaBuscarAlmacenProductoPorCodigoAlmacenNombre=setTimeout(function()
                        {
                            paginaAjax(idSeccion, {codigoAlmacen: $('#txtCodigoAlmacen').val(), nombreCompletoProducto: nombreCompletoProducto}, '/APPSIVAK/public/almacenproducto/listabuscaralmacenproductoporcodigoalmacennombre', 'POST', null, function()
                            {
                                $('.btnSeleccionarAlmacenProducto').on('click', function()
                                {
                                    var codigoAlmacenProducto=this.id.substring(29);
                                    
                                    seleccionarBuscarAlmacenProductoPorCodigoAlmacen(codigoAlmacenProducto);
                                });
                            }, false, true);
                        }, 500);
                    }
                }
            </script>
        </div>
    </section>
    <script>
        function seleccionarBuscarAlmacenProductoPorCodigoAlmacen(codigoAlmacenProducto)
        {
            $('#txtCodigoAlmacenProducto').val($('#codigoAlmacenProducto'+codigoAlmacenProducto).text().trim());
            $('#txtNombreCompletoProducto').val($('#primerNombreAlmacenProducto'+codigoAlmacenProducto).text().trim()+' / '+$('#segundoNombreAlmacenProducto'+codigoAlmacenProducto).text().trim()+' / '+$('#tercerNombreAlmacenProducto'+codigoAlmacenProducto).text().trim());
            $('#txtTipoProducto').val($('#tipoAlmacenProducto'+codigoAlmacenProducto).text().trim());
            $('#txtCodigoPresentacionProducto').val($('#codigoPresentacionAlmacenProducto'+codigoAlmacenProducto).text().trim());
            $('#txtCodigoUnidadMedidaProducto').val($('#codigoUnidadMedidaAlmacenProducto'+codigoAlmacenProducto).text().trim());
            $('#txtCantidadProducto').val($('#cantidadAlmacenProducto'+codigoAlmacenProducto).text().trim());
            $('#txtPrecioCompraUnitarioProducto').val($('#precioCompraUnitarioAlmacenProducto'+codigoAlmacenProducto).text().trim());
            $('#txtPrecioVentaUnitarioProducto').val($('#precioVentaUnitarioAlmacenProducto'+codigoAlmacenProducto).text().trim());
            $('#txtFechaVencimientoProducto').val($('#fechaVencimientoAlmacenProducto'+codigoAlmacenProducto).text().trim());

            ocultarApartadoBuscar();

            animacionAlertaMensajeGeneral('El producto fue cargado en el formulario', '#1497CC');
        }

        function onChangeTxtCodigoAlmacen()
        {
            limpiarHidden('divContenedorFormulario', ['txtCodigoAlmacen']);
            limpiarText('divContenedorFormulario', ['txtDescripcionAlmacen']);
            limpiarTextArea('divContenedorFormulario', null);
        }

        function onClickBtnBuscarAlmacen()
        {            
            ocultarDivsBuscar();
            mostrarDivBuscar('divBuscarEnTablaAlmacen');
            mostrarApartadoBuscar();
        }

        function onClickBtnBuscarAlmacenProducto()
        {
            $('#divListaBuscarAlmacenProducto').html('');

            ocultarDivsBuscar();
            mostrarDivBuscar('divBuscarEnTablaAlmacenProducto');
            mostrarApartadoBuscar();
        }

    	function ocultarDivsBuscar()
        {
            var css=
            {
                'display': 'none'
            };
            $('#divBuscarEnTablaAlmacen').css(css);
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

        function enviarFrmInsertarAlmacenProductoRetiro()
        {
            var mensajeGlobal='';
            
            mensajeGlobal+=(!valVacio($('#txtCodigoAlmacen').val())?'Debe seleccionar Almacén<br>':'');
            mensajeGlobal+=(!valVacio($('#txtCodigoAlmacenProducto').val())?'Debe seleccionar Producto<br>':'');

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
                $('#frmInsertarAlmacenProductoRetiro').submit();
                return;
            }
            alert('Operación Cancelada');
        }
    </script>
@stop