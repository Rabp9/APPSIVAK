<form id="frmCerrarCajaDetalle" action="/APPSIVAK/public/cajadetalle/cerrar" method="post" class="formulario labelMediano textAlignCenter">
    <div class="contenidoTop textAlignLeft">
        <input type="hidden" id="txtCodigoCajaDetalle" name="txtCodigoCajaDetalle" value="{{{$tCajaDetalle->codigoCajaDetalle}}}">
        <label for="txtDescripcion">Descripción del cierre</label>
        <br>
        <textarea name="txtDescripcion" id="txtDescripcion" cols="38" rows="5"></textarea>
    </div>
    <div class="seccionBotones bordeArriba">
        <input type="button" value="Confirmar cierre de caja" onclick="enviarFrmCerrarCajaDetalle();">
    </div>
</form>
<script>
    function enviarFrmCerrarCajaDetalle()
    {
        var mensajeGlobal='';

        if(mensajeGlobal!='')
        {
            animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
            return;
        }

        $('#frmCerrarCajaDetalle').submit();
    }
</script>