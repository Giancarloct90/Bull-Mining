//lo que le estamos diciendo con el este codido es que este pendiente del elemento submit, de form guardarContacto
// yq eu cuando se presione se ejcute el callback
$(document).on("submit", "#guardarContacto", function (e) {
    // con esta linea de codigo cancelamos el comportamiento nativo de un formulario
    // entonces es de esta manera como evitamos que se refresque dicha pagina,
    // evitamos que al presionar el boton de submit se refresque la pagina
    e.preventDefault();
    $.ajax({
        type: "post",
        url: "controller.php?action=guardarContacto",
        data: $(this).serialize(),
        success: function (data) {
            alert(data);
        }
    });
});