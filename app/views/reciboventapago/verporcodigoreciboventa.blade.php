<h3 style="text-decoration: underline;">Pagos del crédito</h3>
<section class="anchoCompleto textAlignLeft backGroundColorGrisClaro">
    <button class="button" onclick="borrarElemento('filaDetalle')">Ocultar Detalles</button>
</section>
<section>
    <table class="table buscarEnTablaReciboVentaLetra textoPequenio">
        <thead class="textAlignCenter">
            <th>CÓDIGO DEL PAGO</th>
            <th>MONTO</th>
            <th>DESCRIPCIÓN</th>
            <th>FECHA</th>
            <th></th>
        </thead>
        <tbody class="textAlignCenter">
            @foreach($listaTReciboVentaPago as $item)
                <tr>
                    <td>{{{$item->codigoReciboVentaPago}}}</td>
                    <td>{{{$item->monto}}}</td>
                    <td>{{{$item->descripcion}}}</td>
                    <td>{{{$item->created_at}}}</td>
                    <td><button onclick="window.open('/APPSIVAK/public/reporte/reciboventapago/{{{$item->codigoReciboVentaPago}}}', '_blank');">Imprimir recibo</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <hr>
</section>