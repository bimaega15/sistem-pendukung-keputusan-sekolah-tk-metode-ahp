var validate = $("#form-submit").validate({
    rules: {
        email_username_users: "required",
        password_users: "required",
    },
    messages: {
        email_username_users: "Masukan email atau password anda",
        password_users: "Masukan password anda",
    }
});

var body = $('body');
var baseurl = $('.baseurl').data('value');

$(document).ready(function () {
    body.on('click', '#btn-submit', function (e) {
        e.preventDefault();
        var formData = $("#form-submit").serialize();
        $.ajax({
            type: "post",
            url: $("#form-submit").attr("action"),
            data: formData,
            dataType: "json",
            beforeSend: function () {
                $("#btn-submit").attr("disabled", true);
                $("#btn-submit").html(disableButton);
            },
            success: function (data) {
                const result = data.result;
                Swal.fire({
                    title: data.title,
                    text: data.message,
                    icon: data.status ? 'success' : 'error',
                    confirmButtonText: "OK",
                }).then(function () {
                    if (data.status) {
                        if (result.nama_roles != 'Wali Murid') {
                            window.location.href = `${baseurl}/Dashboard`;
                        } else {
                            window.location.href = `${baseurl}/PenilaianAhp`;
                        }
                    }
                });
            },
            error: function (jqXHR, exception) {
                $("#btn-submit").attr("disabled", false);
                $("#btn-submit").html(enableButton);

                if (jqXHR.status === 400) {
                    return Swal.fire({
                        title: 'Failed',
                        text: (jqXHR.responseText),
                        icon: "error",
                        confirmButtonText: "OK",
                    });
                }

                Swal.fire({
                    title: 'Failed',
                    text: JSON.parse(jqXHR.responseText).message,
                    icon: "error",
                    confirmButtonText: "OK",
                });
            },
            complete: function () {
                $("#btn-submit").attr("disabled", false);
                $("#btn-submit").html(enableButton);
            },
        });
    })
})