<form id="frmEditarAlmacen" action="/APPSIVAK/public/almacen/editar" method="post" class="formulario labelMediano textAlignCenter">
    <div class="contenidoTop textAlignLeft">
        <input type="hidden" id="txtCodigoAlmacen" name="txtCodigoAlmacen" value="{{{$tAlmacen->codigoAlmacen}}}">
        <label for="txtDescripcion">Descripción</label>
        <input type="text" id="txtDescripcion" name="txtDescripcion" size="50" placeholder="Obligatorio" value="{{{$tAlmacen->descripcion}}}">
        <br>
        <label for="txtPais">País</label>
        <input type="text" id="txtPais" name="txtPais" size="50" placeholder="Obligatorio" value="{{{$tAlmacen->pais}}}">
        <br>
        <label for="txtDepartamento">Departamento</label>
        <input type="text" id="txtDepartamento" name="txtDepartamento" size="50" placeholder="Obligatorio" value="{{{$tAlmacen->departamento}}}">
        <br>
        <label for="txtProvincia">Provincia</label>
        <input type="text" id="txtProvincia" name="txtProvincia" size="50" placeholder="Obligatorio" value="{{{$tAlmacen->provincia}}}">
        <br>
        <label for="txtDistrito">Distrito</label>
        <input type="text" id="txtDistrito" name="txtDistrito" size="50" placeholder="Obligatorio" value="{{{$tAlmacen->distrito}}}">
        <br>
        <label for="txtDireccion">Direción</label>
        <input type="text" id="txtDireccion" name="txtDireccion" size="50" placeholder="Obligatorio" value="{{{$tAlmacen->direccion}}}">
        <br>
        <label for="txtManzana">Manzana</label>
        <input type="text" id="txtManzana" name="txtManzana" size="50" value="{{{$tAlmacen->manzana}}}">
        <br>
        <label for="txtLote">Lote</label>
        <input type="text" id="txtLote" name="txtLote" size="50" value="{{{$tAlmacen->lote}}}">
        <br>
        <label for="txtNumeroVivienda">Nº Vivienda</label>
        <input type="text" id="txtNumeroVivienda" name="txtNumeroVivienda" size="50" value="{{{$tAlmacen->numeroVivienda}}}">
        <br>
        <label for="txtNumeroInterior">Nº Interior</label>
        <input type="text" id="txtNumeroInterior" name="txtNumeroInterior" size="50" value="{{{$tAlmacen->numeroInterior}}}">
        <br>
        <label for="txtTelefono">Teléfono</label>
        <input type="text" id="txtTelefono" name="txtTelefono" size="50" value="{{{$tAlmacen->telefono}}}">
        <br>
        <label for="txtFechaCreacion">Fecha de Constitución</label>
        <input type="date" id="txtFechaCreacion" name="txtFechaCreacion" value="{{{$tAlmacen->fechaCreacion}}}">
        <br>
        <label for="cbxEstado">Estado</label>
        <select name="cbxEstado" id="cbxEstado" style="width: 191px;">
            <option value="1" {{{$tAlmacen->estado ? 'selected' : ''}}}>En Servicio</option>
            <option value="0" {{{!$tAlmacen->estado ? 'selected' : ''}}}>Indispuesto</option>
        </select>
    </div>
    <div class="seccionBotones bordeArriba">
        <input type="button" value="Guardar cambios" onclick="enviarFrmEditarAlmacen();">
    </div>
</form>
<script>
    function enviarFrmEditarAlmacen()
    {
        var mensajeGlobal='';
         
        mensajeGlobal+=(!valVacio($('#txtDescripcion').val())?'Complete el campo de Descripción<br>':'');
        mensajeGlobal+=(!valVacio($('#txtPais').val())?'Complete el campo de País<br>':'');
        mensajeGlobal+=(!valVacio($('#txtDepartamento').val())?'Complete el campo de Departamento<br>':'');
        mensajeGlobal+=(!valVacio($('#txtProvincia').val())?'Complete el campo de Provincia<br>':'');
        mensajeGlobal+=(!valVacio($('#txtDistrito').val())?'Complete el campo de Distrito<br>':'');
        mensajeGlobal+=(!valVacio($('#txtDireccion').val())?'Complete el campo de Direción<br>':'');
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

        if(confirm('Realmente desea editar el Almacén'))
        {        
            $('#frmEditarAlmacen').submit();
            return;
        }
        alert('Operación Cancelada');
    }
</script>