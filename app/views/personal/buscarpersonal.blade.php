<h2 class="textAlignCenter bordeAbajo">PERSONAL</h2>
<section class="anchoCompleto textAlignLeft backGroundColorGrisClaro">
    <label class="contenidoMiddle">Buscar</label>
        <input type="text" class="contenidoMiddle text" size="50" onkeyup="filtrarHtml('tablePersonalBusqueda', this.value, false, 200, event);">
        <input type="button" class="contenidoMiddle button" value="Ocultar Búsqueda" onclick="ocultarApartadoBuscar();">
</section>
<section class="anchoCompleto">
    <table id="tablePersonalBusqueda" class="table">
        <thead>
            <th>DNI</th>
            <th>NOMBRE COMPLETO</th>
            <th>EMPLEADO</th>
            <th>CARGO</th>
            <th style="display: none;"></th>
            <th></th>
        </thead>
        <tbody>
            @foreach($listaTPersonal as $item)
                @if($item->dni=='XXXXXXXX' && explode(',', Session::get('usuario'))[1]!='Yanapasoft')
                    <?php continue; ?>
                @endif
                <tr class="elementoBuscar">
                    <td id="dniPersonal{{{$item->codigoPersonal}}}">{{{$item->dni}}}</td>
                    <td id="nombreCompletoPersonal{{{$item->codigoPersonal}}}">{{{$item->nombre.' '.$item->apellidoPaterno.' '.$item->apellidoMaterno}}}</td>
                    <td id="tipoEmpleadoPersonal{{{$item->codigoPersonal}}}">{{{$item->tipoEmpleado}}}</td>
                    <td id="cargoPersonal{{{$item->codigoPersonal}}}">{{{$item->cargo}}}</td>
                    <td id="codigoPersonal{{{$item->codigoPersonal}}}" style="display: none;">{{{$item->codigoPersonal}}}</td>
                    <td><button id="btnSeleccionarPersonal{{{$item->codigoPersonal}}}" class="btnSeleccionarPersonal">Seleccionar</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>
<script>
    $('.btnSeleccionarPersonal').on('click', function()
    {
        var codigoPersonal=this.id.substring(22);

        $('#txtNombrePersonal').val($('#nombreCompletoPersonal'+codigoPersonal).text());
        $('#txtCodigoPersonal').val($('#codigoPersonal'+codigoPersonal).text());
        
        ocultarApartadoBuscar();
    });
</script>