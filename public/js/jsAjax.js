function dialogoAjax(idDialogo, anchoDialogo, modal, title, position, data, url, method, preFunction, postFunction, cache, async)
{
    if((typeof preFunction)=='function')
    {
        preFunction();
    }

    $('#'+idDialogo).html('<p style="color: #1497CC;font-size: 18px;text-align: center;">Cargando datos...</p>');
    
    $.ajax(
    {
        url: url,
        type: method,
        data: data,
        cache: cache,
        async: async
    }).done(function(pagina) 
    {
        $('#'+idDialogo).html(pagina);

        if((typeof postFunction)=='function')
        {
            postFunction();
        }
    }).fail(function()
    {
        $('#'+idDialogo).html('<p style="color: red;">Ocurrió un error inesperado. Por favor contacte con el administrador del sistema.</p>');
    });

    $( '#'+idDialogo ).dialog(
    {
        resizable: false,
        width: anchoDialogo,
        modal: modal,
        title: title,
        position: {at: position}
    });
}

function paginaAjax(idSeccion, data, url, method, preFunction, postFunction, cache, async)
{
    if((typeof preFunction)=='function')
    {
        preFunction();
    }

    $('#'+idSeccion).html('<p style="color: #1497CC;font-size: 18px;text-align: center;">Cargando datos...</p>');
    
    $.ajax(
    {
        url: url,
        type: method,
        data: data,
        cache: cache,
        async: async
    }).done(function(pagina) 
    {
        $('#'+idSeccion).html(pagina);

        if((typeof postFunction)=='function')
        {
            postFunction();
        }
    }).fail(function()
    {
        $('#'+idSeccion).html('<p style="color: red;">Ocurrió un error inesperado. Por favor contacte con el administrador del sistema.</p>');
    });
}