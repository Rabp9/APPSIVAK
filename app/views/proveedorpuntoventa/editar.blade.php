<form id="frmEditarProveedorPuntoVenta" action="/APPSIVAK/public/proveedorpuntoventa/editar" method="post" class="formulario labelMediano textAlignCenter">
    <div class="contenidoTop textAlignLeft">
        <input type="hidden" id="txtCodigoProveedorPuntoVenta" name="txtCodigoProveedorPuntoVenta" value="{{{$tProveedorPuntoVenta->codigoProveedorPuntoVenta}}}">
        <input type="hidden" id="txtCodigoProveedor" name="txtCodigoProveedor" value="{{{$tProveedorPuntoVenta->codigoProveedor}}}">
        <label for="txtDescripcion">Descripción</label>
        <input type="text" id="txtDescripcion" name="txtDescripcion" size="50" placeholder="Obligatorio" value="{{{$tProveedorPuntoVenta->descripcion}}}">
        <br>
        <label for="txtPais">País</label>
        <input type="text" id="txtPais" name="txtPais" size="50" placeholder="Obligatorio" value="{{{$tProveedorPuntoVenta->pais}}}">
        <br>
        <label for="txtDepartamento">Departamento</label>
        <input type="text" id="txtDepartamento" name="txtDepartamento" size="50" placeholder="Obligatorio" value="{{{$tProveedorPuntoVenta->departamento}}}">
        <br>
        <label for="txtProvincia">Provincia</label>
        <input type="text" id="txtProvincia" name="txtProvincia" size="50" placeholder="Obligatorio" value="{{{$tProveedorPuntoVenta->provincia}}}">
        <br>
        <label for="txtDistrito">Distrito</label>
        <input type="text" id="txtDistrito" name="txtDistrito" size="50" placeholder="Obligatorio" value="{{{$tProveedorPuntoVenta->distrito}}}">
        <br>
        <label for="txtDireccion">Direción</label>
        <input type="text" id="txtDireccion" name="txtDireccion" size="50" placeholder="Obligatorio" value="{{{$tProveedorPuntoVenta->direccion}}}">
        <br>
        <label for="txtManzana">Manzana</label>
        <input type="text" id="txtManzana" name="txtManzana" size="50" value="{{{$tProveedorPuntoVenta->manzana}}}">
        <br>
        <label for="txtLote">Lote</label>
        <input type="text" id="txtLote" name="txtLote" size="50" value="{{{$tProveedorPuntoVenta->lote}}}">
        <br>
        <label for="txtNumeroVivienda">Nº Vivienda</label>
        <input type="text" id="txtNumeroVivienda" name="txtNumeroVivienda" size="50" value="{{{$tProveedorPuntoVenta->numeroVivienda}}}">
        <br>
        <label for="txtNumeroInterior">Nº Interior</label>
        <input type="text" id="txtNumeroInterior" name="txtNumeroInterior" size="50" value="{{{$tProveedorPuntoVenta->numeroInterior}}}">
        <br>
        <label for="txtTelefono">Teléfono</label>
        <input type="text" id="txtTelefono" name="txtTelefono" size="50" value="{{{$tProveedorPuntoVenta->telefono}}}">
        <br>
        <label for="txtCorreo">Correo</label>
        <input type="text" id="txtCorreo" name="txtCorreo" size="50" value="{{{$tProveedorPuntoVenta->correo}}}">
        <br>
        <label for="txtPaginaWeb">paginaWeb</label>
        <input type="text" id="txtPaginaWeb" name="txtPaginaWeb" size="50" value="{{{$tProveedorPuntoVenta->paginaWeb}}}">
        <br>
        <label for="cbxEstado">Estado</label>
        <select name="cbxEstado" id="cbxEstado">
            <option value="1" {{{$tProveedorPuntoVenta->estado ? 'selected':''}}}>En Servicio</option>
            <option value="0" {{{!$tProveedorPuntoVenta->estado ? 'selected':''}}}>Indispuesto</option>
        </select>
    </div>
    <div class="seccionBotones bordeArriba">
        <input type="button" value="Guardar cambios" onclick="enviarFrmEditarProveedorPuntoVenta();">
    </div>
</form>
<script>
    function enviarFrmEditarProveedorPuntoVenta()
    {
        var mensajeGlobal='';

        mensajeGlobal+=(!valVacio($('#txtDescripcion').val())?'Complete el campo de Descripción<br>':'');
        mensajeGlobal+=(!valVacio($('#txtPais').val())?'Complete el campo de País<br>':'');
        mensajeGlobal+=(!valVacio($('#txtDepartamento').val())?'Complete el campo de Departamento<br>':'');
        mensajeGlobal+=(!valVacio($('#txtProvincia').val())?'Complete el campo de Provincia<br>':'');
        mensajeGlobal+=(!valVacio($('#txtDistrito').val())?'Complete el campo de Distrito<br>':'');
        mensajeGlobal+=(!valVacio($('#txtDireccion').val())?'Complete el campo de Direción<br>':'');
        mensajeGlobal+=(!valEmail($('#txtCorreo').val())?'Correo incorrecto<br>':'');

        if(mensajeGlobal!='')
        {
            animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
            return;
        }

        if(confirm('Realmente desea editar la Sucursal'))
        {        
            $('#frmEditarProveedorPuntoVenta').submit();
            return;
        }
        alert('Operación Cancelada');
    }
</script>