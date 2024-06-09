var body = $('body');
var formSubmit = document.getElementById("form-submit");
var validate = $("#form-submit").validate({
    rules: {
        tanggal_absensi: "required",
        nama_absensi: "required",
    },
    messages: {
        tanggal_absensi: "Masukan tanggal",
        nama_absensi: "Masukan absensi",
    }
});

$(document).ready(function () {
    select2Standard({
        parent: '#modalLg',
        selector: 'select[name="nama_absensi"]',
    })

    $('input[name="tanggal_absensi"]').datetimepicker({
        format: 'd/m/Y H:i',
        formatDate: 'Y/m/d H:i',
    });

    formSubmit.addEventListener("submit", function (event) {
        event.preventDefault();
        submitData();
    });

    function submitData() {
        if (validate.valid()) {
            const formData = {};
            formData.tanggal_absensi = formatTanggalToDb($('input[name="tanggal_absensi"]').val());
            formData.nama_absensi = $('select[name="nama_absensi"]').val();
            formData.keterangan_absensi = $('textarea[name="keterangan_absensi"]').val();

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
                    $('#modalLg').modal('hide');
                    Swal.fire({
                        title: 'Successfully',
                        text: data,
                        icon: "success",
                        confirmButtonText: "OK",
                    });
                    datatable.ajax.reload();
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