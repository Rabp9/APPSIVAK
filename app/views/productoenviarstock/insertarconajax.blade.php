<form id="frmInsertarConAjaxProductoEnviarStock" method="post" class="formulario labelPequenio textAlignCenter">
    <div class="contenidoTop textAlignLeft">
        <h2 class="bordeAbajo">Datos del envío</h2>
        <label for="txtDescripcionAlmacen">Almacén de partida</label>
        <input type="text" id="txtDescripcionAlmacen" name="txtDescripcionAlmacen" size="40" placeholder="Obligatorio" readonly="readonly">
        <input type="button" id="btnBuscarAlmacenProductoEnviarStock" value="Buscar Almacén" style="width: 200px;" onclick="onClickBtnBuscarAlmacenProductoEnviarStock();">
        <input type="hidden" id="txtCodigoAlmacen" name="txtCodigoAlmacen">
        <br>
        <label for="txtFleteProductoEnviarStock">Flete</label>
        <input type="text" id="txtFleteProductoEnviarStock" name="txtFleteProductoEnviarStock" placeholder="Obligatorio" value="0.00">
        <hr>
        <h2>Datos de los productos</h2>
        <hr>
        <input type="button" id="btnBuscarAlmacenProductoEnviarStockProductoPorCodigoAlmacen" value="Buscar Producto del Almacén Seleccionado" onclick="$('#divListaBuscarAlmacenProducto').html(''); ocultarDivsBuscar(); mostrarDivBuscar('divBuscarEnTablaAlmacenProducto'); mostrarApartadoBuscar();">
        <label class="noLabel" for="txtCodigoBarrasProductoEnviarStock">o agregarlo por código de barras</label>
        <input type="text" id="txtCodigoBarrasProductoEnviarStock" name="txtCodigoBarrasProductoEnviarStock" onkeyup="onKeyUpTxtCodigoBarrasProductoEnviarStock();" class="text" autofocus>
        <hr>
    </div>
    <input type="hidden" id="txtListaProductosProductoEnviarStock" name="txtListaProductosProductoEnviarStock" value="{{{isset($txtListaProductosProductoEnviarStock)?$txtListaProductosProductoEnviarStock:''}}}">
</form>
<hr>
<section>
    <table class="textoPequenio table">
        <thead>
            <th style="display: none;">CÓDIGO DEL PRODUCTO</th>
            <th style="display: none;">CÓDIGO DE BARRAS</th>
            <th>PRIMER NOMBRE</th>
            <th>SEGUNDO NOMBRE</th>
            <th>TERCER NOMBRE</th>
            <th style="display: none;">DESCRIPCIÓN</th>
            <th style="display: none;">TIPO PRODUCTO</th>
            <th style="display: none;">PRESENTACIÓN</th>
            <th style="display: none;">UNIDAD DE MEDIDA</th>
            <th>CANT. ACTUAL</th>
            <th>CANT. UND. A ENVIAR</th>
            <th style="display: none;">CANT. BLOQ. A ENVIAR</th>
            <th style="display: none;">VENTAS EN DECIMALES</th>
            <th>P. C. UNITARIO</th>
            <th>P. V. UNITARIO</th>
            <th style="display: none;">UND. BLOQUE</th>
            <th style="display: none;">UND. MEDIDA BLOQUE</th>
            <th>FECHA DE VENCIMIENTO</th>
            <th></th>
        </thead>
        <tbody id="bodyTablaProductosAgregadosProductoEnviarStock">

        </tbody>
    </table>
    <div id="divCargaEvento"></div>
</section>
<hr>
<div class="textAlignRight">
    <input type="button" class="button" value="Trasladar producto(s) de almacén y agregar a la lista de venta" onclick="enviarFrmInsertarConAjaxProductoEnviarStock();">
