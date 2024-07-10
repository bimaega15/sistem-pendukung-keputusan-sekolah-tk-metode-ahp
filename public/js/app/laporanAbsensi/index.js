var body = $('body');
var baseurl = $('.baseurl').data('value');
var siswa_id = $('.siswa_id').data('value');
var datatable;

function initDatatable(dari_tanggal = $('input[name="dari_tanggal"]').val(), sampai_tanggal = $('input[name="sampai_tanggal"]').val()) {
    $.ajax({
        url: `${baseurl}/LaporanAbsensi/dataTables?siswa_id=${siswa_id}`,
        type: "get",
        dataType: "json",
        data: {
            dari_tanggal: formatDateToDb(dari_tanggal),
            sampai_tanggal: formatDateToDb(sampai_tanggal)
        },
        success: function (result) {
            const { data } = result;
            $('#dataTable').DataTable().destroy();

            datatable = $('#dataTable').DataTable({
                data: data,
                columns: [
                    { data: null, render: function (data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    { data: 'nama_absensi' },
                    { data: 'keterangan_absensi' },
                    { data: 'jumlah_absensi' },
                ]
            });

        }
    })
}

$(document).ready(function () {
    initDatatable();

    //Date picker
    $('#dari_tanggal').datetimepicker({
        format: 'DD/MM/YYYY'
    });
    $('#sampai_tanggal').datetimepicker({
        format: 'DD/MM/YYYY'
    });

    const setTanggal = () => {
        const dari_tanggal = $('input[name="dari_tanggal"]').val();
        const sampai_tanggal = $('input[name="sampai_tanggal"]').val();

        return {
            dari_tanggal,
            sampai_tanggal,
        }
    }

    body.on('click', '.btn-filter', function (e) {
        e.preventDefault();
        const getTanggal = setTanggal();
        $('#dataTable').DataTable().destroy();
        initDatatable(getTanggal.dari_tanggal, getTanggal.sampai_tanggal);
    })
})
