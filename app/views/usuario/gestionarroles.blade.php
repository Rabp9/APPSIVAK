<form id="frmGestionarRolesUsuario" action="/APPSIVAK/public/usuario/gestionarroles" method="post" class="formulario labelMediano textAlignCenter">
    <div class="contenidoTop textAlignLeft">
        <input type="hidden" id="txtCodigoPersonal" name="txtCodigoPersonal" value="{{{$tUsuario->codigoPersonal}}}">
        <label for="txtNombreUsuario">Usuario</label>
        <input type="text" id="txtNombreUsuario" name="txtNombreUsuario" size="50" readonly="readonly" value="{{{$tUsuario->nombreUsuario}}}">
        <br>
        <div id="checkBoxRol" class="estiloCheckCircular">
            <input type="hidden" id="txtCheckBoxRol" name="txtCheckBoxRol" value="{{{$tUsuario->rol}}}">
            <label>Rol</label>
            <div id="checkAdministrador" value="Administrador" {{strlen(strpos(($tUsuario->rol), 'Administrador'))>0 ? 'seleccionado="true"' : ''}} onclick="onClickEstiloCheckCircular(this);"><b>Administrador</b></div>
            <div id="checkAlmacenero" value="Almacenero" {{strlen(strpos(($tUsuario->rol), 'Almacenero'))>0 ? 'seleccionado="true"' : ''}} onclick="onClickEstiloCheckCircular(this);"><b>Almacenero</b></div>
            <div id="checkVentas" value="Ventas" {{strlen(strpos(($tUsuario->rol), 'Ventas'))>0 ? 'seleccionado="true"' : ''}} onclick="onClickEstiloCheckCircular(this);"><b>Ventas</b></div>
            <div id="checkReportes" value="Reportes" {{strlen(strpos(($tUsuario->rol), 'Reportes'))>0 ? 'seleccionado="true"' : ''}} onclick="onClickEstiloCheckCircular(this);"><b>Reportes</b></div>
        </div>
    </div>
    <div class="seccionBotones bordeArriba">
        <input type="button" value="Confirmar roles" onclick="enviarFrmGestionarRolesUsuario();">
    </div>
</form>
<script>
    inicializarEstiloCheckCircular('checkBoxRol', '110px', '25px', '25px', '10px', 'checkbox');

    function enviarFrmGestionarRolesUsuario()
    {
        var mensajeGlobal='';

        if(mensajeGlobal!='')
        {
            animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
            return;
        }

        $('#frmGestionarRolesUsuario').submit();
    }
</script>