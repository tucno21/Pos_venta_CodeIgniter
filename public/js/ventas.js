$( function() {

    $("#completa_venta").click(function(){
        let nFile = $(".tablaproductosVenta tr").length;

        if(nFile < 2 ){
            Swal.fire(
                'Debe agregar al menos un producto',
                '-',
                'error'
              )
        }else{
            $("#form_venta").submit();
        }
    });

    $( "#clienteV" ).autocomplete({
        source: "/ventas/autocompletarClientes",
        minLength:3,
        select: function( event, ui) {
            event.preventDefault();
            $("#id_cliente").val(ui.item.id);
            $("#clienteV").val(ui.item.value);
        }
    });

    $( "#codigoVenta" ).autocomplete({
        source: "/ventas/autocompletarCompra",
        minLength:3,
        select: function( event, ui) {
            event.preventDefault();
            $("#codigoVenta").val(ui.item.value);
            // $("#id_producto").val(ui.item.id);
            setTimeout(function(){
                e = jQuery.Event("keypress");
                e.which = 13;
                agregarProducto(e, ui.item.id);
            })
        }
    });


    function agregarProducto(e, id_producto){
        let enterkey = 13;
        var codigoCompra = $( "#codigoVenta" ).val();

        if(codigoCompra != ''){

            if(e.which == enterkey){

                var id_venta = $('#id_venta').val();

                var urlVT = '/ventas/ventaTemporal?id_producto=' + id_producto + '&cantidad=' + 1 +'&id_venta=' + id_venta;
            
                $.ajax({
                    url : urlVT,
                    dataType: 'JSON',
                    success: function(resp3) {
          
                        if(resp3.enviado == false) {
                            if(resp3.error == true){
                                $('#codigoVenta').val('');
                                Swal.fire(
                                    'No existe más productos',
                                    '-',
                                    'error'
                                )

                            }
                        }else{
                            $(".tablaproductosVenta tbody").empty();
                            $(".tablaproductosVenta tbody").append(resp3.verVenta);
                            $("#totalVenta").val(resp3.total);
            
                            $("#errorProducto").empty();
                            $('#codigoVenta').val('');
                        }
                    }
                })
            }
        }
    }

} );


$(".tablaproductosVenta tbody").on("click", "button.alertaBorrar", function(e) {
    
    var id_temporal = $(this).attr("id_temporalVenta");
    var id_venta = $('#id_venta').val();

    var urlVE = '/ventas/eliminarTemporal?id_temporal=' + id_temporal + '&id_venta=' + id_venta;

    $.ajax({
        url : urlVE,
        dataType: 'JSON',
        success: function(resp4) {
            if(resp4.enviado == false) {
         
            }else{
                $(".tablaproductosVenta tbody").empty();
                $(".tablaproductosVenta tbody").append(resp4.verVenta);
                $("#totalVenta").val(resp4.total);
            }
        }
    })

})