<form id="frmEditarOficina" action="/APPSIVAK/public/oficina/editar" method="post" class="formulario labelMediano textAlignCenter">
    <div class="contenidoTop textAlignLeft">
        <input type="hidden" id="txtCodigoOficina" name="txtCodigoOficina" value="{{{$tOficina->codigoOficina}}}">
        <label for="txtDescripcion">Descripción</label>
        <input type="text" id="txtDescripcion" name="txtDescripcion" size="50" placeholder="Obligatorio" value="{{{$tOficina->descripcion}}}">
        <br>
        <label for="txtPais">País</label>
        <input type="text" id="txtPais" name="txtPais" size="50" placeholder="Obligatorio" value="{{{$tOficina->pais}}}">
        <br>
        <label for="txtDepartamento">Departamento</label>
        <input type="text" id="txtDepartamento" name="txtDepartamento" size="50" placeholder="Obligatorio" value="{{{$tOficina->departamento}}}">
        <br>
        <label for="txtProvincia">Provincia</label>
        <input type="text" id="txtProvincia" name="txtProvincia" size="50" placeholder="Obligatorio" value="{{{$tOficina->provincia}}}">
        <br>
        <label for="txtDistrito">Distrito</label>
        <input type="text" id="txtDistrito" name="txtDistrito" size="50" placeholder="Obligatorio" value="{{{$tOficina->distrito}}}">
        <br>
        <label for="txtDireccion">Direción</label>
        <input type="text" id="txtDireccion" name="txtDireccion" size="50" placeholder="Obligatorio" value="{{{$tOficina->direccion}}}">
        <br>
        <label for="txtManzana">Manzana</label>
        <input type="text" id="txtManzana" name="txtManzana" size="50" value="{{{$tOficina->manzana}}}">
        <br>
        <label for="txtLote">Lote</label>
        <input type="text" id="txtLote" name="txtLote" size="50" value="{{{$tOficina->lote}}}">
        <br>
        <label for="txtNumeroVivienda">Nº Vivienda</label>
        <input type="text" id="txtNumeroVivienda" name="txtNumeroVivienda" size="50" value="{{{$tOficina->numeroVivienda}}}">
        <br>
        <label for="txtNumeroInterior">Nº Interior</label>
        <input type="text" id="txtNumeroInterior" name="txtNumeroInterior" size="50" value="{{{$tOficina->numeroInterior}}}">
        <br>
        <label for="txtTelefono">Teléfono</label>
        <input type="text" id="txtTelefono" name="txtTelefono" size="50" value="{{{$tOficina->telefono}}}">
        <br>
        <label for="txtFechaCreacion">Fecha de Constitución</label>
        <input type="date" id="txtFechaCreacion" name="txtFechaCreacion" value="{{{$tOficina->fechaCreacion}}}">
        <br>
        <label for="cbxEstado">Estado</label>
        <select name="cbxEstado" id="cbxEstado" style="width: 191px;">
            <option value="1" {{{$tOficina->estado ? 'selected' : ''}}}>En Servicio</option>
            <option value="0" {{{!$tOficina->estado ? 'selected' : ''}}}>Indispuesto</option>
        </select>
    </div>
    <div class="seccionBotones bordeArriba">
        <input type="button" value="Guardar cambios" onclick="enviarFrmEditarOficina();">
    </div>
</form>
<script>
    function enviarFrmEditarOficina()
    {
        var mensajeGlobal='';
            
        mensajeGlobal+=(!valVacio($('#txtDescripcion').val())?'Complete el campo descripción<br>':'');
        mensajeGlobal+=(!valVacio($('#txtPais').val())?'Complete el campo País<br>':'');
        mensajeGlobal+=(!valVacio($('#txtDepartamento').val())?'Complete el campo Departamento<br>':'');
        mensajeGlobal+=(!valVacio($('#txtProvincia').val())?'Complete el campo Provincia<br>':'');
        mensajeGlobal+=(!valVacio($('#txtDistrito').val())?'Complete el campo Distrito<br>':'');
        mensajeGlobal+=(!valVacio($('#txtDireccion').val())?'Complete el campo Direción<br>':'');
        mensajeGlobal+=(!valFechaYYYYMMDD($('#txtFechaCreacion').val())?'Fecha de Registro Incorrecto<br>':'');

        if($('#txtDescripcion').val().indexOf(',')!=-1)
        {
            mensajeGlobal+='No se permiten comas (,) en el campo Descripción<br>';
        }

        if(mensajeGlobal!='')
        {
            animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
            return;
        }

        if(confirm('Realmente desea editar la Oficina'))
        {       
            $('#frmEditarOficina').submit();
            return;
        }
        alert('Operación Cancelada');
    }
</script>