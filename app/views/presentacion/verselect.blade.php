<label for="cbxCodigoPresentacionProducto">Presentación del Producto</label>
<select name="cbxCodigoPresentacionProducto" id="cbxCodigoPresentacionProducto" style="min-width: 391px;">
    @foreach($listaTPresentacion as $item) 
        <option value="{{{$item->codigoPresentacion}}}">{{{$item->nombre}}}</option>
    @endforeach
</select>
<button class="button" style="width: 250px;" onclick="dialogoAjax('dialogo', 380, true, 'Registrar presentación', 'top', null, '/APPSIVAK/public/presentacion/insertarconajax', 'POST', null, null, false, true);">Añadir presentación</button>
@if(isset($mensajeGlobal) && $mensajeGlobal!='')
    <script>animacionAlertaMensajeGeneral('{{$mensajeGlobal}}', '{{$color}}');</script>
@endif