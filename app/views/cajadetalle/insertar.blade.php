@extends('layout.layout')

@section('contenidoCuerpo')
    <h2 class="textAlignRight bordeAbajo tituloCabecera">CREAR CAJA POR USUARIO</h2>
    <section class="contenidoTop">
        <form id="frmInsertarCajaDetalle" action="/APPSIVAK/public/cajadetalle/insertar" method="post" class="formulario labelPequenio">
            <div class="contenidoTop textAlignLeft">
                <h2 class="bordeAbajo">Asignación de caja</h2>
                <label for="txtNombrePersonal">Nombre de Personal</label>
                <input type="text" id="txtNombrePersonal" name="txtNombrePersonal" size="50" placeholder="Obligatorio" readonly="readonly" value="{{{isset($txtNombrePersonal)?$txtNombrePersonal:''}}}">
                <input type="hidden" id="txtCodigoPersonal" name="txtCodigoPersonal" readonly="readonly" value="{{{isset($txtCodigoPersonal)?$txtCodigoPersonal:''}}}">
                <input type="button" id="btnBuscarPersonal" value="Buscar Personal" style="width: 200px;" onclick="mostrarApartadoBuscar();">
                <br>
                <label for="txtSaldoInicial">Saldo inicial</label>
                <input type="text" id="txtSaldoInicial" name="txtSaldoInicial" size="50" placeholder="Obligatorio" value="{{{isset($txtSaldoInicial)?$txtSaldoInicial:'0.00'}}}">
                <br>
                <label for="txtFechaActualEstaCaja">Fecha actual de esta caja</label>
                <input type="text" id="txtFechaActualEstaCaja" name="txtFechaActualEstaCaja" readonly="readonly" value="{{{date('Y-m-d')}}}">
            </div>
            <div class="seccionBotones bordeArriba">
                @if(isset($cajaCerrada) && $cajaCerrada)
                    <h2 class="backGroundColorRojo">Caja cerrada</h2>
                @else
                    <input type="button" value="Asignar caja a este usuario" onclick="enviarFrmInsertarCajaDetalle();">
                @endif
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
        function enviarFrmInsertarCajaDetalle()
        {
            var mensajeGlobal='';
                            
            mensajeGlobal+=(!valVacio($('#txtCodigoPersonal').val())?'Debe seleccionar el personal para asignarle la caja<br>':'');
            mensajeGlobal+=(!valDosDecimales($('#txtSaldoInicial').val())?'El saldo inicial debe ser en soles<br>':'');

            if(mensajeGlobal!='')
            {
                animacionAlertaMensajeGeneral(mensajeGlobal, 'red');
                return;
            }

            if(confirm("Realmente desea abrir caja"))
            {        
                $("#frmInsertarCajaDetalle").submit();
                return;
            }
            alert("Operación Cancelada");
        }
    </script>
@stop