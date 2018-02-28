@extends('layout.layout')

@section('contenidoCuerpo')
    <h2 class="textAlignRight bordeAbajo tituloCabecera">REGISTRAR GASTO GENERADO</h2>
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
        @if(Session::get('localAcceso')!='Oficina')
            <div class="alertaMensajeError">
                Ud. debe estar logueado en una oficina/tienda para registrar gastos
            </div>
        @endif
        @if(Session::get('localAcceso')=='Oficina')
            <section class="contenidoTop">
                <form id="frmInsertarEgreso" action="/APPSIVAK/public/egreso/insertar" method="post" class="formulario labelMediano">
                    <div class="contenidoTop textAlignLeft">
                        <input type="text" style="display: none;">
                        <h2 class="bordeAbajo">Datos del gasto generado</h2>
                        <label for="txtDescripcion">Descripción del gasto</label>
                        <textarea name="txtDescripcion" id="txtDescripcion" cols="50" rows="5" placeholder="Obligatorio">{{{isset($txtDescripcion)?$txtDescripcion:''}}}</textarea>
                        <br>
                        <label for="txtMonto">Monto del gasto</label>
                        <input type="text" id="txtMonto" name="txtMonto" size="50" placeholder="0.00" value="{{{isset($txtMonto)?$txtMonto:''}}}">
                    </div>
                    <div class="seccionBotones bordeArriba">
                        <input type="button" value="Registrar" onclick="enviarFrmInsertarEgreso();">
                    </div>
                </form>
            </section>
            <script>
                function enviarFrmInsertarEgreso()
                {
                    var mensajeGlobal='';
                    
                    mensajeGlobal+=(!valVacio($('#txtDescripcion').val())?'Complete el campo Descripción<br>':'');
                    mensajeGlobal+=(!valDosDecimales($('#txtMonto').val())?'El Monto debe ser en soles<br>':'');

                    if($('#txtMonto').val()<=0)
                    {
                        mensajeGlobal+='El monto debe ser mayor a 0';
                    }

                    if(mensajeGlobal!='')
                    {
                        animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
                        return;
                    }

                    if(confirm('Realmente desea registrar el gasto'))
                    {        
                        $('#frmInsertarEgreso').submit();
                        return;
                    }
                    alert('Operación Cancelada');
                }
            </script>
        @endif
    @endif
@stop