var body = $('body');
var baseurl = $('.baseurl').data('value');
var siswa_id = $('.siswa_id').data('value');
var datatable;

$(document).ready(function () {
    function initDatatable() {
        datatable = basicDatatable({
            tableId: $("#dataTable"),
            ajaxUrl: `${baseurl}/AbsensiSiswa/dataTables?siswa_id=${siswa_id}`,
            columns: [
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    className: "text-center",
                },
                {
                    data: "tanggal_absensi",
                    name: "tanggal_absensi",
                    searchable: true,
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
                    data: "action",
                    name: "action",
                    searchable: true,
                },
            ],
            dataAjaxUrl: {
            },
        });
    }
    initDatatable();


    body.on('click', '.btn-add', function (e) {
        e.preventDefault();

        showModal({
            url: $(this).data('url'),
            modalId: 'modalLg',
            title: 'Form Absensi Siswa',
            type: 'get'
        })
    })

    body.on('click', '.btn-edit', function (e) {
        e.preventDefault();
        showModal({
            url: $(this).attr('href'),
            modalId: 'modalLg',
            title: 'Form Absensi Siswa',
            type: 'get'
        })
    })

    body.on('click', '.btn-delete', function (e) {
        e.preventDefault();
        basicDeleteConfirmDatatable({
            urlDelete: $(this).attr('href'),
        })
    })
})
