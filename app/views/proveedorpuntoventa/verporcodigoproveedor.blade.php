<h3 style="text-decoration: underline;">Puntos de Venta</h3>
<section class="anchoCompleto textAlignLeft backGroundColorGrisClaro">
    <button class="button" onclick="borrarElemento('filaDetalle')">Ocultar Detalles</button>
</section>
<section>
    <table class="table buscarEnTablaProveedorPuntoVenta">
        <thead>
            <th>DESCRIPCIÓN</th>
            <th>PAÍS</th>
            <th>DEPARTAMENTO</th>
            <th>PROVINCIA</th>
            <th>ESTADO</th>
            <th class="widthDetalleTable"></th>
            <th class="widthEditarTable"></th>
        </thead>
        <tbody>
            @foreach($listaTProveedorPuntoVenta as $item) 
                <tr>
                    <td>{{{$item->descripcion}}}</td>
                    <td>{{{$item->pais}}}</td>
                    <td>{{{$item->departamento}}}</td>
                    <td>{{{$item->provincia}}}</td>
                    <td>{{{$item->estado==1?"En Servicio":"Indispuesto"}}}</td>
                    <td><button onclick="paginaAjax('divVerDetalle', {codigo : '{{{$item->codigoProveedorPuntoVenta}}}'}, '/APPSIVAK/public/proveedorpuntoventa/verdetalle', 'POST', function(){$('#divVerDetalle').css({'display' : 'inline-block'});}, null, false, true);">Ver Detalles</button></td>
                    <td><button onclick="dialogoAjax('dialogo', 770, true, 'Datos para editar Punto de Venta', 'top', {codigo : '{{{$item->codigoProveedorPuntoVenta}}}'}, '/APPSIVAK/public/proveedorpuntoventa/editar', 'POST', null, null, false, true);">Editar</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <hr>
</section>