<form id="frmEditarUsuario" action="/APPSIVAK/public/usuario/editar" method="post" class="formulario labelMediano textAlignCenter">
    <div class="contenidoTop textAlignLeft">
        <input type="hidden" id="txtCodigoPersonal" name="txtCodigoPersonal" readonly="readonly" value="{{{$tUsuario->codigoPersonal}}}">
        <label for="txtNombreUsuario">Nombre de Usuario</label>
        <input type="text" id="txtNombreUsuario" name="txtNombreUsuario" size="50" placeholder="Obligatorio" value="{{{$tUsuario->nombreUsuario}}}">
        <br>
        <label for="txtContraseniaAnterior">Contraseña Anterior</label>
        <input type="password" id="txtContraseniaAnterior" name="txtContraseniaAnterior" size="50" placeholder="Obligatorio">
        <br>
        <label for="txtContrasenia">Contraseña</label>
        <input type="password" id="txtContrasenia" name="txtContrasenia" size="50" placeholder="Obligatorio">
        <br>
        <label for="txtRepitaContrasenia">Repita Contraseña</label>
        <input type="password" id="txtRepitaContrasenia" name="txtRepitaContrasenia" size="50" placeholder="Obligatorio">
    </div>
    <div class="seccionBotones bordeArriba">
        <input type="button" value="Guardar cambios" onclick="enviarFrmEditarUsuario();">
    </div>
</form>
<script>
    function enviarFrmEditarUsuario()
    {
        var mensajeGlobal='';

        mensajeGlobal+=(!valVacio($('#txtNombreUsuario').val())?'Complete el campo Nombre Usuario<br>':'');
        mensajeGlobal+=(!valVacio($('#txtContraseniaAnterior').val())?'Complete el campo Contraseña Anterior<br>':'');
        mensajeGlobal+=(!valVacio($('#txtContrasenia').val())?'Complete el campo Nombre Contraseña<br>':'');
        
        if($('#txtContrasenia').val()!=$('#txtRepitaContrasenia').val())
        {
            mensajeGlobal+='La Contraseña no Coencide. Vuelva a escribir contraseña<br>';
        }

        if(mensajeGlobal!='')
        {
            animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
            return;
        }

        if(confirm('Realmente desea editar el Usuario'))
        {        
            $('#frmEditarUsuario').submit();
            return;
        }
        alert('Operación Cancelada');
    }
</script>