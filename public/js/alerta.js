$(".alertaBorrar").on("click", function(event) {
    event.preventDefault();
    const href = $(this).attr("href");
    // console.log(href)

    Swal.fire({
        icon: "warning",
        title: "¿Estas seguro?",
        // text: "¡No podrás revertir esto!",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "¡Sí, bórralo!"
    }).then((result) => {
        if (result.isConfirmed) {
            document.location.href = href;
            // console.log(document.location.href)
        }
    });
})

$(".alertaRestaurar").on("click", function(event) {
    event.preventDefault();
    const href = $(this).attr("href");
    // console.log(href)

    Swal.fire({
        icon: "warning",
        title: "¿Estas seguro?",
        // text: "¡No podrás revertir esto!",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "¡Sí, Restaurar!"
    }).then((result) => {
        if (result.isConfirmed) {
            document.location.href = href;
            // console.log(document.location.href)
        }
    });
})