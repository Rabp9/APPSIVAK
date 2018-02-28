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
    <form id="frmAnularVenta" action="/APPSIVAK/public/reciboventa/anular" method="post" class="formulario labelMediano textAlignCenter">
        <div class="contenidoTop textAlignLeft">
            <input type="hidden" id="txtCodigoReciboVenta" name="txtCodigoReciboVenta" value="{{{$tReciboVenta->codigoReciboVenta}}}">
            <label for="txtMotivoAnulacion">Motivo de la anulación</label>
            <br>
            <textarea name="txtMotivoAnulacion" id="txtMotivoAnulacion" cols="38" rows="5" placeholder="Obligatorio"></textarea>
        </div>
        <div class="seccionBotones bordeArriba">
            <input type="button" value="Confirmar anulación de la venta" onclick="enviarFrmAnularVenta();">
        </div>
    </form>
    <script>
        function enviarFrmAnularVenta()
        {
            var mensajeGlobal='';
             
            mensajeGlobal+=(!valVacio($('#txtMotivoAnulacion').val())?'Complete el campo de Motivo de la anulación<br>':'');

            if(mensajeGlobal!='')
            {
                animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
                return;
            }

            $('#frmAnularVenta').submit();
        }
    </script>
@endif