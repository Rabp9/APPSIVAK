<label for="cbxCodigoUnidadMedidaProducto">Unidad de Medida</label>
<select name="cbxCodigoUnidadMedidaProducto" id="cbxCodigoUnidadMedidaProducto" class="contenidoMiddle" style="min-width: 391px;">
    @foreach($listaTUnidadMedida as $item) 
        <option value="{{{$item->codigoUnidadMedida}}}">{{{$item->nombre}}}</option>
    @endforeach
</select>
<button class="button contenidoMiddle" style="width: 250px;" onclick="dialogoAjax('dialogo', 380, true, 'Registrar unidad de medida', 'top', null, '/APPSIVAK/public/unidadmedida/insertarconajax', 'POST', null, null, false, true);">Añadir unidad de medida</button>
@if(isset($mensajeGlobal) && $mensajeGlobal!='')
    <script>animacionAlertaMensajeGeneral('{{$mensajeGlobal}}', '{{$color}}');</script>
@endif