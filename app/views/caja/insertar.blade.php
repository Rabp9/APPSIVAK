@extends('layout.layout')

@section('contenidoCuerpo')
    <h2 class="textAlignRight bordeAbajo tituloCabecera">ABRIR CAJA PARA LA OFICINA</h2>
    <section class="contenidoTop">
        <form id="frmInsertarCaja" action="/APPSIVAK/public/caja/insertar" method="post" class="formulario labelPequenio">
            <h2 class="bordeAbajo">Datos para abrir caja</h2>
            <div class="contenidoTop textAlignLeft">
                <input type="hidden" id="txtCodigoLocal" name="txtCodigoLocal" size="50" value="{{{explode(',', Session::get('local'))[0]}}}">
                <label for="txtDescripcion">Descripción</label>
                <input type="text" id="txtDescripcion" name="txtDescripcion" size="50" readonly="readonly" value="{{{explode(',', Session::get('local'))[1]}}}">
            </div>
            <div class="seccionBotones bordeArriba">
                @if(isset($cajaCerrada) && $cajaCerrada)
                    <h2 class="backGroundColorRojo">Caja cerrada</h2>
                @else
                    <input type="button" value="Abrir caja" onclick="enviarFrmInsertarCaja();">
                @endif
            </div>
        </form>
    </section>
    <script>
        function enviarFrmInsertarCaja()
        {
            if(confirm("Realmente desea abrir caja"))
            {        
                $("#frmInsertarCaja").submit();
                return;
            }
            alert("Operación Cancelada");
        }
    </script>
@stop