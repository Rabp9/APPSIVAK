<hr>
<input type="button" class="anchoCompleto button" style="margin: 0px;" value="Cerrar detalle" onclick="cerrarDivVerDetalla();">
<hr>
<section class="contenidoTop">
    <div class="formulario labelMediano textAlignLeft">
        <div class="contenidoTop">
            <label><b>Ruc</b></label>
            {{{$tClienteJuridico->ruc}}}
            <br>
            <label><b>Razón Social Corta</b></label>
            {{{$tClienteJuridico->razonSocialCorta}}}
            <br>
            <label><b>Razón Social Larga</b></label>
            {{{$tClienteJuridico->razonSocialLarga}}}
            <br>
            <label><b>Reside País</b></label>
            {{{$tClienteJuridico->residePais==1?"Si":"No"}}}
            <br>
            <label><b>Fecha de Constitución</b></label>
            {{{$tClienteJuridico->fechaConstitucion}}}
            <br>
            <label><b>País</b></label>
            {{{$tClienteJuridico->pais}}}
            <br>
            <label><b>Departamento</b></label>
            {{{$tClienteJuridico->departamento}}}
            <br>
            <label><b>Provincia</b></label>
            {{{$tClienteJuridico->provincia}}}
            <br>
            <label><b>Distrito</b></label>
            {{{$tClienteJuridico->distrito}}}
            <br>
            <label><b>Direción</b></label>
            {{{$tClienteJuridico->direccion}}}
            <br>
            <label><b>Manzana</b></label>
            {{{$tClienteJuridico->manzana}}}
            <br>
            <label><b>Lote</b></label>
            {{{$tClienteJuridico->lote}}}
            <br>
            <label><b>Nº Vivienda</b></label>
            {{{$tClienteJuridico->numeroVivienda}}}
            <br>
            <label><b>Nº Interior</b></label>
            {{{$tClienteJuridico->numeroInterior}}}
            <br>
            <label><b>Teléfono</b></label>
            {{{$tClienteJuridico->telefono}}}
            <br>
            <label><b>Correo</b></label>
            {{{$tClienteJuridico->correo}}}
            <br>
            <label><b>Fecha de Registro</b></label>
            {{{$tClienteJuridico->created_at}}}
        </div>
    </div>
</section>