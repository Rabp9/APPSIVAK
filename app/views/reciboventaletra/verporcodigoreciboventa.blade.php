<h3 style="text-decoration: underline;">Letras del crédito</h3>
<section class="anchoCompleto textAlignLeft backGroundColorGrisClaro">
    <button class="button" onclick="borrarElemento('filaDetalle')">Ocultar Detalles</button>
</section>
<section>
    <table class="table buscarEnTablaReciboVentaLetra textoPequenio">
        <thead class="textAlignCenter">
            <th>FECHA A PAGAR</th>
            <th>POR PAGAR</th>
            <th>PAGADO</th>
            <th>DÍAS ATRASADOS</th>
            <th>ESTADO</th>
            <th></th>
        </thead>
        <tbody class="textAlignCenter">
            <?php 
                $mostrarBotonPago=true;
                $porPagarTotalLetras=0;
                $porPagarTotalMora=0;
            ?>

            @foreach($listaTReciboVentaLetra as $item)
                <?php 
                    $diasRetrasados=((strtotime(date('Y-m-d'))-strtotime($item->fechaPagar))/86400)<0 ? '0' : ((strtotime(date('Y-m-d'))-strtotime($item->fechaPagar))/86400);
                    $porPagar=number_format((($item->estado) ? $item->pagado : ($item->porPagar)), 2, '.', '');
                ?>

                @if($item->estado==1)
                    <?php
                        $diasRetrasados=$item->diasMora;
                    ?>
                @endif
                @if($item->estado==0)
                    <?php
                        $porPagarTotalLetras+=$porPagar;
                    ?>
                @endif
                <?php $porPagarTotalMora+=($diasRetrasados-($item->obviarDiasMora))*$tReciboVenta->montoMoraDia; ?>
                <tr {{$diasRetrasados>0 ? 'style="background-color: rgb(238, 121, 121);"' : ''}}>
                    <td>{{{$item->fechaPagar}}}</td>
                    <td class="backGroundColorAzulClaro">{{{$item->porPagar}}}</td>
                    <td style="background-color: green;color: white;">{{{$item->pagado}}}</td>
                    <td>{{{$diasRetrasados}}}</td>
                    <td>{{$item->estado==0 ? 'Por pagar' : 'Pagado... <img src="/APPSIVAK/public/img/check/check.png">'}}</td>
                    <td>
                        @if($item->estado==0 && $mostrarBotonPago)
                            <button onclick="dialogoAjax('dialogo', 450, true, 'Pagar letra', 'top', {codigo : '{{{$item->codigoReciboVentaLetra}}}'}, '/APPSIVAK/public/reciboventaletra/pagarletra', 'POST', null, null, false, true);">Pagar letra</button>
                            <?php $mostrarBotonPago=false; ?>
                        @endif
                    </td>
                </tr>
            @endforeach
            <tr>
                <td class="textAlignRight">Total por pagar:</td>
                <td class="backGroundColorNaranja">{{{$porPagarTotalLetras}}}</td>
                <td></td>
                <td></td>
                <td></td>
                <th></th>
            </tr>
        </tbody>
    </table>
    <hr>
</section>