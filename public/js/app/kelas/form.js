select2Standard({
    parent: '#modalNormal',
    selector: 'select[name="tingkat_kelas"]',
})

select2Server({
    selector: '.select2Server',
    parent: '#modalNormal',
    routing: `${baseurl}/Guru/select2`,
})

var body = $('body');
var formSubmit = document.getElementById("form-submit");
var validate = $("#form-submit").validate({
    rules: {
        tingkat_kelas: "required",
        nama_kelas: "required",
        users_id: "required",
    },
    messages: {
       
        nama_kelas: "Masukan nama kelas",
        users_id: "Masukan nama guru",
    }
});

$(document).ready(function () {
    formSubmit.addEventListener("submit", function (event) {
        event.preventDefault();
        submitData();
    });

    function submitData() {
        if (validate.valid()) {
            const formData = $("#form-submit").serialize();

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