window.start_load = function(){
    $('body').prepend('<div id="loader-wrapper" style="background-color:rgba(0, 0, 0, 0.59)"> <div id="loader"></div> </div>')
}
window.end_load = function(){
    $('#loader-wrapper').fadeOut('fast', function() {
        $(this).remove();
    })
}

window.start_load_click = function(){
   
    $('#loader-wrapper').prepend('<div id="loader"></div>')
}
window.end_load_click = function(){
    $('#modal-overlay').modal('hide');
    $('#loader-wrapper').fadeOut('fast', function() {
        $(this).remove();
    })
}