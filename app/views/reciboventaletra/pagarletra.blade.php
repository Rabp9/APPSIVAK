@if($cajaAbierta==0)
    <div class="alertaMensajeError">
        Debe abrir caja para este usuario antes de proseguir con las operaciones de entrada y salida monetaria.
    </div>
@endif
@if($cajaAbierta==2)
    <div class="alertaMensajeError">
        La caja del día de hoy para este usuario ya fue cerrado.
    </div>
@endif
@if($cajaAbierta==1)
    <form id="frmPagarLetra" action="/APPSIVAK/public/reciboventaletra/pagarletra" method="post" class="formulario labelMediano textAlignCenter">
        <div class="contenidoTop textAlignLeft">
            <input type="text" style="display: none;">
            <input type="hidden" id="txtCodigoReciboVentaLetra" name="txtCodigoReciboVentaLetra" value="{{{$tReciboVentaLetra->codigoReciboVentaLetra}}}">
            <label for="txtDescripcionReciboVentaPago">Descripción</label>
            <br>
            <textarea name="txtDescripcionReciboVentaPago" id="txtDescripcionReciboVentaPago" cols="38" rows="5"></textarea>
        </div>
        <div class="seccionBotones bordeArriba">
            <input type="button" value="Pagar letra" onclick="enviarFrmPagarLetra();">
        </div>
    </form>
    <script>
        function enviarFrmPagarLetra()
        {
            var mensajeGlobal='';

            if(mensajeGlobal!='')
            {
                animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
                return;
            }

            if(confirm('Realmente desea pagar la letra'))
            {       
                $('#frmPagarLetra').submit();
                return;
            }
            alert('Operación Cancelada');
        }
    </script>
@endif