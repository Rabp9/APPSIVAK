<h2 class="textAlignCenter bordeAbajo">OFICINA</h2>
<section class="anchoCompleto textAlignLeft backGroundColorGrisClaro">
    <label class="contenidoMiddle">Buscar</label>
        <input type="text" class="contenidoMiddle text" size="50" onkeyup="filtrarHtml('tableOficinaBuscar', this.value, false, 200, event);">
        <input type="button" class="contenidoMiddle button" value="Ocultar Búsqueda" onclick="ocultarApartadoBuscar();">
</section>
<section class="anchoCompleto">
    <table id="tableOficinaBuscar" class="table">
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
                    <td id="descripcionOficina{{{$item->codigoOficina}}}">{{{$item->descripcion}}}</td>
                    <td id="paisOficina{{{$item->codigoOficina}}}">{{{$item->pais}}}</td>
                    <td id="departamentoOficina{{{$item->codigoOficina}}}">{{{$item->departamento}}}</td>
                    <td id="provinciaOficina{{{$item->codigoOficina}}}">{{{$item->provincia}}}</td>
                    <td id="estadoOficina{{{$item->codigoOficina}}}">{{{$item->estado==1?"En Servicio":"Indispuesto"}}}</td>
                    <td id="codigoOficina{{{$item->codigoOficina}}}" style="display: none;">{{{$item->codigoOficina}}}</td>
                    <td><button id="btnSeleccionarOficina{{{$item->codigoOficina}}}" class="btnSeleccionarOficina">Seleccionar</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>
<script>
    $('.btnSeleccionarOficina').on('click', function()
    {
        var codigoOficina=this.id.substring(21);

        $('#txtDescripcionOficina').val($('#descripcionOficina'+codigoOficina).text());
        $('#txtCodigoOficina').val($('#codigoOficina'+codigoOficina).text());

        if(typeof onChangeTxtCodigoOficina=='function')
        {
            onChangeTxtCodigoOficina();
        }
        
        ocultarApartadoBuscar();
    });
</script>