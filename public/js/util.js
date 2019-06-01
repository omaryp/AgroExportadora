function filterFloat(evt,input){
    var RE = /^\d*\.?\d*$/;
    if (RE.test(input)) {
        return true;
    } else {
        return false;
    }
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

function ajax_get(ruta,data){
    $.getJSON( ruta+='/'+data , {_token: '{!! csrf_token() !!}'})
    .done(function( data, textStatus, jqXHR ) {
        procesarDataGet(data);
    })
    .fail(function( jqXHR, textStatus, errorThrown ) {
        if ( console && console.log ) {
            console.log( "Algo ha fallado: " +  textStatus);
        }
    });
} 