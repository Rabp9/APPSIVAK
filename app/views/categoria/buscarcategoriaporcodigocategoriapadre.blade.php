<h2 class="textAlignCenter bordeAbajo">CATEGORÍA PADRE</h2>
<section class="anchoCompleto textAlignLeft backGroundColorGrisClaro">
    <label class="contenidoMiddle">Buscar</label>
        <input type="text" class="contenidoMiddle text" size="50" onkeyup="filtrarHtml('tableCategoriaPadreBuscar', this.value, false, 200, event);">
        <input type="button" class="contenidoMiddle button" value="Ocultar Búsqueda" onclick="ocultarApartadoBuscar();">
</section>
<section class="anchoCompleto">
    <table id="tableCategoriaPadreBuscar" class="table">
        <thead>
            <th>NOMBRE</th>
            <th>DESCRIPIÓN</th>
            <th style="display: none;"></th>
            <th></th>
        </thead>
        <tbody>
            @foreach($listaTCategoria as $item) 
                <tr class="elementoBuscar">
                    <td id="nombreCategoria_Padre{{{$item->codigoCategoria}}}">{{{$item->nombre}}}</td>
                    <td id="descripcionCategoria_Padre{{{$item->codigoCategoria}}}">{{{$item->descripcion}}}</td>
                    <td id="codigoCategoria_Padre{{{$item->codigoCategoria}}}" style="display: none;">{{{$item->codigoCategoria}}}</td>
                    <td><button id="btnSeleccionarCategoria_Padre{{{$item->codigoCategoria}}}" class="btnSeleccionarCategoria_Padre">Seleccionar</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>
<script>
    $('.btnSeleccionarCategoria_Padre').on('click', function()
    {
        var codigoCategoria=this.id.substring(29);

        $('#txtNombreCategoria_Padre').val($('#nombreCategoria_Padre'+codigoCategoria).text());
        $('#txtCodigoCategoria_Padre').val($('#codigoCategoria_Padre'+codigoCategoria).text());
        
        ocultarApartadoBuscar();
    });
</script>