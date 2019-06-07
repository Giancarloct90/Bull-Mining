//lo que le estamos diciendo con el este codido es que este pendiente del elemento submit, de form guardarContacto
// yq eu cuando se presione se ejcute el callback


$(document).ready(() => {
    $("#guardarContacto").submit((e) => {
        //$("#guardarContacto").
        // con esta linea de codigo cancelamos el comportamiento nativo de un formulario
        // entonces es de esta manera como evitamos que se refresque dicha pagina,
        // evitamos que al presionar el boton de submit se refresque la pagina
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "controller.php?action=guardarContacto",
            data: $("#guardarContacto").serialize(),
            success: function (data) {
                alert(data);
                $("#guardarContacto").trigger('reset');
            }
        });
    });

    let obtenerContactos = () => {
        $.ajax({
            type: "GET",
            url: "controller.php?action=obtenerContactos",
            success: (response) => {
                let contactos = JSON.parse(response);
                let template = '';
                contactos.forEach(contacto => {

                    template +=
                        `<tr>
                            <td>${contacto.id_contacto}</td>
                            <td>${contacto.nombres}</td>
                            <td>${contacto.apellidos}</td>
                            <td>${contacto.direccion}</td>
                            <td>${999}</td>
                        </tr>`;
                });
                $("#tablaContactos").html(template);
            }
        });
    };

    let obtTelefonos = () => {
        $.ajax({
            type: "POST",
            data: {
                id_contacto: '77'
            },
            url: "controller.php?action=obtenerTelefonos",
            success: (response) => {
                // let contactos = JSON.parse(response);
                // let template = '';
                // contactos.forEach(telefono => {

                //     console.log(telefono);
                // });
                console.log(response);
            }
        });
    };
    obtTelefonos();
    obtenerContactos();
});