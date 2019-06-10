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

    $(document).on('click', '.btnDelete', () => {
        alert('hello');
    });

    let obtenerContactos = () => {
        $.ajax({
            type: "GET",
            url: "controller.php?action=getContactosWithTelefonos",
            success: (response) => {
                let template = '';
                let template2 = '';
                let template3 = '';
                let templateTot = '';
                let template4 = '';
                let template5 = '';
                contactos = JSON.parse(response);
                let arr = [];
                contactos.forEach((contacto) => {
                    arr.push(contacto);
                });
                //console.log(arr);
                let i = 0;
                arr.forEach((ct) => {
                    //console.log(contactos);
                    for (var k in ct) {
                        i++;
                    }
                    //console.log(i);
                    template2 = `<td>`;
                    for (b = 0; b <= i - 5; b++) {
                        template2 += `<li>${ct[b]}</li>`;
                    }
                    template2 += `</td>`;
                    template += `<tr> 
                    <td>${ct['id_contacto']}</td>
                    <td>${ct['nombres']}</td>
                    <td>${ct['apellidos']}</td>
                    <td>${ct['direccion']}</td>
                    `;
                    template += template2;
                    template4 = `<td><a href="modicar.php?id_contacto=${ct['id_contacto']}">Modificar</a></td>`;
                    template5 = `<td><button id="btnBorrar" type="button" class=" btnDelete btn btn-danger">Borrar</button></a></td>`;
                    template += template4;
                    template += template5;
                    template += '<tr>';
                    i = 0;
                });
                templateTot = template + template3;
                $('#tablaContactos').html(template);
            }
        });
    };
    obtenerContactos();
});