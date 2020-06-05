let x = $(document);
x.ready(inicializarEventos);

function inicializarEventos() {
    add_blur_campos();
}

function add_blur_campos(){
    let campos = $("input.campo");
    campos.on('blur', function() {
        let campo = $(this);
        campo.val( campo.val().trim());
    });
}