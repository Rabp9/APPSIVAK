@extends('layout.layout')

@section('contenidoCuerpo')
    <h2 class="textAlignRight bordeAbajo tituloCabecera">REGISTRAR REPRESENTANTE PARA CLIENTE JURÍDICO</h2>
    <section class="contenidoTop">
        <form id="frmInsertarClienteJuridicoRepresentante" action="/APPSIVAK/public/clientejuridicorepresentante/insertar" method="post" class="formulario labelGrande">
            <div class="contenidoTop textAlignLeft">
                <h2 class="bordeAbajo">Datos del representante para el cliente jurídico</h2>
                <input type="button" id="btnBuscarClienteJuridico" value="Buscar Cliente Jurídico" style="width: 200px;" onclick="mostrarApartadoBuscar();">
                <hr>
                <label for="txtRucClienteJuridico">Ruc Cliente Jurídico</label>
                <input type="text" id="txtRucClienteJuridico" name="txtRucClienteJuridico" size="50" placeholder="Obligatorio" readonly="readonly" value="{{{isset($txtRucClienteJuridico)?$txtRucClienteJuridico:''}}}">
                <br>
                <label for="txtRazonSocialCortaClienteJuridico">Razón Social Corta Cliente Jurídico</label>
                <input type="text" id="txtRazonSocialCortaClienteJuridico" name="txtRazonSocialCortaClienteJuridico" size="50" placeholder="Obligatorio" readonly="readonly" value="{{{isset($txtRazonSocialCortaClienteJuridico)?$txtRazonSocialCortaClienteJuridico:''}}}">
                <input type="hidden" id="txtCodigoClienteJuridico" name="txtCodigoClienteJuridico" readonly="readonly" value="{{{isset($txtCodigoClienteJuridico)?$txtCodigoClienteJuridico:''}}}">
                <br>
                <label for="txtDni">Dni</label>
                <input type="text" id="txtDni" name="txtDni" size="50" placeholder="Obligatorio" value="{{{isset($txtDni)?$txtDni:''}}}">
                <br>
                <label for="txtNombreCompleto">Nombre Completo</label>
                <input type="text" id="txtNombreCompleto" name="txtNombreCompleto" size="50" placeholder="Obligatorio" value="{{{isset($txtNombreCompleto)?$txtNombreCompleto:''}}}">
                <br>
                <label for="txtCargo">Cargo</label>
                <input type="text" id="txtCargo" name="txtCargo" size="50" placeholder="Obligatorio" value="{{{isset($txtCargo)?$txtCargo:''}}}">
                <br>
                <label for="txtCorreo">Correo</label>
                <input type="text" id="txtCorreo" name="txtCorreo" size="50" value="{{{isset($txtCorreo)?$txtCorreo:''}}}">
                <br>
                <label for="txtDomicilio">Domicilio</label>
                <input type="text" id="txtDomicilio" name="txtDomicilio" size="50" value="{{{isset($txtDomicilio)?$txtDomicilio:''}}}">
            </div>
            <div class="seccionBotones bordeArriba">
                <input type="button" value="Registrar" onclick="enviarFrmInsertarClienteJuridicoRepresentante();">
            </div>
        </form>
    </section>
    <section id="apartadoBuscar" class="apartadoBuscar">
        <div id="divBuscarEnTablaClienteJuridico">
            <h2 class="textAlignCenter bordeAbajo">CLIENTES JURÍDICOS</h2>
            <section class="anchoCompleto textAlignLeft backGroundColorGrisClaro">
                <label class="contenidoMiddle">Buscar</label>
                <input type="text" class="contenidoMiddle text" size="50" onkeypress="actionListaBuscarClienteJuridicoPorRucRazonSocialLarga('divListaBuscarClienteJuridico', this.value);">
                <input type="button" class="contenidoMiddle button" value="Ocultar Búsqueda" onclick="ocultarApartadoBuscar();">
            </section>
            <section id="divListaBuscarClienteJuridico" class="anchoCompleto labelPequenio textoMediano">
                
            </section>
            <script>
                var lanzarEventoListaBuscarClienteJuridicoPorRucRazonSocialLarga;

                function actionListaBuscarClienteJuridicoPorRucRazonSocialLarga(idSeccion, rucRazonSocialLarga)
                {
                    var code=(event.keyCode ? event.keyCode : event.which);

                    if(code==13)
                    {
                        clearTimeout(lanzarEventoListaBuscarClienteJuridicoPorRucRazonSocialLarga);

                        lanzarEventoListaBuscarClienteJuridicoPorRucRazonSocialLarga=setTimeout(function()
                        {
                            paginaAjax(idSeccion, {rucRazonSocialLarga: rucRazonSocialLarga}, '/APPSIVAK/public/clientejuridico/listabuscarclientejuridicoporrucrazonsociallarga', 'POST', null, function()
                            {
                                $('.btnSeleccionarClienteJuridico').on('click', function()
                                {
                                    var codigoClienteJuridico=this.id.substring(29);

                                    accionSeleccionarClienteJuridico(codigoClienteJuridico);
                                });
                            }, false, true);
                        }, 500);
                    }
                }
            </script>
        </div>
    </section>
    <script>
        function accionSeleccionarClienteJuridico(codigoClienteJuridico)
        {
            $('#txtRucClienteJuridico').val($('#rucClienteJuridico'+codigoClienteJuridico).text());
            $('#txtRazonSocialCortaClienteJuridico').val($('#razonSocialCortaClienteJuridico'+codigoClienteJuridico).text());
            $('#txtCodigoClienteJuridico').val($('#codigoClienteJuridico'+codigoClienteJuridico).text());
            ocultarApartadoBuscar();
        }

        function enviarFrmInsertarClienteJuridicoRepresentante()
        {
            var mensajeGlobal='';
            
            mensajeGlobal+=(!valVacio($('#txtRucClienteJuridico').val())?'Debe seleccionar Cliente Jurídico<br>':'');
            mensajeGlobal+=(!valDni($('#txtDni').val())?'Dni Incorrecto<br>':'');
            mensajeGlobal+=(!valVacio($('#txtNombreCompleto').val())?'Complete el campo Nombre<br>':'');
            mensajeGlobal+=(!valVacio($('#txtCargo').val())?'Complete el campo de Cargo<br>':'');

            if(mensajeGlobal!='')
            {
                animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
                return;
            }

            if(confirm('Realmente desea registrar el Representante para el Cliente Jurídico Seleccionado'))
            {        
                $('#frmInsertarClienteJuridicoRepresentante').submit();
                return;
            }
            alert('Operación Cancelada');                
        }
    </script>
@stop