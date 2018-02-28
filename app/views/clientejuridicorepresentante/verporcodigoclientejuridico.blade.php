<h3 style="text-decoration: underline;">REPRESENTANTE DEL CLIENTE JURÍDICO</h3>
<section class="anchoCompleto textAlignLeft backGroundColorGrisClaro">
    <button class="button" onclick="borrarElemento('filaDetalle')">Ocultar Detalles</button>
</section>
<section>
    <table class="table buscarEnTablaClienteJuridicoRepresentante">
        <thead>
            <th>DNI</th>
            <th>NOMBRE COMPLETO</th>
            <th>CARGO</th>
            <th>CORREO</th>
            <th>DOMICILIO</th>
            <th>FECHA REGISTRO</th>
            <th class="widthEditarTable"></th>
        </thead>
        <tbody>
            @foreach($listaTClienteJuridicoRepresentante as $item) 
                <tr>
                    <td>{{{$item->dni}}}</td>
                    <td>{{{$item->nombreCompleto}}}</td>
                    <td>{{{$item->cargo}}}</td>
                    <td>{{{$item->correo}}}</td>
                    <td>{{{$item->domicilio}}}</td>
                    <td>{{{$item->created_at}}}</td>
                    <td><button onclick="dialogoAjax('dialogo', 800, true, 'Datos para editar Representante', 'top', {codigo : '{{{$item->codigoClienteJuridicoRepresentante}}}'}, '/APPSIVAK/public/clientejuridicorepresentante/editar', 'POST', null, null, false, true);">Editar</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <hr>
</section>