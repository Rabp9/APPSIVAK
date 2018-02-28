<h3 style="text-decoration: underline;">Cajas asignadas</h3>
<section class="anchoCompleto textAlignLeft backGroundColorGrisClaro">
    <button class="button" onclick="borrarElemento('filaDetalle')">Ocultar Detalles</button>
</section>
<section>
    <table class="table buscarEnTablaCajaDetalle">
        <thead>
            <th>PERSONAL</th>
            <th>SALDO INICIAL</th>
            <th>EGRESOS</th>
            <th>INGRESOS</th>
            <th>SALDO FINAL</th>
            <th>DESCRIPCIÓN</th>
            <th>CERRADO</th>
            <th></th>
            <th></th>
            <th></th>
        </thead>
        <tbody>
            @foreach($listaTCajaDetalle as $item)
                @if($item->tPersonal->dni=='XXXXXXXX' && explode(',', Session::get('usuario'))[1]!='Yanapasoft')
                    <?php continue; ?>
                @endif
                <tr>
                    <td>{{{$item->tPersonal->nombre}}} {{{$item->tPersonal->apellidoPaterno}}} {{{$item->tPersonal->apellidoMaterno}}}</td>
                    <td>{{{$item->saldoInicial}}}</td>
                    <td>{{{$item->egresos}}}</td>
                    <td>{{{$item->ingresos}}}</td>
                    <td>{{{$item->saldoFinal}}}</td>
                    <td>{{{$item->descripcion}}}</td>
                    <td>{{{($item->cerrado) ? 'Si' : 'No'}}}</td>
                    <td>
                        @if(!($item->cerrado))
                            <button onclick="dialogoAjax('dialogo', 450, true, 'Datos para incrementar saldo', 'top', {codigo : '{{{$item->codigoCajaDetalle}}}'}, '/APPSIVAK/public/cajadetalle/incrementarsaldoinicial', 'POST', null, null, false, true);">Incrementar saldo inicial</button>
                        @endif
                    </td>
                    <td>
                        @if(!($item->cerrado))
                            <button onclick="dialogoAjax('dialogo', 450, true, 'Confirmar cierre de caja', 'top', {codigo : '{{{$item->codigoCajaDetalle}}}'}, '/APPSIVAK/public/cajadetalle/cerrar', 'POST', null, null, false, true);">Cerrar caja</button>
                        @endif
                    </td>
                    <td>
                        @if($item->cerrado)
                            <button onclick="reabrirCaja({{{$item->codigoCajaDetalle}}})">Reabrir caja</button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <hr>
</section>
<script>
    function reabrirCaja(codigoCajaDetalle)
    {
        if(confirm('¿Realmente desea reabrir caja?'))
        {
            return window.location.href='/APPSIVAK/public/cajadetalle/reabrir/'+codigoCajaDetalle;
        }

        alert('Operación cancelada');
    }
</script>