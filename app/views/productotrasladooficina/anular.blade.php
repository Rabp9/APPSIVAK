<form id="frmAnularProductoTrasladoOficina" action="/APPSIVAK/public/productotrasladooficina/anular" method="post" class="formulario textAlignCenter">
    <div class="contenidoTop textAlignLeft">
        <input type="hidden" id="txtCodigoProductoTrasladoOficina" name="txtCodigoProductoTrasladoOficina" value="{{{$tProductoTrasladoOficina->codigoProductoTrasladoOficina}}}">
        <label for="txtMotivoAnulacion">Motivo de la anulación</label>
        <br>
        <textarea name="txtMotivoAnulacion" id="txtMotivoAnulacion" cols="38" rows="5" placeholder="Obligatorio"></textarea>
    </div>
    <div class="seccionBotones bordeArriba">
        <input type="button" value="Confirmar anulación del traslado" onclick="enviarFrmAnularProductoTrasladoOficina();">
    </div>
</form>
<script>
    function enviarFrmAnularProductoTrasladoOficina()
    {
        var mensajeGlobal='';
         
        mensajeGlobal+=(!valVacio($('#txtMotivoAnulacion').val())?'Complete el campo de Motivo de la anulación<br>':'');

        if(mensajeGlobal!='')
        {
            animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
            return;
        }

        $('#frmAnularProductoTrasladoOficina').submit();
    }
</script>