<h3 style="text-decoration: underline;">Productos que ofrece</h3>
<section class="anchoCompleto textAlignLeft backGroundColorGrisClaro">
    <button class="button" onclick="borrarElemento('filaDetalle')">Ocultar Detalles</button>
</section>
<section>
    <table class="table buscarEnTablaProveedorProducto">
        <thead>
            <th>NOMBRE</th>
            <th>DESCRIPCIÓN</th>
            <th class="widthEditarTable"></th>
        </thead>
        <tbody>
            @foreach($listaTProveedorProducto as $item) 
                <tr>
                    <td>{{{$item->nombre}}}</td>
                    <td>{{{$item->descripcion}}}</td>
                    <td><button onclick="dialogoAjax('dialogo', 800, true, 'Datos para editar Producto del Proveedor', 'top', {codigo : '{{{$item->codigoProveedorProducto}}}'}, '/APPSIVAK/public/proveedorproducto/editar', 'POST', null, null, false, true);">Editar</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <hr>
</section>