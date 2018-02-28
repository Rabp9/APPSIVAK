<hr>
<input type="button" class="anchoCompleto button" style="margin: 0px;" value="Cerrar detalle" onclick="cerrarDivVerDetalla();">
<hr>
<section class="contenidoTop">
    <div class="formulario labelMediano textAlignLeft">
        <div class="contenidoTop">
            <label><b>Descripción</b></label>
            {{{$tProveedorPuntoVenta->descripcion}}}
            <br>
            <label><b>País</b></label>
            {{{$tProveedorPuntoVenta->pais}}}
            <br>
            <label><b>Departamento</b></label>
            {{{$tProveedorPuntoVenta->departamento}}}
            <br>
            <label><b>Provincia</b></label>
            {{{$tProveedorPuntoVenta->provincia}}}
            <br>
            <label><b>Distrito</b></label>
            {{{$tProveedorPuntoVenta->distrito}}}
            <br>
            <label><b>Direción</b></label>
            {{{$tProveedorPuntoVenta->direccion}}}
            <br>
            <label><b>Manzana</b></label>
            {{{$tProveedorPuntoVenta->manzana}}}
            <br>
            <label><b>Lote</b></label>
            {{{$tProveedorPuntoVenta->lote}}}
            <br>
            <label><b>Nº Vivienda</b></label>
            {{{$tProveedorPuntoVenta->numeroVivienda}}}
            <br>
            <label><b>Nº Interior</b></label>
            {{{$tProveedorPuntoVenta->numeroInterior}}}
            <br>
            <label><b>Teléfono</b></label>
            {{{$tProveedorPuntoVenta->telefono}}}
            <br>
            <label><b>Correo</b></label>
            {{{$tProveedorPuntoVenta->correo}}}
            <br>
            <label><b>Página Web</b></label>
            {{{$tProveedorPuntoVenta->paginaWeb}}}
            <br>
            <label><b>Estado</b></label>
            {{{$tProveedorPuntoVenta->estado==1 ? 'En Servicio' : 'Indispuesto'}}}
        </div>
    </div>
</section>