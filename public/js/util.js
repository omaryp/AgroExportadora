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

function ajax_post(ruta,datos){
    $.ajax({
        data: datos,
        type: "POST",
        dataType: "json",
        url: ruta,
    })
    .done(function( rpta, textStatus, jqXHR ) {
        procesar_rpta(rpta);
    })
    .fail(function( jqXHR, textStatus, errorThrown ) {
        rpta_srv = textStatus;
    });
}   