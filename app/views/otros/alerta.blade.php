@extends('layout.layout')

@section('contenidoCuerpo')
    <h2 class="textAlignCenter bordeAbajo tituloCabecera">ALERTAS</h2>
    <section>
        <div id="acordion">
            <h3>PRODUCTOS POR VENCERCE DE TIENDA/ALMACÉN</h3>
            <div>
                @if(count($listaTOficinaProductoPorVencerse)>0)
                    <table class="table textoPequenio">
                        <thead>
                            <th>OFICINA</th>
                            <th>PRESENTACIÓN</th>
                            <th>UNIDAD DE MEDIDA</th>
                            <th>NOMBRE</th>
                            <th>DESCRIPCIÓN</th>
                            <th>TIPO</th>
                            <th>CANTIDAD</th>
                            <th>FECHA DE VENCIMIENTO</th>
                        </thead>
                        <tbody id="bodyTablaProductosAgregados">
                            @foreach($listaTOficinaProductoPorVencerse as $item) 
                                <tr>
                                    <td>{{{$item->tOficina->descripcion}}}</td>
                                    <td>{{{$item->presentacion}}}</td>
                                    <td>{{{$item->unidadMedida}}}</td>
                                    <td>{{{$item->primerNombre.' / '.$item->segundoNombre.' / '.$item->tercerNombre}}}</td>
                                    <td>{{{$item->descripcion}}}</td>
                                    <td>{{{$item->tipo}}}</td>
                                    <td>{{{$item->cantidad}}}</td>
                                    <td>{{{$item->fechaVencimiento}}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>
                        No existen alertas
                    </p>
                @endif
            </div>
            <h3>PRODUCTOS AGOTADOS Y POR AGOTARSE EN TIENDA</h3>
            <div>
                @if(count($listaTOficinaProductoStockReducido)>0)
                    <table class="table textoMediano textAlignCenter">
                        <thead>
                            <th>OFICINA</th>
                            <th>PRESENTACIÓN</th>
                            <th>UNIDAD DE MEDIDA</th>
                            <th>NOMBRE</th>
                            <th>DESCRIPCIÓN</th>
                            <th>TIPO</th>
                            <th>CANTIDAD</th>
                            <th>FECHA DE VENCIMIENTO</th>
                        </thead>
                        <tbody id="bodyTablaProductosAgregados">
                            @foreach($listaTOficinaProductoStockReducido as $item) 
                                <tr>
                                    <td>{{{$item->tOficina->descripcion}}}</td>
                                    <td>{{{$item->presentacion}}}</td>
                                    <td>{{{$item->unidadMedida}}}</td>
                                    <td>{{{$item->primerNombre.' / '.$item->segundoNombre.' / '.$item->tercerNombre}}}</td>
                                    <td>{{{$item->descripcion}}}</td>
                                    <td>{{{$item->tipo}}}</td>
                                    <td>{{{$item->cantidad}}}</td>
                                    <td>{{{$item->fechaVencimiento}}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>
                        No existen alertas
                    </p>
                @endif
            </div>
            <h3>PRODUCTOS AGOTADOS Y POR AGOTARSE EN ALMACÉN</h3>
            <div>
                @if(count($listaTAlmacenProductoStockReducido)>0)
                    <table class="table textoMediano textAlignCenter">
                        <thead>
                            <th>ALMACÉN</th>
                            <th>PRESENTACIÓN</th>
                            <th>UNIDAD DE MEDIDA</th>
                            <th>NOMBRE</th>
                            <th>DESCRIPCIÓN</th>
                            <th>TIPO</th>
                            <th>CANTIDAD</th>
                            <th>FECHA DE VENCIMIENTO</th>
                        </thead>
                        <tbody id="bodyTablaProductosAgregados">
                            @foreach($listaTAlmacenProductoStockReducido as $item) 
                                <tr>
                                    <td>{{{$item->tAlmacen->descripcion}}}</td>
                                    <td>{{{$item->tPresentacion->nombre}}}</td>
                                    <td>{{{$item->tUnidadMedida->nombre}}}</td>
                                    <td>{{{$item->primerNombre.' / '.$item->segundoNombre.' / '.$item->tercerNombre}}}</td>
                                    <td>{{{$item->descripcion}}}</td>
                                    <td>{{{$item->tipo}}}</td>
                                    <td>{{{$item->cantidad}}}</td>
                                    <td>{{{$item->fechaVencimiento}}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>
                        No existen alertas
                    </p>
                @endif
            </div>
            <h3>VENTA DE PRODUCTOS POR COBRAR</h3>
            <div>
                @if(count($listaTReciboVentaPorCobrar)>0)
                    <table class="table textoPequenio textAlignCenter">
                        <thead>
                            <th>OFICINA</th>
                            <th>CLIENTE</th>
                            <th>DIRECCIÓN DEL CLIENTE</th>
                            <th>ESTADO DE LA ENTREGA</th>
                            <th>MONTO DE VENTA</th>
                            <th>POR COBRAR</th>
                        </thead>
                        <tbody id="bodyTablaProductosAgregados">
                            @foreach($listaTReciboVentaPorCobrar as $item)
                                <?php $porPagar=0; ?>

                                @foreach($item->tReciboVentaLetra as $value)
                                    <?php
                                        if(!($value->estado))
                                        {
                                            $porPagar+=(($value->porPagar)+($value->porPagar*$value->diasMora));
                                        }
                                    ?>
                                @endforeach
                                <tr>
                                    <td>{{{$item->tOficina->descripcion}}}</td>
                                    <td>{{{$item->nombreCompletoCliente}}}</td>
                                    <td>{{{$item->direccionCliente}}}</td>
                                    <td>{{{($item->estadoEntrega) ? 'Entregado' : 'Por entregar'}}}</td>
                                    <td>{{{$item->total}}}</td>
                                    <td>{{{$porPagar}}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>
                        No existen alertas
                    </p>
                @endif
            </div>
            <h3>COMPRA DE PRODUCTOS POR PAGAR</h3>
            <div>
                @if(count($listaTReciboCompraPorPagar)>0)
                    <table class="table textoPequenio textAlignCenter">
                        <thead>
                            <th>PROVEEDOR</th>
                            <th>OFICINA</th>
                            <th>FECHA A PAGAR</th>
                            <th>MONTO DE COMPRA</th>
                            <th>POR PAGAR</th>
                        </thead>
                        <tbody id="bodyTablaProductosAgregados">
                            @foreach($listaTReciboCompraPorPagar as $item)
                                <?php $porPagar=0; ?>

                                @foreach($item->tReciboCompraPago as $value)
                                    <?php $porPagar+=$value->monto; ?>
                                @endforeach

                                <?php $porPagar=($item->total)-$porPagar; ?>
                                <tr>
                                    <td>{{{$item->tProveedor->nombre}}}</td>
                                    <td>{{{$item->tAlmacen->descripcion}}}</td>
                                    <td>{{{$item->fechaPagar}}}</td>
                                    <td>{{{$item->total}}}</td>
                                    <td>{{{$porPagar}}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>
                        No existen alertas
                    </p>
                @endif
            </div>
        </div>
    </section>
    <script>
        $(function()
        {
            $('#acordion').accordion(
            {
                collapsible: true,
                active: 4,
                heightStyle: "content"
            });
        });
    </script>
@stop