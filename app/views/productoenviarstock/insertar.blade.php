@extends('layout.layout')

@section('contenidoCuerpo')
    <h2 class="textAlignRight bordeAbajo tituloCabecera">ENVIAR PRODUCTOS DE ALMACÉN A STOCK</h2>
    <section class="contenidoTop">
        <form id="frmInsertarProductoEnviarStock" action="/APPSIVAK/public/productoenviarstock/insertar" method="post" class="formulario labelMediano">
            <div class="contenidoTop textAlignLeft">
                <h2 class="bordeAbajo">Datos del envío</h2>
                <label for="txtDescripcionAlmacen">Almacén de partida</label>
                <input type="text" id="txtDescripcionAlmacen" name="txtDescripcionAlmacen" size="40" placeholder="Obligatorio" readonly="readonly" value="{{{isset($txtDescripcionAlmacen)?$txtDescripcionAlmacen:''}}}">
                <input type="button" id="btnBuscarAlmacen" value="Buscar Almacén" style="width: 200px;" onclick="onClickBtnBuscarAlmacen();">
                <input type="hidden" id="txtCodigoAlmacen" name="txtCodigoAlmacen" value="{{{isset($txtCodigoAlmacen)?$txtCodigoAlmacen:''}}}">
                <br>
                <label for="txtDescripcionOficina">Oficina de llegada</label>
                <input type="text" id="txtDescripcionOficina" name="txtDescripcionOficina" size="40" placeholder="Obligatorio" readonly="readonly" value="{{{isset($txtDescripcionOficina)?$txtDescripcionOficina:''}}}">
                <input type="button" id="btnBuscarOficina" value="Buscar Oficina" style="width: 200px;" onclick="ocultarDivsBuscar(); mostrarDivBuscar('divBuscarEnTablaOficina'); mostrarApartadoBuscar();">
                <input type="hidden" id="txtCodigoOficina" name="txtCodigoOficina" readonly="readonly" value="{{{isset($txtCodigoOficina)?$txtCodigoOficina:''}}}">
                <br>
                <label for="txtFlete">Flete</label>
                <input type="text" id="txtFlete" name="txtFlete" placeholder="Obligatorio" autocomplete="off" value="{{{isset($txtFlete)?$txtFlete:''}}}">
                <hr>
                <h2>Datos de los productos</h2>
                <hr>
                <input type="button" id="btnBuscarAlmacenProductoPorCodigoAlmacen" value="Buscar Producto del Almacén Seleccionado" onclick="ocultarDivsBuscar(); mostrarDivBuscar('divBuscarEnTablaAlmacenProducto'); mostrarApartadoBuscar();">
                <label class="noLabel" for="txtCodigoBarras">o agregarlo por código de barras</label>
                <input type="text" id="txtCodigoBarras" name="txtCodigoBarras" onkeyup="onKeyUpTxtCodigoBarras();" class="text" autofocus autocomplete="off">
                <hr>
            </div>
            <input type="hidden" id="txtListaProductos" name="txtListaProductos" value="{{{isset($txtListaProductos)?$txtListaProductos:''}}}">
            <input type="hidden" id="txtHtmlListaProductos" name="txtHtmlListaProductos" value="{{{isset($txtHtmlListaProductosDevueltos)?$txtHtmlListaProductosDevueltos:''}}}">
        </form>
    </section>
    <hr>
    <section>
        <div class="bordeAbajo textAlignLeft">
            <label class="contenidoMiddle noLabel">Buscar: </label>
            <input type="text" class="contenidoMiddle text" size="50" onkeyup="filtrarHtml('tableProductosAgregados', this.value, false, 200, event);">
        </div>
        <table id="tableProductosAgregados" class="textoPequenio table">
            <thead>
                <th style="display: none;">CÓDIGO DEL PRODUCTO</th>
                <th style="display: none;">CÓDIGO DE BARRAS</th>
                <th>PRIMER NOMBRE</th>
                <th>SEGUNDO NOMBRE</th>
                <th>TERCER NOMBRE</th>
                <th>DESCRIPCIÓN</th>
                <th>TIPO PRODUCTO</th>
                <th>PRESENTACIÓN</th>
                <th>UNIDAD DE MEDIDA</th>
                <th>CANT. ACTUAL</th>
                <th>CANT. UND. A ENVIAR</th>
                <th>CANT. BLOQ. A ENVIAR</th>
                <th>VENTAS EN DECIMALES</th>
                <th>P. C. UNITARIO</th>
                <th>P. V. UNITARIO</th>
                <th>UND. BLOQUE</th>
                <th>UND. MEDIDA BLOQUE</th>
                <th>FECHA DE VENCIMIENTO</th>
                <th class="widthEditarTable"></th>
            </thead>
            <tbody id="bodyTablaProductosAgregados">

            </tbody>
        </table>
    </section>
    <hr>
    <div class="textAlignRight">
        <input type="button" class="button" value="Registrar Datos" onclick="enviarFrmInsertarProductoEnviarStock();" style="height: 40px;width: 420px;">
    </div>
    <section id="apartadoBuscar" class="apartadoBuscar">
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
        $(document).on('ready', function()
        {
            if($('#txtListaProductos').val()!='')
            {                
                $('#bodyTablaProductosAgregados').html($('#txtHtmlListaProductos').val());
            }
        });

        var lanzarEventoOnKeyUpTxtCodigoBarras;

        function onKeyUpTxtCodigoBarras()
        {
            clearTimeout(lanzarEventoOnKeyUpTxtCodigoBarras);

            lanzarEventoOnKeyUpTxtCodigoBarras=setTimeout(function()
            {
                paginaAjax('divListaBuscarAlmacenProducto', {codigoAlmacen: $('#txtCodigoAlmacen').val(), codigoBarras: $('#txtCodigoBarras').val()}, '/APPSIVAK/public/almacenproducto/listabuscaralmacenproductoporcodigobarras', 'POST', 
                function()
                {
                    $('#txtCodigoBarras').attr('readonly', 'readonly');
                }, 
                function()
                {
                    $('#txtCodigoBarras').removeAttr('readonly');

                    var agregado=false;

                    $('#divListaBuscarAlmacenProducto').find('div').each(function(index, elemento)
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
                                var codigoAlmacenProducto=idElemento.substring(27);
                                seleccionarBuscarAlmacenProductoPorCodigoAlmacen(codigoAlmacenProducto);
                                agregado=true;
                            }
                        });
                    });
                }, false, true);
            }, 200);
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

        function eliminarProductoLista(nietoElementoEliminar)
        {
            var elementoEliminar=$(nietoElementoEliminar).parent().parent();

            $(elementoEliminar).remove();

            cargarListaProductos();
        }

        function calcularCantidad(tipoCantidad, codigoAlmacenProducto)
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

            $('#bodyTablaProductosAgregados').find('tr').each(function(index, elemento)
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
                        calcularCantidad('bloque', codigoAlmacenProducto);
                        return false;
                    }
                });
            });

            if(!productoExisteLista)
            {
                var nuevoProducto=''+
                '<tr class="elementoBuscar">'+
                    '<td style="display: none;">'+codigoAlmacenProducto+'</td>'+
                    '<td style="display: none;">'+$('#codigoBarrasAlmacenProducto'+codigoAlmacenProducto).text().trim().replace('<', '&lt;').replace('>', '&gt;')+'</td>'+
                    '<td>'+$('#primerNombreAlmacenProducto'+codigoAlmacenProducto).text().trim().replace('<', '&lt;').replace('>', '&gt;')+'</td>'+
                    '<td>'+$('#segundoNombreAlmacenProducto'+codigoAlmacenProducto).text().trim().replace('<', '&lt;').replace('>', '&gt;')+'</td>'+
                    '<td>'+$('#tercerNombreAlmacenProducto'+codigoAlmacenProducto).text().trim().replace('<', '&lt;').replace('>', '&gt;')+'</td>'+
                    '<td>'+$('#descripcionAlmacenProducto'+codigoAlmacenProducto).text().trim().replace('<', '&lt;').replace('>', '&gt;')+'</td>'+
                    '<td>'+$('#tipoAlmacenProducto'+codigoAlmacenProducto).text().trim()+'</td>'+
                    '<td>'+$('#codigoPresentacionAlmacenProducto'+codigoAlmacenProducto).text().trim()+'</td>'+
                    '<td>'+$('#codigoUnidadMedidaAlmacenProducto'+codigoAlmacenProducto).text().trim()+'</td>'+
                    '<td>'+$('#cantidadAlmacenProducto'+codigoAlmacenProducto).text().trim()+'</td>'+
                    '<td id="cantidadUnidadProductoEnviar'+codigoAlmacenProducto+'" onkeyup=calcularCantidad("bloque",'+codigoAlmacenProducto+');cargarListaProductos(); contenteditable=true class="colorCampoEditable textAlignCenter">1</td>'+
                    '<td id="cantidadBloqueProductoEnviar'+codigoAlmacenProducto+'" onkeyup=calcularCantidad("unidad",'+codigoAlmacenProducto+');cargarListaProductos(); contenteditable=true class="colorCampoEditable textAlignCenter"></td>'+
                    '<td>'+$('#ventaMenorUnidadAlmacenProducto'+codigoAlmacenProducto).text().trim()+'</td>'+
                    '<td>'+$('#precioCompraUnitarioAlmacenProducto'+codigoAlmacenProducto).text().trim()+'</td>'+
                    '<td>'+$('#precioVentaUnitarioAlmacenProducto'+codigoAlmacenProducto).text().trim()+'</td>'+
                    '<td id="unidadesBloqueProducto'+codigoAlmacenProducto+'">'+$('#unidadesBloqueAlmacenProducto'+codigoAlmacenProducto).text().trim()+'</td>'+
                    '<td>'+$('#unidadMedidaBloqueAlmacenProducto'+codigoAlmacenProducto).text().trim().replace('<', '&lt;').replace('>', '&gt;')+'</td>'+                
                    '<td>'+$('#fechaVencimientoAlmacenProducto'+codigoAlmacenProducto).text().trim()+'</td>'+
                    '<td><input type="button" value="Eliminar" onclick="eliminarProductoLista(this);"></td>'+
                '</tr>';
                $('#bodyTablaProductosAgregados').prepend(nuevoProducto);

                if(parseFloat($('#unidadesBloqueAlmacenProducto'+codigoAlmacenProducto).text())==0)
                {
                    $('#cantidadBloqueProductoEnviar'+codigoAlmacenProducto).attr('contenteditable', false);
                    $('#cantidadBloqueProductoEnviar'+codigoAlmacenProducto).removeClass('colorCampoEditable');
                }

                calcularCantidad('bloque', codigoAlmacenProducto);

                animacionAlertaMensajeGeneral('Producto agregado a la lista', '#1497CC');
            }

            cargarListaProductos();
        }

        function onClickBtnBuscarAlmacen()
        {
            var abrirBuscador=true;

            $('#bodyTablaProductosAgregados').find('tr').each(function(index, elemento)
            {
                animacionAlertaMensajeGeneral('Debe quitar los productos de la lista para seleccionar otro almacén', 'red');
                abrirBuscador=false;
                return false;
            });

            if(abrirBuscador)
            {
                $('#divListaBuscarAlmacenProducto').html('');
                
                ocultarDivsBuscar();
                mostrarDivBuscar('divBuscarEnTablaAlmacen');
                mostrarApartadoBuscar();
            }
        }

    	function ocultarDivsBuscar()
        {
            var css=
            {
                'display' : 'none'
            };

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

        function enviarFrmInsertarProductoEnviarStock()
        {
            var mensajeGlobal='';
            
            mensajeGlobal+=(!valVacio($('#txtCodigoAlmacen').val())?'Debe seleccionar Almacén<br>':'');
            mensajeGlobal+=(!valVacio($('#txtCodigoOficina').val())?'Debe seleccionar Oficina<br>':'');
            mensajeGlobal+=(!valDosDecimales($('#txtFlete').val())?'El flete debe ser en soles<br>':'');
            
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
                $('#frmInsertarProductoEnviarStock').submit();
                return;
            }
            alert('Operación Cancelada');
        }
    </script>
@stop