<section class="anchoCompleto">
    <table class="table buscarEnTablaClienteNatural">
        <thead>
            <th>DNI</th>
            <th>NOMBRE</th>
            <th>APELLIDO PATERNO</th>
            <th>APELLIDO MATERNO</th>
            <th>PAÍS</th>
            <th>DIRECCIÓN</th>
            <th style="display: none;"></th>
            <th></th>
        </thead>
        <tbody>
            @foreach($listaTClienteNatural as $item) 
                <tr class="elementoBuscar">
                    <td id="dniClienteNatural{{{$item->codigoClienteNatural}}}">{{{$item->dni}}}</td>
                    <td id="nombreClienteNatural{{{$item->codigoClienteNatural}}}">{{{$item->nombre}}}</td>
                    <td id="apellidoPaternoClienteNatural{{{$item->codigoClienteNatural}}}">{{{$item->apellidoPaterno}}}</td>
                    <td id="apellidoMaternoClienteNatural{{{$item->codigoClienteNatural}}}">{{{$item->apellidoMaterno}}}</td>
                    <td id="paisClienteNatural{{{$item->codigoClienteNatural}}}">{{{$item->pais}}}</td>
                    <td id="direccionClienteNatural{{{$item->codigoClienteNatural}}}">{{{$item->direccion}}}</td>
                    <td id="codigoClienteNatural{{{$item->codigoClienteNatural}}}" style="display: none;">{{{$item->codigoClienteNatural}}}</td>
                    <td><button id="btnSeleccionarClienteNatural{{{$item->codigoClienteNatural}}}" class="btnSeleccionarClienteNatural">Seleccionar</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>