</div>
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
    <section id="divListaBuscarAlmacenProducto" class="anchoCompleto buscarAlmacenProducto labelPequenio textAlignCenter textoMediano">
        
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
<script>
    /*Inicio comentario*/
    /*Operación para evitar conflicto lo cual debe realizar en el formulario de ventas*/
    $('.apartadoBuscar #divBuscarEnTablaAlmacen').remove();
    $('.apartadoBuscar #divBuscarEnTablaAlmacenProducto').remove();

    $('.apartadoBuscar').append($('#divBuscarEnTablaAlmacen'));
    $('.apartadoBuscar').append($('#divBuscarEnTablaAlmacenProducto'));
    /*Fin comentario*/

    var lanzarEventoOnKeyUpTxtCodigoBarrasProductoEnviarStock;

    function onKeyUpTxtCodigoBarrasProductoEnviarStock()
    {
        clearTimeout(lanzarEventoOnKeyUpTxtCodigoBarrasProductoEnviarStock);

        lanzarEventoOnKeyUpTxtCodigoBarrasProductoEnviarStock=setTimeout(function()
        {
            paginaAjax('divListaBuscarAlmacenProducto', {codigoAlmacen: $('#txtCodigoAlmacen').val(), codigoBarras: $('#txtCodigoBarrasProductoEnviarStock').val()}, '/APPSIVAK/public/almacenproducto/listabuscaralmacenproductoporcodigobarras', 'POST', 
            function()
            {
                $('#txtCodigoBarrasProductoEnviarStock').attr('readonly', 'readonly');
            }, 
            function()
            {
                $('#txtCodigoBarrasProductoEnviarStock').removeAttr('readonly');

                var agregado=false;

                $('#divListaBuscarAlmacenProducto').find('div').each(function(index, elemento)
                {
                    if(agregado)
                    {
                        return false;
                    }

                    $(elemento).find('.filtroCodigoBarras').each(function(index2, elemento2)
                    {
                        if($(elemento2).text().trim().toUpperCase()==$('#txtCodigoBarrasProductoEnviarStock').val().trim().toUpperCase() && $('#txtCodigoBarrasProductoEnviarStock').val().trim()!='')
                        {
                            $('#txtCodigoBarrasProductoEnviarStock').val('');
                            var idElemento=$(elemento2).attr('id');
                            var codigoAlmacenProducto=idElemento.substring(27);
                            seleccionarBuscarAlmacenProductoPorCodigoAlmacen(codigoAlmacenProducto);
                            agregado=true;
                        }
                    });
                });
            }, false, true);
        }, 200);
    }

    function cargarListaProductosProductoEnviarStock()
    {
        $('#txtListaProductosProductoEnviarStock').val('');

        $('#bodyTablaProductosAgregadosProductoEnviarStock').find('tr').each(function(index, elemento)
        {
            $(elemento).find('td').each(function(index2, elemento2)
            {
                if(index2==18)
                {
                    var valorTratadoTxtListaProductosProductoEnviarStock=$('#txtListaProductosProductoEnviarStock').val().substring(0, $('#txtListaProductosProductoEnviarStock').val().length-18);
                    $('#txtListaProductosProductoEnviarStock').val(valorTratadoTxtListaProductosProductoEnviarStock);
                    return false;
                }
                $('#txtListaProductosProductoEnviarStock').val($('#txtListaProductosProductoEnviarStock').val()+$(elemento2).text()+'__SEPARADORCAMPO__');
            });

            $('#txtListaProductosProductoEnviarStock').val($('#txtListaProductosProductoEnviarStock').val()+'__SEPARADORREGISTRO__');
        });

        var valorTratadoTxtListaProductosProductoEnviarStock=$('#txtListaProductosProductoEnviarStock').val().substring(0, $('#txtListaProductosProductoEnviarStock').val().length-21);
        $('#txtListaProductosProductoEnviarStock').val(valorTratadoTxtListaProductosProductoEnviarStock);
    }

    function eliminarProductoListaProductoEnviarStock(nietoElementoEliminar)
    {
        var elementoEliminar=$(nietoElementoEliminar).parent().parent();

        $(elementoEliminar).remove();

        cargarListaProductosProductoEnviarStock();
    }

    function calcularCantidadProductoEnviarStock(tipoCantidad, codigoAlmacenProducto)
    {
        var cantidad;
        if(tipoCantidad=='bloque')
        {
            if($('#cantidadUnidadProductoEnviar'+codigoAlmacenProducto).text().trim()=='')
            {
                $('#cantidadBloqueProductoEnviar'+codigoAlmacenProducto).text('0');
                return;
            }
            cantidad=parseFloat($('#cantidadUnidadProductoEnviar'+codigoAlmacenProducto).text())/parseFloat($('#unidadesBloqueProducto'+codigoAlmacenProducto).text());
            cantidad=parseFloat($('#unidadesBloqueProducto'+codigoAlmacenProducto).text())==0?0:cantidad;
            $('#cantidadBloqueProductoEnviar'+codigoAlmacenProducto).text(cantidad);
        }

        if(tipoCantidad=='unidad')
        {
            if(parseFloat($('#unidadesBloqueProducto'+codigoAlmacenProducto).text())!=0)
            {
                if($('#cantidadBloqueProductoEnviar'+codigoAlmacenProducto).text().trim()=='')
                {
                    $('#cantidadUnidadProductoEnviar'+codigoAlmacenProducto).text('0');
                    return;
                }
                cantidad=parseFloat($('#cantidadBloqueProductoEnviar'+codigoAlmacenProducto).text())*parseFloat($('#unidadesBloqueProducto'+codigoAlmacenProducto).text());
                $('#cantidadUnidadProductoEnviar'+codigoAlmacenProducto).text(cantidad);
            }
        }
    }

    function seleccionarBuscarAlmacenProductoPorCodigoAlmacen(codigoAlmacenProducto)
    {
        var productoExisteLista=false;

        $('#bodyTablaProductosAgregadosProductoEnviarStock').find('tr').each(function(index, elemento)
        {
            if(productoExisteLista)
            {
                return false;
            }

            $(elemento).find('td').each(function(index2, elemento2)
            {
                if(!productoExisteLista && $(elemento2).text()==codigoAlmacenProducto)
                {
                    productoExisteLista=true;

                    animacionAlertaMensajeGeneral('Cantidad agregada +1 al producto en la lista', '#FF8F00');
                }

                if(productoExisteLista && index2==10)
                {
                    $(elemento2).text(parseInt($(elemento2).text())+1);
                    calcularCantidadProductoEnviarStock('bloque', codigoAlmacenProducto);
                    return false;
                }
            });
        });

        if(!productoExisteLista)
        {
            var nuevoProducto=''+
            '<tr>'+
                '<td style="display: none;">'+codigoAlmacenProducto+'</td>'+
                '<td style="display: none;">'+$('#codigoBarrasAlmacenProducto'+codigoAlmacenProducto).text().trim().replace('<', '&lt;').replace('>', '&gt;')+'</td>'+
                '<td>'+$('#primerNombreAlmacenProducto'+codigoAlmacenProducto).text().trim().replace('<', '&lt;').replace('>', '&gt;')+'</td>'+
                '<td>'+$('#segundoNombreAlmacenProducto'+codigoAlmacenProducto).text().trim().replace('<', '&lt;').replace('>', '&gt;')+'</td>'+
                '<td>'+$('#tercerNombreAlmacenProducto'+codigoAlmacenProducto).text().trim().replace('<', '&lt;').replace('>', '&gt;')+'</td>'+
                '<td style="display: none;">'+$('#descripcionAlmacenProducto'+codigoAlmacenProducto).text().trim().replace('<', '&lt;').replace('>', '&gt;')+'</td>'+
                '<td style="display: none;">'+$('#tipoAlmacenProducto'+codigoAlmacenProducto).text().trim()+'</td>'+
                '<td style="display: none;">'+$('#codigoPresentacionAlmacenProducto'+codigoAlmacenProducto).text().trim()+'</td>'+
                '<td style="display: none;">'+$('#codigoUnidadMedidaAlmacenProducto'+codigoAlmacenProducto).text().trim()+'</td>'+
                '<td>'+$('#cantidadAlmacenProducto'+codigoAlmacenProducto).text().trim()+'</td>'+
                '<td id="cantidadUnidadProductoEnviar'+codigoAlmacenProducto+'" onkeyup=calcularCantidadProductoEnviarStock("bloque",'+codigoAlmacenProducto+');cargarListaProductosProductoEnviarStock(); contenteditable=true class="colorCampoEditable textAlignCenter">1</td>'+
                '<td style="display: none;" id="cantidadBloqueProductoEnviar'+codigoAlmacenProducto+'" onkeyup=calcularCantidadProductoEnviarStock("unidad",'+codigoAlmacenProducto+');cargarListaProductosProductoEnviarStock(); contenteditable=true class="colorCampoEditable textAlignCenter"></td>'+
                '<td style="display: none;">'+$('#ventaMenorUnidadAlmacenProducto'+codigoAlmacenProducto).text().trim()+'</td>'+
                '<td>'+$('#precioCompraUnitarioAlmacenProducto'+codigoAlmacenProducto).text().trim()+'</td>'+
                '<td>'+$('#precioVentaUnitarioAlmacenProducto'+codigoAlmacenProducto).text().trim()+'</td>'+
                '<td style="display: none;" id="unidadesBloqueProducto'+codigoAlmacenProducto+'">'+$('#unidadesBloqueAlmacenProducto'+codigoAlmacenProducto).text().trim()+'</td>'+
                '<td style="display: none;">'+$('#unidadMedidaBloqueAlmacenProducto'+codigoAlmacenProducto).text().trim().replace('<', '&lt;').replace('>', '&gt;')+'</td>'+                
                '<td>'+$('#fechaVencimientoAlmacenProducto'+codigoAlmacenProducto).text().trim()+'</td>'+
                '<td><input type="button" value="Eliminar" onclick="eliminarProductoListaProductoEnviarStock(this);"></td>'+
            '</tr>';
            $('#bodyTablaProductosAgregadosProductoEnviarStock').prepend(nuevoProducto);

            if(parseFloat($('#unidadesBloqueAlmacenProducto'+codigoAlmacenProducto).text())==0)
            {
                $('#cantidadBloqueProductoEnviar'+codigoAlmacenProducto).attr('contenteditable', false);
                $('#cantidadBloqueProductoEnviar'+codigoAlmacenProducto).removeClass('colorCampoEditable');
            }

            calcularCantidadProductoEnviarStock('bloque', codigoAlmacenProducto);

            animacionAlertaMensajeGeneral('Producto agregado a la lista', '#1497CC');
        }

        cargarListaProductosProductoEnviarStock();
    }

    function onClickBtnBuscarAlmacenProductoEnviarStock()
    {
        var abrirBuscador=true;

        $('#bodyTablaProductosAgregadosProductoEnviarStock').find('tr').each(function(index, elemento)
        {
            animacionAlertaMensajeGeneral('Debe quitar los productos de la lista para seleccionar otro almacén', 'red');
            abrirBuscador=false;
            return false;
        });

        if(abrirBuscador)
        {
            ocultarDivsBuscar();
            mostrarDivBuscar('divBuscarEnTablaAlmacen');
            mostrarApartadoBuscar();
        }
    }

    function enviarFrmInsertarConAjaxProductoEnviarStock()
    {
        var mensajeGlobal='';
        
        mensajeGlobal+=(!valVacio($('#txtCodigoAlmacen').val())?'Debe seleccionar Almacén<br>':'');
        mensajeGlobal+=(!valDosDecimales($('#txtFleteProductoEnviarStock').val())?'El flete debe ser en soles<br>':'');
        
        var cantidadFilasAgregadas=0;

        if($('#txtListaProductosProductoEnviarStock').val().trim()!='')
        {
            cantidadFilasAgregadas++;
        }

        if(cantidadFilasAgregadas==0)
        {
            mensajeGlobal+='Debe agregar productos a la lista para la venta<br>';
        }

        if(mensajeGlobal!='')
        {
            animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
            return;
        }

        if(confirm('¿Realmente desea trasladar productos para su venta?'))
        {
            paginaAjax('divCargaEvento', {codigoAlmacen : $('#txtCodigoAlmacen').val(), flete : $('#txtFleteProductoEnviarStock').val(), listaProductos : $('#txtListaProductosProductoEnviarStock').val()}, '/APPSIVAK/public/productoenviarstock/insertarconajax', 'POST', null, null, false, true);

            return;
        }

        alert('Operación Cancelada');
    }
</script>