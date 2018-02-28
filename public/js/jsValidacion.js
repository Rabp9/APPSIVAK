function valDni(valor)
{
    var expresion=/^[0-9]{8}$/;
    
    if(!expresion.test(valor))
    {
        return false;
    }
    else
    {
        return true;
    }
}

function valRuc(valor)
{
    var expresion=/^[0-9]{11}$/;
    
    if(!expresion.test(valor))
    {
        return false;
    }
    else
    {
        return true;
    }
}

function valEntero(valor)
{
    var expresion=/^[0-9]+$/;
    
    if(!expresion.test(valor))
    {
        return false;
    }
    else
    {
        return true;
    }
}

function valDecimal(valor)
{
    var expresion=/^[0-9]+([\.]{1}[0-9]+)?$/;
    
    if(!expresion.test(valor))
    {
        return false;
    }
    else
    {
        return true;
    }
}

function valDosDecimales(valor)
{
    var expresion=/^[0-9]+([\.]{1}[0-9]{1,2})?$/;
    
    if(!expresion.test(valor))
    {
        return false;
    }
    else
    {
        return true;
    }
}

function valEmail(valor)
{
    var expresion=/^([a-zA-Z0-9\.\/-_]+\@[a-zA-Z-]+\.[a-zA-Z]+)*$/;
    
    if(!expresion.test(valor))
    {
        return false;
    }
    else
    {
        return true;
    }
}

function valFechaYYYYMMDD(valor)
{
    var expresion=/^(1|2){1}[0-9]{3}[-./][0-9]{2}[-./][0-9]{2}$/;
    
    if(!expresion.test(valor))
    {
        return false;
    }
    else
    {
        return true;
    }
}

function valVacio(valor)
{
    
    if($.trim(valor)==="")
    {
        return false;
    }
    else
    {
        return true;
    }
}