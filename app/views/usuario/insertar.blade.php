@extends('layout.layout')

@section('contenidoCuerpo')
    <h2 class="textAlignRight bordeAbajo tituloCabecera">REGISTRAR USUARIO</h2>
    <section class="contenidoTop">
        <form id="frmInsertarUsuario" action="/APPSIVAK/public/usuario/insertar" method="post" class="formulario labelMediano">
            <div class="contenidoTop textAlignLeft">
                <h2 class="bordeAbajo">Datos del usuario</h2>
                <input type="button" id="btnBuscarPersonal" value="Buscar Personal" style="width: 200px;" onclick="mostrarApartadoBuscar();">
                <hr>
                <label for="txtNombrePersonal">Nombre de Personal</label>
                <input type="text" id="txtNombrePersonal" name="txtNombrePersonal" size="50" placeholder="Obligatorio" readonly="readonly" value="{{{isset($txtNombrePersonal)?$txtNombrePersonal:''}}}">
                <input type="hidden" id="txtCodigoPersonal" name="txtCodigoPersonal" readonly="readonly" value="{{{isset($txtCodigoPersonal)?$txtCodigoPersonal:''}}}">
                <br>
                <label for="txtNombreUsuario">Nombre de Usuario</label>
                <input type="text" id="txtNombreUsuario" name="txtNombreUsuario" size="50" placeholder="Obligatorio" value="{{{isset($txtNombreUsuario)?$txtNombreUsuario:''}}}">
                <br>
                <label for="txtContrasenia">Contraseña</label>
                <input type="password" id="txtContrasenia" name="txtContrasenia" size="50" placeholder="Obligatorio" value="{{{isset($txtContrasenia)?$txtContrasenia:''}}}">
                <br>
                <label for="txtRepitaContrasenia">Repita Contraseña</label>
                <input type="password" id="txtRepitaContrasenia" name="txtRepitaContrasenia" size="50" placeholder="Obligatorio" value="{{{isset($txtRepitaContrasenia)?$txtRepitaContrasenia:''}}}">
            </div>
            <div class="seccionBotones bordeArriba">
                <input type="button" value="Registrar" onclick="enviarFrmInsertarUsuario();">
            </div>
        </form>
    </section>
    <section id="apartadoBuscar" class="apartadoBuscar">
        <div id="divBuscarEnTablaPersonal">
            <script>
                paginaAjax('divBuscarEnTablaPersonal', null, '/APPSIVAK/public/personal/buscarpersonal', 'POST', null, null, false, true);
            </script>
        </div>
    </section>
    <script>
        function enviarFrmInsertarUsuario()
        {
            var mensajeGlobal='';

            mensajeGlobal+=(!valVacio($("#txtNombrePersonal").val())?"Completar el campo Nombre del Personal<br>":'');
            mensajeGlobal+=(!valVacio($("#txtNombreUsuario").val())?"Completar el campo Nombre del Usuario<br>":'');
            mensajeGlobal+=(!valVacio($("#txtContrasenia").val())?"Completar el campo Contraseña<br>":'');
            
            if($('#txtContrasenia').val()!=$('#txtRepitaContrasenia').val())
            {
                mensajeGlobal+='La Contraseña no Coencide. Vuelva a escribir contraseña<br>';
            }

            if(mensajeGlobal!='')
            {
                animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
                return;
            }

            if(confirm('Realmente desea registrar el Usuario'))
            {        
                $('#frmInsertarUsuario').submit();
                return;
            }
            alert('Operación Cancelada');
        }
    </script>
@stop