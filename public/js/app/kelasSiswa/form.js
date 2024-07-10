var kelas_id = $('.kelas_id').data('value');
var checkboxItems = [];
var dataTableSiswa;

function getDataKelas() {
    if (kelas_id !== null && kelas_id !== '') {
        $.ajax({
            url: `${baseurl}/KelasSiswa/getDataKelas`,
            type: 'get',
            dataType: 'json',
            data: {
                kelas_id,
            },
            async: false,
            success: function (data) {
                const { row } = data;
                checkboxItems = row;
            }
        })
    }
}
getDataKelas();

var body = $('body');
var formSubmit = document.getElementById("form-submit");

$(document).ready(function () {
    body.off('change', '#checkboxall');
    body.on('change', '#checkboxall', function (e) {
        if ($(this).is(":checked")) {
            $('.checkbox-item').prop('checked', true);
        } else {
            $('.checkbox-item').prop('checked', false);
        }

        checkboxItems = [];
        $('.checkbox-item:checked').each(function () {
            checkboxItems.push($(this).val());
        });

    })
    body.off('change', '.checkbox-item');
    body.on('change', '.checkbox-item', function (e) {
        const isChecked = $(this).is(":checked");
        const value = $(this).val();

        const index = checkboxItems.indexOf(value);

        if (isChecked && index === -1) {
            checkboxItems.push(value);
        } else if (!isChecked && index !== -1) {
            checkboxItems.splice(index, 1);
        }

        const checkboxItem = $('.checkbox-item').length;
        const checkboxItemChecked = $('.checkbox-item:checked').length;
        if (checkboxItem == checkboxItemChecked) {
            $('#checkboxall').prop('checked', true);
        } else {
            $('#checkboxall').prop('checked', false);
        }
    });


    formSubmit.addEventListener("submit", function (event) {
        event.preventDefault();
        submitData();
    });

    function submitData() {
        const formData = {};
        formData.kelas_id = kelas_id;
        formData.users_id = checkboxItems.join(',');

        if (checkboxItems.length === 0) {
            return Swal.fire({
                title: 'Failed',
                text: "Pastikan anda telah memilih siswa",
                icon: "error",
                confirmButtonText: "OK",
            });
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
                $('#modalLg').modal('hide');
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
})