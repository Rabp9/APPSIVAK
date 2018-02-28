<section class="anchoCompleto">
    <table class="table buscarEnTablaClienteJuridico">
        <thead>
            <th>RUC</th>
            <th>RAZÓN SOCIAL CORTA</th>
            <th>RAZÓN SOCIAL LARGA</th>
            <th>FECHA CONSTITUCIÓN</th>
            <th>PAÍS</th>
            <th>DIRECCIÓN</th>
            <th style="display: none;"></th>
            <th></th>
        </thead>
        <tbody>
            @foreach($listaTClienteJuridico as $item) 
                <tr class="elementoBuscar">
                    <td id="rucClienteJuridico{{{$item->codigoClienteJuridico}}}">{{{$item->ruc}}}</td>
                    <td id="razonSocialCortaClienteJuridico{{{$item->codigoClienteJuridico}}}">{{{$item->razonSocialCorta}}}</td>
                    <td id="razonSocialLargaClienteJuridico{{{$item->codigoClienteJuridico}}}">{{{$item->razonSocialLarga}}}</td>
                    <td id="fechaConstitucionClienteJuridico{{{$item->codigoClienteJuridico}}}">{{{$item->fechaConstitucion}}}</td>
                    <td id="paisClienteJuridico{{{$item->codigoClienteJuridico}}}">{{{$item->pais}}}</td>
                    <td id="direccionClienteJuridico{{{$item->codigoClienteJuridico}}}">{{{$item->direccion}}}</td>
                    <td id="codigoClienteJuridico{{{$item->codigoClienteJuridico}}}" style="display: none;">{{{$item->codigoClienteJuridico}}}</td>
                    <td><button id="btnSeleccionarClienteJuridico{{{$item->codigoClienteJuridico}}}" class="btnSeleccionarClienteJuridico">Seleccionar</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>