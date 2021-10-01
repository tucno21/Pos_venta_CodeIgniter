$( function() {
    $( "#clienteV" ).autocomplete({
        source: "/ventas/autocompletarClientes",
        minLength:3,
        select: function( event, ui) {
            event.preventDefault();
            $("#id_cliente").val(ui.item.id);
            $("#clienteV").val(ui.item.value);
        }
    });
} );