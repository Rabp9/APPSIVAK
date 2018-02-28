<hr>
<input type="button" class="anchoCompleto button" style="margin: 0px;" value="Cerrar detalle" onclick="cerrarDivVerDetalla();">
<hr>
<section class="contenidoTop">
    <div class="formulario labelMediano textAlignLeft">
        <div class="contenidoTop">
            <label><b>Dni</b></label>
            {{{$tClienteNatural->dni}}}
            <br>
            <label><b>Nombre</b></label>
            {{{$tClienteNatural->nombre}}}
            <br>
            <label><b>Apellido Paterno</b></label>
            {{{$tClienteNatural->apellidoPaterno}}}
            <br>
            <label><b>Apellido Materno</b></label>
            {{{$tClienteNatural->apellidoMaterno}}}
            <br>
            <label><b>País</b></label>
            {{{$tClienteNatural->pais}}}
            <br>
            <label><b>Departamento</b></label>
            {{{$tClienteNatural->departamento}}}
            <br>
            <label><b>Provincia</b></label>
            {{{$tClienteNatural->provincia}}}
            <br>
            <label><b>Distrito</b></label>
            {{{$tClienteNatural->distrito}}}
            <br>
            <label><b>Direción</b></label>
            {{{$tClienteNatural->direccion}}}
            <br>
            <label><b>Manzana</b></label>
            {{{$tClienteNatural->manzana}}}
            <br>
            <label><b>Lote</b></label>
            {{{$tClienteNatural->lote}}}
            <br>
            <label><b>Nº Vivienda</b></label>
            {{{$tClienteNatural->numeroVivienda}}}
            <br>
            <label><b>Nº Interior</b></label>
            {{{$tClienteNatural->numeroInterior}}}
            <br>
            <label><b>Teléfono</b></label>
            {{{$tClienteNatural->telefono}}}
            <br>
            <label><b>Sexo</b></label>
            {{{$tClienteNatural->sexo==0?"Masculino":"Femenino"}}}
            <br>
            <label><b>Correo</b></label>
            {{{$tClienteNatural->correo}}}
            <br>
            <label><b>Fecha de Nacimiento</b></label>
            {{{$tClienteNatural->fechaNacimiento}}}
            <br>
            <label><b>Fecha de Registro</b></label>
            {{{$tClienteNatural->created_at}}}
        </div>
    </div>
</section>