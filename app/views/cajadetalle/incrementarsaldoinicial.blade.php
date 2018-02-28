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
    <form id="frmEditarCajaDetalle" action="/APPSIVAK/public/cajadetalle/incrementarsaldoinicial" method="post" class="formulario labelMediano textAlignCenter">
        <div class="contenidoTop textAlignLeft">
            <input type="text" style="display: none;">
            <input type="hidden" id="txtCodigoCajaDetalle" name="txtCodigoCajaDetalle" value="{{{$tCajaDetalle->codigoCajaDetalle}}}">
            <label for="txtMontoIncrementoSaldoInicial">Monto a incrementar en el saldo inicial</label>
            <br>
            <input type="text" id="txtMontoIncrementoSaldoInicial" name="txtMontoIncrementoSaldoInicial" placeholder="Obligatorio">
        </div>
        <div class="seccionBotones bordeArriba">
            <input type="button" value="Confirmar incremento" onclick="enviarFrmEditarCajaDetalle();">
        </div>
    </form>
    <script>
        function enviarFrmEditarCajaDetalle()
        {
            var mensajeGlobal='';
                                
            mensajeGlobal+=(!valDosDecimales($('#txtMontoIncrementoSaldoInicial').val())?'El monto a incrementar debe ser en soles<br>':'');

            if(parseFloat($('#txtMontoIncrementoSaldoInicial').val())<=0)
            {
                mensajeGlobal+='El monto a incrementar no puede ser menor o igual a 0<br>';
            }

            if(mensajeGlobal!='')
            {
                animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
                return;
            }

            if(confirm("Realmente desea ralizar el incremento del saldo inicial"))
            {        
                $("#frmEditarCajaDetalle").submit();
                return;
            }
            alert("Operación Cancelada");
        }
    </script>
@endif