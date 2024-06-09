var body = $('body');
var baseurl = $('.baseurl').data('value');
var siswa_id = $('.siswa_id').data('value');
var datatable;

$(document).ready(function () {
    function initDatatable(dari_tanggal = $('input[name="dari_tanggal"]').val(), sampai_tanggal = $('input[name="sampai_tanggal"]').val()) {
        datatable = basicDatatable({
            tableId: $("#dataTable"),
            ajaxUrl: `${baseurl}/LaporanAbsensi/dataTables?siswa_id=${siswa_id}`,
            columns: [
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    className: "text-center",
                },
                {
                    data: "nama_absensi",
                    name: "nama_absensi",
                    searchable: true,
                },
                {
                    data: "keterangan_absensi",
                    name: "keterangan_absensi",
                    searchable: true,
                },
                {
                    data: "jumlah_absensi",
                    name: "jumlah_absensi",
                    searchable: true,
                },
            ],
            dataAjaxUrl: {
                dari_tanggal: formatDateToDb(dari_tanggal),
                sampai_tanggal: formatDateToDb(sampai_tanggal)
            },
        });
    }
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
