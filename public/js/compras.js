$(document).ready(function(){

});

// $('#codigoCompra')

$('#codigoCompra').keypress(function (e) {
    if (e.which == 13) {

        var codigobarra = $('#codigoCompra').val();
        var url = '/compras/buscarCodigo?codigo=' + codigobarra;
        // var url = '<?php base_url(); ?>/compras/buscarCodigo?codigo=' + codigobarra;
        // var url = 'http://pos_venta_codeigniter.test/compras/buscarCodigo?codigo=' + codigobarra;

        $.ajax({
            url : url,
            dataType: 'JSON',
            success: function(respuesta) {
                console.log(respuesta.existe)
                if(respuesta.existe == false) {
                    $('#codigoCompra').val('');
                    $("#errorProducto").append("<p class='text-danger'>"+respuesta.error+"</p>");
                    $('#idProducto').val('');
                    $('#nameProducto').val('');
                    $('#cantidadProducto').val('');
                    $('#PrecioProducto').val('');
                    $('#SubtotalProducto').val('');
                    // console.log('error');
                }else if(respuesta.existe == true){
                    $("#errorProducto").empty();
                    $('#idProducto').val(respuesta.producto.id);
                    $('#nameProducto').val(respuesta.producto.name);
                    $('#cantidadProducto').val(1);
                    $('#PrecioProducto').val(respuesta.producto.precio_compra);
                    $('#SubtotalProducto').val(respuesta.producto.precio_compra);
                }
            }
        })


    // $('form#login').submit();
    }
});


// $('#cantidadProducto').each(function(){
//     var dato = $(this).val();
//     console.log(dato);
// });

$("#cantidadProducto").on("change keyup paste", function(){
    var dato = $(this).val();
    var precio = $('#PrecioProducto').val();

    if(precio == ''){
        $('#cantidadProducto').val('');
        $('#PrecioProducto').val('');
    }else if(precio < 0){
        $('#cantidadProducto').val('');
        $('#PrecioProducto').val('');
    }else{
        var subTotal = dato * precio;
        $('#SubtotalProducto').val(subTotal.toFixed(2));
    }

    // console.log(subTotal);
})

$("#agregarProducto").click(function(){
    var idProducto = $('#idProducto').val();
    var cantidad =  $('#cantidadProducto').val();
    var id_compra = $('#id_compra').val();
    var urlT = '/compras/compraTemporal?id_producto=' + idProducto + '&cantidad=' + cantidad +'&id_compra=' + id_compra;

    $.ajax({
        url : urlT,
        dataType: 'JSON',
        success: function(resp) {
            console.log(resp.enviado);
            if(resp.enviado == false) {
         
            }else{
                $("#errorProducto").empty();
                $('#codigoCompra').val('');
                $('#idProducto').val('');
                $('#nameProducto').val('');
                $('#cantidadProducto').val('');
                $('#PrecioProducto').val('');
                $('#SubtotalProducto').val('');
            }
        }
    })
});