$(document).ready(function(){

    $("#completa_compra").click(function(){
        let nFile = $(".tablaproductos tr").length;

        if(nFile < 2 ){

        }else{
            $("#form_compra").submit();
        }
    });

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
            // var resultado = JSON.parse(resp);
            // console.log(resp);
            // console.log(resultado);
            if(resp.enviado == false) {
         
            }else{
                $(".tablaproductos tbody").empty();
                $(".tablaproductos tbody").append(resp.verCompra);
                $("#totalCompra").val(resp.total);

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


$(".tablaproductos tbody").on("click", "button.alertaBorrar", function(e) {
    
    var id_temporal = $(this).attr("id_temporal");
    var id_compra = $('#id_compra').val();

    var urlE = '/compras/eliminarTemporal?id_temporal=' + id_temporal + '&id_compra=' + id_compra;

    $.ajax({
        url : urlE,
        dataType: 'JSON',
        success: function(resp2) {
            if(resp2.enviado == false) {
         
            }else{
                $(".tablaproductos tbody").empty();
                $(".tablaproductos tbody").append(resp2.verCompra);
                $("#totalCompra").val(resp2.total);
            }
        }
    })

    // console.log(id_temporal);

})