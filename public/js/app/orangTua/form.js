
var row_id = $('.row_id').data('value');
var baseurl = $('.baseurl').data('value');

function getUsersIdSiswa() {
    if (row_id !== null && row_id !== '') {
        $.ajax({
            url: `${baseurl}/Siswa/getUsersById/${row_id}`,
            type: 'get',
            dataType: 'json',
            success: function (data) {
                const { row } = data;
                $('select[name="users_id_siswa"]').append(
                    new
                        Option(`<strong>Nama Siswa: ${row.nama_profile}</strong>`, row.id, true, true)
                );
            }
        })
    }
}

getUsersIdSiswa();


select2Server({
    selector: 'select[name="users_id_siswa"]',
    parent: '#modalNormal',
    routing: `${baseurl}/Siswa/select2`,
})

var body = $('body');
var formSubmit = document.getElementById("form-submit");
var is_edit = $('input[name="is_edit"]').val();
var valuePassword = {
    password_users: "required",
    password_confirm_users: {
        required: true,
        equalTo: "input[name='password_users']"
    },
}
var messagePassword = {
    password_users: "Masukan password",
    password_confirm_users: {
        required: "Masukan confirm password",
        equalTo: "Tolong masukan password sama dengan confirm password"
    },
}
if (is_edit) {
    valuePassword = {
        password_confirm_users: {
            equalTo: "input[name='password_users']"
        },
    };
    messagePassword = {
        password_confirm_users: {
            equalTo: "Tolong masukan password sama dengan confirm password"
        },
    };
}
var validate = $("#form-submit").validate({
    rules: {
        username_users: "required",
        email_users: {
            required: true,
            email: true
        },
        ...valuePassword,
        nama_profile: "required",
        jeniskelamin_profile: "required",
    },
    messages: {
        username_users: "Masukan username",
        email_users: {
            required: "Masukan email",
            email: "Email anda tidak valid"
        },
        ...messagePassword,
        nama_profile: "Masukan nama profile",
        jeniskelamin_profile: "Masukan jenis kelamin",
    }
});

$(document).ready(function () {
    formSubmit.addEventListener("submit", function (event) {
        event.preventDefault();
        submitData();
    });

    function submitData() {
        if (validate.valid()) {
            var formData = $("#form-submit").serialize();
            if (is_edit) {
                var password_users = $('input[name="password_users"]').val();
                var password_old = $('input[name="password_old"]').val();
                var password_db = password_users;
                var is_new_password = 1;
                if (password_users == '' || password_users == undefined) {
                    password_db = password_old;
                    is_new_password = 0;
                }
                formData = {};
                formData.is_new_password = is_new_password;
                formData.username_users = $('input[name="username_users"]').val();
                formData.email_users = $('input[name="email_users"]').val();
                formData.password_users = password_db;
                formData.nama_profile = $('input[name="nama_profile"]').val();
                formData.nomorhp_profile = $('input[name="nomorhp_profile"]').val();
                formData.alamat_profile = $('textarea[name="alamat_profile"]').val();
                formData.jeniskelamin_profile = $('input[name="jeniskelamin_profile"]:checked').val();
                formData.users_id_siswa = $('select[name="users_id_siswa"] option:selected').val();
            }

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
                    $('#modalNormal').modal('hide');
                    Swal.fire({
                        title: 'Successfully',
                        text: data,
                        icon: "success",
                        confirmButtonText: "OK",
                    });
                    initDatatable();
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
        }
    }
})