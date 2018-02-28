<hr>
<input type="button" class="anchoCompleto button" style="margin: 0px;" value="Cerrar detalle" onclick="cerrarDivVerDetalla();">
<hr>
<section class="contenidoTop">
	<div class="formulario labelMediano textAlignLeft">
		<div class="contenidoTop">
			<label><b>Descripción</b></label>
		    {{{$tOficina->descripcion}}}
		    <br>
		    <label><b>País</b></label>
		    {{{$tOficina->pais}}}
		    <br>
		    <label><b>Departamento</b></label>
		    {{{$tOficina->departamento}}}
		    <br>
		    <label><b>Provincia</b></label>
		    {{{$tOficina->provincia}}}
		    <br>
		    <label><b>Distrito</b></label>
		    {{{$tOficina->distrito}}}
		    <br>
		    <label><b>Direción</b></label>
		    {{{$tOficina->direccion}}}
		    <br>
		    <label><b>Manzana</b></label>
		    {{{$tOficina->manzana}}}
		    <br>
		    <label><b>Lote</b></label>
		    {{{$tOficina->lote}}}
		    <br>
		    <label><b>Nº Vivienda</b></label>
		    {{{$tOficina->numeroVivienda}}}
		    <br>
		    <label><b>Nº Interior</b></label>
		    {{{$tOficina->numeroInterior}}}
		    <br>
		    <label><b>Teléfono</b></label>
		    {{{$tOficina->telefono}}}
		    <br>
		    <label><b>Fecha de Constitución</b></label>
		    {{{$tOficina->fechaCreacion}}}
		    <br>
		    <label><b>Fecha de Registro</b></label>
		    {{{$tOficina->created_at}}}
		    <br>
		    <label><b>Estado</b></label>
		    {{{$tOficina->estado==1 ? 'En servicio' : 'Indispuesto'}}}
		</div>
	</div>
</section>