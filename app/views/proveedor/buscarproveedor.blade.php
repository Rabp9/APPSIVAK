<h2 class="textAlignCenter bordeAbajo">PROVEEDOR</h2>
<section class="anchoCompleto textAlignLeft backGroundColorGrisClaro">
    <label class="contenidoMiddle">Buscar</label>
        <input type="text" class="contenidoMiddle text" size="50" onkeyup="filtrarHtml('tableProveedorBuscar', this.value, false, 200, event);">
        <input type="button" class="contenidoMiddle button" value="Ocultar Búsqueda" onclick="ocultarApartadoBuscar();">
</section>
<section class="anchoCompleto">
    <table id="tableProveedorBuscar" class="table">
        <thead>
            <th>DOCUMENTO DE IDENTIDAD</th>
            <th>DESCRIPIÓN</th>
            <th style="display: none;"></th>
            <th></th>
        </thead>
        <tbody>
            @foreach($listaTProveedor as $item) 
                <tr class="elementoBuscar">
                    <td id="documentoIdentidadProveedor{{{$item->codigoProveedor}}}">{{{$item->documentoIdentidad}}}</td>
                    <td id="nombreProveedor{{{$item->codigoProveedor}}}">{{{$item->nombre}}}</td>
                    <td id="codigoProveedor{{{$item->codigoProveedor}}}" style="display: none;">{{{$item->codigoProveedor}}}</td>
                    <td><button id="btnSeleccionarProveedor{{{$item->codigoProveedor}}}" class="btnSeleccionarProveedor">Seleccionar</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>
<script>
    $('.btnSeleccionarProveedor').on('click', function()
    {
        var codigoProveedor=this.id.substring(23);

        $('#txtNombreProveedor').val($('#nombreProveedor'+codigoProveedor).text());
        $('#txtCodigoProveedor').val($('#codigoProveedor'+codigoProveedor).text());
        
        ocultarApartadoBuscar();
    });
</script>