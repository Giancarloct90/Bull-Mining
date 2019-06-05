$(document).on("submit", "#guardarContacto", function (e) {
    e.preventDefault();
    $.ajax({
        type: "post",
        url: "controller.php?action=guardarContacto",
        data: $(this).serializa(),
        success: function (data) {
            alert(data);
        }
    });
});