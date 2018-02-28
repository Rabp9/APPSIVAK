@extends('layout.layout')

@section('contenidoCuerpo')
    <h2 class="textAlignRight bordeAbajo tituloCabecera">TRASLADO DE PRODUCTOS ENTRE OFICINAS/TIENDAS</h2>
    <section class="contenidoTop">
        <form id="frmInsertarProductoTrasladoOficina" action="/APPSIVAK/public/productotrasladooficina/insertar" method="post" class="formulario labelMediano">
            <div class="contenidoTop textAlignLeft">
                <h2 class="bordeAbajo">Datos del traslado</h2>
                <label for="txtDescripcionOficina">Oficina/Tienda de partida</label>
                <input type="text" id="txtDescripcionOficina" name="txtDescripcionOficina" size="40" placeholder="Obligatorio" readonly="readonly" value="{{{isset($txtDescripcionOficina)?$txtDescripcionOficina:''}}}">
                <input type="button" id="btnBuscarOficina" value="Buscar oficina de partida" style="width: 230px;" onclick="onClickBtnBuscarOficina();">
                <input type="hidden" id="txtCodigoOficina" name="txtCodigoOficina" value="{{{isset($txtCodigoOficina)?$txtCodigoOficina:''}}}">
                <br>
                <label for="txtDescripcionOficinaDos">Oficina/Tienda de llegada</label>
                <input type="text" id="txtDescripcionOficinaDos" name="txtDescripcionOficinaDos" size="40" placeholder="Obligatorio" readonly="readonly" value="{{{isset($txtDescripcionOficinaDos)?$txtDescripcionOficinaDos:''}}}">
                <input type="button" id="btnBuscarOficinaDos" value="Buscar oficina de llegada" style="width: 230px;" onclick="ocultarDivsBuscar(); mostrarDivBuscar('divBuscarEnTablaOficinaDos'); mostrarApartadoBuscar();">
                <input type="hidden" id="txtCodigoOficinaDos" name="txtCodigoOficinaDos" readonly="readonly" value="{{{isset($txtCodigoOficinaDos)?$txtCodigoOficinaDos:''}}}">
                <br>
                <label for="txtFlete">Flete</label>
                <input type="text" id="txtFlete" name="txtFlete" placeholder="Obligatorio" autocomplete="off" value="{{{isset($txtFlete)?$txtFlete:''}}}">
                <hr>
                <h2>Datos de los productos</h2>
                <hr>
                <input type="button" id="btnBuscarOficinaProductoPorCodigoOficina" value="Buscar producto de la oficina de partida seleccionada" onclick="ocultarDivsBuscar(); mostrarDivBuscar('divBuscarEnTablaOficinaProducto'); mostrarApartadoBuscar();">
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
                <th>CATEGORÍA</th>
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
        <input type="button" class="button" value="Registrar Datos" onclick="enviarFrmInsertarProductoTrasladoOficina();" style="height: 40px;width: 420px;">
    </div>
    <section id="apartadoBuscar" class="apartadoBuscar">
        <div id="divBuscarEnTablaOficina">
            <script>
                paginaAjax('divBuscarEnTablaOficina', null, '/APPSIVAK/public/oficina/buscaroficina', 'POST', null, null, false, true);
            </script>
        </div>
        <div id="divBuscarEnTablaOficinaDos">
            <script>
                paginaAjax('divBuscarEnTablaOficinaDos', null, '/APPSIVAK/public/oficina/buscaroficinados', 'POST', null, null, false, true);
            </script>
        </div>
        <div id="divBuscarEnTablaOficinaProducto">            
            <h2 class="textAlignCenter bordeAbajo">PRODUCTOS DE LA OFICINA DE PARTIDA</h2>
            <section class="anchoCompleto textAlignLeft backGroundColorGrisClaro">
                <label class="contenidoMiddle">Buscar</label>
                <input type="text" class="contenidoMiddle text" size="50" onkeypress="actionListaBuscarOficinaProductoPorCodigoOficinaNombre('divListaBuscarOficinaProducto', this.value, event);">
                <input type="button" class="contenidoMiddle button" value="Ocultar Búsqueda" onclick="ocultarApartadoBuscar();">
            </section>
            <section id="divListaBuscarOficinaProducto" class="anchoCompleto buscarOficinaProducto labelPequenio textoMediano">
                
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
                paginaAjax('divListaBuscarOficinaProducto', {codigoOficina: $('#txtCodigoOficina').val(), codigoBarras: $('#txtCodigoBarras').val()}, '/APPSIVAK/public/oficinaproducto/listabuscaroficinaproductoporcodigobarras', 'POST', 
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

        function cargarListaProductos()
        {
            $('#txtListaProductos').val('');

            $('#bodyTablaProductosAgregados').find('tr').each(function(index, elemento)
            {
                $(elemento).find('td').each(function(index2, elemento2)
                {
                    if(index2==19)
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

        function calcularCantidad(tipoCantidad, codigoOficinaProducto)
        {
            var cantidad;
            if(tipoCantidad=='bloque')
            {
                if($('#cantidadUnidadProductoEnviar'+codigoOficinaProducto).text().trim()=='')
                {
                    $('#cantidadBloqueProductoEnviar'+codigoOficinaProducto).text('0');
                    return;
                }
                cantidad=parseFloat($('#cantidadUnidadProductoEnviar'+codigoOficinaProducto).text())/parseFloat($('#unidadesBloqueProducto'+codigoOficinaProducto).text());
                cantidad=parseFloat($('#unidadesBloqueProducto'+codigoOficinaProducto).text())==0?0:cantidad;
                $('#cantidadBloqueProductoEnviar'+codigoOficinaProducto).text(cantidad);
            }

            if(tipoCantidad=='unidad')
            {
                if(parseFloat($('#unidadesBloqueProducto'+codigoOficinaProducto).text())!=0)
                {
                    if($('#cantidadBloqueProductoEnviar'+codigoOficinaProducto).text().trim()=='')
                    {
                        $('#cantidadUnidadProductoEnviar'+codigoOficinaProducto).text('0');
                        return;
                    }
                    cantidad=parseFloat($('#cantidadBloqueProductoEnviar'+codigoOficinaProducto).text())*parseFloat($('#unidadesBloqueProducto'+codigoOficinaProducto).text());
                    $('#cantidadUnidadProductoEnviar'+codigoOficinaProducto).text(cantidad);
                }
            }
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

                    if(productoExisteLista && index2==11)
                    {
                        $(elemento2).text(parseInt($(elemento2).text())+1);
                        calcularCantidad('bloque', codigoOficinaProducto);
                        return false;
                    }
                });
            });

            if(!productoExisteLista)
            {
                var nuevoProducto=''+
                '<tr class="elementoBuscar">'+
                    '<td style="display: none;">'+codigoOficinaProducto+'</td>'+
                    '<td style="display: none;">'+$('#codigoBarrasOficinaProducto'+codigoOficinaProducto).text().trim().replace('<', '&lt;').replace('>', '&gt;')+'</td>'+
                    '<td>'+$('#primerNombreOficinaProducto'+codigoOficinaProducto).text().trim().replace('<', '&lt;').replace('>', '&gt;')+'</td>'+
                    '<td>'+$('#segundoNombreOficinaProducto'+codigoOficinaProducto).text().trim().replace('<', '&lt;').replace('>', '&gt;')+'</td>'+
                    '<td>'+$('#tercerNombreOficinaProducto'+codigoOficinaProducto).text().trim().replace('<', '&lt;').replace('>', '&gt;')+'</td>'+
                    '<td>'+$('#descripcionOficinaProducto'+codigoOficinaProducto).text().trim().replace('<', '&lt;').replace('>', '&gt;')+'</td>'+
                    '<td>'+$('#tipoOficinaProducto'+codigoOficinaProducto).text().trim()+'</td>'+
                    '<td>'+$('#presentacionOficinaProducto'+codigoOficinaProducto).text().trim()+'</td>'+
                    '<td>'+$('#unidadMedidaOficinaProducto'+codigoOficinaProducto).text().trim()+'</td>'+
                    '<td>'+$('#categoriaOficinaProducto'+codigoOficinaProducto).text().trim()+'</td>'+
                    '<td>'+$('#cantidadOficinaProducto'+codigoOficinaProducto).text().trim()+'</td>'+
                    '<td id="cantidadUnidadProductoEnviar'+codigoOficinaProducto+'" onkeyup=calcularCantidad("bloque",'+codigoOficinaProducto+');cargarListaProductos(); contenteditable=true class="colorCampoEditable textAlignCenter">1</td>'+
                    '<td id="cantidadBloqueProductoEnviar'+codigoOficinaProducto+'" onkeyup=calcularCantidad("unidad",'+codigoOficinaProducto+');cargarListaProductos(); contenteditable=true class="colorCampoEditable textAlignCenter"></td>'+
                    '<td>'+$('#ventaMenorUnidadOficinaProducto'+codigoOficinaProducto).text().trim()+'</td>'+
                    '<td>'+$('#precioCompraUnitarioOficinaProducto'+codigoOficinaProducto).text().trim()+'</td>'+
                    '<td>'+$('#precioVentaUnitarioOficinaProducto'+codigoOficinaProducto).text().trim()+'</td>'+
                    '<td id="unidadesBloqueProducto'+codigoOficinaProducto+'">'+$('#unidadesBloqueOficinaProducto'+codigoOficinaProducto).text().trim()+'</td>'+
                    '<td>'+$('#unidadMedidaBloqueOficinaProducto'+codigoOficinaProducto).text().trim().replace('<', '&lt;').replace('>', '&gt;')+'</td>'+                
                    '<td>'+$('#fechaVencimientoOficinaProducto'+codigoOficinaProducto).text().trim()+'</td>'+
                    '<td><input type="button" value="Eliminar" onclick="eliminarProductoLista(this);"></td>'+
                '</tr>';
                $('#bodyTablaProductosAgregados').prepend(nuevoProducto);

                if(parseFloat($('#unidadesBloqueProducto'+codigoOficinaProducto).text())==0)
                {
                    $('#cantidadBloqueProductoEnviar'+codigoOficinaProducto).attr('contenteditable', false);
                    $('#cantidadBloqueProductoEnviar'+codigoOficinaProducto).removeClass('colorCampoEditable');
                }

                calcularCantidad('bloque', codigoOficinaProducto);

                animacionAlertaMensajeGeneral('Producto agregado a la lista', '#1497CC');
            }

            cargarListaProductos();
        }

        function onClickBtnBuscarOficina()
        {
            var abrirBuscador=true;

            $('#bodyTablaProductosAgregados').find('tr').each(function(index, elemento)
            {
                animacionAlertaMensajeGeneral('Debe quitar los productos de la lista para seleccionar otra oficina de partida', 'red');
                abrirBuscador=false;
                return false;
            });

            if(abrirBuscador)
            {
                $('#divListaBuscarOficinaProducto').html('');

                ocultarDivsBuscar();
                mostrarDivBuscar('divBuscarEnTablaOficina');
                mostrarApartadoBuscar();
            }
        }

    	function ocultarDivsBuscar()
        {
            var css=
            {
                'display': 'none'
            };
            $('#divBuscarEnTablaOficina').css(css);
            $('#divBuscarEnTablaOficinaDos').css(css);
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

        function enviarFrmInsertarProductoTrasladoOficina()
        {
            var mensajeGlobal='';
            
            mensajeGlobal+=(!valVacio($('#txtCodigoOficina').val())?'Debe seleccionar Oficina de partida<br>':'');
            mensajeGlobal+=(!valVacio($('#txtCodigoOficinaDos').val())?'Debe seleccionar Oficina de llegada<br>':'');
            mensajeGlobal+=(!valDosDecimales($('#txtFlete').val())?'El flete debe ser en soles<br>':'');

            if($('#txtCodigoOficina').val()==$('#txtCodigoOficinaDos').val())
            {
                mensajeGlobal+='La oficina de partida no puede ser la misma que la oficina de llegada<br>';
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
                $('#frmInsertarProductoTrasladoOficina').submit();
                return;
            }
            alert('Operación Cancelada');
        }
    </script>
@stop