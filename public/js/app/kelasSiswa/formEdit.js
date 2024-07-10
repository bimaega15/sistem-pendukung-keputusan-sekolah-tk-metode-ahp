var kelas_id = $('.kelas_id').data('value');
var baseurl = $('.baseurl').data('value');
var row_id = $('.row_id').data('value');


function rowData() {
    if (row_id !== null && row_id !== '') {
        $.ajax({
            url: `${baseurl}/KelasSiswa/getData`,
            type: 'get',
            dataType: 'json',
            data: {
                kelas_id,
                id: row_id,
            },
            success: function (data) {
                const { row } = data;
                $('select[name="users_id"]').append(
                    new Option(`<strong>Nama Siswa: ${row.nama_profile}</strong>`, row.id, true, true)
                );
            }
        })
    }

}
rowData();

var body = $('body');
var formSubmit = document.getElementById("form-submit");
var validate = $("#form-submit").validate({
    rules: {
        users_id: "required",
    },
    messages: {
        users_id: "Masukan Siswa",
    }
});
select2Server({
    selector: 'select[name="users_id"]',
    parent: '#modalNormal',
    routing: `${baseurl}/Siswa/select2`,
})

$(document).ready(function () {
    formSubmit.addEventListener("submit", function (event) {
        event.preventDefault();
        submitData();
    });

    function submitData() {
        if (validate.valid()) {
            const formData = {};
            formData.kelas_id = kelas_id;
            formData.users_id = $('select[name="users_id"]').val();
            formData.users_id_now = $('input[name="users_id_now"]').val();

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