<h3 style="text-decoration: underline;">SUB CATEGORÍA</h3>
<section class="anchoCompleto textAlignLeft backGroundColorGrisClaro">
    <button class="button" onclick="borrarElemento('filaDetalle')">Ocultar Detalles</button>
</section>
<section>
    <table class="table buscarEnTablaCategoria">
        <thead>
            <th>NOMBRE</th>
            <th>DESCRIPCIÓN</th>
            <th></th>
        </thead>
        <tbody>
            @foreach($listaTCategoria as $item) 
                <tr>
                    <td>{{{$item->nombre}}}</td>
                    <td>{{{$item->descripcion}}}</td>
                    <td><button onclick="dialogoAjax('dialogo', 450, true, 'Datos para editar Sub Categoría', 'top', {codigo : '{{{$item->codigoCategoria}}}'}, '/APPSIVAK/public/categoria/editar', 'POST', null, null, false, true);">Editar</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <hr>
</section>