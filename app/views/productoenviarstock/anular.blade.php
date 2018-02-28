<form id="frmAnularProductoEnviarStock" action="/APPSIVAK/public/productoenviarstock/anular" method="post" class="formulario textAlignCenter">
    <div class="contenidoTop textAlignLeft">
        <input type="hidden" id="txtCodigoProductoEnviarStock" name="txtCodigoProductoEnviarStock" value="{{{$tProductoEnviarStock->codigoProductoEnviarStock}}}">
        <label for="txtMotivoAnulacion">Motivo de la anulación</label>
        <br>
        <textarea name="txtMotivoAnulacion" id="txtMotivoAnulacion" cols="38" rows="5" placeholder="Obligatorio"></textarea>
    </div>
    <div class="seccionBotones bordeArriba">
        <input type="button" value="Confirmar anulación del envío" onclick="enviarFrmAnularProductoEnviarStock();">
    </div>
</form>
<script>
    function enviarFrmAnularProductoEnviarStock()
    {
        var mensajeGlobal='';
         
        mensajeGlobal+=(!valVacio($('#txtMotivoAnulacion').val())?'Complete el campo de Motivo de la anulación<br>':'');

        if(mensajeGlobal!='')
        {
            animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
            return;
        }

        $('#frmAnularProductoEnviarStock').submit();
    }
</script>