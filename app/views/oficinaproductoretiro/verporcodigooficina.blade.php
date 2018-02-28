@extends('layout.layout')

@section('contenidoCuerpo')
    @if(Session::get('localAcceso')!='Oficina')
        <div class="alertaMensajeError">
            Ud. debe estar logueado en una oficina para ver estos datos
        </div>
    @endif
    @if(Session::get('localAcceso')=='Oficina')
        <h2 class="textAlignRight bordeAbajo tituloCabecera">PRODUCTOS RETIRADOS DE ESTA OFICINA</h2>
        <section class="anchoCompleto textAlignLeft backGroundColorGrisClaro">
            <label class="contenidoMiddle">Buscar</label>
            <input type="text" class="contenidoMiddle text" size="50" onkeyup="filtrarHtml('tableOficinaProductoRetiro', this.value, false, 200, event);">
        </section>
        <section>
            <table id="tableOficinaProductoRetiro" class="table textoPequenio">
                <thead class="textAlignCenter">
                    <th class="textAlignLeft">NOMBRE COMPLETO</th>
                    <th>TIPO</th>
                    <th>PRESENTACIÓN</th>
                    <th>UNIDAD DE MEDIDA</th>
                    <th>PREC. DE C. U.</th>
                    <th>PREC. DE V. U.</th>
                    <th>VENCIMIENTO</th>
                    <th>CANTIDAD RETIRADA</th>
                    <th>DESCRIPCIÓN DEL RETIRO</th>
                    <th>MONTO PERDIDO</th>
                    <th>FECHA DE RETIRO</th>
                </thead>
                <tbody>
                    @foreach($listaTOficinaProductoRetiro as $item) 
                        <tr class="elementoBuscar textAlignCenter">
                            <td class="textAlignLeft">{{{$item->nombreCompletoProducto}}}</td>
                            <td>{{{$item->tipoProducto}}}</td>
                            <td>{{{$item->presentacionProducto}}}</td>
                            <td>{{{$item->unidadMedidaProducto}}}</td>
                            <td>{{{$item->precioCompraUnitarioProducto}}}</td>
                            <td>{{{$item->precioVentaUnitarioProducto}}}</td>
                            <td>{{{$item->fechaVencimientoProducto}}}</td>
                            <td>{{{$item->cantidadUnidad}}}</td>
                            <td>{{{$item->descripcion}}}</td>
                            <td>{{{$item->montoPerdido}}}</td>
                            <td>{{{$item->created_at}}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    @endif
@stop