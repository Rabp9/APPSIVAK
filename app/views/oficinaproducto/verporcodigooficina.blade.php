@extends('layout.layout')

@section('contenidoCuerpo')
     @if(Session::get('localAcceso')!='Oficina')
        <div class="alertaMensajeError">
            Ud. debe estar logueado en una oficina para ver estos datos
        </div>
    @endif
    @if(Session::get('localAcceso')=='Oficina')
        <h2 class="textAlignRight bordeAbajo tituloCabecera">PRODUCTOS DE ESTA OFICINA</h2>
        <section class="anchoCompleto textAlignLeft backGroundColorGrisClaro">
            <label class="contenidoMiddle">Buscar</label>
            <input type="text" class="contenidoMiddle text" size="50" onkeyup="filtrarHtml('tableOficinaProducto', this.value, false, 200, event);">
        </section>
        <section>
            <table id="tableOficinaProducto" class="table textoPequenio">
                <thead class="textAlignCenter">
                    <th>CÓDIGO DE BARRAS</th>
                    <th class="textAlignLeft">NOMBRE COMPLETO</th>
                    <th class="textAlignLeft">DESCRIPCIÓN</th>
                    <th>TIPO</th>
                    <th>PRESENTACIÓN</th>
                    <th>UNIDAD DE MEDIDA</th>
                    <th>CANT.</th>
                    <th>CATEGORÍA</th>
                    <th>VENTA EN DEC.</th>
                    <th>UND. POR B.</th>
                    <th>UND. DE MED. POR B.</th>
                    <th>PREC. DE C. U.</th>
                    <th>PREC. DE V. U.</th>
                    <th>VENCIMIENTO</th>
                    <th>ESTADO</th>
                </thead>
                <tbody>
                    @foreach($listaTOficinaProducto as $item) 
                        <tr class="elementoBuscar textAlignCenter" {{!($item->estado) ? 'style="background-color: rgb(238, 121, 121);"' : ''}}>
                            <td>{{{$item->codigoBarras}}}</td>
                            <td class="textAlignLeft">{{{$item->primerNombre.' / '.$item->segundoNombre.' / '.$item->tercerNombre}}}</td>
                            <td class="textAlignLeft">{{{$item->descripcion}}}</td>
                            <td>{{{$item->tipo}}}</td>
                            <td>{{{$item->presentacion}}}</td>
                            <td>{{{$item->unidadMedida}}}</td>
                            <td>{{{$item->cantidad}}}</td>
                            <td>{{{$item->categoria}}}</td>
                            <td>{{{$item->ventaMenorUnidad ? 'Si' : 'No'}}}</td>
                            <td>{{{$item->unidadesBloque}}}</td>
                            <td>{{{$item->unidadMedidaBloque}}}</td>
                            <td>{{{$item->precioCompraUnitario}}}</td>
                            <td>{{{$item->precioVentaUnitario}}}</td>
                            <td>{{{$item->fechaVencimiento}}}</td>
                            <td>{{{$item->estado ? 'Habilitado' : 'Deshabilitado'}}}</td>
                            <td><button onclick="dialogoAjax('dialogo', 800, true, 'Datos para editar producto', 'top', {codigo : '{{{$item->codigoOficinaProducto}}}'}, '/APPSIVAK/public/oficinaproducto/editar', 'POST', null, null, false, true);">Editar</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    @endif    
@stop