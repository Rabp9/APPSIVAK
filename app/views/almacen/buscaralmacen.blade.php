<h2 class="textAlignCenter bordeAbajo">ALMACÉN</h2>
<section class="anchoCompleto textAlignLeft backGroundColorGrisClaro">
    <label class="contenidoMiddle">Buscar</label>
        <input type="text" class="contenidoMiddle text" size="50" onkeyup="filtrarHtml('tableAlmacenBuscar', this.value, false, 200, event);">
        <input type="button" class="contenidoMiddle button" value="Ocultar Búsqueda" onclick="ocultarApartadoBuscar();">
</section>
<section class="anchoCompleto">
    <table id="tableAlmacenBuscar" class="table">
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
            @foreach($listaTAlmacen as $item) 
                <tr class="elementoBuscar">
                    <td id="descripcionAlmacen{{{$item->codigoAlmacen}}}">{{{$item->descripcion}}}</td>
                    <td id="paisAlmacen{{{$item->codigoAlmacen}}}">{{{$item->pais}}}</td>
                    <td id="departamentoAlmacen{{{$item->codigoAlmacen}}}">{{{$item->departamento}}}</td>
                    <td id="provinciaAlmacen{{{$item->codigoAlmacen}}}">{{{$item->provincia}}}</td>
                    <td id="estadoAlmacen{{{$item->codigoAlmacen}}}">{{{$item->estado==1?"En Servicio":"Indispuesto"}}}</td>
                    <td id="codigoAlmacen{{{$item->codigoAlmacen}}}" style="display: none;">{{{$item->codigoAlmacen}}}</td>
                    <td><button id="btnSeleccionarAlmacen{{{$item->codigoAlmacen}}}" class="btnSeleccionarAlmacen">Seleccionar</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>
<script>
    $('.btnSeleccionarAlmacen').on('click', function()
    {
        var codigoAlmacen=this.id.substring(21);

        $('#txtDescripcionAlmacen').val($('#descripcionAlmacen'+codigoAlmacen).text());
        $('#txtCodigoAlmacen').val($('#codigoAlmacen'+codigoAlmacen).text());

        if(typeof onChangeTxtCodigoAlmacen=='function')
        {
            onChangeTxtCodigoAlmacen();
        }
        
        ocultarApartadoBuscar();
    });
</script>