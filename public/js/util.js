function filterFloat(evt,input){
    var RE = /^\d*\.?\d*$/;
    if (RE.test(input)) {
        return true;
    } else {
        return false;
    }
}

function calcularDetraccion(porcentaje,importe){
    if(porcentaje<1)
        return porcentaje*importe;
    else
        return (porcentaje/100)*importe;
}