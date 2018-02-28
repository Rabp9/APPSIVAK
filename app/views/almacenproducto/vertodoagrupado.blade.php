@extends('layout.layout')

@section('contenidoCuerpo')
    <h2 class="textAlignRight bordeAbajo tituloCabecera">PRODUCTOS DE TODOS LOS ALMACENES</h2>
    <section class="anchoCompleto textAlignLeft backGroundColorGrisClaro">
        <label class="contenidoMiddle">Buscar</label>
        <input type="text" class="contenidoMiddle text" size="50" onkeyup="filtrarHtml('tableAlmacenProducto', this.value, false, 200, event);">
        <input type="button" class="button" value="Sincronizar categorías en todos los locales" onclick="window.location.href='/APPSIVAK/public/almacenproducto/sincronizarcategorias'">
    </section>
    <section>
        <table id="tableAlmacenProducto" class="table textoPequenio">
            <thead>
                <th>CÓDIGO DE BARRAS</th>
                <th>NOMBRE</th>
                <th>DESCRIPCIÓN</th>
                <th>TIPO PRODUCTO</th>
                <th>PRESENTACIÓN</th>
                <th>UNIDAD DE MEDIDA</th>
                <th>VENTA EN DEC.</th>
                <th>UND. POR B.</th>
                <th>UND. DE MED. POR B.</th>
                <th>ESTADO</th>
                <th></th>
                <th></th>
            </thead>
            <tbody id="bodyTablaProductosAgregados">
                @foreach($listaTAlmacenProducto as $item) 
                    <tr class="elementoBuscar" {{!($item->estado) ? 'style="background-color: rgb(238, 121, 121);"' : ''}}>
                        <td>{{{$item->codigoBarras}}}</td>
                        <td>{{{$item->primerNombre}}} / {{{$item->segundoNombre}}} / {{{$item->tercerNombre}}}</td>
                        <td>{{{$item->descripcion}}}</td>
                        <td>{{{$item->tipo}}}</td>
                        <td>{{{$item->tPresentacion->nombre}}}</td>
                        <td>{{{$item->tUnidadMedida->nombre}}}</td>
                        <td>{{{$item->ventaMenorUnidad ? 'Si' : 'No'}}}</td>
                        <td>{{{$item->unidadesBloque}}}</td>
                        <td>{{{$item->unidadMedidaBloque}}}</td>
                        <td>{{{$item->estado ? 'Habilitado' : 'Deshabilitado'}}}</td>
                        <td><button onclick="irAdministrarCategoria('{{{$item->codigoAlmacenProducto}}}');">Administrar Categoría</button></td>
                        <td><button onclick="dialogoAjax('dialogo', 800, true, 'Datos para editar producto', 'top', {nombrePresentacion : '{{{$item->tPresentacion->nombre}}}', nombreUnidadMedida : '{{{$item->tUnidadMedida->nombre}}}', codigoPresentacion : '{{{$item->codigoPresentacion}}}', codigoUnidadMedida : '{{{$item->codigoUnidadMedida}}}', codigoBarras : '{{{$item->codigoBarras}}}', primerNombre : '{{{$item->primerNombre}}}', segundoNombre : '{{{$item->segundoNombre}}}', tercerNombre : '{{{$item->tercerNombre}}}', tipo : '{{{$item->tipo}}}', ventaMenorUnidad : '{{{$item->ventaMenorUnidad}}}', unidadesBloque : '{{{$item->unidadesBloque}}}', unidadMedidaBloque : '{{{$item->unidadMedidaBloque}}}', estado : '{{{$item->estado}}}'}, '/APPSIVAK/public/almacenproducto/editartodoslocales', 'POST', null, null, false, true);">Editar</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
    
    <script>
        function irAdministrarCategoria(codigoAlmacenProducto)
        {
            window.location.href='/APPSIVAK/public/almacenproducto/administrarcategoria/'+codigoAlmacenProducto;
        }
    </script>
@stop