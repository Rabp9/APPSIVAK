<h3 style="text-decoration: underline;">Pagos realizados de la compra</h3>
<section class="anchoCompleto textAlignLeft backGroundColorGrisClaro">
    <button class="button" onclick="borrarElemento('filaDetalle')">Ocultar Detalles</button>
</section>
<section>
    <table class="table buscarEnTablaReciboVentaLetra textoPequenio">
        <thead class="textAlignCenter">
            <th>DESCRIPCIÓN DEL PAGO</th>
            <th>MONTO PAGADO</th>
            <th>FECHA DEL PAGO</th>
        </thead>
        <tbody class="textAlignCenter">
            <?php $porPagarTotal=0; ?>

            @foreach($listaTReciboCompraPago as $item)
                <?php $porPagarTotal+=($item->monto); ?>
                <tr>
                    <td>{{{$item->descripcion}}}</td>
                    <td>{{{$item->monto}}}</td>
                    <td>{{{$item->created_at}}}</td>
                </tr>
            @endforeach

            <?php $porPagarTotal=($tReciboCompra->total)-$porPagarTotal; ?>
            <tr>
                <td class="backGroundColorVerde textAlignRight">Total por pagar</td>
                <td class="backGroundColorNaranja">{{{$porPagarTotal}}}</td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <hr>
</section>