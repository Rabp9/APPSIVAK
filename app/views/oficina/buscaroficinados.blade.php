<h2 class="textAlignCenter bordeAbajo">OFICINA</h2>
<section class="anchoCompleto textAlignLeft backGroundColorGrisClaro">
    <label class="contenidoMiddle">Buscar</label>
        <input type="text" class="contenidoMiddle text" size="50" onkeyup="filtrarHtml('tableOficinaBuscarDos', this.value, false, 200, event);">
        <input type="button" class="contenidoMiddle button" value="Ocultar Búsqueda" onclick="ocultarApartadoBuscar();">
</section>
<section class="anchoCompleto">
    <table id="tableOficinaBuscarDos" class="table">
        <thead>
            <th>DESCRIPCIÓN</th>
            <th>PAÍS</th>
            <th>DEPARTAMENTO</th>
            <th>PROVINCIA</th>
            <th>ESTADO</th>
            <th style="display: none;"></th>
            <th></th>
        </thead>
        <tbody>
            @foreach($listaTOficina as $item) 
                <tr class="elementoBuscar">
                    <td id="descripcionOficinaDos{{{$item->codigoOficina}}}">{{{$item->descripcion}}}</td>
                    <td id="paisOficinaDos{{{$item->codigoOficina}}}">{{{$item->pais}}}</td>
                    <td id="departamentoOficinaDos{{{$item->codigoOficina}}}">{{{$item->departamento}}}</td>
                    <td id="provinciaOficinaDos{{{$item->codigoOficina}}}">{{{$item->provincia}}}</td>
                    <td id="estadoOficinaDos{{{$item->codigoOficina}}}">{{{$item->estado==1?"En Servicio":"Indispuesto"}}}</td>
                    <td id="codigoOficinaDos{{{$item->codigoOficina}}}" style="display: none;">{{{$item->codigoOficina}}}</td>
                    <td><button id="btnSeleccionarOficinaDos{{{$item->codigoOficina}}}" class="btnSeleccionarOficinaDos">Seleccionar</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>
<script>
    $('.btnSeleccionarOficinaDos').on('click', function()
    {
        var codigoOficina=this.id.substring(24);

        $('#txtDescripcionOficinaDos').val($('#descripcionOficinaDos'+codigoOficina).text());
        $('#txtCodigoOficinaDos').val($('#codigoOficinaDos'+codigoOficina).text());
        
        ocultarApartadoBuscar();
    });
</script>