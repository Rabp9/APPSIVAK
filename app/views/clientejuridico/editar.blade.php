<form id="frmEditarClienteJuridico" action="/APPSIVAK/public/clientejuridico/editar" method="post" class="formulario labelMediano textAlignCenter">
    <div class="contenidoTop textAlignLeft">
        <input type="hidden" id="txtCodigoClienteJuridico" name="txtCodigoClienteJuridico" value="{{{$tClienteJuridico->codigoClienteJuridico}}}">
        <label for="txtRuc">Ruc</label>
        <input type="text" id="txtRuc" name="txtRuc" size="50" placeholder="Obligatorio" value="{{{$tClienteJuridico->ruc}}}">
        <br>
        <label for="txtRazonSocialCorta">Razón Social Corta</label>
        <input type="text" id="txtRazonSocialCorta" name="txtRazonSocialCorta" size="50" placeholder="Obligatorio" value="{{{$tClienteJuridico->razonSocialCorta}}}">
        <br>
        <label for="txtRazonSocialLarga">Razón Social Larga</label>
        <input type="text" id="txtRazonSocialLarga" name="txtRazonSocialLarga" size="50" placeholder="Obligatorio" value="{{{$tClienteJuridico->razonSocialLarga}}}">
        <br>
        <label>Reside en el País</label>
        <div class="contenidoMiddle">
            <input type="radio" id="radioSi" name="radioResidePais" value="1" {{{$tClienteJuridico->residePais=='1' ? 'checked="checked"' : ''}}}>
            <label class="noLabel" for="radioSi">Si</label>
            <input type="radio" id="radioNo" name="radioResidePais" value="0" {{{$tClienteJuridico->residePais=='0' ? 'checked="checked"' : ''}}}>
            <label class="noLabel" for="radioNo">No</label>
        </div>
        <br>
        <label for="txtFechaConstitucion">Fecha de Constitución</label>
        <input type="date" id="txtFechaConstitucion" name="txtFechaConstitucion" value="{{{$tClienteJuridico->fechaConstitucion}}}">
        <br>
        <label for="txtPais">País</label>
        <input type="text" id="txtPais" name="txtPais" size="50" value="{{{$tClienteJuridico->pais}}}">
        <br>
        <label for="txtDepartamento">Departamento</label>
        <input type="text" id="txtDepartamento" name="txtDepartamento" size="50" value="{{{$tClienteJuridico->departamento}}}">
        <br>
        <label for="txtProvincia">Provincia</label>
        <input type="text" id="txtProvincia" name="txtProvincia" size="50" value="{{{$tClienteJuridico->provincia}}}">
        <br>
        <label for="txtDistrito">Distrito</label>
        <input type="text" id="txtDistrito" name="txtDistrito" size="50" value="{{{$tClienteJuridico->distrito}}}">
        <br>
        <label for="txtDireccion">Direción</label>
        <input type="text" id="txtDireccion" name="txtDireccion" size="50" value="{{{$tClienteJuridico->direccion}}}">
        <br>
        <label for="txtManzana">Manzana</label>
        <input type="text" id="txtManzana" name="txtManzana" size="50" value="{{{$tClienteJuridico->manzana}}}">
        <br>
        <label for="txtLote">Lote</label>
        <input type="text" id="txtLote" name="txtLote" size="50" value="{{{$tClienteJuridico->lote}}}">
        <br>
        <label for="txtNumeroVivienda">Nº Vivienda</label>
        <input type="text" id="txtNumeroVivienda" name="txtNumeroVivienda" size="50" value="{{{$tClienteJuridico->numeroVivienda}}}">
        <br>
        <label for="txtNumeroInterior">Nº Interior</label>
        <input type="text" id="txtNumeroInterior" name="txtNumeroInterior" size="50" value="{{{$tClienteJuridico->numeroInterior}}}">
        <br>
        <label for="txtTelefono">Teléfono</label>
        <input type="text" id="txtTelefono" name="txtTelefono" size="50" value="{{{$tClienteJuridico->telefono}}}">
        <br>
        <label for="txtCorreo">E-mail</label>
        <input type="text" id="txtCorreo" name="txtCorreo" size="50" value="{{{$tClienteJuridico->correo}}}">
    </div>
    <div class="seccionBotones bordeArriba">
        <input type="button" value="Guardar cambios" onclick="enviarFrmEditarClienteJuridico();">
    </div>
</form>
<script>
    function enviarFrmEditarClienteJuridico()
    {
        var mensajeGlobal='';
        
        mensajeGlobal+=(!valRuc($('#txtRuc').val())?'Ruc Incorrecto<br>':'');
        mensajeGlobal+=(!valVacio($('#txtRazonSocialCorta').val())?'Complete el campo de Razón Social Corta<br>':'');
        mensajeGlobal+=(!valVacio($('#txtRazonSocialLarga').val())?'Complete el campo de Razón Social Larga<br>':'');
        mensajeGlobal+=(!valFechaYYYYMMDD($('#txtFechaConstitucion').val())?'Fecha de Constitución Incorrecto<br>':'');
        mensajeGlobal+=(!valVacio($('#txtPais').val())?'Complete el campo de País<br>':'');

        if(mensajeGlobal!='')
        {
            animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
            return;
        }

        if(confirm('Realmente desea editar el Cliente'))
        {        
            $('#frmEditarClienteJuridico').submit();
            return;
        }
        alert('Operación Cancelada');
    }
</script>