<hr>
<input type="button" class="anchoCompleto button" style="margin: 0px;" value="Cerrar detalle" onclick="cerrarDivVerDetalla();">
<hr>
<section class="contenidoTop">
    <div class="formulario labelMediano textAlignLeft">
        <div class="contenidoTop">
            <label><b>Descripción</b></label>
            {{{$tAlmacen->descripcion}}}
            <br>
            <label><b>País</b></label>
            {{{$tAlmacen->pais}}}
            <br>
            <label><b>Departamento</b></label>
            {{{$tAlmacen->departamento}}}
            <br>
            <label><b>Provincia</b></label>
            {{{$tAlmacen->provincia}}}
            <br>
            <label><b>Distrito</b></label>
            {{{$tAlmacen->distrito}}}
            <br>
            <label><b>Direción</b></label>
            {{{$tAlmacen->direccion}}}
            <br>
            <label><b>Manzana</b></label>
            {{{$tAlmacen->manzana}}}
            <br>
            <label><b>Lote</b></label>
            {{{$tAlmacen->lote}}}
            <br>
            <label><b>Nº Vivienda</b></label>
            {{{$tAlmacen->numeroVivienda}}}
            <br>
            <label><b>Nº Interior</b></label>
            {{{$tAlmacen->numeroInterior}}}
            <br>
            <label><b>Teléfono</b></label>
            {{{$tAlmacen->telefono}}}
            <br>
            <label><b>Fecha de Constitución</b></label>
            {{{$tAlmacen->fechaCreacion}}}
            <br>
            <label><b>Fecha de Registro</b></label>
            {{{$tAlmacen->created_at}}}
            <br>
            <label><b>Estado</b></label>
            {{{$tAlmacen->estado==1 ? 'En Servicio' : 'Indispuesto'}}}
        </div>
    </div>
</section>